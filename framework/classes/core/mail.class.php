<?php

/* Revis�o: 10/11/2010 - Vers�o 1.1
 * 
 * 10/11/2010 - v1.1 - DD - DD - Melhoria - Cria��o da Classe de Controle de Envio de Email
 *
 */


//Biblioteca de Terceiros
require_once ('phpmailer/class.phpmailer.php' );

class Mail
{

    private static $sFrom     = Config::SMTP_EMAIL;
    private static $sFromName = Config::NOME_SITE;
    private static $sHost     = Config::SMTP_HOST;
    private static $sSMTPAuth = True;
    private static $sUsername = Config::SMTP_EMAIL;
    private static $sPassword = Config::SMTP_PWD;
    private static $Sender    = Config::SMTP_EMAIL;
    private static $sCharSet  = 'utf-8';
    private static $sContentType = 'multipart/alternative'; //multipart/alternative
    private static $iPort = 587;
    private static $sReplyTo = Config::SMTP_EMAIL;
    private static $sReplyToName = Config::NOME_SITE;
    private static $sBody = '';
    private static $sSubject = '';
    private static $sArrDestinatario = '';

    private function __construct()
    {
        
    }

    private function __clone()
    {
        
    }

    private function __wakeup()
    {
        
    }

    public static final function setaConfiguracaoEmail( $sArrArgConfig )
    {
        self::$sFrom        = $sArrArgConfig['email_emitente'];
        self::$sFromName    = $sArrArgConfig['nome_emitente'];
        //self::$sHost        = $sArrArgConfig['host_smtp'];
        self::$sUsername    = $sArrArgConfig['email_login'];
        self::$sPassword    = $sArrArgConfig['email_senha'];
        self::$Sender       = $sArrArgConfig['email_emitente'];
        self::$sReplyTo     = $sArrArgConfig['email_emitente'];
        self::$sReplyToName = $sArrArgConfig['nome_emitente'];

        if (isset($sArrArgConfig['porta']))
        {
            self::$iPort = $sArrArgConfig['porta'];
        }
    }

    public static function setaConteudo($sArgConteudo = '')
    {
        self::$sBody = $sArgConteudo;
    }

    public static function setaFrom($sArgFrom = '')
    {
        self::$sFrom = $sArgFrom;
    }

    public static function setaHost($sArgHost = '')
    {
        self::$sHost = $sArgHost;
    }

    public static function setaPort($sArgPort = '')
    {
        self::$iPort = $sArgPort;
    }

    public static function setaUsuario($sArgUsuario = '')
    {
        self::$sUsername = $sArgUsuario;
    }

    public static function setaSenha($sArgSenha = '')
    {
        self::$sPassword = $sArgSenha;
    }

    public static function setaRemetente($sArgRemetente = '')
    {
        self::$Sender = $sArgRemetente;
    }
    
    public static function setaReply ( $sArgReply = '' )
    {
        self::$sReplyTo = $sArgReply;
    }

    public static function setaAssunto($sArgAssunto = '')
    {
        self::$sSubject = $sArgAssunto;
    }

    public static function setaDestinatario($sArrArgDestinatario)
    {
        self::$sArrDestinatario = $sArrArgDestinatario;
    }

    public static function enviaEmail()
    {
        //Defini��o do Objeto
        $oMail = new PHPMailer ();
        $oMail->PluginDir =  '';

        //Defini��es de Envio
        $oMail->IsSMTP();
        $oMail->From = self::$sFrom;
        $oMail->FromName = self::$sFromName;
        $oMail->Host = self::$sHost;
        $oMail->SMTPAuth = self::$sSMTPAuth;
        $oMail->Username = self::$sUsername;
        $oMail->Password = self::$sPassword;
        $oMail->Sender = self::$Sender;
        $oMail->Port = self::$iPort;

        //$oMail->SMTPDebug  = 2; 
        //Reply-To
        $oMail->AddReplyTo(self::$sReplyTo, self::$sReplyToName);

        //Defini��es de Email
        $oMail->IsHTML(True);
        $oMail->CharSet = self::$sCharSet;
        $oMail->ContentType = self::$sContentType;

        //Defini��es de Conte�do
        $oMail->Subject = self::$sSubject;
        $oMail->Body = self::$sBody;
        $oMail->AltBody = strip_tags(self::$sBody);

        //Envia Email
        $mArrReturn = array();
        for ($a = 0, $iCount = count(self::$sArrDestinatario); $a < $iCount; ++$a)
        {
            try
            {
                $mArrReturn[$a]['email'] = self::$sArrDestinatario[$a]['Email'];
                $oMail->AddAddress(self::$sArrDestinatario[$a]['Email'], self::$sArrDestinatario[$a]['Nome']);

                $mArrReturn[$a]['status'] = $oMail->send();
                $oMail->ClearAllRecipients();
            }
            catch (phpmailerException $e)
            {
                echo $e->errorMessage(); //Pretty error messages from PHPMailer
            }
            catch (Exception $e)
            {
                echo $e->getMessage(); //Boring error messages from anything else!
            }
        }

        //Limpa Cache
        $oMail->ClearReplyTos();
        $oMail->ClearAllRecipients();

        return $mArrReturn;
    }

}

