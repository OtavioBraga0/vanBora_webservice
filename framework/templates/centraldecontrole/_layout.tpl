<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html lang="pt-br">
<head>

   <title>{$sNomeSite}</title>
   <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
   <meta http-equiv="content-language" content="pt-br" />
   <meta http-equiv="imagetoolbar" content="no" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="author" content="Amex Assessoria" />
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
   <meta name="copyright" content="Amex Assessoria" />
   <meta name="geo.region" content="SP"/>
   <meta name="geo.placename" content="Guaratinguetá" />
   <meta name="MSSmartTagsPreventParsing" content="true" />
   <meta name="description" content="" />
   {*<link rel="shortcut icon" href="{$WWW_IMG}centraldecontrole/logo.png" />*}
   <meta http-equiv="content-script-type" content="text/javascript" />
   <meta http-equiv="content-style-type" content="text/css" />
   <base href="{$WWW}" />

   <meta http-equiv="pragma" content="no-cache" />
   <meta http-equiv="expires" content="0" />
   <meta http-equiv="last-modified" content="{$lastModified}" />

   <link rel="stylesheet" href="{$WWW_CSS}font-awesome.min.css" />

   
   <link rel="stylesheet" href="{$WWW_CSS}centraldecontrole/bootstrap.min.css" />        
   <link rel="stylesheet" href="{$WWW_CSS}centraldecontrole/AdminLTE.css" />  
   <link rel="stylesheet" href="{$WWW_CSS}centraldecontrole/skins/_all-skins.css" />
   <link rel="stylesheet" href="{$WWW_CSS}centraldecontrole/style.css" />
   {block name="css"}{/block}
