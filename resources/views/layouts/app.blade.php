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
<body>
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
            @if($usuario->empresas)

                <div class="btn-group">
                    <button type="button" data-log="7" class="log btn blue dropdown-toggle" data-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fa fa-refresh"></i>
                        <span class="hidden-sm hidden-xs">Cambiar Empresa</span>
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @if(count($usuario->empresas) > 1)
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
                        @else
                            <li>
                                <a href="javascript:;" onclick="cambiaRFC({{$usuario->empresas->id_empresa}})">
                                    @if($usuario->empresas->id_empresa==\Illuminate\Support\Facades\Session::get('empresa')->id_empresa)
                                        <i class="fa fa-check"></i>
                                    @endif
                                    {{ str_limit($usuario->empresas->razon_social,33,"...") }}
                                </a>
                            </li>
                        @endif
                        <li role="separator" class="divider"></li>
                        <!-- PEGAR VIP -->
                    </ul>
                </div>
            @else
                <h4>"Bienvenido " {{ucwords(mb_strtolower($s_nombre))}}</h4>
            @endif
        </div>
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <!-- PEGAR CONTENIDO -->
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>


@yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
