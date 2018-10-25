<?php

    class Album
    {
    
        public $Album_lng_Codigo;
        public $Album_vch_Titulo; 
        public $Foto_lng_Codigo;
        public $Album_chr_Visivel;
        public $Album_vch_Credito;

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
        private static $sOrdem  = 'Album_lng_Codigo';
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
                               FROM Album
                               WHERE Album_lng_Codigo = ".$iCodigo
                            );  

            $mResultado->execute();

            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($mArrDados))
            { 

                Foto::setaFiltro(" AND Album_lng_Codigo = ".$mArrDados[0]['Album_lng_Codigo']);
                $arrFoto = Foto::selectAll();
                    
                $arr = array(
                    'Album_lng_Codigo' => $mArrDados[0]['Album_lng_Codigo'],
                    'Album_vch_Titulo' => utf8_encode($mArrDados[0]['Album_vch_Titulo']),
                    'Foto' => $arrFoto
                );
                
                return json_encode($arr);
                
            } else {
                return NULL; 
            }
        }
        
        public static function selectAll( )
        {
            $oConexao = DB::Conectar();

            $sFiltros = '';
            
            /* Define o Limite */
            if (self::$iLimite > 0)
            {
                $sLimite = (' LIMIT '.self::$iInicio.",".self::$iLimite);

                //Limpa Filtro
                self::$iInicio = 0;
                self::$iLimite = 0;
            }

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

            $mResultado = $oConexao->prepare("SELECT 
                                Album.Album_lng_Codigo,
                                Album_vch_Titulo,
                                Album_chr_Visivel,
                                Foto_vch_Url
                                FROM Album
                                LEFT JOIN Foto ON ( Album.Foto_lng_Codigo = Foto.Foto_lng_Codigo )
                                WHERE 1 = 1 ".$sFiltros." 
                                 ORDER BY ".self::$sOrdem."
                                ".$sLimite."
                             ");  

            $mResultado->execute();

            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

            /* Instancia o Objeto */
            $arrObj = array();
            
            if (!empty($mArrDados))
            { 
                for ($a = 0, $iCount = count($mArrDados); $a < $iCount; ++$a)
                {
                    $sCapa = $mArrDados[$a]['Foto_vch_Url'];
                    
                    if ($sCapa == NULL) {
                        
                        Foto::setaFiltro(' AND Album_lng_Codigo = '.$mArrDados[$a]['Album_lng_Codigo']);
                        $oFoto = Foto::select();
                        $sCapa= $oFoto->Foto_vch_Url;
                    }
                    
                    $arr = array(
                        'Album_lng_Codigo' => $mArrDados[$a]['Album_lng_Codigo'],
                        'Album_vch_Titulo' => utf8_encode($mArrDados[$a]['Album_vch_Titulo']),
                        'Album_vch_Thumb'  => 'http://'.$_SERVER['HTTP_HOST'].'/images/fotosAlbuns/'.$sCapa
                    );

                    $arrObj[] = $arr;
                }
                
                return json_encode($arrObj);
                
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
                               FROM Album
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