<?php

class Security
{
    const NUM_LEN_USUARIO = 150;
    const NUM_LEN_SENHA   = 100;
    const NUM_DIGITOS  = 6; // N�mero de D�gitos de Verifica��o ( Sequencia de seis n�meros )
    
    private final function __construct () { }

    private final function __clone () { }

    private final function __wakeup () { }


    public final static function validaUsuario ( $sArgUsuario )
    {
        $sArgUsuario = trim ( $sArgUsuario );
        if ( strlen ( $sArgUsuario ) <= self::NUM_LEN_USUARIO )
        {
            return true;
        }
        return false;
    }

    public final static function validaEmail($sArgEmail){
        //verifica se e-mail esta no formato correto de escrita
        if (!ereg('^([a-zA-Z0-9.-_])*([@])([a-z0-9]).([a-z]{2,3})',$sArgEmail)){
            $mensagem='E-mail Inv&aacute;lido!';
            return $mensagem;
        }
        else{
            //Valida o dominio
            $dominio=explode('@',$sArgEmail);
            if(!checkdnsrr($dominio[1],'A')){
                $mensagem='E-mail Inv&aacute;lido!';
                return $mensagem;
            }
            else{return true;} // Retorno true para indicar que o e-mail é valido
        }
    }


    public final static function validaSenha ( $sArgSenha )
    {
        if ( strlen ( $sArgSenha ) <= self::NUM_LEN_SENHA )
        {
            return true;
        }
        return false;
    }
    
    public final static function encodeUrl ( $sArgAcao )
    {
        //Digitos e Digito Verificador
        $sDigitos = '';
        $sDigitoVerificador = 0;
        for ( $a = 0; $a < Security::NUM_DIGITOS; ++$a )
        {
            $iTmpNumero = rand( 1, 9 );
            $sDigitos .= $iTmpNumero;
            $sDigitoVerificador += (int) $iTmpNumero;
        }

        //Convers�o do Texto/A��o
        $sTexto = $sArgAcao . '.' . rand( 1, 9 ) . rand ( 1, 9 ) . rand ( 1, 9 );
        $sTexto = (string) base64_encode ( $sTexto );
        $sTexto = Security::inverteString ( $sTexto );

        //Junk Information =)
        $sJunk = base64_encode ( 'PKIU.' . rand( 1, 9 ) . rand ( 1, 9 ) . rand ( 1, 9 ) );

        //Monta Url
        $sUrl = $sDigitos . '-' . $sTexto . '-' . base64_encode ( $sDigitoVerificador ) . '-' . $sJunk;

        return $sUrl;
    }
    
    private final static function inverteString ( $sArgString )
    {
        $sTexto = str_split ( $sArgString );
        $sTexto = array_reverse ( $sTexto );
        $sTexto = implode ( '', $sTexto );
        return $sTexto;
    }

}
?>