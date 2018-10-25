{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript">
    function confirmaExcluir()
    {
        var btnConfirm = confirm ( 'Deseja realmente excluir esta Tag?' );
        
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
    <a class="btn btn-primary" href="?pagina=centraldecontrole/tag&acao=editar">
        <i class="fa fa-plus"></i> Nova Tag
    </a>
</div>
{if $sAcao == 'lista'}
    <div class="box box-primary">
        <div class="box-header"><h3>Tags do Sistema</h3></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tag</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjTagSistema as $oTag}
                        <tr>
                            <td>
                                {$oTag->sDescricao}
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/tag&acao=editar&codigo={$oTag->iCodigo}" title="Editar tag">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
    <div class="box box-default">
        <div class="box-header"><h3>Tags Gerais</h3></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tag</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjTag as $oTag}
                        <tr>
                            <td>
                                {$oTag->sDescricao}
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/tag&acao=editar&codigo={$oTag->iCodigo}" title="Editar tag">
                                    <i class="fa fa-pencil text-primary" style="font-size: 19px; color: blue"></i>
                                </a>
                                <a href="?pagina=centraldecontrole/tag&excluir&codigo={$oTag->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                    <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
{elseif $sAcao == 'editar'}
    <form action="?pagina=centraldecontrole/tag&acao=lista" method="post" >
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input name="inputCodigo" type="hidden" value="{$oTag->iCodigo}" />
                            <label  for="inputDescricao">Descrição</label>
                            <input class='form-control' required name="inputDescricao"  type="text" value="{$oTag->sDescricao}" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <label>Tipo</label>
                        <select class="form-control" name="inputTipo">
                            <option value="sistema">Sistema</option>
                            <option value="geral">Geral</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                <a href="?pagina=centraldecontrole/tag&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
            </div>
        </div>
    </form>
{/if}

{/block}