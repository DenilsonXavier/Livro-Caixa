<?php

class Chart_pie{
protected $Head;
protected $Data;
protected $Backcolor;
protected $count_data;

     public function __construct($title,$labels) {
          $this->add_head($title,$labels);
     }

     public function add_head($title,$labels) {
          $this->Head = "{
                    type: 'pie',
                    data: {
                    labels: ".json_encode($labels).",
                    datasets: [{
                    label: '{$title}'
                    ";
     }

     public function add_data($data){
          $Data = ',data: [';
          if (gettype($data) == "array") {
               $kdata = array_keys($data);
               for ($i=0; isset($kdata[$i]); $i++) { 
                    $Data .= $data[$kdata[$i]];
                    $this->count_data++;
                    if (isset($kdata[($i+1)])) {
                         $Data .= ',';
                    }
               }
          }elseif (gettype($data) == "double" || gettype($data) == "integer") {
               $Data .= $data;
                    $this->count_data++;
          }
          $Data .= ']';
          $this->Data = $Data;
     }

     public function add_backcolor($color){

          $Backcolor= ",backgroundColor: [";

          if (gettype($color) == "array") {
               for ($i=0; $this->count_data > $i; $i++) { 
                    $Backcolor .= "'{$color[$i]}'";
                    if ($this->count_data > ($i+1)) {
                         $Backcolor .= ',';
                    }
               }
          }
          if (gettype($color) == "string") {
               $Backcolor .= "'{$color}'";
          }
          $Backcolor .= '], hoverOffset: 4}
               ]
                },
                options: {
                responsive: false,
                scales: {
                }
                }
      }';
          $this->Backcolor = $Backcolor;
     }

     public function getResult(){
          $Result = $this->Head;
          $Result .= $this->Data;
          $Result .= $this->Backcolor;
          return $Result;
     }

     // {
     //      type: 'pie',
     //      data: {
     //      labels: labelproen,
     //      datasets: [{
     //           label: 'Quantidade de Vendas',data: [492,116,306],backgroundColor: ['#84b6f4','#fdfd96','#0079FF','#77dd77','#ff6961'], hoverOffset: 4}
     //      ]
     //      },
     //      options: {
     //      responsive: false,
     //      scales: {
     //      }
     //      }
     //      }

}



class Chart_bar{
     protected $Head = '';
     protected $Data = '';

     public function __construct($labels) {
          $this->add_head($labels);
     }

     public function add_head($labels) {
          if (gettype($labels) == "array") {
               $labels = json_encode($labels);
          }

          $this->Head = "{
               type: 'bar',
               data: {
               labels: ".$labels.",
               datasets: [
          ";

          return true;
     }
     public function add_Data($label,$data,$backcolor) {
          if (!(empty($this->Data))) {
               $this->Data .= ',';
          }
          if (gettype($data) == "array") {
               $data = json_encode($data);
          }
          $this->Data .= "{label: '{$label}',
               data: {$data},
               backgroundColor: '{$backcolor}'
               }
          " ;

          return true;
          
     }

     public function getResult(){
          $Result = $this->Head.$this->Data."
     ]
     },
     options: {
     responsive: true,
     scales: {
     }
     }
     }";
          return $Result;
     }
     public function clear(){
          $this->Head = '';
          $this->Data = '';
          return true;
     }

}

// {
//      type: 'bar',
//      data: {
//      labels: labels,
//      datasets: [{
//           label: 'Vendas',
//           data: databen,
//           backgroundColor: '#007bff'
//      }, {
//           label: 'Receitas',
//           data: databsa,
//           backgroundColor: '#28a745'
//      }]
//      }


?>