<?php 

Controller::loadClass('site/Grupo/Grupo'); 
Controller::loadClass('site/Grupo/GrupoDB');

$Usuario_lng_Codigo = $_POST['Usuario_lng_Codigo'];

    GrupoDB::setaJoin(' INNER JOIN aluno ON aluno.Grupo_lng_Codigo = grupo.Grupo_lng_Codigo');
    GrupoDB::setaFiltro(' AND aluno.Usuario_lng_Codigo = '.$Usuario_lng_Codigo);
    $arrObjGrupo = GrupoDB::pesquisaGrupoLista();

    echo json_encode($arrObjGrupo);


?>