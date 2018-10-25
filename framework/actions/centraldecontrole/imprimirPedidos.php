<?php

/* Carrega as Classes Necessárias */
Controller::loadClass('site/pedido/pedido'); 
Controller::loadClass('site/pedido/pedidoDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$arrObjPedido = '';
$sExibeRelatorio = false;
$sExibirPedidosVela = false;
$sDataInicial = date("d/m/Y");
$sDataFinal   = date("d/m/Y");

if ( isset ( $_POST['inputFiltrar'] ) )
{
    $sDataInicial = $_POST['inputDataInicial'];
    $sDataFinal   = $_POST['inputDataFinal'];;

    PedidoDB::setaFiltro (" AND ( DATE( Pedido_dat_Data ) BETWEEN '" . Util::converterDataParaMysql($sDataInicial) . "' AND  '" . Util::converterDataParaMysql($sDataFinal) . "')  ");
    
    if ( isset ( $_POST['exibirPedidosVela'] ) )
    {
        PedidoDB::setaFiltro (" AND  ( Pedido_chr_Tipo = 'P' OR  Pedido_chr_Tipo = 'V' ) ");
        $sExibirPedidosVela = true;
    }
    else
    {
        PedidoDB::setaFiltro (" AND  Pedido_chr_Tipo = 'P' ");
    }
    
    $arrObjPedido = PedidoDB::pesquisaPedidoLista();
    
    $sExibeRelatorio = true;
}

$oTemplate->assign ('sDataInicial', $sDataInicial );
$oTemplate->assign ('sDataFinal', $sDataFinal );
$oTemplate->assign ('sExibirPedidosVela', $sExibirPedidosVela );
$oTemplate->assign ('sExibeRelatorio', $sExibeRelatorio );
$oTemplate->assign ('arrObjPedido', $arrObjPedido );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/imprimirPedidos.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>