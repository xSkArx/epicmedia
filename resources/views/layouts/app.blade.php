<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title>ADMINUS · Tus Facturas a un click.</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="EPICMEDIA hola@epicmedia.pro" name="author"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="assets/global/plugins/pace/pace.min.js" type="text/javascript"></script>
    <link href="assets/global/plugins/pace/themes/pace-theme-flash.css" rel="stylesheet" type="text/css"/>

    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet"
          type="text/css"/>
    <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css"/>
    <link href="assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/pages/css/pricing.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css"/>
    <link href="assets/pages/css/invoice-2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/global/plugins/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="assets/layouts/layout2/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/layouts/layout2/css/themes/blue.min.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="assets/layouts/layout2/css/custom.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME LAYOUT STYLES -->


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="Adminus">
    <meta name="application-name" content="Adminus">
    <meta name="theme-color" content="#ffffff">

    <link href="assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet"
          type="text/css"/>

    <link href="assets/offline/offline-theme-chrome.css" rel="stylesheet" type="text/css"/>
    <link href="assets/offline/offline-language-spanish.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
    <script src='//cdn.zarget.com/99132/156573.js'></script>
</head>
<script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<!-- END HEAD -->
<style>
    .desactivado {
        color: #8896a0;
        font-style: italic;
        text-decoration: line-through;
    }

    .mayusculas {
        text-transform: uppercase;
    }
</style>

<script>
    window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
</script>
<body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid page-md">
<!-- BEGIN HEADER -->

