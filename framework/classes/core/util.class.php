<?php

class Util
{

    private final function __construct()
    {
        
    }

    private final function __clone()
    {
        
    }

    private final function __wakeup()
    {
        
    }

    public static final function removeFormatacaoCnpj($sArg)
    {
        $sDicionario = array('.' => '',
            '-' => '',
            '/' => ''
        );
        return trim(strtr($sArg, $sDicionario));
    }

    public static final function timediff($date1 = null, $date2 = null)
    {
        // Valores padr�o
        if (is_null($date1))
            $date1 = time();
        if (is_null($date2))
            $date2 = time();

        // Verificando argumentos
        if (!is_int($date1) || !is_int($date2))
            return false;
        if ($date2 >= $date1)
            return false;

        // Diferen�a entre os timestamps
        $diff = $date1 - $date2;

        $time = array(0, 0, 0);

        if ($diff >= 3600)
            $time[0] = floor(($diff >= 86400) ? ($diff / 86400) * 24 : $diff / 3600);

        if ($calc = ($diff % 3600))
        {
            $time[1] = floor($calc / 60);
            $time[2] = $calc % 60;
        }
        return $time;
    }

    public static final function validaCNPJ($sArgCNPJ)
    {
        if (strlen($sArgCNPJ) == 18)
        {
            $sDicionario = array('.' => '',
                '-' => '',
                '/' => ''
            );
            $mTmp = trim(strtr($sArgCNPJ, $sDicionario));
            $sCnpj = str_split($mTmp);

            $v1 = ( 5 * $sCnpj[0] ) + ( 4 * $sCnpj[1] ) + ( 3 * $sCnpj[2] ) + ( 2 * $sCnpj[3] ) + ( 9 * $sCnpj[4] ) + ( 8 * $sCnpj[5] ) + ( 7 * $sCnpj[6] ) + ( 6 * $sCnpj[7] ) + ( 5 * $sCnpj[8] ) + ( 4 * $sCnpj[9] ) + ( 3 * $sCnpj[10] ) + ( 2 * $sCnpj[11] );

            $iResto = ( $v1 % 11 );
            $v1 = ( $iResto >= 10 ) ? 0 : 11 - $iResto;

            $v2 = ( 6 * $sCnpj[0] ) + ( 5 * $sCnpj[1] ) + ( 4 * $sCnpj[2] ) + ( 3 * $sCnpj[3] ) + ( 2 * $sCnpj[4] ) + ( 9 * $sCnpj[5] ) + ( 8 * $sCnpj[6] ) + ( 7 * $sCnpj[7] ) + ( 6 * $sCnpj[8] ) + ( 5 * $sCnpj[9] ) + ( 4 * $sCnpj[10] ) + ( 3 * $sCnpj[11] ) + ( 2 * $sCnpj[12] );


            $iResto = ( $v2 % 11 );
            $v2 = ( $iResto < 2 ) ? 0 : 11 - $iResto;
            $bValida = ( $v1 == $sCnpj[12] && $v2 == $sCnpj[13] ) ? true : false;

            if ($bValida === true)
            {
                return $sArgCNPJ;
            }
            return false;
        }
    }

    public static final function geraPaginacao($iTotalDados = '', $iArgTotalRegistros = '', $bPaginacao = true, $iArgNumeroRegistros = 20)
    {
        $iNumRegistrosPagina = $iArgNumeroRegistros;

        /* Se o parametro pagina��o for falso, n�o realiza a pagina��o */
        if ($bPaginacao == false)
        {
            $iNumRegistrosPagina = $iArgTotalRegistros;
        }

        if ($iArgTotalRegistros <> '')
        {
            $iArrPaginacao['NUM_PAGINA'] = ceil($iArgTotalRegistros / $iNumRegistrosPagina);
        }
        else
        {
            $iArrPaginacao['NUM_PAGINA'] = ceil($iTotalDados / $iNumRegistrosPagina);
        }

        $iArrPaginacao['PAGINA_ATUAL'] = ( isset($_GET['p']) ) ? $_GET['p'] : 1;

        return $iArrPaginacao;
    }

    public static final function geraPaginacao2($iMaximo, $iTotal)
    {
        $iPagina = $_GET["p"];

        if ($iPagina == "")
        {
            $iPagina = 1;
        }

        $iInicio = $iPagina - 1;
        $iInicio = $iMaximo * $iInicio;

        return $iInicio;
    }

