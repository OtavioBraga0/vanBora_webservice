<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{$sNomeSite}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" href="{$WWW_IMG}_header/favicon.ico" type="image/x-icon" /> {if isset($oArtigo)}
  <meta property="og:type" content="article" />
  <meta property="og:title" content="{$oArtigo->sTitulo}" />
  <meta property="og:url" content="{$WWW}{$oArtigo->sLink}" />
  <meta property="og:description" content="{$oArtigo->sResumo}" />
  <meta property="og:image" content="{$oArtigo->sUrlImagem}" /> {else if isset($oAlbum)}
  <meta property="og:title" content="{$oAlbum->sTitulo}" />
  <meta property="og:url" content="{$WWW}fotos/{$oAlbum->iCodigo}" />
  <meta property="og:description" content="{$oAlbum->sTitulo}" />
  <meta property="og:image" content="{$WWW}{$oAlbum->arrObjFoto[0]->sUrl}" /> {else}
  <meta property="og:title" content="Nome do Santu�rio" />
  <meta property="og:url" content="{$WWW}" />
  <meta property="og:description" content="Resumo sobre o Santu�rio" />
  <meta property="og:image" content="Url imagem para ser carregada ao compartilhar a home nas redes sociais" /> {/if}

  <link rel="stylesheet" href="{$WWW_CSS}bootstrap/bootstrap.min.css" />
  <link rel="stylesheet" href="{$WWW_CSS}font-awesome.min.css" />
  <link rel="stylesheet" href="{$WWW_CSS}wow/animate.css" />
  <link rel="stylesheet" href="{$WWW_CSS}swiper/swiper.min.css" /> {if $sPaginaNome == "artigo"}
  <link rel="stylesheet" href="{$WWW_CSS}bx-slider/jquery.bxslider.css" /> {/if}

  <link rel="stylesheet" href="{$WWW_CSS}style.css" />

</head>

<body>
 {if $sPaginaNome == "home"}
  <header id="inicio" class="menu-home">
    <div class="container">
      <div class="row justify-content-center text-center">
        <div class="col-12">
          <img src="{$WWW_IMG}home/logo-amex-branco.svg" alt="{$sNomeSite}" title="{$sNomeSite}" class="img-logo-inicio mb-4" />
        </div>
        <div class="col-12">
          <img src="{$WWW_IMG}home/slogan-amex.svg" alt="Amex - Ampliando Horizontes" title="Amex - Ampliando Horizontes"
            class="img-slogan-inicio" />
        </div>

        <div class="col-12 mt-4">
          <nav class="navbar navbar-expand-md navbar-dark" id="navegacao-site">
            <a class="navbar-brand d-none" href="{$WWW}">
              <img src="{$WWW_IMG}shared/logo-amex.svg" alt="Logo Amex Assessoria" title="{$sNomeSite}" />
            </a>

            <button class="navbar-toggler d-none" type="button" data-toggle="collapse" data-target="#menu-site">
              <span class="fa fa-bars"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu-site">
              <ul class="navbar-nav mx-auto text-uppercase">
                {foreach $arrObjMenu as $oMenu1}
                {if ($oMenu1->arrObjMenu->count()) > 0}
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true">{$oMenu1->sDescricao}</a>
                  <div class="dropdown-menu">
                    {foreach $oMenu1->arrObjMenu as $oMenu2}
                    <a class="dropdown-item" href="{$WWW}{$oMenu2->sLink}">{$oMenu2->sDescricao}</a>
                    {/foreach}
                  </div>
                </li>
                {else}
                <li class="nav-item">
                  <a class="nav-link" href="{$WWW}{$oMenu1->sLink}">{$oMenu1->sDescricao}</a>
                </li>

                {/if}
                {/foreach}
              </ul>
            </div>
          </nav>
        </div>

      </div>
    </div>

  </header>

  {else}

  <header id="inicio" class="menu-interno">
      <div class="container">
        <div class="row justify-content-center text-center">
  
          <div class="col-12">
            <nav class="navbar navbar-expand-md fixed-top menu-fixo" id="navegacao-site">
              <a class="navbar-brand" href="{$WWW}">
                <img src="{$WWW_IMG}shared/logo-amex.svg" alt="Logo Amex Assessoria" title="{$sNomeSite}" class="logo-min"/>
              </a>
  
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu-site">
                <span class="fa fa-bars"></span>
              </button>
  
              <div class="collapse navbar-collapse" id="menu-site">
                <ul class="navbar-nav ml-auto text-uppercase">
                  {foreach $arrObjMenu as $oMenu1}
                  {if ($oMenu1->arrObjMenu->count()) > 0}
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true">{$oMenu1->sDescricao}</a>
                    <div class="dropdown-menu">
                      {foreach $oMenu1->arrObjMenu as $oMenu2}
                      <a class="dropdown-item" href="{$WWW}{$oMenu2->sLink}">{$oMenu2->sDescricao}</a>
                      {/foreach}
                    </div>
                  </li>
                  {else}
                  <li class="nav-item">
                    <a class="nav-link" href="{$WWW}{$oMenu1->sLink}">{$oMenu1->sDescricao}</a>
                  </li>
  
                  {/if}
                  {/foreach}
                </ul>
              </div>
            </nav>
          </div>
  
        </div>
      </div>
  
    </header>

    <div class="mt-5"></div>

    {/if}