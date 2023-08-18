<?php
include_once './class/Lancamento.php';

class Pesquisa extends Lancamento{     
     private $consulta;

     
     public function __construct() {
          parent::__construct();
     }

     public function PreparaBusca($tipo,$data,$id_fpagamento,$descricao,$id_produto,$ordem)
     {

		$contartipos = 0;
          if (!empty($tipo) || !empty($data) || !empty($id_fpagamento) || !empty($descricao) || !empty($id) || !empty($id_produto)) {
               $Stringbusca = "SELECT lancamento.id_lancamento, lancamento.id_produto, lancamento.dia,lancamento.quantidade, lancamento.VT, lancamento.forma_pagamento, produto.descricao, produto.tipo, usuario.nick
                FROM `lancamento` 
                join produto 
                    on lancamento.id_produto = produto.id_produto 
                join usuario 
                    on lancamento.id_usuario = usuario.id_usuario
                 WHERE ";
          }else{
               $Stringbusca = "SELECT lancamento.id_lancamento, lancamento.id_produto, lancamento.dia,lancamento.quantidade, lancamento.VT, lancamento.forma_pagamento, produto.descricao, produto.tipo, usuario.nick
                FROM `lancamento` 
                join produto 
                    on lancamento.id_produto = produto.id_produto 
                join usuario 
                    on lancamento.id_usuario = usuario.id_usuario";
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
                     $Stringbusca .= " lancamento.dia LIKE '{$dia}%'";
                     $contartipos = 1;
                    break;
               case 2:
                    if ($contartipos > 0) {$Stringbusca .= " AND ";}
                      $dia = date('Y-m-d', strtotime('-1 week'));
                      $Stringbusca .= "lancamento.dia > '{$dia}' ";
                      $contartipos = 1;
                    break;
               case 3:
                    if ($contartipos > 0) {$Stringbusca .= " AND ";}
                      $dia = date('Y-m-d', strtotime('-1 month'));
                      $Stringbusca .= "lancamento.dia > '{$dia}' ";
                      $contartipos = 1;
                    break;
               case 4:
                    if ($contartipos > 0) {$Stringbusca .= " AND ";}
                      $dia = date('Y-m-d', strtotime('-1 year'));
                      $Stringbusca .= "lancamento.dia > '{$dia}' ";
                      $contartipos = 1;
                    break;
          }
          if (!empty($descricao)) {
               if ($contartipos > 0) {$Stringbusca .= " AND ";}
               $Stringbusca .= "produto.descricao LIKE '{$descricao}%' ";
               $contartipos = 1;
          }
          if (!empty($id_produto)) {
               if ($contartipos > 0) {$Stringbusca .= " AND ";}
               $Stringbusca .= "produto.id_produto = '{$id_produto}' ";
               $contartipos = 1;
          }
          if (!empty($id_fpagamento)) {
               if ($contartipos > 0) {$Stringbusca .= " AND ";}
               $Stringbusca .= "lancamento.forma_pagamento = '{$id_fpagamento}' ";
               $contartipos = 1;
          }
          switch($ordem){
               case 'ASC':
                    $Stringbusca .= " ORDER BY lancamento.dia ASC ";
                    break;
               case 'DESC':
                    $Stringbusca .= " ORDER BY lancamento.dia DESC ";
                    break;
          }
          $this->consulta = $Stringbusca;



     }
     public function Busca($pag)
     {       
          $Stringbusca = $this->consulta;   
          $Stringbusca .= "LIMIT ".($pag*13-13).", ".$pag*13;
          $this->conectar();
          try {
               $consulta = $this->conexao->prepare($Stringbusca);
               $consulta->execute();
          } catch (\Throwable $th) {
               return false;
          }
          $rows = null;
           $resultado = $consulta->get_result();
           for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
             }
          
          return $rows;
     }
     public function Buscatodos(){
          $Stringbusca = $this->consulta;
          $this->conectar();
          try {
               $consulta = $this->conexao->prepare($Stringbusca);
               $consulta->execute();
          } catch (\Throwable $th) {
               return false;
          }
          $rows[0] = null;
           $resultado = $consulta->get_result();
           for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
             }
          return $rows;

     }

     


}




?>