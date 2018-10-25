<?php

class Login
{

    private static $sMsgErro;

    const USUARIO_ATIVO = 'S';
    const USUARIO_INATIVO = 'N';
    const ACTION_LOGIN = 'centraldecontrole/login';
    const INDICE_ACTION = 'pagina';
    const WEBSERVICE_PASSPORT = '!redireciona';

    private final function __construct()
    {
        
    }

    private final function __clone()
    {
        
    }

    private final function __wakeup()
    {
        
    }

    public static final function verificaAutenticacao()
    {
        
        if ( ( isset($_SESSION['CODIGO']) ) && $_SESSION['WEB_PASSPORT'] == '!Valid.Passport' ) 
        {
            if (isset($_GET[Login::INDICE_ACTION]) && ( $_GET[Login::INDICE_ACTION] == self::WEBSERVICE_PASSPORT ))
            {                
                Header ( 'Location:' . PATH_WWW . 'index.php?pagina=' . $_GET['destino'] );
                exit();
            }
        }
        else
        {   
            //Header ( 'Location:' . PATH_WWW . 'index.php?a=logoff' );
            $_GET[Login::INDICE_ACTION] = Login::ACTION_LOGIN;
     
        }
    }

    
    public static final function autenticaUsuario()
    {
        if (isset($_POST['inputEmail']) && isset($_POST['inputSenha']))
        {
            $bLogin = Security::validaUsuario($_POST['inputEmail']);
            $bSenha = Security::validaSenha($_POST['inputSenha']);
            try
            {
                if ($bLogin && $bSenha)
                {   
                    //Inicializa o Banco de Dados
                    $oConexao = db::conectar();
                    $mResultado = $oConexao->prepare("SELECT
                           Usuario_vch_Login,
                           Usuario_chr_Senha,
                           Usuario_lng_Codigo,
                           Usuario_chr_Ativo,
                           Usuario_vch_Nome,
                           Usuario_chr_Adicionar_Artigo,
                           Usuario_chr_Editar_Artigo,
                           Usuario_chr_Excluir_Artigo,
                           Usuario_chr_Cadastrar_Usuario,
                           Usuario_chr_Cadastrar_Foto,
                           Usuario_chr_Cadastrar_Tag,
                           Usuario_chr_Cadastrar_Video,
                           Usuario_chr_Cadastrar_Audio,
                           Usuario_chr_Cadastrar_Menu,
                           Usuario_chr_Cadastrar_Informativo,
                           Usuario_chr_Cadastrar_Carrossel,
                           Usuario_chr_Administrar_Espiritualidade,
                           Usuario_chr_Visualizar_Relatorios,
                           Usuario_chr_Cadastrar_Configuracoes
                           FROM Usuario
                           WHERE Usuario_vch_Email = '".$_POST['inputEmail']."' AND Usuario_chr_Senha = '".sha1($_POST['inputSenha'])."'                    
                         ");  
 
                    $mResultado->execute();
                    

                    $mArrDados = $mResultado->fetch(PDO::FETCH_ASSOC);
                    
                    
                    if (is_array($mArrDados) && isset($mArrDados['Usuario_chr_Ativo']))
                    {
                        switch ($mArrDados['Usuario_chr_Ativo'])
                        {
                            case Login::USUARIO_ATIVO;
                            case NULL:
                                
                                $_SESSION['WEB_PASSPORT']                        = '!Valid.Passport'; 
                                $_SESSION['NOME']                                = $mArrDados['Usuario_vch_Nome'];
                                $_SESSION['CODIGO']                              = $mArrDados['Usuario_lng_Codigo'];
                                $_SESSION['PERMISSOES']['ADICIONAR_ARTIGO']      = $mArrDados['Usuario_chr_Adicionar_Artigo'];
                                $_SESSION['PERMISSOES']['EDITAR_ARTIGO']         = $mArrDados['Usuario_chr_Editar_Artigo'];
                                $_SESSION['PERMISSOES']['EXCLUIR_ARTIGO']        = $mArrDados['Usuario_chr_Excluir_Artigo'];
                                $_SESSION['PERMISSOES']['CADASTRAR_USUARIO']     = $mArrDados['Usuario_chr_Cadastrar_Usuario'];
                                $_SESSION['PERMISSOES']['CADASTRAR_FOTO']        = $mArrDados['Usuario_chr_Cadastrar_Foto'];
                                $_SESSION['PERMISSOES']['CADASTRAR_TAG']         = $mArrDados['Usuario_chr_Cadastrar_Tag'];
                                $_SESSION['PERMISSOES']['CADASTRAR_VIDEO']       = $mArrDados['Usuario_chr_Cadastrar_Video'];
                                $_SESSION['PERMISSOES']['CADASTRAR_AUDIO']       = $mArrDados['Usuario_chr_Cadastrar_Audio'];
                                $_SESSION['PERMISSOES']['CADASTRAR_MENU']        = $mArrDados['Usuario_chr_Cadastrar_Menu'];
                                $_SESSION['PERMISSOES']['CADASTRAR_INFORMATIVO'] = $mArrDados['Usuario_chr_Cadastrar_Informativo'];
                                $_SESSION['PERMISSOES']['CADASTRAR_CARROSSEL']   = $mArrDados['Usuario_chr_Cadastrar_Carrossel'];
                                $_SESSION['PERMISSOES']['VISUALIZAR_RELATORIOS'] = $mArrDados['Usuario_chr_Visualizar_Relatorios'];
                                $_SESSION['PERMISSOES']['ADMINISTRAR_ESPIRITUALIDADE'] = $mArrDados['Usuario_chr_Administrar_Espiritualidade'];
                                $_SESSION['PERMISSOES']['CADASTRAR_CONFIGURACOES']     = $mArrDados['Usuario_chr_Cadastrar_Configuracoes'];
                                 
                                /* Redireciona */
                                Header("Location:" . PATH_WWW . '?pagina=centraldecontrole/inicial');
                                exit();
                                break;

                            case Login::USUARIO_INATIVO:
                                self::$sMsgErro = 'Usuário inativo, por favor, entre em contato com o Administrador do Sistema.';
                                break;

                            default:
                                self::$sMsgErro = 'Erro desconhecido, por favor, entre em contato com o Administrador do Sistema';
                                break;
                        }
                    }
                }
            }
            catch (Exception $e)
            {
                //Error::fatalError($e->getCode() . ':' . $e->getMessage());
            }
            self::$sMsgErro = 'Login e/ou senha são inválidos.';
        }
        return false;
    }
    

    public static final function pegaMsgErro()
    {
        return self::$sMsgErro;
    }

    public static final function sairSistema()
    {
        $_SESSION['WEB_PASSPORT'] = '';
        $_SESSION['NOME']         = '';
        $_SESSION['CODIGO']       = '';
        $_SESSION['PERMISSOES']   = '';
        //$_SESSION = array();

        unset($_SESSION['WEB_PASSPORT']);
        unset($_SESSION['NOME']);
        unset($_SESSION['CODIGO']);
        unset($_SESSION['PERMISSOES']);

    }

}

?>