{include file="site/_header.tpl"}
<section class="container-fluid" id="sobre">
    <div class="row">
        <div class="col-lg-6 col-12 missao-amex">
            {foreach $arrObjSessao as $oSessao}
                {if $oSessao->iCodigo lt 4}
                    <h2>{$oSessao->sTitulo}</h2>
                    <p>{$oSessao->sConteudo}</p>
                {/if}
            {/foreach}
            <div class="nav-secoes text-right">
                <ul>
                    <li><a href="#equipe" class="active">Equipe</a></li>
                    <li><a href="#clientes">Clientes</a></li>
                    <li><a href="#depoimentos">Depoimentos</a></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6 col-12 sobre-amex">
            <h1 class="titulo">{$arrObjSessao[3]->sTitulo}</h1>
            {$arrObjSessao[3]->sConteudo}
        </div>
    </div>
</section>


<section class="container" id="equipe">
    <div class="row">
        <div class="col-12">
            <h2 class="titulo">Equipe</h2>
            <!-- Swiper -->
            <div class="swiper-container" id="carousel-equipe">
                <div class="swiper-wrapper">
                    {foreach $arrObjEquipe as $oEquipe}
                        <div class="swiper-slide">
                            <img src="{$WWW_IMG}equipe/{$oEquipe->sUrlImagem}" alt="" title="" />
                            <h3 class="mt-3">{$oEquipe->sNome}</h3>
                            <h4>{$oEquipe->sCargo}</h4>
                        </div>
                    {/foreach}                    
                </div>
                <!-- Add Arrows -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>
    </div>
</section>

<section class="container-fluid" id="clientes">
    <div class="row">
        <div class="col-12">
            <h2 class="titulo">{$arrObjSessao[4]->sTitulo}</h2>
            {$arrObjSessao[4]->sConteudo}
        </div>

        <div class="col-12">
            <div class="swiper-container mt-5 mb-5" id="carousel-clientes">
                <div class="swiper-wrapper">
                    {foreach $arrObjCliente as $oCliente}
                        <div class="swiper-slide">
                            <img src="{$WWW_IMG}cliente/{$oCliente->sUrlImagem}" alt="" title="" />
                        </div>
                    {/foreach}
                </div>
                <!-- Add Arrows -->
                <!-- <div class="swiper-button-next d-md-none"></div>
                <div class="swiper-button-prev d-md-none"></div> -->
            </div>
        </div>

        <div class="col-lg-6 col-12 depoimentos">
            <h2 class="titulo my-5">Depoimentos</h2>
        </div>
        <div class="col-lg-6 col-12 align-self-center py-5">
            <h2 class="titulo">
                <p class="text-center mb-0">Veja o que nossos clientes e parceiros dizem sobre nós!</p>
            </h2>
        </div>

    </div>
</section>

<section class="container" id="depoimentos">
    <div class="row">
        <div class="col-12">

            <div class="swiper-container my-5" id="carousel-depoimentos">
                <div class="swiper-wrapper">
                    {foreach $arrObjDepoimento as $oDepoimento}
                        <div class="swiper-slide">
                            <img src="{$WWW_IMG}depoimento/{$oDepoimento->sUrlImagem}" alt="{$oDepoimento->sNome}" title="{$oDepoimento->sNome}" />
                            <div class="info-depoimentos">
                                {$oDepoimento->sConteudo}
                                <h4>{$oDepoimento->sNome}</h4>
                                <h5>{$oDepoimento->sEmpresa}</h5>
                            </div>
                        </div>
                    {/foreach}
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>

        </div>
    </div>
</section>

<section id="servicos" class="bg-azul-escuro">
    <div class="container">
        <div class="row">

            <div class="col-12 descricao-servicos">
                <h3 class="text-uppercase text-center">Saiba o que podemos realizar juntos para <span>ampliar horizontes!</span></h3>
                <h2 class="text-uppercase text-center my-4 bg-azul">Fundraising</h2>

                <ul class="list-unstyle text-uppercase text-center">
                    <li>Campanha de Fundraising</li>
                    <li>Sistema de Relacionamento</li>
                    <li>Formação e Treinamentos</li>
                </ul>
            </div>
            <div class="col-12">

                <div class="swiper-container mt-4 mb-5" id="carousel-servicos">
                    <div class="swiper-wrapper">
                        {foreach $arrObjFundraising as $oFundraising}
                            <div class="swiper-slide passo{$oFundraising->iCodigo}">
                                <h3>{$oFundraising->sNome}</h3>
                                <h4 class="text-justify">{$oFundraising->sConteudo}
                                </h4>
                            </div>
                        {/foreach}
                    </div>

                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

            </div>
        </div>
    </div>
</section>

<main id="areas">
    <div class="container">

            <div class="row text-center item-areas bg-azul-escuro">

                <div class="col-lg-3 col-md-6 col-12">
                    <h3 class="bg-azul text-uppercase mb-2">Digital</h3>
                    <ul class="list-unstyle text-uppercase text-center">
                        <li>Site</li>
                        <li>Portal</li>
                        <li>Aplicativo</li>
                        <li>Gestão de redes social</li>
                        <li>Gestão de site</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <h3 class="bg-azul text-uppercase mb-2">Design</h3>
                    <ul class="list-unstyle text-uppercase text-center">
                        <li>Identidade visual</li>
                        <li>Papelaria institucional</li>
                        <li>Projeto gráfico <span>(campanhas e eventos)</span></li>
                        <li>Ilustração</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <h3 class="bg-azul text-uppercase mb-2">Editorial</h3>
                    <ul class="list-unstyle text-uppercase text-center">
                        <li>Informativo</li>
                        <li>Revista</li>
                        <li>Livro</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-12 bg-branco d-flex">
                    <div class="col align-self-center mt-md-0 mt-3">
                        <h3 class="text-uppercase text-center text-lg-right">Veja todos os nossos serviços</h3>
                        <a href="#" class="btn-link-interno mt-3"><i class="fa fa-angle-down"></i></a>
                    </div>
                </div>
        
            </div>

    </div>
</main>

<section class="container" id="portifolio">
    <div class="row">
        <div class="col-12">

            <h2 class="titulo">Portfólio</h2>

            <div class="swiper-container mt-5 mb-5" id="carousel-portifolio">
                <div class="swiper-wrapper">
                    {foreach $arrObjPortifolio as $oPortifolio}
                        <div class="swiper-slide">
                            <a href="#portifolio-detalhes" data-id="{$oPortifolio->iCodigo}">
                                <img src="{$oPortifolio->sUrlImagem}" alt="{$oPortifolio->sNome}" title="{$oPortifolio->sNome}" />
                            </a>
                        </div>
                    {/foreach}

                <div class="swiper-button-next to-end"></div>
                <div class="swiper-button-prev to-end"></div>
            </div>
        </div>
    </div>

    <div class="row" id="portifolio-detalhes">
        <!-- CARREGADO DINAMICAMENTE -->
    </div>

</section>

<section id="chamada-noticias">

    <div class="container">
        <div class="row">
            <div class="col text-center text-uppercase">
                <a href="{$WWW}busca">
                    <img src="{$WWW_IMG}shared/newspaper.svg" alt="Not�cias" title="Not�cias" /> Confira as notícias!
                </a>
            </div>
        </div>
    </div>

</section>

<div class="modal fade modalForm" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <p class="text-center" id="mensagemForm"></p>
            </div>

        </div>
    </div>
</div>            

{include file="site/_footer.tpl"}