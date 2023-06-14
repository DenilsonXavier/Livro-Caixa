<?php 
session_start();
$label = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro');
$cores =array('#84b6f4', '#fdfd96', '#77dd77', '#ff6961', '#fdcae1' , '#ff85d5', '#ffe180', '#a3ffac', '#ffda9e');
$funcionarioname = array('admin','funcionario');
$produtonameen = array('Manutenção','Reparo');
$produtonamesa = array('Limpeza', 'Carlão da Esquina');

$balancaen = array(100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500);
$balancasa = array(300, 250, 400, 200, 350, 150, 200, 150, 300, 250, 400, 41);
$funcionariovendasvalor = array(100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500);
$funcionariolucrovalor = array(15000,32100);
$produtoenvalor = array(100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500);
$produtosavalor = array(100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500);
$produtoenlucro = array(1500, 3500);
$produtosagastos = array(120, 1540);




$funcionariovendas = ''; 
for ($i=0; isset($funcionarioname[$i]); $i++) { 
     $funcionariovendas .= "{label: '{$funcionarioname[$i]}',data:[";
     for ($s=0;  isset($funcionariovendasvalor[$s]); $s++) { 
          $funcionariovendas .= $funcionariovendasvalor[$s];
          if (isset($funcionariovendas[$s+1])) {$funcionariovendas .= ',';}
     }
     $funcionariovendas .= "],backgroundColor: '{$cores[$i]}'}";
     if (isset($funcionarioname[$i+1])) {$funcionariovendas .= ',';}
}

$funcionariolucro = "label: 'Numero de Vendas',data: ["; 
for ($s=0; isset($funcionariolucrovalor[$s]); $s++) { 
          $funcionariolucro .= $funcionariolucrovalor[$s];
          if (isset($funcionariolucrovalor[$s+1])) {$funcionariolucro .= ',';}
     }
$funcionariolucro .= "],backgroundColor: [";
for ($c=0; isset($funcionarioname[$c]) ; $c++) { 
     $funcionariolucro .= "'{$cores[$c]}' ";
     if (isset($funcionarioname[$c+1])) { $funcionariolucro .= ',';}
     }
$funcionariolucro .= "],
hoverOffset: 4";

$produtovendas = '';
for ($i=0; isset($produtonameen[$i]); $i++) { 
     $produtovendas .= "{label: '{$produtonameen[$i]}', data:[";
     for ($s=0; isset($produtoenvalor[$s]) ; $s++) { 
          $produtovendas .= $produtoenvalor[$s];
               if(isset($produtoenvalor[($s+1)])){$produtovendas .= ',';}
     }
     $produtovendas .= "], backgroundColor:'$cores[$i]'}"; 
     if (isset($produtonameen[($i+1)])) {$produtovendas .= ',';}
}



     // {label: 'admin',
     // data:[100,200,150,300,250,400,41,50,12,121,48,500,],
     // backgroundColor: '#84b6f4'}
     // ,{label: 'funcionario',
     //      data:[100,200,150,300,250,400,41,50,12,121,48,500,],
     //      backgroundColor: '#fdfd96'}


$labels = json_encode($label);
$labelfun = json_encode($funcionarioname);
$labelproen = json_encode($produtonameen);
$labelprosa = json_encode($produtonamesa);
$databen = json_encode($balancaen);
$databsa = json_encode($balancasa);
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css\bootstrap-icons-1.10.5\font\bootstrap-icons.min.css">
    <link rel="shortcut icon" href="css/bootstrap-icons-1.10.5/pie-chart-fill.svg" type="image/x-icon">
    <title>Relatorio</title>
