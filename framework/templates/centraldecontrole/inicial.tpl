{extends file='centraldecontrole/_layout.tpl'}

{block name="js"}
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.4&appId=865104380211119";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript">

        function confirmaExcluir() {
            var btnConfirm = confirm('Deseja realmente excluir esta Postagem?');

            if (btnConfirm) {
                return true;
            }

            return false;
        }
    </script>
{/block}

{block name="body"}
    <div class="box box-default">
        <div class="box-body">
            {if $smarty.session.PERMISSOES.ADICIONAR_ARTIGO == 'S'}
            <div class="page-header form-flex">
                {foreach $arrObjArtigoTipo as $oArtigoTipo} {if ($oArtigoTipo->iCodigo <> 4) && ($oArtigoTipo->iCodigo <> 5)}
                    <a class="btn btn-primary" href="?pagina=centraldecontrole/publicar_artigo&tipo={$oArtigoTipo->iCodigo}">
                        <i class="icon-plus-sign icon-white"></i> {$oArtigoTipo->sDescricao}
                    </a>
                {/if} {/foreach}
            </div>
            {else}
            <br/> {/if}
            <form action="?pagina=centraldecontrole/inicial" method="post">
                <div class="col-xs-12 form-flex">
                    <div class="col-xs-4 form-group">
                        <label>Descrição</label>
                        <input class='form-control' type="text" style="width:250px;" name="inputDescricao" id="inputDescricao" value="{$sDescricao}" />
                    </div>
                    <div class="col-xs-2 form-group">
                        <label for="inputTipo">Tipo</label>
                        <select name="inputTipo" class="form-control">
                            <option value="-">Todos</option>
                            {foreach $arrObjArtigoTipo as $oArtigoTipo} 
                            {if ($oArtigoTipo->iCodigo <> 4) && ($oArtigoTipo->iCodigo <> 5)}
                                    <option value="{$oArtigoTipo->iCodigo}" {if $iTipo== $oArtigoTipo->iCodigo} selected {/if} >{$oArtigoTipo->sDescricao}</option>
                            {/if} 
                            {/foreach}
                        </select>
                    </div>
                    <div class="col-xs-5 form-group">
                        <label>Data</label>
                        <div class="form-flex">
                            <input class='form-control' type="date" name="inputDataInicial" id="inputDataInicial" value="{$sDataInicial|date_format:'%Y-%m-%d'}" /> à
                            <input class='form-control' type="date" name="inputDataFinal" id="inputDataFinal" value="{$sDataFinal|date_format:'%Y-%m-%d'}" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default">Filtrar</button>
                </div>
    
            </form>
    
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Data</th>
                        <th>Agendado para:</th>
                        <th>Tipo</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjArtigo as $oArtigo}
                    <tr>
                        <td style="width:500px">
                            {$oArtigo->sTitulo}
                        </td>
                        <td>
                            {$oArtigo->oUsuario->sNome}
                        </td>
                        <td>
                            {$oArtigo->sDataCadastro|date_format:"%d/%m/%Y"}
                        </td>
                        <td>
                            {if ($oArtigo->sAgenda !== null) && ($oArtigo->sAgenda !== "")}{$oArtigo->sAgenda|date_format:"%d/%m/%Y"}{else}-{/if}
                        </td>
                        <td>
                            {$oArtigo->oArtigoTipo->sDescricao}
                        </td>
                        <td class="text-center">
                            <span class="fb-share-button" data-href="{$oArtigo->sLink}" data-layout="icon"></span>
                            <a href="?pagina=centraldecontrole/publicar_artigo&codigo={$oArtigo->iCodigo}" title="Editar artigo">
                                <i class="fa fa-pencil text-primary" style="font-size: 18px; color: blue"></i>
                            </a>
                            {if $smarty.session.PERMISSOES.EXCLUIR_ARTIGO == 'S'}
                            <a href="?pagina=centraldecontrole/excluir_artigo&codigo={$oArtigo->iCodigo}" title="Excluir" onclick="return confirmaExcluir();">
                                <i class="fa fa-times-circle text-danger" style="font-size: 18px; color: red"></i>
                            </a>
                            {else} - {/if}
                        </td>
                    </tr>
                    {foreachelse}
                    <tr>
                        <td colspan="6">
                            Nenhum resultado encontrado.
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    </div>
{/block}