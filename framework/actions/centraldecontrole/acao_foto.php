<?php

@header( 'Content-Type: text/html; charset=iso-8859-1' );

Controller::loadClass('core/util'); 
Controller::loadClass('site/foto/foto'); 
Controller::loadClass('site/foto/fotoDB');
Controller::loadClass('site/albumTipo/albumTipo'); 
Controller::loadClass('site/albumTipo/albumTipoDB');
Controller::loadClass('site/album/album'); 
Controller::loadClass('site/album/albumDB');

if ( isset( $_GET['action'] ) )
{
    $action = $_GET['action'];
    $action();
}

function updateAlbum()
{
    
    $oAlbum = new Album();
    
    $oAlbum->iCodigo  = $_POST['album_id'];
    $oAlbum->sVisivel = $_POST['visivel'];
    $oAlbum->sCredito = utf8_decode($_POST['album_credito']);
    $oAlbum->sTitulo = utf8_decode( Util::fulltrim( $_POST['album_name'] ) );
    $oAlbum->sTipo = $_POST['album_categoria'];
    
    $oAlbumTipo = new AlbumTipo();
    
    if ($_POST['album_tipo'] !== '-')
    {
        $oAlbumTipo->iCodigo = $_POST['album_tipo'];
    }
    else {
        $oAlbumTipo->iCodigo = null;
    }
    
    $oAlbum->oAlbumTipo = $oAlbumTipo; 
              
    AlbumDB::alteraAlbum($oAlbum);
    
    echo 'Álbum Atualizado: <Br/>' . $oAlbum->sTitulo;
}

function updateFotoCover()
{
    $oAlbum = new Album();
    $oAlbum->iFotoCodigo = $_POST['foto_album'];
    $oAlbum->iCodigo      = $_POST['foto_id'];      

    AlbumDB::alteraCapa($oAlbum);
    
    echo 'Capa do �lbum atualizada <Br/>';
}

function updateFotoName()
{
    $oFoto = new Foto();
    
    $oFoto->sCaption   = utf8_decode( Util::fulltrim( $_POST['foto_caption'] ) );
    //$oFoto->sUrl       = utf8_decode( Util::fulltrim( $_POST['foto_url'] ) );
    $oFoto->iCodigo    = preg_replace( '/f\_/', '', Util::fulltrim( $_POST['foto_id'] ) );
    
    FotoDB::alteraFoto($oFoto);

    echo 'Foto Atualizada<Br/>' . $oFoto->sCaption;
}

function deleteFoto()
{

    FotoDB::setaFiltro(' AND Foto_lng_Codigo = '.$_POST['foto_id']);
    $oFoto = FotoDB::pesquisaFoto();
    
    $file = ".images/fotosAlbuns" . $oFoto->sUrl;
    
    if ( file_exists( $file ) )
    {
        @unlink( $file );
    }
                
    FotoDB::excluiFoto($oFoto->iCodigo);

    echo 'Foto Removida<Br/>';
}

function updateFotoPos()
{
    extract( $_POST );
    parse_str( $item, $arr );
    foreach ( $arr['item'] as $iPosicao => $iFotoCodigo )
    {
        $oFoto = new Foto();
        
        $oFoto->iCodigo  = $iFotoCodigo;
        $oFoto->iPosicao = $iPosicao;
        FotoDB::alteraPosicao($oFoto);
    }
}

?>