<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
            <a href="index.php">
                <img src="logo.png" width="130" alt="logo" class="logo-default"/> </a>
            <div class="menu-toggler sidebar-toggler">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
           data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <div class="page-actions hidden-xs">
            @if($usuario->hasEmpresas())

                <div class="btn-group">
                    <button type="button" data-log="7" class="log btn blue dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fa fa-refresh"></i>
                        <span class="hidden-sm hidden-xs">Cambiar Empresa</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($usuario->empresas as $empresa)
                            <li>
                                <a href="javascript:;" onclick="cambiaRFC({{$empresa->id_empresa}})">
                                    @if($empresa->id_empresa==\Illuminate\Support\Facades\Session::get('empresa')->id_empresa)
                                        <i class="fa fa-check"></i>
                                    @endif
                                    {{ str_limit($empresa->razon_social,33,"...") }}
                                </a>
                            </li>
                        @endforeach
                        <li role="separator" class="divider"></li>
                        <!-- PEGAR VIP -->
                        @if($usuario->vip)
                            <li><a data-log="23" class="log" href="app/nueva_empresa">AGREGAR NUEVO RFC</a></li>
                        @else
                            <li><a data-target="#paquete_expirado" data-toggle="modal">AGREGAR NUEVO RFC</a></li>
                        @endif
                    </ul>
                </div>
            @else
                <h4>Bienvenido {{ucwords(mb_strtolower($usuario->nombre))}}</h4>
            @endif
        </div>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <!-- PEGAR CONTENIDO -->
        <div class="page-top">
            @if(\Illuminate\Support\Facades\Session::has('empresa'))
                <div class="top-menu hidden-xs hidden-sm hidden-md">
                    <h3 style="margin-right: 20px;">
                        {{substr(\Illuminate\Support\Facades\Session::get('empresa')->razon_social,0,53)}}
                    </h3>
                </div>

                <div class="top-menu hidden-xs hidden-lg">
                    <h3 style="margin-right: 20px;">
                        {{str_limit(\Illuminate\Support\Facades\Session::get('empresa')->razon_social, 0, 30, '...')}}
                    </h3>
                </div>

                <div class="row visible-xs">
                    <div class="col-xs-2 " style="text-align: left;">
                        @if(\Illuminate\Support\Facades\Session::has('empresa'))

                            <div class="btn-group" style="margin-top: 17px;margin-left: 10px;">
                                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false">
                                    <i class="fa fa-refresh"></i>
                                    <span class="hidden-sm hidden-xs">Cambiar Empresa</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    @if($usuario->hasEmpresas())
                                        @foreach($usuario->empresas as $empresa)
                                            <li>
                                                <a href="javascript:;" onclick="cambiaRFC({{$empresa->id_empresa}})">
                                                    @if($empresa->id_empresa==\Illuminate\Support\Facades\Session::get('empresa')->id_empresa)
                                                        <i class="fa fa-check"></i>
                                                    @endif
                                                    {{ str_limit($empresa->razon_social,33,"...") }}
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                    <li role="separator" class="divider"></li>
                                    @if($usuario->vip)
                                        <li><a data-log="23" class="log" href="app/nueva_empresa">AGREGAR NUEVO RFC</a>
                                        </li>
                                    @else
                                        <li><a data-target="#paquete_expirado" data-toggle="modal">AGREGAR NUEVO RFC</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        @else
                            <h4>Bienvenido {{ucwords(mb_strtolower($usuario->nombre))}}</h4>
                        @endif

                    </div>
                    <!-- Fechas -->
                    <div class="col-xs-10 col-md-12" style="text-align: right;">
                        <h3 style="margin-right: 20px;font-size: 20px;margin-top: 25px;">
                            {{str_limit(\Illuminate\Support\Facades\Session::get('empresa')->razon_social, 0, 25, '...')}}
                        </h3>
                    </div>
                </div>
            @else
                <div class="row visible-xs">
                    <div class="col-md-12">
                        <h3 style="margin-right: 20px;font-size: 20px;margin-top: 25px;">
                            Bienvenido {{ucwords(mb_strtolower($usuario->nombre))}}
                        </h3>
                    </div>
                </div>
        @endif
        <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false"
                data-auto-scroll="true" data-slide-speed="200">
                <!-- Activa con clases "active open"-->
                <li class="nav-item start {{ (Request::is('app') ? 'active' : '') }}">
                    <a href="app" class="nav-link nav-toggle">
                        <i class="icon-bar-chart"></i>
                        <span class="title">Indicadores</span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('app/facturas/ingresos') ? 'active' : '') }}">
                    <a href="app/facturas/ingresos" class="nav-link nav-toggle">
                        <i class="icon-cloud-download"></i>
                        <span class="title">Ingresos</span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('app/facturas/gastos') ? 'active' : '') }}">
                    <a href="app/facturas/gastos" class="nav-link nav-toggle">
                        <i class="icon-cloud-upload"></i>
                        <span class="title">Gastos</span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('app/gastos') ? 'active' : '') }}">
                    <a href="app/gastos" class="nav-link nav-toggle">
                        <i class="icon-social-dropbox"></i>
                        <span class="title">Mis Archivos</span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('app/planes') ? 'active' : '') }} ">
                    <a href="app/planes" class="nav-link nav-toggle">
                        <i class="icon-tag"></i>
                        <span class="title">Precios</span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('app/empresas') ? 'active' : '') }} ">
                    <a href="app/empresas" class="nav-link nav-toggle">
                        <i class="icon-grid"></i>
                        <span class="title">Mis Empresas (RFC)</span>
                        <span class="arrow"></span>
                    </a>
                </li>


                <li class="nav-item {{ (Request::is('app/perfil') ? 'active' : '') }} ">
                    <a href="app/perfil" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">Mis Datos</span>
                        <span class="arrow"></span>
                    </a>
                </li>

                <li class="nav-item {{ (Request::is('app/soporte') ? 'active' : '') }} ">
                    <a href="app/soporte" class="nav-link nav-toggle">
                        <i class="icon-envelope"></i>
                        <span class="title">Contacto</span>
                        <span class="arrow"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('logout')}}" data-log="27" class="log nav-link nav-toggle"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class=" icon-logout"></i>
                        <span class="title">Salir</span>
                        <span class="arrow"></span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                          style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <div class="alert alert-info alert-dismissable visible-xs hidden-print">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <strong>Adminus</strong> se ve mejor en una computadora :)
            </div>
        @if (\Illuminate\Support\Facades\Session::has('empresa') && \Illuminate\Support\Facades\Session::get('empresa')->activo)<!-- si es primera descarga = 0 -->
            @if (\Illuminate\Support\Facades\Session::get('empresa')->rfc_valido == 0)
                <div class="alert alert-block alert-danger fade in">
                    <h4 class="alert-heading" style="font-weight: 500;">¡Error! </h4>
                    <p>Adminus no se puede conectar a tu Portal del SAT:<br>Contraseña CIEC inválida, actualízala de
                        inmediato para reanudar la sincronización.<br></p>
                    @if (!Request::is('app/perfil')) { ?>
                    <p>
                        <a class="btn red" href="app/empresas"> Actualizar contraseña CIEC </a>
                    </p>
                    @endif
                </div>
            @endif
        @endif

        @yield('content')


        <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
