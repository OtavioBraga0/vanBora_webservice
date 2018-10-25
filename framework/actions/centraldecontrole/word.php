<?php
$word = new COM("word.application") or die ("Erro!!");

//Em seguida, atribuímos à variável $file, o nome do documento que será aberto
$file = "teste.doc";

//Aqui, abrimos o documento em questão
$word->Documents->Add(realpath($file));

// Agora, extraímos seu conteúdo para a variável $content
//convertento o mesmo para string
$content = (string) $word->ActiveDocument->Content;

//Convertemos as quebras de linha para html
$txt = nl2br($content);

//Pra visualizar o conteúdo, basta imprimir a variável
echo $txt;

//Agora, fechamos o documento...
$word->ActiveDocument->Close(false);
//"Saímos do word" (ou quase, hahahaha)
$word->Quit();
//Os passos seguintes, são recomendados pra
//evitar vazamento de memória
$word = null;
unset($word);
?>