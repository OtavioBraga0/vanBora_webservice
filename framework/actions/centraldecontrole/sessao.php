<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_TAG'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/sessao/sessao'); 
Controller::loadClass('site/sessao/sessaoDB');


$oSessao = new Sessao();

$arrObjSessao = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oSessao->iCodigo    = $_POST['inputCodigo'];
    $oSessao->sTitulo = $_POST['inputTitulo'];
    $oSessao->sConteudo = $_POST['inputConteudo'];
    
    if ( $oSessao->iCodigo == '' )
    {
        SessaoDB::salvaSessao($oSessao);
    }
    else
    {   
        SessaoDB::alteraSessao($oSessao);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    SessaoDB::excluiSessao($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    SessaoDB::setaFiltro(' AND Sessao_lng_Codigo = '.$_GET['codigo']);
    $oSessao = SessaoDB::pesquisaSessao();
}
else
{
    $arrObjSessao = SessaoDB::pesquisaSessaoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjSessao', $arrObjSessao );
$oTemplate->assign ('oSessao', $oSessao );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'Sessao' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/sessao.tpl');

?>
