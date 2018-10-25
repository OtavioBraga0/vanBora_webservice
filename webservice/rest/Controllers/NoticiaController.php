<?php 

    Controller::carregaModel('Noticia/Noticia'); 
    
    class NoticiaController
    {      
        
        public function Listar()
        {
            $iPagina = (isset($_GET['p']) ? $_GET['p'] : 0);
            $iLimite = 10;
            $iInicio = 0;
            
            if ($iPagina > 1) {
                $iInicio = $iLimite * $iPagina;
            } 
            
            Noticia::setaFiltro(" AND Tipo_lng_Codigo = 1 ");
            Noticia::setaLimite($iLimite,$iInicio);
            
            echo Noticia::selectAll();
            
        }

        public function ListarPorTag()
        {
            $iCodigoTag = $_POST['tag'];

            Noticia::setaJoin("INNER JOIN Art_tag ON Artigo.Artigo_lng_Codigo = Art_tag.Artigo_lng_Codigo ");
            Noticia::setaLimite(3);
            Noticia::setaFiltro(" AND  ( Art_tag.Tag_lng_Codigo = " . $iCodigoTag . ") ");

            echo Noticia::selectAll();
        }
        
        public function Detalhar()
        {            
            $iCodigo = $_GET['id'];
            echo Noticia::selectPorCodigo($iCodigo);
        }
        
        public function SantoDoDia()
        {            
            Noticia::setaFiltro(" AND Tipo_lng_Codigo = 5 ");
            Noticia::setaFiltro(" AND ( Artigo_chr_Dia = ".date('d')." AND Artigo_chr_Mes = ".date('m')." )");
            echo Noticia::select();
        }

        public function EvangelhoDoDia()
        {            
            Controller::CarregaArquivo('Util/Dom'); 

            $sUrl = "http://liturgiadiaria.cnbb.org.br/app/user/user/UserView.php?ano=".date("Y")."&mes=".date("n")."&dia=".date("j");
            $html = file_get_html($sUrl);
            $sLeituras = $html->find('#corpo_leituras',0);
            $sConteudo = $sLeituras->outertext;

            echo utf8_decode($sConteudo);

        }
       
    }
?>