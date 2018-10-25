{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
    <script src="{$WWW_JS}centraldecontrole/tinymce/tinymce.min.js"></script>
    <script src="{$WWW_JS}centraldecontrole/tinymce/jquery.tinymce.min.js"></script>
    <script src="{$WWW_JS}centraldecontrole/tinymce/langs/pt_BR.js"></script>
    <script>
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
        <div class="box box-default">
            <div class="box-header"></div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Sessao</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        {foreach $arrObjSessao as $oSessao}
                            <tr>
                                <td>
                                    {$oSessao->sTitulo}
                                </td>
                                <td class="text-center">
                                    <a href="?pagina=centraldecontrole/sessao&acao=editar&codigo={$oSessao->iCodigo}" onclick="return confirmaExcluir()" title="Excluir" >
                                        <i class="fa fa-pencil text-primary" style="font-size: 19px; color: blue"></i>
                                    </a>
                                </td>
                            </tr>
                        {foreachelse}
                            <tr>
                                <td colspan="5">
                                    Nenhuma Sessão
                                </td>
                            </tr>
        
                        {/foreach}
                    </tbody>
                </table>
            </div>
            <div class="box-footer"></div>
        </div>    
    {elseif $sAcao == 'editar'}
        <form action="?pagina=centraldecontrole/sessao&acao=lista" method="post" >
            <div class="box box-default">
                <div class="box-header"></div>
                <div class="box-body">
                    <div class="form-group">
                        <legend>{$oSessao->sTitulo}</legend>
                        <input name="inputCodigo" type="hidden" value="{$oSessao->iCodigo}" />
                        <input name="inputTitulo" class='form-control' type="hidden" value="{$oSessao->sTitulo}" />
                    </div>
                    <div class="form-group">
                        <label  for="inputConteudo">Conteúdo</label>
                        <textarea class="inputConteudo" name="inputConteudo">{$oSessao->sConteudo}</textarea>                        
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" name="inputSalvar" class="btn btn-success">Salvar</button>
                    <a href="?pagina=centraldecontrole/sessao&acao=lista"  class="btn btn-danger pull-right">Cancelar</a>
                </div>
            </div>
        </form>
    {/if}
{/block}