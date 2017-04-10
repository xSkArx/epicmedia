<?
session_start();
if ($_SESSION['s_id']) header('Location: /app/');
$menu = isset($_GET['Menu']) ? $_GET['Menu'] : NULL; ?>
        <!DOCTYPE html>
<html data-pageloader="y" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="vo72Vf7bcUQCIavm-BlSHXzKokCNfkrxPvGZZCHXcJk"/>
    <title>ADMINUS · Tus Facturas a un click.</title>

    <!--pageMeta-->

    <!-- Lib CSS -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700%7COpen+Sans:400,300,300italic,400italic,600,700,600italic,700italic,800,800italic'
          rel='stylesheet' type='text/css'>
    <link href="minify/rgen_min.css" rel="stylesheet">

    <link href="css/custom.css" rel="stylesheet">
    <link href="css/forms.css" rel="stylesheet">


    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/manifest.json">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="apple-mobile-web-app-title" content="Adminus">
    <meta name="application-name" content="Adminus">
    <meta name="theme-color" content="#ffffff">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <!--[if IE 9 ]>
    <script src="js/ie-matchmedia.js"></script><![endif]-->
    <script src="lib/jquery/jquery.min.js"></script>
</head>
<body>
<!-- Facebook Pixel Code -->
<script>
    !function (f, b, e, v, n, t, s) {
        if (f.fbq)return;
        n = f.fbq = function () {
            n.callMethod ?
                n.callMethod.apply(n, arguments) : n.queue.push(arguments)
        };
        if (!f._fbq) f._fbq = n;
        n.push = n;
        n.loaded = !0;
        n.version = '2.0';
        n.queue = [];
        t = b.createElement(e);
        t.async = !0;
        t.src = v;
        s = b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t, s)
    }(window,
        document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');

    fbq('init', '955511147894538');
    fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
               src="https://www.facebook.com/tr?id=955511147894538&ev=PageView&noscript=1"
    /></noscript>
<!-- End Facebook Pixel Code -->
<script>
    (function (i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
        a = s.createElement(o),
            m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
    })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

    ga('create', 'UA-84151842-1', 'auto');
    ga('send', 'pageview');

</script>
<div id="page" data-linkscroll='y'>


    <!--
    ************************************************************
    * Navigation
    ************************************************************ -->
    <nav class="nav-wrp nav-1" data-glass="y" data-sticky="y">
        <div class="container pd-0 bdr-b bdr-op-1 min-px-h100 flex-cc" data-rgen-sm="pd-lr-20 h-reset">
            <div class="flex-row gt0 middle-md">

                <!--=================================
                = Logo section
                ==================================-->
                <div class="flex-col-md-3">
                    <div class="nav-header">
                        <a class="navbar-brand" href="/"><img src="logoadmins_AZUL.png" alt="Adminus"
                                                              style="width: 220px;"></a>
                        <a class="nav-handle" data-nav=".nav" data-navopen="pe-7s-more" data-navclose="pe-7s-close"><i
                                    class="pe-7s-more"></i></a>
                    </div>
                </div><!-- // END : Column //  -->

                <!--=================================
                = Navigation links
                ==================================-->
                <div class="flex-col-md-9 align-r">
                    <div class="nav">
                        <!--
                        <ul class="nav-links sf-menu">
                            <li><a href="#features">Ventajas</a></li>
                        </ul>

                        <div class="nav-social mr-lr-10" data-rgen-md="hide">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-youtube"></i></a>
                        </div>
                        -->

                        <div class="nav-other">
                            <a href="#popup-login" class="btn btn-dark1 mini set-popup"><i
                                        class="fa fa-user mr-r-5"></i> Iniciar Sesión</a>&nbsp;&nbsp;&nbsp;
                            <a href="#popup-content" class="btn btn-color1 mini set-popup"><i
                                        class="fa fa-envelope-o mr-r-5"></i> Prueba Gratis</a>
                        </div><!-- // END : Contact button //  -->

                    </div><!-- // END : Nav //  -->

                </div><!-- // END : Column //  -->

            </div><!-- // END : row //  -->

        </div><!-- // END : container //  -->
    </nav>
    <!-- ************** END : Navigation **************  -->


@yield('content')



<!--
	************************************************************
	* Footer
	************************************************************ -->
    <footer class="pos-rel pd-tb-small bg-dark1" data-rgen-sm="pd-tb-small">
        <div class="container typo-light" data-rgen-sm="align-c">
            <div class="flex-row gt40 mb40">
                <div class="flex-col-md-6">
                    <p style="margin-bottom: 0px;"><a href="index.php" class="inline-block max-px-w150"><img
                                    src="logo.png" alt="logo"></a></p>
                    <p>Av. Álvaro Obregón 449-A <br>Centro 77000. Tel: (983) 83 3 21 89<br>Chetumal, Quintana Roo.</p>

                    <!--=========================================
                    =  Social links
                    =============================================-->
                    <a href="http://fb.com/adminusmx" target="_blank"
                       class="sq30 fs16 mr-r-4 rd-4 inline-flex flex-cc btn-white"><i class="fa fa-facebook"></i></a>
                    <a href="http://twitter.com/adminus_mx" target="_blank"
                       class="sq30 fs16 mr-r-4 rd-4 inline-flex flex-cc btn-white"><i class="fa fa-twitter"></i></a>
                    <!--<a href="#" target="_blank" class="sq30 fs16 mr-r-4 rd-4 inline-flex flex-cc btn-white" data-toggle="tooltip" data-placement="top" title="Proximamente"><i class="fa fa-google"></i></a>
                    <a href="#" target="_blank" class="sq30 fs16 mr-r-4 rd-4 inline-flex flex-cc btn-white" data-toggle="tooltip" data-placement="top" title="Proximamente"><i class="fa fa-youtube"></i></a>
                    <a href="#" target="_blank" class="sq30 fs16 mr-r-4 rd-4 inline-flex flex-cc btn-white" data-toggle="tooltip" data-placement="top" title="Proximamente"><i class="fa fa-tumblr"></i></a>-->
                    <ul class="list-1 op-07">
                        <li><a href="privacidad" class="txt-white">Aviso de Privacidad</a> | <a href="politicas"
                                                                                                class="txt-white">Términos
                                y Condiciones</a></li>
                    </ul>
                </div>
                <div class="flex-col-md-6" style="text-align: right">
                    <h2 class="title tiny">CONTÁCTANOS</h2>
                    <ul class="list-1 op-07">
                        <li><a href="#" class="txt-white">+52-(983)-83-3-2189</a></li>
                        <li><a href="mailto:hola@epicmedia.pro" class="txt-white">hola@epicmedia.pro</a></li>
                    </ul>
                </div>
                <!--
                                <div class="flex-col-md-3">
                                    <h2 class="title tiny">QUICK LINKS</h2>
                                    <ul class="list-1 op-07">
                                        <li><a href="#" class="txt-white">About us</a></li>
                                        <li><a href="#" class="txt-white">Help</a></li>
                                        <li><a href="#" class="txt-white">Contact us</a></li>
                                        <li><a href="#" class="txt-white">Term &amp; conditions</a></li>
                                        <li><a href="#" class="txt-white">Privacy policy</a></li>
                                    </ul>
                                </div>-->


            </div>

            <hr class="light">
            <p class="mr-0 op-05">Derechos Reservados ADMINUS© Powered by <a href="http://epicmedia.pro"
                                                                             target="_blank">EPICMEDIA</a></p>
        </div>
    </footer>
    <!-- ************** END : Footer section **************  -->


    <!-- form : "mfp-hide" Add this class before using -->
    <div id="popup-content" class="white-popup-block popup-content mfp-hide">
        <div class="pop-header align-c pd-b-0" data-rgen-sm="pd-20">
            <!--<p class="sq90 inline-flex flex-cc fs80 mr-0 txt-color1"><i class="pe-7s-mail"></i></p>-->
            <h2 class="title mr-0" data-rgen-sm="small">Prueba Adminus Gratis 30 días<br>
                <small>Descubre lo que Adminus puede hacer por ti.</small>
            </h2>
        </div>
        <div class="pop-body" data-rgen-sm="pd-20">
            <!-- form-block -->
            <div class="form-block">

                <form class="form-widget" id="frm_registra" action="register" method="post">
                    {{ csrf_field() }}
                    <div class="field-wrp">
                        <div class="form-group">

                            <div class="group">
                                <input type="text" name="nombre" id="nombre" autocomplete="off" title=" "
                                       maxlength="128" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Nombre</label>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="group">
                                <input type="text" name="celular" class="numero" autocomplete="off" id="telefono"
                                       title=" " maxlength="10" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Teléfono</label>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="group">
                                <input type="text" name="email" id="email" title=" " autocomplete="off" maxlength="128"
                                       required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Email</label>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="group">
                                <input type="password" name="password" id="contrasena" title=" " autocomplete="off"
                                       maxlength="64" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contraseña</label>
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="group">
                                <input type="password" name="password_confirmation" id="contrasena-confirm" title=" "
                                       autocomplete="off" maxlength="64" required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Confirmar Contraseña</label>
                            </div>
                        </div>
                    </div>

                    <p>Se recomienda contar con un <b>RFC</b> y <b>CIEC</b>.</p>

                    <div class="alert alert-danger nm" id="msg_data" style="display: none;"></div>
                    <center><span id="crea_cuenta" style="display: none;"><p class="title-sub" data-rgen-sm="small">Estamos creando tu cuenta <img
                                        src="//adminus.mx/app/assets/global/img/Preloader_3.gif" width="60"/></span></p>
                    </center>
                    <button type="submit" onclick="registra(this)"
                            class="btn solid btn-color1 btn-block mr-b-10 block btn-registro">REGISTRARSE
                    </button>
                    <button type="button" class="btn btn-dark1 btn-block mr-b-10 block cerrar">CANCELAR</button>
                </form><!-- / form -->

            </div><!-- / form block -->
        </div>
    </div><!-- /#popup-content -->


    <!-- Login -->
    <div id="popup-login" class="white-popup-block popup-content mfp-hide">
        <div class="pop-header align-c pd-b-0" data-rgen-sm="pd-20">
            <!--<p class="sq90 inline-flex flex-cc fs80 mr-0 txt-color1"><i class="pe-7s-mail"></i></p>-->
            <h2 class="title mr-0" data-rgen-sm="small">Inicia Sesión en Adminus</h2>
        </div>
        <div class="pop-body" data-rgen-sm="pd-20">
            <!-- form-block -->
            <div class="form-block">

                <form class="form-widget" action="login" method="post" id="frm_login">

                    <div class="field-wrp">

                        <div class="form-group">

                            <div class="group">
                                <input type="text" autocomplete="off" name="email" id="login_email" title=" " required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Email</label>
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="group">
                                <input type="password" name="password" id="login_contrasena" title=" " required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Contraseña</label>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <p><a href="#popup-password" class=" set-popup">¿Olvidaste tu contraseña?</a></p>
                    </div>
                    <div class="alert alert-danger nm" id="msg_data_login" style="display: none;"></div>
                    <center><span id="load_login" style="display: none;"><img
                                    src="//adminus.mx/app/assets/global/img/Preloader_3.gif" width="60"/></span>
                    </center>
                    <button type="submit" onclick="login(this)"
                            class="btn solid btn-color1 btn-block mr-b-10 block btn-login">INICIAR SESIÓN
                    </button>
                </form><!-- / form -->

            </div><!-- / form block -->
        </div>
    </div><!-- /#popup-content -->


    <!-- Contraseña -->
    <div id="popup-password" class="white-popup-block popup-content mfp-hide">
        <div class="pop-header align-c pd-b-0" data-rgen-sm="pd-20">
            <!--<p class="sq90 inline-flex flex-cc fs80 mr-0 txt-color1"><i class="pe-7s-mail"></i></p>-->
            <h2 class="title mr-0" data-rgen-sm="small">Recupera tu contraseña</h2>
        </div>
        <div class="pop-body" data-rgen-sm="pd-20">
            <!-- form-block -->
            <div class="form-block">

                <form class="form-widget" id="frm_login" method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}
                    <div class="field-wrp">
                        <p class="title-sub" data-rgen-sm="small" id="confirma">Ingresa tu email para enviarte tu acceso
                            de Adminus.</p>
                        <div class="form-group">

                            <div class="group" id="grupo_pass">
                                <input type="text" name="email" autocomplete="off" id="pass_email" title=" "
                                       required>
                                <span class="highlight"></span>
                                <span class="bar"></span>
                                <label>Email</label>
                            </div>
                        </div>

                    </div>
                    <div class="alert alert-danger nm" id="msg_data_pass" style="display: none;"></div>
                    <center><span id="load_pass" style="display: none;"><img
                                    src="//adminus.mx/app/assets/global/img/Preloader_3.gif" width="60"/></span>
                    </center>
                    <button type="submit" onclick="pass(this)"
                            class="btn solid btn-color1 btn-block mr-b-10 block btn-pass">RECUPERAR MI CONTRASEÑA
                    </button>
                    <button type="button" class="btn btn-dark1 btn-block mr-b-10 block cerrar" style="display: none;">
                        CERRAR
                    </button>
                </form><!-- / form -->

            </div><!-- / form block -->
        </div>
    </div><!-- /#popup-content -->


