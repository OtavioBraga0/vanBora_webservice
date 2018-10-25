<?php
 
class DB
{
    protected static $oConexao;

    private function __construct() 
    {
        try 
        {
            self::$oConexao = new PDO( "mysql:host=".CONFIG::HOST.";port=3306;dbname=".CONFIG::DB, CONFIG::USER, CONFIG::PSWD,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES latin1'));
            self::$oConexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //self::$oConexao->setAttribute( PDO::SQLSRV_ATTR_ENCODING, PDO::SQLSRV_ENCODING_SYSTEM );
        }
        catch (PDOException $e) 
        {
            echo "Erro de conexão: " . $e->getMessage();
        }
    }

    public static function Conectar() 
    {
        if (!self::$oConexao) 
        {
            new db();
        }
        return self::$oConexao;
    }
}
 
?>