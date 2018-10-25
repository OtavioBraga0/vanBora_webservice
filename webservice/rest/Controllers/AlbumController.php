<?php 

    Controller::carregaModel('Album/Album'); 
    Controller::carregaModel('Foto/Foto'); 

    class AlbumController
    {          
        public function Listar()
        { 
            $iPagina = (isset($_GET['p']) ? $_GET['p'] : 0);
            $iLimite = 10;
            $iInicio = 0;
            
            if ($iPagina > 1) {
                $iInicio = $iLimite * $iPagina;
            } 
            
			Album::setaFiltro(" AND Album_chr_Visivel = 'S' ");
            Album::setaOrdem('Album.Album_lng_Codigo DESC');
            Album::setaLimite($iLimite,$iInicio);
            
            echo Album::selectAll(); 
        }
        
        public function Detalhar()
        { 
            $iCodigo = $_GET['id'];
            echo Album::selectPorCodigo($iCodigo);
        }
        
    }
    
?>