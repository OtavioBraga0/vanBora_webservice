<?php 

    Controller::carregaModel('Colaborador/Colaborador'); 

    class ColaboradorController
    {   

		public function Detalhar()
        {            
            $iCodigo = $_GET['id'];
            echo Colaborador::selectPorCodigo($iCodigo);
        }  

		public function DetalharPorCPF()
        {        
			$sMensagem = "";
			$bRetorno = false;

            $sCPF = $_GET['cpf'];
			Colaborador::setaFiltro("AND Colaborador_chr_CPF = '".$sCPF."'");
            
			$mRetorno = Colaborador::select();

			if ($mRetorno == null) {
				$sMensagem = "Não foi encontrado nenhum colaborador com o CPF informado";
			} else {
				$sMensagem = "Colaborador encontrado";
				$bRetorno = $mRetorno;
			}

			$arrRertorno = array(
				"retorno" => $bRetorno,
				"mensagem" => $sMensagem
			);

			echo json_encode($arrRertorno);

        }  

		public function AlteraDados()
        {
			$bRetorno = false;

			$oColaborador = new Colaborador();
			$oColaborador->Colaborador_lng_Codigo   = $_POST['Colaborador_lng_Codigo'];
			$oColaborador->Colaborador_vch_Nome     = $_POST['Colaborador_vch_Nome'];
			$oColaborador->Colaborador_vch_DDD      = $_POST['Colaborador_vch_DDD'];
			$oColaborador->Colaborador_vch_Telefone = $_POST['Colaborador_vch_Telefone'];

			$bRetorno = $oColaborador->alteraDados($oColaborador);

			if ($bRetorno) {
				$sMensagem = "Dados alterados com sucesso";
			} else {
				$sMensagem = "Erro ao salvar seus dados";
			}

			$arrRertorno = array(
				"retorno" => $bRetorno,
				"mensagem" => utf8_encode($sMensagem)
			);

			echo json_encode($arrRertorno);
		}

        public function Salvar()
        {
			$sMensagem = "";
			$bRetorno = false;
			$oColaborador = new Colaborador();

            $sCPF = $_POST['Colaborador_chr_CPF'];

            Colaborador::setaFiltro(" AND Colaborador_chr_CPF = '".$sCPF."'");
            $iTotalRegistros = Colaborador::count();

            if ($iTotalRegistros == 0) {

				$bCPFValido = Util::validaCPF($_POST['Colaborador_chr_CPF']);

				if ($bCPFValido) {

					$bEmailValido = Util::validaemail($_POST['Colaborador_vch_Email']);

					if ($bEmailValido) {

						$oColaborador->Colaborador_vch_Nome           = utf8_decode($_POST['Colaborador_vch_Nome']);
						$oColaborador->Colaborador_vch_Endereco       = utf8_decode($_POST['Colaborador_vch_Endereco']);
						$oColaborador->Colaborador_lng_Numero         = utf8_decode($_POST['Colaborador_lng_Numero']);
						$oColaborador->Colaborador_vch_Bairro         = utf8_decode($_POST['Colaborador_vch_Bairro']);
						$oColaborador->Colaborador_vch_Cidade         = utf8_decode($_POST['Colaborador_vch_Cidade']); 
						$oColaborador->Colaborador_chr_Estado         = $_POST['Colaborador_chr_Estado'];
						$oColaborador->Colaborador_vch_Telefone       = $_POST['Colaborador_vch_Telefone'];
						$oColaborador->Colaborador_vch_Email          = $_POST['Colaborador_vch_Email'];
						$oColaborador->Colaborador_chr_CPF            = $_POST['Colaborador_chr_CPF'];
						$oColaborador->Colaborador_chr_Sexo           = $_POST['Colaborador_chr_Sexo'];
						$oColaborador->Colaborador_dat_DataNascimento = date('Y-m-d', strtotime($_POST['Colaborador_dat_DataNascimento']));
						$oColaborador->Colaborador_chr_CEP            = $_POST['Colaborador_chr_CEP'];
						$oColaborador->Colaborador_vch_Complemento    = utf8_decode($_POST['Colaborador_vch_Complemento']);
						$oColaborador->Colaborador_dat_DataCadastro   = date("Y-m-d H:i:s");
						$oColaborador->Colaborador_bit_Campanha       = intval($_POST['Colaborador_bit_Campanha']);
						$oColaborador->Colaborador_vch_DDD            = $_POST['Colaborador_vch_DDD'];

						$oColaborador->Colaborador_lng_Codigo = $oColaborador->salvar($oColaborador);

						if ($oColaborador->Colaborador_lng_Codigo) {
							$bRetorno = true;
							$sMensagem = "Seu cadastro foi efetuado com sucesso. Aguarde o nosso contato.";
						} else {
							$bRetorno = false;
							$sMensagem = "Erro ao efetuar seu cadastro. Tente novamente";
						}
					} else {
						$bRetorno = false;
						$sMensagem = "Seu e-mail é inválido. Tente novamente";
					}
				} else {
					$bRetorno = false;
					$sMensagem = "Seu CPF é inválido. Tente novamente";
				}
            } else {
                $bRetorno = false;
				$sMensagem = "Seu CPF já está cadastrado na campanha.";
            }
			
			$arrRertorno = array(
				"retorno" => $bRetorno,
				"mensagem" => utf8_encode($sMensagem),
				"Colaborador_lng_Codigo" => $oColaborador->Colaborador_lng_Codigo 
			);

			echo json_encode($arrRertorno);
        }

        public function Listar()
        {
            echo Colaborador::selectAll();
        }
    }
?>