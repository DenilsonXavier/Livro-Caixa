<?php
include_once './class/Lancamento.php';

class Pesquisa extends Lancamento{
     
     public function busca($tipo,$data,$descricao,$id_produto,$ordem,$pag)
     {

		$contartipos = 0;
          if (!empty($tipo) || !empty($data) || !empty($descricao) || !empty($id) || !empty($id_produto) ) {
               $Stringbusca = "SELECT * FROM `lancamento` INNER join produto on lancamento.id_produto = produto.id_produto WHERE ";
          }else{
               $Stringbusca = "SELECT * FROM `lancamento` INNER join produto on lancamento.id_produto = produto.id_produto ";
          }

          switch($tipo){
               case 1:
                    $Stringbusca .= "produto.tipo = 'entrada'";
                    $contartipos = 1;
                    break;
               case 2:
                    $Stringbusca .= "produto.tipo = 'saida'";
                    $contartipos = 1;
                    break;
               
          }
          switch($data){
               case 1:
                   if ($contartipos > 0) {$Stringbusca .= " AND ";}
                     $dia = date('Y-m-d', time());
                     $Stringbusca .= " lancamento.dia LIKE '".$dia."%'";
                     $contartipos = 1;
                    break;
               case 2:
                    if ($contartipos > 0) {$Stringbusca .= " AND ";}
                      $dia = date('Y-m-d', strtotime('-1 week'));
                      $Stringbusca .= "lancamento.dia > '".$dia."' ";
                      $contartipos = 1;
                    break;
               case 3:
                    if ($contartipos > 0) {$Stringbusca .= " AND ";}
                      $dia = date('Y-m-d', strtotime('-1 month'));
                      $Stringbusca .= "lancamento.dia > '".$dia."' ";
                      $contartipos = 1;
                    break;
               case 4:
                    if ($contartipos > 0) {$Stringbusca .= " AND ";}
                      $dia = date('Y-m-d', strtotime('-1 year'));
                      $Stringbusca .= "lancamento.dia > '".$dia."' ";
                      $contartipos = 1;
                    break;
          }
          if (!empty($descricao)) {
               if ($contartipos > 0) {$Stringbusca .= " AND ";}
               $Stringbusca .= "produto.descricao = '".$descricao."' ";
               $contartipos = 1;
          }
          if (!empty($id_produto)) {
               if ($contartipos > 0) {$Stringbusca .= " AND ";}
               $Stringbusca .= "produto.id_produto = '".$id_produto."' ";
               $contartipos = 1;
          }
          switch($ordem){
               case 'ASC':
                    $Stringbusca .= " ORDER BY lancamento.id_produto ASC ";
                    break;
               case 'DESC':
                    $Stringbusca .= " ORDER BY lancamento.id_produto DESC ";
                    break;
          }
          $Stringbusca .= "LIMIT ".($pag*15-15).", ".$pag*15;
          $this->conectar();
          echo $Stringbusca;
          $consulta = $this->conexao->prepare($Stringbusca);
          $consulta->execute();
          $rows[0] = null;
           $resultado = $consulta->get_result();
           for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
             }
          return $rows;




     }
     
}




?>