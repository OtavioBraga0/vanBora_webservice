<?php

if ($_SESSION['PERMISSOES']['CADASTRAR_INFORMATIVO'] == 'N') {
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/informativo/informativo');
Controller::loadClass('site/informativo/informativoDB');

$oInformativo = new Informativo();
$arrObjInformativo = '';
$sAcao = 'lista';

if (isset($_POST['inputSalvar'])) {
    $oInformativo->iCodigo = $_POST['inputCodigo'];
    $oInformativo->sTitulo = $_POST['inputTitulo'];
    //$oInformativo->Url       = $_FILES['inputInformativo']['name'];
    //$oInformativo->sUrl        = $_POST['inputUrl'];
    $oInformativo->sMes = $_POST['inputMes'];
    $oInformativo->sAno = $_POST['inputAno'];
    $oInformativo->iNumero = $_POST['inputNumero'];
    $oInformativo->sDescricao = $_POST['inputDescricao'];
    $oInformativo->sIssuuLink = $_POST['inputIssuuLink'];

    // echo $_FILES['inputCapa']['name'];
    // die();

    if ($_FILES['inputCapa']['name'] != '') {

        if (!file_exists('images/capaInformativo')) {
            mkdir('capaInformativo');
        }

        move_uploaded_file($_FILES['inputCapa']['tmp_name'], 'images/capaInformativo/' . $_FILES['inputCapa']['name']);

    }
    move_uploaded_file($_FILES['inputCapa']['tmp_name'], 'images/capaInformativo/' . $_FILES['inputCapa']['name']);

    if($_FILES['inputCapa']['name'] != ''){
		$oInformativo->sCapa= $_FILES['inputCapa']['name'];
	}
	else {
		$oInformativo->sCapa= $_POST['inputMiniaturaVazio'];
	}

    if ($_FILES['inputInformativo']['name'] != '') {
        $oInformativo->sUrl = $_FILES['inputInformativo']['name'];
    } elseif (isset($_POST['inputInformativoText'])) {
        $oInformativo->sUrl = $_POST['inputInformativoText'];
    } else {
        $oInformativo->sUrl = '';
    }

    if ($oInformativo->sUrl != '') {
        $sExtensao = strtolower(end(explode('.', $_FILES['inputInformativo']['name'])));
        if ($sExtensao == 'pdf') {
            if ($_FILES['inputInformativo']['name'] != '') {
                if (isset($_POST['inputInformativoText'])) {
                    $file = 'informativoPDF/' . $_POST['inputInformativoText'];

                    if (file_exists($file)) {
                        @unlink($file);
                    }
                }

                if (!file_exists('informativoPDF')) {
                    mkdir('informativoPDF');
                }

                move_uploaded_file($_FILES['inputInformativo']['tmp_name'], 'informativoPDF/' . $_FILES['inputInformativo']['name']);

            }
            move_uploaded_file($_FILES['inputInformativo']['tmp_name'], 'informativoPDF/' . $_FILES['inputInformativo']['name']);
        } else {
            $oInformativo->sUrl = $_POST['inputInformativoText'];
        }

        if ($oInformativo->iCodigo == '') {
            InformativoDB::salvaInformativo($oInformativo);
        } else {
            InformativoDB::alteraInformativo($oInformativo);
        }

    }

} else if (isset($_GET['excluir'])) {
    InformativoDB::excluiInformativo($_GET['codigo']);
}

if (isset($_GET['codigo']) && !isset($_GET['excluir'])) {
    InformativoDB::setaFiltro(' AND Informativo_lng_Codigo = ' . $_GET['codigo']);
    $oInformativo = InformativoDB::pesquisaInformativo();
} else {
    $arrObjInformativo = InformativoDB::pesquisaInformativoLista();
}

if (isset($_GET['acao'])) {
    $sAcao = $_GET['acao'];
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

/*
if ( $sAcao == 'publicar' )
{
$sAssinatura = '';
$sParametros = '';
$sInformativoPath = PATH_WWW.'informativos/';

$sParametros = 'actionissuu.document.uploadapiKey'.Config::ISSU_KEY.'nameracingtitleracing';

$sAssinatura = md5(CONFIG::ISSU_SECRET.$sParametros);

$oTemplate->assign ('sAssinatura', $sAssinatura );
$oTemplate->assign ('sInformativoPath',  $sInformativoPath);
}
 */

$oTemplate->assign('arrObjInformativo', $arrObjInformativo);
$oTemplate->assign('oInformativo', $oInformativo);

$oTemplate->assign('sAcao', $sAcao);
$oTemplate->assign('sPagina', 'informativos');
$oTemplate->assign('sMenu', 'multimidia');
/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/informativo.tpl');

//echo '<pre>';
//var_dump ( $_SESSION );