// "UNIT TEST"
    /*
    $sArrDestinatario = Array (
         0 => array ( 'Nome' => 'Daniel Duarte', 'Email' => 'daniel@k2software.com.br' ),
         1 => array ( 'Nome' => 'WebMaster',     'Email' => 'webmaster@k2software.com.br' ),
         2 => array ( 'Nome' => 'Andr�',         'Email' => 'andre@k2software.com.br' )
    );
    
    //Teste - Beta
    $sConteudo = '<p>&Eacute; fato que a implementa&ccedil;&atilde;o da Nf-e foi um avan&ccedil;o consider&aacute;vel, at&eacute; porque  no<br />Brasil o cen&aacute;rio fiscal &eacute; complexo e muitas vezes contradit&oacute;rio. Fora  o<br />avan&ccedil;o tecnol&oacute;gico que for&ccedil;ou as empresas de Software investir em  novas<br />ferramentas e pessoal. A princ&iacute;pio o projeto da Nf-e causou grande  polemica<br />por fatores &oacute;bvios. O pre&ccedil;o era inacess&iacute;vel, a dificuldade de  implementar<br />era gigante e as empresas j&aacute; estavam habituadas com o formul&aacute;rio  continuo. <br /><br /><span style="color: #00ffff;">Agora o processo flui bem, inclusive os contribuintes j&aacute;  conseguem "notar"</span><br /><span style="color: #00ffff;">alguns benef&iacute;cios com o modelo 55. A entrada da nota, por  exemplo, esta</span><br /><span style="color: #00ffff;">sendo feita automaticamente atrav&eacute;s do XML, recurso que tr&aacute;s  ganho de tempo</span><br /><span style="color: #00ffff;">e elimina erros de lan&ccedil;amento. Al&eacute;m do mais, as integra&ccedil;&otilde;es  entre sistemas</span><br /><span style="color: #00ffff;">administrativos e cont&aacute;beis ganharam um novo layout a n&iacute;vel  nacional que &eacute; o</span><br /><span style="color: #00ffff;">pr&oacute;prio XML, ou seja, esta muito mais f&aacute;cil integrar  softwares</span><br /><span style="color: #00ffff;">administrativos com cont&aacute;beis. Bom pra empresa e bom pro  contador.</span><br /><br /><br /><span style="background-color: #888888;">Um ponto interessante de citar &eacute; a organiza&ccedil;&atilde;o do cadastro  que foi for&ccedil;ada</span><br /><span style="background-color: #888888;">com as regras de valida&ccedil;&atilde;o da Nf-e. Assim, o que foi "chato"  no come&ccedil;o</span><br /><span style="background-color: #888888;">contribuiu para atualizar o cadastro geral (clientes,  fornecedores,</span><br /><span style="background-color: #888888;">transportadoras, itens e fiscal). </span><br /><br />Proporcionou  atualiza&ccedil;&atilde;o nos dados errados, vazios, antigos de modo que<br />ficou mais conciso  ampliando os relat&oacute;rios gerenciais/t&aacute;ticos.<br /><br />&nbsp;<br /><br />&nbsp;<br /><br /><span style="text-decoration: line-through;">Enfim tudo  isso j&aacute; passou, agora em 2011 novas empresas estar&atilde;o enquadradas</span><br /><span style="text-decoration: line-through;">na emiss&atilde;o  de NF-e. A implementa&ccedil;&atilde;o esta mais r&aacute;pida, clientes e</span><br /><span style="text-decoration: line-through;">fornecedores acabam se  ajudando porque o conceito j&aacute; esta em &acirc;mbito Brasil.</span><br /><span style="text-decoration: line-through;">Consultores j&aacute; est&atilde;o  inseridos e conhecendo todo esse contexto,</span><br /><span style="text-decoration: line-through;">principalmente as dificuldades da  implanta&ccedil;&atilde;o.</span><br /><br />&nbsp;<br /><br /><strong>E o Sistema K2 mudou conceitos de interface para  adotar uma metodologia de</strong><br /><strong>faturamento r&aacute;pida, agregou recursos de valida&ccedil;&atilde;o  para facilitar o</strong><br /><strong>entendimento das inconsist&ecirc;ncias, incluiu um dispositivo que  garante a</strong><br /><strong>seguran&ccedil;a do certificado A3, ou seja, o sistema s&oacute; pede a senha uma  vez ao</strong><br /><strong>abrir o modulo. </strong><br /><strong>Uma mudan&ccedil;a consider&aacute;vel para NF-e 2.0 foi &agrave;  reconstru&ccedil;&atilde;o de todo modulo</strong><br /><strong>visando principalmente os recursos de  hardware/software do contribuinte de</strong><br /><strong>maneira que n&atilde;o exija computadores  possantes para emiss&atilde;o.</strong><br /><br /><strong>Estas s&atilde;o algumas das caracter&iacute;sticas do novo  NF-e 2.0 tudo pronto para</strong><br /><strong>2011. </strong><br /><br /></p>';
    KMail::setaConteudo ( $sConteudo );
    KMail::setaAssunto ( 'Envio de Email Teste 01.01' );
    KMail::setaDestinatario ( $sArrDestinatario );
    $mArrEnviado = KMail::enviaEmail();

    echo 'Situa��o de Envio<br>';
    for ( $a = 0, $iCount = count ( $mArrEnviado ); $a < $iCount; ++$a )
    {
        if ( $mArrEnviado[$a]['status'] === True )
        {
            $sMsg = 'Email enviado com Sucesso';
        }
        else
        {
            $sMsg = 'Erro ao enviar o e-mail: ' . $mArrEnviado[$a]['status'];
        }
        echo '- ' . $mArrEnviado[$a]['email'] . ' : ' . $sMsg . '<br>';
    }
    */