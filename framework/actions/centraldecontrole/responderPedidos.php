<?php

if ( $_SESSION['PERMISSOES']['ADMINISTRAR_ESPIRITUALIDADE'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/pedido/pedido'); 
Controller::loadClass('site/pedido/pedidoDB');
Controller::loadClass('site/parametro/parametro'); 
Controller::loadClass('site/parametro/parametroDB');
Controller::loadClass('site/relatorioPedido/relatorioPedido'); 
Controller::loadClass('site/relatorioPedido/relatorioPedidoDB');

$sAcao = 'lista';
$oPedido = new Pedido();
$oParametro = new Parametro();

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

//var_dump ($_POST);

if ( isset ( $_POST['inputEnviarResposta'] ) )
{
    Controller::loadClass ('core/mail');
    
    PedidoDB::responder($_POST['inputCodigo']);
    
    PedidoDB::setaFiltro(' AND Pedido_lng_Codigo = '.$_POST['inputCodigo']);
    $oPedido = PedidoDB::pesquisaPedido();
    
    $sArrDestinatario[0]['Nome']  = $oPedido->sNome;
    $sArrDestinatario[0]['Email'] = $oPedido->sEmail;
    
    /* Define Variáveis do Template */
    $oTemplate->assign('oPedido', $oPedido);
    $oTemplate->assign('sConteudo', $_POST['inputResposta']);
    $oTemplate->assign('sNomeSite', Config::NOME_SITE);
    $oTemplate->assign('sNomePedido', $oPedido->sNome);

    $sConteudo = $oTemplate->fetch('email/respostaPedido.tpl');
    
    if ($oPedido->sTipo == 'T')
    {
        $sArrArgConfig['email_emitente'] = Config::EMAIL_TESTEMUNHO;
        $sArrArgConfig['email_login']    = Config::EMAIL_TESTEMUNHO;
        $sArrArgConfig['email_senha']    = Config::SENHA_EMAIL_TESTEMUNHO;
        
        Mail::setaAssunto($oPedido->sNome.', respondemos o seu Testemunho de fé!');
    }
    elseif ($oPedido->sTipo == 'P')
    {
        $sArrArgConfig['email_emitente'] = Config::EMAIL_PEDIDODEORACAO;
        $sArrArgConfig['email_login']    = Config::EMAIL_PEDIDODEORACAO;
        $sArrArgConfig['email_senha']    = Config::SENHA_EMAIL_PEDIDOORACAO;
        
        Mail::setaAssunto($oPedido->sNome.', respondemos o seu Pedido de oração!');
    }
    
    $sArrArgConfig['nome_emitente']  = Config::NOME_SITE;
    
    Mail::setaConfiguracaoEmail($sArrArgConfig);
    Mail::setaConteudo($sConteudo);
    Mail::setaDestinatario($sArrDestinatario);
    Mail::enviaEmail();
    
    echo "<script>
            alert('E-mail enviado!');
         </script>";
}
else if ( isset ( $_GET['excluir'] ) )
{
    RelatorioPedidoDB::excluiRelatorioPedidoPorPedido($_GET['codigo']);
    PedidoDB::excluiPedido($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] )  )
{
    PedidoDB::setaFiltro(' AND Pedido_lng_Codigo = '.$_GET['codigo']);
    $oPedido = PedidoDB::pesquisaPedido();
    
    $oParametro = ParametroDB::pesquisaParametro();
}

PedidoDB::setaFiltro(" AND  ( Pedido_chr_Tipo = 'T' OR  Pedido_chr_Tipo = 'P') ");
PedidoDB::setaFiltro(" AND  Pedido_chr_Respondido = 'N' ");

$arrObjPedido = PedidoDB::pesquisaPedidoLista();

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'responderPedidos' );
$oTemplate->assign ('sMenu', 'espiritualidade' );

$oTemplate->assign ('arrObjPedido', $arrObjPedido );
$oTemplate->assign ('oPedido', $oPedido );
$oTemplate->assign ('oParametro', $oParametro );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/responderPedidos.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>