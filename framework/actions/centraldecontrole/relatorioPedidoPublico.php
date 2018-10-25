<?php

if ( $_SESSION['PERMISSOES']['ADMINISTRAR_ESPIRITUALIDADE'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/pedido/pedido'); 
Controller::loadClass('site/pedido/pedidoDB');
Controller::loadClass('site/relatorio/relatorio'); 
Controller::loadClass('site/relatorio/relatorioDB');
Controller::loadClass('site/relatorioPedido/relatorioPedido'); 
Controller::loadClass('site/relatorioPedido/relatorioPedidoDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$arrObjRelatorio = '';

if ( isset ( $_GET['excluir'] ) )
{
    RelatorioPedidoDB::excluiRelatorioPedido($_GET['codigo']);
    RelatorioDB::excluiRelatorio($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    RelatorioDB::setaFiltro(' AND Relatorio_lng_Codigo = '.$_GET['codigo']);
    $oRelatorio = RelatorioDB::pesquisaRelatorio();
}
else
{
    RelatorioDB::setaOrdem(" Relatorio_lng_Codigo DESC ");
    $arrObjRelatorio = RelatorioDB::pesquisaRelatorioLista();
} 

$oTemplate->assign ('sPagina', 'relatoriosPublicos' );
$oTemplate->assign ('sMenu',   'espiritualidade' );
$oTemplate->assign ('arrObjRelatorio', $arrObjRelatorio );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/relatorioPedidoPublico.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>