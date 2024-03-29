<?php 
	include_once './class/Produto.php';
	include_once './class/Lancamento.php';
	// varify if the user is signed
	session_start();
	if (empty($_SESSION['nick']) || empty($_SESSION['nivel']) || empty($_SESSION['id_usuario']) ) {
		header('Location: ./login.php');
	}
	// delete launch by POST method
	if (isset($_POST['deletar_l'])) {
		$l = new Lancamento;
		$l->deletarLancamento($_POST['id_lancamento']);
	}

	// Validation TOKEN
	// deepcode ignore InsecureHash: <Just for extra randomizezion>
 $_SESSION['validacao_hash'] = md5(rand());

	// Get the products and the today´s launchs
	$p = new Produto;
	$todosp = $p->BuscarTodosProdutos();
	$l = new Lancamento;
	$todosl = $l->BuscarLancamentosHoje();
	
	$tvalor = 0;
	for ($i=0;isset($todosl[$i]); $i++) { 
		switch ($todosl[$i]['tipo']) {
			case 'entrada':
				$tvalor += $todosl[$i]['VT'];
				break;
			case 'saida':
				$tvalor -= $todosl[$i]['VT'];
				break;
		}
		
	}
	if ($tvalor >= 1) {
		$cortv = ' text-success';
	}elseif ($tvalor <= 0) {
		$cortv = ' text-danger';
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\bootstrap-icons-1.10.5\font\bootstrap-icons.min.css">
	<link rel="shortcut icon" href="css/bootstrap-icons-1.10.5/house-fill.svg" type="image/x-icon">
</head>
<body >

	<div class="container-fluid ">
		<div  class="row h-100">

			<!-- Area das entradas e saidas-->
			<div class="col-xl-5 col-lg-3">
				<div class="row shadow border-2 rounded-4">
						<div class="col-12 h4 ">
								<div class="display-4 my-2 text-center fw-bold">
									<span>Entrada</span>
								</div>
								<!-- Formulario de entrada-->
								<form action="./Controller/IndexController.php" method="post">
									<div class="mb-3">
										<div class="input-group ">
											<span class="input-group-text">Descrição</span>
											<select name="descricao_p" id="descricao_p" class="form-select " required>
												  <option selected value="0">Escolha serviço</option>
												  <?php 
												  	// echo the products
												  	$i =0;
												 	for ($i = 0; isset($todosp[$i]); $i++) { 
														if ($todosp[$i]['tipo'] == 'entrada') {
														echo '<option value="'.$todosp[$i]['id_produto'].'">'.$todosp[$i]['descricao'].'</option>';
													}
													}
												  ?>
											</select>
										</div>
											<?php 
											// Error verifier
											if (isset($_SESSION['Errofdes'])) {
												echo '<label for="" class="h6 form-label text-danger">Esse campo é obrigatorio</label>';
												unset($_SESSION['Errofdes']);
											}
											?>
									</div>
									<div class="mb-3">
										<div class="input-group ">
											<span class="input-group-text">Pagamento</span>
											<select name="forma_p" id="forma_p" class="form-select " required>
												  <option selected value="0">Forma de Pagamento</option>
												  <option value="Dinheiro">Dinheiro</option>
												  <option value="Cartão">Cartão</option>
												  <option value="Pix">Pix</option>
											</select>
										</div>
											<?php 
											// Error verifier
											if (isset($_SESSION['Errofpag'])) {
												echo '<label for="" class="h6 form-label text-danger">Esse campo é obrigatorio</label>';
												unset($_SESSION['Errofpag']);
											}
											?>
									</div>
									<div class="mb-3 ">
										<div class="input-group ">
											<?php 
												// Error verifier
												if (isset($_SESSION['Erronume'])) {
													echo '<label for="" class="h6 form-label text-danger">Coloque numeros interios com ponto final.</label>';
												}
												$_SESSION['Erronume'] = null;
											?>
											<span class="input-group-text">Valor </span>
											<span class="input-group-text">R$</span>
											<input type="text" name="valor_l" id="valor_l" class="form-control" required>
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group"><span class="input-group-text">Quantidade</span>
											<input type="number" name="qtn_l" id="qtn_l" class="form-control" value="1"  required>
										</div>
									</div>
									<div class="d-grid gap-2 mb-3">
										<input type="hidden" name="tipo_acao" value="entrada">
										<input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
										 <button type="submit" class="btn btn-outline-success  justify-content-start">Lançar</button>
									</div>
									<div class="mb-3 input-group d-flex">
										<span class="input-group-text ">Valor total Do dia</span>
										<span <?php echo " class='input-group-text flex-fill {$cortv}'" ;?>><?php echo number_format((float)$tvalor, 2, '.', ''); ?> </span>
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
							<form action="./Controller/IndexController.php" method="post">
									
									<div class="mb-3">
										<div class="input-group input-group-sm">
											<span class="input-group-text">Descrição</span>

											<select name="descricao_p" id="descricao_p" class="form-select " required>
												  <option value="0" selected>Escolha Serviço</option>
												  <?php 
												  	// echo products
												  	$i =0;
												 	for ($i = 0; isset($todosp[$i]); $i++) { 
														if ($todosp[$i]['tipo'] == 'saida') {
														echo '<option value="'.$todosp[$i]['id_produto'].'">'.$todosp[$i]['descricao'].'</option>';
													}
													}
												  ?>
											</select>
										</div>
											<?php 
											// Error verifier
											if (isset($_SESSION['Errofdess'])) {
												echo '<label for="" class="h6 form-label text-danger">Esse campo é obrigatorio</label>';
												unset($_SESSION['Errofdess']);
											}
											?>
									</div>


									<div class="mb-3">
										<div class="input-group ">
											<span class="input-group-text">Pagamento</span>
											<select name="forma_p" id="forma_p" class="form-select " required>
												  <option  value="0" selected>Forma de Pagamento</option>
												  <option value="Dinheiro">Dinheiro</option>
												  <option value="Cartão">Cartão</option>
												  <option value="Pix">Pix</option>
											</select>
										</div>
											<?php 
											// Error verifier
											if (isset($_SESSION['Errofpags'])) {
												echo '<label for="" class="h6 form-label text-danger">Esse campo é obrigatorio</label>';
												unset($_SESSION['Errofpags']);
											}
											?>
									</div>

									
									<div class="mb-3 ">
										<div class="input-group input-group-sm">
												<?php 
												// Error verifier
												if (isset($_SESSION['Erronums'])) {
													echo '<label for="" class="h6 form-label text-danger">Coloque numeros interios com ponto final.</label>';
												}
												$_SESSION['Erronums'] = null;
												?>
											<span class="input-group-text">Valor </span>
											<span class="input-group-text">R$</span>
											<input type="text" name="valor_l" id="valor_l" class="form-control" required>
										</div>
									</div>

									<div class="d-grid gap-2 mb-3">
										<input type="hidden" name="tipo_acao" value="saida">
										<input type="hidden" name="validacao_hash" value="<?php echo $_SESSION['validacao_hash'] ?>">
										 <button type="submit" class="btn btn-outline-danger justify-content-start">Lançar</button>
									</div>

							</form>


						</div>
				</div>
			</div>

			<!-- Area da Tabela -->
			<div class="col-xl-7 col-lg-9 text-center"  >
			<div class="table-responsive" style="height: 90vh;">
				<table class="table w-100 p-3 my-4 table-sm table-hover align-middle">
					<thead>
					<tr>
						<th>Data</th>
						<th>Descrição</th>
						<th>Responsavel</th>
						<th>Codigo Produto</th>
						<th>Forma Pagamento</th>
						<th>Tipo</th>
						<th>Valor Unitário</th>
						<th>Quantidade</th>
						<th>Valor Total</th>

					</tr>
					</thead>
					<tbody>
						<form action="./index.php" method="post">
							<input type="hidden" name="deletar_l" value="1">
						<?php 
							// echo each launch as a table´s element
							for ($i=0; isset($todosl[$i]) ; $i++) { 
								switch($todosl[$i]['tipo']){
									case 'entrada':
										$cor = 'text-success';
										break;
									case 'saida':
										$cor = 'text-danger';
										break;
								} 
							echo 
							"<tr class='{$cor}'>
							<th>".substr($todosl[$i]['dia'], 0, -15)."</th>
							<th>{$todosl[$i]['descricao']}</th>
							<th>{$todosl[$i]['nick']}</th>
							<th>{$todosl[$i]['id_produto']}</th>
							<th>{$todosl[$i]['forma_pagamento']}</th>
							<th>{$todosl[$i]['tipo']}</th>
							<th class='text-end'>".number_format((float)($todosl[$i]['VT']/$todosl[$i]['quantidade']), 2, '.', '')."</th>
							<th>{$todosl[$i]['quantidade']}</th>
							<th class='text-end'>".number_format((float)$todosl[$i]['VT'], 2, '.', '')."</th>
							<th><button type='submit' 'name='id_lancamento' value='{$todosl[$i]['id_lancamento']}' class='btn'><i class='bi bi-trash-fill text-danger'></i></button></th>
							</tr>";
							}
						?>
						</form>
					</tbody>
					<tfoot>
						<tr class="text-start table-active ">
							<th colspan="8">
								Total do dia
							</th>
							<th colspan="2" class="text-center <?php echo $cortv?>"> <?php echo number_format((float)$tvalor, 2, '.', ''); ?> </th>
						</tr>
					</tfoot>
				</table>
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

</body>
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>
</html>