    function retiraAcentos($sArgString)
    {
        $string = ereg_replace("[^a-zA-Z0-9_.]", "", strtr($sArgString, "�������������������������� ", "aaaaeeiooouucAAAAEEIOOOUUC_"));

        return $string;
    }

    private static $removeArray = array(
        "a" => "a",
        "b" => "b",
        "c" => "c",
        "d" => "d",
        "e" => "e",
        "f" => "f",
        "g" => "g",
        "h" => "h",
        "i" => "i",
        "j" => "j",
        "k" => "k",
        "l" => "l",
        "m" => "m",
        "n" => "n",
        "o" => "o",
        "p" => "p",
        "q" => "q",
        "r" => "r",
        "s" => "s",
        "t" => "t",
        "u" => "u",
        "v" => "v",
        "x" => "x",
        "y" => "y",
        "z" => "z",
        "�" => "a",
        "�" => "e",
        "�" => "i",
        "�" => "o",
        "�" => "u",
        "�" => "a",
        "�" => "e",
        "�" => "i",
        "�" => "o",
        "�" => "�",
        "�" => "a",
        "�" => "o",
        "�" => "a",
        "�" => "e",
        "�" => "i",
        "�" => "o",
        "�" => "u",
        "," => "",
        "!" => "",
        "#" => "",
        "%" => "",
        "�" => "",
        "-" => "_",
        "{" => "",
        "}" => "",
        "^" => "",
        "�" => "",
        "`" => "",
        "" => "",
        "/" => "",
        ";" => "",
        ":" => "",
        "?" => "",
        "�" => "1",
        "�" => "2",
        "�" => "3",
        "�" => "a",
        "�" => "o",
        "�" => "c",
        "�" => "u",
        "�" => "a",
        "�" => "i",
        "�" => "o",
        "�" => "e",
        "$" => "s",
        "�" => "y",
        "w" => "w",
        "<" => "",
        ">" => "",
        "[" => "",
        "]" => "",
        "&" => "e",
        " " => "-", //Aqui transforma os espa�os
        "'" => '',
        '"' => "",
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '4' => '4',
        '5' => '5',
        '6' => '6',
        '7' => '7',
        '8' => '8',
        '9' => '9',
        '0' => '0'
    );
    private static $acentosArray = array(
        '�' => 'a', '�' => 'A',
        '�' => 'e', '�' => 'E',
        '�' => 'i', '�' => 'i',
        '�' => 'o', '�' => 'O',
        '�' => 'u', '�' => 'U',
        '�' => '�', '�' => '�',
        '�' => '�', '�' => '�',
        '�' => '�', '�' => '�',
        '�' => 'a', '�' => '�',
        '�' => 'c', '�' => 'C',
        '�' => 'a', '�' => '�',
        '�' => 'o', '�' => 'o'
    );

    /**
     * Limpa uma string para ser usada como termo de uma URL
     * @param string $string
     * @return string
     */
    public static function formataUrl($string)
    {
        $finalString = "";
        $string = strtolower($string);
        $string = str_replace("'", "", $string);
        $string = str_replace('"', "", $string);
        $string = str_replace('&#8211;', "", $string);
        $string = str_replace('-', "", $string);
        $string = str_replace('  ', " ", $string);

        $string = trim($string);

        $string = filter_var($string, FILTER_SANITIZE_STRING);

        foreach (str_split($string) as $str)
        {
            $finalString .= self::$removeArray[$str];
        }

        $finalString = str_replace("__", "_", $finalString);
        $finalString = str_replace("__", "_", $finalString);

        if (substr($finalString, -1, 1) == "_")
        {
            $finalString = substr($finalString, 0, -1);
        }

        return $finalString;
    }

    /**
     * Remove os acentos de uma string
     *
     * @param string $string
     * @return string
     */
    public static function removeAcento($string)
    {
        $finalString = "";
        $string = str_replace("'", "", $string);
        $string = str_replace('"', "", $string);
        $string = str_replace('&', "", $string);

        $string = trim($string);

        $string = filter_var($string, FILTER_SANITIZE_STRING);

        foreach (str_split($string) as $str)
        {
            if (key_exists($str, self::$acentosArray))
            {
                $finalString .= self::$acentosArray[$str];
            }
            else
            {
                $finalString .= $str;
            }
        }

        if (substr($finalString, -1, 1) == "_")
        {
            $finalString = substr($finalString, 0, -1);
        }

        return $finalString;
    }

