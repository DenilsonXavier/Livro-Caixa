<?php 

include_once './Conect.php';
class back extends Conexao{
    function fazer(){
        $this->conectar();
        $consulta = $this->conexao->prepare("SELECT * FROM  lancamento");
        $consulta->execute();
        $rows[0] = null;
        $resultado = $consulta->get_result();
        for ($i=0; $row = $resultado->fetch_assoc() ; $i++) { 
            $rows[$i] = $row;
        }
        $consulta->close();
        $this->fecharConexao();
        for ($i=0; isset($rows[$i]) ; $i++) { 
            echo $rows[$i]['id_lancamento']."";
            echo $rows[$i]['id_produto'];
            echo $rows[$i]['id_usuario'];
            echo $rows[$i]['quantidade'];
            echo $rows[$i]['dia'];
            echo $rows[$i]['forma_pagamento']."</br>";
        }
        
    }
}
// fopen('../tmp/backup.sql', 'x');
$con = new back;
$con->fazer();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de PDV</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


</body>
</html>
