<?php

    Controller::loadClass('site/usuario/usuario');
    Controller::loadClass('site/usuario/usuarioDB');

    UsuarioDB::setaFiltro(" AND Usuario_vch_Celular = '".$_POST['Usuario_vch_Celular']."'");    
    $oUsuario = UsuarioDB::pesquisaUsuario();

    echo json_encode($oUsuario);

    return;


?>