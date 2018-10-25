{extends file='centraldecontrole/_layout.tpl'}

{block name='js'}
<script src="{$WWW_JS}centraldecontrole/tinymce/tinymce.min.js"></script>
<script src="{$WWW_JS}centraldecontrole/maskedinput/jquery.maskedinput.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){  

        tinymce.init({
            selector: 'textarea.inputConteudo',
            height: 500,
            resize: false,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor textcolor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code help wordcount'
            ],
            toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        }); 

        $(function(){ 
            $('#inputHoraAgenda').mask('99:99');
        });  
        
        {if !isset($smarty.get.codigo)}
            $("#inputTitulo").keyup(function() {
                return verificaLinkIgual();
            });       
        {/if}
    }); 

    $("#inputMiniatura").change(function(){
        var imagem = $("#inputMiniatura").val();

        $("#imgMiniatura").attr("src", imagem);
    });
</script>
{/block}

{block name='body'}
<div class="box box-default">
    <form action="?pagina=centraldecontrole/publicar_artigo{if isset($smarty.get.tipo)}&tipo={$smarty.get.tipo}{/if}" method="post" enctype="multipart/form-data" >
        <fieldset>
            <div class="box-header">
                <legend>{$oArtigo->oArtigoTipo->sDescricao}</legend>
            </div>
            <div class="box-body">
                <input type="hidden" name="inputCodigo" value="{$oArtigo->iCodigo}" />
                <input type="hidden" name="inputTipo"   value="{$oArtigo->oArtigoTipo->iCodigo}" />
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="inputTitulo">Título</label>
                        <input required class="form-control" type="text" name="inputTitulo" id="inputTitulo" {if $oArtigo->oArtigoTipo->iCodigo == 9}maxlength="20"{else}maxlength="100"{/if} value="{$oArtigo->sTitulo}"/>
                    </div>
                </div>
                <div id="divMensagemTitulo"></div>
                {if $oArtigo->sLink <> ''}
                    <div class="col-xs-12">
                        <label>Link:</label><p>{$oArtigo->sLink}</p>
                        <input type="hidden" value="{$oArtigo->sLink}" name="inputLink"/>
                    </div>
                {/if}
                {if $oArtigo->oArtigoTipo->iCodigo <> 3}
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label>Resumo</label>
                            <textarea id='inputResumo' class='form-control' required name="inputResumo" maxlength="250">{$oArtigo->sResumo}</textarea>
                        </div>
                    </div>
                {/if}
                
                {if ($oArtigo->oArtigoTipo->iCodigo == 4) || ($oArtigo->oArtigoTipo->iCodigo == 5)}
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Data referente</label>
                            <input required class="form-control" type="date" id="dataDiaMes" name="inputData" maxlength="100" value="{$oArtigo->sDia}/{$oArtigo->sMes}"/>
                        </div>
                    </div>
                {/if}

                {if ($oArtigo->oArtigoTipo->iCodigo == 4)}
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label style="margin-left:15px;" >Ano</label>
                            <select class="form-control" required name="inputAno" >
                                <option value="A" {if $oArtigo->sAno == 'A'}selected{/if} >A</option>
                                <option value="B" {if $oArtigo->sAno == 'B'}selected{/if}>B</option>
                                <option value="C" {if $oArtigo->sAno == 'C'}selected{/if}>C</option>
                            </select>
                        </div>
                    </div>
                {/if}

                <div class="col-xs-12">
                    <div class="form-group">
                        <label>Conteúdo</label>
                        <textarea class="inputConteudo form-control" id='inputConteudo' name="inputConteudo">{$oArtigo->sConteudo}</textarea>
                    </div>
                </div>
                
                {if ($oArtigo->oArtigoTipo->iCodigo <> 4) && ($oArtigo->oArtigoTipo->iCodigo <> 5)}
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Miniatura</label> 
                            <div id="divMiniatura">
                                <img alt="Miniatura" style="max-height: 180px; max-width: 280px;" id="imgMiniatura" title="Minatura" src="{$WWW_IMG}fotosAlbuns/{$oArtigo->sUrlImagem}" />
                                <input type="hidden" name="inputMiniaturaVazio" value="{$oArtigo->sUrlImagem}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Capa</label> 
                            <input type="file" class='form-control' id="inputMiniatura" name="inputMiniatura"/>
                        </div>
                    </div>
                {/if}

                {if $oArtigo->oArtigoTipo->iCodigo <> 3}
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Data da Postagem</label>
                            <input type="date" class='form-control' name="inputAgenda" id="inputAgenda" maxlength="20" value="{if ($oArtigo->sAgenda !== null) && ($oArtigo->sAgenda !== "")}{$oArtigo->sAgenda|date_format:"%d/%m/%Y"}{/if}"/>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Hora da Postagem</label>
                            <input type="text" class='form-control' name="inputHoraAgenda" id="inputHoraAgenda" maxlength="20" value="{if ($oArtigo->sAgenda !== null) && ($oArtigo->sAgenda !== "")}{$oArtigo->sAgenda|date_format:"%H:%M:%S"}{/if}"/>
                        </div>
                    </div>
                {/if}
                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Álbum</label>
                        <select name="inputAlbum" class="form-control">
                            <option value="-" >Nenhum</option>
                            {foreach $arrObjAlbum as $oAlbum}
                                <option {if $oArtigo->oAlbum->iCodigo == $oAlbum->iCodigo}selected{/if} value="{$oAlbum->iCodigo}" >{$oAlbum->sTitulo}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>

                <div class="col-xs-6">
                    <div class="form-group">
                        <label>Crédito</label>
                        <input class='form-control' type="text" name="inputCredito" id="inputCredito" maxlength="250" value="{$oArtigo->sCredito}"/>
                    </div>
                </div>

                {if $oArtigo->oArtigoTipo->iCodigo<> 3}
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Nome da Fonte</label>
                            <input class='form-control' type="text" name="inputFonteDescricao" id="inputFonteDescricao" value="{$oArtigo->sFonteDescricao}"/>
                        </div>
                    </div>    
                    <div class="col-xs-6">
                        <div class="form-group">
                            <label>Link da Fonte</label>
                            <input class='form-control' type="text" name="inputFonteUrl" id="inputFonteUrl" value="{$oArtigo->sFonteUrl}"/>
                        </div>
                    </div>
                {/if}
            </div>     
            <div class="box-footer">
                {if $smarty.session.PERMISSOES.EDITAR_ARTIGO == 'S'}
            
                <div id="divMensagemTitulo" ></div>
                
                <input type="submit"  name="inputSalvarArtigo" class="btn btn-primary btnSalvar" value="Salvar"/>
                {if !isset($smarty.get.codigo)}
                    <input type="submit" name="inputSalvarArtigo" class="btn btn-success btnSalvar" value="Salvar e Novo"/>
                {/if}
                <a href="?pagina=centraldecontrole/inicial"  class="btn btn-danger pull-right">Cancelar</a>
                {/if}
            </div>

        </fieldset>
    </form>
</div>
{/block}