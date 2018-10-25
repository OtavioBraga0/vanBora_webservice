<?php

/* Carrega as Classes Necess�rias */
Controller::loadClass('site/cliente/cliente'); 
Controller::loadClass('site/cliente/clienteDB');


$oCliente = new Cliente();

$arrObjCliente = '';

$sAcao = 'lista';

if  ( isset ( $_POST['inputSalvar'] ) )
{
    $oCliente->iCodigo    = $_POST['inputCodigo'];
    $oCliente->sNome = $_POST['inputNome'];
    

    if ($_FILES['inputImagem']['name'] != '') {

        if (!file_exists('images/clientes')) {
            mkdir('clientes');
        }

        move_uploaded_file($_FILES['inputImagem']['tmp_name'], 'images/clientes/' . $_FILES['inputImagem']['name']);

    }
    move_uploaded_file($_FILES['inputImagem']['tmp_name'], 'images/clientes/' . $_FILES['inputImagem']['name']);

    if($_FILES['inputImagem']['name'] != ''){
		$oCliente->sUrlImagem = $_FILES['inputImagem']['name'];
	}
	else {
		$oCliente->sUrlImagem = $_POST['inputMiniaturaVazio'];
	}

    if ( $oCliente->iCodigo == '' )
    {
        ClienteDB::salvaCliente($oCliente);
    }
    else
    {   
        ClienteDB::alteraCliente($oCliente);
    }
}
else if ( isset ( $_GET['excluir'] ) )
{
    ClienteDB::excluiCliente($_GET['codigo']);
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    ClienteDB::setaFiltro(' AND Cliente_lng_Codigo = '.$_GET['codigo']);
    $oCliente = ClienteDB::pesquisaCliente();
}
else
{
    $arrObjCliente = ClienteDB::pesquisaClienteLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}


/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjCliente', $arrObjCliente );
$oTemplate->assign ('oCliente', $oCliente );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sPagina', 'cliente' );
$oTemplate->assign ('sMenu',   'layout' );

/* Define P�gina/Template a ser executado */
$oTemplate->display('centraldecontrole/cliente.tpl');

?>
