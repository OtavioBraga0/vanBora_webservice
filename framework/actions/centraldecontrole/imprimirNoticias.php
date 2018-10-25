<?php

/* Carrega as Classes Necessárias */
Controller::loadClass('site/artigo/artigo'); 
Controller::loadClass('site/artigo/artigoDB');
Controller::loadClass('site/artigoTipo/artigoTipo'); 
Controller::loadClass('site/artigoTipo/artigoTipoDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$arrObjArtigo = '';
$sExibeRelatorio = false;
$sDataInicial = date("d/m/Y");
$sDataFinal   = date("d/m/Y");

if ( isset ( $_POST['inputFiltrar'] ) )
{
    $sDataInicial = $_POST['inputDataInicial'];
    $sDataFinal   = $_POST['inputDataFinal'];

    ArtigoDB::setaFiltro(" AND (Artigo_vch_FonteDescricao = '' OR Artigo_vch_FonteDescricao IS NULL)");
    ArtigoDB::setaFiltro(" AND (Artigo_vch_FonteUrl = '' OR Artigo_vch_FonteUrl IS NULL)");
    ArtigoDB::setaFiltro(" AND (Tipo_lng_Codigo = 1)");
    ArtigoDB::setaFiltro (" AND ( DATE( Artigo_dat_Cadastro ) BETWEEN '" . Util::converterDataParaMysql($sDataInicial) . "' AND  '" . Util::converterDataParaMysql($sDataFinal) . "')  ");

    $arrObjArtigo = ArtigoDB::pesquisaArtigoLista();
    
    $sExibeRelatorio = true;
}

$oTemplate->assign ('sDataInicial', $sDataInicial );
$oTemplate->assign ('sDataFinal', $sDataFinal );
$oTemplate->assign ('sExibeRelatorio', $sExibeRelatorio );
$oTemplate->assign ('arrObjArtigo', $arrObjArtigo );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/imprimirNoticias.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>