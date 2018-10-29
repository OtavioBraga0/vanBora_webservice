<?php

    Controller::loadClass('site/aluno/aluno');
    Controller::loadClass('site/aluno/alunoDB');

    $oAluno = new Aluno();

    $oAluno->Grupo_lng_Codigo = $_POST['Grupo_lng_Codigo'];
    $oAluno->Usuario_lng_Codigo = $_POST['Usuario_lng_Codigo'];
    $oAluno->Aluno_chr_Confirmacao = $_POST['Aluno_chr_Confirmacao'];

    AlunoDB::alteraResposta($oAluno);

    echo(json_encode(array(
        'Grupo_lng_Codigo' => $oAluno->Grupo_lng_Codigo,
        'Usuario_lng_Codigo' => $oAluno->Usuario_lng_Codigo,
        'Aluno_chr_Confirmacao' => $oAluno->Aluno_chr_Confirmacao,
    )));
?>