<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_AUDIO'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

//ini_set ('post_max_size', '100M');
//ini_set ('upload_max_filesize', '100M');

/*
  --post_max_size = 100M--
  --upload_max_filesize = 100M--
*/

/* Carrega as Classes Necessárias */
Controller::loadClass('site/audio/audio'); 
Controller::loadClass('site/audio/audioDB');
Controller::loadClass('site/audioTipo/audioTipo'); 
Controller::loadClass('site/audioTipo/audioTipoDB');

$oAudio = new Audio();
$sAcao = 'lista';
$arrObjAudio = '';
$arrObjAudioTipo = AudioTipoDB::pesquisaAudioTipoLista();

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oAudio->iCodigo    = $_POST['inputCodigo'];
    $oAudio->sDescricao = $_POST['inputDescricao'];
    
    $oAudioTipo = new AudioTipo();
    
    if ($_POST['inputTipo'] !== '-')
    {
        $oAudioTipo->iCodigo = $_POST['inputTipo'];
    }
    else {
        $oAudioTipo->iCodigo = null;
    }
    
    $oAudio->oAudioTipo = $oAudioTipo;
    
    if ( $_FILES['inputAudio']['name'] <> '' )
    {
        $oAudio->sUrl = $_FILES['inputAudio']['name'];
    }
    elseif ( isset( $_POST['inputAudioText'] ) )
    {
        $oAudio->sUrl = $_POST['inputAudioText'];
    }
    else
    {
        $oAudio->sUrl = '';
    }
    
    //$oAudio->sUrl       = $_POST['inputAudio'];
    if ( $oAudio->sUrl <> '')
    {
        $sExtensao    = strtolower ( end ( explode ( '.', $_FILES['inputAudio']['name'] ) ) );
        if ( $sExtensao == 'mp3' )
        {
            if ( $_FILES['inputAudio']['name'] <> '' )
            {
                if ( isset ( $_POST['inputAudioText'] ) )
                {
                    $file = 'sounds/'.$_POST['inputAudioText'];

                    if ( file_exists( $file ) )
                    {
                        @unlink( $file );
                    }
                }
                
                if ( !file_exists ( 'sounds' ) )
                {
                    mkdir( 'sounds' );
                }

                move_uploaded_file ( $_FILES['inputAudio']['tmp_name'], 'sounds/'.$_FILES['inputAudio']['name'] );

            }

        }
        else
        {
            $oAudio->sUrl = $_POST['inputAudioText'];
        }
        
        if ( $oAudio->iCodigo == '' )
        {
            AudioDB::salvaAudio($oAudio);
        }
        else
        {
            AudioDB::alteraAudio($oAudio);
        }
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    AudioDB::excluiAudio($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    AudioDB::setaFiltro(' AND Audio_lng_Codigo = '.$_GET['codigo']);
    $oAudio = AudioDB::pesquisaAudio();
}
else
{
    $arrObjAudio = AudioDB::pesquisaAudioLista();
}   

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjAudio', $arrObjAudio );
$oTemplate->assign ('oAudio', $oAudio );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('arrObjAudioTipo', $arrObjAudioTipo );
$oTemplate->assign ('sPagina', 'audios' );
$oTemplate->assign ('sMenu',   'multimidia' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/audio.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>