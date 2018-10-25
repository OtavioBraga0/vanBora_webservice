<?php

    class Foto
    {
    
        public $Foto_lng_Codigo;
        public $Foto_vch_Url; 
        public $Foto_vch_Caption;
        public $Foto_dat_Data;
        public $Foto_lng_Posicao;
        public $Foto_vch_Informacao;

        /* Métodos mágicos GET e SET */
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
        
        /* Queries Dinamicas */
        private static $sOrdem  = 'Foto_lng_Posicao DESC';
        private static $iLimite = 0;
        private static $iInicio = 0;
        private static $mArrCampos = '';
        
        public static function setaFiltro($sArgCampo)
        {
            self::$mArrCampos['CONDICAO'][] = $sArgCampo;
        }

        public static function setaJoin($sArgJoin)
        {
            self::$mArrJoin['JOIN'][] = $sArgJoin;
        }

        public static function setaOrdem($sArgOrdem)
        {
            self::$sOrdem = $sArgOrdem;
        }

        public static final function setaLimite($iArgLimite, $iArgInicio = 0)
        {
            self::$iLimite = $iArgLimite;
            self::$iInicio = $iArgInicio;
        }
        
        public static function selectPorCodigo( $iCodigo )
        {
            $oConexao = DB::Conectar();

            $mResultado = $oConexao->prepare("SELECT *
                               FROM Foto
                               WHERE Foto_lng_Codigo = ".$iCodigo
                            );  

            $mResultado->execute();

            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
            if($mArrDados)
            {
                 /* Instancia o Objeto */
                $oFoto = new Foto;

                if (is_array($mArrDados))
                {  
                    $oFoto->Foto_lng_Codigo     = $mArrDados[0]['Foto_lng_Codigo'];
                    $oFoto->Foto_vch_Url        = $mArrDados[0]['Foto_vch_Url']; 
                    $oFoto->Foto_vch_Caption    = $mArrDados[0]['Foto_vch_Caption'];
                    $oFoto->Foto_dat_Data       = $mArrDados[0]['Foto_dat_Data'];
                    $oFoto->Foto_lng_Posicao    = $mArrDados[0]['Foto_lng_Posicao'];
                    $oFoto->Foto_vch_Informacao = $mArrDados[0]['Foto_vch_Informacao'];
                }

                return $oFoto;
            }
            else
            {
                return null;
            }
        }
        
        public static function select( )
        {
            $sFiltros = '';

            // Define os Filtros
            if (isset(self::$mArrCampos['CONDICAO']))
            {
                for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
                {
                    $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
                }
                //Limpa Filtros
                self::$mArrCampos['CONDICAO'] = '';
            }
            
            $oConexao = DB::Conectar();

            $mResultado = $oConexao->prepare("SELECT *
                               FROM Foto
                               WHERE 1 = 1 ".$sFiltros
                            );  

            $mResultado->execute();

            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
            if($mArrDados)
            {
                 /* Instancia o Objeto */
                $oFoto = new Foto;

                if (is_array($mArrDados))
                {  
                    $oFoto->Foto_lng_Codigo     = $mArrDados[0]['Foto_lng_Codigo'];
                    $oFoto->Foto_vch_Url        = $mArrDados[0]['Foto_vch_Url']; 
                    $oFoto->Foto_vch_Caption    = $mArrDados[0]['Foto_vch_Caption'];
                    $oFoto->Foto_dat_Data       = $mArrDados[0]['Foto_dat_Data'];
                    $oFoto->Foto_lng_Posicao    = $mArrDados[0]['Foto_lng_Posicao'];
                    $oFoto->Foto_vch_Informacao = $mArrDados[0]['Foto_vch_Informacao'];
                }

                return $oFoto;
            }
            else
            {
                return null;
            }
        }
        
        public static function selectAll( )
        {
            $oConexao = DB::Conectar();

            $sFiltros = '';

            // Define os Filtros
            if (isset(self::$mArrCampos['CONDICAO']))
            {
                for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
                {
                    $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
                }
                //Limpa Filtros
                self::$mArrCampos['CONDICAO'] = '';
            }

            $mResultado = $oConexao->prepare("SELECT *
                               FROM Foto
                               WHERE 1 = 1 ".$sFiltros." 
                               ORDER BY ".self::$sOrdem."
                             ");  

            $mResultado->execute();

            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

            /* Instancia o Objeto */
            $arrObj = array();
            
            if (!empty($mArrDados))
            { 
                for ($a = 0, $iCount = count($mArrDados); $a < $iCount; ++$a)
                {
                    $arr = array(
                        'Foto_lng_Codigo' => $mArrDados[$a]['Foto_lng_Codigo'],
                        'Foto_vch_Caption' => utf8_encode($mArrDados[$a]['Foto_vch_Caption']),
                        'Foto_vch_Url'  => 'http://'.$_SERVER['HTTP_HOST'].'/images/fotosAlbuns/'.$mArrDados[$a]['Foto_vch_Url']
                    );

                    $arrObj[] = $arr;
                }
                
                return $arrObj;
                
            } else {
                return NULL; 
            }
            
        }
        
        public static final function count( )
        {
            $oConexao = DB::Conectar();

            $sFiltros = '';

            // Define os Filtros
            if (isset(self::$mArrCampos['CONDICAO']))
            {
                for ($a = 0, $iCount = count(self::$mArrCampos['CONDICAO']); $a < $iCount; ++$a)
                {
                    $sFiltros .= (self::$mArrCampos['CONDICAO'][$a]);
                }
                
                self::$mArrCampos = "";
                
            }

            $mResultado = $oConexao->prepare("SELECT
                               count(*)
                               FROM Foto
                               WHERE 1 = 1 ".$sFiltros."                       
                             ");  
            
            $mResultado->execute();
            //echo $mResultado->queryString;
            
            if ($mResultado)
            {
                $iTotal = $mResultado->fetchColumn();
            }
            else
            {
                $iTotal = null;
            }
            

            return $iTotal;     
        }
    }
?>