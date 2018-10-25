<?php

class Util {

    private final function __construct() {
        
    }

    private final function __clone() {
        
    }

    private final function __wakeup() {
        
    }

    public static final function removeFormatacaoCnpj($sArg) {
        $sDicionario = array('.' => '',
            '-' => '',
            '/' => ''
        );
        return trim(strtr($sArg, $sDicionario));
    }

    public static final function timediff($date1 = null, $date2 = null) {
        // Valores padrão
        if (is_null($date1))
            $date1 = time();
        if (is_null($date2))
            $date2 = time();

        // Verificando argumentos
        if (!is_int($date1) || !is_int($date2))
            return false;
        if ($date2 >= $date1)
            return false;

        // Diferença entre os timestamps
        $diff = $date1 - $date2;

        $time = array(0, 0, 0);

        if ($diff >= 3600)
            $time[0] = floor(($diff >= 86400) ? ($diff / 86400) * 24 : $diff / 3600);

        if ($calc = ($diff % 3600)) {
            $time[1] = floor($calc / 60);
            $time[2] = $calc % 60;
        }
        return $time;
    }
    
    public static final function validaCNPJ($sArgCNPJ) {
        if (strlen($sArgCNPJ) == 18) {
            $sDicionario = array('.' => '',
                '-' => '',
                '/' => ''
            );
            $mTmp = trim(strtr($sArgCNPJ, $sDicionario));
            $sCnpj = str_split($mTmp);

            $v1 = ( 5 * $sCnpj[0] ) + ( 4 * $sCnpj[1] ) + ( 3 * $sCnpj[2] ) + ( 2 * $sCnpj[3] )
                    + ( 9 * $sCnpj[4] ) + ( 8 * $sCnpj[5] ) + ( 7 * $sCnpj[6] ) + ( 6 * $sCnpj[7] )
                    + ( 5 * $sCnpj[8] ) + ( 4 * $sCnpj[9] ) + ( 3 * $sCnpj[10] ) + ( 2 * $sCnpj[11] );

            $iResto = ( $v1 % 11 );
            $v1 = ( $iResto >= 10 ) ? 0 : 11 - $iResto;

            $v2 = ( 6 * $sCnpj[0] ) + ( 5 * $sCnpj[1] ) + ( 4 * $sCnpj[2] ) + ( 3 * $sCnpj[3] )
                    + ( 2 * $sCnpj[4] ) + ( 9 * $sCnpj[5] ) + ( 8 * $sCnpj[6] ) + ( 7 * $sCnpj[7] )
                    + ( 6 * $sCnpj[8] ) + ( 5 * $sCnpj[9] ) + ( 4 * $sCnpj[10] ) + ( 3 * $sCnpj[11] )
                    + ( 2 * $sCnpj[12] );


            $iResto = ( $v2 % 11 );
            $v2 = ( $iResto < 2 ) ? 0 : 11 - $iResto;
            $bValida = ( $v1 == $sCnpj[12] && $v2 == $sCnpj[13] ) ? true : false;

            if ($bValida === true) {
                return $sArgCNPJ;
            }
            return false;
        }
    }

    public static final function geraPaginacao($sArgDados = '', $iArgTotalRegistros = '', $bPaginacao = true) {
        $iNumRegistrosPagina = Config::CFG_PAGINACAO;

        /* Se o parametro paginação for falso, não realiza a paginação */
        if ($bPaginacao == false) {
            $iNumRegistrosPagina = $iArgTotalRegistros;
        }

        if ($iArgTotalRegistros <> '') {
            $iArrPaginacao['NUM_PAGINA'] = ceil($iArgTotalRegistros / $iNumRegistrosPagina);
        }
        else {
            $iArrPaginacao['NUM_PAGINA'] = ceil(count($sArgDados) / $iNumRegistrosPagina);
        }

        $iArrPaginacao['PAGINA_ATUAL'] = ( isset($_GET['p']) ) ? $_GET['p'] : 1;
        return $iArrPaginacao;
    }

    
    function retiraAcentos ($sArgString) {
        $string = ereg_replace("[^a-zA-Z0-9_.]", "", strtr($sArgString, "áàãâéêíóôõúüçÁÀÃÂÉÊÍÓÔÕÚÜÇ ", "aaaaeeiooouucAAAAEEIOOOUUC_"));
        
        return $string;
    }
    
