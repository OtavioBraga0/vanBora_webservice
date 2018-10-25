<?php

require_once('./lib/nusoap.php');
require_once( '../framework/config/config.class.php' );
require_once( '../framework/classes/core/util.class.php' );

$server = new soap_server;
$server->configureWSDL('Amex.Noticia','urn:Amex.Noticia');
$server->wsdl->schemaTargetNamespace = 'urn:Amex.Noticia';

$server->register('insereNoticia', //nome do método
                  array(
                        'senha'      => 'xsd:string', 
                        'titulo'     => 'xsd:string',
                        'resumo'     => 'xsd:string',
						'conteudo'   => 'xsd:string',
						'tags'       => 'xsd:string',
						'fonte'      => 'xsd:string',
						'link'       => 'xsd:string',
                        'thumb'      => 'xsd:string'
				  ), //parâmetros de entrada
                  array(
                        'retorno' => 'xsd:boolean',
						'url'     => 'xsd:string'
                  ), //parâmetros de saída
                  'urn:Amex.Noticia', //namespace
                  'urn:Amex.Noticia#insereNoticia', //soapaction
                  'rpc', //style
                  'encoded', //use
                  'Retorna o Noticia' //documentação do serviço
);


function insereNoticia($sSenha, $sTitulo, $sResumo, $sConteudo, $sTags, $sFonteDescricao, $sFonteUrl, $sThumb)
{

    if ( ($sSenha == 'ame%@1') )
    {
		if ( (trim($sTitulo) <> '') && (trim($sResumo) <> '') && (trim($sConteudo) <> '') && (trim($sFonteDescricao) <> '') && (trim($sFonteUrl) <> '') && (trim($sThumb) <> ''))
		{
			$host = Config::HOST;
			$db   = Config::DB;
			$user = Config::USER;
			$psdw = Config::PSWD;

			$oConexao = new PDO( "mysql:host=".$host.";port=3306;dbname=".$db, $user, $psdw);
			
			$sUrl = Util::formataUrl($sTitulo);
			$resultado = '';
			
			$sNomeFoto   =  md5(uniqid($sThumb));
			copy($sThumb, '../images/fotosAlbuns/'.$sNomeFoto.'.jpg');
			$sUrlImagem = 'images/fotosAlbuns/'.$sNomeFoto.'.jpg';

			$sSqlInsercao = $oConexao->prepare("INSERT INTO Artigo (
						Artigo_vch_Titulo,
						Artigo_vch_Resumo,
						Artigo_txt_Conteudo,
						Artigo_vch_FonteDescricao,
						Artigo_vch_FonteUrl,
						Artigo_vch_UrlImagem,
						Artigo_chr_Ativo,
						Tipo_lng_Codigo,
						Artigo_dat_Cadastro,
						Artigo_chr_Destaque,
						Artigo_vch_Link,
						Usuario_lng_Codigo,
						Artigo_lng_TotalDeVisitas,
						Artigo_chr_OcultarMiniatura,
						Artigo_chr_Carrossel
						) VALUES ( '".$sTitulo."','".$sResumo."','".$sConteudo."','".$sFonteDescricao."','".$sFonteUrl."','".$sUrlImagem."','S' ,1 ,'".date( 'Y-m-d H:i:s' )."','N', '".$sUrl."',1,0,'N','N')"
					);

			$resultado = $sSqlInsercao->execute();


			if ($resultado) {
				
				$res = array(true, 'artigo/'.$sUrl.'.html');
			}
			else {
				$res = array(false, "Erro ao executar a consulta");
			}
		}
        else 
		{
			$res = array(false, "Erro ao validar os dados");
		}
    }
    else
    {
        $res = array(false, "Senha incorreta");
    }

    return $res;

}



// requisição para uso do serviço
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
