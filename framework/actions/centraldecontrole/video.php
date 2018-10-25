<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_VIDEO'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/video/video'); 
Controller::loadClass('site/video/videoDB');

$oVideo = new Video();
$arrObjVideo = '';
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oVideo->iCodigo    = $_POST['inputCodigo'];
    $oVideo->sDescricao = $_POST['inputDescricao'];
    $oVideo->sLink      = $_POST['inputLink'];
    
    if ( $oVideo->iCodigo == '' )
    {
        VideoDB::salvaVideo($oVideo);
    }
    else
    {
        VideoDB::alteraVideo($oVideo);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    VideoDB::excluiVideo($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    VideoDB::setaFiltro(' AND Video_lng_Codigo = '.$_GET['codigo']);
    $oVideo = VideoDB::pesquisaVideo();
}
else
{
    $arrObjVideo = VideoDB::pesquisaVideoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}



/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjVideo', $arrObjVideo );
$oTemplate->assign ('oVideo', $oVideo );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'videos' );
$oTemplate->assign ('sMenu',   'multimidia' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/video.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>