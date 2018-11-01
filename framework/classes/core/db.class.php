<?php

class db
{
    protected static $oConexao;

    private function __construct()
    {
        try
        {
            self::$oConexao = new PDO( "mysql:host=".CONFIG::HOST.";port=3306;dbname=".CONFIG::DB, CONFIG::USER, CONFIG::PSWD);
        }
        catch (PDOException $e)
        {
            echo "Erro de conex�o: " . $e->getMessage();
			echo PDO::errorInfo;
        }
	}

    public static function conectar()
    {
        if (!self::$oConexao)
        {
            new db();
        }
        return self::$oConexao;
    }
}

?>