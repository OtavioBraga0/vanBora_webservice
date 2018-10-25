{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/maskedinput/jquery.maskedinput.js"></script>
<script type="text/javascript">
function confirmaExcluir() {
    var btnConfirm = confirm('Deseja realmente excluir este Arte?');

    if (btnConfirm) {
        return true;
    }

    return false;
}
$("#inputMiniatura").change(function(){
    var imagem = $("#inputMiniatura").val();

    $("#imgMiniatura").attr("src", imagem);
});
</script>
{/block}

{block name='body'}
<div class="page-header">
    <a class="btn btn-primary" href="?pagina=centraldecontrole/arte&acao=editar">
        <i class="icon-plus-sign icon-white"></i> Novo Arte
    </a>
</div>
{if $sAcao == 'lista'}
<div class="box box-default">
    <div class="box-header"></div>
    <div class="box-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Arte</th>
                    <th>Entrada</th>
                    <th>Saida</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                {foreach $arrObjArte as $oArte}
                <tr>
                    <td>
                        <a href="?pagina=centraldecontrole/arte&acao=editar&codigo={$oArte->iCodigo}" title="Editar Arte">{$oArte->sTitulo}</a>
                    </td>
                    <td>
                        <label>{$oArte->sEntrada|date_format:'%d/%m/%Y'}</label>
                    </td>
                    <td>
                        <label>{$oArte->sSaida|date_format:'%d/%m/%Y'}</label>
                    </td>
                    <td class="text-center">
                        <a href="?pagina=centraldecontrole/arte&excluir&codigo={$oArte->iCodigo}" onclick="return confirmaExcluir()" title="Excluir">
                            <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                        </a>
                    </td>
                </tr>
                {foreachelse}
                <tr>
                    <td colspan="4">
                        Nenhuma Arte
                    </td>
                </tr>
    
                {/foreach}
            </tbody>
        </table>
    </div>
    <div class="box-footer"></div>
</div>
{elseif $sAcao == 'editar'}
<form action="?pagina=centraldecontrole/arte&acao=lista" method="post" enctype="multipart/form-data">
    <div class="box box-default">
        <div class="box-header"></div>
        <div class="box-body">
            <div class="form-group">
                <input required name="inputCodigo" type="hidden" value="{$oArte->iCodigo}" />
                <label  for="inputTitulo">Titulo</label>
                <input class='form-control' required type="text" name="inputTitulo" value="{$oArte->sTitulo}">
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Miniatura</label>
                    <div id="divMiniatura">
                        <img class='img-responsive' alt="Miniatura" style="max-height: 180px; max-width: 280px;" id="imgMiniatura" title="Minatura" src="{$WWW_IMG}fotosAlbuns/{$oArte->sUrlImagem}"/>
                        <input type="hidden" name="inputMiniaturaVazio" value="{$oArte->sUrlImagem}" />
                    </div>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label>Capa</label> 
                    <input class='form-control' required type="file" id="inputMiniatura" name="inputMiniatura"/>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label  for="inputEntrada">Entrada</label>
                    <input class='form-control' required type="date" id="dataEntrada" name="inputEntrada" value="{$oArte->sEntrada}">
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label  for="inputSaida">Saida</label>
                    <input class='form-control' required type="date" id="dataSaida" name="inputSaida" value="{$oArte->sSaida}">
                </div>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
            <a href="?pagina=centraldecontrole/arte&acao=lista" class="btn btn-danger pull-right">Cancelar</a>
        </div>
    </div>
</form>
{/if}
{/block}