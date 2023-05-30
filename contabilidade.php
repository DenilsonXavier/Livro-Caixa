<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Contabilidade</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

</head>
<body class="bg-dark-subtle text-light">

     <div class="container-fluid ">
          
          <div class="row">
               
          <!-- Area Tabela -->
          <div class="col-8">
               <div class="table-responsive">
				<table class="table  bg-dark-subtle table-borderless w-100 p-3 my-4 table-sm table-hover">
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
          <div class="col-4 bg-dark bg-opacity-75 my-4 mx-5 w-25 rounded-4">
               
               <div class="my-3">
                    <form action="">
				 <div class="text-center mb-3"> <span class="h2 tw-bold">Pesquisa</span></div>
					<div class="input-group mb-1">
						<span class="input-group-text">Tipo</span>
						<select name="p_tipo" id="" class="form-select">
							<option selected>Ambos</option>
							<option value="1">Entrada</option>
							<option value="2">Saida</option>
						</select>
					</div>
					<div class="input-group mb-1">
                              <span class="input-group-text">Data</span>
						<select name="p_data" id="" class="form-select">
							<option selected>Todos os dias</option>
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
						<input type="text" name="p_codigop" id="" class="form-control">
					</div>
					<div class="input-group mb-1">
						<span class="input-group-text">Ordem</span>
						<select name="p_ordem" id="" class="form-select">
							<option value="1" selected>Mais Recente</option>
							<option value="2">Mais Antigo</option>
						</select>
					</div>
					<div class="row mx-2">
						<a href="#" class="btn btn-warning mb-1">Limpar</a>
						<button type="submit" class="btn btn-primary">Pesquisar</button>
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
				<a href="#" class="btn btn-primary">Home</a>
				<a href="#" class="btn btn-warning">Administrar</a>
				<a href="#" class="btn btn-danger">Sair</a>
			</div>
		</div>

     </div>
     
	<script type="text/javascript" src="Js/bootstrap.bundle.min.js"></script>

</body>
</html>
