{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript">
    function confirmaExcluir()
    {
        var btnConfirm = confirm ( 'Deseja realmente excluir esta Tipo?' );
        
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
    <a class="btn btn-primary" href="?pagina=centraldecontrole/album_tipo&acao=editar">
        <i class="fa fa-plus"></i> Novo Tipo
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
                    {foreach $arrObjAlbumTipo as $oAlbumTipo}
                        <tr>
                            <td>
                                <a href="?pagina=centraldecontrole/album_tipo&acao=editar&codigo={$oAlbumTipo->iCodigo}" title="Editar tipo">{$oAlbumTipo->sDescricao}</a>
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/album_tipo&excluir&codigo={$oAlbumTipo->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
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
    <form action="?pagina=centraldecontrole/album_tipo&acao=lista" method="post" >
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="form-group">
                    <input name="inputCodigo" type="hidden" value="{$oAlbumTipo->iCodigo}" />
                    <label  for="inputDescricao">Descrição</label>
                    <input class='form-control' name="inputDescricao"  type="text" value="{$oAlbumTipo->sDescricao}" />
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                <a href="?pagina=centraldecontrole/album_tipo&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
            </div>
        </div>
    </form>
{/if}

{/block}