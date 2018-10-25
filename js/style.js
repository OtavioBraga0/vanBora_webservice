var btnTop = $("#toTop");

$(window).scroll(function(){
    var altura = $(window).height() * 3/4;  

    if ($(this).scrollTop() > altura) {
        btnTop.fadeIn();
    } else {
        btnTop.fadeOut();
    }
});

btnTop.click(function(){
    $('html, body').animate({scrollTop : 0},1000);
    return false;
});

var navbar = $("#inicio.menu-home #navegacao-site");
var navbarItems = $("#inicio.menu-home .navbar-nav");
var logo = $("#navegacao-site .navbar-brand");
var logoImg = $("#navegacao-site .navbar-brand img");
var iconeMenuMobile = $("#navegacao-site .navbar-toggler");

function animarMenu() {
    navbar.addClass("alterar-top");
    logo.removeClass("d-none");
    logoImg.addClass("logo-min");
    iconeMenuMobile.removeClass("d-none");
    navbarItems.removeClass("mx-auto");
    navbarItems.addClass("ml-auto");

    setTimeout(() => {
        navbar.addClass("anime");
        navbar.addClass("fixed-top");
        navbar.addClass("menu-fixo");
    }, 10);
}

function defaultMenu(){
    logo.addClass("d-none");
    iconeMenuMobile.addClass("d-none");
    navbar.removeClass("anime");
    navbar.removeClass("alterar-top");
    navbar.removeClass  ("fixed-top");
    navbar.removeClass  ("menu-fixo");
    logoImg.removeClass("logo-min");
    navbarItems.addClass("mx-auto");
    navbarItems.removeClass("ml-auto");
}

$(window).scroll(function () {
    var altura = $("#sobre").offset().top;        
    var alturaLimiteMenuFixed = $(this).scrollTop(); // posicao vertical scrollbar
    console.log(altura, alturaLimiteMenuFixed);

    if (alturaLimiteMenuFixed >= altura) {
        animarMenu();
    } else {
        defaultMenu();
    }
});

$("#formContato").submit(function(e){
    e.preventDefault();
    let dados  = $(this).serialize();

    $.post(
        $(this).attr('action'),
        {dados}
    )
    .done(function(msgRetorno){
        $("#mensagemForm").html(msgRetorno);
        $(".modalForm").modal("show");
    });
});
