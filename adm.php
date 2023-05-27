<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrador</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body>

	<div class="container-fluid">


		<div class="row bg-secondary ">
			<div class="col-1 text-start ">
				<div class="text-start d-inline-block"><a href="" class="btn btn-light">Voltar</a></div>
			</div>
			<div class="col-10 text-center">
				<div class="text-cente d-inline-block display-4 tw-bold">Administrador</div>
			</div>
		</div>
		<div class="row text-center">
			<div class="col-3 bg-info">
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
			<div class="col-3 bg-success">
				Alterar funcionario
			</div>
			<div class="col-3 bg-warning">
				Produdo				
			</div>
			<div class="col-3 bg-primary">
				backup
			</div>
		</div>
		
	</div>

</body>
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>
</html>