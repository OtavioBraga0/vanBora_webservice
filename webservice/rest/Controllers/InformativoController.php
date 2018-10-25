<?php 

    Controller::carregaModel('Informativo/Informativo'); 

    class InformativoController
    {      
        public function DetalharDoMes()
        {            
            echo Informativo::selectUltimo();
        }
    }

?>