{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script type="text/javascript">	       
    $("#inputSelecionarTodos").click(function () {
        if ($("#inputSelecionarTodos").is(':checked')) {
            $(".table input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });
    
        } else {
            $(".table input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    function confirmaExcluir()
    {
        var btnConfirm = confirm ( 'Deseja realmente excluir?' );
        
        if ( btnConfirm )
        {
            return true;
        }
        
        return false;
    }
</script>
{/block}

{block name='body'}
<form action="?pagina=centraldecontrole/aprovarPedidos" method="post" >
    <div class="box primary">
        <div class="box-header">
            <div class="checkbox form-flex">
                <div class="col-xs-3">
                    <input name="inputSelecionarTodos" id="inputSelecionarTodos" type="checkbox"/> Selecionar todos
                </div>
                <div class="col-xs-3">
                    <button type="submit" class="btn btn-success" name="inputAprovar" id="inputAprovar">Aprovar selecionados</button>
                </div>
                <div class="col-xs-3">
                    <button type="submit" class="btn btn-danger" name="inputExcluir" id="inputExcluir">Excluir selecionados</button> 
                </div>
            </div>
        </div>
        <div class="box-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            
                        </th>
                        <th>
                            Nome(E-mail)
                        </th>
                        <th>
                            Intenção
                        </th>
                        <th>
                            Cidade
                        </th>
                        <th>
                            Data
                        </th>
                        <th>
                            Tipo
                        </th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjPedido as $oPedido}
                        <tr>
                            <td><input type="checkbox" name="inputPedido[]" value="{$oPedido->iCodigo}"/></td>
                            <td>{$oPedido->sNome}({$oPedido->sEmail})</td>
                            <td>{$oPedido->sIntencao}</td>
                            <td>{$oPedido->sCidade}-{$oPedido->sEstado}</td> 
                            <td>{$oPedido->sData|date_format:"d/m/Y"}</td>
                            <td>{if ($oPedido->sTipo == 'T')}Testemunho{elseif ($oPedido->sTipo == 'V')}Vela virtual{/if}</td>
                        </tr>
                    {foreachelse}
                         <tr>
                             <td colspan="7">Nenhum resultado encontrado.</td>
                        </tr>
                    {/foreach}
                </tbody> 
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
</form>   

{/block}