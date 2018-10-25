<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/>
        <div class="container">
            <div class="page-header">
                <a class="btn btn-primary" href="?pagina=centraldecontrole/video&acao=editar">
                    <i class="icon-plus-sign icon-white"></i> Novo Vídeo
                </a>
            </div>
            {if $sAcao == 'lista'}
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Vídeo</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjVideo as $oVideo}
                            <tr>
                                <td>
                                    <a href="?pagina=centraldecontrole/video&acao=editar&codigo={$oVideo->iCodigo}" title="Editar video">{$oVideo->sDescricao}</a>
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/video&excluir&codigo={$oVideo->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="2">
                                    Nenhum Vídeo
                                </td>
                            </tr>

                        {/foreach}
                    </tbody>
                </table>
             {elseif $sAcao == 'editar'}
                <form action="?pagina=centraldecontrole/video&acao=lista" method="post" >
                    <div class="form-group">
                        <input name="inputCodigo" type="hidden" value="{$oVideo->iCodigo}" />
                        <label  for="inputDescricao">Descrição</label>
                        <input required name="inputDescricao" type="text" style="width:300px;"  value="{$oVideo->sDescricao}" />
                        <br/><br/>
                        <label  for="inputLink">Link</label>
                        <input required name="inputLink" type="text" style="width:300px;" value="{$oVideo->sLink}" />
                        
                        <br/><br/>
                        <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                        <a href="?pagina=centraldecontrole/video&acao=lista"  class="btn btn-danger">Cancelar</a>
                    </div>
                </form>
             {/if}
        </div>
        <script type="text/javascript">
            function confirmaExcluir()
            {
                var btnConfirm = confirm ( 'Deseja realmente excluir este Vídeo?' );
                
                if ( btnConfirm )
                {
                    return true;
                }
                
                return false;
            }
        </script>
    </body>
</html>