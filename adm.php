<?php 
include_once 'class/Produto.php';
include_once 'class/Usuario.php';

session_start();
if (empty($_SESSION['nick']) || empty($_SESSION['nivel']) || empty($_SESSION['id_usuario']) ) {
     session_unset();
     session_abort();
     header('Location: ./login.php');
}
$p = new Produto;
$todosp = $p->BuscarTodosProdutos();
$u = new Usuario;
$todosu = $u->BuscarTodosProdutos();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Administrador</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=25">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>
    <div class=" container d-flex justify-content-center align-items-center" style="height: 100vh;" >
          <div class="row p-3 shadow rounded border" style=" width: 100vh;">
          
               <div class="col-4 p-3">
           
                         <ul class="list-group list-group-flush mt-3">
                              <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_control" role="button" aria-expanded="false" aria-controls="Funcionario_control" ><p class="h2">Funcionario</p></a></div></li>
                                  
                                   <div class="collapse multi-collapse" id="Funcionario_control">
                                        <li class="list-group-item ">
                                             <ul class="list-group list-group-flush ">
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_a" role="button" aria-expanded="false" aria-controls="Funcionario_a">Adicionar</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_e" role="button" aria-expanded="false" aria-controls="Funcionario_e">Excluir</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_an" role="button" aria-expanded="false" aria-controls="Funcionario_an">Alterar Nome</a></div></li>
                                                  <li class="list-group-item"><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_as" role="button" aria-expanded="false" aria-controls="Funcionario_as">Alterar Senha</a></div></li>
                                                  <li class="list-group-item"><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_ani" role="button" aria-expanded="false" aria-controls="Funcionario_ani">Alterar Nivel</a></div></li>
                                             </ul>
                                        </li>
                                   </div>
                         </ul>
                         <ul class="list-group list-group-flush mt-1">     
                              <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_control" role="button" aria-expanded="false" aria-controls="produto_control" ><p class="h2">Produto</p></a></div></li>
                                   <div class="collapse multi-collapse" id="produto_control">
                                        <li class="list-group-item ">
                                             <ul class="list-group list-group-flush ">
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_a" role="button" aria-expanded="false" aria-controls="produto_a">Adicionar</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_e" role="button" aria-expanded="false" aria-controls="produto_e">Excluir</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_ad" role="button" aria-expanded="false" aria-controls="produto_ad">Alterar Descrição</a></div></li>
                                                  <li class="list-group-item"><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_at" role="button" aria-expanded="false" aria-controls="produto_at">Alterar Tipo</a></div></li>
                                             </ul>
                                        </li>
                                   </div>
                         </ul>
               </div>
             
               <div class="col-8 p-3 text-center">

                    <div class="collapse multi-collapse" id="Funcionario_a">
                         <div class="my-3"><span class="tw-bold h4 ">Adicionar funcionario</span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="mb-3">
                                   <div class="input-group">
                                        <span class="input-group-text">Nome</span>
                                        <input type="text" name="nick_f" id="" class="form-control">
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <div class="input-group">
                                        <span class="input-group-text">Senha</span>
                                        <input type="password" name="senha_f" id="" class="form-control">
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <div class="input-group">
                                        <span class="input-group-text">Nivel</span>
                                        <select name="nivel_f" id="nivel_f" class="form-select " required>
                                             <option selected value="funcionario">Funcionario</option>
                                             <option value="administrador">Administrador</option>
                                      </select>
                                   </div>
                              </div>
                              <div class="mb-3 d-grid">
							<input type="hidden" name="tipo_acao" value="f_adicionar">
                                   <button type="submit" class="btn btn-outline-success">Registrar</button>
                              </div>
                         </form>
                    </div>

                    <div class="collapse multi-collapse" id="Funcionario_e">
                         <div class="my-3 tw-bold h4"><span>Excluir funcionario</span></div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="mb-3">
                                        <select name="deletar_f" id="" class="form-select" >
                                             <option selected>Escolha um usuario</option>
                                             <?php 
                                                  for ($i=0; isset($todosu[$i]); $i++) { 
                                                       echo '<option value="'.$todosu[$i]['id_usuario'].'">'.$todosu[$i]['nick'].'</option>';
                                                  }
                                             ?>
                                        </select>
                              </div>
                              <div class="mb-3 text-start ">
                                        <div class="form-check">
                                             <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                             <label class="form-check-label tw-bold" for="flexCheckDefault">
                                              Tem certeza?
                                             </label>
                                        </div>
                              </div>
							<input type="hidden" name="tipo_acao" value="f_excluir">
							<div class="mb-3 d-grid"><button type="submit" class="btn btn-outline-danger">Excluir</button></div>
                         </form>
                    </div>
                    
                    <div class="collapse multi-collapse" id="Funcionario_an">
                         <div class="my-3"><span class="tw-bold h4 ">Alterar Nome</span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text">Novo Nome</span>
                                   <input type="text" name="a_nick" id="" class="form-control">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text">usuario</span>
                                   <select name="a_usuario" id="" class="form-select">
                                        <option selected>Selecione</option>
                                             <?php 
                                                  for ($i=0; isset($todosu[$i]); $i++) { 
                                                       echo '<option value="'.$todosu[$i]['id_usuario'].'">'.$todosu[$i]['nick'].'</option>';
                                                  }
                                             ?>
                                   </select>
                              </div>
							<input type="hidden" name="tipo_acao" value="f_alterarnome">
							<div class="text-center d-grid"><button type="submit" class="btn btn-outline-warning">Alterar Nome</button></div>
                         </form>
                    </div>

                    <div class="collapse multi-collapse" id="Funcionario_as">
                         <div class="my-3"><span class="tw-bold h4 ">Alterar Senha</span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text">Nova Senha</span>
                                   <input type="password" name="a_senha" id="" class="form-control">
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text">Usuario</span>
                                   <select name="a_usuario" id="" class="form-select">
                                        <option selected>Selecione</option>
                                             <?php 
                                                  for ($i=0; isset($todosu[$i]); $i++) { 
                                                       echo '<option value="'.$todosu[$i]['id_usuario'].'">'.$todosu[$i]['nick'].'</option>';
                                                  }
                                             ?>
                                   </select>
                              </div>
							<input type="hidden" name="tipo_acao" value="f_alterarsenha">
							<div class="text-cente d-grid"><button type="submit" class="btn btn-outline-warning">Alterar Senha</button></div>
                         </form>
                    </div>

                    <div class="collapse multi-collapse" id="Funcionario_ani">
                         <div class="my-3"><span class="tw-bold h4 ">Alterar Nivel</span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="input-group mb-3">
                                   <span class="input-group-text">Novo Nivel</span>
                                   <select name="a_nivel" id="" class="form-select">
                                        <option value="funcionario" selected>Funcionario</option>
                                        <option value="administrador">Administrador</option>
                                   </select>
                              </div>
                              <div class="input-group mb-3">
                                   <span class="input-group-text">Usuario</span>
                                   <select name="a_usuario" id="" class="form-select">
                                        <option selected>Selecione</option>
                                             <?php 
                                                  for ($i=0; isset($todosu[$i]); $i++) { 
                                                       echo '<option value="'.$todosu[$i]['id_usuario'].'">'.$todosu[$i]['nick'].'</option>';
                                                  }
                                             ?>
                                   </select>
                              </div>
							<input type="hidden" name="tipo_acao" value="f_alterarnivel">
							<div class="text-center d-grid"><button type="submit" class="btn btn-outline-warning">Alterar Nivel</button></div>
                         </form>
                    </div>

                    <div class="collapse multi-collapse" id="produto_a">
                         <div class="my-3"><span class="tw-bold h4 ">Adicionar Produto</span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="mb-3">
                                   <div class="input-group">
                                        <span class="input-group-text">Descrição</span>
                                        <input type="text" name="descricao_p" id="" class="form-control">
                                   </div>
                              </div>
                              <div class="mb-3">
                                   <div class="input-group">
                                        <span class="input-group-text">Tipo</span>
                                        <Select name="tipo_p" id="" class="form-select" >
                                            <option value="entrada">Entrada</option>
                                            <option value="saida">Saida</option>
                                       </Select>
                                   </div>
                              </div>
                              <div class="mb-3 d-grid">
							<input type="hidden" name="tipo_acao" value="p_adicionar">
                                   <button type="submit" class="btn btn-outline-success">Registrar</button>
                              </div>
                         </form>
                    </div>

                    <div class="collapse multi-collapse" id="produto_e">
						<div class="my-3 tw-bold h4"><span>Excluir produto</span></div>
						<form action="./Controller/AdmCrontroller.php" method="post">
							<div class="mb-3">
									<select name="deletar_p" id="" class="form-select" >
										<option selected>Escolha um produto</option>
                                             <?php 
                                                  for ($i=0; isset($todosp[$i]); $i++) { 
                                                       echo '<option value="'.$todosp[$i]['id_produto'].'">'.$todosp[$i]['descricao'].'</option>';
                                                  }
                                             ?>
									</select>
							</div>
							<div class="mb-3 text-start ">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
										<label class="form-check-label tw-bold" for="flexCheckDefault">
										Tem certeza?
										</label>
									</div>
							</div>
							<input type="hidden" name="tipo_acao" value="p_excluir">
							<div class="mb-3 d-grid"><button type="submit" class="btn btn-outline-danger">Excluir</button></div>
						</form>
                    </div>

                    <div class="collapse multi-collapse" id="produto_ad">
						<div class="my-3"><span class="tw-bold h4 ">Alterar Descrição</span> </div>
						<form action="./Controller/AdmCrontroller.php" method="post">
							<div class="input-group mb-3">
								<span class="input-group-text">Nova Descrição</span>
								<input type="text" name="a_descricao" id="" class="form-control">
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Produto</span>
								<select name="a_produto" id="" class="form-select">
									<option selected>Selecione</option>
                                             <?php 
                                                  for ($i=0; isset($todosp[$i]); $i++) { 
                                                       echo '<option value="'.$todosp[$i]['id_produto'].'">'.$todosp[$i]['descricao'].'</option>';
                                                  }
                                             ?>
								</select>
							</div>
							<input type="hidden" name="tipo_acao" value="p_alterardescricaor">
							<div class="text-center mb-3 d-grid"><button type="submit" class="btn btn-outline-warning">Alterar Descrição</button></div>
						</form>
                    </div>

                    <div class="collapse multi-collapse" id="produto_at">
						<div class="my-3"><span class="tw-bold h4 ">Alterar Tipo</span> </div>
						<form action="./Controller/AdmCrontroller.php" method="post">
							<div class="input-group mb-3">
								<span class="input-group-text">Nova Tipo</span>
								 <Select name="a_tipo" id="" class="form-select" >
									<option value="entrada">Entrada</option>
									<option value="saida">Saida</option>
								</Select>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Produto</span>
								<select name="a_produto" id="" class="form-select">
									<option selected>Selecione</option>
                                             <?php 
                                                  for ($i=0; isset($todosp[$i]); $i++) { 
                                                       echo '<option value="'.$todosp[$i]['id_produto'].'">'.$todosp[$i]['descricao'].'</option>';
                                                  }
                                             ?>
								</select>
							</div>
							<input type="hidden" name="tipo_acao" value="p_alterarTipo">
							<div class="text-center mb-3 d-grid"><button type="submit" class="btn btn-outline-warning">Alterar Tipo</button></div>
						</form>
                    </div>
               </div>
          </div>
			
		<!-- Area da seção Admin e logout -->
		<div class="row position-fixed fixed-bottom p-1" >
			<div class="col-12 text-end" > 
				<a href="index.php" class="btn btn-primary">Home</a>
				<a href="contabilidade.php" class="btn btn-success justify-content-end">Ver todos os valores</a>
				<a href="login.php" class="btn btn-danger">Sair</a>
			</div>
		</div>
           
    </div>
    
    <script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>

</body>
</html>
