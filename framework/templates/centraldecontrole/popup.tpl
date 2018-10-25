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
                <a class="btn btn-primary" href="?pagina=centraldecontrole/popup&acao=editar">
                    <i class="icon-plus-sign icon-white"></i> Novo Popup
                </a>
            </div>
            {if $sAcao == 'lista'}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjPopup as $oPopup}
                            <tr>
                                <td>
                                    <a href="?pagina=centraldecontrole/popup&acao=editar&codigo={$oPopup->iCodigo}" title="Editar popup">{$oPopup->sDescricao}</a>
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/popup&excluir&codigo={$oPopup->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="2">
                                    Nenhum Popup
                                </td>
                            </tr>

                        {/foreach}
                    </tbody>
                </table>
             {elseif $sAcao == 'editar'}
                <form action="?pagina=centraldecontrole/popup&acao=lista" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        
                        <input name="inputCodigo" type="hidden" value="{$oPopup->iCodigo}" />
                        <label  for="inputDescricao">Descrição</label>
                        <input type="text" name="inputDescricao" style="width:300px;" maxlength="250"  value="{$oPopup->sDescricao}" />
                        <br/><br/>
                        
                        <label  for="inputImagemUrl">Imagem do Popup</label>
                        {if $oPopup->sImagemUrl == ''}
                            <input type="file" name="inputPopup"  accept="image/x-png, image/gif, image/jpeg" style="width:300px;" />
                        {else}
                             <input type="hidden" name="inputPopupHidden"  value="{$oPopup->sImagemUrl}" />
                             <img src="images/banner/{$oPopup->sImagemUrl}" style="width:300px;"/>
                             
                             <br/><br/>
                             <label  for="inputImagemUrl">Nova Imagem</label>
                             <input type="file" name="inputPopup"  accept="image/x-png, image/gif, image/jpeg" style="width:300px;" />
                        {/if}
                        <br/><br/>
                        
                        <label  for="inputLink">Link</label>
                        <input type="text" name="inputLink"  style="width:300px;" value="{$oPopup->sLink}" />          
                        <br/><br/>

                        <label  for="inputLinkExterno">Abrir link externamente?</label>
                        <select class="inputLinkExterno" name="inputLinkExterno" style="width:80px;">
                            <option value=1 {if $oPopup->bLinkExterno == 1}selected{/if}>Sim</option>
                            <option value=0 {if $oPopup->bLinkExterno == 0}selected{/if}>Não</option>
                        </select>
                        <br/><br/>

                        <label>Data e hora de entrada</label>
                        <input type="text" class="data" name="inputEntradaData" id="inputEntradaData" maxlength="20" style="width:100px" value="{if ($oPopup->sEntrada !== null) && ($oPopup->sEntrada !== "")}{$oPopup->sEntrada|date_format:"%d/%m/%Y"}{/if}"/>
                        <input type="text" class="hora" name="inputEntradaHora" id="inputEntradaHora" maxlength="20" style="width:50px" value="{if ($oPopup->sEntrada !== null) && ($oPopup->sEntrada !== "")}{$oPopup->sEntrada|date_format:"H:i"}{/if}"/>
                        <br/><br/>

                        <label>Data e hora de saída</label>
                        <input type="text" class="data" name="inputExpiracaoData" id="inputExpiracaoData" maxlength="20" style="width:100px" value="{if ($oPopup->sExpiracao !== null) && ($oPopup->sExpiracao !== "")}{$oPopup->sExpiracao|date_format:"%d/%m/%Y"}{/if}"/>
                        <input type="text" class="hora" name="inputExpiracaoHora" id="inputExpiracaoHora" maxlength="20" style="width:50px" value="{if ($oPopup->sExpiracao !== null) && ($oPopup->sExpiracao !== "")}{$oPopup->sExpiracao|date_format:"H:i"}{/if}"/>
                        <br/><br/>

                        <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                        <a href="?pagina=centraldecontrole/popup&acao=lista"  class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
             {/if}
        </div>
        <script type="text/javascript" src="{$WWW_JS}jquery.maskedinput.js"></script>
        <script type="text/javascript">

            $(function(){  
                $(".data").mask("99/99/9999");   
                $(".hora").mask("99:99");  
            });  

            function confirmaExcluir()
            {
                var btnConfirm = confirm ( 'Deseja realmente excluir este Popup?' );
                
                if ( btnConfirm )
                {
                    return true;
                }
                
                return false;
            }
        </script>
    </body>
</html>