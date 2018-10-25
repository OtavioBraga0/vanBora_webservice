<?php

header('Access-Control-Allow-Origin: *');

require_once( '../framework/config/config.class.php' );
require_once( '../framework/classes/core/util.class.php' );

$sSenha = $_POST['dados']['sSenha'];
$sTitulo = addslashes($_POST['dados']['sTitulo']);
$sResumo = addslashes($_POST['dados']['sResumo']);
$sConteudo = addslashes($_POST['dados']['sConteudo']);
$sTags = $_POST['dados']['sTags'];
$sFonteDescricao = addslashes($_POST['dados']['sFonte']);
$sFonteUrl = $_POST['dados']['sLink'];
$sThumb = $_POST['dados']['sThumb'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (($sSenha == 'ame%@1')) {
        if ((trim($sTitulo) <> '') && (trim($sResumo) <> '') && (trim($sConteudo) <> '') && (trim($sThumb) <> '')) {
            $host = Config::HOST;
            $db = Config::DB;
            $user = Config::USER;
            $psdw = Config::PSWD;

            $oConexao = new PDO("mysql:host=" . $host . ";port=3306;dbname=" . $db, $user, $psdw);

            $sUrl = Util::formataUrl($sTitulo);
            $resultado = '';

            //$sNomeFoto = md5(uniqid($sThumb));
            //copy($sThumb, '../images/fotosAlbuns/' . $sNomeFoto . '.jpg');
            //$sUrlImagem = 'images/fotosAlbuns/' . $sNomeFoto . '.jpg';

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
						) VALUES ( '" . $sTitulo . "','" . $sResumo . "','" . $sConteudo . "','" . $sFonteDescricao . "','" . $sFonteUrl . "','" . $sThumb . "','S' ,1 ,'" . date('Y-m-d H:i:s') . "','N', '" . $sUrl . "',1,0,'N','N')"
            );

            $resultado = $sSqlInsercao->execute();


            if ($resultado) {

                $res = array('retorno' => true, 'url' => 'artigo/' . $sUrl . '.html');
            } else {
                $res = array('retorno' => false, 'url' => "Erro ao executar a consulta");
            }
        } else {
            $res = array('retorno' => false, 'url' => "Erro ao validar os dados");
        }
    } else {
        $res = array('retorno' => false, 'url' => "Senha incorreta");
    }
} else {
    $res = array('retorno' => false, 'url' => "Erro no servidor");
}

echo json_encode($res);
?>
