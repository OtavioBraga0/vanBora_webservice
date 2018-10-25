<?php

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/fundraising/fundraising'); 
Controller::loadClass('site/fundraising/fundraisingDB');


$oFundraising = new Fundraising();

$arrObjFundraising = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oFundraising->iCodigo    = $_POST['inputCodigo'];
    $oFundraising->sNome = $_POST['inputNome'];
    $oFundraising->sConteudo = $_POST['inputConteudo'];

    if ( $oFundraising->iCodigo == '' )
    {
        FundraisingDB::salvaFundraising($oFundraising);
    }
    else
    {   
        FundraisingDB::alteraFundraising($oFundraising);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    FundraisingDB::excluiFundraising($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    FundraisingDB::setaFiltro(' AND Fundraising_lng_Codigo = '.$_GET['codigo']);
    $oFundraising = FundraisingDB::pesquisaFundraising();
}
else
{
    $arrObjFundraising = FundraisingDB::pesquisaFundraisingLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjFundraising', $arrObjFundraising );
$oTemplate->assign ('oFundraising', $oFundraising );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'fundraising' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/fundraising.tpl');

?>
