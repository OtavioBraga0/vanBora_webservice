<?php

class Controller {

    private static $sController = '';
    private static $sControllerNome = '';
    private static $sAcao = '';
    private static $sVariaveisTemplate = array(); 

    public final static function CarregaModel($sArgModelName) {
        try {
            if (file_exists('Models/' . $sArgModelName . '.php')) {
                include_once ( 'Models/' . $sArgModelName . '.php' );
            } else {
                throw new Exception('CONTROLLER: Arquivo da model (' . $sArgModelName . ') não foi encontrada.', 2000);
            }
        } catch (Exception $e) {
            die('#' . $e->getCode() . ' : ' . $e->getMessage());
        }
    }
    
    public final static function CarregaArquivo($sArgArquivoCaminho) {
        
        try {
            if (file_exists( $sArgArquivoCaminho . '.php')) {
                include_once ( $sArgArquivoCaminho . '.php' );
            } else {
                throw new Exception('CONTROLLER: Arquivo (' . $sArgArquivoCaminho . ') não foi encontrado.', 2000);
            }
        } catch (Exception $e) {
            die('#' . $e->getCode() . ' : ' . $e->getMessage());
        }
    }

    public final static function ExecutaAcao() {

        if (isset($_GET['c']) && !empty($_GET['c'])) {
            self::$sController = $_GET['c'];
            self::$sControllerNome = $_GET['c'] . 'Controller';
        }

        if (isset($_GET['a']) && !empty($_GET['a'])) {
            self::$sAcao = $_GET['a'];
        }

        try {
            if (file_exists('Controllers/' . self::$sController . 'Controller.php')) {
                include_once ( 'Controllers/' . self::$sController . 'Controller.php' );

                if (trim(self::$sAcao) !== "") {
                    if (method_exists(self::$sControllerNome, self::$sAcao)) {

                        $sAcaoExecutar = self::$sAcao;

                        $oController = new self::$sControllerNome;
                        $oController->$sAcaoExecutar();
                    } else {
                        throw new Exception('CONTROLLER: Método (' . self::$sAcao . ') não foi encontrado.', 2002);
                    }
                }
            } else {
                throw new Exception('CONTROLLER: Arquivo do Controller (' . self::$sController . ') não foi encontrado.', 2002);
            }
            
        } catch (Exception $e) {
            die('#' . $e->getCode() . ' : ' . $e->getMessage());
        }
    }
    
    public final static function SetaVariavelTemplate($sVariavel, $mValor) {
        self::$sVariaveisTemplate[] = array("variavel" => $sVariavel, "valor" => $mValor);
    }

}

?>