</head>
<body>
     <div class="container-fluid">
          <div class="row ">
               <div class="col-12 text-center my-3">
                    <div class="display-4 fst-italic my-3">Relatorio</div>
                    <form action="">
                    <div class="d-flex flex-row justify-content-center bg-dark-subtle rounded-5">
                         <div class="p-2 flex-fill d-grid "><button type="submit" name="tipo_acao" value="0" class="btn "><span class=" fst-italic h3">Hoje</span></button></div>
                         <div class="p-2 flex-fill d-grid  "><button type="submit" name="tipo_acao" value="1" class="btn "><span class=" fst-italic h3">Essa Semana</span></button></div>
                         <div class="p-2 flex-fill d-grid "><button type="submit" name="tipo_acao" value="2" class="btn "><span class=" fst-italic h3">Esse Mês</span></button></div>
                         <div class="p-2 flex-fill d-grid  "><button type="submit" name="tipo_acao" value="3" class="btn "><span class=" fst-italic h3">Esse Ano</span></button></div>
                         <div class="p-2 flex-fill d-grid"><button type="submit" name="tipo_acao" value="4" class="btn "><span class=" fst-italic h3">Todos os Anos</span></button></div>
                    </div>
                    </form>
               </div>
          </div>
          <div class="row shadow">
               <div class="col-3">
                    <ul class="list-group list-group-flush mt-3">
                         <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_control" role="button" aria-expanded="false" aria-controls="balanca_control" ><p class="h2">Balança</p></a></div></li>
                              <div class="collapse multi-collapse" id="balanca_control">
                                   <li class="list-group-item ">
                                        <ul class="list-group list-group-flush ">
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_ge" role="button" aria-expanded="false" aria-controls="balanca_ge" >Geral</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_en" role="button" aria-expanded="false" aria-controls="balanca_en">Entrada</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#balanca_sa" role="button" aria-expanded="false" aria-controls="balanca_sa">Saida</a></div></li>
                                        </ul>
                                   </li>
                              </div>
                    </ul>
                    <ul class="list-group list-group-flush mt-3">
                         <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_control" role="button" aria-expanded="false" aria-controls="Funcionario_control" ><p class="h2">Funcionários</p></a></div></li>
                              <div class="collapse multi-collapse" id="Funcionario_control">
                                   <li class="list-group-item ">
                                        <ul class="list-group list-group-flush ">
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_ve" role="button" aria-expanded="false" aria-controls="Funcionario_ve">Vendas</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#Funcionario_lc" role="button" aria-expanded="false" aria-controls="Funcionario_lc">Lucro</a></div></li>
                                        </ul>
                                   </li>
                              </div>
                    </ul>
                    <ul class="list-group list-group-flush mt-3">
                         <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_control" role="button" aria-expanded="false" aria-controls="produto_control" ><p class="h2">Produtos</p></a></div></li>
                              <div class="collapse multi-collapse" id="produto_control">
                                   <li class="list-group-item ">
                                        <ul class="list-group list-group-flush ">
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_ve" role="button" aria-expanded="false" aria-controls="produto_ve">Vendas</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_lc" role="button" aria-expanded="false" aria-controls="produto_lc">Lucro</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_gt" role="button" aria-expanded="false" aria-controls="produto_gt">Gastos</a></div></li>
                                        </ul>
                                   </li>
                              </div>
                    </ul>
               </div>
               <div class="col-9 shadow py-3">

                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="balanca_ge">
                         <div class="text-center h3 fw-bold fst-italic"><span>Balança Geral</span></div>
                         <canvas id="Relatorio_bge" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="balanca_en">
                         <div class="text-center h3 fw-bold fst-italic"><span>Balança Entradas</span></div>
                         <canvas id="Relatorio_ben" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="balanca_sa">
                         <div class="text-center h3 fw-bold fst-italic"><span>Balança Saidas</span></div>
                         <canvas id="Relatorio_bsa" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2" style="height: 10vh;" id="Funcionario_ve">
                         <div class="text-center h3 fw-bold fst-italic"><span>Funcionários Vendas</span></div>
                         <canvas id="Funcionario_fve" style="height: 10vh;"></canvas>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="Funcionario_lc">
                         <div class="text-center h3 fw-bold fst-italic"><span>Funcionárois Lucro</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="Funcionario_flc" style="height: 50vh;" ></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_ve">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Vendas</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_pve" style="height: 10vh;"></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_lc">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Lucro</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_plc" style="height: 50vh;" ></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_gt">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Gastos</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_pgt" style="height: 50vh;" ></canvas>
                         </div>
                    </div>




               </div>
          </div>


		<!-- Area da seção Admin e logout -->
		<div class="row p-1" >
               <div class="row fixed-bottom " >
                    <div class="col-12 text-end" > 
                         <div class="d-flex d-inline justify-content-end align-bottom mb-4" style="height: 5vh;">
                              <div class="collapse multi-collapse" id="menu_control">
                                   <div class="d-inline d-flex">
                                        <div><a href="index.php" class="btn btn "><p class="h2"><i class="bi bi-house"></i></p></a></div>
							     <?php if ($_SESSION['nivel'] == 'administrador') {echo ' <div> <a href="adm.php" class="btn btn "><p class="h2"><i class="bi bi-gear"></i></p></a> </div> ';} ?>
                                        <div><a href="contabilidade.php" class="btn btn "><p class="h2"><i class="bi bi-journals"></i></p></a></div>
                                        <div><a href="login.php" class="btn btn "><p class="h2 text-danger"><i class="bi bi-door-open"></i></p></a></div>
                                   </div>
                              </div>
                              <div><a class="btn " data-bs-toggle="collapse" href="#menu_control" role="button" aria-expanded="false" aria-controls="menu_control" ><p class="h2"><i class='bi bi-list '></i></p></a></div>
                         </div>
                    </div>
               </div>
		</div>

          <!-- ------------- fim do container ------------- -->
     </div>

     <script src="js/cdn.jsdelivr.chart.js.umd.min.js"></script>
     <script src="js/bootstrap.bundle.min.js"></script>
     <script>
          var labels = JSON.parse('<?php echo $labels; ?>');
          var labelfun = JSON.parse('<?php echo $labelfun; ?>');
          var labelproen = JSON.parse('<?php echo $labelproen; ?>');
          var labelprosa = JSON.parse('<?php echo $labelprosa; ?>');
          var databen = JSON.parse('<?php echo $databen; ?>');
          var databsa = JSON.parse('<?php echo $databsa; ?>');

          // Grafico Balança Geral
          var ctx = document.getElementById('Relatorio_bge').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [{
               label: 'Vendas',
               data: databen,
               backgroundColor: '#007bff'
          }, {
               label: 'Receitas',
               data: databsa,
               backgroundColor: '#28a745'
          }]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Balança Entrada
          var ctx = document.getElementById('Relatorio_ben').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [{
               label: 'Vendas',
               data: databen,
               backgroundColor: '#007bff'
          }]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Balança Saida
          var ctx = document.getElementById('Relatorio_bsa').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [{
               label: 'Receitas',
               data: databsa,
               backgroundColor: '#28a745'
          }]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Funcionarios vendas
          var ctx = document.getElementById('Funcionario_fve').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [
               
               <?php 
               echo $funcionariovendas;
                    ?>]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Funcionarios Lucro
          var ctx = document.getElementById('Funcionario_flc').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: labelfun,
          datasets: [{
               <?php echo $funcionariolucro;?>}
          ]
          },
          options: {
          responsive: false,
          scales: {
          }
          }
          });
          // Grafico Produto Vendas
          var ctx = document.getElementById('produto_pve').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
          labels: labels,
          datasets: [
               <?php echo $produtovendas;?>
          ]
          },
          options: {
          responsive: true,
          scales: {
          }
          }
          });
          // Grafico Produto Lucro
          var ctx = document.getElementById('produto_plc').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: labels,
          datasets: [{
               <?php echo $funcionariolucro;?>}
          ]
          },
          options: {
          responsive: false,
          scales: {
          }
          }
          });
          // Grafico Produto Gastos
          var ctx = document.getElementById('produto_pgt').getContext('2d');
          var myChart = new Chart(ctx, {
          type: 'pie',
          data: {
          labels: labels,
          datasets: [{
               <?php echo $funcionariolucro;?>}
          ]
          },
          options: {
          responsive: false,
          scales: {
          }
          }
          });

          
     </script>
</body>
</html>