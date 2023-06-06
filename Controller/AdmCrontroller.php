<?php
require_once '../class/Usuario.php';
require_once '../class/Produto.php';

class adm extends Usuario {
    public function alteraUsuarioNick($nick, $id) {
        $this->conectar();
        $AlteraNick = $this->conexao->prepare("UPDATE usuario SET nick = ? WHERE id_usuario = ?");
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
        $senhaHash = md5($senha);
        $AlteraSenha = $this->conexao->prepare("UPDATE usuario SET senha = ? WHERE id_usuario = ?");
        $AlteraSenha->bind_param("si", $senhaHash, $id);
        $AlteraSenha->execute();

        if ($AlteraSenha->errno) {
            die("Erro ao alterar a senha do usuário: " . $AlteraSenha->error);
        }

        $AlteraSenha->close();
        $this->fecharConexao();
    }

    public function alteraUsuarioNivel($nivel, $id) {
        $this->conectar();
        $AlteraNivel = $this->conexao->prepare("UPDATE usuario SET Nivel = ? WHERE id_usuario = ?");
        $AlteraNivel->bind_param("si", $nivel, $id);
        $AlteraNivel->execute();

        if ($AlteraNivel->errno) {
            die("Erro ao alterar o nível do usuário: " . $AlteraNivel->error);
        }

        $AlteraNivel->close();
        $this->fecharConexao();
    }
}

class prod extends Produto {
    public function alterarDescricaoProduto($id_produto, $descricao) {
        $this->conectar();

        $consulta = $this->conexao->prepare("UPDATE produto SET descricao = ? WHERE produto.id_produto = ?");
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
        $consulta = $this->conexao->prepare("UPDATE `produto` SET `tipo` = ? WHERE `produto`.`id_produto` = ?");
        $consulta->bind_param("si", $tipo, $id_produto);
        $consulta->execute();

        if ($consulta->errno) {
            echo $consulta->error;
            die("Erro ao alterar o tipo do produto: " . $consulta->error);
        }

        $consulta->close();
        $this->fecharConexao();
    }
}

switch ($_POST['tipo_acao']) {
    case 'f_adicionar':
        $nick = $_POST['nick_f'];
        $senha = $_POST['senha_f'];
        $nivel = $_POST['nivel_f'];

        $adm = new adm();
        $adm->adicionarUsuario($nick, $senha, $nivel);
        header('Location: ../adm.php');
        break;

    case 'f_excluir':
        $id = $_POST['deletar_f'];

        $adm = new adm();
        $adm->deletarUsuario($id);
        header('Location: ../adm.php');
        break;

    case 'f_alterarnome':
        $nick = $_POST['a_nick'];
        $id = $_POST['a_usuario'];

        $adm = new adm();
        $adm->alteraUsuarioNick($nick, $id);
        header('Location: ../adm.php');
        break;

    case 'f_alterarsenha':
        $senha = $_POST['a_senha'];
        $id = $_POST['a_usuario'];

        $adm = new adm();
        $adm->alteraUsuarioSenha($senha, $id);
        header('Location: ../adm.php');
        break;

    case 'f_alterarnivel':
        $nivel = $_POST['a_nivel'];
        $id = $_POST['a_usuario'];

        $adm = new adm();
        $adm->alteraUsuarioNivel($nivel, $id);
        header('Location: ../adm.php');
        break;

    case 'p_adicionar':
        $descricao = $_POST['descricao_p'];
        $tipo = $_POST['tipo_p'];

        $prod = new prod();
        $prod->adicionarProduto($descricao, $tipo);
        header('Location: ../adm.php');
        break;

    case 'p_excluir':
        $id = $_POST['deletar_p'];
        $prod = new Produto;
        $prod->deletarProduto($id);
        header('Location: ../adm.php');

        break;

    case 'p_alterardescricaor':
        $descricao = $_POST['a_descricao'];
        $id = $_POST['a_produto'];
        $prod = new prod();
        $prod->alterarDescricaoProduto($id, $descricao);
        header('Location: ../adm.php');
        break;

    case 'p_alterarTipo':
        $tipo = $_POST['a_tipo'];
        $id = $_POST['a_produto'];

        $prod = new prod();
        $prod->alterarTipoProduto($id, $tipo);
        header('Location: ../adm.php');
        break;

    default:
        header('Location: ../adm.php');
        break;
}
?>
