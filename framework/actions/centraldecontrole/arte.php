<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_TAG'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/arte/arte');
Controller::loadClass('site/arte/arteDB');

$oArte = new Arte();

$arrObjArte = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oArte->iCodigo    = $_POST['inputCodigo'];
    $oArte->sTitulo = $_POST['inputTitulo'];
    $oArte->sEntrada =$_POST['inputEntrada'];
    $oArte->sSaida = $_POST['inputSaida'];


	if ($_FILES['inputiniatura']['name'] != '') {

        if (!file_exists('images/fotosAlbuns')) {
            mkdir('fotosAlbuns');
        }

        move_uploaded_file($_FILES['inputMiniatura']['tmp_name'], 'images/fotosAlbuns/' . $_FILES['inputMiniatura']['name']);

    }
    move_uploaded_file($_FILES['inputMiniatura']['tmp_name'], 'images/fotosAlbuns/' . $_FILES['inputMiniatura']['name']);

	if($_FILES['inputMiniatura']['name'] != ''){
		$oArte->sUrlImagem= $_FILES['inputMiniatura']['name'];
	}
	else {
		$oArte->sUrlImagem= $_POST['inputMiniaturaVazio'];
	}

    if ( $oArte->iCodigo == '' )
    {
        ArteDB::salvaArte($oArte);
    }
    else
    {
        ArteDB::alteraArte($oArte);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    ArteDB::excluiArte($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    ArteDB::setaFiltro(' AND Arte_lng_Codigo = '.$_GET['codigo']);
    $oArte = ArteDB::pesquisaArte();
}
else
{
    $arrObjArte = ArteDB::pesquisaArteLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjArte', $arrObjArte );
$oTemplate->assign ('oArte', $oArte );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'Arte' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/arte.tpl');

?>
