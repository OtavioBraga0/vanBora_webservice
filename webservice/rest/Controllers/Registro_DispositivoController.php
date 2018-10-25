<?php 

    Controller::carregaModel('Registro_Dispositivo/Registro_Dispositivo'); 

    class Registro_DispositivoController
    {      

        public function Salvar()
        {

            $sID = $_POST['id'];
            $sVersao = (isset($_POST['versao']) ? $_POST['versao'] : NULL);

            Registro_Dispositivo::setaFiltro(" AND Registro_Dispositivo_vch_ID = '".$sID."'");
            $iTotalRegistros = Registro_Dispositivo::count();

            $oRegistro_Dispositivo = new Registro_Dispositivo();
            $oRegistro_Dispositivo->Registro_Dispositivo_vch_ID = $sID;
            $oRegistro_Dispositivo->Registro_Dispositivo_vch_Versao = $sVersao;
            $oRegistro_Dispositivo->Registro_Dispositivo_dat_Data = date("Y-m-d H:i:s");
            $oRegistro_Dispositivo->Registro_Dispositivo_bit_Ativo = 1;
            $oRegistro_Dispositivo->Registro_Dispositivo_vch_Plataforma = $_POST['plataforma'];

            if ($iTotalRegistros == 0) {

                $mRetorno = Registro_Dispositivo::salvar($oRegistro_Dispositivo);

                if ($mRetorno) {
                    echo true;
                } else {
                    echo false;
                }

            } else {

                $mRetorno = Registro_Dispositivo::alterarDataVersao($oRegistro_Dispositivo);

                if ($mRetorno) {
                    echo true;
                } else {
                    echo false;
                }
            }
        }
		
		public function Alterar()
        {
            $bRetorno = false;

			$oRegistro_Dispositivo = new Registro_Dispositivo();
            $oRegistro_Dispositivo->Registro_Dispositivo_vch_ID    = $_POST['id'];
            $oRegistro_Dispositivo->Registro_Dispositivo_vch_Nome  = $_POST['nome'];
            $oRegistro_Dispositivo->Registro_Dispositivo_vch_Email = $_POST['email'];
            //$oRegistro_Dispositivo->Registro_Dispositivo_bit_Ativo = $_POST['notificacoes'];
            $oRegistro_Dispositivo->Registro_Dispositivo_bit_Ativo = 1;

            $mRetorno = Registro_Dispositivo::alterar($oRegistro_Dispositivo);    
            
            if ($mRetorno) {
                $bRetorno = true;
            } else {
                $bRetorno = false;
            }

			echo json_encode($bRetorno);
        }

        public function Listar()
        {   
            $sPlatform = "";
            // $idTeste = "cnp1GesD07U:APA91bGtmCwjScQ3bhHeUC8Wv93mVWP1L8PYtKNh7bDviWPQCya4m0sFmofiug0ujm9KFEvsd4LJbtoewnXu-keU7h62dUOO3FcwEu8ji6NGs45iaLjd49CFja-zqEbLulX3gipmNFwk";
            // $idTeste1 = "fd5XKY_GWy0:APA91bFMD9z-fvAz_BMUJMO4aX4XTH6HnvyL4BAe-wfDQhpYXsHCPFatCdXFMBA7t402-tFUib8ZuTfjoQVn4_OoGUvPu7ApWWytgAShID5pu3uUpfR3I0R-7XJRv_NQk2Waqhx2zT2J";
            // $idTeste2 = "eS8TJNzFS7Q:APA91bFiYS6pX061URBC_ZuzjXNxLf33FOz8qzJxns2oCiTuPldoyvj57bmpk_P_UAUOOI56Qu2VrjIVPZEyrHNPt__34Znq0WQdG1mrsqC1_w0rjE5-72e9KgJpwWp37ic_acRseaAJ";
            // Registro_Dispositivo::setaFiltro(" AND Registro_Dispositivo_bit_Registrado = 1 AND Registro_Dispositivo_bit_Ativo = 1");
            
            if (isset($_GET['min_version']))
                Registro_Dispositivo::setaFiltro(" AND Registro_Dispositivo_vch_Versao >= '".$_GET['min_version']."'");
                

            if (isset($_GET['platform']))
                $sPlatform = $_GET['platform'];

            if ($sPlatform !== "")                
                Registro_Dispositivo::setaFiltro(" AND Registro_Dispositivo_vch_Plataforma = '".$sPlatform."'");

            // Registro_Dispositivo::setaFiltro(" AND Registro_Dispositivo_vch_ID = '".$idTeste."'");
            // Registro_Dispositivo::setaFiltro(" OR Registro_Dispositivo_vch_ID = '".$idTeste1."'");
            // Registro_Dispositivo::setaFiltro(" OR Registro_Dispositivo_vch_ID = '".$idTeste2."'");
            
            
            //Registro_Dispositivo::setaFiltro(" AND ((Registro_Dispositivo_bit_Ativo IS NULL) OR (Registro_Dispositivo_bit_Ativo = 1))");
            
            echo Registro_Dispositivo::selectAllID();
        }
        
        public function Desativar()
        {            
            $iId = $_GET['id'];
            echo Registro_Dispositivo::desativar($iId);
        }

        public function Deletar()
        {            
            $iId = $_GET['id'];
            echo Registro_Dispositivo::deletar($iId);
        }

        public function Ativar()
        {            
            $iId = $_GET['id'];
            echo Registro_Dispositivo::ativar($iId);
        }

        public function Ativo()
        {             
            $iId = $_GET['id'];
            echo Registro_Dispositivo::ativo($iId);
        }

        public function NaoRegistrado()
        {
            $iId = $_GET['id'];
            echo Registro_Dispositivo::naoRegistrado($iId);
        }

    }

?>