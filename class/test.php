<?php
require_once 'Conect.php'; 
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
?>