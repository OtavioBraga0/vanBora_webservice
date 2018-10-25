<?php
header("Content-Type: text/html;  charset=UTF-8",true);
header('Access-Control-Allow-Origin: *');

//ini_set('default_charset', 'ISO-8859-1');
//ini_set('display_errors', '1');

error_reporting(0);

// error_reporting(E_ALL ^ E_STRICT);
setlocale(LC_ALL, 'pt_BR', 'ptb');
date_default_timezone_set("America/Sao_Paulo");

session_start();

/* Define os Caminhos Absolutos */
define('PATH_SISTEMA', 'webservice/rest');
define('PATH_ABS', dirname(__FILE__) . '\\');
define('PATH_WWW', 'http://' . $_SERVER['HTTP_HOST'] . '/' . PATH_SISTEMA . '/');

/* Adiciona Classe de Configura��o */
try {
    if (file_exists('Core/Config.php')) {
        
        require_once ('Util/Util.php' );
        require_once ('Core/Config.php' );
        require_once ('Core/Security.php' );
        require_once ('Core/DB.php' );
        
        /* Verifica se o Usu�rio � Autenticado */
        Security::VerificaAutenticacao();

        Config::LoadController();
        
        /* Exibe a p�gina solicitada */
        Controller::ExecutaAcao();
    } else {
        throw new Exception('INDEX: N�o foi poss�vel carregar o arquivo de Configura��o.', 0001);
    }
} catch (Exception $e) {
    die('#' . $e->getCode() . ' : ' . $e->getMessage());
}
?>