    public static final function converterDataParaMysql($sData)
    {

        $sTmp = explode('/', $sData);
        $sData = $sTmp[2] . '-' . $sTmp[1] . '-' . $sTmp[0];

        return $sData;
    }

    public static final function converterData($sData)
    {

        $sTmp = explode('-', $sData);
        $sData = $sTmp[2] . '/' . $sTmp[1] . '/' . $sTmp[0];

        return $sData;
    }

    public static final function calculaAno($iAno = '')
    {

        $sDiaDaSemanaNatal = date("N",strtotime($iAno."-12-25"));
        $sDomingoAntesNatal = (25-$sDiaDaSemanaNatal);
        $sPrimeiroDomingoAdvento = date('Y-m-d', (strtotime('-21 days', strtotime($iAno.'-'.'12-'.$sDomingoAntesNatal))));
        //echo $sPrimeiroDomingoAdvento;
        
        $sAnoLiturgico = '';

        if ($iAno == '')
        {
            $iAno = date("Y");
        }

        $iAno = (int) $iAno;
        
        if ((date('Y-m-d')) >= $sPrimeiroDomingoAdvento)
        {
            $iAno = $iAno+1;
        }

        $iSomaDigitos = array_sum(str_split($iAno));

        $iRestoDivisao = ( $iSomaDigitos % 3 );

        switch ($iRestoDivisao)
        {
            case 1:
                $sAnoLiturgico = 'A';
                break;
            case 2:
                $sAnoLiturgico = 'B';
                break;
            case 0:
                $sAnoLiturgico = 'C';
                break;
        }

        return $sAnoLiturgico;
    }

    function fulltrim($str)
    {
        return trim(preg_replace('/\s+/', ' ', $str));
    }

    public static final function retornaDiferencaDeDias($sDataInicial, $sDataFinal)
    {
        $sPartesDataInicial = explode('-', $sDataInicial);
        $sDataInicial = mktime(0, 0, 0, $sPartesDataInicial[1], $sPartesDataInicial[2], $sPartesDataInicial[0]);

        $sPartesDataFinal = explode('-', $sDataFinal);
        $sDataFinal = mktime(0, 0, 0, $sPartesDataFinal[1], $sPartesDataFinal[2], $sPartesDataFinal[0]);

        // Calcula a diferen�a de segundos entre as duas datas:
        $iDiferenca = $sDataFinal - $sDataInicial;

        // Calcula a diferen�a de dias
        $iDias = (int) floor($iDiferenca / (60 * 60 * 24));

        return $iDias;
    }

    public static final function retornaMesExtenso($sMes = '')
    {
        $sRetornoMes = '';

        switch ($sMes)
        {
            case '01':
                $sRetornoMes = 'Janeiro';
                break;
            case '02':
                $sRetornoMes = 'Fevereiro';
                break;
            case '03':
                $sRetornoMes = 'Mar�o';
                break;
            case '04':
                $sRetornoMes = 'Abril';
                break;
            case '05':
                $sRetornoMes = 'Maio';
                break;
            case '06':
                $sRetornoMes = 'Junho';
                break;
            case '07':
                $sRetornoMes = 'Julho';
                break;
            case '08':
                $sRetornoMes = 'Agosto';
                break;
            case '09':
                $sRetornoMes = 'Setembro';
                break;
            case '10':
                $sRetornoMes = 'Outubro';
                break;
            case '11':
                $sRetornoMes = 'Novembro';
                break;
            case '12':
                $sRetornoMes = 'Dezembro';
                break;
        }

        return $sRetornoMes;
    }

