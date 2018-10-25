<?php

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/portifolio/portifolio'); 
Controller::loadClass('site/portifolio/portifolioDB');

$oPortifolio = new Portifolio();

$arrObjPortifolio = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oPortifolio->iCodigo    = $_POST['inputCodigo'];
    $oPortifolio->sNome = $_POST['inputNome'];
    $oPortifolio->sConteudo = $_POST['inputConteudo'];
    $oPortifolio->sUrlImagem = $_POST['inputUrlImagem'];

    if ( $oPortifolio->iCodigo == '' )
    {
        PortifolioDB::salvaPortifolio($oPortifolio);
    }
    else
    {   
        PortifolioDB::alteraPortifolio($oPortifolio);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    PortifolioDB::excluiPortifolio($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    PortifolioDB::setaFiltro(' AND Portifolio_lng_Codigo = '.$_GET['codigo']);
    $oPortifolio = PortifolioDB::pesquisaPortifolio();

}
else
{
    $arrObjPortifolio = PortifolioDB::pesquisaPortifolioLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjPortifolio', $arrObjPortifolio );
$oTemplate->assign ('oPortifolio', $oPortifolio );
$oTemplate->assign ('arrObjAlbum', $arrObjAlbum );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'portifolio' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/portifolio.tpl');

?>
