<?php

class Chart_pie{
protected $Head;
protected $Data;
protected $Backcolor;
protected $count_data;

     public function __construct($title) {
          $this->add_head($title);
     }

     public function add_head($title) {
          $this->Head = "label: '{$title}'";
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
          $Backcolor .= '], hoverOffset: 4';
          $this->Backcolor = $Backcolor;
     }

     public function getResult(){
          $Result = $this->Head;
          $Result .= $this->Data;
          $Result .= $this->Backcolor;
          return $Result;
     }

}


?>