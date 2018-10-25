<?php

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/artigo/artigo'); 
Controller::loadClass('site/artigo/artigoDB');
Controller::loadClass('site/artigoTipo/artigoTipo'); 
Controller::loadClass('site/artigoTipo/artigoTipoDB');
Controller::loadClass('site/usuario/usuario'); 
Controller::loadClass('site/usuario/usuarioDB');

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$iTipo = '-';
$sDescricao = '';
$sDataInicial = date("d/m/Y");
$sDataFinal   = date("d/m/Y");

$arrObjArtigoTipo = ArtigoTipoDB::pesquisaArtigoTipoLista();

//Filtro por tipo
if ( isset($_POST['inputTipo'] ))
{
    $iTipo = $_POST['inputTipo'];
    $_SESSION['FILTROS']['TIPO'] = $iTipo;
}
elseif ( isset( $_SESSION['FILTROS']['TIPO'] ))
{
    $iTipo = $_SESSION['FILTROS']['TIPO'];
}

if ( $iTipo <> '-')
{
    ArtigoDB::setaFiltro(' AND Tipo_lng_Codigo = '.$iTipo);
}
ArtigoDB::setaFiltro(' AND Tipo_lng_Codigo NOT IN ( 4, 5 )');

//Filtro por Descri��o
if (isset($_POST['inputDescricao']))
{
    if (trim($_POST['inputDescricao']) <> '')
    {
        $sDescricao = $_POST['inputDescricao'];
    }
    else 
    {
        $sDescricao = '';
        
    }
    $_SESSION['FILTROS']['DESCRICAO']   = $sDescricao;
}
elseif ( isset($_SESSION['FILTROS']['DESCRICAO'] ) && trim($_SESSION['FILTROS']['DESCRICAO']) <> '')
{
    $sDescricao = $_SESSION['FILTROS']['DESCRICAO'];
}

if ( strlen(trim($sDescricao)) >= 1 )
{
    //Seta condi��o falsa para n�o retornar resultado 
    ArtigoDB::setaFiltro(" AND ( ( UPPER(Artigo_vch_Titulo) LIKE UPPER('%".$sDescricao."%') ) OR ( UPPER(Artigo_txt_Conteudo) LIKE UPPER('%".$sDescricao."%') ) )");
}

//Filtro por Data
if ( isset($_POST['inputDataInicial'] ) && $_POST['inputDataInicial'] <> '-')
{
    $sDataInicial = $_POST['inputDataInicial'];
    $sDataFinal   = $_POST['inputDataFinal'];
    
    $_SESSION['FILTROS']['DATA_INICIAL'] = $sDataInicial;
    $_SESSION['FILTROS']['DATA_FINAL']   = $sDataFinal;
}
elseif ( isset($_SESSION['FILTROS']['DATA_INICIAL'] ) && $_SESSION['FILTROS']['DATA_INICIAL'] <> '-')
{
    $sDataInicial = $_SESSION['FILTROS']['DATA_INICIAL'];
    $sDataFinal   = $_SESSION['FILTROS']['DATA_FINAL'];
}
ArtigoDB::setaFiltro (" AND ( DATE( Artigo_dat_Cadastro ) BETWEEN '" . $sDataInicial . "' AND  '" . $sDataFinal . "')  ");

$arrObjArtigo = ArtigoDB::pesquisaArtigoListaPainelDeControle();

$oTemplate->assign ('sDescricao', $sDescricao );
$oTemplate->assign ('iTipo', $iTipo );
$oTemplate->assign ('sDataInicial', $sDataInicial );
$oTemplate->assign ('sDataFinal', $sDataFinal );
$oTemplate->assign ('arrObjArtigo', $arrObjArtigo );
$oTemplate->assign ('arrObjArtigoTipo', $arrObjArtigoTipo );

$oTemplate->assign ('sMenu', 'layout' );
$oTemplate->assign ('sPagina', 'postagens' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/inicial.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>