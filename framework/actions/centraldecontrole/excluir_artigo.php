<?php

/* Carrega as Classes Necessárias */
Controller::loadClass('site/artigo/artigo'); 
Controller::loadClass('site/artigo/artigoDB');
Controller::loadClass('site/artigoTag/artigoTag'); 
Controller::loadClass('site/artigoTag/artigoTagDB');

if ( $_SESSION['PERMISSOES']['EXCLUIR_ARTIGO'] == 'S' )
{
    ArtigoTagDB::excluiArtigoTag($_GET['codigo']);
    ArtigoDB::excluiArtigo($_GET['codigo']);
}

header('Location: ?pagina=centraldecontrole/inicial');

//echo '<pre>';
//var_dump ( $_SESSION );
?>