<?php 

Controller::loadClass('site/aluno/aluno'); 
Controller::loadClass('site/aluno/alunoDB');

$Grupo_lng_Codigo = $_POST['Grupo_lng_Codigo'];

if(isset($_POST['Grupo_lng_Codigo'])){
    AlunoDB::setaFiltro(' AND Grupo_lng_Codigo = '.$Grupo_lng_Codigo);
    AlunoDB::setaJoin('INNER JOIN usuario ON usuario.Usuario_lng_Codigo = aluno.Usuario_lng_Codigo');
    $arrObjAluno = AlunoDB::pesquisaAlunoLista();

    echo json_encode($arrObjAluno);

    return;
}


?>