    public static final function calculaPaginacao($iPaginaAtual, $iTotalPaginas)
    {
        $arrPaginacao = '';

        /* Calcula o loop */
        if ($iPaginaAtual > 5)
        {
            $arrPaginacao['loop'] = $iPaginaAtual + 5;
            
            if ( $iTotalPaginas > 10 )
            {
                if (($arrPaginacao['loop'] > $iTotalPaginas))
                { 
                    $arrPaginacao['loop'] = $iTotalPaginas + 1;
                    $arrPaginacao['start'] = $arrPaginacao['loop'] - 10;
                }
                else
                {
                    $arrPaginacao['start'] = $iPaginaAtual - 5;
                }
            }
            else
            {
                if (($arrPaginacao['loop'] > $iTotalPaginas))
                { 
                    $arrPaginacao['loop'] = $iTotalPaginas + 1;
                    $arrPaginacao['start'] = 1;
                }
            }
        }
        else
        {
            if ($iTotalPaginas > 10)
            {
                $arrPaginacao['loop'] = $iPaginaAtual + ((10 - $iPaginaAtual) + 1);
            }
            else
            {
                $arrPaginacao['loop'] = $iPaginaAtual + (($iTotalPaginas - $iPaginaAtual) + 1);
            }
            $arrPaginacao['start'] = 1;
        }

        /* Calcula pr�xima e anterior */
        if ($iPaginaAtual == 1)
        {
            $arrPaginacao['anterior'] = 1;
        }
        else
        {
            $arrPaginacao['anterior'] = $iPaginaAtual - 1;
        }

        if ($iPaginaAtual == $iTotalPaginas)
        {
            $arrPaginacao['proxima'] = $iTotalPaginas;
        }
        else
        {
            $arrPaginacao['proxima'] = $iPaginaAtual + 1;
        }
        
        return $arrPaginacao;
    }

    public static final function date_diff($date1, $date2)
    {
        $current = $date1;
        $datetime2 = date_create($date2);
        $count = 0;
        while (date_create($current) < $datetime2)
        {
            $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
            $count++;
        }
        return $count;
    }

    public static final function converteDataBR($data)
    {
        $dataBR = implode("/", array_reverse(explode("-", $data)));

        return $dataBR;
    }

    public static final function filtraPalavroes($sConteudo)
    {
        $arrPalavroes = array(
            'arrombado',
            'arrombada',
            'arombado',
            'arombada',
            'buceta',
            'boceta',
            'bucetao',
            'bocetao',
            'bucetaum',
            'bocetaum',
            'bucetinha',
            'bocetinha',
            'blowjob',
            'caralinho',
            'caralhao',
            'caralhaum',
            'caralhex',
            'cacete',
            'cacetinho',
            'cacetao',
            'cacetaum',
            'epenis',
            'ehpenis',
            'penis',
            'p�nis',
            'cu',
            'c�',
            'cuzinho',
            'c�zinho',
            'cuz�o',
            'c�zao',
            'cuzudo',
            'c�zudo',
            'cusinho',
            'c�sinho',
            'c�s�o',
            'cus�o',
            'c�sao',
            'cusao',
            'cusudo',
            'c�sudo',
            'foder',
            'fodas',
            'fodase',
            'foda-se',
            'fodasse',
            'foda-sse',
            'fodasi',
            'foda-si',
            'fodassi',
            'foda-ssi',
            'fodassa',
            'foda�a',
            'fodinha',
            'fodao',
            'fodaum',
            'foda',
            'fodona',
            'fodo',
            'foder',
            'fodar',
            'fodeu',
            'fuckoff',
            'fuckyou',
            'fuck',
            'filhodaputa',
            'filho-da-puta',
            'fdp',
            'filhadaputa',
            'filha-da-m�e',
            'filho de uma egua',
            'filho de uma �gua',
            'filho-de-uma-egua',
            'filho-de-uma-�gua',
            'filhodeumaegua',
            'filhodeuma�gua',
            'filha de uma egua',
            'filha de uma �gua',
            'filha-de-uma-egua',
            'filha-de-uma-�gua',
            'filhadeumaegua',
            'filhadeuma�gua',
            'gozo',
            'goza',
            'gozar',
            'gozada',
            'gozadanacara',
            'merda',
            'merdas',
            'merdao',
            'merdaum',
            'merdinha',
            'vadia',
            'vasefoder',
            'venhasefoder',
            'voufoder',
            'vasefuder',
            'venhasefuder',
            'voufuder',
            'vaisefoder',
            'vaisefuder',
            'venhasefuder',
            'vaisifude',
            'vaisifoder',
            'vaisifuder',
            'vasifuder',
            'vasefuder',
            'vasefoder',
            'pirigueti',
            'piriguete',
            'porra',
            'porras',
            'porraloca',
            'porraloka',
            'porranacara',
            'puta',
            'putas',
            'putinha',
            'putona',
            'putassa',
            'putao',
            'punheta',
            'putamerda',
            'putaquepariu',
            'putaquemepariu',
            'putaquetepariu',
            'putavadia',
            'pqp',
            'putaqpariu',
            'putaqpario',
            'putaqparil',
            'peido',
            'peidar',
            'xoxota',
            'xoxotas',
            'xota',
            'xoxotinha',
            'xoxotona'
        );

        $iTotalPalavroes = sizeof($arrPalavroes);

        for ($i = 0; $i < $iTotalPalavroes; $i++)
        {
            $sConteudo = preg_replace('/\b' . $arrPalavroes[$i] . '\b/ie', "str_repeat('*',strlen('$0'))", $sConteudo);
        }

        return $sConteudo;
    }

