<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type");
    header("Content-Type: application/json");
    
    #LC_ALL converte todas as definicoes do php para portugues inclusive a moeda
	setlocale(LC_ALL, "ptb");
    date_default_timezone_set("America/Sao_paulo");

	error_reporting( E_ALL  ^ E_STRICT);


	// ini_set( 'display_errors', '1' );

	// error_reporting(0);

	ini_set('post_max_size', '640M');
	ini_set('upload_max_filesize', '640M');

    /* Codificao Padrao */
    ini_set('default_charset', 'UTF-8');
    ini_set('max_execution_time', 300); //300 seconds = 5 minutes

    /* Inicializa SESSIONs */
    session_start();

    /* Define os Caminhos Absolutos */
    define ( 'PATH_SISTEMA', 'faculdade/vanBora' );
    define ( 'PATH_FW',      'framework' );
    define ( 'PATH_ABS',     dirname ( __FILE__ ) . '\\' );
    define ( 'PATH_WWW',     'http://' . $_SERVER['HTTP_HOST'] .'/'.PATH_SISTEMA.'/');

    /* Adiciona Classe de Configuracao */
    try
    {
        if ( file_exists (  PATH_FW . '/config/config.class.php' ) )
        {
            require_once (  PATH_FW . '/config/config.class.php' );

            Config::loadConfig ();
            Config::loadController ();

             /* Inicializa Bibliotecas / Configuracoes */
             Controller::loadClass ( 'smarty/Smarty' );
             Controller::loadClass ( 'core/security' );
             Controller::loadClass ( 'core/template' );
             Controller::loadClass ( 'core/login' );
             Controller::loadClass ( 'core/util' );
             Controller::loadClass ( 'core/db' );

             if ( isset ( $_GET['pagina'] ) )
             {
                $arrUrl = explode('/', $_GET['pagina']);

                if ( $arrUrl[0] == 'centraldecontrole' )
                {
                    /* Verifica se o Usuario é Autenticado */
                    Login::verificaAutenticacao();
                }
             }

             /* Exibe a pagina solicitada */
             Controller::exibePagina();

        }
        else
        {
            throw new Exception( 'INDEX:Não foi possível carregar o arquivo de Configuração.', 0001 );
        }
    }
    catch ( Exception $e )
    {
        die ( '#' . $e->getCode() . ' : ' . $e->getMessage() );
    }




?>