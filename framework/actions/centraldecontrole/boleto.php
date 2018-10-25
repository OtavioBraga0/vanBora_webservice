<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_CONFIGURACOES'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/boleto/boleto'); 
Controller::loadClass('site/boleto/boletoDB');
Controller::loadClass('site/banco/banco'); 
Controller::loadClass('site/banco/bancoDB');

$oBoleto      = new Boleto();
$arrObjBoleto = '';
$arrObjBanco  = '';
$sAcao        = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oBoleto->iCodigo          = $_POST['inputCodigo'];
    $oBoleto->iIdBanco         = $_POST['inputBanco'];
    $oBoleto->sConvenio        = $_POST['inputConvenio'];
    $oBoleto->sCarteira        = $_POST['inputCarteira'];
    $oBoleto->sCodigoCedente   = $_POST['inputCodigoCedente'];
    $oBoleto->sNomeCedente     = $_POST['inputNomeCedente'];
    $oBoleto->sCNPJCedente     = $_POST['inputCNPJCedente'];
    $oBoleto->sEnderecoCedente = $_POST['inputEnderecoCedente'];
    $oBoleto->sBairroCedente   = $_POST['inputBairroCedente'];
    $oBoleto->sCEPCedente      = $_POST['inputCEPCedente'];
    $oBoleto->sNumeroCedente   = $_POST['inputNumeroCedente'];
    $oBoleto->sCidadeCedente   = $_POST['inputCidadeCedente'];
    $oBoleto->sEstadoCedente   = $_POST['inputEstadoCedente'];
    $oBoleto->sAgenciaNumero   = $_POST['inputAgenciaNumero'];
    $oBoleto->sAgenciaDigito   = $_POST['inputAgenciaDigito'];
    $oBoleto->sContaNumero     = $_POST['inputContaNumero'];
    $oBoleto->sContaDigito     = $_POST['inputContaDigito'];
    $oBoleto->sOperacao        = $_POST['inputOperacao'];
    /* $oBoleto->sLogoGrande      = $_POST['inputLogoGrande'];
    $oBoleto->sLogoPequeno     = $_POST['inputLogoPequeno']; */
    $oBoleto->sLocalPagamento1 = $_POST['inputLocalPagamento1'];
    $oBoleto->sLocalPagamento2 = $_POST['inputLocalPagamento2'];
    $oBoleto->sInstrucao1      = $_POST['inputInstrucao1'];
    $oBoleto->sInstrucao2      = $_POST['inputInstrucao2'];
    $oBoleto->sInstrucao3      = $_POST['inputInstrucao3'];
    $oBoleto->sInstrucao4      = $_POST['inputInstrucao4'];
    $oBoleto->sInstrucao5      = $_POST['inputInstrucao5'];
    $oBoleto->sInstrucao6      = $_POST['inputInstrucao6'];
    $oBoleto->sInstrucao7      = $_POST['inputInstrucao7'];
    $oBoleto->sInstrucao8      = $_POST['inputInstrucao8'];
    $oBoleto->sAtivo           = $_POST['inputAtivo']; 
    $oBoleto->sDataCadastro      = date( 'Y-m-d H:i:s' );
    $oBoleto->sDataModificacao   = date( 'Y-m-d H:i:s' );
    
    BoletoDB::desativaConvenios();
    
    if ( $_POST['inputCodigo'] == '' )
    {
        BoletoDB::salvaBoleto($oBoleto);
    }
    else
    {
        BoletoDB::alteraBoleto($oBoleto);
    }
    
}
else if ( isset ( $_GET['excluir'] ) )
{
    BoletoDB::excluiBoleto($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    BoletoDB::setaFiltro(" AND Boleto_lng_Codigo = ".$_GET['codigo']);
    $oBoleto = BoletoDB::pesquisaBoleto();
}
else
{
    $arrObjBoleto = BoletoDB::pesquisaBoletoLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}
    
if ( $sAcao == 'editar')
{
    $arrObjBanco  = BancoDB::pesquisaBancoLista();
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjBoleto', $arrObjBoleto );
$oTemplate->assign ('arrObjBanco',  $arrObjBanco );
$oTemplate->assign ('oBoleto', $oBoleto );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'boleto' );
$oTemplate->assign ('sMenu',   'configuracoes' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/boleto.tpl');


//echo '<pre>';

?>