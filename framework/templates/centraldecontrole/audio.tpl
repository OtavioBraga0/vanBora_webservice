{extends  file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript">
    function confirmaExcluir()
    {
        var btnConfirm = confirm ( 'Deseja realmente excluir este Áudio?' );
        
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
    <a class="btn btn-primary" href="?pagina=centraldecontrole/audio&acao=editar">
        <i class="fa fa-plus"></i> Novo Áudio
    </a>
</div>
{if $sAcao == 'lista'}
    <div class="box box-default">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Audio</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjAudio as $oAudio}
                        <tr>
                            <td>
                                {$oAudio->sDescricao}
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/audio&acao=editar&codigo={$oAudio->iCodigo}" title="Editar audio">
                                    <i class="fa fa-pencil" style="font-size: 19px; color: blue"></i>
                                </a>
                                <a href="?pagina=centraldecontrole/audio&excluir&codigo={$oAudio->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                    <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                </a>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="2">
                                Nenhum Áudio
                            </td>
                        </tr>
        
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
{elseif $sAcao == 'editar'}
    <form action="?pagina=centraldecontrole/audio&acao=lista" method="post" enctype="multipart/form-data">
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input name="inputCodigo" type="hidden" value="{$oAudio->iCodigo}" />
                            <label  for="inputDescricao">Descrição</label>
                            <input class='form-control' required type="text" name="inputDescricao" style="width:300px;"  value="{$oAudio->sDescricao}" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label  for="inputTipo">Tipo</label>
                            <select class='form-control' required name="inputTipo">
                                <option value="-">-</option>
                                {foreach $arrObjAudioTipo as $oAudioTipo}
                                    <option value="{$oAudioTipo->iCodigo}" {if ($oAudio->oAudioTipo !== null) && ($oAudio->oAudioTipo->iCodigo == $oAudioTipo->iCodigo)}selected{/if}>{$oAudioTipo->sDescricao}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    {if $oAudio->sUrl <> ''}
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label  for="inputUrl">Áudio</label>
                                <input class='form-control' required type="text" name="inputAudioText" readonly accept="audio/x-mpeg" value="{$oAudio->sUrl}"/>        
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label  for="inputUrl">Alterar Áudio</label>
                                <input class='form-control' type="file" name="inputAudio" accept="audio/x-mpeg"/>
                            </div>
                        </div>
                    {else}
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label  for="inputUrl">Áudio</label>
                                <input required class='form-control' type="file" name="inputAudio" accept="audio/x-mpeg"/>
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                <a href="?pagina=centraldecontrole/audio&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
            </div>
        </div>
    </form>
{/if}
{/block}