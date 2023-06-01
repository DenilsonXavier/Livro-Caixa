<?php
require_once '../class/Usuario.php';
require_once '../class/Produto.php';
class adm  extends Usuario  {
	public function apagaUsuarioPorId($idUsuario) {
		$this->conectar();

		$apaga = $this->conexao->Altera("DELETE FROM usuario WHERE id_usuario = ?");
		$apaga->bind_param("i", $idUsuario);
		$apaga->execute();
	
		if ($apaga->errno) {
			die("Erro ao apagar usuário por ID: " . $apaga->error);
		}
	
		$apaga->close();
		$this->fecharConexao();
	}
	public function alteraUsuarioNick($nick, $id) {
		$this->conectar();
		$AlteraNick = $this->conexao->prepare("UPDATE usuario SET nick = ? WHERE id = ?");
		$AlteraNick->bind_param("si", $nick, $id);
		$AlteraNick->execute();
	
		if ($AlteraNick->errno) {
			die("Erro ao alterar o nick do usuário: " . $AlteraNick->error);
		}
	
		$AlteraNick->close();
		$this->fecharConexao();
	}
	public function alteraUsuarioSenha($senha, $id) {
		$this->conectar();
		$AlteraSenha = $this->conexao->prepare("UPDATE usuario SET senha = ? WHERE id = ?");
		$AlteraSenha->bind_param("si", $senha, $id);
		$AlteraSenha->execute();
	
		if ($AlteraSenha->errno) {
			die("Erro ao alterar a senha do usuário: " . $AlteraSenha->error);
		}
	
		$AlteraSenha->close();
		$this->fecharConexao();
	}
	public function alteraUsuarioNivel($nivel, $id) {
		$this->conectar();
		$AlteraNivel = $this->conexao->prepare("UPDATE usuario SET Nivel = ? WHERE id = ?");
		$AlteraNivel->bind_param("si", $nivel, $id);
		$AlteraNivel->execute();
	
		if ($AlteraNivel->errno) {
			die("Erro ao alterar o nível do usuário: " . $AlteraNivel->error);
		}
	
		$AlteraNivel->close();
		$this->fecharConexao();
	}
}	
class prod  extends Produto  {
	public function apagarProduto($id_produto) {
		$this->conectar();
	
		$consulta = $this->conexao->prepare("DELETE FROM produto WHERE id_produto = ?");
		$consulta->bind_param("i", $id_produto);
		$consulta->execute();
	
		if ($consulta->errno) {
			die("Erro ao apagar o produto: " . $consulta->error);
		}
	
		$consulta->close();
		$this->fecharConexao();
	}
	public function alterarDescricaoProduto($id_produto, $descricao) {
		$this->conectar();
	
		$consulta = $this->conexao->prepare("UPDATE produto SET descricao = ? WHERE id_produto = ?");
		$consulta->bind_param("si", $descricao, $id_produto);
		$consulta->execute();
	
		if ($consulta->errno) {
			die("Erro ao alterar a descrição do produto: " . $consulta->error);
		}
	
		$consulta->close();
		$this->fecharConexao();
	}
	
	public function alterarTipoProduto($id_produto, $tipo) {
		$this->conectar();
	
		$consulta = $this->conexao->prepare("UPDATE produto SET tipo = ? WHERE id_produto = ?");
		$consulta->bind_param("si", $tipo, $id_produto);
		$consulta->execute();
	
		if ($consulta->errno) {
			die("Erro ao alterar o tipo do produto: " . $consulta->error);
		}
	
		$consulta->close();
		$this->fecharConexao();
	}
	
	public function alterarValorProduto($id_produto, $valor) {
		$this->conectar();
	
		$consulta = $this->conexao->prepare("UPDATE produto SET valor = ? WHERE id_produto = ?");
		$consulta->bind_param("di", $valor, $id_produto);
		$consulta->execute();
	
		if ($consulta->errno) {
			die("Erro ao alterar o valor do produto: " . $consulta->error);
		}
	
		$consulta->close();
		$this->fecharConexao();
	}
	
	
}
	