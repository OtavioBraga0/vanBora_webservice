<?php

    Controller::loadClass('site/aluno/aluno');
    Controller::loadClass('site/aluno/alunoDB');

    Controller::loadClass('site/usuario/usuario');
    Controller::loadClass('site/usuario/usuarioDB');

    UsuarioDB::setaFiltro(' AND Usuario_vch_Celular = "'.$_POST['Usuario_vch_Celular'].'"');
    $oUsuario = UsuarioDB::pesquisaUsuario();

    $oAluno = new Aluno();

    $oAluno->Usuario_lng_Codigo = $oUsuario['Usuario_lng_Codigo'];
    $oAluno->Grupo_lng_Codigo   = $_POST['Grupo_lng_Codigo'];
    $oAluno->Aluno_chr_Confirmacao = '';

    $sRetorno = AlunoDB::salvaAluno($oAluno);

    echo json_encode($sRetorno);

    return;
    

?>  