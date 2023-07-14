<?php
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt-br');
include_once ".\class\Conect.php";
include ".\class\Formater.php";
include ".\class\Chart_mount.php";
$cores = file("./etc/colors.txt",FILE_IGNORE_NEW_LINES);
class Relatorio extends Conexao{
     private $data;

     public function __construct() {
          $this->data = date('Y-m-d', time());
     }

     function setData($data){
          $this->data = $data;
     }
     function getlancamentos(){
          $this->conectar();
               $consulta = $this->conexao->prepare(
               "SELECT L.quantidade, l.VT, L.dia, P.id_produto,P.descricao, P.tipo 
               FROM lancamento L 
               JOIN produto P on L.id_produto = P.id_produto 
               WHERE L.dia LIKE '{$this->data}%' OR L.dia > '{$this->data}'
               ORDER BY L.id_produto ASC"
               );
               $consulta->execute();
               $rows = null;
                $resultado = $consulta->get_result();
                for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
                 $rows[$i] = $row;
                  }
               
               return $rows;

     }


}







if (empty($_GET['tipo_acao']) || is_null($_SESSION['data'])) {
     $_SESSION['data'] = 0;
}else{
     $_SESSION['data'] = $_GET['tipo_acao'];
}
$lancamentos = new Relatorio;

$label;
switch ($_SESSION['data']) {
     case 0:
          $label = array('Hoje');
          $lancamentos->setData(date('Y-m-d', time()));
          $Balanca = $lancamentos->getlancamentos();
          $tempo = 'today';
          break;
     case 1:
          $label = array('Domingo','Segunda','Térça',"Quarta",'Quinta','Sexta','Sábado');
          $lancamentos->setData(date('Y-m-d', strtotime('-'.(date('w',time())).' day')));
          $Balanca = $lancamentos->getlancamentos();
          $tempo = 'week';
          break;
     case 2:
          $label = array('1º a 3º','4º a 6º','7º a 9º', '10º a 12º', '13º a 15º', '16º a 18º', '19º a 21º', '22º a 24º', '25º a 27º', '28º a 30º', '31º');
          $lancamentos->setData(date('Y-m-', time()).'01');
          $Balanca = $lancamentos->getlancamentos();
          $tempo = 'month';
          break;
     case 3:
          $label = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro');
          $lancamentos->setData(date('Y-', time()).'-01-01');
          $Balanca = $lancamentos->getlancamentos();
          $tempo = 'year';
          break;
     case 4:
          $label = 'Hoje';
          break;
     
     default:
          $label = 'Hoje';
          break;
}

$labels = json_encode($label);
$fmt = new Formater($tempo);
for ($i=0; isset($Balanca[$i]) ; $i++) { 
     $fmt->add_format(
     $Balanca[$i]["id_produto"],
     $Balanca[$i]["descricao"],
     $Balanca[$i]["VT"],
     $Balanca[$i]["quantidade"],
     $Balanca[$i]["dia"],
     $Balanca[$i]["tipo"]);
}
$BTS = $fmt->get_date();
$Balanca = $fmt->get_result();

$balancaen =array('name' => array(),'lucro' => array(), 'data' => array() ); $balancasa =array('name' => array(),'lucro' => array(), 'data' => array() );
$produtoen = array(); $produtosa = array();
$Bkeys =array_keys($Balanca);
for ($i=0; isset($Bkeys[$i]); $i++) { 
     $BTempo = $Balanca[$Bkeys[$i]];
     $BTkeys = array_keys($BTempo);

     for ($s=0; isset($BTkeys[$s]) ; $s++) { 
          if (!isset($balancaen['data'][$BTkeys[$s]])) {
                $balancaen['data'][$BTkeys[$s]] = 0;
          
          }
          if (!isset($balancasa['data'][$BTkeys[$s]])) {
                $balancasa['data'][$BTkeys[$s]] = 0;
          
          }
          $Barray = $BTempo[$BTkeys[$s]];

          if (isset($Barray['ID'])) {

               switch($Barray['TIPO']){
               case 'entrada':    

                    $balancaen['data'][$BTkeys[$s]] += $Barray['VT'];

                    if (!isset($produtoen[$Barray['ID']])) {
                         $produtoen[$Barray['ID']] = array('name' => $Barray['name'], 
                         "VT" => array(),
                         "QT" => array()
                         );
                    }
                    if (!isset($produtoen[$Barray['ID']]['VT'][$BTkeys[$s]])) {
                         $produtoen[$Barray['ID']]['VT'][$BTkeys[$s]] = $Barray['VT'];
                         $produtoen[$Barray['ID']]['QT'][$BTkeys[$s]] = $Barray['QT'];
                    }else {
                         $produtoen[$Barray['ID']]['VT'][$BTkeys[$s]] += $Barray['VT'];
                         $produtoen[$Barray['ID']]['QT'][$BTkeys[$s]] += $Barray['QT'];
                    }
                    break;
               case 'saida':
                    $balancasa['data'][$BTkeys[$s]] += $Barray['VT'];
                    
                    if (!isset($produtosa[$Barray['ID']])) {
                         $produtosa[$Barray['ID']] = array('name' => $Barray['name'],'VT' => 0,'QT' => 0);
                    }
                    $produtosa[$Barray['ID']]['VT'] += $Barray['VT'];
                    $produtosa[$Barray['ID']]['QT'] += $Barray['QT'];
                    break;
               }
          }
         
     }

}


