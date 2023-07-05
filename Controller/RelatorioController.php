<?php
include_once ".\class\Conect.php";
include ".\class\Formater.php";
include ".\class\Chart_mount.php";

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


?>