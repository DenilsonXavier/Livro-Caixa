<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

	<div class="container-fluid">
		<div class="row">

			<!-- Area das entradas e calculadora -->
			<div class="col-5 ">
				<div class="row bg-info p-2">
						<div class="col-12 h4">
								<form>
									<div class="mb-3">
										<label for="descricao_l" class="form-label">Descrição</label>
										<input type="text" class="form-control form-control-sm" name="descricao" id="descricao_l" required>
									</div>
									<div class="mb-3">
										<label for="forma_p" class="form-label">Forma de Pagamento</label>
										<select name="forma_p" id="forma_p" class="form-select form-select-sm" required>
											  <option selected>Escolha a forma de Pagamento</option>
											  <option value="1">Dinheiro</option>
											  <option value="2">Cartão</option>
											  <option value="3">Pix</option>
										</select>
									</div>
									<div class="mb-3 ">
										<label for="valor_l" class="form-label">Valor do Lançamento</label>
										<div class="input-group input-group-sm">
											<span class="input-group-text">R$</span>
											<input type="number" name="valor_l" id="valor_l" class="form-control" required>
										</div>
									</div>
									<div class="mb-3">
										<label for="qtn_l" class="form-label">Quantidade</label>
										<input type="number" name="qtn_l" id="qtn_l" class="form-control form-control-sm"  required>
									</div>
									<div class="mb-3">
										 <button type="submit" class="btn btn-primary btn-sm">Lançar</button>
										 <a href="#" class="btn btn-danger btn-sm">Ver todos os valores</a>
									</div>
									<div class="mb-3 input-group input-group-sm">
										<span class="input-group-text ">Valor total Do dia</span>
										<input type="text" placeholder="00.00" class="form-control form-control-sm" disabled>
									</div>

								</form>
						</div>
				</div>
				<div class="row bg-secondary">
						<div class="col-12">
							hfadg
						</div>
				</div>
			</div>

			<!-- Area da Tabela -->
			<div class="col-7 bg-danger">
				<table class="table table-sm align-middle">
					<thead>
						<tr>
							<th colspan="4"></th>
							<th colspan="3">Entradas</th>
							<th colspan="2">Saidas</th>
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
		<div class="row bg-primary align-items-end mb-0">
			<div class="col-12 ">
				asfas
			</div>
		</div>
		
	</div>

</body>
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>
</html>