<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_TAG'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/evento/evento'); 
Controller::loadClass('site/evento/eventoDB');

Controller::loadClass('site/artigo/artigo'); 
Controller::loadClass('site/artigo/artigoDB');

$oEvento = new Evento();

$arrObjEvento = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oEvento->iCodigo    = $_POST['inputCodigo'];
    $oEvento->sTitulo = $_POST['inputTitulo'];
    $oEvento->sData = $_POST['inputData']." ".$_POST['inputHora'];;
    $oEvento->sDescricao = $_POST['inputDescricao'];
    $oEvento->sLocal = $_POST['inputLocal'];
    $oEvento->sLink = $_POST['inputLink'];
    
    if ( $oEvento->iCodigo == '' )
    {
        EventoDB::salvaEvento($oEvento);
    }
    else
    {   
        EventoDB::alteraEvento($oEvento);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    EventoDB::excluiEvento($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    EventoDB::setaFiltro(' AND Evento_lng_Codigo = '.$_GET['codigo']);
    $oEvento = EventoDB::pesquisaEvento();
}
else
{
    $arrObjEvento = EventoDB::pesquisaEventoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

ArtigoDB::setaOrdem(" Artigo_dat_Cadastro DESC");

ArtigoDB::setaFiltro(" AND Tipo_lng_Codigo = 1");

ArtigoDB::setaJoin(" INNER JOIN Art_tag ON ( Artigo.Artigo_lng_Codigo = Art_tag.Artigo_lng_Codigo ) ");

ArtigoDB::setaFiltro(" AND ( Art_tag.Tag_lng_Codigo = 1 )");

$arrObjArtigo = ArtigoDB::pesquisaArtigoLista();



/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjArtigo', $arrObjArtigo);

$oTemplate->assign ('arrObjEvento', $arrObjEvento );
$oTemplate->assign ('oEvento', $oEvento );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'evento' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/evento.tpl');

?>
