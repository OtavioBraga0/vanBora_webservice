<?php

if ( $_SESSION['PERMISSOES']['VISUALIZAR_RELATORIOS'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/colaborador/colaborador'); 
Controller::loadClass('site/colaborador/colaboradorDB');
Controller::loadClass('site/logradouro/logradouro'); 
Controller::loadClass('site/logradouro/logradouroDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$arrObjColaborador = '';
$sExibeRelatorio = false;
$sDataInicial = date("d/m/Y");
$sDataFinal   = date("d/m/Y");

if ( isset ( $_POST['inputFiltrar'] ) )
{
    $sDataInicial = $_POST['inputDataInicial'];
    $sDataFinal   = $_POST['inputDataFinal'];;

    ColaboradorDB::setaFiltro (" AND ( DATE( Colaborador_dat_DataCadastro ) BETWEEN '" . Util::converterDataParaMysql($sDataInicial) . "' AND  '" . Util::converterDataParaMysql($sDataFinal) . "')  ");

    
    $arrObjColaborador = ColaboradorDB::pesquisaColaboradorLista();
    
    $sExibeRelatorio = true;
}

$oTemplate->assign ('sDataInicial', $sDataInicial );
$oTemplate->assign ('sDataFinal', $sDataFinal );
$oTemplate->assign ('sExibeRelatorio', $sExibeRelatorio );
$oTemplate->assign ('arrObjColaborador', $arrObjColaborador );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/relatorioColaborador.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>