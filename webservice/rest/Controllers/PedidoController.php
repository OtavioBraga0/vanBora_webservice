<?php 



    Controller::carregaModel('Pedido/Pedido'); 



    class PedidoController

    {      

        

        public function Salvar()

        {

            

            $sImagem = (isset($_POST['imagem']) ? $_POST['imagem'] : NULL);

            

            $oPedido = new Pedido();

            $oPedido->Pedido_vch_Nome           = utf8_decode($_POST['nome']);

            $oPedido->Pedido_vch_Email          = utf8_decode($_POST['email']);

            $oPedido->Pedido_txt_Intencao       = utf8_decode($_POST['intencao']);

            $oPedido->Pedido_chr_ExibirIntencao = "S";

            $oPedido->Pedido_dat_Data           = date('Y-m-d');

            $oPedido->Pedido_chr_Tipo           = $_POST['tipo'];

            $oPedido->Pedido_vch_UrlImagem      = $sImagem;

            $oPedido->Pedido_chr_Aprovado       = 'N';

            $oPedido->Pedido_chr_Respondido     = 'N';

            

            if (trim($oPedido->Pedido_vch_Nome) !== "") {

                $mRetorno = $oPedido->salvar($oPedido);

            

                if ($mRetorno) {

                    echo true;

                } else {

                    echo false;

                }

            } else {

                echo false;

            }

        }

        

        public function SalvaFoto()

        {

            

            if (isset($_FILES["file"])) {

                

                Controller::CarregaArquivo('Util/Upload'); 

                

                $sDiretorioDestino = '../../images/testemunho/';

                $oFotoUpload = new Upload( $_FILES["file"] );

            

                if ( $oFotoUpload->uploaded )

                {



                    $oFotoUpload->file_overwrite = true;

                    $oFotoUpload->image_convert = 'jpg';

                    //Configuracoes de redimensionamento retrato

                    $lMax  = 700; //largura maxima permitida

                    $aMax  = 600; // altura maxima permitida

                    //Configuracoes de redimensionamento paisagem

                    $plMax = 650; //largura maxima permitida

                    $paMax = 550; // altura maxima permitida





                    if ( $oFotoUpload->image_src_x > $oFotoUpload->image_y )

                    {

                        if ( $oFotoUpload->image_src_x > $lMax || $oFotoUpload->image_y > $aMax )

                        {

                            $oFotoUpload->image_resize = true;

                            $oFotoUpload->image_ratio = true;

                            $oFotoUpload->image_x = ($lMax / 2);

                            $oFotoUpload->image_y = ($aMax / 2);

                        }

                    }

                    else

                    {

                        if ( $oFotoUpload->image_src_x > $plMax || $oFotoUpload->image_y > $paMax )

                        {

                            $oFotoUpload->image_resize = true;

                            $oFotoUpload->image_ratio = true;

                            $oFotoUpload->image_x = ($plMax / 2);

                            $oFotoUpload->image_y = ($paMax / 2);

                        }

                    }



                    $oFotoUpload->file_new_name_body = md5( uniqid( $_FILES["file"]['name'] ) );

                    $oFotoUpload->Process( $sDiretorioDestino );



                    if ( $oFotoUpload->processed )

                    {

                        echo $oFotoUpload->file_dst_name;

                    }

                }

                

                //move_uploaded_file($_FILES["file"]["tmp_name"], '../../images/testemunho/foto.jpg');

            }

        }

        

    }

?>