{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript">
    function confirmaExcluir()
    {
        var btnConfirm = confirm ( 'Deseja realmente excluir este Tipo?' );
        
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
    <a class="btn btn-primary" href="?pagina=centraldecontrole/audio_tipo&acao=editar">
        <i class="icon-plus-sign icon-white"></i> Novo Tipo
    </a>
</div>
{if $sAcao == 'lista'}
    <div class="box box-default">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjAudioTipo as $oAudioTipo}
                        <tr>
                            <td>
                                {$oAudioTipo->sDescricao}
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/audio_tipo&acao=editar&codigo={$oAudioTipo->iCodigo}" title="Editar tipo">
                                    <i class="fa fa-pencil" style="font-size: 19px; color: blue"></i>
                                </a>
                                <a href="?pagina=centraldecontrole/audio_tipo&excluir&codigo={$oAudioTipo->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                    <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                </a>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="2">
                                Nenhum Tipo
                            </td>
                        </tr>
        
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
 {elseif $sAcao == 'editar'}
    <form action="?pagina=centraldecontrole/audio_tipo&acao=lista" method="post" >
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="form-group">
                    <input name="inputCodigo" type="hidden" value="{$oAudioTipo->iCodigo}" />
                    <label  for="inputDescricao">Descrição</label>
                    <input name="inputDescricao" class="form-control" type="text" value="{$oAudioTipo->sDescricao}" />
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                <a href="?pagina=centraldecontrole/audio_tipo&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
            </div>
        </div>
    </form>
 {/if}
{/block}