$funcionarioname = array('admin','funcionario');
$funcionariovendasvalor = array(100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500);
$funcionariolucrovalor = array(15000,32100);

$chart_pie = new Chart_pie("Numero de vendas",$funcionarioname);
$chart_bar = new Chart_bar($label);


$BENkeys = array_keys($balancaen);
$bendata['data'] = array(); 

for ($i=0; isset($BENkeys[$i]); $i++) { 
     for ($s=0; $BTS > $s ; $s++) { 
          if(isset($balancaen['data'][$s])){
               $bendata['data'][$s] = 
               $balancaen['data'][$s];
          }else{
               $bendata['data'][$s] = 0;
          }
     }
}

$BSAkeys = array_keys($balancasa);
$bsadata['data'] = array(); 

for ($i=0; isset($BSAkeys[$i]); $i++) { 
     for ($s=0; $BTS > $s ; $s++) { 
          if(isset($balancasa['data'][$s])){
               $bsadata['data'][$s] = 
               $balancasa['data'][$s];
          }else{
               $bsadata['data'][$s] = 0;
          }
     }
}

// Cria o grafico em Barra de Balança Geral
$chart_bar->add_head($label);
$chart_bar->add_Data("Vendas",$bendata['data'],'#007bff');
$chart_bar->add_Data("Saida",json_encode($bsadata['data']),'#28a745');
$databge = $chart_bar->getResult();
$chart_bar->clear();


// Cria o grafico em Barra de Balança Entrada
$chart_bar->add_head($label);
$chart_bar->add_Data("Vendas",$bendata['data'],'#007bff');
$databen = $chart_bar->getResult();
$chart_bar->clear();


// Cria o grafico em Barra de Balança Saida
$chart_bar->add_head($label);
$chart_bar->add_Data("Vendas",$bsadata['data'],'#28a745');
$databsa = $chart_bar->getResult();
$chart_bar->clear();

$funcionarioname = array('admin','funcionario');
$funcionariovendasvalor = array(100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500);
$funcionariolucrovalor = array(15000,32100);


// Gerar os dataset do Grafito de Vendas dos Funcionarios
$funcionariovendas = '';
// ------------------------------------------------------ //


// Gerar os dataset do Grafito de Lucro dos Funcionarios
$chart_pie->add_data($funcionariolucrovalor);
$chart_pie->add_backcolor($cores);
$funcionariolucro = $chart_pie->getResult(); 
// ------------------------------------------------------ //


// Gerar os dataset do Grafito de Vendas dos Produtos
$chart_bar->add_head($label);
$PVkeys = array_keys($produtoen);
$data = array();
for ($i=0; isset($PVkeys[$i]); $i++) { 
     for ($s=0; $BTS > $s ; $s++) { 
          if (!isset($data[$PVkeys[$i]])) {
               $data[$PVkeys[$i]] = array(); 
          }
          if(isset($produtoen[$PVkeys[$i]]['VT'][$s])){
               $data[$PVkeys[$i]][$s] = 
               $produtoen[$PVkeys[$i]]['VT'][$s];
          }else{
               $data[$PVkeys[$i]][$s] = 0;
          }
     }
}
if (isset($PVkeys)) {
     for ($i=0; isset($PVkeys[$i]) ; $i++) {
          $chart_bar->add_Data($produtoen[$PVkeys[$i]]['name'],
          array_values($data[$PVkeys[$i]]),
          $cores[$i]);
     }
}

$produtovendas = $chart_bar->getResult();
$chart_bar->clear();



// Gerar os dataset do Grafito de Lucro dos Produtos
$kproden = array_keys($produtoen);
$datapen = array(); 
$labelproen = array();
for ($i=0; isset($kproden[$i]); $i++) { 
     $datapen[$i] = $produtoen[$kproden[$i]]['VT'];
     $labelproen[$i] = $produtoen[$kproden[$i]]['name'];

}
$chart_pie->add_head("Quantidade de Vendas",$labelproen);
$chart_pie->add_data($datapen);
$chart_pie->add_backcolor($cores);
$produtolucro = $chart_pie->getResult();
// ------------------------------------------------------ //


// Gerar os dataset do Grafito de Gastos dos Produtos

$kprodsa = array_keys($produtosa);
$datapsa = array(); 
$labelprosa = array();
for ($i=0; isset($kprodsa[$i]); $i++) { 
     $datapsa[$i] = $produtosa[$kprodsa[$i]]['VT'];
     $labelprosa[$i] = $produtosa[$kprodsa[$i]]['name'];
}
$chart_pie->add_head("Gastos em R$",$labelprosa);
$chart_pie->add_data($datapsa);
$chart_pie->add_backcolor($cores);
$produtogastos = $chart_pie->getResult();
// ------------------------------------------------------ //


$labelfun = json_encode($funcionarioname);


?>