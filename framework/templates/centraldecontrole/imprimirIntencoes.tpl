{extends file='centraldecontrole/_layout.tpl'}

{block name='css'}
    <link rel="stylesheet" href="{$WWW_CSS}centraldecontrole/report/report.css" type="text/css" media="screen" charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="{$WWW_CSS}centraldecontrole/report/reportPrint.css" media="print" />
{/block}

{block name='body'}
<form action="?pagina=centraldecontrole/imprimirIntencoes" method="post" class="form-inline">
    <div class="box box-default">
        <div class="box-header"></div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row form-flex">
                        <div class="col-xs-5">
                            <div class="form-group">
                                <label>Data</label>
                                <div class="form-flex-between">
                                    <input type="date" class="form-control" name="inputDataInicial" id="inputDataInicial" value="{$sDataInicial}" /> à
                                    <input type="date" class="form-control" name="inputDataFinal" id="inputDataFinal" value="{$sDataFinal}"/> 
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group" style="flex-grow: .5">
                                <label for=""></label>
                                <input name="exibirPedidosVela" {if $sExibirPedidosVela == true}checked{/if} type="checkbox"> Exibir pedidos da vela virtual
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group" style="">
                                <button type="submit" class="btn btn-default" name="inputFiltrar" id="inputFiltrar">
                                    <i class="fa fa-filter"></i> Filtrar
                                </button> 
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="box-footer">
            {if isset($smarty.post.inputFiltrar) && (count($arrObjPedido) > 0)}
                <a class="btn btn-primary" href='javascript:window.print();'>
                    <i class="fa fa-print"></i> Imprimir
                </a>    
                <button class="btn btn-primary" type="submit" name="inputGerarRelatorioPublico">
                    <i class="fa fa-eye"></i> Gerar relatório público
                </button>
            {/if}
        </div>
    </div>
</form>
<div class="box box-default pagina-size">
    <div class="box-header"></div>
    <div class="box-body">
        <div class="boxBody" >
            {if $sExibeRelatorio==true}
                <div class="boxTop" style="float:left">
                <img src="{$WWW_IMG}topo/logo-site.png" alt="{$sNomeSite}" title="{$sNomeSite}"  style="max-width:180px;max-height:60px;"/>
                </div>
                <div class="boxTop cabecalho" style="float:left;width:450px;margin-left:20px;">
                    <h1>Relatório de Pedidos de oração</h1>
                </div>  
                <div class="boxTop left" style="float:left;width:50px;height:80px">
                    <span></span>
                    <p class="tright">{$smarty.now|date_format:"d/m/Y"}</p>
                </div>
                <br class="clear"/>
                <div style="width:100%;float:left">
                    {foreach $arrObjPedido as $oPedido}
                        <ul>
                            <li><b>Nome: </b>{$oPedido->sNome}</li>
                                                        <li><b>E-mail: </b>{$oPedido->sEmail}</li>
                            <li><b>Cidade/Estado: </b>{$oPedido->sCidade}-{$oPedido->sEstado}<br/></li> 
                            <li><b>Data do Pedido: </b>{$oPedido->sData|date_format:"d/m/Y"}<br/></li>
                            <li><b>Pedido: </b>{$oPedido->sIntencao}<br/></li>
                        </ul>
                    {foreachelse}
                        <p>Nenhum colaborador Encontrado</p>
                    {/foreach}
                </div>
            {/if}
            <br class="clear" />
        </div>
    </div>
    <div class="box-footer"></div>
</div>
{/block}