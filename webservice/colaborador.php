<?php

require_once('lib/nusoap.php');
require_once( '../framework/config/config.class.php' );

$server = new soap_server;
$server->configureWSDL('Amex.Colaborador','urn:Amex.Colaborador');
$server->wsdl->schemaTargetNamespace = 'urn:Amex.Colaborador';

/* Adiciona ComplexType de Colaborador, para retornar uma array de colaboradores quando consultar o método: consultaColaboradorLista */
$server->wsdl->addComplexType(
    'Colaborador',
    'complexType',
    'struct',
    'all',
    '',
    array(
      'codigo'         => array( 'name' => 'codigo',         'type' => 'xsd:integer'),
      'nome' 	       => array( 'name' => 'nome',           'type' => 'xsd:string'),
      'endereco'       => array( 'name' => 'endereco',       'type' => 'xsd:string'),
      'numero'         => array( 'name' => 'numero',         'type' => 'xsd:integer'),
      'bairro' 	       => array( 'name' => 'bairro',         'type' => 'xsd:string'),
      'cidade'         => array( 'name' => 'cidade',         'type' => 'xsd:string'),
      'estado'         => array( 'name' => 'estado',         'type' => 'xsd:string'),
      'telefone'       => array( 'name' => 'telefone',       'type' => 'xsd:string'),
      'email'          => array( 'name' => 'email',          'type' => 'xsd:string'),
      'cpf'            => array( 'name' => 'cpf',            'type' => 'xsd:string'),
      'dataNascimento' => array( 'name' => 'dataNascimento', 'type' => 'xsd:date'),
      'cep'            => array( 'name' => 'cep',            'type' => 'xsd:string'),
      'sexo'           => array( 'name' => 'sexo',           'type' => 'xsd:string'),
      'logradouro'     => array( 'name' => 'logradouro',     'type' => 'xsd:string'),
      'complemento'    => array( 'name' => 'complemento',    'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'ColaboradorArray',
    'complexType',
    'array',
    '',
    'SOAP-ENC:Array',
    array(),
    array(
        array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Colaborador[]')
    ),
    'tns:Colaborador'
);


$server->register('consultaColaborador', //nome do método
    array(
      'Colaborador' => 'xsd:string', 
      'senha'       => 'xsd:string'
    ), //parâmetros de entrada
    array(
      'codigo' 	       => 'xsd:string',
      'nome' 	       => 'xsd:string',
      'endereco'       => 'xsd:string',
      'numero'         => 'xsd:string',
      'bairro' 	       => 'xsd:string',
      'cidade'         => 'xsd:string',
      'estado'         => 'xsd:string',
      'telefone'       => 'xsd:string',
      'email'          => 'xsd:string',
      'cpf'            => 'xsd:string',
      'dataNascimento' => 'xsd:string',
      'cep'            => 'xsd:string',
      'sexo'           => 'xsd:string',
      'logradouro'     => 'xsd:string',
      'complemento'    => 'xsd:string',
      'retorno'        => 'xsd:string'
     ), //parâmetros de saída
    'urn:Amex.Colaborador', //namespace
    'urn:Amex.Colaborador#consultaColaborador', //soapaction
    'rpc', //style
    'encoded', //use
    'Retorna os dados do Colaborador através do seu código' //documentação do serviço
);

$server->register('consultaColaboradorLista', //nome do método
    array(
      'senha' 	     => 'xsd:string'
    ), //parâmetros de entrada
    array(
      'return' => 'tns:ColaboradorArray'
     ), //parâmetros de saída
    'urn:Amex.Colaborador', //namespace
    'urn:Amex.Colaborador#consultaColaboradorLista', //soapaction
    'rpc', //style
    'encoded', //use
    'Retorna a lista de colaboradores cadastrados' //documentação do serviço
);


function consultaColaborador($iCodigo, $sSenha)
{
    if ( ($sSenha == 'ame%@1') )
    {
        $host = Config::HOST;
        $db   = Config::DB;
        $user = Config::USER;
        $psdw = Config::PSWD;

        $conexao = new PDO( "mysql:host=".$host.";port=3306;dbname=".$db, $user, $psdw);

        $consulta = $conexao->query("
            SELECT Colaborador_lng_Codigo,
            Colaborador_vch_Nome,
            Colaborador_vch_Endereco,
            Colaborador_lng_Numero,
            Colaborador_vch_Bairro,
            Colaborador_vch_Cidade,
            Colaborador_chr_Estado,
            Colaborador_vch_Telefone,
            Colaborador_vch_Email,
            Colaborador_chr_CPF,
            Colaborador_dat_DataNascimento,
            Colaborador_chr_CEP,
            Colaborador_chr_Sexo,
            Colaborador_vch_Complemento,
            Logradouro_vch_Descricao 
            FROM Colaborador 
            LEFT JOIN Logradouro ON ( Logradouro.Logradouro_lng_Codigo = Colaborador.Logradouro_lng_Codigo )
            WHERE Colaborador_lng_Codigo =  '".$iCodigo."'
        ");

        
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        
        if ($resultado)
        {
            
            //$sDataBR = date("d/m/Y", strtotime($res["Colaborador_dat_DataNascimento"]));

            $retorno = array(
                $resultado['Colaborador_lng_Codigo'],
                utf8_encode($resultado['Colaborador_vch_Nome']),
                utf8_encode($resultado['Colaborador_vch_Endereco']),
                $resultado['Colaborador_lng_Numero'],
                utf8_encode($resultado['Colaborador_vch_Bairro']),
                utf8_encode($resultado['Colaborador_vch_Cidade']),
                $resultado['Colaborador_chr_Estado'],
                $resultado['Colaborador_vch_Telefone'],
                $resultado['Colaborador_vch_Email'],
                $resultado['Colaborador_chr_CPF'],
                $resultado["Colaborador_dat_DataNascimento"],
                $resultado['Colaborador_chr_CEP'],
                $resultado['Colaborador_chr_Sexo'],
                utf8_encode($resultado['Logradouro_vch_Descricao']),
                utf8_encode($resultado['Colaborador_vch_Complemento']),
                true
            );
        }
        else
        {
            $retorno = array('','','','','','','','','','','','','','','',false);
        }
    }
    else
    {
        $retorno = array('','','','','','','','','','','','','','','',false);
    }
    return $retorno;
}

function consultaColaboradorLista($sSenha)
{
    if ( ($sSenha == 'ame%@1') )
    {
        $host = Config::HOST;
        $db   = Config::DB;
        $user = Config::USER;
        $psdw = Config::PSWD;

        $conexao = new PDO( "mysql:host=".$host.";port=3306;dbname=".$db, $user, $psdw);

        $consulta = $conexao->query("
            SELECT Colaborador_lng_Codigo,
            Colaborador_vch_Nome,
            Colaborador_vch_Endereco,
            Colaborador_lng_Numero,
            Colaborador_vch_Bairro,
            Colaborador_vch_Cidade,
            Colaborador_chr_Estado,
            Colaborador_vch_Telefone,
            Colaborador_vch_Email,
            Colaborador_chr_CPF,
            Colaborador_dat_DataNascimento,
            Colaborador_chr_CEP,
            Colaborador_chr_Sexo,
            Colaborador_vch_Complemento,
            Logradouro_vch_Descricao 
            FROM Colaborador 
            LEFT JOIN Logradouro ON ( Logradouro.Logradouro_lng_Codigo = Colaborador.Logradouro_lng_Codigo )
            WHERE Colaborador_chr_Importado_Frs IS NULL
        ");

        
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        
        if (is_array($resultado))
        {
            $retorno = array();
            
            for ($a = 0, $iCount = count($resultado); $a < $iCount; ++$a)
            {
                //$conexao = new PDO( "mysql:host=".$host.";port=3306;dbname=".$db, $user, $psdw);
                
                /*$update = $conexao->prepare("UPDATE Colaborador SET
                            Colaborador_chr_Importado_Frs    = 'S'
                            WHERE Colaborador_lng_Codigo = ".$resultado[$a]['Colaborador_lng_Codigo'] );
                            */
                //$update->bindParam(1, ($resultado[$a]['Colaborador_lng_Codigo']));

                //$update->execute();
                
                $sDataBR = date("d/m/Y", strtotime($resultado[$a]["Colaborador_dat_DataNascimento"]));
                
                $retorno[$a]['codigo']         = $resultado[$a]['Colaborador_lng_Codigo'];
                $retorno[$a]['nome']           = $resultado[$a]['Colaborador_vch_Nome'];
                $retorno[$a]['endereco']       = $resultado[$a]['Colaborador_vch_Endereco'];
                $retorno[$a]['numero']         = $resultado[$a]['Colaborador_lng_Numero'];
                $retorno[$a]['bairro']         = $resultado[$a]['Colaborador_vch_Bairro'];
                $retorno[$a]['cidade']         = $resultado[$a]['Colaborador_vch_Cidade'];
                $retorno[$a]['estado']         = $resultado[$a]['Colaborador_chr_Estado'];
                $retorno[$a]['telefone']       = $resultado[$a]['Colaborador_vch_Telefone'];
                $retorno[$a]['telefone']       = $resultado[$a]['Colaborador_vch_Email'];
                $retorno[$a]['cpf']            = $resultado[$a]['Colaborador_chr_CPF'];
                $retorno[$a]['dataNascimento'] = $sDataBR;
                $retorno[$a]['cep']            = $resultado[$a]['Colaborador_chr_CEP'];
                $retorno[$a]['sexo']           = $resultado[$a]['Colaborador_chr_Sexo'];
                $retorno[$a]['logradouro']     = $resultado[$a]['Logradouro_vch_Descricao'];
                $retorno[$a]['complemento']    = $resultado[$a]['Colaborador_vch_Complemento'];
            }
            
            return $retorno;
        }
        else
        {
            $retorno = array('','','','','','','','','','','','','','','');
        }
    }
    else
    {
        $retorno = array('','','','','','','','','','','','','','','');
    }
    return $retorno;
}

// requisição para uso do serviço
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>
