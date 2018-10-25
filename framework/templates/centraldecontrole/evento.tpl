{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/maskedinput/jquery.maskedinput.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(function(){    
            $("#horaDoEvento").mask("99:99");   
        });  
    });
    function confirmaExcluir()
    {
        var btnConfirm = confirm ( 'Deseja realmente excluir este Evento?' );
        
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
    <a class="btn btn-primary" href="?pagina=centraldecontrole/evento&acao=editar">
        <i class="fa fa-plus"></i> Novo Evento
    </a>
</div>
{if $sAcao == 'lista'}
    <div class="box box-default">
        <div class="box-header"></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Evento</th>
                        <th>Data</th>
                        <th>Descrição</th>
                        <th>Local</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjEvento as $oEvento}
                        <tr>
                            <td>
                                {$oEvento->sTitulo}
                            </td>
                            <td>
                                {$oEvento->sData|date_format:'%d/%m/%Y'}
                            </td>
                            <td>
                                {$oEvento->sDescricao|truncate:100}
                            </td>
                            <td>
                                {$oEvento->sLocal}
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/evento&acao=editar&codigo={$oEvento->iCodigo}" title="Editar Evento">
                                    <i class="fa fa-pencil text-primary" style="font-size: 19px; color: blue"></i>
                                </a>
                                <a href="?pagina=centraldecontrole/Evento&excluir&codigo={$oEvento->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                    <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                </a>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="5">
                                Nenhuma Evento
                            </td>
                        </tr>
        
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
{elseif $sAcao == 'editar'}
    <form action="?pagina=centraldecontrole/evento&acao=lista" method="post" >
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="col-xs-12">
                    <div class="form-group">
                        <input name="inputCodigo" type="hidden" value="{$oEvento->iCodigo}" />
                        <label  for="inputTitulo">Titulo</label>
                        <input required class="form-control" type="text" name="inputTitulo" value="{$oEvento->sTitulo}">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label  for="inputDescricao">Descrição</label>
                        <input required class="form-control" type="text" name="inputDescricao" value="{$oEvento->sDescricao}">
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="form-group">
                        <label  for="inputLocal">Local</label>
                        <input required class="form-control" type="text" name="inputLocal" value="{$oEvento->sLocal}">
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label  for="inputLocal">Link do Artigo</label>
                        <select class='form-control' name="inputLink">
                            {foreach $arrObjArtigo as $oArtigo}
                                <option value="{$oArtigo->sLink}" {if $oArtigo->sLink == $oEvento->sLink}selected{/if}>{$oArtigo->sTitulo}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        <label  for="inputData">Data</label>
                        <input required class="form-control" type="date" id="dataDoEvento" name="inputData" value="{$oEvento->sData|date_format:'%Y-%m-%d'}">
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                <a href="?pagina=centraldecontrole/evento&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
            </div>
        </div>
    </form>
{/if}
{/block}