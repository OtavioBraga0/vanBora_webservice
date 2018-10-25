<!-- Menu fixo -->
{*<div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a  href="?pagina=centraldecontrole/inicial" ><img style="max-height: 38px;float: left;margin-right: 10px;" src="{$WWW_IMG}centraldecontrole/logo.png"></a>
                <div class="nav-collapse collapse" style="display: flex; justify-content: space-around; align-items: center">
                    <ul class="nav">
                        <li class="dropdown {if ( $sMenu == 'layout' )} active {/if}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Conteúdo/Layout <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li {if $sPagina == 'postagens'}class="active"{/if}>
                                    <a href="?pagina=centraldecontrole/inicial">Postagens</a>
                                </li>
                                {*if $smarty.session.PERMISSOES.CADASTRAR_MENU == 'S'}
                                    <li {if $sPagina == 'menu'}class="active"{/if}>
                                        <a href="?pagina=centraldecontrole/menu&acao=lista">Menu</a>
                                    </li>
                                {/if
                                {*if $smarty.session.PERMISSOES.CADASTRAR_CARROSSEL == 'S'}
                                    <li {if $sPagina == 'carrossel'}class="active"{/if}>
                                        <a href="?pagina=centraldecontrole/carrossel&acao=lista">Carrossel</a>
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
                                <li {if $sPagina == 'cliente'}class="active"{/if}>
                                    <a href="?pagina=centraldecontrole/cliente">Depoimentos</a>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown {if ( $sMenu == 'multimidia' )} active {/if}">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown">Multimídia <b class="caret"></b></a>
                            <ul class="dropdown-menu">
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
                                {*<li {if $sPagina == 'anexos'}class="active"{/if}>
                                    <a href="?pagina=centraldecontrole/anexo">Anexos</a>
                                </li>
                                {*<li {if $sPagina == 'informativo'}class="active"{/if}>
                                    <a href="?pagina=centraldecontrole/informativo">Informativo</a>
                                </li>
                            </ul>
                        </li>
                        {if $smarty.session.PERMISSOES.ADMINISTRAR_ESPIRITUALIDADE == 'S'}
                            {*<li class="dropdown {if ( $sMenu == 'espiritualidade' )} active {/if}">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown">Espiritualidade<b class="caret"></b></a>
                                <ul class="dropdown-menu">
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
                        {/if}
                        {if $smarty.session.PERMISSOES.VISUALIZAR_RELATORIOS == 'S'}
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle " data-toggle="dropdown">Relatórios<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    {*<li>
                                        <a href="?pagina=centraldecontrole/relatorioColaborador" target="_blank">Colaboradores cadastrados</a>
                                    </li>
                                    <li>
                                        <a href="?pagina=centraldecontrole/imprimirNoticias" target="_blank">Notícias</a>
                                    </li>
                                 </ul>
                            </li>
                        {/if}
                        <li class="dropdown {if ( $sMenu == 'configuracoes' )} active {/if}">
                            <a href="#" class="dropdown-toggle " data-toggle="dropdown">Configurações<b class="caret"></b></a>
                            <ul class="dropdown-menu">
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
                                {*if $smarty.session.PERMISSOES.CADASTRAR_CONFIGURACOES == 'S'}
                                    <li {if $sPagina == 'boleto'}class="active"{/if}>
                                        <a href="?pagina=centraldecontrole/boleto">Boleto</a>
                                    </li>
                                    <li {if $sPagina == 'parametros'}class="active"{/if}>
                                        <a href="?pagina=centraldecontrole/parametros">Parâmetros</a>
                                    </li>
                                {/if
                            </ul>
                        </li>            
                        <li>
                            <a href="?pagina=centraldecontrole/logoff">Sair</a>
                        </li>
                    </ul>
                    <p class="navbar-text pull-right">
                        Usuário :
                        <b>{$smarty.session.NOME}</b>
                    </p>
                </div><!--/.nav-collapse -->
            </div>
        </div>
    </div>*}
    
<header class="main-header">
        <!-- Logo -->
        <a href="{$WWW}?pagina=centraldecontrole/inicial" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>
    
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
                    <li class="user-header">
                    <p>
                        {$smarty.session.NOME}
                    </p>
                    </li>
                    <!-- Menu Body -->
                    <li class="user-body">
                    <div class="row">
                        <div class="col-xs-4 text-center">
                        <a href="#">Followers</a>
                        </div>
                        <div class="col-xs-4 text-center">
                        <a href="#">Sales</a>
                        </div>
                        <div class="col-xs-4 text-center">
                        <a href="#">Friends</a>
                        </div>
                    </div>
                    <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                    <div class="pull-left">
                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                    </li>
                </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
            </div>
        </nav>
</header>

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
    <!-- search form -->
    <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
            <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
            </span>
        </div>
    </form>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu tree" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
            <li><a href="../../index.html"><i class="fa fa-circle-o"></i> Dashboard v1</a></li>
            <li><a href="../../index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a></li>
        </ul>
        </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Layout Options</span>
            <span class="pull-right-container">
            <span class="label label-primary pull-right">4</span>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="../layout/top-nav.html"><i class="fa fa-circle-o"></i> Top Navigation</a></li>
            <li><a href="../layout/boxed.html"><i class="fa fa-circle-o"></i> Boxed</a></li>
            <li><a href="../layout/fixed.html"><i class="fa fa-circle-o"></i> Fixed</a></li>
            <li><a href="../layout/collapsed-sidebar.html"><i class="fa fa-circle-o"></i> Collapsed Sidebar</a></li>
        </ul>
        </li>
        <li>
        <a href="../widgets.html">
            <i class="fa fa-th"></i> <span>Widgets</span>
            <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
            </span>
        </a>
        </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-pie-chart"></i>
            <span>Charts</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="../charts/chartjs.html"><i class="fa fa-circle-o"></i> ChartJS</a></li>
            <li><a href="../charts/morris.html"><i class="fa fa-circle-o"></i> Morris</a></li>
            <li><a href="../charts/flot.html"><i class="fa fa-circle-o"></i> Flot</a></li>
            <li><a href="../charts/inline.html"><i class="fa fa-circle-o"></i> Inline charts</a></li>
        </ul>
        </li>
        <li class="treeview active">
        <a href="#">
            <i class="fa fa-laptop"></i>
            <span>UI Elements</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu" style="display: none;">
            <li><a href="general.html"><i class="fa fa-circle-o"></i> General</a></li>
            <li class="active"><a href="icons.html"><i class="fa fa-circle-o"></i> Icons</a></li>
            <li><a href="buttons.html"><i class="fa fa-circle-o"></i> Buttons</a></li>
            <li><a href="sliders.html"><i class="fa fa-circle-o"></i> Sliders</a></li>
            <li><a href="timeline.html"><i class="fa fa-circle-o"></i> Timeline</a></li>
            <li><a href="modals.html"><i class="fa fa-circle-o"></i> Modals</a></li>
        </ul>
        </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-edit"></i> <span>Forms</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="../forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
            <li><a href="../forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
            <li><a href="../forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
        </ul>
        </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-table"></i> <span>Tables</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="../tables/simple.html"><i class="fa fa-circle-o"></i> Simple tables</a></li>
            <li><a href="../tables/data.html"><i class="fa fa-circle-o"></i> Data tables</a></li>
        </ul>
        </li>
        <li>
        <a href="../calendar.html">
            <i class="fa fa-calendar"></i> <span>Calendar</span>
            <span class="pull-right-container">
            <small class="label pull-right bg-red">3</small>
            <small class="label pull-right bg-blue">17</small>
            </span>
        </a>
        </li>
        <li>
        <a href="../mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
            <small class="label pull-right bg-yellow">12</small>
            <small class="label pull-right bg-green">16</small>
            <small class="label pull-right bg-red">5</small>
            </span>
        </a>
        </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Examples</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="../examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="../examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="../examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="../examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="../examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="../examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="../examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="../examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="../examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
        </li>
        <li class="treeview">
        <a href="#">
            <i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
            <li class="treeview">
            <a href="#"><i class="fa fa-circle-o"></i> Level One
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-circle-o"></i> Level Two</a></li>
                <li class="treeview">
                <a href="#"><i class="fa fa-circle-o"></i> Level Two
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Level Three</a></li>
                </ul>
                </li>
            </ul>
            </li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Level One</a></li>
        </ul>
        </li>
        <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li>
        <li class="header">LABELS</li>
        <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
        <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
    <li class="bg-green"><a href="https://themequarry.com"><i class="fa fa-star-o" style="color: rgb(255, 255, 255);"></i><span style="color: rgb(255, 255, 255);">Premium Templates</span></a></li></ul>
    </section>
    <!-- /.sidebar -->
</aside>