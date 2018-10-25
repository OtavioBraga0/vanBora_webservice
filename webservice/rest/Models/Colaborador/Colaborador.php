<?php

    class Colaborador
    {

        public $Colaborador_lng_Codigo;
        public $Colaborador_vch_Nome; 
        public $Colaborador_vch_Endereco;
        public $Colaborador_lng_Numero;
        public $Colaborador_vch_Bairro;
        public $Colaborador_vch_Cidade;
        public $Colaborador_chr_Estado;
        public $Colaborador_vch_Telefone;
        public $Colaborador_vch_Email;
        public $Colaborador_chr_CPF;
        public $Colaborador_dat_DataNascimento;
        public $Colaborador_chr_CEP;
        public $Colaborador_chr_Sexo;
        public $Colaborador_vch_Complemento;
        public $Colaborador_dat_DataCadastro;
        public $Colaborador_bit_Campanha;
        public $Colaborador_vch_DDD;

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
        private static $sOrdem  = 'Colaborador_lng_Codigo';
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
                               FROM Colaborador
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
                               FROM Colaborador
                               WHERE Colaborador_lng_Codigo = ".$iCodigo
                            );  

            $mResultado->execute();
            
            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($mArrDados))
            { 

                $arr = array(
                    'Colaborador_lng_Codigo'         => $mArrDados[0]['Colaborador_lng_Codigo'],
                    'Colaborador_vch_Nome'           => utf8_encode($mArrDados[0]['Colaborador_vch_Nome']),
                    'Colaborador_vch_Endereco'       => utf8_encode($mArrDados[0]['Colaborador_vch_Endereco']),
                    'Colaborador_lng_Numero'         => utf8_encode($mArrDados[0]['Colaborador_lng_Numero']),
                    'Colaborador_vch_Bairro'         => utf8_encode($mArrDados[0]['Colaborador_vch_Bairro']),
                    'Colaborador_vch_Cidade'         => utf8_encode($mArrDados[0]['Colaborador_vch_Cidade']),
                    'Colaborador_chr_Estado'         => $mArrDados[0]['Colaborador_chr_Estado'],
                    'Colaborador_vch_Telefone'       => $mArrDados[0]['Colaborador_vch_Telefone'],
                    'Colaborador_vch_Email'          => $mArrDados[0]['Colaborador_vch_Email'],
                    'Colaborador_chr_CPF'            => $mArrDados[0]['Colaborador_chr_CPF'],
                    'Colaborador_dat_DataNascimento' => date("d/m/Y", strtotime($mArrDados[0]['Colaborador_dat_DataNascimento'])),
                    'Colaborador_chr_CEP'            => $mArrDados[0]['Colaborador_chr_CEP'],
                    'Colaborador_chr_Sexo'           => $mArrDados[0]['Colaborador_chr_Sexo'],
                    'Colaborador_vch_Complemento'    => utf8_encode($mArrDados[0]['Colaborador_vch_Complemento']),
                    'Colaborador_bit_Importado_Frs'  => $mArrDados[0]['Colaborador_bit_Importado_Frs'],
                    'Colaborador_dat_DataCadastro'   => date("d/m/Y", strtotime($mArrDados[0]['Colaborador_dat_DataCadastro'])),
                    'Colaborador_bit_Campanha'       => $mArrDados[0]['Colaborador_bit_Campanha'],
                    'Colaborador_vch_DDD'            => $mArrDados[0]['Colaborador_vch_DDD']
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
                               FROM Colaborador
                               WHERE 1 = 1 ".$sFiltros   
                            );  

            $mResultado->execute();
            
            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

            if (!empty($mArrDados))
            { 

                $arr = array(
                    'Colaborador_lng_Codigo'         => $mArrDados[0]['Colaborador_lng_Codigo'],
                    'Colaborador_vch_Nome'           => utf8_encode($mArrDados[0]['Colaborador_vch_Nome']),
                    'Colaborador_vch_Endereco'       => utf8_encode($mArrDados[0]['Colaborador_vch_Endereco']),
                    'Colaborador_lng_Numero'         => utf8_encode($mArrDados[0]['Colaborador_lng_Numero']),
                    'Colaborador_vch_Bairro'         => utf8_encode($mArrDados[0]['Colaborador_vch_Bairro']),
                    'Colaborador_vch_Cidade'         => utf8_encode($mArrDados[0]['Colaborador_vch_Cidade']),
                    'Colaborador_chr_Estado'         => $mArrDados[0]['Colaborador_chr_Estado'],
                    'Colaborador_vch_Telefone'       => $mArrDados[0]['Colaborador_vch_Telefone'],
                    'Colaborador_vch_Email'          => $mArrDados[0]['Colaborador_vch_Email'],
                    'Colaborador_chr_CPF'            => $mArrDados[0]['Colaborador_chr_CPF'],
                    'Colaborador_dat_DataNascimento' => date("d/m/Y", strtotime($mArrDados[0]['Colaborador_dat_DataNascimento'])),
                    'Colaborador_chr_CEP'            => $mArrDados[0]['Colaborador_chr_CEP'],
                    'Colaborador_chr_Sexo'           => $mArrDados[0]['Colaborador_chr_Sexo'],
                    'Colaborador_vch_Complemento'    => utf8_encode($mArrDados[0]['Colaborador_vch_Complemento']),
                    'Colaborador_bit_Importado_Frs'  => $mArrDados[0]['Colaborador_bit_Importado_Frs'],
                    'Colaborador_dat_DataCadastro'   => date("d/m/Y", strtotime($mArrDados[0]['Colaborador_dat_DataCadastro'])),
                    'Colaborador_bit_Campanha'       => $mArrDados[0]['Colaborador_bit_Campanha'],
                    'Colaborador_vch_DDD'            => $mArrDados[0]['Colaborador_vch_DDD']
                );

                return json_encode($arr);
            } 
            else
            {
                return null;
            }
        }

        public static function salvar( $oColaborador )
        {
            try 
            {
                $oConexao = db::conectar();
                $sSql = $oConexao->prepare("INSERT INTO Colaborador (
                        Colaborador_vch_Nome,
                        Colaborador_vch_Endereco,
                        Colaborador_lng_Numero,
                        Colaborador_vch_Bairro,
                        Colaborador_vch_Cidade,
                        Colaborador_chr_Estado,
                        Colaborador_vch_Telefone,
                        Colaborador_vch_Email,
                        Colaborador_chr_CPF,
                        Colaborador_dat_DataNascimento,
                        Colaborador_chr_CEP,
                        Colaborador_chr_Sexo,
                        Colaborador_vch_Complemento,
                        Colaborador_bit_Importado_Frs,
                        Colaborador_dat_DataCadastro,
                        Colaborador_bit_Campanha,
                        Colaborador_vch_DDD,
						Logradouro_lng_Codigo
                        ) VALUES ( ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,? )"); 

                $sSql->bindValue(1, ($oColaborador->Colaborador_vch_Nome));
                $sSql->bindValue(2, ($oColaborador->Colaborador_vch_Endereco));
                $sSql->bindValue(3, ($oColaborador->Colaborador_lng_Numero));
                $sSql->bindValue(4, ($oColaborador->Colaborador_vch_Bairro));
                $sSql->bindValue(5, ($oColaborador->Colaborador_vch_Cidade));
                $sSql->bindValue(6, ($oColaborador->Colaborador_chr_Estado));
                $sSql->bindValue(7, ($oColaborador->Colaborador_vch_Telefone));
                $sSql->bindValue(8, ($oColaborador->Colaborador_vch_Email));
                $sSql->bindValue(9, ($oColaborador->Colaborador_chr_CPF));
                $sSql->bindValue(10,($oColaborador->Colaborador_dat_DataNascimento));
                $sSql->bindValue(11,($oColaborador->Colaborador_chr_CEP));
                $sSql->bindValue(12,($oColaborador->Colaborador_chr_Sexo));
                $sSql->bindValue(13,($oColaborador->Colaborador_vch_Complemento));
                $sSql->bindValue(14,($oColaborador->Colaborador_bit_Importado_Frs));
                $sSql->bindValue(15,($oColaborador->Colaborador_dat_DataCadastro));
                $sSql->bindValue(16,($oColaborador->Colaborador_bit_Campanha));
                $sSql->bindValue(17,($oColaborador->Colaborador_vch_DDD));
				$sSql->bindValue(18,(209));
                
                $sSql->execute();
				return $oConexao->lastInsertId(); 
            } 
            catch (Exception $e) 
            {
				//var_dump($e);
                return false;
            }
        }

        public static function alteraDados($oArg)
        {
            $oColaborador = $oArg;
            try 
            {
                $oConexao = db::conectar();
                $sSql = $oConexao->prepare("UPDATE Colaborador SET
                        Colaborador_vch_DDD      = :Colaborador_vch_DDD,
                        Colaborador_vch_Telefone = :Colaborador_vch_Telefone,
                        Colaborador_vch_Nome     = :Colaborador_vch_Nome
                        WHERE Colaborador_lng_Codigo = :Colaborador_lng_Codigo"); 

                $sSql->bindParam(':Colaborador_vch_DDD',      ($oColaborador->Colaborador_vch_DDD));
                $sSql->bindParam(':Colaborador_vch_Telefone', ($oColaborador->Colaborador_vch_Telefone));
                $sSql->bindParam(':Colaborador_lng_Codigo',   ($oColaborador->Colaborador_lng_Codigo));
                $sSql->bindParam(':Colaborador_vch_Nome',     ($oColaborador->Colaborador_vch_Nome));
                
                return $sSql->execute();
            } 
            catch (Exception $e) 
            {
                //var_dump($e);
                return false;
            }
        }
    }
?>