</head>
<body class="sidebar-mini skin-black">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="{$WWW}?pagina=centraldecontrole/inicial" class="logo">
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    <img src="{$WWW_IMG}logo_amex.svg" class="img-responsive" style="margin: 5px 20px">
                </span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
       
                <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning">10</span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">You have 10 notifications</li>
                        <li>
                        <!-- inner menu: contains the actual data -->
                        <ul class="menu">
                            <li>
                            <a href="#">
                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                            </a>
                            </li>
                            <li>
                            <a href="#">
                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                page and may cause design problems
                            </a>
                            </li>
                            <li>
                            <a href="#">
                                <i class="fa fa-users text-red"></i> 5 new members joined
                            </a>
                            </li>
                            <li>
                            <a href="#">
                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                            </a>
                            </li>
                            <li>
                            <a href="#">
                                <i class="fa fa-user text-red"></i> You changed your username
                            </a>
                            </li>
                        </ul>
                        </li>
                        <li class="footer"><a href="#">View all</a></li>
                    </ul>
                    </li>
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="hidden-xs">{$smarty.session.NOME}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <!-- <li class="user-header">
                            
                        </li> -->
                        <!-- Menu Body -->
                        <li class="user-body">
                            <p>
                                {$smarty.session.NOME}
                            </p>
                        <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="?pagina=centraldecontrole/logoff" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                    </li>
                </ul>
                </div>
            </nav>
        </header>
        <!-- ./header -->

        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                </div>
                <div class="pull-left info">
                <p>{$smarty.session.NOME}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu tree" data-widget="tree">
                <li class="header">GERAL</li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-edit"></i>
                        <span>Conteúdo / Layout</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {if $sPagina == 'postagens'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/inicial">Postagens</a>
                        </li>
                        {if $smarty.session.PERMISSOES.CADASTRAR_MENU == 'S'}
                            <li {if $sPagina == 'menu'}class="active"{/if}>
                                <a href="?pagina=centraldecontrole/menu&acao=lista">Menu</a>
                            </li>
                        {/if}
                        {if $smarty.session.PERMISSOES.CADASTRAR_TAG == 'S'}
                            <li {if $sPagina == 'tags'}class="active"{/if}>
                                <a href="?pagina=centraldecontrole/tag&acao=lista">Tags</a>
                            </li>
                        {/if} 
                        <li {if $sPagina == 'evento'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/evento">Eventos</a>
                        </li>
                        <li {if $sPagina == 'arte'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/arte">Artes Eventuais</a>
                        </li>
                        <li {if $sPagina == 'sessao'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/sessao">Sessão</a>
                        </li>
                        <li {if $sPagina == 'equipe'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/equipe">Equipe</a>
                        </li>
                        <li {if $sPagina == 'cliente'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/cliente">Clientes</a>
                        </li>
                        <li {if $sPagina == 'depoimento'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/depoimento">Depoimentos</a>
                        </li>
                        <li {if $sPagina == 'fundraising'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/fundraising">Fundraising</a>
                        </li> 
                        <li {if $sPagina == 'portifolio'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/portifolio">Portifólio</a>
                        </li>    
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-video-camera"></i>
                        <span>Multimídia</span>
                        <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        {if $smarty.session.PERMISSOES.CADASTRAR_FOTO == 'S'}
                            <li {if $sPagina == 'album_tipo'}class="active"{/if}>
                                <a href="?pagina=centraldecontrole/album_tipo">Tipos de Álbum</a>
                            </li>
                        {/if}
                        {if $smarty.session.PERMISSOES.CADASTRAR_FOTO == 'S'}
                            <li {if $sPagina == 'fotos'}class="active"{/if}>
                                <a href="?pagina=centraldecontrole/album">Fotos</a>
                            </li>
                        {/if}
                        {if $smarty.session.PERMISSOES.CADASTRAR_AUDIO == 'S'}
                            <li {if $sPagina == 'audio_tipo'}class="active"{/if}>
                                <a href="?pagina=centraldecontrole/audio_tipo">Tipos de Áudio</a>
                            </li>
                        {/if}
                        {if $smarty.session.PERMISSOES.CADASTRAR_AUDIO == 'S'}
                            <li {if $sPagina == 'audios'}class="active"{/if}>
                                <a href="?pagina=centraldecontrole/audio">Áudios</a>
                            </li>
                        {/if}
                        {if $smarty.session.PERMISSOES.CADASTRAR_VIDEO == 'S'}
                            <li {if $sPagina == 'videos'}class="active"{/if}>
                                <a href="?pagina=centraldecontrole/video">Vídeos</a>
                            </li>
                        {/if}
                        <li {if $sPagina == 'anexos'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/anexo">Anexos</a>
                        </li>
                        <li {if $sPagina == 'informativo'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/informativo">Informativo</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-home"></i> 
                        <span>Espiritualidade</span>
                        <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li {if $sPagina == 'aprovarPedidos'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/aprovarPedidos">Aprovar Testemunhos e Vela Virtual</a>
                        </li>
                        <li {if $sPagina == 'responderPedidos'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/responderPedidos&acao=lista" >Responder pedidos de oração e testemunhos</a>
                        </li>
                        <li>
                            <a href="?pagina=centraldecontrole/imprimirIntencoes" target="_blank">Imprimir pedidos de oração</a>
                        </li>
                        <li {if $sPagina == 'relatoriosPublicos'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/relatorioPedidoPublico" >Relatórios de pedidos públicos</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Relatórios</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li>
                            <a href="?pagina=centraldecontrole/relatorioColaborador" target="_blank">Colaboradores cadastrados</a>
                        </li>
                        <li>
                            <a href="?pagina=centraldecontrole/imprimirNoticias" target="_blank">Notícias</a>
                        </li>
                    </ul>
                </li>
                <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Configurações</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    {if $smarty.session.PERMISSOES.CADASTRAR_USUARIO == 'S'}
                        <li {if $sMenu == 'usuarios'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/usuario&acao=lista">Usuários</a>
                        </li>
                    {/if}
                    {if $smarty.session.CODIGO <> 1}
                        <li {if $sPagina == 'alterarSenha'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/alterarSenha">Alterar Senha</a>
                        </li>
                    {/if}
                    {if $smarty.session.PERMISSOES.CADASTRAR_CONFIGURACOES == 'S'}
                        <li {if $sPagina == 'boleto'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/boleto">Boleto</a>
                        </li>
                        <li {if $sPagina == 'parametros'}class="active"{/if}>
                            <a href="?pagina=centraldecontrole/parametros">Parâmetros</a>
                        </li>
                    {/if}
                </ul>
            </li>
            </section>
            <!-- /.sidebar -->
        </aside>
        <!-- ./aside -->

        <div class="content-wrapper">
            <section class="content" style="height: 100%;">
                {block name="body"}{/block}
            </section>
        </div>
    </div>
       
    <script type="text/javascript" src="{$WWW_JS}jquery-3.2.1.min.js"></script>
    <script src="{$WWW_JS}centraldecontrole/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript" src="{$WWW_JS}centraldecontrole/bootstrap.min.js"></script>
    <script type="text/javascript" src="{$WWW_JS}centraldecontrole/app.min.js"></script>
    
    {block name="js"}{/block}
</body>
</html>