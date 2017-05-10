@extends('layouts.app')

@section('content')
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i style="color:{{$bread['color']}}" class="{{$bread['icono']}}"></i>
                <span><b style="color:{{$bread['color']}}">{{$bread['texto']}}</b> <span
                            id="status">{!! $sesionEmpresa->status !!}</span></span>
            </li>
        </ul>
        @if(!$bread['refresh'])
            <div class="page-toolbar ">
                <div class="btn-group pull-right">
                    @if($usuario->vip)
                        <form action="/app" method="post" id="form_tipo_fecha">
                            <input type="hidden" name="tipo_fecha" value="1" id="tipo_fecha">
                            {{ csrf_field() }}
                        </form>
                        <button type="button" data-log="6" class="log btn btn-fit-height blue dropdown-toggle"
                                data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-calendar-check-o"></i>
                            <span class="hidden-sm hidden-xs">Viendo del {{$fechas[0]->format('d M Y')}}
                                al {{$fechas[1]->format('d M Y')}}</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">

                            <li><a href="javascript:;" onclick="tipoFecha(1)">MES EN CURSO</a></li>
                            <li><a href="javascript:;" onclick="tipoFecha(2)">MES ANTERIOR</a></li>
                            <li><a href="javascript:;" onclick="tipoFecha(3)">AÑO EN CURSO</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#cambiaFechas" data-toggle="modal" data-backdrop="static"
                                   data-keyboard="false">RANGO DE FECHAS</a></li>
                        </ul>
                    @else
                        <button type="button" class="btn btn-fit-height blue dropdown-toggle"
                                data-target="#paquete_expirado" data-toggle="modal" aria-expanded="false">
                            <i class="fa fa-calendar-check-o"></i>
                            <span class="hidden-sm hidden-xs">Viendo del {{$fechas[0]->format('d M Y')}}
                                al {{$fechas[1]->format('d M Y')}}</span>
                            <i class="fa fa-angle-down"></i>
                        </button>
                    @endif
                </div>
            </div>
        @endif
    </div>
    @if(!$sesionEmpresa->primera_descarga)
        @if(!$usuario->vip)
            @include('app.note_block')
        @endif
    @endif
    <script>
        $(function () {
            @if($facturas['emitidas']->count() > 0)
            App.blockUI({
                target: "#datos_ingresos",
                animate: !0
            });
            setTimeout(function () {
                App.unblockUI("#datos_ingresos");
            }, 3000);
            @endif
            @if($facturas['recibidas']->count() > 0)
            App.blockUI({
                target: "#datos_egresos",
                animate: !0
            });
            setTimeout(function () {
                App.unblockUI("#datos_egresos");
            }, 3000);
            @endif

        });
    </script>
    <div class="row">
        @include('app.tabla.ingresos')
        @include('app.tabla.gastos')
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-pie-chart font-green-sharp"></i>
                        <span class="caption-subject font-green-sharp bold uppercase">Cálculo aproximado de IVA</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 " style="margin-bottom: 0;">
                                <div class="display" style="margin-bottom: 0;">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <small>$</small>
                                            <span data-counter="counterup"
                                                  data-value="{{number_format($facturas['emitidas']->sum('importe'),2)}}">0.00</span>
                                        </h3>
                                        <small>IVA de Ingresos</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 " style="margin-bottom: 0;">
                                <div class="display" style="margin-bottom: 0;">
                                    <div class="number">
                                        <h3 class="font-red-haze">
                                            <small>$</small>
                                            <span data-counter="counterup"
                                                  data-value="{{number_format($facturas['recibidas']->sum('importe'),2)}}">0.00</span>
                                        </h3>
                                        <small>Iva de Gastos (Acreditable*)</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <div class="dashboard-stat2 " style="margin-bottom: 0;">
                                <div class="display" style="margin-bottom: 0;">
                                    <div class="number">
                                        <h3 class="font-green-sharp">
                                            <small>$</small>
                                            <span data-counter="counterup"
                                                  data-value="{{number_format($facturas['emitidas']->sum('importe') - $facturas['recibidas']->sum('importe'),2)}}">0.00</span>
                                        </h3>
                                        <small>IVA Pendiente*</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($usuario->vip)
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light ">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-red-sunglo hide"></i>
                            <span class="caption-subject font-{{$charts[2]}} sbold uppercase">{{$charts[3]}} </span>
                            <span class="caption-helper"> mes a mes</span>
                        </div>

                        <div class="actions">
                            <div class="btn-group btn-group-devided" data-toggle="buttons">
                                <div class="btn-group">
                                    <form method="post" action="app" id="frm_tipo_chart">
                                        {{csrf_field()}}
                                        <input type="hidden" id="tipo_chart" name="tipo_chart">
                                        <button type="button" data-log="2" onclick="tipoChart('emitidas')"
                                                class="log btn {{$charts[1]}}">
                                            INGRESOS <?= date('Y') ?></button>
                                        <button type="button" data-log="3" onclick="tipoChart('recibidas')"
                                                class="log btn {{$charts[0]}}">
                                            GASTOS <?= date('Y') ?></button>
                                    </form>
                                    <script>
                                        function tipoChart(str) {
                                            $("#tipo_chart").val(str).parent().submit();
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="portlet-body">
                        <div id="site_activities_loading">
                            <img src="assets/global/img/loading.gif" alt="loading"/>
                        </div>
                        <div id="site_activities_content" class="display-none">
                            <div id="site_activities" style="height: 228px;"></div>
                        </div>
                        <div style="margin: 20px 0 10px 30px">
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-info"> TOTAL <?= date('Y') ?>: </span>
                                    <h3>$ {{$charts[4]}}</h3>
                                </div>
                                <div class="col-md-3 col-sm-3 col-xs-6 text-stat">
                                    <span class="label label-sm label-info"> IVA <?= date('Y') ?>: </span>
                                    <h3>$ {{$charts[5]}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>

        </div>
    @endif

    <!--MODAL FECHAS-->
    <div class="modal fade" id="cambiaFechas">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span
                                class="sr-only">Cerrar</span></button>
                    <h4 class="modal-title"><i class="icon-calendar"></i> Filtrado por Fechas</h4>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger display-hide" role="alert" id="fechas_msg_error"></div>
                    <div class="alert alert-success display-hide" role="alert" id="fechas_msg_ok"></div>
                    <form id="frm_fechas" class="form-horizontal" action="app" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-md-4">Seleccione Rango: </label>
                            <div class="col-md-8">

                                <div class="input-group">
                                    <input type="text" class="form-control" id="define_fecha" name="rango_fechas">
                                    <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Cerrar</button>
                    <button type="submit" class="btn blue btn_ac" onclick="$('#frm_fechas').submit()">Filtrar</button>
                </div>
            </div>
        </div>
    </div>


@endsection
