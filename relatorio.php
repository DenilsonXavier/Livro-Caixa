<?php 
session_start();
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_TIME, 'pt-br');
include_once 'Controller/RelatorioController.php';
$cores =array('#84b6f4', '#fdfd96', '#0079FF', '#77dd77', '#ff6961', '#fdcae1' , '#ff85d5', '#ffe180', '#a3ffac', '#ffda9e');





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
$keys = array();$k = 0;
for ($i=0; isset($Balanca[$i]) ; $i++) { 
     if(!in_array($Balanca[$i]["id_produto"],$keys)){
          $keys[$Balanca[$i]["id_produto"]] = $k;
          $k++;
     }
     $fmt->add_format($keys[$Balanca[$i]["id_produto"]],$Balanca[$i]["id_produto"],$Balanca[$i]["descricao"],$Balanca[$i]["VT"],$Balanca[$i]["quantidade"],$Balanca[$i]["dia"],$Balanca[$i]["tipo"]);
}

$Balanca = $fmt->get_result();

$ke = 0;$ks = 0; $c = 0;
$balancaen =array('name' => array(),'lucro' => array(), 'data' => array() );
$balancasa =array('name' => array(),'lucro' => array(), 'data' => array() );
$produtoen = array();
$coresp = array();
for ($i=0; isset($Balanca[$i]); $i++) { 
     $balancaen['data'][$i] = 0;
     $balancasa['data'][$i] = 0;
     $Bkeys = array_keys($Balanca[$i]);
     for ($s=0; isset($Bkeys[$s]) ; $s++) { 
          $Barray = $Balanca[$i][$Bkeys[$s]];
          if (isset($Barray['ID'])) {
               if (!(in_array($Barray['ID'],$coresp))) {
                    $coresp[$Balanca[$i][$Bkeys[$s]]['ID']] = $cores[$c];
               }
               switch($Balanca[$i][$Bkeys[$s]]['TIPO']){
               case 'entrada':
                    $balancaen['name'][$ke] = $Barray['name'];
                    $balancaen['lucro'][$ke] = $Barray['VT'];
                    $balancaen['id'][$ke] = $Barray['ID'];
                    $balancaen['data'][$i] += $Barray['VT'];
                    $ke++;

                    if (!isset($produtoen[$Barray['ID']])) {
                         $produtoen[$Barray['ID']] = array('name' => '','VT' => 0,'QT' => 0);
                    }
                    $produtoen[$Barray['ID']]['name'] = $Barray['name'];
                    $produtoen[$Barray['ID']]['VT'] += $Barray['VT'];
                    $produtoen[$Barray['ID']]['QT'] += $Barray['QT'];
                    break;
               case 'saida':
                    $balancasa['name'][$ks] = $Barray['name'];
                    $balancasa['lucro'][$ks] = $Barray['VT'];
                    $balancasa['id'][$ke] = $Barray['ID'];
                    $balancasa['data'][$i] += $Barray['VT'];
                    $ks++;
                    
                    if (!isset($produtosa[$Barray['ID']])) {
                         $produtosa[$Barray['ID']] = array('name' => '','VT' => 0,'QT' => 0);
                    }
                    $produtosa[$Barray['ID']]['name'] = $Barray['name'];
                    $produtosa[$Barray['ID']]['VT'] += $Barray['VT'];
                    $produtosa[$Barray['ID']]['QT'] += $Barray['QT'];
                    break;
               }
          }
         
     }

}
$databen = json_encode($balancaen['data']);
$databsa = json_encode($balancasa['data']);

$funcionarioname = array('admin','funcionario');

$funcionariovendasvalor = array(100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500);
$funcionariolucrovalor = array(15000,32100);



$chart_pie = new Chart_pie("Numero de vendas");

// Gerar os dataset do Grafito de Vendas dos Funcionarios
$funcionariovendas = '';
// ------------------------------------------------------ //


// Gerar os dataset do Grafito de Lucro dos Funcionarios
$chart_pie->add_data($funcionariolucrovalor);
$chart_pie->add_backcolor($cores);
$funcionariolucro = $chart_pie->getResult(); 
// ------------------------------------------------------ //


// Gerar os dataset do Grafito de Vendas dos Produtos
$produtovendas = '';


// Gerar os dataset do Grafito de Lucro dos Produtos
$kproden = array_keys($produtoen);
$datapen = array(); 
for ($i=0; isset($kproden[$i]); $i++) { 
     $datapen[$i] = $produtoen[$kproden[$i]]['VT'];
     $labelproen[$i] = $produtoen[$kproden[$i]]['name'];

}
$chart_pie->add_head("Quantidade de Vendas");
$chart_pie->add_data($datapen);
$chart_pie->add_backcolor($cores);
$produtolucro = $chart_pie->getResult();
$labelproen = json_encode($labelproen);
// ------------------------------------------------------ //


