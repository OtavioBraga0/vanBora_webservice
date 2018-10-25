<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_CARROSSEL'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/carrossel/carrossel'); 
Controller::loadClass('site/carrossel/carrosselDB');

$oCarrossel = new Carrossel();
$arrObjCarrossel = '';
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    
    if ( isset ( $_POST['inputCarrosselHidden'] ) && $_FILES['inputCarrossel']['name'] == '' )
    {
        $oCarrossel->sImagemUrl = $_POST['inputCarrosselHidden'];
    }
    else
    {
        $oCarrossel->sImagemUrl = $_FILES['inputCarrossel']['name'];
       
    }
    
    if ( $oCarrossel->sImagemUrl <> '')
    {
    
        $oCarrossel->iCodigo        = $_POST['inputCodigo'];
        $oCarrossel->sDescricao     = $_POST['inputDescricao'];
        $oCarrossel->sLink          = $_POST['inputLink'];
        $oCarrossel->bLinkExterno   = $_POST['inputLinkExterno'];
        $oCarrossel->sCadastro      = date( 'Y-m-d H:i:s' );
        $oCarrossel->iCodigoUsuario = $_SESSION['CODIGO'];

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

        $oCarrossel->sEntrada = $sEntrada;
        $oCarrossel->sExpiracao = $sExpiracao;
        
        if ( $_FILES['inputCarrossel']['name'] <> '' )
        {
            if ( isset ( $_POST['inputCarrosselHidden'] ) )
            {
                $file = 'images/banner/'.$_POST['inputCarrosselHidden'];
                        
                if ( file_exists( $file ) )
                {
                    @unlink( $file );
                }
            }
            
            if ( !file_exists ( 'images/banner/' ) )
            {
                mkdir( 'images/banner/' );
            }
            
             move_uploaded_file ( $_FILES['inputCarrossel']['tmp_name'], 'images/banner/'.$_FILES['inputCarrossel']['name'] );
        }


        if ( $oCarrossel->iCodigo == '' )
        {
            CarrosselDB::salvaCarrossel($oCarrossel);
        }
        else
        {
            CarrosselDB::alteraCarrossel($oCarrossel);
        }
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    CarrosselDB::excluiCarrossel($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    CarrosselDB::setaFiltro(' AND Carrossel_lng_Codigo = '.$_GET['codigo']);
    $oCarrossel = CarrosselDB::pesquisaCarrossel();
}
else
{
    $arrObjCarrossel = CarrosselDB::pesquisaCarrosselListaCentralDeControle();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjCarrossel', $arrObjCarrossel );
$oTemplate->assign ('oCarrossel', $oCarrossel );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'carrossel' );
$oTemplate->assign ('sMenu',   'layout' );
/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/carrossel.tpl');

?>