    function validaCPF($cpf)
    {
        // determina um valor inicial para o digito $d1 e $d2
        // pra manter o respeito ;)
        $d1 = 0;
        $d2 = 0;
        // remove tudo que n�o seja n�mero
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        // lista de cpf inv�lidos que ser�o ignorados
        $ignore_list = array(
            '00000000000',
            '01234567890',
            '11111111111',
            '22222222222',
            '33333333333',
            '44444444444',
            '55555555555',
            '66666666666',
            '77777777777',
            '88888888888',
            '99999999999'
        );
        // se o tamanho da string for dirente de 11 ou estiver
        // na lista de cpf ignorados j� retorna false
        if (strlen($cpf) != 11 || in_array($cpf, $ignore_list))
        {
            return false;
        }
        else
        {
            // inicia o processo para achar o primeiro
            // n�mero verificador usando os primeiros 9 d�gitos
            for ($i = 0; $i < 9; $i++)
            {
                // inicialmente $d1 vale zero e � somando.
                // O loop passa por todos os 9 d�gitos iniciais
                $d1 += $cpf[$i] * (10 - $i);
            }
            // acha o resto da divis�o da soma acima por 11
            $r1 = $d1 % 11;
            // se $r1 maior que 1 retorna 11 menos $r1 se n�o
            // retona o valor zero para $d1
            $d1 = ($r1 > 1) ? (11 - $r1) : 0;
            // inicia o processo para achar o segundo
            // n�mero verificador usando os primeiros 9 d�gitos
            for ($i = 0; $i < 9; $i++)
            {
                // inicialmente $d2 vale zero e � somando.
                // O loop passa por todos os 9 d�gitos iniciais
                $d2 += $cpf[$i] * (11 - $i);
            }
            // $r2 ser� o resto da soma do cpf mais $d1 vezes 2
            // dividido por 11
            $r2 = ($d2 + ($d1 * 2)) % 11;
            // se $r2 mair que 1 retorna 11 menos $r2 se n�o
            // retorna o valor zeroa para $d2
            $d2 = ($r2 > 1) ? (11 - $r2) : 0;
            // retona true se os dois �ltimos d�gitos do cpf
            // forem igual a concatena��o de $d1 e $d2 e se n�o
            // deve retornar false.
            return (substr($cpf, -2) == $d1 . $d2) ? true : false;
        }
    }

    function validaemail($email)
    {
        $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";

        if (preg_match($er, $email))
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function encode( $sArg ) {
        
        $sChave = Config::NOME_SITE;
        $sEncode = base64_encode($sArg."-".$sChave);
        
        return $sEncode;
    }
    
    function decode( $sArg ) {
        
        $sChave = Config::NOME_SITE;
        $sDecode = base64_decode($sArg);
        $arrDecode = explode("-", $sDecode);
        
        return $arrDecode[0];
    }

    function geraAssinaturaIssuu ( $arrParametrosIssuu ) {
        ksort($arrParametrosIssuu);

        $sQuery = 'http://api.issuu.com/1_0?';
        $sAssinatura = "";
        $sLink = "";

        foreach ($arrParametrosIssuu as $key => $item) {
            $sAssinatura .= $key.$item;
            $sQuery .=  $key.'='.$item.'&';
        }
        
        $sAssinatura = md5(CONFIG::ISSUU_SECRET.$sAssinatura);

        $sLink = $sQuery.'signature='.$sAssinatura;

        return $sLink;
    }

}

?>