{strip}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}      
    </head>
    <body id="bodyCentraldeControle">
        <div class="login-box">
            {if ( $bRecuperarSenha == false )}
                <div class="login-logo">
                    <img src="{$WWW_IMG}logo_amex.svg" alt="Amex Assessoria" title="Amex Assessoria" />
                </div>
                <!-- /.login-logo -->
                <div class="login-box-body">
                    <form action="?pagina=centraldecontrole/login" method="post">
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <input type="email" id="inputEmail" class="form-control" name="inputEmail" placeholder="Email">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback">
                            <div class="input-group">
                                <input type="password" class="form-control" name="inputSenha" placeholder="Password">
                                <div class="input-group-addon password-eye" data-target='inputSenha'>
                                    <i class="fa fa-eye-slash"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-xs-8">
                            <div class="checkbox icheck">
                            <label class="">
                                <a href="{$WWW}?pagina=centraldecontrole/login&recuperarSenha" title="Recuperar Senha">Esqueceu sua senha?</a>   
                            </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" name="btnSend" class="btn btn-primary btn-block btn-flat">Entrar</button>
                        </div>
                        <!-- /.col -->
                        </div>
                    </form>
                    {if ($msgErro <> null)}
                        <br/><br/><br/>
                        <div class="alert alert-error">
                            {$msgErro}
                        </div>
                    {else}
                        <br class="clear"/>
                    {/if}
                    <!-- /.social-auth-links -->
                    <br>
            
                </div>
                <!-- /.login-box-body -->
            {else}
                <div class="login-logo">
                    <img src="{$WWW_IMG}logo_amex.svg" alt="Amex Assessoria" title="Amex Assessoria" />
                </div>
                <!-- /.login-logo -->
                <p style="font-size: 14px" class="text-center">Para recuperar a sua senha, digite seu e-mail cadastrado. A senha atual será enviada.</p>
                <div class="login-box-body">
                    <p class="login-box-msg"></p>
                    <form action="?pagina=centraldecontrole/login" method="post">
                        <div class="form-group has-feedback">
                        <input type="email" id="inputEmail" class="form-control" name="inputEmail" placeholder="Email">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        </div>
                        <div class="row">
                        <!-- /.col -->
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                    <!-- /.social-auth-links -->
                    <br>
            
                </div>
                <!-- /.login-box-body -->
            {/if}
        </div>        
    </body>

    <script type="text/javascript" src="{$WWW_JS}jquery-3.2.1.min.js"></script>
    <script type="text/javascript">
            document.querySelector('#inputEmail').focus();

            $(".password-eye").click(function(){
                let icone = $(this).children();
                let target = $(this).attr('data-target');
                
                if(icone.hasClass('fa fa-eye')){
                    icone.removeClass();
                    icone.addClass('fa fa-eye-slash');
                    $("input[name='" + target + "']").attr('type','password');
                } else {
                    icone.removeClass();
                    icone.addClass('fa fa-eye');
                    $("input[name='" + target + "']").attr('type','text');
                }

            });
    </script>
</html>
{/strip}