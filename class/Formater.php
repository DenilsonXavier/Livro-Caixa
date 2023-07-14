<?php 
class Formater{
     protected $layout;
     protected $result;

     public function __construct($layout) {
          if ($this->setlayout($layout)) {
                $this->prepare_result();
               return true;    
          }else{
               die("Error, time is not valueble. Expected Strings 'week','month','year'.");
          }
     }

     function setlayout($layout) {
          if ($layout == "week" || $layout == "month" || $layout == "year" || $layout == "today") {
               $this->layout = $layout;
               return true;
          }else{
               return false;
          }

     }
     function get_result(){
          return $this->result;
     }
     function get_date(){
          switch ($this->layout) {
               case 'today':
                    $date = 1;
                    break;
               case 'week':
                    $date = 7;
                    break;
               case 'month':
                    $date = 12;
                    break;
               case 'year':
                    $date = 12;
                    break;
          }
          return $date;
     }


     function prepare_result(){

          $this->result = array();
          return true;
     }

     function add_format($id,$des,$value,$qtn,$dia,$tipo = ''){
          switch ($this->layout) {
               case 'today':
                      $tempo = 0;
                    break;
               case 'week':
                       $tempo = date("w", strtotime($dia));
                    break;
               case 'month':
                       $tempo = floor(date("d", strtotime($dia))/3);
                    break;
               case 'year':
                       $tempo = (date("m", strtotime($dia))-1);
                    break;
          }
          if (!(isset($this->result[$id]))) {
               $this->result[$id] = array();
          }
          if (!(isset($this->result[$id][$tempo]))) {
               $this->result[$id][$tempo] = array();
               $this->result[$id][$tempo]['name'] = $des;
               $this->result[$id][$tempo]['VT'] = 0;
               $this->result[$id][$tempo]['QT'] = 0;
               $this->result[$id][$tempo]['ID'] = $id;
               $this->result[$id][$tempo]['TIPO'] = $tipo;
          }
          $this->result[$id][$tempo]['VT'] += $value;
          $this->result[$id][$tempo]['QT'] += $qtn;
          
     return true;
}

}

?>