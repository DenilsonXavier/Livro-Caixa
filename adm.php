<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrador</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body class="bg-secondary">

	<div class="container-fluid ">


		<div class="row bg-light-subtle rounded-bottom-5">
			<nav class="navbar navbar-expand-lg ">
				<div class="container">
				  <a class="navbar-brand" href="#">Navbar</a>
				  
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
					 <li class="nav-item">
					   <a class="nav-link active" aria-current="page" href="#">Home</a>
					 </li>
				    </ul>
				  </div>
				</div>
			   </nav>
		</div>
		<div class="row text-center ">
			<div class="col-3 bg-info rounded-5">
				<div class="row">
					<div class="col-12">
						<div class="my-3"><span class="tw-bold h4 ">Adicionar funcionario</span> </div>
						<form action="">
							<div class="mb-3">
								<div class="input-group">
									<span class="input-group-text">Nome</span>
									<input type="text" name="Nome_f" id="" class="form-control">
								</div>
							</div>
							<div class="mb-3">
								<div class="input-group">
									<span class="input-group-text">Senha</span>
									<input type="password" name="Senha_f" id="" class="form-control">
								</div>
							</div>
							<div class="mb-3">
								<div class="input-group">
									<span class="input-group-text">Nivel</span>
									<select name="nivel_f" id="nivel_f" class="form-select " required>
										<option selected value="1">Funcionario</option>
										<option value="2">Administrador</option>
								   </select>
								</div>
							</div>
							<div class="mb-3">
								<button type="submit" class="btn btn-light">Registrar</button>
							</div>
						</form>

					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="my-3 tw-bold h4"><span>Excluir funcionario</span></div>
						<form action="">
							<div class="mb-3">
									<select name="deletar_f" id="" class="form-select" >
										<option selected>Escolha um usuario</option>
										<option value="1" required>admin</option>
										<option value="2">Root</option>
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
							<div class="mb-3"><button type="submit" class="btn btn-light">Excluir</button></div>

						</form>
					</div>
				</div>
			</div>
			<div class="col-3 bg-success rounded-5">

				<div class="row">
					<div class="col-12">
						<div class="my-3"><span class="tw-bold h4 ">Alterar funcionario</span> </div>
						<form action="">
							<div class="input-group mb-3">
								<span class="input-group-text">Novo Nome</span>
								<input type="text" name="a_nome" id="" class="form-control">
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">usuario</span>
								<select name="a_usuario" id="" class="form-select">
									<option selected>Selecione</option>
									<option value="1">Admin</option>
									<option value="2">root</option>
								</select>
							</div>
							<div class="text-center"><button type="submit" class="btn btn-light">Alterar Nome</button></div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="my-3"><span class="tw-bold h4 ">Alterar Senha</span> </div>
						<form action="">
							<div class="input-group mb-3">
								<span class="input-group-text">Nova Senha</span>
								<input type="password" name="a_senha" id="" class="form-control">
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">usuario</span>
								<select name="a_usuario" id="" class="form-select">
									<option selected>Selecione</option>
									<option value="1">Admin</option>
									<option value="2">root</option>
								</select>
							</div>
							<div class="text-center"><button type="submit" class="btn btn-light">Alterar Senha</button></div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mb-3">
						<div class="my-3"><span class="tw-bold h4 ">Alterar Nivel</span> </div>
						<form action="">
							<div class="input-group mb-3">
								<span class="input-group-text">Novo Nivel</span>
								<select name="a_nivel" id="" class="form-select">
									<option value="1" selected>Funcionario</option>
									<option value="2">Administrador</option>
								</select>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">usuario</span>
								<select name="a_usuario" id="" class="form-select">
									<option selected>Selecione</option>
									<option value="1">Admin</option>
									<option value="2">root</option>
								</select>
							</div>
							<div class="text-center"><button type="submit" class="btn btn-light">Alterar Nivel</button></div>
						</form>
					</div>
				</div>

			</div>
			<div class="col-3 bg-warning rounded-5">
				<div class="row">
					<div class="col-12">
						<div class="my-3"><span class="tw-bold h4 ">Adicionar Produto</span> </div>
						<form action="">
							<div class="mb-3">
								<div class="input-group">
									<span class="input-group-text">Descrição</span>
									<input type="text" name="descricao_p" id="" class="form-control">
								</div>
							</div>
							<div class="mb-3">
								<div class="input-group">
									<span class="input-group-text">Tipo</span>
									<input type="text" name="tipo_p" id="" class="form-control">
								</div>
							</div>
							<div class="mb-3">
								<div class="input-group">
									<span class="input-group-text">Valor do produto</span>
									<input type="text" name="valor_p" id="" class="form-control">
								</div>
							</div>
							<div class="mb-3">
								<button type="submit" class="btn btn-light">Registrar</button>
							</div>
						</form>

					</div>			
				</div>
				<div class="row">
					<div class="col-12">
						<div class="my-3 tw-bold h4"><span>Excluir produto</span></div>
						<form action="">
							<div class="mb-3">
									<select name="deletar_p" id="" class="form-select" >
										<option selected>Escolha um produto</option>
										<option value="1" required>abacaxi</option>
										<option value="2">banana</option>
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
							<div class="mb-3"><button type="submit" class="btn btn-light">Excluir</button></div>

						</form>
					</div>
				</div>

			</div>
			<div class="col-3 bg-primary rounded-5">
				<div class="row">
					<div class="col-12">
						<div class="my-3"><span class="tw-bold h4 ">Alterar Produto</span> </div>
						<form action="">
							<div class="input-group mb-3">
								<span class="input-group-text">Nova Descrição</span>
								<input type="text" name="a_descricao" id="" class="form-control">
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Produto</span>
								<select name="a_produto" id="" class="form-select">
									<option selected>Selecione</option>
									<option value="1">abacaxi</option>
									<option value="2">banana</option>
								</select>
							</div>
							<div class="text-center"><button type="submit" class="btn btn-light">Alterar Descrição</button></div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="my-3"><span class="tw-bold h4 ">Alterar Tipo</span> </div>
						<form action="">
							<div class="input-group mb-3">
								<span class="input-group-text">Nova Tipo</span>
								<Select class="form-select">
									<option value="1">Entrada</option>
									<option value="2">Saida</option>
								</Select>
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">usuario</span>
								<select name="a_produto" id="" class="form-select">
									<option selected>Selecione</option>
									<option value="1">Abacaxi</option>
									<option value="2">banana</option>
								</select>
							</div>
							<div class="text-center"><button type="submit" class="btn btn-light">Alterar Tipo</button></div>
						</form>
					</div>
				</div>
				<div class="row">
					<div class="col-12 mb-3">
						<div class="my-3"><span class="tw-bold h4 ">Alterar Valor</span> </div>
						<form action="">
							<div class="input-group mb-3">
								<span class="input-group-text">Novo Valor</span>
								<input type="text" name="a_valor" id="" class="form-control">
							</div>
							<div class="input-group mb-3">
								<span class="input-group-text">Produto</span>
								<select name="a_produto" id="" class="form-select">
									<option selected>Selecione</option>
									<option value="1">Banana</option>
									<option value="2">abacaxi</option>
								</select>
							</div>
							<div class="text-center"><button type="submit" class="btn btn-light">Alterar Valor</button></div>
						</form>
					</div>
				</div>

			 </div>
			</div>
		</div>
		

</body>
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>
</html>