<?php

if ( $_SESSION['PERMISSOES']['ADMINISTRAR_ESPIRITUALIDADE'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/pedido/pedido');
Controller::loadClass('site/pedido/pedidoDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

//var_dump ($_POST);

if ( isset ( $_POST['inputAprovar'] ) )
{
    if ( isset ( $_POST['inputPedido'] ) )
    {
        foreach ( $_POST['inputPedido'] as $key => $value)
        {
            PedidoDB::aprovar($value);
        }
    }
}
else if ( isset ( $_POST['inputExcluir'] ) )
{
    if ( isset ( $_POST['inputPedido'] ) )
    {
        foreach ( $_POST['inputPedido'] as $key => $value)
        {
            PedidoDB::excluiPedido($value);
        }
    }
}

PedidoDB::setaFiltro(' AND (COALESCE(Pedido_chr_Aprovado, "N") = "N")');
PedidoDB::setaFiltro (" AND  Pedido_chr_Tipo <> 'P' ");

$arrObjPedido = PedidoDB::pesquisaPedidoLista();

$oTemplate->assign ('sPagina', 'aprovarPedidos' );
$oTemplate->assign ('sMenu', 'espiritualidade' );


$oTemplate->assign ('arrObjPedido', $arrObjPedido );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/aprovarPedidos.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>