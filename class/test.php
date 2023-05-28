<?php
require_once 'class/Conect.php'; 
class TesteAdicionarProduto {
    public function adicionarProduto() {
        $produto = new Produto();
        $produto->adicionarProduto("Produto de Teste", 9,99); 
        echo "Produto adicionado com sucesso!";
    }
}
$teste = new TesteAdicionarProduto(); 
$teste->adicionarProduto(); 
?>