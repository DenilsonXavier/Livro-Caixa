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


     function prepare_result(){
          switch ($this->layout) {
               case 'today':
                    $this->result = array(0 => array(array()));
                    break;
               case 'week':
                    $this->result = array(0 => array(array())
                    ,1=> array(array())
                    ,2=> array(array())
                    ,3=> array(array())
                    ,4=> array(array())
                    ,5=> array(array())
                    ,6=> array(array())
               );
                    break;
               case 'month':
                    $this->result = array(0 => array(array())
                    ,1=> array(array())
                    ,2=> array(array())
                    ,3=> array(array())
                    ,4=> array(array())
                    ,5=> array(array())
                    ,6=> array(array())
                    ,7=> array(array())
                    ,8=> array(array())
                    ,9=> array(array())
                    ,10=> array(array())
               );
                    break;
               case 'year':
                    $this->result = array(0 => array()
                    ,1=> array()
                    ,2=> array()
                    ,3=> array()
                    ,4=> array()
                    ,5=> array()
                    ,6=> array()
                    ,7=> array()
                    ,8=> array()
                    ,9=> array()
                    ,10=> array()
                    ,11=> array()
               );
                    break;
               
               default:
                    return false;
                    break;
          }

          return true;
     }

     function add_format($key,$id,$des,$value,$qtn,$dia,$tipo = ''){
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
          if (!(in_array($key, $this->result[$tempo]))) {
               $this->result[$tempo][$key] = array();
               $this->result[$tempo][$key]['name'] = $des;
               $this->result[$tempo][$key]['VT'] = 0;
               $this->result[$tempo][$key]['QT'] = 0;
               $this->result[$tempo][$key]['ID'] = $id;
               $this->result[$tempo][$key]['TIPO'] = $tipo;
          }
          $this->result[$tempo][$key]['VT'] += $value;
          $this->result[$tempo][$key]['QT'] += $qtn;
          
     return true;
}

}

?>