<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_CARROSSEL'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/popup/popup'); 
Controller::loadClass('site/popup/popupDB');

$oPopup = new Popup();
$arrObjPopup = '';
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    
    if ( isset ( $_POST['inputPopupHidden'] ) && $_FILES['inputPopup']['name'] == '' )
    {
        $oPopup->sImagemUrl = $_POST['inputPopupHidden'];
    }
    else
    {
        $oPopup->sImagemUrl = $_FILES['inputPopup']['name'];
       
    }
    
    if ( $oPopup->sImagemUrl <> '')
    {
    
        $oPopup->iCodigo        = $_POST['inputCodigo'];
        $oPopup->sDescricao     = $_POST['inputDescricao'];
        $oPopup->sLink          = $_POST['inputLink'];
        $oPopup->bLinkExterno   = $_POST['inputLinkExterno'];
        $oPopup->sCadastro      = date( 'Y-m-d H:i:s' );
        $oPopup->iCodigoUsuario = $_SESSION['CODIGO'];

        $sEntrada = "";
        $sExpiracao   = "";
        
        if (($_POST['inputEntradaData'] !== "") && ($_POST['inputEntradaHora'] !== "")) {
            $sEntrada = Util::converterDataParaMysql($_POST['inputEntradaData']) . " " . $_POST['inputEntradaHora'] . ":00";
        }
        else {
            $sEntrada = null;
        }

        if (($_POST['inputExpiracaoData'] !== "") && ($_POST['inputExpiracaoHora'] !== "")) {
            $sExpiracao = Util::converterDataParaMysql($_POST['inputExpiracaoData']) . " " . $_POST['inputExpiracaoHora'] . ":00";
        }
        else {
            $sExpiracao = null;
        }

        $oPopup->sEntrada = $sEntrada;
        $oPopup->sExpiracao = $sExpiracao;
        
        if ( $_FILES['inputPopup']['name'] <> '' )
        {
            if ( isset ( $_POST['inputPopupHidden'] ) )
            {
                $file = 'images/banner/'.$_POST['inputPopupHidden'];
                        
                if ( file_exists( $file ) )
                {
                    @unlink( $file );
                }
            }
            
            if ( !file_exists ( 'images/banner/' ) )
            {
                mkdir( 'images/banner/' );
            }
            
             move_uploaded_file ( $_FILES['inputPopup']['tmp_name'], 'images/banner/'.$_FILES['inputPopup']['name'] );
        }


        if ( $oPopup->iCodigo == '' )
        {
            PopupDB::salvaPopup($oPopup);
        }
        else
        {
            PopupDB::alteraPopup($oPopup);
        }
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    PopupDB::excluiPopup($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    PopupDB::setaFiltro(' AND Popup_lng_Codigo = '.$_GET['codigo']);
    $oPopup = PopupDB::pesquisaPopup();
}
else
{
    $arrObjPopup = PopupDB::pesquisaPopupListaCentralDeControle();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjPopup', $arrObjPopup );
$oTemplate->assign ('oPopup', $oPopup );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'popup' );
$oTemplate->assign ('sMenu',   'layout' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/popup.tpl');

?>