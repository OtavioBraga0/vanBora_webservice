<?php

class Grupo
{
    
    /* Atributos */
    private $Grupo_lng_Codigo;
    private $Grupo_vch_Nome;
    private $Grupo_vch_Horario;
    private $Usuario_lng_Codigo;
    private $Periodo_lng_Codigo;
    
    /* M�todos m�gicos GET e SET */
    public function __get($property) 
    {
        if (property_exists($this, $property)) 
        {
          return $this->$property;
        }
    }
    
    public function __set($property, $value) 
    {
        if (property_exists($this, $property)) 
        {
          $this->$property = $value;
        }
        return $this;
    }

}

?>