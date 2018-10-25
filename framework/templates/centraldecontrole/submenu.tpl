<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        {include file="centraldecontrole/_header.tpl"}
        <link href="{$WWW_CSS}ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
        <script src="{$WWW_JS}jquery-ui-1.10.3.custom.min.js"></script>
        <style>
            #sortable { list-style-type: none; margin: 0; padding: 0; width: 60%; }
            #sortable li { margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.0em; height: 18px; float:left;cursor:move }
            #sortable li span { position: absolute; margin-left: -1.3em; }
        </style>
    </head>
    <body>
        {include file="centraldecontrole/_menu.tpl"}
        <br/><br/>
        <div class="container">
            <div class="page-header">
                <h4>Menu : {$oMenu->sDescricao} </h4>
                <a class="btn btn-primary" href="?pagina=centraldecontrole/submenu&acao=editar&menu={$oMenu->iCodigo}">
                    <i class="icon-plus-sign icon-white"></i> Novo Submenu
                </a>
            </div>
            {if $sAcao == 'lista'}
                <ul id="sortable">
                {foreach $arrObjSubmenu as $oSubmenu}
                    <li class="ui-state-default" id="{$oSubmenu->iCodigo}"><span class="ui-icon ui-icon-arrowthick-2-e-w"></span>{$oSubmenu->sDescricao}</li>
                {foreachelse}
                    <li>Nenhum Submenu</li>
                {/foreach}
                </ul>
                <br/><br/><br/>
                <a class="btn" id="btnSalvarOrdemSubmenu">
                    <i class=""></i> Salvar ordem do submenu
                </a>
                <br/><br/>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Submenu</th>
                            <th>Ativo</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjSubmenu as $oSubmenu}
                            <tr>
                                <td>
                                    <a href="?pagina=centraldecontrole/submenu&acao=editar&codigo={$oSubmenu->iCodigo}&menu={$oMenu->iCodigo}" title="Editar submenu">{$oSubmenu->sDescricao}</a>
                                </td>
                                <td>
                                    {if ($oSubmenu->sAtivo) == 'S'}Sim{else}Não{/if}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/submenu&excluir&codigo={$oSubmenu->iCodigo}&menu={$oMenu->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <img src="{$WWW_IMG}galeria/cross-circle.png" title="Excluir" style="width:19px;height:19px"/>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="3">
                                    Nenhum Submenu
                                </td>
                            </tr>

                        {/foreach}
                    </tbody>
                </table>
             {elseif $sAcao == 'editar'}
                <form action="?pagina=centraldecontrole/submenu&acao=lista&menu={$oMenu->iCodigo}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input name="inputCodigo" type="hidden" value="{$oSubmenu->iCodigo}" />
                        <label class="sr-only" for="inputDescricao">Descrição</label>
                        <input type="text" name="inputDescricao" style="width:300px;"  value="{$oSubmenu->sDescricao}" />

                        <br/><br/>
                        <label class="sr-only" for="inputLink">Link</label>
                        <!-- <input type="file" name="inputSubmenu"  style="width:300px;"  /> -->
                        <input type="text" name="inputLink"  style="width:300px;" value="{$oSubmenu->sLink}" />
                        
                        <br/><br/>
                        <label class="sr-only" for="inputLink">Ativo</label>
                        <select class="inputAtivo" name="inputAtivo" style="width:80px;">
                            <option value="S" {if $oSubmenu->sAtivo == 'S'}selected{/if}>Sim</option>
                            <option value="N" {if $oSubmenu->sAtivo == 'N'}selected{/if}>Não</option>
                        </select>
                        
                        <button type="submit" name="inputSalvar" class="btn btn-default">Salvar</button>
                    </div>
                </form>
             {/if}
        </div>
        <script type="text/javascript">
            function confirmaExcluir()
            {
                    var btnConfirm = confirm ( 'Deseja realmente excluir este Submenu?' );
                
                if ( btnConfirm )
                {
                    return true;
                }
                
                return false;
            }
            
            $('#btnSalvarOrdemSubmenu').click(function(){
            
                var arrPosicoesSubmenu = [];
                
                $( "#sortable li" ).each(function( index ) {
                    arrPosicoesSubmenu[index] = $(this).attr('id');
                });
                
                $.ajax({
                    type: "POST",
                    url: "?pagina=centraldecontrole/ajax",
                    data: { arrPosicoesSubmenu:arrPosicoesSubmenu, action:'salvarOrdemSubmenu' }
                })
                    .done(function( msg ) {
                    alert( "Salvo com sucesso!");
                });
            });
            
            $(function() {
                $( "#sortable" ).sortable();
                $( "#sortable" ).disableSelection();
            });
            
        </script>
    </body>
</html>