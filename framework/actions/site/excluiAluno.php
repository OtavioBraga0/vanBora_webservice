<?php

    Controller::loadClass('site/aluno/aluno');
    Controller::loadClass('site/aluno/alunoDB');

    $sRetorno = AlunoDB::excluiAluno($_POST['Usuario_lng_Codigo'], $_POST['Grupo_lng_Codigo']);

    echo json_encode(array(
        'Usuario_lng_Codigo' => $_POST['Usuario_lng_Codigo'],
        'Grupo_lng_Codigo' => $_POST['Grupo_lng_Codigo'],
        'Retorno' => $sRetorno
    ));

    return;
?>