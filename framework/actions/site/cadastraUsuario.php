<?php

    Controller::loadClass('site/usuario/usuario');
    Controller::loadClass('site/usuario/usuarioDB');


    $oUsuario = new Usuario();

    $oUsuario->Usuario_vch_Nome = $_POST['Usuario_vch_Nome'];
    $oUsuario->Usuario_vch_Celular = $_POST['Usuario_vch_Celular'];
    $oUsuario->Usuario_dat_DataNascimento = $_POST['Usuario_dat_DataNascimento'];
    $oUsuario->Usuario_vch_Endereco = $_POST['Usuario_vch_Endereco'];
    $oUsuario->Usuario_vch_Numero = $_POST['Usuario_vch_Numero'];
    $oUsuario->Usuario_vch_Complemento = $_POST['Usuario_vch_Complemento'];
    $oUsuario->Usuario_chr_Tipo = $_POST['Usuario_chr_Tipo'];

    $sRetorno = UsuarioDB::salvaUsuario($oUsuario);

    echo json_encode($sRetorno);

    return;

?>