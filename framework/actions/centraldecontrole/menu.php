<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_MENU'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/menu/menu'); 
Controller::loadClass('site/menu/menuDB');

$oMenu = new Menu();
$oMenuPai = new Menu();
$oMenuAnterior = new Menu();
$arrObjMenu = '';
$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oMenu->iCodigo     = $_POST['inputCodigo'];
    $oMenu->sDescricao  = $_POST['inputDescricao'];
    //$oMenu->Link       = $_FILES['inputMenu']['name'];
    $oMenu->sLink        = $_POST['inputLink'];
    $oMenu->sAtivo       = $_POST['inputAtivo'];
    
    if ( isset ( $_GET['codigoMenuPai'] ) )
    {
        $oMenu->iCodigoPai = $_GET['codigoMenuPai'];
    }
    else
    {
        $oMenu->iCodigoPai = NULL;
    }
    
   // move_uploaded_file ( $_FILES['inputMenu']['tmp_name'], 'sounds/'.$_FILES['inputMenu']['name'] );
    
    if ( $oMenu->iCodigo == '' )
    {
        MenuDB::salvaMenu($oMenu);
    }
    else
    {
        MenuDB::alteraMenu($oMenu);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    $bExisteSubmenu = MenuDB::verificaSubmenu($_GET['codigo']);
    
    if ( $bExisteSubmenu == true )
    {
        echo "<script>alert('Exclua todos os submenus deste menu para finalizar.')</script>";
    }
    else
    {
        MenuDB::excluiMenu($_GET['codigo']);
    }
}


if ( ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) ) )
{
    //if ( isset ( $_GET['codigoMenuPai'] ) )
    //{
        //MenuDB::setaFiltro(' AND Menu_lng_Codigo = '.$_GET['codigoMenuPai']);
    //}
   // else
   // {
   //     MenuDB::setaFiltro(' AND Menu_lng_Codigo = '.$_GET['codigo']);
   // }
    
    MenuDB::setaFiltro(' AND Menu_lng_Codigo = '.$_GET['codigo']);
    $oMenu = MenuDB::pesquisaMenu();
    
}
else
{
    if ( isset ( $_GET['codigoMenuPai'] ) )
    {
        MenuDB::setaFiltro(' AND Menu_lng_Codigo = '.$_GET['codigoMenuPai']);
        $oMenuPai = MenuDB::pesquisaMenu();

        MenuDB::setaFiltro(" AND  Menu_lng_Codigo = ( SELECT Menu_lng_CodigoPai FROM Menu WHERE Menu_lng_Codigo = ".$_GET['codigoMenuPai'].") ");
        $oMenuAnterior = MenuDB::pesquisaMenu();

        MenuDB::setaFiltro(' AND Menu_lng_CodigoPai = '.$_GET['codigoMenuPai']);
    }
    else
    {
        MenuDB::setaFiltro(' AND Menu_lng_CodigoPai IS NULL ');
    }

    $arrObjMenu = MenuDB::pesquisaMenuLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}



/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjMenu', $arrObjMenu );
$oTemplate->assign ('oMenu', $oMenu );
$oTemplate->assign ('oMenuPai', $oMenuPai );
$oTemplate->assign ('oMenuAnterior', $oMenuAnterior );
$oTemplate->assign ('sAcao', $sAcao );

$oTemplate->assign ('sPagina', 'menu' );
$oTemplate->assign ('sMenu', 'layout' );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/menu.tpl');

?>