<?php
class Conexao{

    protected $conexao;
    private $host; 
    private $usuario; 
    private $senha; 
    private $banco;
    private $tablelancamentos;
    private $tableusuario;
    private $tableprodutos;

    // Get the elements from /config/conection.php
    public function __construct() {
        $this->setvars();
    }

    public function setvars(){
        $configcon = file_get_contents($_SERVER['DOCUMENT_ROOT']."/Livro-Caixa/config/conection.json");
        $configcon = json_decode($configcon, true);
        $this->host = $configcon["host"];
        $this->usuario  = $configcon["usuario"];
        $this->senha = $configcon["senha"];
        $this->banco = $configcon["banco"];
        $this->tablelancamentos = $configcon["tabelalancamentos"];
        $this->tableusuario = $configcon["tabelausuario"];
        $this->tableprodutos = $configcon["tabelaproduto"];
        
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
    
    function gettablenameLancamentos() {
        return $this->tablelancamentos;
    }
    function gettablenameUsuario() {
        return $this->tableusuario;
    }
    function gettablenameProduto() {
        return $this->tableprodutos;
    }

    public function fecharConexao() {
        $this->conexao->close();
    }
}
?>