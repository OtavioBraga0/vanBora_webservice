{include file="site/_header.tpl"}

<section class="container" id="noticias">
    <article class="row documentos-container" id="noticias">

        <div class="col-12 col-lg-6 wow fadeInLeft" data-wow-duration="1s">
            <div class="data">
                <p>{$oArtigo->sCadastro|date_format:"%d"}</p>
                <p>{$oArtigo->sCadastro|date_format:"%B"}</p>
                <p>{$oArtigo->sCadastro|date_format:"%Y"}</p>
            </div>
        </div>

        <div class="col-12 col-lg-6 wow fadeInRight" data-wow-duration="1s">
            <h2 class="titulo-noticia mb-3">{$oArtigo->sTitulo}</h2>
            <p><strong>{$oArtigo->sResumo}</strong></p>
        </div>

        {if $oArtigo->oAlbum->arrObjFoto[0]->sUrl != "" }
            <div class="col-12 col-lg-6 order-lg-0 order-1 wow fadeInDown" data-wow-delay=".5s" data-wow-duration="1s">
                <div class="row">
                    <div class="col-12 order-1">
                        <ul class="galeriaDeFotos">
                            {foreach $oArtigo->oAlbum->arrObjFoto as $oFoto}
                                <li>
                                    <img src="{$WWW_IMG}fotosAlbuns/{$oFoto->sUrl}" alt="" title="" />
                                </li>
                            {/foreach}
                        </ul>

                        <div class="thumbsArtigoAlbum">
                            {$i = 0}
                            {foreach $oArtigo->oAlbum->arrObjFoto as $oFoto}
                                {$i = $i + 1}
                                <a data-slide-index="{$i}" href="{$WWW_IMG}fotosAlbuns/{$oFoto->sUrl}">
                                    <div class="thumbAlbum" style="background-image: url('{$WWW_IMG}fotosAlbuns/{$oFoto->sUrl}');"></div>
                                </a>
                            {/foreach}
                        </div>
                    </div>
                </div>
            </div>
        {else}
            <div class="col-12 col-lg-6 order-lg-0 order-1 wow fadeInDown" data-wow-delay=".5s" data-wow-duration="1s">
                <div class="row">
                    <div class="col-12 order-1">
                        <img src="{$oArtigo->sUrlImagem}" class="img-fluid">
                    </div>
                </div>
            </div>
        {/if}

        <div class="col-12 col-lg-6 order-lg-1 order-0 wow fadeInDown" data-wow-delay=".5s" data-wow-duration="1s">
            {$oArtigo->sConteudo}
            {if isset($oArtigo->sAutor)}
                <p class="creditos text-right">Por: {$oArtigo->sAutor}</p>
            {/if}
        </div>

    </article>
</section>

{include file="site/_footer.tpl"}