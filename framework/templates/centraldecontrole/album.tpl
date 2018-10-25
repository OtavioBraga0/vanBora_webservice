{extends file='centraldecontrole/_layout.tpl'}

{block name='css'}
<link href="{$WWW_CSS}centraldecontrole/galeria/960_12.css" rel="stylesheet" type="text/css">
<link href="{$WWW_CSS}centraldecontrole/galeria/simple-lists.css" rel="stylesheet" type="text/css">
<link href="{$WWW_CSS}centraldecontrole/galeria/common.css" rel="stylesheet" type="text/css">
<!-- <link href="{$WWW_CSS}centraldecontrole/galeria/standard.css" rel="stylesheet" type="text/css">  -->
<link href="{$WWW_CSS}centraldecontrole/galeria/form.css" rel="stylesheet" type="text/css" />
<link href="{$WWW_CSS}centraldecontrole/galeria/simple-lists.css" rel="stylesheet" type="text/css" />
<link href="{$WWW_CSS}centraldecontrole/galeria/block-lists.css" rel="stylesheet" type="text/css" />
<link href="{$WWW_CSS}centraldecontrole/galeria/admin.css" rel="stylesheet" type="text/css" />
<link href="{$WWW_CSS}centraldecontrole/galeria/uploadify.css" type="text/css" rel="stylesheet" />
<link href="{$WWW_CSS}centraldecontrole/ui-lightness/jquery-ui-1.10.3.custom.min.css" rel="stylesheet" type="text/css" />
{/block}

{block name='js'}
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/galeria/html5.js"></script>
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/galeria/common.js"></script>
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/galeria/jquery.tip.js"></script>
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/galeria/standard.js"></script> 
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/jquery-ui-1.10.3.custom.min.js"></script>
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/galeria/album.js"></script>
<script type="text/javascript" src="{$WWW_JS}centraldecontrole/notify/notify.min.js"></script>
{/block}

