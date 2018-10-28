<?php 

Controller::loadClass('site/grupo/grupo'); 
Controller::loadClass('site/grupo/grupoDB');

$Usuario_lng_Codigo = $_POST['Usuario_lng_Codigo'];

    GrupoDB::setaFiltro(' AND Usuario_lng_Codigo = '.$Usuario_lng_Codigo);
    $arrObjGrupo = GrupoDB::pesquisaGrupoLista();

    echo json_encode($arrObjGrupo);


?>