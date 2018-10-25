<?php

class Security {
    
    
    public static final function VerificaAutenticacao()
    {
        if (!isset($_GET['s']) || $_GET['s'] != Config::REST_SENHA ) {
            //echo "Erro ao acessar";
            exit();
        }
    }
    
    
}
?>