
<?php
include_once 'Controller/ContabilidadeController.php';
include_once 'class/Lancamento.php';

// Verify if the user is Singned
session_start();
if (empty($_SESSION['nick']) || empty($_SESSION['nivel']) || empty($_SESSION['id_usuario']) ) {
     session_unset();
     session_abort();
     header('Location: ./login.php');
}

// Delete the launch by POST method
if (isset($_POST['deletar'])) {
	$l = new Lancamento;
	$l->deletarLancamento($_POST['id_lancamento']);
}

// verify in the session if the search elements are empty or not, if are needed alteretion they are done
if(isset($_POST['p_tipo'])){$_SESSION['pes_tipo'] = $_POST['p_tipo'];}
if(isset($_POST['p_data'])){$_SESSION['pes_data'] = $_POST['p_data'];}
if(isset($_POST['p_fpagamento'])){$_SESSION['pes_fpagamento'] = $_POST['p_fpagamento'];}
if(isset($_POST['p_descricao'])){$_SESSION['pes_descricao'] = $_POST['p_descricao'];}
if(isset($_POST['p_codigo'])){$_SESSION['pes_id_produto'] = $_POST['p_codigo'];}
if(isset($_POST['p_ordem'])){$_SESSION['pes_ordem'] = $_POST['p_ordem'];}
if(isset($_POST['p_pag'])){$_SESSION['pes_pag'] = $_POST['p_pag'];}

// Inicialize the search elements
if(!isset($_SESSION['pes_pag']) || isset($_POST['limpar_pes'])){
	$_SESSION['pes_tipo'] = 0;
	$_SESSION['pes_data'] = 0;
	$_SESSION['pes_fpagamento'] = '';
	$_SESSION['pes_descricao'] = '';
	$_SESSION['pes_id_produto'] = '';
	$_SESSION['pes_ordem'] = 'DESC';
	$_SESSION['pes_pag'] = 1;

}

