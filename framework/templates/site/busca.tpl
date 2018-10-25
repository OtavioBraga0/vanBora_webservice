{include file="site/_header.tpl"}

<section class="container" id="noticias-principais">

    <div class="row text-center">
        <div class="col">
            <h2 class="titulo">Notícias</h2>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-10 col-md-9 col-12">
            
            <!-- Swiper -->
            <div class="swiper-container" id="carousel-noticias-principais">
                <div class="swiper-wrapper">
                    <!-- CARREGADO DINAMICAMENTE -->
                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

        <div class="col-lg-2 col-md-3 col-12 align-self-center">
            
            <ul class="lista-noticias-principais text-right nice-scroll">
                {$ano = 0}
                {foreach $arrObjArtigoAno as $oArtigo}
                    {if $ano == 0}  
                        {$ano = $oArtigo->sAno}        
                        <li><a class="ano" data-ano="{$oArtigo->sAno}">{$oArtigo->sAno}</a></li>    
                        <li>
                            <ul class="lista-meses">            
                    {elseif $oArtigo->sAno != $ano}
                        {$ano = $oArtigo->sAno}        

                            </ul>
                        </li>  
                        <li><a class="ano" data-ano="{$oArtigo->sAno}">{$oArtigo->sAno}</a></li>    
                        <li>
                            <ul class="lista-meses"> 
                    {/if}
                            {$dt=$oArtigo->sAno|cat:"-"|cat:$oArtigo->sMes|cat:"-01"}
                                <li><a href="" data-ano="{$oArtigo->sAno}" data-mes="{$oArtigo->sMes}">{$dt|date_format:'%B'|utf8_encode}</a></li>
                {/foreach}
                {if $ano != 0}
                            </ul>
                        </li>
                {/if}
            </ul>
        </div>

    </div>
</section>

{*
<section class="container" id="noticias">
    <!-- CARREGADO DINAMICAMENTE -->
</section>
*}

<section class="container">
    
    <div class="row busca-noticias line-top">
        <!-- CARREGADO DINAMICAMENTE -->
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col ver-mais">            
            <a href="#" class="btn-vermais" id="carregar-mais" data-item="1">
                <span class="mb-3 texto">Ver mais...</span>
                <span class="icone">+</span>
            </a>
        </div>
    </div>
</div>

{include file="site/_footer.tpl"}