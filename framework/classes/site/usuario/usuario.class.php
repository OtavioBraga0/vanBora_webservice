<?php

class Usuario
{
    
    /* Atributos */
    private $Usuario_lng_Codigo;
    private $Usuario_vch_Nome;
    private $Usuario_dat_DataNascimento;
    private $Usuario_vch_Endereco;
    private $Usuario_vch_Numero;
    private $Usuario_vch_Complemento;
    private $Usuario_vch_Celular;
    private $Usuario_chr_Tipo;
    private $Usuario_vch_DeviceId;
    
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