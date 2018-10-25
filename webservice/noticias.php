<?php

require_once('lib/nusoap.php');
require_once( '../framework/config/config.class.php' );

$server = new soap_server;
$server->configureWSDL('Amex.Noticia','urn:Amex.Noticia');
$server->wsdl->schemaTargetNamespace = 'urn:Amex.Noticia';

/* Adiciona ComplexType de Noticia, para retornar uma array de notícias quando consultar o método: consultaNoticiaLista */
$server->wsdl->addComplexType(
    'Noticia',
    'complexType',
    'struct',
    'all',
    '',
    array(
      'titulo' => array( 'name' => 'titulo', 'type' => 'xsd:string'),
      'resumo' => array( 'name' => 'resumo', 'type' => 'xsd:string'),
      'link'   => array( 'name' => 'link',   'type' => 'xsd:string'),
      'thumb'  => array( 'name' => 'thumb',  'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'NoticiaArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Noticia[]')
    ),
    'tns:Noticia'
);


$server->register('consultaNoticiaLista', //nome do método
    array(
      'senha'  => 'xsd:string',
      'limite' => 'xsd:integer'
    ), //parâmetros de entrada
    array(
      'return' => 'tns:NoticiaArray'
     ), //parâmetros de saída
    'urn:Amex.Noticia', //namespace
    'urn:Amex.Noticia#consultaNoticiaLista', //soapaction
    'rpc', //style
    'encoded', //use
    'Retorna últimas notícias' //documentação do serviço
);


function consultaNoticiaLista($sSenha, $iLimite)
{
    if ( ($sSenha == 'ame%@1') )
    {
        $host = Config::HOST;
        $db   = Config::DB;
        $user = Config::USER;
        $psdw = Config::PSWD;

        $conexao = new PDO( "mysql:host=".$host.";port=3306;dbname=".$db, $user, $psdw);

        $consulta = $conexao->query("
             SELECT 
                Artigo_vch_Titulo,
                Artigo_vch_Link,
                Artigo_vch_UrlImagem,
                Artigo_vch_Resumo
            FROM Artigo 
            WHERE (Artigo_chr_Ativo = 'S' OR Artigo_chr_Ativo IS NULL) AND (Artigo_chr_Carrossel = 'S')
            ORDER BY Artigo_lng_Codigo DESC
            LIMIT 0 ,".$iLimite);

        
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        
        if (is_array($resultado))
        {
            $retorno = array();
            
            for ($a = 0, $iCount = count($resultado); $a < $iCount; ++$a)
            {
                
                $retorno[$a]['titulo'] = $resultado[$a]['Artigo_vch_Titulo'];
                $retorno[$a]['resumo'] = $resultado[$a]['Artigo_vch_Resumo'];
                $retorno[$a]['link']   = $resultado[$a]['Artigo_vch_Link'];
                $retorno[$a]['thumb']  = $resultado[$a]['Artigo_vch_UrlImagem'];
            }
            
            return $retorno;
        }
        else
        {
            $retorno = array('','','','');
        }
    }
    else
    {
        $retorno = array('','','','');
    }
    return $retorno;
}

// requisição para uso do serviço
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
