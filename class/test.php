<?php
require_once 'Conect.php'; 
<<<<<<< HEAD
require_once 'Usuario.php'; 


        $usuario = new usuario();
        $usuario->adicionarUsuario( "gus",1548,'Funcionario' ); 
        echo "Usuario adicionado com sucesso!";
=======
require_once 'produto.php'; 
class TesteAdicionarProduto {
    public function adicionarProduto() {
        $produto = new Produto();
        $produto->adicionarProduto("Produto de Teste", 5 ,23 ); 
        echo "Produto adicionado com sucesso!";
    }
}
$teste = new TesteAdicionarProduto(); 
$teste->adicionarProduto(); 
>>>>>>> 0ea8757d8afd11e3bfc8696beefb868425de7a33
?>