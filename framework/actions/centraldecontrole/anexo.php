<?php

/* Carrega as Classes Necessárias */
Controller::loadClass('site/anexo/anexo'); 
Controller::loadClass('site/anexo/anexoDB');

$oAnexo = new Anexo();
$arrObjAnexo = '';
$sAcao = 'lista';
$sDiretorioDestinoAnexos = 'uploads';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oAnexo->sTitulo     = $_POST['inputTitulo'];
    $oAnexo->sCadastro   = date( 'Y-m-d H:i:s' );
    
    $sNomeUpload = $_FILES['inputAnexo']['name'];
    
    if ( $sNomeUpload <> '')
    {
        $sAnoAtual = date('Y');
        $sMesAtual = date('m');
        $sExtensao    = strtolower(end(explode( '.', $sNomeUpload)));
        $sNomeArquivo = strtolower(reset(explode( '.', $sNomeUpload)));
        $sNomeArquivo = $sNomeArquivo.'_'.date('dmYHis').rand().'.' .$sExtensao;

        if(!file_exists($sDiretorioDestinoAnexos))
        {
            mkdir($sDiretorioDestinoAnexos);
        }

        if(!file_exists($sDiretorioDestinoAnexos.'/'.$sAnoAtual))
        {
            mkdir($sDiretorioDestinoAnexos.'/'.$sAnoAtual);
        }

        if(!file_exists($sDiretorioDestinoAnexos.'/'.$sAnoAtual.'/'.$sMesAtual))
        {
            mkdir($sDiretorioDestinoAnexos.'/'.$sAnoAtual.'/'.$sMesAtual);
        }

        $oAnexo->sCaminho = $sDiretorioDestinoAnexos.'/'.$sAnoAtual.'/'.$sMesAtual.'/'.$sNomeArquivo;

        move_uploaded_file ( $_FILES['inputAnexo']['tmp_name'], $oAnexo->sCaminho );
    }

    AnexoDB::salvaAnexo($oAnexo);
}
else if ( isset ( $_GET['excluir'] ) )
{
    AnexoDB::excluiAnexo($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    AnexoDB::setaFiltro(' AND Anexo_lng_Codigo = '.$_GET['codigo']);
    $oAnexo = AnexoDB::pesquisaAnexo();
}
else
{
    $arrObjAnexo = AnexoDB::pesquisaAnexoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjAnexo', $arrObjAnexo );
$oTemplate->assign ('oAnexo', $oAnexo );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'anexos' );
$oTemplate->assign ('sMenu',   'multimidia' );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/anexo.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>