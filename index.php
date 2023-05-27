<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

	<div class="container-fluid ">
		<div  class="row h-100 pb-5">

			<!-- Area das entradas e calculadora -->
			<div class="col-5 ">
				<div class="row bg-info p-2">
						<div class="col-12 h4">
								<div class="display-4 text-center fw-bold">
									<span>Entrada</span>
								</div>
								<form>
									<div class="mb-3">
										<div class="input-group ">
											<span class="input-group-text">Descrição</span>
											<input type="text" class="form-control" name="descricao" id="descricao_l" required>
										</div>
									</div>
									<div class="mb-3">

										<div class="input-group ">
											<span class="input-group-text">Forma de pagamento</span>
											<select name="forma_p" id="forma_p" class="form-select " required>
												  <option selected>Escolha a forma de Pagamento</option>
												  <option value="1">Dinheiro</option>
												  <option value="2">Cartão</option>
												  <option value="3">Pix</option>
											</select>
										</div>
									</div>
									<div class="mb-3 ">
										<div class="input-group">
											<span class="input-group-text">Valor do Lançamento</span>
											<span class="input-group-text">R$</span>
											<input type="number" name="valor_l" id="valor_l" class="form-control" required>
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">										<span class="input-group-text">Quantidade</span>
											<input type="number" name="qtn_l" id="qtn_l" class="form-control"  required>
										</div>
									</div>
									<div class="mb-3">
										 <button type="submit" class="btn btn-primary justify-content-start">Lançar</button>
										 <a href="#" class="btn btn-danger justify-content-end">Ver todos os valores</a>
									</div>
									<div class="mb-3 input-group ">
										<span class="input-group-text ">Valor total Do dia</span>
										<input type="text" placeholder="00.00" class="form-control " disabled>
									</div>

								</form>
						</div>
				</div>
				<div class="row bg-secondary ">
						<div class="col-12 h6">
							<div class="display-4 fw-bold text-center">
							<span >Saida</span>
							</div>

							<form>
									
									<div class="mb-3">
										<div class="input-group input-group-sm">
											<span class="input-group-text">Descrição</span>
											<input type="text" class="form-control form-control-sm" name="descricao" id="descricao_l" required>
										</div>
									</div>

									
									<div class="mb-3 ">
										<div class="input-group input-group-sm">
											<span class="input-group-text">Valor do Lançamento</span>
											<span class="input-group-text">R$</span>
											<input type="number" name="valor_l" id="valor_l" class="form-control" required>
										</div>
									</div>

									<div class="mb-3">
										 <button type="submit" class="btn btn-primary justify-content-start">Lançar</button>
									</div>

							</form>

						</div>
				</div>
			</div>

			<!-- Area da Tabela -->
			<div class="col-7 bg-danger text-center">
				<table class="table table-sm align-middle">
					<thead>
						<tr>
							<th colspan="3"></th>
							<th colspan="3">Entradas</th>
							<th colspan="3">Saidas</th>
						</tr>
					</thead>
					<tr>
						<th>Data</th>
						<th>Descrição</th>
						<th>Codigo</th>
						<th>Valor Unitário</th>
						<th>Quantidade</th>
						<th>Valor Total</th>
						<th>Valor Unitário</th>
						<th>Quantidade</th>
						<th>Valor Total</th>
					</tr>
					
				</table>
			</div>

		</div>

		<!-- Area da seção Admin e logout -->
		<div class="row bg-primary position-fixed fixed-bottom p-1" >
			<div class="col-12 text-end" > 
				<a href="#" class="btn btn-light">Sair</a>
				<a href="#" class="btn btn-light">Administrar</a>
			</div>
		</div>
		
	</div>

</body>
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>
</html>