{block name='body'}
{if $oAlbum->iCodigo <> ''}
    <div class="page-header">
        <a href="?pagina=centraldecontrole/album" class="btn btn-primary"> Voltar para Álbuns </a>
    </div>
    <div class="box box-primary"> 
        <div class="box-header"></div>
        <div class="box-body">
                <div class="form-flex">
                <div class="form-group">
                    <label for="{$oAlbum->iCodigo}">Nome do Álbum</label>
                    <input required type="text" name="album_name" id="{$oAlbum->iCodigo}" class="album_name with-tip form-control" title="Nome do Álbum" value="{$oAlbum->sTitulo}" maxlength="100" /> 
                </div>                        
                <div class="form-group">
                    <label for="inputCredito">Créditos</label>
                    <input required type="text" name="inputCredito" class="album_credito form-control" title="Créditos do Álbum" value="{$oAlbum->sCredito}" />         
                </div>
                <div class="form-group">
                    <label>Visível</label>
                    <select required class="inputVisivel form-control" name="inputVisivel">
                        <option value="S" {if $oAlbum->sVisivel == 'S'}selected{/if}>Sim</option>
                        <option value="N" {if $oAlbum->sVisivel == 'N'}selected{/if}>Não</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tipo</label>
                    <select required class="album_tipo form-control" name="inputTipo">
                        <option value="-">-</option>
                        {foreach $arrObjAlbumTipo as $oAlbumTipo}
                            <option value="{$oAlbumTipo->iCodigo}" {if $oAlbum->oAlbumTipo->iCodigo == $oAlbumTipo->iCodigo}selected{/if}>{$oAlbumTipo->sDescricao}</option>
                        {/foreach}
                    </select>
                </div>
                <div class="form-group">
                    <label>Categoria</label>
                    <select required class='album_categoria form-control' name="inputCategoria">
                        <option value="geral" {if $oAlbum->sTipo == 'geral'}selected{/if}>Geral</option>
                        <option value="sistema" {if $oAlbum->sTipo == 'sistema'}selected{/if}>Sistema</option>
                    </select>
                </div>
                <button class="btn updateAlbum btn-success">Atualizar</button>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header"></div>
        <div class="box-body">
            <div class="row">
                <div class="col-xs-12">
                    <form action="?pagina=centraldecontrole/upload_foto" method="post" enctype="multipart/form-data">
                        <div class="col-xs-9">
                            <div class="form-group">
                                <input required type="hidden" name="inputAlbumCodigo" value="{$oAlbum->iCodigo}" />
                                <input class='form-control'required name="uploads[]" type="file" multiple accept="image/x-png, image/gif, image/jpeg"  />
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <input type="submit" name="submit" class="btn btn-success pull-right"> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="box-footer"></div>
    </div>
    <div class="box box-default">
        <div class="box-header"></div>
        <div class="box-body">
            <div class="sortable form-flex-start" style="list-style-type: none; margin: 0; padding: 0;">
                {foreach $oAlbum->arrObjFoto as $oFoto}
                    <div class="lisort form-flex" id="item_{$oFoto->iCodigo}" class="div_{$oFoto->iCodigo}">
                        <div class="box box-default box-foto-edit extended-list div_{$oFoto->iCodigo}">
                            <div class="div_{$oFoto->iCodigo} fotos-album">
                                <ul class="mini-menu with-children-tip">
                                    <li><a href="javascript:void(0)" title="Atualizar"    id="{$oFoto->iCodigo}" album="{$oAlbum->iCodigo}" class="refresh"><i class="fa fa-refresh text-danger" style="font-size: 16px; color: blue"></i></a></li>
                                    <li><a href="javascript:void(0)" title="Definir Capa" id="{$oFoto->iCodigo}" album="{$oAlbum->iCodigo}" class="cover"><i class="fa fa-photo text-danger" style="font-size: 19px; color: black"></i></a></li>
                                    <li><a href="javascript:void(0)" title="Remover"      id="{$oFoto->iCodigo}" class="delete"><i class="fa fa-times-circle text-danger" style="font-size: 16px; color: red"></i></a></li>
                                </ul>   
                                <img class="pic with-tip tip-bottom" title="Mover posição" src="{$WWW_IMG}fotosAlbuns/{$oFoto->sUrl}" style="width:174px;height:136px" />
                                <input required type="text" class="with-tip foto_caption" id="f_{$oFoto->iCodigo}"  value="{$oFoto->sCaption}" maxlength="74" title="Título" style="margin-top:5px;" />
                                <label>Link:</label>
                                <input readonly type="text" value="{$WWW_IMG}fotosAlbuns/{$oFoto->sUrl}" title="Link" style="margin-top:-4px;" />
                            </div>
                        </div>
                    </div>
                {/foreach}
                </div>
        </div>
        <div class="box-footer"></div>
    </div>
{else}
    <form name="f" action="?pagina=centraldecontrole/album&create=true" method="post">
        <div class="box box-primary">
            <div class="box-header"></div>
            <div class="box-body">
                <div class="form-flex">
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="new">Nome do Álbum</label>
                            <input required type="text" name="inputAlbum" id="new" class="form-control" title="Nome do Álbum" />    
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label for="inputCredito">Créditos</label>
                            <input class="form-control" type="text" name="inputCredito" title="Créditos do Álbum" value="{$oAlbum->sCredito}" />   
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Visível</label>
                            <select required class='form-control' name="inputVisivel">
                                <option value="S" {if $oAlbum->sVisivel == 'S'}selected{/if}>Sim</option>
                                <option value="N" {if $oAlbum->sVisivel == 'N'}selected{/if}>Não</option>
                            </select>
                        </div>     
                    </div> 
                    <div class="col-xs-3">
                        <div class="form-group">
                            <label>Categoria</label>
                            <select required class='form-control' name="inputCategoria">
                                <option value="geral" {if $oAlbum->sTipo == 'geral'}selected{/if}>Geral</option>
                                <option value="sistema" {if $oAlbum->sTipo == 'sistema'}selected{/if}>Sistema</option>
                            </select>
                        </div>     
                    </div>                     
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary">Criar</button>
            </div>
        </div>
    </form>
    <div class="box box-primary">
        <div class="box-header"><h3>Albuns de Sistema</h3></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Álbum</th>
                        <th class="text-center">Visível</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>  
                    {foreach $arrObjAlbumSistema as $oAlbum}
                        <tr>
                            <td> {$oAlbum->iCodigo} </td>
                            <td> 
                                {$oAlbum->sTitulo}
                            </td>
                            <td class="text-center"> {if ($oAlbum->sVisivel == 'S')} Sim {else} Não {/if} </td>
                            <td class="text-center"> 
                                <a title="Editar Álbum" href="?pagina=centraldecontrole/album&edit={$oAlbum->iCodigo}">
                                    <i class="fa fa-pencil" style="font-size: 19px; color: blue"></i>
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
    <div class="box box-default">
        <div class="box-header"><h3>Albuns Gerais</h3></div>
        <div class="box-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Álbum</th>
                        <th class="text-center">Visível</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $arrObjAlbum as $oAlbum}
                        <tr>
                            <td> {$oAlbum->iCodigo} </td>
                            <td> 
                                {$oAlbum->sTitulo} 
                            </td>
                            <td class="text-center"> {if ($oAlbum->sVisivel == 'S')} Sim {else} Não {/if} </td>
                            <td class="text-center"> 
                                <a class="" title="Editar Álbum" href="?pagina=centraldecontrole/album&edit={$oAlbum->iCodigo}">
                                    <i class="fa fa-pencil" style="color: blue; font-size: 19px"></i>
                                </a>
                                <a class="deleteAlbum" title="Remover Álbum"  id="{$oAlbum->iCodigo}" href="javascript:void(0)">
                                    <i class="fa fa-times-circle text-danger" style="font-size: 19px; color: red"></i>
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                </tbody>                                        
            </table>
        </div>
        <div class="box-footer"></div>
    </div>
{/if}
{/block}