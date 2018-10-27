<?php

    Controller::loadClass('site/usuario/usuario');
    Controller::loadClass('site/usuario/usuarioDB');

    UsuarioDB::setaFiltro(' AND Usuario_lng_Codigo = '.$_POST['Usuario_lng_Codigo']);
    $oUsuario = UsuarioDB::pesquisaUsuario();

    echo json_encode($oUsuario);
    return;

?>