<?php

if ( $_SESSION['CADASTRAR_TAG'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/menu/menu'); 
Controller::loadClass('site/menu/menuDB');
Controller::loadClass('site/submenu/submenu'); 
Controller::loadClass('site/submenu/submenuDB');

$oSubmenu = new Submenu();
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oSubmenu->iCodigo      = $_POST['inputCodigo'];
    $oSubmenu->sDescricao   = $_POST['inputDescricao'];
    //$oSubmenu->Link       = $_FILES['inputSubmenu']['name'];
    $oSubmenu->sLink        = $_POST['inputLink'];
    $oSubmenu->sAtivo       = $_POST['inputAtivo'];
    $oSubmenu->iCodigoMenu  = $_GET['menu'];
    
   // move_uploaded_file ( $_FILES['inputSubmenu']['tmp_name'], 'sounds/'.$_FILES['inputSubmenu']['name'] );
    
    if ( $oSubmenu->iCodigo == '' )
    {
        SubmenuDB::salvaSubmenu($oSubmenu);
    }
    else
    {
        SubmenuDB::alteraSubmenu($oSubmenu);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    SubmenuDB::excluiSubmenu($_GET['codigo']);
}


if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    SubmenuDB::setaFiltro(' AND Submenu_lng_Codigo = '.$_GET['codigo']);
    $oSubmenu = SubmenuDB::pesquisaSubmenu();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

SubmenuDB::setaFiltro(' AND Menu_lng_Codigo = '.$_GET['menu']);
$arrObjSubmenu = SubmenuDB::pesquisaSubmenuLista();

MenuDB::setaFiltro('AND Menu_lng_Codigo = '.$_GET['menu']);
$oMenu         = MenuDB::pesquisaMenu();

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjSubmenu', $arrObjSubmenu );
$oTemplate->assign ('oSubmenu', $oSubmenu );
$oTemplate->assign ('oMenu', $oMenu );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'submenu' );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/submenu.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>