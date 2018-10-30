<?php

    Controller::loadClass('site/aluno/aluno');
    Controller::loadClass('site/aluno/alunoDB');

    GrupoDB::esvaziaGrupo($_POST['Grupo_lng_Codigo']);
    GrupoDB::excluiGrupo($_POST['Grupo_lng_Codigo']);
    
    echo json_encode(array(
        'Grupo_lng_Codigo' => $_POST['Grupo_lng_Codigo']
    ));

    return;
?>