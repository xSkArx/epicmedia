@extends('welcome_base')
@section('content')
    <!--
	************************************************************
	* Intro section
	************************************************************ -->
    <section class="pd-0 pos-rel">

        <!--=================================
        = App screen shots
        ==================================-->
        <div class="container pos-rel z3 pd-t-150" data-rgen-sm="pd-t-30">
            <div class="w75 mr-auto align-c">
                <h1 class="title large bold-n mr-b-10" data-rgen-sm="fs30">Simple, poderoso y automatizado</h1>
                <p class="title-sub small" data-rgen-sm="fs16">ADMINUS organiza y descarga tus facturas desde el
                    <b>SAT</b> automáticamente.<br/>No tienes que hacer nada, solo tomar decisiones.</p>


                <a href="#popup-content" class="btn btn-color1 solid large set-popup" data-rgen-sm="medium bold-n">
                    <span class="btn-txt">Prueba Gratis por 30 días</span>
                </a>
            </div>
            <br/>
            <img src="images/intro-app-img-02.png" class="mr-auto -mr-b-100" data-rgen-sm="" alt="app-image">
        </div>

        <!--=================================
        = Features content
        ==================================-->
        <div class="pd-tb-small pos-rel align-c bg-color1 typo-light" data-rgen-sm="pd-tb-small">
            <div class="container">
                <div class="flex-row gt40 mr-t-80">
                    <div class="flex-col-md-4">
                        <div class="info-obj img-t g20 mini align-c pos-rel">
                            <div class="img txt-white"><span class="iconwrp"><i class="icon-upload"></i></span></div>
                            <div class="info">
                                <h3 class="title mini bold-2">En Automático</h3>
                                <p>Tus facturas se descargan y sincronizan desde el SAT automáticamente todos los
                                    días.</p>
                            </div>
                        </div>
                    </div><!-- column -->

                    <div class="flex-col-md-4">
                        <div class="info-obj img-t g20 mini align-c pos-rel">
                            <div class="img txt-white"><span class="iconwrp"><i class="icon-download"></i></span></div>
                            <div class="info">
                                <h3 class="title mini bold-2">Exporta</h3>
                                <p>Exporta tus XML masivamente directamente desde ADMINUS.</p>
                            </div>
                        </div>
                    </div><!-- column -->

                    <div class="flex-col-md-4">
                        <div class="info-obj img-t g20 mini align-c pos-rel">
                            <div class="img txt-white"><span class="iconwrp"><i class="icon-bargraph"></i></span></div>
                            <div class="info">
                                <h3 class="title mini bold-2">Reportes</h3>
                                <p>Descarga reportes en Excel con toda la información de tus facturas, con un solo
                                    click.</p>
                            </div>
                        </div>
                    </div><!-- column -->
                </div><!-- row -->
                <!--
                <hr class="light mr-tb-40">

                <ul class="logo-list gt-medium size-medium reset op-05">
                    <li><img src="images/award-logo-light-01.png" alt="award"></li>
                    <li><img src="images/award-logo-light-02.png" alt="award"></li>
                    <li><img src="images/award-logo-light-03.png" alt="award"></li>
                    <li><img src="images/award-logo-light-04.png" alt="award"></li>
                    <li><img src="images/award-logo-light-05.png" alt="award"></li>
                </ul>-->

            </div><!-- / container -->
        </div>
    </section>
    <!-- ************** END : Intro section **************  -->


    <!--
    ************************************************************
    * Content section
    ************************************************************ -->
@endsection