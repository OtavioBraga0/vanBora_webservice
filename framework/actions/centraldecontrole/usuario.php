<?php

if ( $_SESSION['PERMISSOES']['CADASTRAR_USUARIO'] == 'N' )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/usuario/usuario'); 
Controller::loadClass('site/usuario/usuarioDB');

$oUsuario      = new Usuario();
$sAcao         = 'lista';
$arrObjUsuario = '';

if ( $_SESSION['PERMISSOES']['CADASTRAR_USUARIO'] == 'S' )
{
    if  ( isset ( $_POST['inputSalvar'] ) )
    {   

        $sAtivo                = (isset($_POST['inputAtivo'])) ? 'S' : 'N';
        $sAdicionarPublicacao  = (isset($_POST['inputAdicionarPublicacao'])) ? 'S' : 'N';
        $sEditarPublicacao     = (isset($_POST['inputEditarPublicacao'])) ? 'S' : 'N';
        $sExcluirPublicacao    = (isset($_POST['inputExcluirPublicacao'])) ? 'S' : 'N';
        $sCadastrarUsuario     = (isset($_POST['inputCadastrarUsuario'])) ? 'S' : 'N';
        $sCadastrarFoto        = (isset($_POST['inputCadastrarFoto'])) ? 'S' : 'N';
        $sCadastrarTag         = (isset($_POST['inputCadastrarTag'])) ? 'S' : 'N';
        $sCadastrarVideo       = (isset($_POST['inputCadastrarVideo'])) ? 'S' : 'N';
        $sCadastrarAudio       = (isset($_POST['inputCadastrarAudio'])) ? 'S' : 'N';
        $sCadastrarMenu        = (isset($_POST['inputCadastrarMenu'])) ? 'S' : 'N';
        $sCadastrarInformativo = (isset($_POST['inputCadastrarInformativo'])) ? 'S' : 'N';
        $sCadastrarCarrossel   = (isset($_POST['inputCadastrarCarrossel'])) ? 'S' : 'N';
        $sCadastrarConfiguracoes       = (isset($_POST['inputCadastrarConfiguracoes'])) ? 'S' : 'N';
        $sAdministrarEspiritualidade   = (isset($_POST['inputAdministrarEspiritualidade'])) ? 'S' : 'N';
        $sVisualizarRelatorios         = (isset($_POST['inputVisualizarRelatorios'])) ? 'S' : 'N';
        
        if ( isset( $_POST['inputSenha'] ) )
        {
            $oUsuario->sSenha   = $_POST['inputSenha'];
        }

        $oUsuario->iCodigo  = $_POST['inputCodigo'];
        $oUsuario->sLogin   = $_POST['inputLogin'];
        $oUsuario->sNome    = $_POST['inputNome'];
        $oUsuario->sEmail   = $_POST['inputEmail'];
        $oUsuario->sAtivo   = $sAtivo;
        $oUsuario->sDataCadastro     = date( 'Y-m-d H:i:s' );
        $oUsuario->sAdicionarArtigo  = $sAdicionarPublicacao;
        $oUsuario->sEditarArtigo     = $sEditarPublicacao;
        $oUsuario->sExcluirArtigo    = $sExcluirPublicacao;
        $oUsuario->sCadastrarUsuario = $sCadastrarUsuario;
        $oUsuario->sCadastrarFoto    = $sCadastrarFoto;
        $oUsuario->sCadastrarTag     = $sCadastrarTag;
        $oUsuario->sCadastrarVideo   = $sCadastrarVideo;
        $oUsuario->sCadastrarAudio   = $sCadastrarAudio;
        $oUsuario->sCadastrarMenu    = $sCadastrarMenu;
        $oUsuario->sCadastrarInformativo = $sCadastrarInformativo;
        $oUsuario->sCadastrarCarrossel   = $sCadastrarCarrossel;
        $oUsuario->sAdministrarEspiritualidade = $sAdministrarEspiritualidade;
        $oUsuario->sVisualizarRelatorios       = $sVisualizarRelatorios;
        $oUsuario->sCadastrarConfiguracoes     = $sCadastrarConfiguracoes;
        
        if ( $oUsuario->iCodigo == '' )
        {
            UsuarioDB::salvaUsuario($oUsuario);
        }
        else
        {
            UsuarioDB::alteraUsuario($oUsuario);
        }
    }
    else if ( isset ( $_GET['excluir'] ) )
    {
        UsuarioDB::excluiUsuario($_GET['codigo']);
    }
}

if ( isset ( $_GET['codigo'] ) && !isset( $_GET['excluir'] ) )
{
    UsuarioDB::setaFiltro(' AND Usuario_lng_Codigo = '.$_GET['codigo']);
    $oUsuario = UsuarioDB::pesquisaUsuario();
}
else
{
    $arrObjUsuario = UsuarioDB::pesquisaUsuarioLista();
}

if ( isset ( $_GET['acao'] ) )
{
    $sAcao = $_GET['acao'];
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('arrObjUsuario', $arrObjUsuario );
$oTemplate->assign ('oUsuario', $oUsuario );

$oTemplate->assign ('sAcao', $sAcao );
$oTemplate->assign ('sMenu', 'usuarios' );
$oTemplate->assign ('sPagina', '' );
/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/usuario.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>