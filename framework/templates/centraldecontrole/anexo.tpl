{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript">

function confirmaExcluir()
{
    var btnConfirm = confirm ( 'Deseja realmente excluir este Anexo?' );
    
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
    <a class="btn btn-primary" href="?pagina=centraldecontrole/anexo&acao=editar">
        <i class="icon-plus-sign icon-white"></i> Novo Anexo
    </a>
</div>
{if $sAcao == 'lista'}
    <div class="box box-default">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Anexo</th>
                        <th>Link</th>
                        <th class="text-center">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjAnexo as $oAnexo}
                        <tr>
                            <td>
                                {$oAnexo->sTitulo}
                            </td>
                            <td>
                                <a href="{$WWW}{$oAnexo->sCaminho}" target="_blank">{$WWW}{$oAnexo->sCaminho|truncate:75}</a>
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/anexo&excluir&codigo={$oAnexo->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                    <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                </a>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="4">
                                Nenhum Anexo
                            </td>
                        </tr>
        
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
 {elseif $sAcao == 'editar'}
    <form action="?pagina=centraldecontrole/anexo&acao=lista" method="post" enctype="multipart/form-data">
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="col-xs-6">
                    <div class="form-group">
                        <label  for="inputTitulo">Título</label>
                        <input required type="text" class="form-control" name="inputTitulo" value="{$oAnexo->sTitulo}" />
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label  for="inputAnexo">Anexo</label>
                        <input required type="file" name="inputAnexo" class="form-control"/>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                <a href="?pagina=centraldecontrole/anexo&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
            </div>
        </div>
    </form>
 {/if}
{/block}