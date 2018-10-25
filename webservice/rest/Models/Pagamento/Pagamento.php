<?php

    class Pagamento
    {

        public $Pagamento_lng_Codigo;
        public $Pagamento_vch_Forma; 
        public $Pagamento_vch_Valor;
        public $Pagamento_lng_Status;
        public $Colaborador_lng_Codigo;
        public $Pagamento_dat_Cadastro;
        public $Pagamento_dat_Modificacao;

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
        private static $sOrdem  = 'Pagamento_lng_Codigo';
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
                               FROM Pagamento
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

        public static function selectPorCodigo( $iCodigo )
        {
            $oConexao = DB::Conectar();

            $mResultado = $oConexao->prepare("SELECT *
                               FROM Pagamento
                               WHERE Pagamento_lng_Codigo = ".$iCodigo
                            );  

            $mResultado->execute();
            
            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($mArrDados))
            { 

                $arr = array(
                    'Pagamento_lng_Codigo'   => $mArrDados[0]['Pagamento_lng_Codigo'],
                    'Pagamento_vch_Forma'    => $mArrDados[0]['Pagamento_vch_Forma'],
                    'Pagamento_vch_Valor'    => $mArrDados[0]['Pagamento_vch_Valor'],
                    'Pagamento_lng_Status'   => $mArrDados[0]['Pagamento_lng_Status'],
                    'Colaborador_lng_Codigo' => $mArrDados[0]['Colaborador_lng_Codigo']
                );

                return json_encode($arr);
            } 
            else
            {
                return null;
            }
        }

        public static function select()
        {

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

            $oConexao = DB::Conectar();

            $mResultado = $oConexao->prepare("SELECT *
                               FROM Pagamento
                               WHERE 1 = 1 ".$sFiltros   
                            );  

            $mResultado->execute();
            
            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($mArrDados))
            { 

                $arr = array(
                    'Pagamento_lng_Codigo'   => $mArrDados[0]['Pagamento_lng_Codigo'],
                    'Pagamento_vch_Forma'    => $mArrDados[0]['Pagamento_vch_Forma'],
                    'Pagamento_vch_Valor'    => $mArrDados[0]['Pagamento_vch_Valor'],
                    'Pagamento_lng_Status'   => $mArrDados[0]['Pagamento_lng_Status'],
                    'Colaborador_lng_Codigo' => $mArrDados[0]['Colaborador_lng_Codigo']
                );

                return json_encode($arr);
            } 
            else
            {
                return null;
            }
        }

        public static function salvar( $oPagamento )
        {

            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("INSERT INTO Pagamento (
                        Pagamento_vch_Forma,
                        Pagamento_vch_Valor,
                        Pagamento_lng_Status,
                        Colaborador_lng_Codigo,
                        Pagamento_dat_Cadastro
                        ) VALUES ( ?,?,?,?,? )"); 

                $sSql->bindValue(1, ($oPagamento->Pagamento_vch_Forma));
                $sSql->bindValue(2, ($oPagamento->Pagamento_vch_Valor));
                $sSql->bindValue(3, ($oPagamento->Pagamento_lng_Status));
                $sSql->bindValue(4, ($oPagamento->Colaborador_lng_Codigo));
                $sSql->bindValue(5, ($oPagamento->Pagamento_dat_Cadastro));
                
                $sSql->execute();
                return $oConexao->lastInsertId(); 
            } 
            catch (Exception $e) 
            {
                return false;
            }
        }

        public static function alteraStatus( $oPagamento )
        {

            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("UPDATE Pagamento SET
                    Pagamento_lng_Status = ?,
                    Pagamento_dat_Modificacao = ?
                    WHERE Pagamento_lng_Codigo  = ?"); ; 

                $sSql->bindValue(1, ($oPagamento->Pagamento_lng_Status));
                $sSql->bindValue(2, ($oPagamento->Pagamento_dat_Modificacao));
                $sSql->bindValue(3, ($oPagamento->Pagamento_lng_Codigo));
                
                return $sSql->execute();
            } 
            catch (Exception $e) 
            {
                return false;
            }
        }


    }
?>