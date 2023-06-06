
<?php
include_once 'Controller/ContabilidadeController.php';
session_start();
if (empty($_SESSION['nick']) || empty($_SESSION['nivel']) || empty($_SESSION['id_usuario']) ) {
     session_unset();
     session_abort();
     header('Location: ./login.php');
}

if(isset($_POST['p_tipo'])){$_SESSION['pes_tipo'] = $_POST['p_tipo'];}
if(isset($_POST['p_data'])){$_SESSION['pes_data'] = $_POST['p_data'];}
if(isset($_POST['p_descricao'])){$_SESSION['pes_descricao'] = $_POST['p_descricao'];}
if(isset($_POST['p_codigo'])){$_SESSION['pes_id_produto'] = $_POST['p_codigo'];}
if(isset($_POST['p_ordem'])){$_SESSION['pes_ordem'] = $_POST['p_ordem'];}
if(isset($_POST['p_pag'])){$_SESSION['pes_pag'] = $_POST['p_pag'];}

if(!isset($_SESSION['pes_pag']) || isset($_POST['limpar_pes'])){
	$_SESSION['pes_tipo'] = 0;
	$_SESSION['pes_data'] = 0;
	$_SESSION['pes_descricao'] = '';
	$_SESSION['pes_id_produto'] = '';
	$_SESSION['pes_ordem'] = 'DESC';
	$_SESSION['pes_pag'] = 1;

}
$p = new Pesquisa;
$p->PreparaBusca($_SESSION['pes_tipo'], $_SESSION['pes_data'], $_SESSION['pes_descricao'], $_SESSION['pes_id_produto'], $_SESSION['pes_ordem']);;
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

</head>
<body >

     <div class="container-fluid ">
          
          <div class="row">
               
          <!-- Area Tabela -->
          <div class="col-8">
               <div class="table-responsive">
				<table class="table w-100 p-3 my-4 table-sm table-hover text-end">
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
					<tbody class="table-group-divider">
						<?php 
						
							for ($i=0; isset($pesquisa[$i]) ; $i++) { 
								switch($pesquisa[$i]['tipo']){
									case 'entrada':
										$cor = ' class="text-success">';
										break;
									case 'saida':
										$cor = ' class="text-danger">';
										break;
								} 
							echo 
							'<tr'.$cor.
							'<th>'.substr($pesquisa[$i]['dia'], 0, -15).'</th>
							<th>'.$pesquisa[$i]['descricao'].'</th>
							<th>'.$pesquisa[$i]['id_produto'].'</th>
							<th>'.number_format((float)($pesquisa[$i]['VT']/$pesquisa[$i]['quantidade']), 2, '.', '').'</th>
							<th>'.$pesquisa[$i]['tipo'].'</th>
							<th>'.$pesquisa[$i]['quantidade'].'</th>
							<th>'.number_format((float)$pesquisa[$i]['VT'], 2, '.', '').'</th>
							<th><form action="#"><input type="hidden" name="id_lancamento" value=""><button type="submit" class="btn"><i class="bi bi-trash-fill text-danger"></i></button></form></th>
							</tr>'	
								
								;
							}
						?>
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
							<th colspan="6">
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
							<?PHP 
								if (isset($_SESSION['pes_tipo'])) {
									switch ($_SESSION['pes_tipo']) {
										case 1:
											echo'
											<option value="0" >Ambos</option>
											<option value="1" selected>Entrada</option>
											<option value="2">Saida</option>';
											break;
										case 2:
											echo'
											<option value="0" >Ambos</option>
											<option value="1" >Entrada</option>
											<option value="2" selected>Saida</option>';
											break;
										default:
											echo'
											<option value="0" selected>Ambos</option>
											<option value="1" >Entrada</option>
											<option value="2">Saida</option>';
										break;
									}
								}
								else{
									echo'
									<option value="0" selected>Ambos</option>
									<option value="1" >Entrada</option>
									<option value="2">Saida</option>';
								}
							?>
						</select>
					</div>
					<div class="input-group mb-1">
                              <span class="input-group-text">Data</span>
						<select name="p_data" id="" class="form-select">
							<?PHP 
								if (isset($_SESSION['pes_data'])) {
									switch ($_SESSION['pes_data']) {
										case 1:
											echo'
											<option value="0">Todos os dias</option>
											<option value="1" selected>Hoje</option>
											<option value="2">Essa Semana</option>
											<option value="3">Esse Mês</option>
											<option value="4">Esse Ano</option>';
											break;
										case 2:
											echo'
											<option value="0">Todos os dias</option>
											<option value="1">Hoje</option>
											<option value="2" selected>Essa Semana</option>
											<option value="3">Esse Mês</option>
											<option value="4">Esse Ano</option>';
											break;
										case 3:
											echo'
											<option value="0">Todos os dias</option>
											<option value="1">Hoje</option>
											<option value="2">Essa Semana</option>
											<option value="3" selected>Esse Mês</option>
											<option value="4">Esse Ano</option>';
											break;
										case 4:
											echo'
											<option value="0">Todos os dias</option>
											<option value="1">Hoje</option>
											<option value="2">Essa Semana</option>
											<option value="3">Esse Mês</option>
											<option value="4" selected>Esse Ano</option>';
											break;
										default:
											echo'
											<option value="0" selected>Todos os dias</option>
											<option value="1">Hoje</option>
											<option value="2">Essa Semana</option>
											<option value="3">Esse Mês</option>
											<option value="4">Esse Ano</option>';
										break;
									}
								}
								else{
									echo'
									<option value="0" selected>Todos os dias</option>
									<option value="1">Hoje</option>
									<option value="2">Essa Semana</option>
									<option value="3">Esse Mês</option>
									<option value="4" >Esse Ano</option>';
								}
							?>
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
							<?PHP 
								if (isset($_SESSION['pes_ordem'])) {
									switch ($_SESSION['pes_ordem']) {
										case "DESC":
											echo'
											<option value="DESC" selected>Mais Recente</option>
											<option value="ASC">Mais Antigo</option>';
											break;
										case "ASC":
											echo'
											<option value="DESC">Mais Recente</option>
											<option value="ASC" selected>Mais Antigo</option>';
											break;
									}
								}
								else{
									echo'
									<option value="DESC" selected>Mais Recente</option>
									<option value="ASC">Mais Antigo</option>';
								}
							?>
						</select>
					</div>
					<div class="row mx-2">
						<button type="submit" name="limpar_pes" value="1" class="btn btn-outline-primary mb-1">Limpar</button>
						<button type="submit" class="btn btn-outline-success ">Pesquisar</button>
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
				<a href="adm.php" class="btn btn-warning">Administrar</a>
				<a href="login.php" class="btn btn-danger">Sair</a>
			</div>
		</div>

     </div>
     
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>

</body>
</html>
