<?php

    /* Inicializa o Template */
    $oTemplate = Template::inicializaSmarty();
    
    Controller::loadClass('site/usuario/usuario'); 
    Controller::loadClass('site/usuario/usuarioDB');
    
    if ( isset( $_GET['recuperarSenha'] ) )
    {
        $bRecuperarSenha = true;
    }
    else
    {
        $bRecuperarSenha = false;
    }

    /* Define as Vari�veis */
    $oTemplate -> assign ( 'bRecuperarSenha', $bRecuperarSenha ); 
    
    if(isset($_POST['btnSend'])){

         /* Verifica Usu�rio */
         $bMsg = Login::autenticaUsuario();
        
    }
       

    if ( $bMsg === false )
    {
        $oTemplate -> assign ( 'msgErro', Login::pegaMsgErro () );
    }
    
    if ( isset ($_POST['btnSend']) &&  ( $_POST['btnSend'] == 'Enviar' ) )
    {
        $sEmail = $_POST['inputEmail'];
        
        if(filter_var($sEmail, FILTER_VALIDATE_EMAIL))
        { 
            Controller::loadClass ( 'core/kmail' );
            Controller::loadClass ( 'centraldecontrole/usuario/usuario' );
            Controller::loadClass ( 'centraldecontrole/usuario/usuarioDB' );

            UsuarioDB::setaFiltro(" AND Usuario_vch_Email = '".$_POST['inputEmail']."'");
            $oUsuario = UsuarioDB::pesquisaUsuario();

            UsuarioDB::enviarSenhaPorEmail($oUsuario);

            echo "<script type='text/javascript'>alert('E-mail de recuperação de senha enviado!');</script>";
        }
        else
        {
            echo "<script type='text/javascript'>alert('E-mail inválido!');</script>";
        }
        
        
    }

    /* Define P�gina/Template a ser executado */
    $oTemplate -> display ('centraldecontrole/login.tpl');

?>