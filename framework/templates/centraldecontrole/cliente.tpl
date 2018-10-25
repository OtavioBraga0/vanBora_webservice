{extends file='centraldecontrole/_layout.tpl'}

{block name='body'}
    {if $sAcao == 'lista'}
        <div class="page-header">
            <a class="btn btn-primary" href="?pagina=centraldecontrole/cliente&acao=editar">
                <i class="fa fa-plus"></i> Novo Cliente
            </a>
        </div>
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjCliente as $oCliente}
                            <tr>
                                <td>
                                    {$oCliente->sNome}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/cliente&acao=editar&codigo={$oCliente->iCodigo}" title="Excluir" >
                                        <i class="fa fa-pencil text-primary" style="font-size: 19px; color: blue"></i>
                                    </a>
                                    <a href="?pagina=centraldecontrole/cliente&excluir&codigo={$oCliente->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="5">
                                    Nenhum Cliente
                                </td>
                            </tr>
        
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="box-footer"></div>
        </div>
    {elseif $sAcao == 'editar'}
        <form action="?pagina=centraldecontrole/cliente&acao=lista" method="post" enctype="multipart/form-data">
            <div class="box box-default">
                <div class="box-header"></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <input name="inputCodigo" type="hidden" value="{$oCliente->iCodigo}" />
                                <label  for="inputNome">Nome</label>
                                <input type="text" class="inputNome form-control" name="inputNome" value="{$oCliente->sNome}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Miniatura</label> 
                                <div id="divMiniatura" style="background-color: black">
                                    <img alt="Miniatura" id="imgMiniatura" class="img-responsive" style="margin: 0 auto" title="Minatura" src="{$WWW_IMG}cliente/{$oCliente->sUrlImagem}" />
                                    <input type="hidden" name="inputMiniaturaVazio" value="{$oCliente->sUrlImagem}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label  for="inputImagem">Imagem</label>
                                <input type="file" name="inputImagem" class="form-control"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                    <a href="?pagina=centraldecontrole/cliente&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
                </div>
            </div>
        </form>
    {/if}
{/block}