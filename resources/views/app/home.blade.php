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
                        <form action="app" method="post" id="form_tipo_fecha">
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


@endsection
