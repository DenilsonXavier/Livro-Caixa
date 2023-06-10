
<?php
include_once 'Controller/ContabilidadeController.php';
include_once 'class/Lancamento.php';
session_start();
if (empty($_SESSION['nick']) || empty($_SESSION['nivel']) || empty($_SESSION['id_usuario']) ) {
     session_unset();
     session_abort();
     header('Location: ./login.php');
}
if (isset($_POST['deletar'])) {
	$l = new Lancamento;
	$l->deletarLancamento($_POST['id_lancamento']);
}

if(isset($_POST['p_tipo'])){$_SESSION['pes_tipo'] = $_POST['p_tipo'];}
if(isset($_POST['p_data'])){$_SESSION['pes_data'] = $_POST['p_data'];}
if(isset($_POST['p_fpagamento'])){$_SESSION['pes_fpagamento'] = $_POST['p_fpagamento'];}
if(isset($_POST['p_descricao'])){$_SESSION['pes_descricao'] = $_POST['p_descricao'];}
if(isset($_POST['p_codigo'])){$_SESSION['pes_id_produto'] = $_POST['p_codigo'];}
if(isset($_POST['p_ordem'])){$_SESSION['pes_ordem'] = $_POST['p_ordem'];}
if(isset($_POST['p_pag'])){$_SESSION['pes_pag'] = $_POST['p_pag'];}

if(!isset($_SESSION['pes_pag']) || isset($_POST['limpar_pes'])){
	$_SESSION['pes_tipo'] = 0;
	$_SESSION['pes_data'] = 0;
	$_SESSION['pes_fpagamento'] = '';
	$_SESSION['pes_descricao'] = '';
	$_SESSION['pes_id_produto'] = '';
	$_SESSION['pes_ordem'] = 'DESC';
	$_SESSION['pes_pag'] = 1;

}
$p = new Pesquisa;
$p->PreparaBusca($_SESSION['pes_tipo'], $_SESSION['pes_data'], $_SESSION['pes_fpagamento'],$_SESSION['pes_descricao'], $_SESSION['pes_id_produto'], $_SESSION['pes_ordem']);;
$pesquisa = $p->Busca($_SESSION['pes_pag']);
$totalp = $p->Buscatodos();
$contarl = ceil(count($totalp)/15);

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
</head>
<body >

     <div class="container-fluid ">
          
          <div class="row">
               
          <!-- Area Tabela -->
          <div class="col-8">
               <div class="table-responsive">
				<table class="table w-100 p-3 my-4 table-sm table-hover text-center">
					<thead class="text-center">
					<tr>
						<th>Data</th>
						<th>Descrição</th>
						<th>Codigo Produto</th>
						<th>Forma de Pagamento</th>
						<th>Valor Unitário</th>
						<th>Tipo</th>
						<th>Quantidade</th>
						<th>Valor Total</th>

					</tr>
					</thead>
					<tbody class="table-group-divider">
					<form action="./contabilidade.php" method="post">
						<input type="hidden" name="deletar" value="1">
						<?php
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
							<th>".substr($pesquisa[$i]['dia'], 0, -15)."</th>
							<th>{$pesquisa[$i]['descricao']}</th>
							<th>{$pesquisa[$i]['id_produto']}</th>
							<th>{$pesquisa[$i]['forma_pagamento']}</th>
							<th class='text-end'>".number_format((float)($pesquisa[$i]['VT']/$pesquisa[$i]['quantidade']), 2, '.', '')."</th>
							<th>{$pesquisa[$i]['tipo']}</th>
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
						?>
						<tr class="text-start table-active ">
							<th colspan="7">
								Total da pesquisa
							</th>
							<th colspan="2" class="text-center<?php echo $cor.'">'.number_format((float)$tvalor, 2, '.', ''); ?></th>
						</tr>
					</tfoot>
				</table>
			</div>

          <!-- /Area Tabela -->
          </div>

          <!-- Area Pesquisa -->
          <div class="col-4 shadow border-1 my-4  w-25 rounded-4">
               
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
					<div class="text-center mb-1">Total da Pesquisa: <?php echo count($pesquisa);?></div>
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
										<?php for ($i=0; $i < $contarl; $i++) { 
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
		<div class="row position-fixed fixed-bottom p-1" >
			<div class="col-12 text-end" > 
				<a href="index.php" class="btn btn-primary">Home</a>
				<?php 
					if ($_SESSION['nivel'] == 'administrador') {
						echo '<a href="adm.php" class="btn btn-warning">Administrar</a>';
					}
				?>
				<a href="login.php" class="btn btn-danger">Sair</a>
			</div>
		</div>

     </div>
     
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>

</body>
</html>
