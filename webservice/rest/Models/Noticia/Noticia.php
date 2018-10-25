<?php



    class Noticia

    {

    

        public $Noticia_lng_Codigo;

        public $Noticia_vch_Titulo; 

        public $Noticia_txt_Conteudo;

        public $Noticia_vch_UrlImagem;

        public $Noticia_dat_Cadastro;

        public $Noticia_vch_Resumo;

        public $Noticia_vch_Link;



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

        private static $sOrdem  = 'Artigo_lng_Codigo';

        private static $iLimite = 0;

        private static $iInicio = 0;

        private static $mArrCampos = '';

        private static $mArrJoin   = '';
        

        

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

                               FROM Artigo

                               WHERE Artigo_lng_Codigo = ".$iCodigo

                            );  



            $mResultado->execute();



            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

   

            if (!empty($mArrDados))

            { 

                $sUrlImagem = $mArrDados[0]['Artigo_vch_UrlImagem'];

                $sUrlImagemParsed = parse_url($sUrlImagem);

                if (empty($sUrlImagemParsed['scheme'])) {

                    $sUrlImagem =  'http://'.$_SERVER['HTTP_HOST'].'/'.ltrim($sUrlImagem, '/');

                }



                $arr = array(

                    'Noticia_lng_Codigo'    => $mArrDados[0]['Artigo_lng_Codigo'],

                    'Noticia_vch_Titulo'    => utf8_encode($mArrDados[0]['Artigo_vch_Titulo']),

                    'Noticia_vch_UrlImagem' => $sUrlImagem,

                    'Noticia_dat_Cadastro'  => date("d/m/Y", strtotime($mArrDados[0]['Artigo_dat_Cadastro'])),

                    'Noticia_vch_Resumo'    => utf8_encode($mArrDados[0]['Artigo_vch_Resumo']),

                    'Noticia_txt_Conteudo'  => utf8_encode($mArrDados[0]['Artigo_txt_Conteudo']),

					'Noticia_vch_Link'      => 'http://'.$_SERVER['HTTP_HOST'].'/artigo/'.$mArrDados[0]['Artigo_vch_Link'].'.html'

                );

                    

                return json_encode($arr);

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

                               FROM Artigo

                               WHERE 1 = 1 ".$sFiltros

                            );  



            $mResultado->execute();



            $mArrDados = $mResultado->fetchAll(PDO::FETCH_ASSOC);

   

            if (!empty($mArrDados))

            { 



                $arr = array(

                    'Noticia_lng_Codigo'    => $mArrDados[0]['Artigo_lng_Codigo'],

                    'Noticia_vch_Titulo'    => utf8_encode($mArrDados[0]['Artigo_vch_Titulo']),

                    'Noticia_txt_Conteudo'  => utf8_encode($mArrDados[0]['Artigo_txt_Conteudo']),

					'Noticia_vch_Link'      => 'http://'.$_SERVER['HTTP_HOST'].'/artigo/'.$mArrDados[0]['Artigo_vch_Link'].'.html'

                );

                    

                return json_encode($arr);

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
            $sJoin = '';
            $sLimite  = '';


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

            // Define os Joins
            if (isset(self::$mArrJoin['JOIN']))
            {
                if ( self::$mArrJoin['JOIN'] <> '' )
                {
                    for ($a = 0, $iCount = count(self::$mArrJoin['JOIN']); $a < $iCount; ++$a)
                    {
                        $sJoin .= (self::$mArrJoin['JOIN'][$a]);
                    }
                }
                //Limpa Filtros
                self::$mArrJoin['JOIN'] = '';
            }

            /* Define o Limite */

            if (self::$iLimite > 0)

            {

                $sLimite = (' LIMIT '.self::$iInicio.",".self::$iLimite);



                //Limpa Filtro

                self::$iInicio = 0;

                self::$iLimite = 0;

            }



            $mResultado = $oConexao->prepare("SELECT 

                                Artigo.Artigo_lng_Codigo,

                                Artigo.Artigo_vch_Titulo,

                                Artigo.Artigo_vch_UrlImagem,

								Artigo.Artigo_vch_Link,

                                (CASE WHEN Artigo_dat_Agenda IS NOT NULL THEN Artigo_dat_Agenda ELSE Artigo_dat_Cadastro END) AS Artigo_dat_Cadastro,

                                Artigo.Artigo_vch_Resumo
                                
                                FROM Artigo 
                                
                                ".$sJoin."

                                WHERE 1 = 1 ".$sFiltros." 

                                AND ( Artigo_dat_Agenda <= NOW() OR Artigo_dat_Agenda IS NULL) 

                                AND ( Artigo_chr_Ativo = 'S' OR Artigo_chr_Ativo IS NULL )

                                ORDER BY Artigo_dat_Cadastro DESC

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

                    $sUrlImagem = $mArrDados[$a]['Artigo_vch_UrlImagem'];

                    $sUrlImagemParsed = parse_url($sUrlImagem);

                    if (empty($sUrlImagemParsed['scheme'])) {

                        $sUrlImagem =  'http://'.$_SERVER['HTTP_HOST'].'/'.ltrim($sUrlImagem, '/');

                    }

                    

                    $arr = array(

                        'Noticia_lng_Codigo'    => $mArrDados[$a]['Artigo_lng_Codigo'],

                        'Noticia_vch_Titulo'    => $mArrDados[$a]['Artigo_vch_Titulo'],

                        'Noticia_vch_UrlImagem' => $sUrlImagem,

                        'Noticia_dat_Cadastro'  => date("d/m/Y", strtotime($mArrDados[$a]['Artigo_dat_Cadastro'])),

                        'Noticia_vch_Resumo'    => $mArrDados[$a]['Artigo_vch_Resumo'],

						'Noticia_vch_Link'      => 'http://'.$_SERVER['HTTP_HOST'].'/artigo/'.$mArrDados[$a]['Artigo_vch_Link'].'.html'

                    );

                    

                    $arrObj[] = $arr;

                }



                return json_encode($arrObj);

            } 

            else

            {

                return null;

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

                               FROM Artigo

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