// Gerar os dataset do Grafito de Gastos dos Produtos

$kprodsa = array_keys($produtosa);
$datapsa = array(); 
for ($i=0; isset($kprodsa[$i]); $i++) { 
     $datapsa[$i] = $produtosa[$kprodsa[$i]]['VT'];
     $labelprosa[$i] = $produtosa[$kprodsa[$i]]['name'];
}
$chart_pie->add_head("Gastos em R$");
$chart_pie->add_data($datapsa);
$chart_pie->add_backcolor($cores);
$produtogastos = $chart_pie->getResult();
$labelprosa = json_encode($labelprosa);
// ------------------------------------------------------ //


$labelfun = json_encode($funcionarioname);
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css\bootstrap-icons-1.10.5\font\bootstrap-icons.min.css">
    <link rel="shortcut icon" href="css/bootstrap-icons-1.10.5/pie-chart-fill.svg" type="image/x-icon">
    <title>Relatorio</title>
</head>
<body>
     <div class="container-fluid">
          <div class="row shadow">
               <div class="col-3">
                    <ul class="list-group list-group-flush mt-3 text-center">
                         <li class="list-group-item"><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#relatorio_control" role="button" aria-expanded="false" aria-controls="relatorio_control" ><p class="display-5 fst-italic">Relatorio</p></a></div></li>
                         <div class="collapse multi-collapse" id="relatorio_control">
                              <li class="list-group-item">
                                   <ul class="list-group  list-group-flush">
                                        <form action="./relatorio.php" method="get">
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="0" class="btn "><span class=" fst-italic h4">Hoje</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="1" class="btn "><span class=" fst-italic h4">Essa Semana</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="2" class="btn "><span class=" fst-italic h4">Esse Mês</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="3" class="btn "><span class=" fst-italic h4">Esse Ano</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="4" class="btn "><span class=" fst-italic h4">Todos os Anos</span></button></li>
                                        </form>
                                   </ul>
                              </li>
                         </div>
                    </ul>
                    <ul class="list-group list-group-flush mt-3">
                         <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_control" role="button" aria-expanded="false" aria-controls="balanca_control" ><p class="h2">Balança</p></a></div></li>
                              <div class="collapse multi-collapse" id="balanca_control">
                                   <li class="list-group-item ">
                                        <ul class="list-group list-group-flush ">
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_ge" role="button" aria-expanded="false" aria-controls="balanca_ge" >Geral</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_en" role="button" aria-expanded="false" aria-controls="balanca_en">Entrada</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_sa" role="button" aria-expanded="false" aria-controls="balanca_sa">Saida</a></div></li>
                                        </ul>
                                   </li>
                              </div>
                    </ul>
                    <ul class="list-group list-group-flush mt-3">
                         <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_control" role="button" aria-expanded="false" aria-controls="Funcionario_control" ><p class="h2">Funcionários</p></a></div></li>
                              <div class="collapse multi-collapse" id="Funcionario_control">
                                   <li class="list-group-item ">
                                        <ul class="list-group list-group-flush ">
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_ve" role="button" aria-expanded="false" aria-controls="Funcionario_ve">Vendas</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_lc" role="button" aria-expanded="false" aria-controls="Funcionario_lc">Lucro</a></div></li>
                                        </ul>
                                   </li>
                              </div>
                    </ul>
                    <ul class="list-group list-group-flush mt-3">
                         <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_control" role="button" aria-expanded="false" aria-controls="produto_control" ><p class="h2">Produtos</p></a></div></li>
                              <div class="collapse multi-collapse" id="produto_control">
                                   <li class="list-group-item ">
                                        <ul class="list-group list-group-flush ">
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_ve" role="button" aria-expanded="false" aria-controls="produto_ve">Vendas</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_lc" role="button" aria-expanded="false" aria-controls="produto_lc">Lucro</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_gt" role="button" aria-expanded="false" aria-controls="produto_gt">Gastos</a></div></li>
                                        </ul>
                                   </li>
                              </div>
                    </ul>
               </div>
               <div class="col-9 shadow py-3">

                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="balanca_ge">
                         <div class="text-center h3 fw-bold fst-italic"><span>Balança Geral</span></div>
                         <canvas id="Relatorio_bge" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="balanca_en">
                         <div class="text-center h3 fw-bold fst-italic"><span>Balança Entradas</span></div>
                         <canvas id="Relatorio_ben" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="balanca_sa">
                         <div class="text-center h3 fw-bold fst-italic"><span>Balança Saidas</span></div>
                         <canvas id="Relatorio_bsa" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="Funcionario_ve">
                         <div class="text-center h3 fw-bold fst-italic"><span>Funcionários Vendas</span></div>
                         <canvas id="Funcionario_fve" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="Funcionario_lc">
                         <div class="text-center h3 fw-bold fst-italic"><span>Funcionárois Faturamento</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="Funcionario_flc" style="height: 50vh;" ></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_ve">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Vendas</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_pve" style="height: 10vh;"></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_lc">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Lucro</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_plc" style="height: 50vh;" ></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_gt">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Gastos</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_pgt" style="height: 50vh;" ></canvas>
                         </div>
                    </div>




               </div>
          </div>


		<!-- Area da seção Admin e logout -->
		<div class="row p-1" >
               <div class="row fixed-bottom " >
                    <div class="col-12 text-end" > 
                         <div class="d-flex d-inline justify-content-end align-bottom mb-4" style="height: 5vh;">
                              <div class="collapse multi-collapse" id="menu_control">
                                   <div class="d-inline d-flex">
                                        <div><a href="index.php" class="btn btn "><p class="h2"><i class="bi bi-house"></i></p></a></div>
						     	<?php if ($_SESSION['nivel'] == 'administrador') {echo ' <div> <a href="adm.php" class="btn btn "><p class="h2"><i class="bi bi-gear"></i></p></a> </div> ';} ?>
						     	<?php if ($_SESSION['nivel'] == 'administrador') {echo ' <div> <a href="relatorio.php" class="btn btn "><p class="h2"><i class="bi bi-pie-chart"></i></p></a> </div> ';} ?>
                                        <div><a href="contabilidade.php" class="btn btn "><p class="h2"><i class="bi bi-journals"></i></p></a></div>
                                        <div><a href="login.php" class="btn btn "><p class="h2 text-danger"><i class="bi bi-door-open"></i></p></a></div>
                                   </div>v>
                              </div>
                              <div><a class="btn " data-bs-toggle="collapse" href="#menu_control" role="button" aria-expanded="false" aria-controls="menu_control" ><p class="h2"><i class='bi bi-list '></i></p></a></div>
                         </div>
                    </div>
               </div>
		</div>

          <!-- ------------- fim do container ------------- -->
     </div>

     <script src="js/cdn.jsdelivr.chart.js.umd.min.js"></script>
     <script src="js/bootstrap.bundle.min.js"></script>
     <script>
          var labels = JSON.parse('<?php echo $labels; ?>');
          var labelfun = JSON.parse('<?php echo $labelfun; ?>');
          var labelproen = JSON.parse('<?php echo $labelproen; ?>');
          var labelprosa = JSON.parse('<?php echo $labelprosa; ?>');
          var databen = JSON.parse('<?php echo $databen; ?>');
          var databsa = JSON.parse('<?php echo $databsa; ?>');

          // Grafico Balança Geral
          var ctx = document.getElementById('Relatorio_bge').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [{
               label: 'Vendas',
               data: databen,
               backgroundColor: '#007bff'
          }, {
               label: 'Receitas',
               data: databsa,
               backgroundColor: '#28a745'
          }]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Balança Entrada
          var ctx = document.getElementById('Relatorio_ben').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [{
               label: 'Vendas',
               data: databen,
               backgroundColor: '#007bff'
          }]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Balança Saida
          var ctx = document.getElementById('Relatorio_bsa').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [{
               label: 'Receitas',
               data: databsa,
               backgroundColor: '#28a745'
          }]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Funcionarios vendas
          var ctx = document.getElementById('Funcionario_fve').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [
               <?php 
               echo $funcionariovendas;
                    ?>]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Funcionarios Lucro
          var ctx = document.getElementById('Funcionario_flc').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: labelfun,
          datasets: [{
               <?php echo $funcionariolucro;?>
          }
          ]
          },
          options: {
          responsive: false,
          scales: {
          }
          }
          });
          // Grafico Produto Vendas
          var ctx = document.getElementById('produto_pve').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [{
               <?php echo $produtovendas;?>}
          ]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Produto Lucro
          var ctx = document.getElementById('produto_plc').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: labelproen,
          datasets: [{
               <?php echo $produtolucro;?>}
          ]
          },
          options: {
          responsive: false,
          scales: {
          }
          }
          });
          // Grafico Produto Gastos
          var ctx = document.getElementById('produto_pgt').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: labelprosa,
          datasets: [{
               <?php echo $produtogastos;?>}
          ]
          },
          options: {
          responsive: false,
          scales: {
          }
          }
          });

          
     </script>
</body>
</html>