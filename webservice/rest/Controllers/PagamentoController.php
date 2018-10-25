<?php 

    Controller::carregaModel('Pagamento/Pagamento'); 

    class PagamentoController
    {      
        public function GeraSession()
        { 
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL,Config::PAGSEGURO_URL."/v2/sessions");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                        "email=".Config::PAGSEGURO_EMAIL."&token=".Config::PAGSEGURO_TOKEN);
						
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			/*curl_setopt($ch, CURLOPT_URL,"https://ws.sandbox.pagseguro.uol.com.br/v2/sessions");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,
                        "email=fabio@amexassessoria.com&token=693046D71CD34C829310219E4372E971");

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);*/

            $server_output = curl_exec($ch);

            curl_close ($ch);
			
			$xml = simplexml_load_string($server_output);

            echo json_encode($xml);
        }

        public function GeraBoleto()
        { 
            $ch = curl_init();

            $dados = $_POST;

            $Colaborador = json_decode($_POST['Colaborador']);
            $Pagamento = json_decode($_POST['Pagamento']);

            $Colaborador->Colaborador_chr_CPF = str_replace('.','',$Colaborador->Colaborador_chr_CPF);
			$Colaborador->Colaborador_chr_CPF = str_replace('-','',$Colaborador->Colaborador_chr_CPF);
			
			$Pagamento->Pagamento_vch_Valor    = str_replace('.','',$Pagamento->Pagamento_vch_Valor);
            $Pagamento->Pagamento_vch_Valor    = str_replace(',','.',$Pagamento->Pagamento_vch_Valor);

            $Pagamento->Colaborador_lng_Codigo = $Colaborador->Colaborador_lng_Codigo;
            $Pagamento->Pagamento_lng_Status   = 1;
            $Pagamento->Pagamento_dat_Cadastro = date("Y-m-d H:i:s");
			
            $Pagamento->Pagamento_lng_Codigo = Pagamento::salvar($Pagamento);
			
			//$Colaborador->Colaborador_vch_Email = "fabio@sandbox.pagseguro.com.br";

            if ($Pagamento->Pagamento_lng_Codigo) {

                curl_setopt($ch, CURLOPT_URL,Config::PAGSEGURO_URL."/v2/transactions");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "email=".Config::PAGSEGURO_EMAIL.
                    "&token=".Config::PAGSEGURO_TOKEN.
                    "&paymentMode=default".
                    "&paymentMethod=boleto".
                    "&receiverEmail=".Config::PAGSEGURO_EMAIL.
                    "&currency=BRL".
                    "&extraAmount=0.00".
                    "&itemId1=0".
                    "&itemDescription1=Doaчуo Online".
                    "&itemAmount1=".$Pagamento->Pagamento_vch_Valor.
                    "&itemQuantity1=1".
                    "&notificationURL=".Config::REST_URL."Pagamento/Retorno".
                    "&reference=".$Pagamento->Pagamento_lng_Codigo.
                    "&senderName=".$Colaborador->Colaborador_vch_Nome.
                    "&senderCPF=".$Colaborador->Colaborador_chr_CPF.
                    "&senderAreaCode=".$Colaborador->Colaborador_vch_DDD.
                    "&senderPhone=".$Colaborador->Colaborador_vch_Telefone.
                    "&senderEmail=".$Colaborador->Colaborador_vch_Email.
                    "&senderHash=".$Pagamento->Pagamento_vch_Hash.
                    "&shippingAddressStreet=".$Colaborador->Colaborador_vch_Endereco.
                    "&shippingAddressNumber=".$Colaborador->Colaborador_lng_Numero.
                    "&shippingAddressComplement=".$Colaborador->Colaborador_vch_Complemento.
                    "&shippingAddressDistrict=".$Colaborador->Colaborador_chr_Estado.
                    "&shippingAddressPostalCode=".$Colaborador->Colaborador_chr_CEP.
                    "&shippingAddressCity=".$Colaborador->Colaborador_vch_Cidade.
                    "&shippingAddressState=".$Colaborador->Colaborador_chr_Estado.
                    "&shippingAddressCountry=Brasil".
                    "&shippingType=1".
                    "&shippingCost=0.00"
                );
                            
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $server_output = curl_exec($ch);
                
                curl_close ($ch);
                
                $xml = simplexml_load_string($server_output);

                /*$mArquivo = fopen("pagamentos.txt", 'w+');
                fwrite($mArquivo, $server_output);
                fclose($mArquivo);*/

                echo json_encode($xml);
            } else {
                echo false;
            }
        }

        public function PagaCartao()
        { 
            $ch = curl_init();

            $dados = $_POST;

            $Colaborador = json_decode($_POST['Colaborador']);
            $Pagamento = json_decode($_POST['Pagamento']);
			
			$Colaborador->Colaborador_chr_CPF = str_replace('.','',$Colaborador->Colaborador_chr_CPF);
			$Colaborador->Colaborador_chr_CPF = str_replace('-','',$Colaborador->Colaborador_chr_CPF);

            $Pagamento->Pagamento_vch_Valor    = str_replace('.','',$Pagamento->Pagamento_vch_Valor);
            $Pagamento->Pagamento_vch_Valor    = str_replace(',','.',$Pagamento->Pagamento_vch_Valor);

            $Pagamento->Colaborador_lng_Codigo = $Colaborador->Colaborador_lng_Codigo;
            $Pagamento->Pagamento_lng_Status   = 1;
            $Pagamento->Pagamento_dat_Cadastro = date("Y-m-d H:i:s");
			
			$Colaborador->Colaborador_chr_CPF = str_replace('.','',$Colaborador->Colaborador_chr_CPF);
			$Colaborador->Colaborador_chr_CPF = str_replace('-','',$Colaborador->Colaborador_chr_CPF);

            $Pagamento->Pagamento_lng_Codigo = Pagamento::salvar($Pagamento);
			
			//$Colaborador->Colaborador_vch_Email = "fabio@sandbox.pagseguro.com.br";

            if ($Pagamento->Pagamento_lng_Codigo) {

                curl_setopt($ch, CURLOPT_URL,Config::PAGSEGURO_URL."/v2/transactions");
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "email=".Config::PAGSEGURO_EMAIL.
                    "&token=".Config::PAGSEGURO_TOKEN.
                    "&paymentMode=default".
                    "&paymentMethod=creditCard".
                    "&receiverEmail=".Config::PAGSEGURO_EMAIL.
                    "&currency=BRL".
                    "&extraAmount=0.00".
                    "&itemId1=0".
                    "&itemDescription1=Doaчуo Online".
                    "&itemAmount1=".$Pagamento->Pagamento_vch_Valor.
                    "&itemQuantity1=1".
                    "&notificationURL=".Config::REST_URL."Pagamento/Retorno".
                    "&reference=".$Pagamento->Pagamento_lng_Codigo.
                    "&senderName=".$Colaborador->Colaborador_vch_Nome.
                    "&senderCPF=".$Colaborador->Colaborador_chr_CPF.
                    "&senderAreaCode=".$Colaborador->Colaborador_vch_DDD.
                    "&senderPhone=".$Colaborador->Colaborador_vch_Telefone.
                    "&senderEmail=".$Colaborador->Colaborador_vch_Email.
                    "&senderHash=".$Pagamento->Pagamento_vch_Hash.
                    "&shippingAddressStreet=".$Colaborador->Colaborador_vch_Endereco.
                    "&shippingAddressNumber=".$Colaborador->Colaborador_lng_Numero.
                    "&shippingAddressComplement=".$Colaborador->Colaborador_vch_Complemento.
                    "&shippingAddressDistrict=".$Colaborador->Colaborador_vch_Bairro.
                    "&shippingAddressPostalCode=".$Colaborador->Colaborador_chr_CEP.
                    "&shippingAddressCity=".$Colaborador->Colaborador_vch_Cidade.
                    "&shippingAddressState=".$Colaborador->Colaborador_chr_Estado.
                    "&shippingAddressCountry=Brasil".
                    "&shippingType=1".
                    "&shippingCost=0.00".
                    "&creditCardToken=".$Pagamento->Cartao_vch_Token.
                    "&installmentQuantity=1".
                    "&installmentValue=".$Pagamento->Pagamento_vch_Valor.
                    "&creditCardHolderName=".$Colaborador->Colaborador_vch_Nome.
                    "&creditCardHolderCPF=".$Colaborador->Colaborador_chr_CPF.
                    "&creditCardHolderBirthDate=".$Colaborador->Colaborador_dat_DataNascimento.
                    "&creditCardHolderAreaCode=".$Colaborador->Colaborador_vch_DDD.
                    "&creditCardHolderPhone=".$Colaborador->Colaborador_vch_Telefone.
                    "&billingAddressStreet=".$Colaborador->Colaborador_vch_Endereco.
                    "&billingAddressNumber=".$Colaborador->Colaborador_lng_Numero.
                    "&billingAddressComplement=".$Colaborador->Colaborador_vch_Complemento.
                    "&billingAddressDistrict=".$Colaborador->Colaborador_vch_Bairro.
                    "&billingAddressPostalCode=".$Colaborador->Colaborador_chr_CEP.
                    "&billingAddressCity=".$Colaborador->Colaborador_vch_Cidade.
                    "&billingAddressState=".$Colaborador->Colaborador_chr_Estado.
                    "&billingAddressCountry=BRA"
                );
                            
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $server_output = curl_exec($ch);
                
                /*if($server_output === false)
                {
                    echo 'Curl error: ' . curl_error($ch);
                }
                else
                {
                    echo 'Operation completed without any errors';
                }*/

                curl_close ($ch);
                
                $xml = simplexml_load_string($server_output);

                /*$mArquivo = fopen("pagamentos.txt", 'w+');
                fwrite($mArquivo, $server_output);
                fclose($mArquivo);*/

                echo json_encode($xml);
            } else {
                echo false;
            }
        }

        public function Retorno()
        {
            header('Content-type: application/xml');

            if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
                
                $sCodigoNotificacao = $_POST['notificationCode'];
                
                $cUrl = curl_init();

                curl_setopt($cUrl, CURLOPT_URL, Config::PAGSEGURO_URL."/v3/transactions/notifications/".$sCodigoNotificacao."?email=".Config::PAGSEGURO_EMAIL."&token=".Config::PAGSEGURO_TOKEN);
                curl_setopt($cUrl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($cUrl, CURLOPT_SSL_VERIFYPEER, false);
                
                $mResultado = curl_exec($cUrl);
                $xml = simplexml_load_string($mResultado);

                $oPagamento = new Pagamento();
                $oPagamento->Pagamento_dat_Modificacao = date("Y-m-d H:i:s");
                $oPagamento->Pagamento_lng_Codigo = $xml->reference;
                $oPagamento->Pagamento_lng_Status = $xml->status;

                Pagamento::alteraStatus($oPagamento);

                curl_close($cUrl);
                
            }
        }
    }

?>