<?php

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/equipe/equipe'); 
Controller::loadClass('site/equipe/equipeDB');


$oEquipe = new Equipe();

$arrObjEquipe = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oEquipe->iCodigo    = $_POST['inputCodigo'];
    $oEquipe->sNome = $_POST['inputNome'];
    $oEquipe->sCargo = $_POST['inputCargo'];
    

    if ($_FILES['inputImagem']['name'] != '') {

        if (!file_exists('images/equipe')) {
            mkdir('equipe');
        }

        move_uploaded_file($_FILES['inputImagem']['tmp_name'], 'images/equipe/' . $_FILES['inputImagem']['name']);

    }
    move_uploaded_file($_FILES['inputImagem']['tmp_name'], 'images/equipe/' . $_FILES['inputImagem']['name']);

    if($_FILES['inputImagem']['name'] != ''){
		$oEquipe->sUrlImagem = $_FILES['inputImagem']['name'];
	}
	else {
		$oEquipe->sUrlImagem = $_POST['inputMiniaturaVazio'];
	}

    if ( $oEquipe->iCodigo == '' )
    {
        EquipeDB::salvaEquipe($oEquipe);
    }
    else
    {   
        EquipeDB::alteraEquipe($oEquipe);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    EquipeDB::excluiEquipe($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    EquipeDB::setaFiltro(' AND Equipe_lng_Codigo = '.$_GET['codigo']);
    $oEquipe = EquipeDB::pesquisaEquipe();
}
else
{
    $arrObjEquipe = EquipeDB::pesquisaEquipeLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjEquipe', $arrObjEquipe );
$oTemplate->assign ('oEquipe', $oEquipe );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'equipe' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/equipe.tpl');

?>
