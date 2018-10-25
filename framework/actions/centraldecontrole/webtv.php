<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_VIDEO'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/webtv/webtv'); 
Controller::loadClass('site/webtv/webtvDB');

$oWebtv = new Webtv();  
$arrObjWebtv = '';
$sAcao = 'lista';
$sLink = '';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oWebtv->iCodigo    = $_POST['inputCodigo'];
    $oWebtv->sTitulo    = $_POST['inputTitulo'];
    list($http, $sLink) = split('=', $_POST['inputLink']);
    $oWebtv->sLink      = $sLink;
    $oWebtv->sLinkCompleto      = $_POST['inputLink'];

    // var_dump($oWebtv);
    // die();
    
    if ( $oWebtv->iCodigo == '' )
    {
        WebtvDB::salvaVideo($oWebtv);
    }
    else
    {
        WebtvDB::alteraVideo($oWebtv);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    WebtvDB::excluiVideo($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    WebtvDB::setaFiltro(' AND Webtv_lng_Codigo = '.$_GET['codigo']);
    $oWebtv = WebtvDB::pesquisaVideo();
}
else
{
    $arrObjWebtv = WebtvDB::pesquisaVideoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}



/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjWebtv', $arrObjWebtv );
$oTemplate->assign ('oWebtv', $oWebtv );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'webtv' );
$oTemplate->assign ('sMenu',   'multimidia' );
/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/webtv.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>