</div>
<!-- /#page -->
<script>
    $(function () {
        $('.cerrar').click(function () {
            $.magnificPopup.close();
        });
        $('#frm_registra').keyup(function (e) {

            if (e.keyCode == 13) {
                registra(this);
            }

        });

        $('#frm_login').keyup(function (e) {

            if (e.keyCode == 13) {
                login(this);
            }

        });


        $("#nombre").blur(function () {
            var nombre = $('#nombre').val();
            if (nombre) {
                $('#msg_data').hide();
                return false;
            }
        });

        $("#telefono").blur(function () {
            var telefono = $('#telefono').val();
            if (telefono) {
                $('#msg_data').hide();
                return false;
            }
        });

        $("#email").blur(function () {
            var email = $('#email').val();
            if (email) {
                expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!expr.test(email)) {
                    $('#msg_data').html("La dirección de correo " + email + " es incorrecta.");
                    $('#msg_data').show();
                    $('#email').focus();
                    return false;
                } else {
                    $('#msg_data').hide();
                    return false;
                }
            }
        });

        $("#contrasena").blur(function () {
            var contrasena = $('#contrasena').val();
            if (contrasena) {
                $('#msg_data').hide();
                return false;
            }
        });

    });
    function registra(el) {
        $('#msg_data2').hide();
        var nombre = $('#nombre').val();
        var telefono = $('#telefono').val();
        var email = $('#email').val();
        var contrasena = $('#contrasena').val();
        var contrasena_confirm = $('#contrasena-confirm').val();


        if (!nombre) {
            $('#msg_data').html('Es necesario que escriba su nombre.');
            $('#msg_data').show();
            $('#nombre').focus();
            return false;
        }

        if (!telefono) {
            $('#msg_data').html('Es necesario que escriba su número de teléfono.');
            $('#msg_data').show();
            $('#telefono').focus();
            return false;
        }

        if (!email) {
            $('#msg_data').html('Es necesario que escriba su dirección de E-mail.');
            $('#msg_data').show();
            $('#email').focus();
            return false;
        }

        if (!contrasena) {
            $('#msg_data').html('Es necesario que escriba una contraseña.');
            $('#msg_data').show();
            $('#contrasena').focus();
            return false;
        }

        if (contrasena != contrasena_confirm) {
            $('#msg_data').html('Las contraseñas no coinciden.').show();
            $('#contrasena-confirm').focus();
            return false;
        }

        $('.btn').hide();
        $('#crea_cuenta').show();
        //$('.btn').prop("disabled",true);
        var formulario = $('#frm_registra').serialize();
        fbq('track', 'Lead');
        /*$.post('ac/registro.php',formulario,function(data){
         if(data==1){

         window.open("app/index.php", "_self");
         }else{
         $('#msg_data').html(data);
         $('#msg_data').show();
         //$('.btn').prop("disabled",false);
         $('#crea_cuenta').hide();
         $('.btn').show();

         }
         });*/
        setTimeout(1000, function () {
            el.submit();
        });
    }

    function login(el) {

        /*var email = $('#login_email').val();
         var pass = $('#login_contrasena').val();

         $('.btn-login').hide();
         $('#load_login').show();

         $.post('app/ac/login.php','email='+email+'&pass='+pass,function(data) {
         if(data==1){
         window.location = 'app/index.php';
         }else{
         $('#msg_data_login').html(data);
         $('#msg_data_login').show('Fast');
         $('#load_login').hide();
         $('.btn-login').show();
         }
         });*/
        $('.btn-login').hide();
        $('#load_login').show();
        setTimeout(1000, function () {
            el.submit();
        })

    }

    function pass(el) {

        $('.btn-pass').hide();
        $('#load_pass').show();
        setTimeout(1000, function () {
            el.submit();
        })
    }
</script>
<!-- JavaScript -->
<script src="minify/rgen_min.js"></script>
<script async src="js/rgen.js"></script>
<div id="fb-root"></div>
<script>(function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7&appId=243054549068386";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
    window.smartlook || (function (d) {
        var o = smartlook = function () {
            o.api.push(arguments)
        }, h = d.getElementsByTagName('head')[0];
        var c = d.createElement('script');
        o.api = new Array();
        c.async = true;
        c.type = 'text/javascript';
        c.charset = 'utf-8';
        c.src = '//rec.smartlook.com/recorder.js';
        h.appendChild(c);
    })(document);
    smartlook('init', '28458242424f7144e7cac8437cc7c42135c1c6ee');
</script>
</body>
</html>