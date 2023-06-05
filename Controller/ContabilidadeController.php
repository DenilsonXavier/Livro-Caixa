<?php
include_once './class/Lancamento.php';

class Pesquisa extends Lancamento{
     
     public function busca($tipo,$data,$descricao,$id_produto,$ordem,$pag)
     {
		$contartipos = 0;
          if (isset($tipo) || isset($data) || isset($descricao) || isset($id) || isset($id_produto) ) {
               $Stringbusca = "SELECT * FROM `lancamento` WHERE ";
          }else{
               $Stringbusca = "SELECT * FROM `lancamento` ";
          }

          switch($tipo){
               case 'entrada':
                    $Stringbusca += " lancamento.tipo = 'entrada'";
                    $contartipos = 1;
                    break;
               case 'saida':
                    $Stringbusca += " lancamento.tipo = 'saida'";
                    $contartipos = 1;
                    break;
          }
          switch($data){
               case 'value':
                    # code...
                    break;
               case 'value':
                    # code...
                    break;
               case 'value':
                    # code...
                    break;
               case 'value':
                    # code...
                    break;
          }
          
          
          $this->conectar();
          




     }
     
}




?>