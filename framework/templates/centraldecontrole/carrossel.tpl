{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/maskedinput/jquery.maskedinput.js"></script>
<script type="text/javascript">
    $(function(){    
        $(".hora").mask("99:99");  
    });  

    function confirmaExcluir()
    {
        var btnConfirm = confirm ( 'Deseja realmente excluir este Carrossel?' );
        
        if ( btnConfirm )
        {
            return true;
        }
        
        return false;
    }
</script>
{/block}

{block name='body'}
<div class="page-header">
    <a class="btn btn-primary" href="?pagina=centraldecontrole/carrossel&acao=editar">
        <i class="fa fa-plus"></i> Novo Carrossel
    </a>
</div>
{if $sAcao == 'lista'}
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-default">
                <div class="box-header"></div>
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $arrObjCarrossel as $oCarrossel}
                                <tr>
                                    <td>
                                        {$oCarrossel->sDescricao}
                                    </td>
                                    <td class="text-center">
                                        <a href="?pagina=centraldecontrole/carrossel&acao=editar&codigo={$oCarrossel->iCodigo}" title="Editar carrossel">
                                            <i class="fa fa-pencil text-primary" style="font-size: 19px; color: blue"></i>
                                        </a>
                                        <a href="?pagina=centraldecontrole/carrossel&excluir&codigo={$oCarrossel->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                            <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                        </a>
                                    </td>
                                </tr>
                            {foreachelse}
                                <tr>
                                    <td colspan="2">
                                        Nenhum Carrossel
                                    </td>
                                </tr>
            
                            {/foreach}
                        </tbody>
                    </table>
                </div>
                <div class="box-footer"></div>
            </div>
        </div>
    </div>
{elseif $sAcao == 'editar'}
    <form action="?pagina=centraldecontrole/carrossel&acao=lista" method="post" enctype="multipart/form-data">
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input name="inputCodigo" type="hidden" value="{$oCarrossel->iCodigo}" />
                        <label  for="inputDescricao">Título</label>
                        <input class='form-control' required type="text" name="inputDescricao" maxlength="250"  value="{$oCarrossel->sDescricao}" />
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label  for="inputImagemUrl">Imagem do Carrossel</label>
                            {if $oCarrossel->sImagemUrl == ''}
                                <input class='form-control' required type="file" name="inputCarrossel"  accept="image/x-png, image/gif, image/jpeg" />
                        </div>
                            {else}
                                <input type="hidden" name="inputCarrosselHidden"  value="{$oCarrossel->sImagemUrl}" />
                                <img class="img-responsive pad" src="{$WWW_IMG}banner/{$oCarrossel->sImagemUrl}"/>
                        </div>
                                <div class="col-xs-6">
                                    <label  for="inputImagemUrl">Nova Imagem</label>
                                    <input class='form-control' required type="file" name="inputCarrossel"  accept="image/x-png, image/gif, image/jpeg" />
                                </div>
                            {/if}

                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">  
                        <label  for="inputLink">Link</label>
                        <input required class='form-control' type="text" name="inputLink"  value="{$oCarrossel->sLink}" />          
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label  for="inputLinkExterno">Abrir link externamente?</label>
                        <select required class="inputLinkExterno form-control" name="inputLinkExterno" style="width:80px;">
                            <option value=1 {if $oCarrossel->bLinkExterno == 1}selected{/if}>Sim</option>
                            <option value=0 {if $oCarrossel->bLinkExterno == 0}selected{/if}>Não</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Data e hora de entrada</label>
                        <div class="form-flex-between">
                            <input required type="date" class="data form-control" name="inputEntradaData" id="inputEntradaData" maxlength="20" value="{if ($oCarrossel->sEntrada !== null) && ($oCarrossel->sEntrada !== "")}{$oCarrossel->sEntrada|date_format:"%Y-%m-%d"}{/if}"/>
                            <input required type="text" class="hora form-control" name="inputEntradaHora" id="inputEntradaHora" maxlength="20" value="{if ($oCarrossel->sEntrada !== null) && ($oCarrossel->sEntrada !== "")}{$oCarrossel->sEntrada|date_format:"%H:%M"}{/if}"/>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Data e hora de saída</label>
                        <div class="form-flex-between">
                            <input required type="date" class="data form-control" name="inputExpiracaoData" id="inputExpiracaoData" maxlength="20" value="{if ($oCarrossel->sExpiracao !== null) && ($oCarrossel->sExpiracao !== "")}{$oCarrossel->sExpiracao|date_format:"%Y-%m-%d"}{/if}"/>
                            <input required type="text" class="hora form-control" name="inputExpiracaoHora" id="inputExpiracaoHora" maxlength="20" value="{if ($oCarrossel->sExpiracao !== null) && ($oCarrossel->sExpiracao !== "")}{$oCarrossel->sExpiracao|date_format:"%H:%M"}{/if}"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                <a href="?pagina=centraldecontrole/carrossel&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
            </div>
        </div>
    </form>
{/if}
{/block}