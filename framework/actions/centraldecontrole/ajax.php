<?php

@header( 'Content-Type: text/html; charset=iso-8859-1' );

Controller::loadClass('core/util'); 
Controller::loadClass('site/menu/menu'); 
Controller::loadClass('site/menu/menuDB');
Controller::loadClass('site/artigo/artigo'); 
Controller::loadClass('site/artigo/artigoDB');
Controller::loadClass('site/artigoTag/artigoTag'); 
Controller::loadClass('site/artigoTag/artigoTagDB');
Controller::loadClass('site/artigoTipo/artigoTipo'); 
Controller::loadClass('site/artigoTipo/artigoTipoDB');
Controller::loadClass('site/informativo/informativo'); 
Controller::loadClass('site/informativo/informativoDB');

if ( isset( $_POST['action'] ) )
{
    $action = $_POST['action'];
    $action();
}

function salvarOrdemMenu()
{
    
    $oMenu = new Menu();
    
    if ( isset ( $_POST['arrPosicoesMenu'] ) )
    {
        $arrPosicoesMenu = $_POST['arrPosicoesMenu'];
        
        for ($index = 0; $index < count($arrPosicoesMenu); $index++) 
        {
            $oMenu->iCodigo  = $arrPosicoesMenu[$index];
            $oMenu->iPosicao = $index;
            
            MenuDB::alteraOrdemMenu($oMenu);
        }
        
    }
}

function verificaTituloIgual()
{
    
    $sMensagemRetorno = '';
    
    ArtigoDB::setaFiltro(" AND Artigo_vch_Titulo = '".$_POST['sTitulo']."'");
    $oArtigo = ArtigoDB::pesquisaArtigo();

    if ($oArtigo->iCodigo == '')
    {
        $sMensagemRetorno = '<label class="blue">Título válido</label>';
    }
    else
    {
        $sMensagemRetorno = '<label class="red">Já existe uma página com este título</label>';
    }
    
    echo $sMensagemRetorno;
}

function verificaLinkIgual()
{
    
    $bMensagemRetorno = false;
    
    ArtigoDB::setaFiltro(" AND Artigo_vch_Link = '".Util::formataUrl(utf8_decode($_POST['sTitulo']))."'");
    $oArtigo = ArtigoDB::pesquisaArtigo();

    if ($oArtigo->iCodigo == '')
    {
        $bMensagemRetorno = true;
    }
    else
    {
        $bMensagemRetorno = false;
    }
    
    echo $bMensagemRetorno;
}

function verificaInformativoValido()
{
    $sMensagemRetorno = '';
    
    InformativoDB::setaFiltro(" AND Informativo_chr_Mes = '".$_POST['sMes']."' AND Informativo_chr_Ano = '".$_POST['sAno']."'");
    $oInformativo = InformativoDB::pesquisaInformativo();

    if ($oInformativo->iCodigo == '')
    {
        $sMensagemRetorno = '';
    }
    else
    {
        $sMensagemRetorno = '<label class="red">Já existe um informativo nesta data</label>';
    }
    
    echo $sMensagemRetorno;
}

?>