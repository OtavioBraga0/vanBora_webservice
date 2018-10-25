<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_TAG'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/tag/tag'); 
Controller::loadClass('site/tag/tagDB');

$oTag = new Tag();
$arrObjTag = '';
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oTag->iCodigo    = $_POST['inputCodigo'];
    $oTag->sDescricao = $_POST['inputDescricao'];
    
    if ( $oTag->iCodigo == '' )
    {
        TagDB::salvaTag($oTag);
    }
    else
    {
        TagDB::alteraTag($oTag);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    TagDB::excluiTag($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    TagDB::setaFiltro(' AND Tag_lng_Codigo = '.$_GET['codigo']);
    $oTag = TagDB::pesquisaTag();
}
else
{
    $arrObjTag = TagDB::pesquisaTagLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjTag', $arrObjTag );
$oTemplate->assign ('oTag', $oTag );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'tags' );
$oTemplate->assign ('sMenu',   'layout' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/tag.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>