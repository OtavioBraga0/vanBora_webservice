<?php

class Aluno
{
    
    /* Atributos */
    private $Aluno_lng_Codigo;
    private $Usuario_lng_Codigo;
    private $Grupo_lng_Codigo;
    private $Aluno_chr_Confirmacao;
    
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