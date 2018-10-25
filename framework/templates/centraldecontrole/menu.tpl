{extends file='centraldecontrole/_layout.tpl'}

{block name='css'}
    <link href="{$WWW_CSS}centraldecontrole/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; display: flex; justify-content: space-around }
        #sortable li { display: flex; align-items: center; margin: 0 3px 3px 3px; padding: 0.4em; padding-left: 1.5em; font-size: 1.0em; float:left;cursor:move }
        #sortable li span { position: absolute; margin-left: -1.3em; }
    </style>
{/block}

{block name='js'}
    <script src="{$WWW_JS}centraldecontrole/ui-lightness/jquery-ui-1.10.3.custom.min.js"></script>
    <script type="text/javascript">
        function confirmaExcluir()
        {
            
            var btnConfirm = confirm ( 'Deseja realmente excluir este Menu?' );
            
            if ( btnConfirm )
            {
                return true;
            }
            
            return false;
        }
        
        $('#btnSalvarOrdemMenu').click(function(){
        
            var arrPosicoesMenu = [];
            
            $( "#sortable li" ).each(function( index ) {
                arrPosicoesMenu[index] = $(this).attr('id');
            });
            
            $.ajax({
                type: "POST",
                url: "?pagina=centraldecontrole/ajax",
                data: { arrPosicoesMenu:arrPosicoesMenu, action:'salvarOrdemMenu' }
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
{/block}

{block name='body'}
    <div class="page-header">
        {if isset( $smarty.get.codigoMenuPai )}
            {if $oMenuAnterior->iCodigo <> ''} 
                Menu anterior : <a href="?pagina=centraldecontrole/menu&codigoMenuPai={$oMenuAnterior->iCodigo}">{$oMenuAnterior->sDescricao}</a>
            {/if}
            <h3>Menu pai : {$oMenuPai->sDescricao}</h3>
        {/if}
        <a class="btn btn-primary" href="?pagina=centraldecontrole/menu&acao=editar{if isset( $smarty.get.codigoMenuPai )}&codigoMenuPai={$smarty.get.codigoMenuPai}{/if}">
            <i class="fa fa-plus"></i> Novo Menu
        </a>
    </div>
    {if $sAcao == 'lista'}
        <div class="box box-default">
            <div class="box-header"><h4>Ordem do Menu</h4></div>
            <div class="box-body">
                <div class="row">
                    <div class="col-xs-12">
                        <ul id="sortable">
                            {foreach $arrObjMenu as $oMenu}
                                <li class="btn btn-default ui-state-default" id="{$oMenu->iCodigo}">
                                    <span class="fa fa-arrows"></span>
                                    {$oMenu->sDescricao}
                                </li>
                            {foreachelse}
                                <li>Nenhum Menu</li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <a class="btn btn-success" id="btnSalvarOrdemMenu">
                    <i class=""></i> Salvar ordem do menu
                </a>
            </div>
        </div>
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Ativo</th>
                            <th class="text-center">Ações</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjMenu as $oMenu}
                            <tr>
                                <td>
                                    {$oMenu->sDescricao}
                                </td>
                                <td>
                                    {if ($oMenu->sAtivo) == 'S'}Sim{else}Não{/if}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/menu&excluir&codigo={$oMenu->iCodigo}{if isset( $smarty.get.codigoMenuPai )}&codigoMenuPai={$smarty.get.codigoMenuPai}{/if}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                    <a href="?pagina=centraldecontrole/menu&acao=editar&codigo={$oMenu->iCodigo}{if isset( $smarty.get.codigoMenuPai )}&codigoMenuPai={$smarty.get.codigoMenuPai}{/if}" title="Editar menu">
                                        <i class="fa fa-pencil text-primary" style="font-size: 19px; color: blue"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="?pagina=centraldecontrole/menu&acao=lista&codigoMenuPai={$oMenu->iCodigo}" title="Submenus">Submenus</a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="2">
                                    Nenhum Menu
                                </td>
                            </tr>
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="box-footer"></div>
        </div>
    {elseif $sAcao == 'editar'}
        <form action="?pagina=centraldecontrole/menu&acao=lista{if isset( $smarty.get.codigoMenuPai )}&codigoMenuPai={$smarty.get.codigoMenuPai}{/if}" method="post" enctype="multipart/form-data">        
            <div class="box box-default">
                <div class="box-header"></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <input name="inputCodigo" type="hidden" value="{$oMenu->iCodigo}" />
                                <label for="inputDescricao">Descrição</label>
                                <input required class='form-control' type="text" name="inputDescricao" style="width:300px;"  value="{$oMenu->sDescricao}" />
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="inputLink">Link</label>
                                <!-- <input type="file" name="inputMenu"  style="width:300px;"  /> -->
                                <input class='form-control' type="text" name="inputLink"  style="width:300px;" value="{$oMenu->sLink}" />
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="inputLink">Ativo</label>
                                <select class='form-control' required class="inputAtivo" name="inputAtivo" style="width:80px;">
                                    <option value="S" {if $oMenu->sAtivo == 'S'}selected{/if}>Sim</option>
                                    <option value="N" {if $oMenu->sAtivo == 'N'}selected{/if}>Não</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                    <a class='btn btn-danger pull-right' href="?pagina=centraldecontrole/menu&acao=lista{if isset( $smarty.get.codigoMenuPai )}&codigoMenuPai={$smarty.get.codigoMenuPai}{/if}"  class="btn btn-danger">Cancelar</a>
                </div>
            </div>
        </form>
    {/if}
{/block}