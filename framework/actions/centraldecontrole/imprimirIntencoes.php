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

$arrObjPedido = '';
$sExibeRelatorio = false;
$sExibirPedidosVela = false;
$sDataInicial = date("d/m/Y");
$sDataFinal   = date("d/m/Y");

if ( isset ( $_POST['inputFiltrar'] ) ||  isset ( $_POST['inputGerarRelatorioPublico'] ))
{
    $sDataInicial = $_POST['inputDataInicial'];
    $sDataFinal   = $_POST['inputDataFinal'];

    PedidoDB::setaFiltro (" AND ( DATE( Pedido_dat_Data ) BETWEEN '" . Util::converterDataParaMysql($sDataInicial) . "' AND  '" . Util::converterDataParaMysql($sDataFinal) . "')  ");
    
    if ( isset ( $_POST['exibirPedidosVela'] ) )
    {
        PedidoDB::setaFiltro (" AND  ( Pedido_chr_Tipo <> 'P' OR  Pedido_chr_Tipo = 'V' OR  Pedido_chr_Tipo = 'R' ) ");
        $sExibirPedidosVela = true;
    }
    else
    {
        PedidoDB::setaFiltro (" AND  Pedido_chr_Tipo = 'P' ");
    }
    
    $arrObjPedido = PedidoDB::pesquisaPedidoLista();
    
    if (isset($_POST['inputGerarRelatorioPublico'])) {
        
        $oRelatorio = new Relatorio();
        $oRelatorio->sData = date( 'Y-m-d H:i:s' );
        $iRelatorioCodigo = RelatorioDB::salvaRelatorio($oRelatorio);
        
        foreach ($arrObjPedido as $oPedido) {
            $oRelatorioPedido = new RelatorioPedido();
            $oRelatorioPedido->iPedido = $oPedido->iCodigo;
            $oRelatorioPedido->iRelatorio = $iRelatorioCodigo;
            $oRelatorioPedido->sAtivo = "S";
            RelatorioPedidoDB::salvaRelatorioPedido($oRelatorioPedido);
        }
        
        header("Location: ".PATH_WWW."relatorio/pedido/".Util::encode($iRelatorioCodigo));        
    }
    else {
        $sExibeRelatorio = true;
    }    
}

$oTemplate->assign ('sDataInicial', $sDataInicial );
$oTemplate->assign ('sDataFinal', $sDataFinal );
$oTemplate->assign ('sExibirPedidosVela', $sExibirPedidosVela );
$oTemplate->assign ('sExibeRelatorio', $sExibeRelatorio );
$oTemplate->assign ('arrObjPedido', $arrObjPedido );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/imprimirIntencoes.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>