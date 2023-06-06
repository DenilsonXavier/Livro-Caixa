
<?php
include_once 'Controller/ContabilidadeController.php';
session_start();
if (!isset($_SESSION['nick']) || !isset($_SESSION['nivel']) || !isset($_SESSION['id_usuario']) ) {
	session_abort();
	header('Location: ./login.php');
}

if(isset($_POST['p_tipo'])){$_SESSION['pes_tipo'] = $_POST['p_tipo'];}
if(isset($_POST['p_data'])){$_SESSION['pes_data'] = $_POST['p_data'];}
if(isset($_POST['p_descricao'])){$_SESSION['pes_descricao'] = $_POST['p_descricao'];}
if(isset($_POST['p_codigo'])){$_SESSION['pes_id_produto'] = $_POST['p_codigo'];}
if(isset($_POST['p_ordem'])){$_SESSION['pes_ordem'] = $_POST['p_ordem'];}
if(isset($_POST['p_pag'])){$_SESSION['pes_pag'] = $_POST['p_pag'];}

if(!isset($_SESSION['pes_pag'])){
	$_SESSION['pes_tipo'] = '';
	$_SESSION['pes_data'] = '';
	$_SESSION['pes_descricao'] = '';
	$_SESSION['pes_id_produto'] = '';
	$_SESSION['pes_ordem'] = 'DESC';
	$_SESSION['pes_pag'] = 1;

}
$p = new Pesquisa;
$pesquisa = $p->busca($_SESSION['pes_tipo'], $_SESSION['pes_data'], $_SESSION['pes_descricao'], $_SESSION['pes_id_produto'], $_SESSION['pes_ordem'], $_SESSION['pes_pag']);;


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
				<table class="table w-100 p-3 my-4 table-sm table-hover"">
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
						<tr class="text-start table-active">
							<th colspan="6">
								Total da Pesquisa
							</th>
							<th>16000000</th>
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
							<option value="" selected>Ambos</option>
							<option value="1">Entrada</option>
							<option value="2">Saida</option>
						</select>
					</div>
					<div class="input-group mb-1">
                              <span class="input-group-text">Data</span>
						<select name="p_data" id="" class="form-select">
							<option value="" selected>Todos os dias</option>
							<option value="1">Hoje</option>
							<option value="2">Essa Semana</option>
							<option value="3">Esse Mês</option>
							<option value="4">Esse Anos</option>
						</select>
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Descrição</span>
						<input type="text" name="p_descricao" id="" class="form-control">
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Codigo produto</span>
						<input type="text" name="p_codigo" id="" class="form-control">
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Ordem</span>
						<select name="p_ordem" id="" class="form-select">
							<option value="DESC" selected>Mais Recente</option>
							<option value="ASC">Mais Antigo</option>
						</select>
					</div>
					<div class="row mx-2">
						<a href="#" class="btn btn-outline-primary mb-1">Limpar</a>
						<button type="submit" class="btn btn-outline-success ">Pesquisar</button>
					</div>
                    </form>

				<div class="row ">
					<div class="col-12  my-3">
						<nav aria-label="Page navigation ">
							<ul class="pagination justify-content-center">
							  <li class="page-item">
							    <a class="page-link" href="#" aria-label="Previous">
								 <span aria-hidden="true">&laquo;</span>
							    </a>
							  </li>
							  <li class="page-item"><a class="page-link" href="#">1</a></li>
							  <li class="page-item"><a class="page-link" href="#">2</a></li>
							  <li class="page-item"><a class="page-link" href="#">3</a></li>
							  <li class="page-item">
							    <a class="page-link" href="#" aria-label="Next">
								 <span aria-hidden="true">&raquo;</span>
							    </a>
							  </li>
							</ul>
						</nav>
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
				<a href="#" class="btn btn-danger">Sair</a>
			</div>
		</div>

     </div>
     
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>

</body>
</html>
