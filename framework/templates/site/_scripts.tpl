<script src="{$WWW_JS}jquery-3.2.1.min.js"></script>
<script src="{$WWW_JS}bootstrap/bootstrap.min.js"></script>
<script src="{$WWW_JS}wow/wow.min.js"></script>
<script src="{$WWW_JS}bx-slider/jquery.bxslider.js"></script>
<script src="{$WWW_JS}swiper/swiper.min.js"></script>
<script src="{$WWW_JS}nicescroll/jquery.nicescroll.min.js"></script>
<script src="{$WWW_JS}style.js"></script>

<script>

  // hover secao contato
  var items = $(".contato-item");

  function windowWidth(){
    var windowWidth = window.innerWidth;
    if(windowWidth < 991) {
      items.removeClass("have-active");
    }
  }

  items.each(function(index, elemento){    
      $(this).mouseover(function(){
        items.removeClass("active");
        $(this).addClass("active");          
      });      
  });

  windowWidth();

  window.addEventListener('resize', function(){
    windowWidth();    
  });
  
  // inicializa wow.js
  new WOW().init();

  // #carousel-equipe
  var carouselEquipe = "#carousel-equipe";

  var swiper = new Swiper(carouselEquipe, {
    slidesPerView: 5,
    pagination: {
      el: carouselEquipe + ' .swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: carouselEquipe + ' .swiper-button-next',
      prevEl: carouselEquipe + ' .swiper-button-prev',
    },
    breakpoints: {
      992: {
        slidesPerView: 3
      },
      768: {
        slidesPerView: 2
      },
      576: {
        slidesPerView: 1
      }
    }
  });

  // #carousel-clientes
  var carouselClientes = "#carousel-clientes";

  var swiper = new Swiper(carouselClientes, {
    slidesPerView: 5,
    slidesPerColumn: 3,
    spaceBetween: 40,
    // pagination: {
    //   el: carouselClientes + ' .swiper-pagination',
    //   clickable: true
    // },
    navigation: {
      nextEl: carouselClientes + ' .swiper-button-next',
      prevEl: carouselClientes + ' .swiper-button-prev',
    },
    breakpoints: {
      992: {
        slidesPerView: 3
      },
      768: {
        slidesPerView: 2
      },
      576: {
        slidesPerView: 1
      }
    }
  });
  
  // #carousel-portifolio
  var carouselPortifolio = "#carousel-portifolio";

  var swiper = new Swiper(carouselPortifolio, {
    slidesPerView: 5,
    slidesPerColumn: 3,
    spaceBetween: 1,
    pagination: {
      el: carouselPortifolio + ' .swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: carouselPortifolio + ' .swiper-button-next',
      prevEl: carouselPortifolio + ' .swiper-button-prev',
    },
    breakpoints: {
      992: {
        slidesPerView: 3
      },
      768: {
        slidesPerView: 2,
        slidesPerColumn: 2
      },
      576: {
        slidesPerView: 2,
        slidesPerColumn: 1
      }
    }
  });

  // #carousel-depoimentos
  var carouselDepoimentos = "#carousel-depoimentos";

  var swiper = new Swiper(carouselDepoimentos, {
    direction: 'vertical',
    autoplay: {
      delay: 20000
    },
    pagination: {
      el: carouselDepoimentos + ' .swiper-pagination',
      clickable: true
    },
    breakpoints: {
      992: {
        direction: 'horizontal'
      }
    }
  });

  // #carousel-servicos
  var carouselServicos = "#carousel-servicos";

  var swiper = new Swiper(carouselServicos, {
    slidesPerView: 2,
    spaceBetween: 40,
    pagination: {
      el: carouselServicos + ' .swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: carouselServicos + ' .swiper-button-next',
      prevEl: carouselServicos + ' .swiper-button-prev',
    },
    breakpoints: {
      992: {
        slidesPerView: 1
      }
    }
  });  

  
  {if $sPaginaNome == "artigo"}
    // carroussel de fotos
    $('.galeriaDeFotos').bxSlider({
      mode: 'fade',
      controls: true,
      captions: true,
      pagerCustom: '.thumbsArtigoAlbum'
    });
  {/if}
  
  {if $sPaginaNome == "busca"}

    // #carousel-noticias-principais
    var carouselNoticiasPrincipais = "#carousel-noticias-principais";

    var swiperNoticiasPrincipais = new Swiper(carouselNoticiasPrincipais, {
      pagination: {
        el: carouselNoticiasPrincipais + ' .swiper-pagination',
        clickable: true
      }
    });

    $(document).ready(function () {
      $(".ano").removeClass('active');
      var ano = $('.lista-meses a').first().attr("data-ano");
      var mes = $('.lista-meses a').first().attr("data-mes");
      $(".ano[data-ano='"+ano+"']").addClass('active');
      carregaCarrossel(ano, mes);

      var lastId = 0
      var btnCarragarMais = $("#carregar-mais");

      listaArtigo(lastId);

      function listaArtigo(){
        $.post(
          '{$WWW}busca', 
          {literal}{lastId:lastId}{/literal}
        ).done(function(oArtigo){
          oArtigo = JSON.parse(oArtigo);
          $.each(oArtigo, function(idx, obj){
            let noticia =  `<div class="col-md-4 col-12">
                                <a href="{literal}${obj.sLink}{/literal}">
                                    <img src="{literal}${obj.sUrlImagem}{/literal}" alt="{literal}${obj.sTitulo}{/literal}" title="{literal}${obj.sTitulo}{/literal}" />
                                    <h2 class="titulo-noticia my-3">{literal}${obj.sTitulo}{/literal}</h2>
                                    <h3 class="resumo-noticia mb-md-0 mb-5">{literal}${obj.sResumo}{/literal}</h3>
                                </a>
                            </div>`;
          
            lastId = obj.iCodigo;
            $(".busca-noticias").append(noticia);
            if(obj.Proximo == null){
              btnCarragarMais.hide();
            } 
          })
        })
      }

      btnCarragarMais.click(function(e){
        e.preventDefault();
        listaArtigo();
      })

      $(".lista-meses a").click(function(e){
        e.preventDefault();
        $(".ano").removeClass('active')
        var ano = $(this).attr("data-ano");
        var mes = $(this).attr("data-mes");
        $(".ano[data-ano='"+ano+"']").addClass('active');
        carregaCarrossel(ano, mes);
      })

      function carregaCarrossel(ano, mes){
        swiperNoticiasPrincipais.removeAllSlides();
        $.post(
          "{$WWW}busca",
          {literal}{mes: mes, ano: ano}{/literal}
        ).done(function(arrObjArtigoPrincipal){
          arrObjArtigoPrincipal = JSON.parse(arrObjArtigoPrincipal)
          $.each(arrObjArtigoPrincipal, function(idx, obj){
            var noticia = `<div class="swiper-slide">
                              <a href="{literal}${obj.sLink}{/literal}">
                                  <img src="{literal}${obj.sUrlImagem}{/literal}" alt="{literal}${obj.sTitulo}{/literal}" title="{literal}${obj.sTitulo}{/literal}" />
                                  <div class="noticias-info">
                                      <div>
                                          <h2 class="titulo-noticia my-2">{literal}${obj.sTitulo}{/literal}</h2>
                                      </div>
                                  </div>
                              </a>
                          </div>`;
            swiperNoticiasPrincipais.appendSlide(noticia);
          })
        })
        swiperNoticiasPrincipais.updateSlides();
      }
    });  

  {/if}

  // envia form contato com ajax
  function enviaContato() {
    var dados = $("#formulario-contato").serialize();

    var url = "{$WWW}contato";

    $.post(url, dados, function (msg) {
      $("#mensagemContato").html("<h4 class='text-success text-center'>" + msg + "</h4>");
      setTimeout(function () {
        $("#mensagemContato").html("");
      }, 5000);
    }).fail(function () {
      $("#mensagemContato").html("<h4 class='text-danger text-center'>" + msg + "</h4>");
      setTimeout(function () {
        $("#mensagemContato").html("");
      }, 5000);
    });
  }
  // add scrol personalizado .lista-noticias-principais
  $(".nice-scroll").niceScroll({
    cursorcolor:"#4fc9fc"
  });

  {if $sPaginaNome == "home"}
    // mostra item portifolio
    var itemPortifolio = $('#portifolio .swiper-container .swiper-slide a');
    var detalhesPortifolio = $('#portifolio-detalhes');

    $(document).ready(function(){
      detalhesPortifolio.hide();
    })

    itemPortifolio.click(function () { 
        detalhesPortifolio.show();
        var id = $(this).attr('href');
        var navbarHeight = $('#navegacao-site').height();
        
        var offset = $(id).offset().top;

        $('html, body').animate({
            scrollTop: offset - (navbarHeight + 10)
        }, 800);  
        
        var idPortifolio = $(this).attr('data-id');
        carregaPortifolioDetalhes(idPortifolio);
    });

    function carregaPortifolioDetalhes(idPortifolio){
      $.post(
        "{$WWW}",
        {literal}{idPortifolio: idPortifolio}{/literal}
      ).done(function(oPortifolio){
        oPortifolio = JSON.parse(oPortifolio)
        var portifolio = `<div class="col-12 col-lg-6">
                              <img src="{literal}${oPortifolio.sUrlImagem}{/literal}" alt="{literal}${oPortifolio.sNome}{/literal}" class="img-portifolio"/>
                          </div>
                          <div class="col-12 col-lg-6 text-justify">
                              <h3 class="titulo-portifolio mb-3">{literal}${oPortifolio.sNome}{/literal}</h3>
                              {literal}${oPortifolio.sConteudo}{/literal}
                              <a href="#" id="portifolio-fecha-detalhes" class="btn btn-azul-escuro pull-right"><i class="fa fa-angle-left"></i> Voltar</a>
                          </div>`;

        $("#portifolio-detalhes").html(portifolio);
      })
    }

    $("a#portifolio-fecha-detalhes").click(function(e){
      e.preventDefault();
      detalhesPortifolio.hide();
    })
  {/if}
</script>