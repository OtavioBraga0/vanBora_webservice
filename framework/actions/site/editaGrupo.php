<?php

    Controller::loadClass('site/grupo/grupo');
    Controller::loadClass('site/grupo/grupoDB');

    $oGrupo = new Grupo();

    $oGrupo->Grupo_lng_Codigo = $_POST['Grupo_lng_Codigo'];
    $oGrupo->Grupo_vch_Nome = $_POST['Grupo_vch_Nome'];
    $oGrupo->Grupo_vch_Horario = $_POST['Grupo_vch_Horario'];
    $oGrupo->Periodo_lng_Codigo = $_POST['Periodo_lng_Codigo'];

    GrupoDB::alteraGrupo($oGrupo);

    echo json_encode(array(
        'Grupo_lng_Codigo' => $oGrupo->Grupo_lng_Codigo,
        'Grupo_vch_Nome' => $oGrupo->Grupo_vch_Nome,
        'Grupo_vch_Horario' => $oGrupo->Grupo_vch_Horario,
        'Periodo_lng_Codigo' => $oGrupo->Periodo_lng_Codigo,
    ));

    return;
?>