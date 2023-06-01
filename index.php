<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body >

	<div class="container-fluid ">
		<div  class="row h-100">

			<!-- Area das entradas e saidas-->
			<div class="col-5">
				<div class="row shadow border-2 rounded-4">
						<div class="col-12 h4 ">
								<div class="display-4 my-2 text-center fw-bold">
									<span>Entrada</span>
								</div>
								<!-- Formulario de entrada-->
								<form>
									<div class="mb-3">
										<div class="input-group ">
											<span class="input-group-text">Descrição</span>
											<select name="forma_p" id="forma_p" class="form-select " required>
												  <option selected>Escolha serviço</option>
												  <option value="1">reparo</option>
												  <option value="2">Manutenção</option>
												  <option value="3">Formatação</option>
											</select>
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
											<input type="text" name="valor_l" id="valor_l" class="form-control" required>
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">										<span class="input-group-text">Quantidade</span>
											<input type="number" name="qtn_l" id="qtn_l" class="form-control"  required>
										</div>
									</div>
									<div class="d-grid gap-2 mb-3">
										 <button type="submit" class="btn btn-outline-success  justify-content-start">Lançar</button>
									</div>
									<div class="mb-3 input-group ">
										<span class="input-group-text ">Valor total Do dia</span>
										<input type="text" placeholder="00.00" class="form-control " disabled>
									</div>

								</form>
						</div>
				</div>
				<div class="row bg-secondary-subtle shadow rounded-4">
						<div class="col-12 h6 ">
							<div class="display-4 my-3 fw-bold text-center">
							<span >Saida</span>
							</div>

							<!-- Formulario de saida -->
							<form>
									
									<div class="mb-3">
										<div class="input-group input-group-sm">
											<span class="input-group-text">Descrição</span>

											<select name="forma_p" id="forma_p" class="form-select " required>
												  <option selected>Escolha serviço</option>
												  <option value="1">reparo</option>
												  <option value="2">Manutenção</option>
												  <option value="3">Formatação</option>
											</select>
										</div>
									</div>

									
									<div class="mb-3 ">
										<div class="input-group input-group-sm">

											<span class="input-group-text">Valor do Lançamento</span>
											<span class="input-group-text">R$</span>
											<input type="number" name="valor_l" id="valor_l" class="form-control" required>
										</div>
									</div>

									<div class="d-grid gap-2 mb-3">
										 <button type="submit" class="btn btn-outline-danger justify-content-start">Lançar</button>
									</div>

							</form>


						</div>
				</div>
			</div>

			<!-- Area da Tabela -->
			<div class="col-7 text-center" >
			<div class="table-responsive">
				<table class="table w-100 p-3 my-4 table-sm table-striped table-hover align-middle">
					<thead>
					<tr>
						<th>Data</th>
						<th>Descrição</th>
						<th>Codigo</th>
						<th>Valor Unitário</th>
						<th>Tipo</th>
						<th>Quantidade</th>
						<th>Valor Total</th>

					</tr>
					</thead>
					<tbody>
						<tr>
							<th>11/09/2002</th>
							<th>Dinheiro facil</th>
							<th>69</th>
							<th>8000.00</th>
							<th>Entrada</th>
							<th>10</th>
							<th>8000.00</th>
						</tr>
						<tr>
							<th>11/09/2002</th>
							<th>Dinheiro facil</th>
							<th>69</th>
							<th>8000.00</th>
							<th>Entrada</th>
							<th>10</th>
							<th>8000.00</th>
						</tr>
					</tbody>
					<tfoot>
						<tr class="text-start table-active">
							<th colspan="6">
								Total do dia
							</th>
							<th>16000000</th>
						</tr>
					</tfoot>
				</table>
			</div>
			</div>
		</div>

		<!-- Area da seção Admin e logout -->
		<div class="row position-fixed fixed-bottom p-1" >
			<div class="col-12 text-end" > 
				<a href="adm.php" class="btn btn-warning">Administrar</a>
				<a href="contabilidade.php" class="btn btn-success justify-content-end">Ver todos os valores</a>
				<a href="#" class="btn btn-danger">Sair</a>
			</div>
		</div>
		
	</div>

</body>
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>
</html>