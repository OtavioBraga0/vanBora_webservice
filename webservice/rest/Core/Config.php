<?php

class Config {
   

    // Informa��es de Conex�o - DB MySQL
    const HOST = 'sao_miguel_sp.mysql.dbaas.com.br';
    const USER = 'sao_miguel_sp';
    const PSWD = 'saomiguel2018';
    const DB   = 'sao_miguel_sp';
	
	/* Configura��es do ISSUU */
    const ISSUU_KEY    = "iyc3hzp7riiosjprsjjcz6eqjz40os0e";
    const ISSUU_SECRET = "0c8cxu6dwfflfp6cd3g7136redlll9di";
    const ISSUU_NAME   = "santuariosenhordobonfim";
	
	/* Configura��es do PagSeguro */
    const PAGSEGURO_TOKEN = "0B1B131F463045449DCB4620D73CA635";
    const PAGSEGURO_EMAIL = "bonfimsantuario@gmail.com";
    const PAGSEGURO_URL   = "https://ws.pagseguro.uol.com.br";
    const REST_URL        = 'http://santuariosenhordobonfim.com/webservice/rest/ame040516/';
	
	// Informa��es do Rest
    const REST_SENHA = "ame%@1";

    public static final function LoadController() {
        try {
            if (file_exists( 'Core/Controller.php')) {
                include_once ( 'Core/Controller.php' );
            }
            else {
                throw new Exception('CONFIG: Arquivo do Controller n&#227;o encontrado.', 1000);
            }
        }
        catch (Exception $e) {
            die('#' . $e->getCode() . ' : ' . $e->getMessage());
        }
    }

}

?>