<?php

class Config
{
    //Dados do Sistema
    const NOME_SITE = "Amex Assessoria - Marketing e Comunicação Integrada";
	const EMAIL_SITE = "contato@amexassessoria.com";
	const EMAIL_CAMPANHA = "";
	const NUMERO_CAMPANHA = "999";
	const NUMERO_CAMPANHA_DOACAO_ANONIMA = "998";
    const SITE_CODIGO = 1;

	const RECAPTCHA_PUBLIC_KEY  = "6Le3dO4SAAAAAHm7rPe64FSoocTg19KjwrCVEOBV ";
    const RECAPTCHA_PRIVATE_KEY = "6Le3dO4SAAAAAM-Ow3uDgXFXmzfaMnIFJ-u4_wdr";

    // Informa��es de Conex�o - DB MySQL
	const HOST = 'localhost';
    const USER = 'root';
    const PSWD = '';
    const DB   = 'vanbora';

    // const HOST = '192.168.15.25';
	// const USER = 'root';
	// const PSWD = 't1@m3x21';
	// const DB   = 'amex';


    //E-mails espiritualidade
    const EMAIL_TESTEMUNHO = '';
    const SENHA_EMAIL_TESTEMUNHO = '';
    const EMAIL_PEDIDODEORACAO = '';
    const SENHA_EMAIL_PEDIDOORACAO = '';

	// Configura��es de SMTP
    const SMTP_EMAIL = "contato@amexassessoria.com";
    const SMTP_HOST  = "smtp.intranet.amexassessoria.com";
    const SMTP_PWD   = "contato14**";

	const ISSUU_KEY    = "";
    const ISSUU_SECRET = "";
    const ISSUU_NAME   = "";

    /* Outras Configura��es */
	const QUANTIDADE_TESTEMUNHOS = 3;
    const NUMERO_VELAS = 6;
    const NUMERO_ALBUNS = 12;
    const NUMERO_PAGINAS_BUSCA = 9;
    const QUANTIDADE_ULTIMAS_NOTICIAS = 6;
    const QUANTIDADE_VIDEOS = 3;
    const QUANTIDADE_NUMERO_ALBUNS_TELA_INICIAL = 4;
	const NUMERO_PAGINAS_MULTIMIDIA = 12;
    const QUANTIDADE_NOTICIAS_CARROSSEL = 5;

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