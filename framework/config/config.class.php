<?php

class Config
{
    //Dados do Sistema
    const NOME_SITE = "API - VanBora";
	const EMAIL_SITE = "zenithdevteam0@gmail.com";

    // Informa��es de Conex�o - DB MySQL
	const HOST = 'us-cdbr-iron-east-01.cleardb.net';
    const USER = 'b026d32be5d880';
    const PSWD = 'bf108166';
    const DB   = 'heroku_00fb156f7be6116';

    // const HOST = 'us-cdbr-iron-east-01.cleardb.net';
	// const USER = 'b026d32be5d880';
	// const PSWD = 'bf108166';
	// const DB   = 'heroku_00fb156f7be6116';


    private final function __construct()
    {

    }

    private final function __clone()
    {

    }

    private final function __wakeup()
    {

    }

    public static final function loadConfig()
    {
        /* Carrega Configura��es Padr�es se Forem Necess�rias */

    }

    public static final function loadController()
    {
        try
        {
            if (file_exists( PATH_FW .'/classes/core/controller.class.php'))
            {
                include_once (  PATH_FW .'/classes/core/controller.class.php' );
            }
            else
            {
                throw new Exception('CONFIG:Arquivo do Controller n&#227;o encontrado.', 1000);
            }
        }
        catch (Exception $e)
        {
            die('#' . $e->getCode() . ' : ' . $e->getMessage());
        }
    }

}

?>