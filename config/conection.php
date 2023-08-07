<?php
// elements of DB
class connetion_att{
    // connecion settings
    private $host = "localhost"; 
    private $usuario = "root"; 
    private $senha = ""; 
    private $banco = "livro-Caixa"; 

    function gethost() {
     return $this->host;
    }
    function getusuario() {
     return $this->usuario;
    }
    function getsenha() {
     return $this->senha;
    }
    function getbanco() {
     return $this->banco;
    }
        
    // Name of DB tables
    private $tablenameLancamentos = 'lancamento';
    private $tablenameUsuario = 'Usuario';
    private $tablenameProduto = 'produto';

    function gettablenameLancamentos() {
        return $this->tablenameLancamentos;
    }
    function gettablenameUsuario() {
        return $this->tablenameUsuario;
    }
    function gettablenameProduto() {
        return $this->tablenameProduto;
    }
    
}


?>