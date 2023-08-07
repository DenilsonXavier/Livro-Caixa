<?php
require $_SERVER['DOCUMENT_ROOT']."/Livro-Caixa/config/conection.php";
class Conexao extends connetion_att{

    protected $conexao;
    private $host = ""; 
    private $usuario = ""; 
    private $senha = ""; 
    private $banco = ""; 

    // Get the elements from /config/conection.php
    public function __construct() {
        $this->setvars();
    }

    function setvars() {
        $this->host = $this->gethost();
        $this->usuario = $this->getusuario();
        $this->senha = $this->getsenha();
        $this->banco = $this->getbanco();
        
    }
 
    public function conectar() {
        $this->setvars();
        $this->conexao = new mysqli(
        $this->host, 
        $this->usuario,
         $this->senha,
          $this->banco);

        
        if ($this->conexao->connect_errno) {
            die("Falha na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
    }

    public function fecharConexao() {
        $this->conexao->close();
    }
}
?>