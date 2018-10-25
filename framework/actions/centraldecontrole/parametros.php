<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_CONFIGURACOES'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/parametro/parametro'); 
Controller::loadClass('site/parametro/parametroDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

//var_dump ($_POST);

if ( isset ( $_POST['inputSalvar'] ) )
{
    $oParametro = new Parametro();
    
    $oParametro->sRespostaTestemunho   = $_POST['inputRespostaTestemunho'];
    $oParametro->sRespostaPedidoOracao = $_POST['inputRespostaPedidoOracao'];
    
    ParametroDB::alteraParametro($oParametro);
}

$oParametro = ParametroDB::pesquisaParametro();



$oTemplate->assign ('sPagina', 'parametros' );
$oTemplate->assign ('sMenu', 'configuracoes' );

$oTemplate->assign ('oParametro', $oParametro );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/parametros.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>