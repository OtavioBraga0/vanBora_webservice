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
                <a class="btn btn-primary" href="?pagina=centraldecontrole/informativo&acao=editar">
                    <i class="icon-plus-sign icon-white"></i> Novo Informativo
                </a>
            </div>
            {if $sAcao == 'lista'}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Informativo</th>
                            <th>Mês</th>
                            <th>Ano</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjInformativo as $oInformativo}
                            <tr>
                                <td>
                                    <a href="?pagina=centraldecontrole/informativo&acao=editar&codigo={$oInformativo->iCodigo}" title="Editar informativo">{$oInformativo->sDescricao}</a>
                                </td>
                                <td>
                                   {$oInformativo->sMes}
                                </td>
                                <td>
                                   {$oInformativo->sAno}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/informativo&excluir&codigo={$oInformativo->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="4">
                                    Nenhum Informativo
                                </td>
                            </tr>

                        {/foreach}
                    </tbody>
                </table>
             {elseif $sAcao == 'editar'}
                <form action="?pagina=centraldecontrole/informativo&acao=lista" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input name="inputCodigo" type="hidden" value="{$oInformativo->iCodigo}" />
                        <label  for="inputDescricao">Descrição</label>
                        <input required type="text" name="inputDescricao" style="width:300px;"  value="{$oInformativo->sDescricao}" />
                        <br/><br/>
                        
                        <label  for="inputInformativo">Informativo</label>
                        {if $oInformativo->sUrl <> ''}
                            <input required type="text" name="inputInformativoText" readonly  style="width:300px;" value="{$oInformativo->sUrl}" />
                            <br/><br/>
                            <label  for="inputInformativo">Alterar Informativo</label>
                        {/if}
                        <input required type="file" name="inputInformativo" accept="application/pdf"  style="width:300px;"  />
                        <br/><br/>
                        
                        <label  for="inputMes">Mês</label>
                        <!-- <input type="file" name="inputInformativo"  style="width:300px;"  /> -->
                        <select required name="inputMes" style="width:60px;">
                            <option value="01"  {if $oInformativo->sMes == '01'}selected{/if} >Janeiro</option>
                            <option value="02"  {if $oInformativo->sMes == '02'}selected{/if} >Fevereiro</option>
                            <option value="03"  {if $oInformativo->sMes == '03'}selected{/if} >Março</option>
                            <option value="04"  {if $oInformativo->sMes == '04'}selected{/if} >Abril</option>
                            <option value="05"  {if $oInformativo->sMes == '05'}selected{/if} >Maio</option>
                            <option value="06"  {if $oInformativo->sMes == '06'}selected{/if} >Junho</option>
                            <option value="07"  {if $oInformativo->sMes == '07'}selected{/if} >Julho</option>
                            <option value="08"  {if $oInformativo->sMes == '08'}selected{/if} >Agosto</option>
                            <option value="09"  {if $oInformativo->sMes == '09'}selected{/if} >Setembro</option>
                            <option value="10" {if $oInformativo->sMes == '10'}selected{/if} >Outubro</option>
                            <option value="11" {if $oInformativo->sMes == '11'}selected{/if} >Novembro</option>
                            <option value="12" {if $oInformativo->sMes == '12'}selected{/if} >Dezembro</option>
                        </select>
                        <br/><br/>
                        
                        <label  for="inputNumero">Número</label>
                        <input required type="text" name="inputNumero" id="inputAno" style="width:80px;" value="{$oInformativo->iNumero}" />
                        <br/><br/>
                        
                        <label  for="inputAno">Ano</label>
                        <input required type="text" name="inputAno" id="inputAno" style="width:80px;" value="{$oInformativo->sAno}" />
                        <br/><br/>

                        <label>Miniatura</label> 
                        <div id="divMiniatura">
                            <img alt="Miniatura" style="max-height: 180px; max-width: 280px;" id="imgMiniatura" title="Minatura" src="{$WWW_IMG}fotosAlbuns/{$oInformativo->sCapa}" />
                            <input type="hidden" name="inputMiniaturaVazio" value="{$oInformativo->sCapa}" />
                        </div>
                        <br/>
                        
                        <label  for="inputCapa">Capa</label>
                        <input required type="file" name="inputCapa" style="width:300px;" />
                        <br/><br/>
                        
                        <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                        <a href="?pagina=centraldecontrole/informativo&acao=lista"  class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
             {/if}
        </div>
        <script type="text/javascript" src="{$WWW_JS}jquery.maskedinput.js"></script>
        <script type="text/javascript">
            
            $(document).ready(function(){  
                $(function(){  
                    $("#inputData").mask("99/99/9999");   
                });  
            });  
            
            function confirmaExcluir()
            {
                    var btnConfirm = confirm ( 'Deseja realmente excluir este Informativo?' );
                
                if ( btnConfirm )
                {
                    return true;
                }
                
                return false;
            }

            $("#inputMiniatura").change(function(){
                var imagem = $("#inputMiniatura").val();

                $("#imgMiniatura").attr("src", imagem);
            });
        </script>
    </body>
</html>