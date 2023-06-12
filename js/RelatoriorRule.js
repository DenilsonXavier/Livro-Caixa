
import {Chartful} from "cdn.jsdelivr.chart.js.umd.min.js";
 function Relatorio_bge() {
     var ctx = document.getElementById('Relatorio_bge').getContext('2d');
     var myChart = new Chart(ctx, {
     type: 'bar',
     data: {
     labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto','Setembro', 'Outubro', 'Novembro', 'Dezembro'],
     datasets: [{
          label: 'Vendas',
          data: [100, 200, 150, 300, 250, 400, 41, 50, 12 ,121, 48, 500],
          backgroundColor: '#007bff'
     }, {
          label: 'Receitas',
          data: [300, 250, 400, 200, 350, 150, 200, 150, 300, 250, 400, 41],
          backgroundColor: '#28a745'
     }]
     },
     options: {
     responsive: true,
     scales: {
          height: 10
     }
     }
     });
     
 }
