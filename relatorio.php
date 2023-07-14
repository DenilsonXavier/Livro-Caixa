<?php 
session_start();
include_once 'Controller/RelatorioController.php';
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
          <div class="row shadow">
               <div class="col-3">
                    <ul class="list-group list-group-flush mt-3 text-center">
                         <li class="list-group-item"><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#relatorio_control" role="button" aria-expanded="false" aria-controls="relatorio_control" ><p class="display-5 fst-italic">Relatorio</p></a></div></li>
                         <div class="collapse multi-collapse" id="relatorio_control">
                              <li class="list-group-item">
                                   <ul class="list-group  list-group-flush">
                                        <form action="./relatorio.php" method="get">
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="0" class="btn "><span class=" fst-italic h4">Hoje</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="1" class="btn "><span class=" fst-italic h4">Essa Semana</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="2" class="btn "><span class=" fst-italic h4">Esse Mês</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="3" class="btn "><span class=" fst-italic h4">Esse Ano</span></button></li>
                                        <li class="list-group-item"><button type="submit" name="tipo_acao" value="4" class="btn "><span class=" fst-italic h4">Todos os Anos</span></button></li>
                                        </form>
                                   </ul>
                              </li>
                         </div>
                    </ul>
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
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_ve" role="button" aria-expanded="false" aria-controls="produto_ve">Vendas-Lucro</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_vq" role="button" aria-expanded="false" aria-controls="produto_vq">Vendas-Quantidade</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#produto_lc" role="button" aria-expanded="false" aria-controls="produto_lc">Lucro-Geral</a></div></li>
                                        </ul>
                                   </li>
                              </div>
                    </ul>
                    <ul class="list-group list-group-flush mt-3">
                         <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#gastos_control" role="button" aria-expanded="false" aria-controls="gastos_control" ><p class="h2">Gastos</p></a></div></li>
                              <div class="collapse multi-collapse" id="gastos_control">
                                   <li class="list-group-item ">
                                        <ul class="list-group list-group-flush ">
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#gastos_n" role="button" aria-expanded="false" aria-controls="gastos_n">Gastos</a></div></li>
                                             <li class="list-group-item "><div class="d-grid"><a class="btn " data-bs-toggle="collapse" href="#gastos_g" role="button" aria-expanded="false" aria-controls="gastos_g">Gastos-Geral</a></div></li>
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
                         <div class="text-center h3 fw-bold fst-italic"><span>Funcionárois Faturamento</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="Funcionario_flc" style="height: 50vh;" ></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_ve">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Vendas-Lucro</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_pve" style="height: 10vh;"></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_vq">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Vendas-Quantidade</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_pvq" style="height: 10vh;"></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="produto_lc">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Lucro-Geral</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_plc" style="height: 50vh;" ></canvas>
                         </div>
                    </div>
                    <div class="collapse multi-collapse my-2 text-center" style="height: 10vh;" id="gastos_g">
                         <div class="text-center h3 fw-bold fst-italic"><span>Produto Gastos</span></div>
                         <div class="d-flex justify-content-center">
                              <canvas id="produto_pgt" style="height: 50vh;" ></canvas>
                         </div>
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

          <!-- ------------- fim do container ------------- -->
     </div>

     <script src="js/cdn.jsdelivr.chart.js.umd.min.js"></script>
     <script src="js/bootstrap.bundle.min.js"></script>
     <script>
          var labels = JSON.parse('<?php echo $labels; ?>');
          var labelfun = JSON.parse('<?php echo $labelfun; ?>');

          // Grafico Balança Geral
          var ctx = document.getElementById('Relatorio_bge').getContext('2d');
          var myChart = new Chart(ctx, 
               <?php echo $databge; ?>);

          // Grafico Balança Entrada
          var ctx = document.getElementById('Relatorio_ben').getContext('2d');
          var myChart = new Chart(ctx, 
          <?php echo $databen; ?>);

          // Grafico Balança Saida
          var ctx = document.getElementById('Relatorio_bsa').getContext('2d');
          var myChart = new Chart(ctx, 
          <?php echo $databsa; ?>);


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
          var myChart = new Chart(ctx, 
               <?php echo $funcionariolucro;?>);

          // Grafico Produto Vendas
          var ctx = document.getElementById('produto_pve').getContext('2d');
          var myChart = new Chart(ctx, 
               <?php echo $produtovendas;?>);

          // Grafico Produto Lucro
          var ctx = document.getElementById('produto_plc').getContext('2d');
          var myChart = new Chart(ctx, 
               <?php echo $produtolucro;?>);

          // Grafico Produto Gastos
          var ctx = document.getElementById('produto_pgt').getContext('2d');
          var myChart = new Chart(ctx, <?php echo $produtogastos;?>);

          
     </script>
</body>
</html>