<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/>
        <div class="container">
            <div class="page-header">
                <a class="btn btn-primary" href="?pagina=centraldecontrole/usuario&acao=editar">
                    <i class="icon-plus-sign icon-white"></i> Novo Usuário
                </a>
            </div>
            {if $sAcao == 'lista'}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Usuário</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Ativo</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjUsuario as $oUsuario}
                            <tr>
                                <td>
                                    <a href="?pagina=centraldecontrole/usuario&acao=editar&codigo={$oUsuario->iCodigo}" title="Editar usuário">{$oUsuario->sNome}</a>
                                </td>
                                <td>
                                    {$oUsuario->sNome}
                                </td>
                                <td>
                                    {$oUsuario->sEmail}
                                </td>
                                <td>
                                    {if ($oUsuario->sAtivo == 'S')}Sim{else}Não{/if}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/usuario&excluir&codigo={$oUsuario->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="5">
                                    Nenhum Usuário
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
             {elseif $sAcao == 'editar'}
                <form action="?pagina=centraldecontrole/usuario&acao=lista" method="post" >
                    <div class="form-group form-inline">
                        <input name="inputCodigo" type="hidden" value="{$oUsuario->iCodigo}" />
                        
                        <label style="margin-left:10px;"  for="inputLogin">Login</label>
                        <input type="text" name="inputLogin" value="{$oUsuario->sLogin}" />
                        
                        {if $oUsuario->iCodigo == ''}
                            <label style="margin-left:10px;" maxlength="12"  for="inputSenha">Senha</label>
                            <input type="password" name="inputSenha" value="{$oUsuario->sSenha}" />
                        {/if}
                        <input type="checkbox" {if $oUsuario->sAtivo == 'S'}checked{/if} name="inputAtivo" style="margin-left:10px;margin-top:-3px;" /> Ativo
                        
                        <br/><br/>
                        
                        <label style="margin-left:10px;"  for="inputNome">Nome</label>
                        <input type="text" name="inputNome" style="width:500px;" value="{$oUsuario->sNome}" />
                        
                        <label style="margin-left:10px;"  for="inputEmail">E-mail</label>
                        <input type="text" name="inputEmail" style="width:350px;" value="{$oUsuario->sEmail}" />
                        
                        <br/><br/>
                        
                        <input type="checkbox" name="inputVisualizarRelatorios"       {if $oUsuario->sVisualizarRelatorios == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Visualizar Relatórios 
                        <input type="checkbox" name="inputAdministrarEspiritualidade" {if $oUsuario->sAdministrarEspiritualidade == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Administrar Espiritualidade 
                        
                        <br/><br/>
                        Postagens : 
                        
                        <input type="checkbox" name="inputAdicionarPublicacao" {if $oUsuario->sAdicionarArtigo == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Criar 
                        <input type="checkbox" name="inputEditarPublicacao"    {if $oUsuario->sEditarArtigo == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Editar 
                        <input type="checkbox" name="inputExcluirPublicacao"   {if $oUsuario->sExcluirArtigo == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Excluir 
                        
                        <br/><br/>
                        
                        Cadastrar : 
                        
                        <input type="checkbox" name="inputCadastrarUsuario"     {if $oUsuario->sCadastrarUsuario == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Usuários
                        <input type="checkbox" name="inputCadastrarFoto"        {if $oUsuario->sCadastrarFoto == 'S'}checked{/if}  style="margin-left:10px;margin-top:-3px;" /> Fotos
                        <input type="checkbox" name="inputCadastrarTag"         {if $oUsuario->sCadastrarTag == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Tags
                        <input type="checkbox" name="inputCadastrarVideo"       {if $oUsuario->sCadastrarVideo == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Vídeo
                        <input type="checkbox" name="inputCadastrarAudio"       {if $oUsuario->sCadastrarAudio == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Áudio
                        <input type="checkbox" name="inputCadastrarMenu"        {if $oUsuario->sCadastrarMenu  == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Menu
                        <input type="checkbox" name="inputCadastrarCarrossel"   {if $oUsuario->sCadastrarCarrossel   == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Carrossel
                        <input type="checkbox" name="inputCadastrarInformativo" {if $oUsuario->sCadastrarInformativo == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Informativo
                        <input type="checkbox" name="inputCadastrarConfiguracoes" {if $oUsuario->sCadastrarConfiguracoes == 'S'}checked{/if} style="margin-left:10px;margin-top:-3px;" /> Configurações
                        <br/><br/>
                        
                        <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                        <a href="?pagina=centraldecontrole/usuario&acao=lista"  class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
             {/if}
        </div>
        <script type="text/javascript">
            function confirmaExcluir()
            {
                var btnConfirm = confirm ( 'Deseja realmente excluir este Usuário?' );
                
                if ( btnConfirm )
                {
                    return true;
                }
                
                return false;
            }
        </script>
    </body>
</html>