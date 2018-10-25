<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/>
        <div class="container">
            <br/><br/>
            <h4>Responder Pedidos de oração e Testemunhos</h4>
            <br/>
            {if $sAcao == 'lista'}
                <form action="?pagina=centraldecontrole/aprovarPedidos" method="post" >
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>
                                    Responder
                                </th>
                                <th>
                                    Excluir
                                </th>
                                <th>
                                    Nome
                                </th>
                                <th>
                                    Descrição
                                </th>
                                <th>
                                    Tipo
                                </th>
                                <th>
                                    Data
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach $arrObjPedido as $oPedido}
                                <tr>
                                    <td style="text-align:center">
                                        <a href="?pagina=centraldecontrole/responderPedidos&acao=editar&codigo={$oPedido->iCodigo}">
                                            <img style="" src="{$WWW_IMG}centraldecontrole/responder.png" title="Responder" alt="Responder"/>
                                        </a>
                                    </td>
                                    <td style="text-align:center">
                                        <a href="?pagina=centraldecontrole/responderPedidos&excluir&codigo={$oPedido->iCodigo}" onclick="return confirmaExcluir()">
                                            <img style="" src="{$WWW_IMG}galeria/delete.png" title="Excluir" alt="Excluir"/>
                                        </a>
                                    </td>
                                    <td>{$oPedido->sNome}</td>
                                    <td>{$oPedido->sIntencao}<br/></td>
                                    <td>{if ($oPedido->sTipo == 'T')}Testemunho{elseif ($oPedido->sTipo == 'P')}Pedido de oração{/if}<br/></td> 
                                    <td>{$oPedido->sData|date_format:"d/m/Y"}<br/></td>
                                </tr>
                            {foreachelse}
                                <tr>
                                    <td colspan="6">Nenhum resultado encontrado.</td>
                                </tr>
                            {/foreach}
                        </tbody> 
                    </table>
                </form>   
            {else}
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>
                                Nome
                            </th>
                            <th>
                                Descrição
                            </th>
                            <th>
                                Tipo
                            </th>
                            <th>
                                E-mail
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{$oPedido->sNome}</td>
                            <td>{$oPedido->sIntencao}<br/></td>
                            <td>{if ($oPedido->sTipo == 'T')}Testemunho{elseif ($oPedido->sTipo == 'P')}Pedido de oração{/if}</td> 
                            <td>{$oPedido->sEmail}</td>
                        </tr>
                    </tbody> 
                </table>
                <br/>
                <form action="?pagina=centraldecontrole/responderPedidos&acao=lista" method="post" enctype="multipart/form-data">
                    <input name="inputCodigo" type="hidden" value="{$oPedido->iCodigo}" />

                    <label>Resposta</label>
                    <textarea name="inputResposta" style="width:800px;height:150px;">{if ($oPedido->sTipo == 'T')}{$oParametro->sRespostaTestemunho}{elseif ($oPedido->sTipo == 'P')}{$oParametro->sRespostaPedidoOracao}{/if}</textarea>
                    <br/><br/>

                    <input type="submit" name="inputEnviarResposta" class="btn btn-primary btnSalvar" value="Enviar"/>
                    <a href="?pagina=centraldecontrole/responderPedidos&acao=lista"  class="btn btn-danger">Cancelar</a>
                    <br/><br/>
                </form>
            {/if}
        </div>
        <script type="text/javascript">
            $("#inputSelecionarTodos").click(function() {
                if ($("#inputSelecionarTodos").is(':checked')) {
                    $(".table input[type=checkbox]").each(function() {
                        $(this).prop("checked", true);
                    });

                } else {
                    $(".table input[type=checkbox]").each(function() {
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
    </body>
</html>