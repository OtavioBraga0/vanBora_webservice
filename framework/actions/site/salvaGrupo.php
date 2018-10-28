<?php

    Controller::loadClass('site/grupo/grupo');
    Controller::loadClass('site/grupo/grupoDB');


        $oGrupo = new Grupo();

        $oGrupo->Grupo_vch_Nome = $_POST['Grupo_vch_Nome'];
        $oGrupo->Grupo_vch_Horario = $_POST['Grupo_vch_Horario'];
        $oGrupo->Usuario_lng_Codigo = intval($_POST['Usuario_lng_Codigo']);
        $oGrupo->Periodo_lng_Codigo = intval($_POST['Periodo_lng_Codigo']);

        $sRetorno = GrupoDB::salvaGrupo($oGrupo);

        echo json_encode($sRetorno);

        return;
    

?>  