<?php
class Usuario{

    var $datos = "Rafael Bascón Barrera";
    
    function Usuario($id){
      echo $id . " " . $this->datos;
    }

    function mostrar($id){
      echo "<br>" . $id . " " . $this->datos;
    }
 }