    private static $removeArray = array(
    "a" => "a" ,
    "b" => "b" ,
    "c" => "c" ,
    "d" => "d" ,
    "e" => "e" ,
    "f" => "f" ,
    "g" => "g" ,
    "h" => "h" ,
    "i" => "i" ,
    "j" => "j" ,
    "k" => "k" ,
    "l" => "l" ,
    "m" => "m" ,
    "n" => "n" ,
    "o" => "o" ,
    "p" => "p" ,
    "q" => "q" ,
    "r" => "r" ,
    "s" => "s" ,
    "t" => "t" ,
    "u" => "u" ,
    "v" => "v" ,
    "x" => "x" ,
    "y" => "y" ,
    "z" => "z" ,
    "á" => "a" ,
    "é" => "e" ,
    "í" => "i" ,
    "ó" => "o" ,
    "ú" => "u" ,
    "à" => "a" ,
    "è" => "e" ,
    "ì" => "i" ,
    "ò" => "o" ,
    "ù" => "ù" ,
    "ã" => "a" ,
    "õ" => "o" ,
    "â" => "a" ,
    "ê" => "e" ,
    "î" => "i" ,
    "ô" => "o" ,
    "û" => "u" ,
    "," => ""  ,
    "!" => "" ,
    "#" => "" ,
    "%" => "",
    "¬" => "" ,
    "-" => "_" ,
    "{" => "" ,
    "}" => "" ,
    "^" => ""  ,
    "´" => "" ,
    "`" => "" ,
    "" => "" ,
    "/" => "" ,
    ";" => "" ,
    ":" => "" ,
    "?" => "" ,
    "¹" => "1" ,
    "²" => "2" ,
    "³" => "3" ,
    "ª" => "a" ,
    "º" => "o" ,
    "ç" => "c" ,
    "ü" => "u" ,
    "ä" => "a" ,
    "ï" => "i" ,
    "ö" => "o" ,
    "ë" => "e" ,
    "$" => "s" ,
    "ÿ" => "y" ,
    "w" => "w" ,
    "<" => "" ,
    ">" => "" ,
    "[" => "" ,
    "]" => "" ,
    "&" => "e" ,
    " " => "-" , //aki transformamos os espaços
    "'" => '' ,
    '"' => ""  ,
    '1' => '1' ,
    '2' => '2' ,
    '3' => '3' ,
    '4' => '4' ,
    '5' => '5' ,
    '6' => '6' ,
    '7' => '7' ,
    '8' => '8' ,
    '9' => '9' ,
    '0' => '0'
    );

    private static $acentosArray = array(
        'á' => 'a' , 'Á' => 'A' ,
        'é' => 'e' , 'É' => 'E' ,
        'í' => 'i' , 'Í' => 'I' ,
        'ó' => 'o' , 'Ó' => 'O' ,
        'ú' => 'u' , 'Ú' => 'U' ,
        'â' => 'â' , 'Â' => 'A' ,
        'ê' => 'ê' , 'Ê' => 'E' ,
        'ô' => 'ô' , 'Ô' => 'O' ,
        'à' => 'a' , 'À' => 'A' ,
        'ç' => 'c' , 'Ç' => 'C' ,
        'ã' => 'a' , 'Ã' => 'A' ,
        'õ' => 'o' , 'Õ' => 'O'
    );
    
