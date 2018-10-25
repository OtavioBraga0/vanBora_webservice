<?php
$word = new COM("word.application") or die ("Erro!!");

//Em seguida, atribu�mos � vari�vel $file, o nome do documento que ser� aberto
$file = "teste.doc";

//Aqui, abrimos o documento em quest�o
$word->Documents->Add(realpath($file));

// Agora, extra�mos seu conte�do para a vari�vel $content
//convertento o mesmo para string
$content = (string) $word->ActiveDocument->Content;

//Convertemos as quebras de linha para html
$txt = nl2br($content);

//Pra visualizar o conte�do, basta imprimir a vari�vel
echo $txt;

//Agora, fechamos o documento...
$word->ActiveDocument->Close(false);
//"Sa�mos do word" (ou quase, hahahaha)
$word->Quit();
//Os passos seguintes, s�o recomendados pra
//evitar vazamento de mem�ria
$word = null;
unset($word);
?>