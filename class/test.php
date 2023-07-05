<?php 

include_once './Conect.php';
class back extends Conexao{
    function fazer(){
        $this->conectar();
        $consulta = $this->conexao->prepare("SELECT L.id_lancamento, L.id_produto, L.id_usuario, L.quantidade, L.dia, L.forma_pagamento, P.descricao, P.tipo FROM lancamento L JOIN produto P on L.id_produto = P.id_produto GROUP BY L.id_produto, L.dia ORDER BY L.dia ASC");
        $consulta->execute();
        $rows[0] = null;
        $resultado = $consulta->get_result();
        for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
        }
        $consulta->close();
        $this->fecharConexao();
        for ($i=0; isset($rows[$i]) ; $i++) { 
            echo $rows[$i]['id_lancamento']." | ";
            echo $rows[$i]['descricao']." | ";
            echo $rows[$i]['id_produto']." | ";
            echo $rows[$i]['tipo']." | ";
            echo $rows[$i]['id_usuario']." | ";
            echo $rows[$i]['quantidade']." | ";
            echo $rows[$i]['dia']." | ";
            echo $rows[$i]['forma_pagamento']."</br>";
        }
        
    }
}
$con = new back;
$con->fazer();
?>
