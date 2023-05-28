<?php
class Conexao {
    private $host = "localhost"; 
    private $usuario = "root"; 
    private $senha = ""; 
    private $banco = "livro-Caixa"; 

    protected $conexao;

 
    public function conectar() {
        $this->conexao = new mysqli($this->host, $this->usuario, $this->senha, $this->banco);

        
        if ($this->conexao->connect_errno) {
            die("Falha na conexão com o banco de dados: " . $this->conexao->connect_error);
        }
    }

    public function fecharConexao() {
        $this->conexao->close();
    }
}
?>