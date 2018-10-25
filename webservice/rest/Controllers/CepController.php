<?php 

    Controller::carregaArquivo('Util/Nusoap'); 

    class CepController
    {          
        public function Detalhar()
        { 
            // Cria uma instância do cliente
            $oClient = new nusoap_client('http://webservice.amexassessoria.com/cep.php?wsdl', true);

            // verifica se ocorreu erro na criação do objeto
            $sErro = $oClient->getError(); 

            if ($sErro)
            {
                echo "Erro no construtor<pre>".$sErro."</pre>";
            }

            // chamada do método SOAP
            $mArrDados = $oClient->call ( 'consultaCEP',array( $_GET['cep'],'ame%@1' ) ); 

            // Verifica se ocorreu falha na chamada do método
            if ($oClient->fault)
            {
                    echo "Falha<pre>".print_r($mArrDados)."</pre>";
            }
            else
            {
                // Verifica se ocorreu erro
                $err = $oClient->getError();

                if ($err)
                {
                    echo "Erro<pre>".$err."</pre>";
                } 
                else
                {
                    echo json_encode( $mArrDados );
                }
            }
        }
    }
    
?>