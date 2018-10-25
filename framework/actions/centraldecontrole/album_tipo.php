<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_FOTO'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/albumTipo/albumTipo'); 
Controller::loadClass('site/albumTipo/albumTipoDB');

$oAlbumTipo = new AlbumTipo();
$arrObjAlbumTipo = '';
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oAlbumTipo->iCodigo    = $_POST['inputCodigo'];
    $oAlbumTipo->sDescricao = $_POST['inputDescricao'];
    
    if ( $oAlbumTipo->iCodigo == '' )
    {
        AlbumTipoDB::salvaAlbumTipo($oAlbumTipo);
    }
    else
    {
        AlbumTipoDB::alteraAlbumTipo($oAlbumTipo);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    AlbumTipoDB::excluiAlbumTipo($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    AlbumTipoDB::setaFiltro(' AND Album_Tipo_lng_Codigo = '.$_GET['codigo']);
    $oAlbumTipo = AlbumTipoDB::pesquisaAlbumTipo();
}
else
{
    $arrObjAlbumTipo = AlbumTipoDB::pesquisaAlbumTipoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjAlbumTipo', $arrObjAlbumTipo );
$oTemplate->assign ('oAlbumTipo', $oAlbumTipo );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'album_tipo' );
$oTemplate->assign ('sMenu',   'multimidia' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/album_tipo.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>