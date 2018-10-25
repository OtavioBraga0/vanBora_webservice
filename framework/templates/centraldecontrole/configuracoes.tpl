{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
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
{/block}

{block name='body'}
    <div class="page-header">
        <a class="btn btn-primary" href="?pagina=centraldecontrole/imprimirIntencoes" target="_blank">
            <i class="fa fa-print"></i>
            Imprimir pedidos
        </a>
        <a class="btn btn-primary" href="?pagina=centraldecontrole/aprovarPedidos" >
            <i class="fa fa-check-square-o"></i>
            Aprovar testemunhos
        </a> 
    </div>
    {if $smarty.session.CODIGO <> 1}
        <form action="?pagina=centraldecontrole/configuracoes" method="post" >
            <div class="box box-default">
                <div class="box-header">
                    <h2>Alterar Senha</h2>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="inputSenhaAtual">Senha Atual</label>
                                <div class="input-group">
                                    <input name="inputSenhaAtual" class="form-control" type="password" value="" />
                                    <div class="input-group-addon password-eye" data-target='inputSenhaAtual'>
                                        <i class="fa fa-eye-slash"></i>
                                    </div>
                                </div>                        
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="inputNovaSenha">Nova Senha</label>
                                <div class="input-group">
                                    <input name="inputNovaSenha" class="form-control" id="inputNovaSenha" type="password"  value="" />  
                                    <div class="input-group-addon password-eye" data-target="inputNovaSenha">
                                        <i class="fa fa-eye-slash"></i>
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label  for="inputConfirmaSenha">Digite a nova senha novamente</label>
                                <div class="input-group">
                                    <input name="inputConfirmaSenha" class="form-control" id="inputConfirmaSenha" type="password"  value="" />
                                    <div class="input-group-addon password-eye" data-target="inputConfirmaSenha">
                                        <i class="fa fa-eye-slash"></i>
                                    </div>
                                </div>    
                                <label style="margin : 8px 0 0 5px;" id="labelSenhaNaoConfere" ></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="inputAlterarSenha" onclick="return verificaSenha();" class="btn btn-success">Salvar</button>
                    <label style="margin : 8px 0 0 5px;" >{$sMensagem}</label>
                </div>
            </div>
        </form>   
    {/if}
{/block}