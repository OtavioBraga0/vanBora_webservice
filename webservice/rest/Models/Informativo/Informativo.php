<?php

    class Informativo
    {
    
        public $Informativo_lng_Codigo;
        public $Informativo_vch_Titulo; 
        public $Informativo_vch_Url;
        public $Informativo_chr_Mes;
        public $Informativo_chr_Ano;
        public $Informativo_lng_Numero;
        public $Informativo_txt_Descricao;
        public $Informativo_vch_EmbedCode;
        public $Informativo_vch_IssuuLink;
        public $Informativo_vch_Capa;

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
        
        public static function selectUltimo( )
        {
            $arrParametrosIssuu = array(
                'access' => 'public',
                'action' => 'issuu.documents.list',
                'apiKey' => CONFIG::ISSUU_KEY,
                'documentSortBy' => 'publishDate',
                'publishDate' => 'public',
                'format' => 'json',
                'pageSize' => '1',
                'responseParams' => 'title,description,documentId,name',
                'resultOrder' => 'desc'
            );

            $arrInformativo = json_decode(file_get_contents(Util::geraAssinaturaIssuu($arrParametrosIssuu)));

            if (!empty($arrInformativo))
            { 

                $arr = array(
                    'Informativo_vch_Titulo'    => utf8_decode($arrInformativo->rsp->_content->result->_content[0]->document->title),
                    'Informativo_vch_Url'       => 'http://issuu.com/'.CONFIG::ISSUU_NAME.'/docs/'.$arrInformativo->rsp->_content->result->_content[0]->document->name,
                    'Informativo_txt_Descricao' => utf8_decode($arrInformativo->rsp->_content->result->_content[0]->document->description),
                    'Informativo_vch_Capa'      => 'http://image.issuu.com/'.$arrInformativo->rsp->_content->result->_content[0]->document->documentId.'/jpg/page_1_thumb_large.jpg'
                );
                    
                return json_encode($arr);
            } 
            else
            {
                return null;
            }
        }
    }
?>