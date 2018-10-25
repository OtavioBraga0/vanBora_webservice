<?php

    class Pedido
    {
    
        public $Pedido_lng_Codigo;
        public $Pedido_vch_Nome; 
        public $Pedido_vch_Email;
        public $Pedido_chr_Estado;
        public $Pedido_vch_Cidade;
        public $Pedido_txt_Intencao;
        public $Pedido_chr_ExibirIntencao;
        public $Pedido_dat_Data;
        public $Pedido_chr_Tipo;
        public $Pedido_chr_Aprovado;
        public $Pedido_chr_Respondido;
        public $Pedido_vch_UrlImagem;

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
        private static $sOrdem  = 'Artigo_lng_Codigo';
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
        
        public static function salvar( $oPedido )
        {
            try 
            {
                $oConexao = db::conectar();

                $sSql = $oConexao->prepare("INSERT INTO Pedido (
                            Pedido_vch_Nome,
                            Pedido_vch_Email,
                            Pedido_chr_Estado,
                            Pedido_vch_Cidade,
                            Pedido_txt_Intencao,
                            Pedido_chr_ExibirIntencao,
                            Pedido_dat_Data,
                            Pedido_chr_Tipo,
                            Pedido_chr_Aprovado,
                            Pedido_chr_Respondido,
                            Pedido_vch_UrlImagem
                            ) VALUES ( ?,?,?,?,?,?,?,?,?,?,? )"); 

                $sSql->bindValue(1, ($oPedido->Pedido_vch_Nome));
                $sSql->bindValue(2, ($oPedido->Pedido_vch_Email));
                $sSql->bindValue(3, ($oPedido->Pedido_chr_Estado));
                $sSql->bindValue(4, ($oPedido->Pedido_vch_Cidade));
                $sSql->bindValue(5, ($oPedido->Pedido_txt_Intencao));
                $sSql->bindValue(6, ($oPedido->Pedido_chr_ExibirIntencao));
                $sSql->bindValue(7, ($oPedido->Pedido_dat_Data));
                $sSql->bindValue(8, ($oPedido->Pedido_chr_Tipo));
                $sSql->bindValue(9, ($oPedido->Pedido_chr_Aprovado));
                $sSql->bindValue(10,($oPedido->Pedido_chr_Respondido));
                $sSql->bindValue(11,($oPedido->Pedido_vch_UrlImagem));
                
                return $sSql->execute();

            } 
            catch (Exception $e) 
            {
                return false;
            }
        }
    }
?>