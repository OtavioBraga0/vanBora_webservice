<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/>
        <div class="container">
            <h2>Alterar Senha</h2>
            <form action="?pagina=centraldecontrole/alterarSenha" method="post" >
                <div class="form-group">

                    <label class="sr-only" for="inputSenhaAtual">Senha Atual</label>
                    <input name="inputSenhaAtual" type="password" value="" />
                    <br/>
                    <label class="sr-only" for="inputNovaSenha">Nova Senha</label>
                    <input name="inputNovaSenha" id="inputNovaSenha" type="password"  value="" />
                    <br/>
                    <label class="sr-only"  for="inputConfirmaSenha">Digite a nova senha novamente</label>
                    <div class="form-inline">
                        <input name="inputConfirmaSenha" id="inputConfirmaSenha" type="password"  value="" />
                        <label style="margin : 8px 0 0 5px;" id="labelSenhaNaoConfere" ></label>
                    </div>
                    <br/>
                    <button type="submit" name="inputAlterarSenha" onclick="return verificaSenha();" class="btn btn-default">Salvar</button>
                    <label style="margin : 8px 0 0 5px;" >{$sMensagem}</label>
                </div>
            </form>   
        </div>
        <script type="text/javascript">	                                         
            function verificaSenha ( )
            {
                if($("#inputNovaSenha").val() !== ($("#inputConfirmaSenha").val()))
                {
                    $('#labelSenhaNaoConfere').html('<font color="red">Sua senha não corresponde</font>');
                    //$("#newpassword").val('');
                    //$("#conformpassword").val('');
                    //$('#newpassword').css("border", "#FF0000 solid 1px")
                    $('#inputConfirmaSenha').css("border", "#FF0000 solid 1px")
                    $("#inputConfirmaSenha").focus();

                    return false;
                }
                else
                {
                    return true;
                }
            }   			
        </script>
    </body>
</html>