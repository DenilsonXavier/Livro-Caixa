<?php
require_once 'Conect.php'; 
require_once 'Usuario.php'; 


        $usuario = new usuario();
        $usuario->adicionarUsuario( "gus",1548,'Funcionario' ); 
        echo "Usuario adicionado com sucesso!";
?>