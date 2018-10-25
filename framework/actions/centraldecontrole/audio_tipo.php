<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_FOTO'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/audioTipo/audioTipo'); 
Controller::loadClass('site/audioTipo/audioTipoDB');

$oAudioTipo = new AudioTipo();
$arrObjAudioTipo = '';
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oAudioTipo->iCodigo    = $_POST['inputCodigo'];
    $oAudioTipo->sDescricao = $_POST['inputDescricao'];
    
    if ( $oAudioTipo->iCodigo == '' )
    {
        AudioTipoDB::salvaAudioTipo($oAudioTipo);
    }
    else
    {
        AudioTipoDB::alteraAudioTipo($oAudioTipo);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    AudioTipoDB::excluiAudioTipo($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    AudioTipoDB::setaFiltro(' AND Audio_Tipo_lng_Codigo = '.$_GET['codigo']);
    $oAudioTipo = AudioTipoDB::pesquisaAudioTipo();
}
else
{
    $arrObjAudioTipo = AudioTipoDB::pesquisaAudioTipoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjAudioTipo', $arrObjAudioTipo );
$oTemplate->assign ('oAudioTipo', $oAudioTipo );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'audio_tipo' );
$oTemplate->assign ('sMenu',   'multimidia' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/audio_tipo.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>