// Inicialize the search
$p = new Pesquisa;
$p->PreparaBusca($_SESSION['pes_tipo'], $_SESSION['pes_data'], $_SESSION['pes_fpagamento'],$_SESSION['pes_descricao'], $_SESSION['pes_id_produto'], $_SESSION['pes_ordem']);;
$pesquisa = $p->Busca($_SESSION['pes_pag']);
$totalp = $p->Buscatodos();
// verify if the search is not empty
if ($totalp != false) {
	$contarl = ceil(count($totalp)/13);
}else {
	$contarl = 0;
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Contabilidade</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css\bootstrap-icons-1.10.5\font\bootstrap-icons.min.css">
	<link rel="shortcut icon" href="css/bootstrap-icons-1.10.5/journals.svg" type="image/x-icon">
</head>
<body >

     <div class="container-fluid ">
          
          <div class="row">
               
          <!-- Area Tabela -->
          <div class="col-xl-8 col-lg-9" style="height: 100vh;">
               <div class="table-responsive">
				<table class="table my-4 table-sm table-hover text-center">
					<thead class="text-center">
					<tr>
						<th >Data</th>
						<th>Descrição</th>
						<th>Lançado por:</th>
						<th>Codigo Produto</th>
						<th>Forma de Pagamento</th>
						<th>Tipo</th>
						<th>Valor Unitário</th>
						<th>Qtn</th>
						<th>Valor Total</th>

					</tr>
					</thead>
					<tbody class="table-group-divider ">
					<form action="./contabilidade.php" method="post">
						<input type="hidden" name="deletar" value="1">
						<?php
							// echo each launch in table elements
							for ($i=0; isset($pesquisa[$i]) ; $i++) { 
								switch($pesquisa[$i]['tipo']){
									case 'entrada':
										$cor = 'text-success';
										break;
									case 'saida':
										$cor = 'text-danger';
										break;
								} 
							echo 
							"<tr class='{$cor}'>
							<th class='text-nowrap'>".substr($pesquisa[$i]['dia'], 0, -15)."</th>
							<th>{$pesquisa[$i]['descricao']}</th>
							<th>{$pesquisa[$i]['nick']}</th>
							<th>{$pesquisa[$i]['id_produto']}</th>
							<th>{$pesquisa[$i]['forma_pagamento']}</th>
							<th>{$pesquisa[$i]['tipo']}</th>
							<th class='text-end'>".number_format((float)($pesquisa[$i]['VT']/$pesquisa[$i]['quantidade']), 2, '.', '')."</th>
							<th>{$pesquisa[$i]['quantidade']}</th>
							<th class='text-end'>".number_format((float)$pesquisa[$i]['VT'], 2, '.', '')."</th>
							<th><button type='submit' name='id_lancamento' value='{$pesquisa[$i]['id_lancamento']}' class='btn'><i class='bi bi-trash-fill text-danger'></i></button></th>
							</tr>";
							}
						?>
					</form>
					</tbody>
					<tfoot>
						<?php 
						// echo the sum of launchs values
						$tvalor = 0;
						for ($i=0;isset($totalp[$i]); $i++) { 
							switch ($totalp[$i]['tipo']) {
								case 'entrada':
									$tvalor += $totalp[$i]['VT'];
									break;
								case 'saida':
									$tvalor -= $totalp[$i]['VT'];
									break;
							}
							
						}
						if ($tvalor >= 1) {
							$cor = ' text-success';
						}else {
							$cor = ' text-danger';
						}
						$tvalor = number_format((float)$tvalor, 2, '.', '');
						?>
						<tr class="text-start table-active ">
							<th colspan="7">
								Total da pesquisa
							</th>
							<th colspan="3" class="text-center <?php echo $cor;?>"><?php echo $tvalor;?></th>
						</tr>
					</tfoot>
				</table>
			</div>

          <!-- /Area Tabela -->
          </div>

          <!-- Area Pesquisa -->
          <div class="col-xl-4 col-lg-3 shadow border-1 my-4 rounded-start-4">
               <!-- Every If varify the current option from the search -->
               <div class="my-3">
                    <form action="./contabilidade.php" method="POST">
				 <div class="text-center mb-3"> <span class="h2 tw-bold">Pesquisa</span></div>
					<div class="input-group mb-1">
						<span class="input-group-text">Tipo</span>
						<select name="p_tipo" id="" class="form-select">
							<option value="0">Ambos</option>
							<option value="1" <?php if($_SESSION['pes_tipo'] == 1){echo 'selected';} ?>>Entrada</option>
							<option value="2" <?php if($_SESSION['pes_tipo'] == 2){echo 'selected';} ?>>Saida</option>
						</select>
					</div>
					<div class="input-group mb-1">
                              <span class="input-group-text">Data</span>
						<select name="p_data" id="" class="form-select">
							<option value="0">Todos os dias</option>
							<option value="1" <?php if($_SESSION['pes_data'] == 1){echo 'selected';} ?>>Hoje</option>
							<option value="2" <?php if($_SESSION['pes_data'] == 2){echo 'selected';} ?>>Essa Semana</option>
							<option value="3" <?php if($_SESSION['pes_data'] == 3){echo 'selected';} ?>>Esse Mês</option>
							<option value="4" <?php if($_SESSION['pes_data'] == 4){echo 'selected';} ?>>Esse Ano</option>
						</select>
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Forma Pagamento</span>
						<select name="p_fpagamento" id="" class="form-select">
							<option value="" >Todas</option>
							<option value="Dinheiro" <?php if($_SESSION['pes_fpagamento'] == 'Dinheiro'){echo 'selected';} ?>>Dinheiro</option>
							<option value="Cartão" <?php if($_SESSION['pes_fpagamento'] == 'Cartão'){echo 'selected';} ?>>Cartão</option>
							<option value="Pix" <?php if($_SESSION['pes_fpagamento'] == 'Pix'){echo 'selected';} ?>>Pix</option>
						</select>
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Descrição</span>
						<input type="text" name="p_descricao" id="" value="<?php if(!empty($_SESSION['pes_descricao'])){echo $_SESSION['pes_descricao'];} ?>" class="form-control">
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Codigo produto</span>
						<input type="text" name="p_codigo" id="" value="<?php if(!empty($_SESSION['pes_id_produto'])){echo $_SESSION['pes_id_produto'];} ?>" class="form-control">
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Ordem</span>
						<select name="p_ordem" id="" class="form-select">	
						<option value="DESC" <?php if($_SESSION['pes_ordem'] == 'DESC'){echo 'selected';} ?>>Mais Recente</option>
						<option value="ASC" <?php if($_SESSION['pes_ordem'] == 'ASC'){echo 'selected';} ?>>Mais Antigo</option>
						</select>
					</div>
					<div class="text-center mb-1">Total da Pesquisa: <?php if($totalp != false && isset($totalp[0])){echo count($totalp);}else{echo 0;} ?></div>
					<div class="row mx-2 text-center">
						<button type="submit" class="btn btn-outline-success mb-1">Pesquisar</button>
						<button type="submit" name="limpar_pes" value="1" class="btn btn-outline-primary ">Limpar</button>
					</div>
                    </form>

				<div class="row ">
					<div class="col-12  my-3">
						<form action="./contabilidade.php" method="post">
							<nav aria-label="Page navigation ">
								<ul class="pagination justify-content-center">
								<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
								</a>
								</li>
										<?php 
										// echo the sum of pagnation buttons 
										for ($i=0; $i < $contarl; $i++) { 
											if(($i+1) == $_SESSION['pes_pag']){ $linkstart ='<li class="page-item active"><button class="page-link" name="p_pag" value="';}else{$linkstart ='<li class="page-item"><button class="page-link" name="p_pag" value="';}
											echo  $linkstart.($i+1).'">'.($i+1).'</button></li>
										';
										}?>
								<li class="page-item">
								<a class="page-link" href="#" aria-label="Next">
									<span aria-hidden="true">&raquo;</span>
								</a>
								</li>
								</ul>
							</nav>
						</form>

					</div>
				</div>
			</div>

          <!-- /Area Pesquias -->
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

</body>
</html>
