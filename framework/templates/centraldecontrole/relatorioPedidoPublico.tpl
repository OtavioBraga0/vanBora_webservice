<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/><br/><br/>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Data</th>
                        <th>Link Público</th>
                        <th class="text-center">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjRelatorio as $oRelatorio}
                        <tr>
                            <td>
                                {$oRelatorio->iCodigo}
                            </td>
                            <td>
                                {$oRelatorio->sData|date_format:"%d/%m/%Y %H:%M:%S"}
                            </td>
                            <td>
                                <a href="{$WWW}relatorio/pedido/{Util::encode($oRelatorio->iCodigo)}" target="_blank">{$WWW}relatorio/pedido/{Util::encode($oRelatorio->iCodigo)}</a>
                            </td>
                            <td class="text-center">
                                <a href="?pagina=centraldecontrole/relatorioPedidoPublico&excluir&codigo={$oRelatorio->iCodigo}" title="Excluir" onclick="return confirmaExcluir();" >
                                    <img src="{$WWW_IMG}galeria/cross-circle.png" title="Excluir" style="width:19px;height:19px"/>
                                </a>
                            </td>
                        </tr>
                    {foreachelse}
                        <tr>
                            <td colspan="4">
                                Nenhum resultado encontrado.
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        <script type="text/javascript" >
        
            function confirmaExcluir()
            {
                var btnConfirm = confirm ( 'Deseja realmente excluir este Relatório?' );
                
                if ( btnConfirm )
                {
                    return true;
                }
                
                return false;
            }
        </script>
    </body>
</html>