<?php 
include_once 'class/Produto.php';
include_once 'class/Usuario.php';

// Verify if the user is singned
session_start();
if (empty($_SESSION['nick']) || empty($_SESSION['nivel']) || empty($_SESSION['id_usuario']) ) {
     session_unset();
     session_abort();
     header('Location: ./login.php');
}
// Verify if the user is an Admin
if ($_SESSION['nivel'] <> 'administrador') {
     header("Location: index.php");
}

// Token of validation
$_SESSION['validacao_hash'] = md5(rand());

// Get the products and user from the DB
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
    <link rel="stylesheet" type="text/css" href="css\bootstrap-icons-1.10.5\font\bootstrap-icons.min.css">
    <link rel="shortcut icon" href="css/bootstrap-icons-1.10.5/gear-fill.svg" type="image/x-icon">
     <style>
          .custom-tooltip {
          --bs-tooltip-bg: var(--bs-yellow);
          --bs-tooltip-color: var(--bs-dark);
          --bs-tooltip-opacity: 1;
          }
     </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center mt-5" >
          <div class="row p-3 shadow rounded border bg" style=" width: 100vh; ">
          
               <div class="col-4 p-3">
                         <ul class="list-group list-group-flush mt-3">
                              <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_control" role="button" aria-expanded="false" aria-controls="Funcionario_control" ><p class="h2">Funcionario</p></a></div></li>
                                  
                                   <div class="collapse multi-collapse show" id="Funcionario_control">
                                        <li class="list-group-item ">
                                             <ul class="list-group list-group-flush ">
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_a" role="button" aria-expanded="false" aria-controls="Funcionario_a">Adicionar</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_e" role="button" aria-expanded="false" aria-controls="Funcionario_e">Excluir</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_af" role="button" aria-expanded="false" aria-controls="Funcionario_af">Alterar Funcionarios</a></div></li>
                                             </ul>
                                        </li>
                                   </div>
                         </ul>
                         <ul class="list-group list-group-flush mt-1">     
                              <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_control" role="button" aria-expanded="false" aria-controls="produto_control" ><p class="h2">Produto</p></a></div></li>
                                   <div class="collapse multi-collapse show" id="produto_control">
                                        <li class="list-group-item ">
                                             <ul class="list-group list-group-flush ">
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_a" role="button" aria-expanded="false" aria-controls="produto_a">Adicionar</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_e" role="button" aria-expanded="false" aria-controls="produto_e">Excluir</a></div></li>
                                                  <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_ap" role="button" aria-expanded="false" aria-controls="produto_ap">Alterar Produto</a></div></li>
                                             </ul>
                                        </li>
                                   </div>
                         </ul>
               </div>
             
               <div class="col-8 p-3 text-center">

                    <div class="collapse multi-collapse" id="Funcionario_a">
                         <div class="my-2"><span class="tw-bold h4 ">Adicionar funcionario</span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="mb-2">
                                   <div class="input-group">
                                        <span class="input-group-text">Nome</span>
                                        <input type="text" name="nick_f" id="" class="form-control">
                                   </div>
                              </div>
                              <div class="mb-2">
                                   <div class="input-group">
                                        <span class="input-group-text">Senha</span>
                                        <input type="password" name="senha_f" id="" class="form-control">
                                   </div>
                              </div>
                              <div class="mb-2">
                                   <div class="input-group">
                                        <span class="input-group-text">Nivel</span>
                                        <select name="nivel_f" id="nivel_f" class="form-select " required>
                                             <option selected value="funcionario">Funcionario</option>
                                             <option value="administrador">Administrador</option>
                                      </select>
                                   </div>
                              </div>
                              <div class="mb-2 d-grid">
							<input type="hidden" name="tipo_acao" value="f_adicionar">
                                   <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
                                   <button type="submit" class="btn btn-outline-success">Registrar</button>
                              </div>
                         </form>
                    </div>

                    <div class="collapse multi-collapse" id="Funcionario_e">
                         <div class="my-2"><span class="tw-bold h4 justify-content-center d-flex">Excluir Funcionario <b class="h6"><i data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" title="Ao excluir um Usuario, todos os lançamentos feitos por ele seram passados para sua conta." class="bi bi-info-circle"></i></b>
                         </span> </div>
                         <?php 
                              // verify error in the delete user
                              if(isset($_SESSION['error_mu'])){
                                   echo '
                                   <div class="my-3 tw-bold h3 text-danger">O Usuário não pode ser excluido em sua sessão.</div>
                                   ';
                                   unset($_SESSION['error_mu']);
                              }
                         ?>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="mb-2">
                                        <select name="deletar_f" id="" class="form-select" >
                                             <option selected>Escolha um usuario</option>
                                             <?php 
                                                  // echo the users in the select form
                                                  for ($i=0; isset($todosu[$i]); $i++) { 
                                                       echo "<option value='{$todosu[$i]['id_usuario']}'>{$todosu[$i]['nick']}  -  {$todosu[$i]['Nivel']}</option>";
                                                  }
                                             ?>
                                        </select>
                              </div>
                              <div class="mb-2 text-start ">
                                        <div class="form-check">
                                             <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                             <label class="form-check-label tw-bold" for="flexCheckDefault">
                                              Tem certeza?
                                             </label>
                                        </div>
                              </div>
							<input type="hidden" name="tipo_acao" value="f_excluir">
                                   <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
							<div class="mb-2 d-grid"><button type="submit" class="btn btn-outline-danger">Excluir</button></div>
                         </form>
                    </div>
                    <div class="collapse multi-collapse" id="Funcionario_af">
                         <div class="my-3"><span class="tw-bold h4 justify-content-center d-flex">Alterar Funcionario <b class="h6"><i data-bs-toggle="tooltip"  data-bs-custom-class="custom-tooltip" title="Se não quiser alterar a informação, deixe em branco." class="bi bi-info-circle"></i></b>  
                         </span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="input-group mb-2">
                                   <span class="input-group-text">Usuario</span>
                                   <select name="a_usuario" id="" class="form-select">
                                        <option selected>Selecione</option>
                                             <?php 
                                                  // echo the users in the select form
                                                  for ($i=0; isset($todosu[$i]); $i++) { 
                                                       echo "<option value='{$todosu[$i]['id_usuario']}'>{$todosu[$i]['nick']}  -  {$todosu[$i]['Nivel']}</option>";
                                                  }
                                             ?>
                                   </select>
                              </div>
                              <div class="input-group mb-2">
                                   <span class="input-group-text">Novo Nome</span>
                                   <input type="text" name="a_nick" id="" placeholder="Nome" class="form-control">
                              </div>
                              <div class="input-group mb-2">
                                   <span class="input-group-text">Nova Senha</span>
                                   <input type="password" name="a_senha" placeholder="Senha" id="" class="form-control">
                              </div>
                              <div class="input-group mb-2">
                                   <span class="input-group-text">Novo Nivel</span>
                                   <select name="a_nivel" id="" class="form-select">
									<option value="" selected>Escolha uma Opção</option>
                                             <option value="funcionario" >Funcionario</option>
                                        <option value="administrador">Administrador</option>
                                   </select>
                              </div>
							<input type="hidden" name="tipo_acao" value="f_alterarfuncionario">
                                   <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
							<div class="text-center d-grid"><button type="submit" class="btn btn-outline-warning">Salvar Alterações</button></div>
                         </form>
                    </div>


                    <div class="collapse multi-collapse" id="produto_a">
                         <div class="my-3"><span class="tw-bold h4 ">Adicionar Produto</span> </div>
                         <form action="./Controller/AdmCrontroller.php" method="post">
                              <div class="mb-2">
                                   <div class="input-group">
                                        <span class="input-group-text">Descrição</span>
                                        <input type="text" name="descricao_p" id="" class="form-control">
                                   </div>
                              </div>
                              <div class="mb-2">
                                   <div class="input-group">
                                        <span class="input-group-text">Tipo</span>
                                        <Select name="tipo_p" id="" class="form-select" >
                                            <option value="entrada">Entrada</option>
                                            <option value="saida">Saida</option>
                                       </Select>
                                   </div>
                              </div>
                              <div class="mb-2 d-grid">
							<input type="hidden" name="tipo_acao" value="p_adicionar">
                                   <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
                                   <button type="submit" class="btn btn-outline-success">Registrar</button>
                              </div>
                         </form>
                    </div>

                    <div class="collapse multi-collapse" id="produto_e">
						<div class="my-3">
                                   <span class="tw-bold h4 justify-content-center d-flex">Excluir Produto  
                                   <b class="h6"><i data-bs-toggle="tooltip"  data-bs-custom-class="custom-tooltip" title="Excluir um Produto substituira ele automaticamente nos lançamentos pelo Produto/Serviço Padrão." class="bi bi-info-circle"></i></b> 
                              </span></div>
                                   <?php 
                                        // verify error in the delete product
                                        if(isset($_SESSION['Error_mp'])){
                                             echo '
                                             <div class="my-3 tw-bold h4 text-danger">O Produto não pode ser excluido, é um produto padrão.</div>
                                             ';
                                             unset($_SESSION['Error_mp']);
                                        }
                                   ?>
						<form action="./Controller/AdmCrontroller.php" method="post">
							<div class="mb-2">
									<select name="deletar_p" id="" class="form-select" >
										<option selected>Escolha um produto</option>
                                             <?php 
                                                  // echo the produtcs in the select form
                                                  for ($i=0; isset($todosp[$i]); $i++) { 
                                                       if($todosp[$i]['id_produto'] > 2) {
                                                             echo "<option value='{$todosp[$i]['id_produto']}'>{$todosp[$i]['descricao']}   -   {$todosp[$i]['tipo']}</option>";
                                                       }
                                                  }
                                             ?>
									</select>
							</div>
							<div class="mb-2 text-start ">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
										<label class="form-check-label tw-bold" for="flexCheckDefault">
										Tem certeza?
										</label>
									</div>
							</div>
							<input type="hidden" name="tipo_acao" value="p_excluir">
                                   <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
							<div class="mb-2 d-grid"><button type="submit" class="btn btn-outline-danger">Excluir</button></div>
						</form>        
                         </div>

                    <div class="collapse multi-collapse" id="produto_ap">
						<div class="my-3">
                                   <span class="tw-bold h4 justify-content-center d-flex">Alterar Produto   
                                   <b class="h6"><i data-bs-toggle="tooltip"  data-bs-custom-class="custom-tooltip" title="Se não quiser alterar a informação, deixe em branco." class="bi bi-info-circle"></i></b> 
                              </span> </div>
						<form action="./Controller/AdmCrontroller.php" method="post">
							<div class="input-group mb-2">
								<span class="input-group-text">Produto</span>
								<select name="a_produto" id="" class="form-select">
									<option selected>Selecione o Produto</option>
                                             <?php 
                                                  // echo the produtcs in the select form
                                                  for ($i=0; isset($todosp[$i]); $i++) { 
                                                       echo "<option value='{$todosp[$i]['id_produto']}'>{$todosp[$i]['descricao']}   -   {$todosp[$i]['tipo']}</option>";
                                                  }
                                             ?>
								</select>
							</div>
							<div class="input-group mb-2">
								<span class="input-group-text">Nova Descrição</span>
								<input type="text" name="a_descricao" id="" class="form-control">
							</div>
							<div class="input-group mb-2">
								<span class="input-group-text d-inline">
                                             Nova Tipo
                                             <b class="h6"><i data-bs-toggle="tooltip"  data-bs-custom-class="custom-tooltip" title="Alterar o tipo do Produto afeta diretamente os lançamentos, cuidado." class="bi bi-info-circle"></i></b> 
                                             </span>
								 <Select name="a_tipo" id="" class="form-select" >
									<option value="">Escolha uma Opção</option>
									<option value="entrada">Entrada</option>
									<option value="saida">Saida</option>
								</Select>
							</div>
							<input type="hidden" name="tipo_acao" value="p_alterarproduto">
                                   <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
							<div class="text-center mb-2 d-grid"><button type="submit" class="btn btn-outline-warning">Alterar Descrição</button></div>
						</form>
                    </div>

                    <div class="collapse multi-collapse" id="backup_c">
					<div class="my-3"><span class="tw-bold h4 ">Criar Backup</span></div>
                         <form action="./contabilidade.php" method="post">
                              <input type="hidden" name="tipo_acao" value="b_criar">
                              <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
                              <div class="text-center mb-3 d-grid"><button type="submit" class="btn btn-outline-primary">Criar</button></div>
                         </form>     
                    </div>
                    <div class="collapse multi-collapse" id="backup_r">
						<div class="my-3"><span class="tw-bold h4 ">Recuperar Backup</span> </div>
                              <form action="./contabilidade.php" method="post">
                                   <select name="b_qual" id="" class="form-select mb-1">
                                        <option>backup - 12/05/23</option>
                                        <option>backup - 12/04/23</option>
                                        <option>backup - 12/03/23</option>
                                        <option>backup - 12/02/23</option>
                                   </select>
                                   <div class="form-check text-start mb-1">
                                        <input type="checkbox" name="" id="flexCheckDefault" class="form-check-input" required>
                                        <label for="flexCheckDefault" class="form-check-label">Tem certeza?</label>
                                   </div>
                                   <input type="hidden" name="tipo_acao" value="b_recuperar">
                                   <input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
                                   <div class="text-center mb-3 d-grid"><button type="submit" class="btn btn-outline-warning">Criar</button></div>
                              </form>  
                    </div>
               </div>
          </div>
			
		<!-- Area da seção Admin e logout -->
		<div class="position-fixed bottom-0 end-0">
               <div class="d-flex d-inline justify-content-end align-bottom mb-4 " style="height: 5vh;">
                    <div class="collapse multi-collapse" id="menu_control">
                         <div class="d-inline d-flex">
                              <div><a href="index.php" class="btn btn "><p class="h2"><i class="bi bi-house"></i></p></a></div>
                              <?php if ($_SESSION['nivel'] == 'administrador') {echo ' <div> <a href="adm.php" class="btn btn "><p class="h2"><i class="bi bi-gear"></i></p></a> </div> ';} ?>
                              <?php if ($_SESSION['nivel'] == 'administrador') {echo ' <div> <a href="relatorio.php" class="btn btn "><p class="h2"><i class="bi bi-pie-chart"></i></p></a> </div> ';} ?>
                              <div><a href="contabilidade.php" class="btn btn "><p class="h2"><i class="bi bi-journals"></i></p></a></div>
                              <div><a href="login.php" class="btn btn "><p class="h2 text-danger"><i class="bi bi-door-open"></i></p></a></div>
                         </div>
                    </div>
                    <div><a class="btn " data-bs-toggle="collapse" href="#menu_control" role="button" aria-expanded="false" aria-controls="menu_control" ><p class="h2"><i class='bi bi-list '></i></p></a></div>
               </div>
          </div>
           
    </div>
    
    <script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>
    <script>
     // Necessery for the tooltips works, DO NOT DELETE
     const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
     const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
     </script>

</body>
</html>
