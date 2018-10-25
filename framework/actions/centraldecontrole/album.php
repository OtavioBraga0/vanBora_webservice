<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_FOTO'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/albumTipo/albumTipo'); 
Controller::loadClass('site/albumTipo/albumTipoDB');
Controller::loadClass('site/album/album'); 
Controller::loadClass('site/album/albumDB');
Controller::loadClass('site/foto/foto'); 
Controller::loadClass('site/foto/fotoDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oAlbum = new Album();
$arrObjAlbum = '';
$arrObjAlbumTipo = AlbumTipoDB::pesquisaAlbumTipoLista();


if ( isset ( $_GET['edit'] ) )
{
    AlbumDB::setaFiltro(' AND Album_lng_Codigo = '.$_GET['edit']);
    $oAlbum = AlbumDB::pesquisaAlbum(true);
}
else
{
    AlbumDB::setaFiltro('AND Album_vch_Tipo = "geral"');
    $arrObjAlbum = AlbumDB::pesquisaAlbumLista();

    AlbumDB::setaFiltro('AND Album_vch_Tipo = "sistema"');
    $arrObjAlbumSistema = AlbumDB::pesquisaAlbumLista();
}

if ( isset( $_GET['create'] ) && !empty( $_POST['inputAlbum'] ) )
{
    
    $oAlbum->sTitulo  = trim( preg_replace( '/\s+/', ' ', $_POST['inputAlbum'] ) ) ;
    $oAlbum->sVisivel = $_POST['inputVisivel'];
    $oAlbum->sCredito = $_POST['inputCredito'];
    $oAlbum->sTipo    = $_POST['inputCategoria'];
    
    $oAlbumTipo = new AlbumTipo();
    
    if ($_POST['inputTipo'] !== '-')
    {
        $oAlbumTipo->iCodigo = $_POST['inputTipo'];
    }
    else {
        $oAlbumTipo->iCodigo = null;
    }
    
    $oAlbum->oAlbumTipo = $oAlbumTipo; 

    if ( $oAlbum->sTitulo != "" )
    {
        $iCodigoAlbum = AlbumDB::salvaAlbum($oAlbum);
        header("Location: ?pagina=centraldecontrole/album&edit=$iCodigoAlbum");
    }
}

if ( isset( $_GET['delete'] ) && !empty( $_GET['delete'] ) )
{
    $album_id = $_GET['delete'];

    FotoDB::setaFiltro(" AND Album_lng_Codigo = $album_id");
    $arrObjFoto = FotoDB::pesquisaFotoLista(); 

    foreach ( $arrObjFoto as $oFoto )
    {
        $file = "images/fotosAlbuns/" . $oFoto->sUrl;
        FotoDB::excluiFoto($oFoto->iCodigo);

        /*if ( file_exists( $file ) )
        {
            @unlink( $file );
        }*/
    }

    AlbumDB::excluiAlbum($album_id);

    header("Location: ?pagina=centraldecontrole/album");
}
    
$oTemplate->assign ('oAlbum', $oAlbum );
$oTemplate->assign ('arrObjAlbum', $arrObjAlbum );
$oTemplate->assign ('arrObjAlbumSistema', $arrObjAlbumSistema );
$oTemplate->assign ('arrObjAlbumTipo', $arrObjAlbumTipo );

$oTemplate->assign ('sPagina', 'fotos' );
$oTemplate->assign ('sMenu',   'multimidia' );

$oTemplate->display('centraldecontrole/album.tpl');

?>
