<?php

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
$oTemplate->assign ('sMenu',   'configuracoes' );
$oTemplate->assign ('sPagina', 'configuracoes' );

/* Define Página/Template a ser executado */
$oTemplate->display('centraldecontrole/configuracoes.tpl');


//echo '<pre>';
//var_dump ( $_SESSION );
?>