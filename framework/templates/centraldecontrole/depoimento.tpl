{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
    <script src="{$WWW_JS}centraldecontrole/tinymce/tinymce.min.js"></script>
    <script src="{$WWW_JS}centraldecontrole/tinymce/jquery.tinymce.min.js"></script>
    <script src="{$WWW_JS}centraldecontrole/tinymce/langs/pt_BR.js"></script>
    <script>
        $("#inputMiniatura").change(function(){
            var imagem = $("#inputMiniatura").val();

            $("#imgMiniatura").attr("src", imagem);
        });
        $(document).ready(function(){
            tinymce.init({
                selector: "textarea.inputConteudo",
                height: "250",
                plugins: [
                    "advlist autolink lists link image charmap print preview anchor",
                    "searchreplace visualblocks code fullscreen",
                    "insertdatetime media table contextmenu paste"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
            });
        });
    </script>
{/block}

{block name='body'}
    {if $sAcao == 'lista'}
        <div class="page-header">
            <a class="btn btn-primary" href="?pagina=centraldecontrole/depoimento&acao=editar">
                <i class="fa fa-plus"></i> Novo Depoimento
            </a>
        </div>
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Depoimento</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjDepoimento as $oDepoimento}
                            <tr>
                                <td>
                                    {$oDepoimento->sNome}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/depoimento&acao=editar&codigo={$oDepoimento->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-pencil text-primary" style="font-size: 19px; color: blue"></i>
                                    </a>
                                    <a href="?pagina=centraldecontrole/depoimento&excluir&codigo={$oDepoimento->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="5">
                                    Nenhum Depoimento
                                </td>
                            </tr>
    
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="box-footer"></div>
        </div>
    {elseif $sAcao == 'editar'}
        <form action="?pagina=centraldecontrole/depoimento&acao=lista" method="post" enctype="multipart/form-data">
            <div class="box box-default">
                <div class="box-header"></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <input name="inputCodigo" type="hidden" value="{$oDepoimento->iCodigo}" />
                                <label  for="inputNome">Nome</label>
                                <input type="text" class="inputNome form-control" name="inputNome" value="{$oDepoimento->sNome}" required>
                            </div> 
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="inputEmpresa">Empresa</label>
                                <input type="text" class="form-control inputEmpresa" name="inputEmpresa" value="{$oDepoimento->sEmpresa}" required>                      
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Miniatura</label> 
                                <div id="divMiniatura">
                                    <img alt="Miniatura" class="img-responsive" style="margin: 0 auto" id="imgMiniatura" title="Minatura" src="{$WWW_IMG}depoimento/{$oDepoimento->sUrlImagem}" />
                                    <input type="hidden" name="inputMiniaturaVazio" value="{$oDepoimento->sUrlImagem}" />
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label  for="inputCapa">Capa</label>
                                <input type="file" name="inputCapa" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label  for="inputConteudo">Conteúdo</label>
                                <textarea maxlength="200" class="inputConteudo" name="inputConteudo">{$oDepoimento->sConteudo}</textarea>                        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                    <a href="?pagina=centraldecontrole/depoimento&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
                </div>
            </div>
        </form>
    {/if}
{/block}