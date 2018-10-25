<?php

if ( $_SESSION['CODIGO'] == 1 )
{
    header('Location: ?pagina=centraldecontrole/inicial');
}

/* Carrega as Classes Necessárias */
Controller::loadClass('site/usuario/usuario'); 
Controller::loadClass('site/usuario/usuarioDB');

$sMensagem = '';

if ( isset ( $_POST['inputAlterarSenha'] ) )
{
    UsuarioDB::setaFiltro(' AND Usuario_lng_Codigo = '.$_SESSION['CODIGO']);
    $oUsuario = UsuarioDB::pesquisaUsuario();

    if ( $oUsuario->sSenha == ( sha1( $_POST['inputSenhaAtual'] ) ) )
    {
        UsuarioDB::alteraSenha(sha1($_POST['inputNovaSenha']));
        $sMensagem = 'Senha alterada com sucesso!';
    }
    else
    {
        $sMensagem = 'Senha atual incorreta!';
    }
    
}

/* Inicializa o Template */
$oTemplate = Template::inicializaSmarty();

$oTemplate->assign ('sMensagem', $sMensagem );
$oTemplate->assign ('sPagina', 'alterarSenha' );
$oTemplate->assign ('sMenu',   'configuracoes' );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/alterarSenha.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>