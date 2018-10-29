<?php 

Controller::loadClass('site/grupo/grupo'); 
Controller::loadClass('site/grupo/grupoDB');

    GrupoDB::setaFiltro(' AND Grupo_lng_Codigo = '.$_POST['Grupo_lng_Codigo']);
    $oGrupo = GrupoDB::pesquisaGrupo();

    echo json_encode($oGrupo);

    return;
?>