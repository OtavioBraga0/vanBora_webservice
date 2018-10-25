<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_TAG'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/depoimento/depoimento'); 
Controller::loadClass('site/depoimento/depoimentoDB');


$oDepoimento = new Depoimento();

$arrObjDepoimento = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oDepoimento->iCodigo    = $_POST['inputCodigo'];
    $oDepoimento->sNome = $_POST['inputNome'];
    $oDepoimento->sEmpresa = $_POST['inputEmpresa'];
    $oDepoimento->sConteudo = $_POST['inputConteudo'];
    

    if ($_FILES['inputCapa']['name'] != '') {

        if (!file_exists('images/depoimento')) {
            mkdir('depoimento');
        }

        move_uploaded_file($_FILES['inputCapa']['tmp_name'], 'images/depoimento/' . $_FILES['inputCapa']['name']);

    }
    move_uploaded_file($_FILES['inputCapa']['tmp_name'], 'images/depoimento/' . $_FILES['inputCapa']['name']);

    if($_FILES['inputCapa']['name'] != ''){
		$oDepoimento->sUrlImagem = $_FILES['inputCapa']['name'];
	}
	else {
		$oDepoimento->sUrlImagem = $_POST['inputMiniaturaVazio'];
	}

    if ( $oDepoimento->iCodigo == '' )
    {
        DepoimentoDB::salvaDepoimento($oDepoimento);
    }
    else
    {   
        DepoimentoDB::alteraDepoimento($oDepoimento);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    DepoimentoDB::excluiDepoimento($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    DepoimentoDB::setaFiltro(' AND Depoimento_lng_Codigo = '.$_GET['codigo']);
    $oDepoimento = DepoimentoDB::pesquisaDepoimento();
}
else
{
    $arrObjDepoimento = DepoimentoDB::pesquisaDepoimentoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjDepoimento', $arrObjDepoimento );
$oTemplate->assign ('oDepoimento', $oDepoimento );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'depoimento' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/depoimento.tpl');

?>
