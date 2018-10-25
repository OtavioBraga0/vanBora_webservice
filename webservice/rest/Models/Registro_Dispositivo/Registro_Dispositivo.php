<?php

    class Registro_Dispositivo
    {
    
        public $Registro_Dispositivo_lng_Codigo;
        public $Registro_Dispositivo_vch_ID; 
        public $Registro_Dispositivo_dat_Data;
        public $Registro_Dispositivo_vch_Plataforma;
        public $Registro_Dispositivo_bit_Ativo;
        public $Registro_Dispositivo_vch_Nome;
        public $Registro_Dispositivo_vch_Email;
        public $Registro_Dispositivo_vch_Versao;

        /* M�todos m�gicos GET e SET */
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
        private static $sOrdem  = 'Registro_Dispositivo_lng_Codigo';
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
                               FROM Registro_Dispositivo
                               WHERE Registro_Dispositivo_lng_Codigo = ".$iCodigo
                            );  

            $mResultado->execute();

            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
            
            if (!empty($mArrDados))
            { 
                    
                $arr = array(
                    'Registro_Dispositivo_lng_Codigo' => $mArrDados[0]['Registro_Dispositivo_lng_Codigo'],
                    'Registro_Dispositivo_vch_ID' => utf8_encode($mArrDados[0]['Registro_Dispositivo_vch_ID'])
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
            $sLimite = '';
            
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

            $mResultado = $oConexao->prepare("SELECT *
                                FROM Registro_Dispositivo
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
                    
                    $arr = array(
                        'Registro_Dispositivo_lng_Codigo' => $mArrDados[$a]['Registro_Dispositivo_lng_Codigo'],
                        'Registro_Dispositivo_vch_ID' => Util::encrypt(utf8_encode($mArrDados[$a]['Registro_Dispositivo_vch_ID'])),
                        'Registro_Dispositivo_vch_Plataforma' => utf8_encode($mArrDados[$a]['Registro_Dispositivo_vch_Plataforma']),
                        'Registro_Dispositivo_vch_Versao' => utf8_encode($mArrDados[$a]['Registro_Dispositivo_vch_Versao'])
                    );

                    $arrObj[] = $arr;
                }
                
                return json_encode($arrObj);
                
            } else {
                return NULL; 
            }
        }

        public static function selectAllID()
        {

            $oConexao = DB::Conectar();
            
            $sFiltros = '';
            $sLimite = '';
            
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

            $mResultado = $oConexao->prepare("SELECT Registro_Dispositivo_vch_ID
                                FROM Registro_Dispositivo
                                WHERE 1 = 1 ".$sFiltros." 
                                 ORDER BY ".self::$sOrdem."
                                ".$sLimite."
                             ");  
            $mResultado->execute();

            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);
            
            /* Instancia o Objeto */        
            $arrId = array();

            if (!empty($mArrDados))
            { 
                for ($a = 0, $iCount = count($mArrDados); $a < $iCount; ++$a)
                {
                    $arrId[] = $mArrDados[$a]['Registro_Dispositivo_vch_ID'];
                }
                
                return json_encode($arrId);
                
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
                               FROM Registro_Dispositivo
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

        public static function salvar( $oRegistro_Dispositivo )
        {
            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("INSERT INTO Registro_Dispositivo (
                            Registro_Dispositivo_vch_ID,
                            Registro_Dispositivo_dat_Data,
                            Registro_Dispositivo_vch_Plataforma,
                            Registro_Dispositivo_vch_Versao
                            ) VALUES ( ?,?,?,? )"); 

                $sSql->bindValue(1, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_ID));
				$sSql->bindValue(2, ($oRegistro_Dispositivo->Registro_Dispositivo_dat_Data));
                $sSql->bindValue(3, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_Plataforma));
                $sSql->bindValue(4, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_Versao));
                
                return $sSql->execute();

            } 
            catch (Exception $e) 
            {
                return false;
            }
        }

        public static function alterar( $oRegistro_Dispositivo )
        {
            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("UPDATE Registro_Dispositivo SET
                            Registro_Dispositivo_vch_Nome = ?,
                            Registro_Dispositivo_vch_Email = ?,
                            Registro_Dispositivo_bit_Ativo = ?,
                            Registro_Dispositivo_bit_Registrado = 1                            
                            WHERE Registro_Dispositivo_vch_ID  = ?"); 

                $sSql->bindValue(1, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_Nome));
                $sSql->bindValue(2, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_Email));
                $sSql->bindValue(3, ($oRegistro_Dispositivo->Registro_Dispositivo_bit_Ativo));
                $sSql->bindValue(4, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_ID));
                
                return $sSql->execute();

            } 
            catch (Exception $e) 
            {
                return false;
            }
        }

        public static function alterarDataVersao( $oRegistro_Dispositivo )
        {
            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("UPDATE Registro_Dispositivo SET
                            Registro_Dispositivo_dat_Data = ?,
                            Registro_Dispositivo_vch_Versao = ?
                            WHERE Registro_Dispositivo_vch_ID  = ?"); 

                $sSql->bindValue(1, ($oRegistro_Dispositivo->Registro_Dispositivo_dat_Data));
                $sSql->bindValue(2, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_Versao));
                $sSql->bindValue(3, ($oRegistro_Dispositivo->Registro_Dispositivo_vch_ID));
                
                return $sSql->execute();

            } 
            catch (Exception $e) 
            {
                return false;
            }
        }

        public static function desativar($iId)
        {
            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("UPDATE Registro_Dispositivo SET
                            Registro_Dispositivo_bit_Ativo = 0,
                            Registro_Dispositivo_bit_Registrado = 0                            
                            WHERE Registro_Dispositivo_vch_ID  = ?"); 

                $sSql->bindValue(1, ($iId));
                return $sSql->execute();

            } 
            catch (Exception $e) 
            {
                return false;
            }
        }

        public static function naoRegistrado($iId)
        {
            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("UPDATE Registro_Dispositivo SET
                            Registro_Dispositivo_bit_Registrado = 0                            
                            WHERE Registro_Dispositivo_vch_ID  = ?"); 

                $sSql->bindValue(1, ($iId));
                return $sSql->execute();

            } 
            catch (Exception $e) 
            {
                return false;
            }
        }

        public static function ativar($iId)
        {
            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("UPDATE Registro_Dispositivo SET
                            Registro_Dispositivo_bit_Ativo = 1,
                            Registro_Dispositivo_bit_Registrado = 1
                            WHERE Registro_Dispositivo_vch_ID  = ?"); 

                $sSql->bindValue(1, ($iId));
                return $sSql->execute();

            } 
            catch (Exception $e) 
            {
                return false;
            }
        }

        public static function ativo( $iCodigo )
        {
            $oConexao = DB::Conectar();

            $mResultado = $oConexao->prepare("SELECT Registro_Dispositivo_bit_Ativo
                               FROM Registro_Dispositivo
                               WHERE Registro_Dispositivo_vch_ID = '".$iCodigo."'"
                            );  

            $mResultado->execute();
            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($mArrDados))
            {
                if ($mArrDados[0]['Registro_Dispositivo_bit_Ativo'] == 0) {
                    return 0;
                } else {
                    return 1;
                }

            } else {
                return 0; 
            }

        }

    }

?>