    /**
     * Limpa uma string para ser usada como termo de uma URL
     * @param string $string
     * @return string
     */
    public static function formataUrl($string) {
        $finalString = "";
        $string = strtolower($string);
        $string = str_replace("'", "", $string);
        $string = str_replace('"', "", $string);

        $string = trim($string);

        $string = filter_var($string, FILTER_SANITIZE_STRING);

        foreach(str_split($string) as $str) {
            $finalString .= self::$removeArray[$str];
        }

        $finalString = str_replace("__", "_", $finalString);
        $finalString = str_replace("__", "_", $finalString);

        if(substr($finalString, -1, 1)=="_") {
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
    public static function removeAcento($string) {
        $finalString = "";
        $string = str_replace("'", "", $string);
        $string = str_replace('"', "", $string);
        $string = str_replace('&', "", $string);

        $string = trim($string);

        $string = filter_var($string, FILTER_SANITIZE_STRING);

        foreach(str_split($string) as $str) {
            if(key_exists($str, self::$acentosArray)) {
                $finalString .= self::$acentosArray[$str];
            } else {
                $finalString .= $str;
            }
        }

        if(substr($finalString, -1, 1)=="_") {
            $finalString = substr($finalString, 0, -1);
        }

        return $finalString;
    }
    
    public static final function converterDataParaMysql($sData)
    {

        $sTmp = explode('/', $sData);
        $sData = trim($sTmp[2]) . '-' . trim($sTmp[1]) . '-' . trim($sTmp[0]);

        return $sData;
    }
    
    public static final function converterDataParaBR($sData)
    {

        $sTmp = explode('-', $sData);
        $sData = trim($sTmp[2]) . '-' . trim($sTmp[1]) . '-' . trim($sTmp[0]);

        return $sData;
    }
    
    public static final function inverteData($sData, $sSeparadorAtual, $sSeparadorFinal)
    {

        $sTmp = explode($sSeparadorAtual, $sData);
        $sData = $sTmp[2] . $sSeparadorFinal . $sTmp[1] . $sSeparadorFinal . $sTmp[0];

        return $sData;
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
                $sRetornoMes = 'Março';
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
    
    public static final function uploadThumb($sDiretorio, $sArquivo )
    {
        Controller::loadClass('core/upload'); 
        
        if ( !file_exists ( $sDiretorio ) )
        {
            mkdir( $sDiretorio );
        }
        
        $oFotoUpload = new Upload( $sArquivo );
        
        if ( $oFotoUpload->uploaded )
        {

            $oFotoUpload->file_overwrite = true;
            $oFotoUpload->image_convert = 'jpg';
            
            //Configuracoes de redimensionamento retrato
            $lMax  = 500; //largura maxima permitida
            $aMax  = 400; // altura maxima permitida
            //
            //Configuracoes de redimensionamento paisagem
            $plMax = 450; //largura maxima permitida
            $paMax = 350; // altura maxima permitida


            if ( $oFotoUpload->image_src_x > $oFotoUpload->image_y )
            {
                if ( $oFotoUpload->image_src_x > $lMax || $oFotoUpload->image_y > $aMax )
                {
                    $oFotoUpload->image_resize = true;
                    $oFotoUpload->image_ratio = true;
                    $oFotoUpload->image_x = ($lMax / 2);
                    $oFotoUpload->image_y = ($aMax / 2);
                }
            }
            else
            {
                if ( $oFotoUpload->image_src_x > $plMax || $oFotoUpload->image_y > $paMax )
                {
                    $oFotoUpload->image_resize = true;
                    $oFotoUpload->image_ratio = true;
                    $oFotoUpload->image_x = ($plMax / 2);
                    $oFotoUpload->image_y = ($paMax / 2);
                }
            }

            $oFotoUpload->file_new_name_body = md5( uniqid( $sArquivo['name'] ) );
            $oFotoUpload->Process( $sDiretorio );

            if ( $oFotoUpload->processed )
            {
                return $oFotoUpload->file_dst_name;
            }
            else
            {
                return false;
            }
        }
    }
    
    public static final function uploadMultiplo(array $_files, $top = TRUE)
    {
        $files = array();
        foreach($_files as $name=>$file){
            if($top) $sub_name = $file['name'];
            else    $sub_name = $name;

            if(is_array($sub_name)){
                foreach(array_keys($sub_name) as $key){
                    $files[$name][$key] = array(
                        'name'     => $file['name'][$key],
                        'type'     => $file['type'][$key],
                        'tmp_name' => $file['tmp_name'][$key],
                        'error'    => $file['error'][$key],
                        'size'     => $file['size'][$key],
                    );
                    $files[$name] = Util::uploadMultiplo($files[$name], FALSE);
                }
            }else{
                $files[$name] = $file;
            }
        }
        return $files;
    }
    
    public static final function gerarRandomString( $iTamanho ) 
    {
        $sCaracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
        $iCaracteresTamanho = strlen($sCaracteres);
        $sRandomString = '';
        
        for ($i = 0; $i < $iTamanho; $i++) 
        {
            $sRandomString .= $sCaracteres[rand(0, $iCaracteresTamanho - 1)];
        }
        
        return $sRandomString;
    }
    
    public static final function tempoAtras($ptime)
    {
        $etime = time() - strtotime($ptime);

        if ($etime < 1)
        {
            return '0 segundos';
        }

        $a = array( 365 * 24 * 60 * 60  =>  'ano',
                     30 * 24 * 60 * 60  =>  'mês',
                          24 * 60 * 60  =>  'dia',
                               60 * 60  =>  'hora',
                                    60  =>  'minuto',
                                     1  =>  'segundo'
                    );
        $a_plural = array( 'ano'     => 'anos',
                           'mês'     => 'meses',
                           'dia'     => 'dias',
                           'hora'    => 'horas',
                           'minuto'  => 'minutos',
                           'segundo' => 'segundos'
                    );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' atrás';
            }
        }
    }
	
	public static final function validaCPF($cpf)
    {
        // determina um valor inicial para o digito $d1 e $d2
        // pra manter o respeito ;)
        $d1 = 0;
        $d2 = 0;
        // remove tudo que não seja número
        $cpf = preg_replace("/[^0-9]/", "", $cpf);
        // lista de cpf inválidos que serão ignorados
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
        // na lista de cpf ignorados já retorna false
        if (strlen($cpf) != 11 || in_array($cpf, $ignore_list))
        {
            return false;
        }
        else
        {
            // inicia o processo para achar o primeiro
            // número verificador usando os primeiros 9 dígitos
            for ($i = 0; $i < 9; $i++)
            {
                // inicialmente $d1 vale zero e é somando.
                // O loop passa por todos os 9 dígitos iniciais
                $d1 += $cpf[$i] * (10 - $i);
            }
            // acha o resto da divisão da soma acima por 11
            $r1 = $d1 % 11;
            // se $r1 maior que 1 retorna 11 menos $r1 se não
            // retona o valor zero para $d1
            $d1 = ($r1 > 1) ? (11 - $r1) : 0;
            // inicia o processo para achar o segundo
            // número verificador usando os primeiros 9 dígitos
            for ($i = 0; $i < 9; $i++)
            {
                // inicialmente $d2 vale zero e é somando.
                // O loop passa por todos os 9 dígitos iniciais
                $d2 += $cpf[$i] * (11 - $i);
            }
            // $r2 será o resto da soma do cpf mais $d1 vezes 2
            // dividido por 11
            $r2 = ($d2 + ($d1 * 2)) % 11;
            // se $r2 mair que 1 retorna 11 menos $r2 se não
            // retorna o valor zeroa para $d2
            $d2 = ($r2 > 1) ? (11 - $r2) : 0;
            // retona true se os dois últimos dígitos do cpf
            // forem igual a concatenação de $d1 e $d2 e se não
            // deve retornar false.
            return (substr($cpf, -2) == $d1 . $d2) ? true : false;
        }
    }
	
	public static final function validaemail($email)
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

    public static final function geraAssinaturaIssuu ( $arrParametrosIssuu ) {
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

    public static final function encrypt ( $q ) {
        $cryptKey  = Config::REST_SENHA;
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }
    
}

?>