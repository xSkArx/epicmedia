@extends('layouts.app')

@section('content')
    @php($uri = Route::current()->uri)
    <style>
        .noselect {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .block {
            -webkit-filter: blur(3px);
            filter: blur(3px);
        }

        .upgrade-cover {
            background-color: rgba(255, 255, 255, .85);
            height: 100%;
            width: 100%;
            position: absolute;
            border-top: 1px dashed grey;
            z-index: 99;

        }
    </style>
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

    <div class="row">
        <div class="col-md-12">

            <div class="portlet light portlet-fit ">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-cloud-upload font-dark"></i>
                        <span class="caption-subject font-dark sbold uppercase">{{$html['titulo']}}</span>
                    </div>
                    <div class="actions" style="/*display: none*/">
                        <div class="btn-group">
                            @if($usuario->vip)
                                <button type="button" data-log="8"
                                        class="log btn {{$html['color']}} dropdown-toggle btn-sm" data-toggle="dropdown"
                                        aria-expanded="true">
                                    <span class="hidden-sm hidden-xs">Filtrar por Tipo</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    @if(Input::has('tipo_cfdi'))
                                        <li>
                                            <a href="/{{$uri}}"
                                               style="margin-top: 10px;text-align: center"><b>MOSTRAR TODOS</b></a>
                                        </li>
                                        <li class="divider"></li>
                                    @endif

                                    <li>
                                        <a href="/{{$uri}}?tipo_cfdi=1{{Input::has('proveedor') ? "&proveedor=" . Input::get('proveedor') : ""}}">FACTURA</a>
                                    </li>
                                    <li>
                                        <a href="/{{$uri}}?tipo_cfdi=2{{Input::has('proveedor') ? "&proveedor=" . Input::get('proveedor') : ""}}">NOTA
                                            DE
                                            CRÉDITO</a>
                                    </li>
                                    <li>
                                        <a href="/{{$uri}}?tipo_cfdi=3{{Input::has('proveedor') ? "&proveedor=" . Input::get('proveedor') : ""}}">NÓMINA</a>
                                    </li>
                                    <li>
                                        <a href="/{{$uri}}?tipo_cfdi=4{{Input::has('proveedor') ? "&proveedor=" . Input::get('proveedor') : ""}}">CANCELADAS</a>
                                    </li>

                                </ul>
                            @else
                                <button type="button" class=" btn {{$html['color']}} dropdown-toggle btn-sm"
                                        data-target="#paquete_expirado" data-toggle="modal" aria-expanded="true">
                                    <span class="hidden-sm hidden-xs">Filtrar por Tipo</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            @endif
                        </div>
                        <div class="btn-group">
                            @if($usuario->vip)
                                <button type="button" data-log="9"
                                        class="log btn {{$html['color']}} dropdown-toggle btn-sm" data-toggle="dropdown"
                                        aria-expanded="true">
                                    <span class="hidden-sm hidden-xs">Filtrar por {{$html['filtrar']}}</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>

                                <ul class="dropdown-menu pull-right" role="menu">
                                    @if(Input::has('tipo_cfdi'))
                                        <li>
                                            <a href="/{{$uri}}"
                                               style="margin-top: 10px;text-align: center"><b>MOSTRAR TODOS</b></a>
                                        </li>
                                        <li class="divider"></li>
                                    @endif

                                    @foreach($proveedores as $rfc => $proveedor)
                                        <li>
                                            <a href="/{{$uri}}?proveedor={{$rfc}}">
                                                {{ ($proveedor) ? str_limit($proveedor[0], 40) : $rfc . " (SIN RAZÓN SOCIAL)" }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <button type="button" class=" btn {{$html['color']}} dropdown-toggle btn-sm"
                                        data-target="#paquete_expirado" data-toggle="modal" aria-expanded="true">
                                    <span class="hidden-sm hidden-xs">Filtrar por Proveedor</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            @endif
                        </div>
                        <div class="btn-group">
                            @if($usuario->vip)
                                <button type="button" class="btn {{$html['color']}} dropdown-toggle btn-sm"
                                        data-toggle="dropdown" aria-expanded="true">
                                    <span class="hidden-sm hidden-xs">Exportar</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a data-log="10" class="log"
                                           href="formatos_xls/{{$html['xls']}}.php{{Input::has('proveedor') ? "?proveedor=". Input::get('proveedor') : ""}}<?=@$link_tipo?>">Exportar
                                            Excel</a>
                                    </li>

                                    <li>
                                        <a data-log="11" class="log"
                                           href="download_zip.php?&m={{$html['zip']}}{{Input::has('proveedor') ? "&proveedor=". Input::get('proveedor') : ""}}<?=@$link_tipo?>"
                                           data-target="#descargarZip" data-toggle="modal">Descargar Archivos XML</a>
                                    </li>
                                </ul>
                            @else
                                <button type="button" class=" btn {{$html['color']}} dropdown-toggle btn-sm"
                                        data-target="#paquete_expirado" data-toggle="modal" aria-expanded="true">
                                    <span class="hidden-sm hidden-xs">Exportar</span>
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    @if($usuario->vip && $facturas->count() > 0)
                        <div class="row">
                            <div class="col-md-12 contador" style="text-align: right;">
                                <span class="font-{{$html['color']}}" id="datos_top" style="display: none">
                                    <strong>$ <span
                                                id="monto_facturas"></span> en <span>{{$facturas->count()}}</span> {{$facturas->count() > 1 ? "CFDIs" : "CFDI"}}</strong>
                                </span>
                            </div>
                        </div>
                    @endif
                    @if($facturas->count() > 0)
                        <div class="table-scrollable table-scrollable-borderless" id="facturas">
                            <table class="table table-hover facts" style="/*display:none*/">
                                <thead>
                                <tr class="uppercase">
                                    <th width="70">
                                        @php($uri2 = Input::has('tipo') ? (Input::get('tipo')==1?"&tipo=2" : "&tipo=1"):"&tipo=1".(Input::has('proveedor') ? "&proveedor=".Input::get('proveedor'):""))
                                        <a href="/{{$uri}}?ordena=1{{$uri2}}">Fecha &nbsp;<i class="fa fa-sort"></i></a>
                                    </th>
                                    <th>
                                        <a href="/{{$uri}}?ordena=2{{$uri2}}">RFC &nbsp;<i class="fa fa-sort"></i></a>
                                    </th>
                                    <th class="hidden-xs">
                                        <a href="/{{$uri}}?ordena=3{{$uri2}}">Razón Social &nbsp;<i
                                                    class="fa fa-sort"></i></a>
                                    </th>
                                    <th class="visible-lg hidden-xs" width="140">
                                        <a href="/{{$uri}}?ordena=4{{$uri2}}">Método &nbsp;<i
                                                    class="fa fa-sort"></i></a>
                                    </th>
                                    <th class="visible-lg hidden-xs" width="100">
                                        <a href="/{{$uri}}?ordena=5{{$uri2}}">Tipo &nbsp;<i class="fa fa-sort"></i></a>
                                    </th>
                                    <th class="hidden-xs" width="80" align="right">
                                        <a href="/{{$uri}}?ordena=6{{$uri2}}">Sub Total &nbsp;<i class="fa fa-sort"></i></a>
                                    </th>
                                    <th class="hidden-xs" width="80" align="right">
                                        <a href="/{{$uri}}?ordena=7{{$uri2}}">IVA &nbsp;<i class="fa fa-sort"></i></a>
                                    </th>
                                    <th width="80" align="right">
                                        <a href="/{{$uri}}?ordena=8{{$uri2}}">Total &nbsp;<i class="fa fa-sort"></i></a>
                                    </th>
                                    <th width="90"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $i = 0;
                                    $contador_bloqueo = 1;
                                @endphp
                                @foreach($facturas as $factura)
                                    @if(!$usuario->vip)
                                        @if($contador_bloqueo > 5 && $facturas->count() > 5)
                                            @php
                                                $css_block = "block1 noselect";
                                                $tr_only = "limited";
                                                $nohover ="background:white;cursor:pointer"
                                            @endphp
                                        @else
                                            @php
                                                unset($css_block);
                                                unset($nohover);
                                            @endphp
                                        @endif
                                    @endif
                                    <tr style="<?=@$nohover?>" class="<?=@$tr_only?>">
                                        <td class="<?=@$css_block?>"><?=strtoupper(Date::parse($factura->fecha)->format('d/M/Y'))?></td>
                                        <td class="<?=@$css_block?>">
                                            <strong>
                                                @if(empty($css_block))
                                                    {{$factura->rfc}}
                                                @else
                                                    {{"Limitado"}}
                                                @endif
                                            </strong>
                                        </td>
                                        <td class="hidden-xs <?=@$css_block ?>">
                                            {{empty($css_block) ? $factura->razon_social : "Limitado"}}
                                        </td>
                                        <td class="visible-lg hidden-xs <?=@$css_block ?>">
                                            {{empty($css_block) ? $factura->metodo_real : "Limitado"}}
                                        </td>
                                        <td class="visible-lg hidden-xs <?=@$css_block ?> {{(!Input::has('cfdi')) ? ($factura->id_tipo_cfdi != 1 ? "font-red" : "") :""}}">
                                            @if (strtoupper($factura->id_tipo_cfdi) == 1)
                                                FACTURA
                                            @elseif (strtoupper($factura->id_tipo_cfdi) == 2)
                                                NOTA DE CRÉDITO
                                            @elseif (strtoupper($factura->id_tipo_cfdi) == 3)
                                                NÓMINA
                                            @elseif (strtoupper($factura->id_tipo_cfdi) == 4)
                                                CANCELADA
                                            @endif
                                        </td>
                                        <td class="hidden-xs text-right <?=@$css_block?> {{(!Input::has('cfdi')) ? ($factura->id_tipo_cfdi != 1 ? "font-red" : "") :""}}">
                                            {{number_format($factura->subtotal,2)}}
                                        </td>
                                        <td class="hidden-xs text-right <?=@$css_block?> {{(!Input::has('cfdi')) ? ($factura->id_tipo_cfdi != 1 ? "font-red" : "") :""}}">
                                            {{number_format($factura->importe,2)}}
                                        </td>
                                        <td class="text-right <?=@$css_block?> {{(!Input::has('cfdi')) ? ($factura->id_tipo_cfdi != 1 ? "font-red" : "") :""}}">
                                            {{number_format($factura->total,2)}}
                                        </td>
                                        <td class="text-right <?=@$css_block?>">
                                            @if(empty($css_block))
                                                @if($usuario->vip)
                                                    <span class="label"><a data-log="12" class="log"
                                                                           href="formatos/factura_html.php?t={{$html['factura_html']}}&i=<?=$factura->{$html['id_factura']}?>"
                                                                           data-target="#verFactura"
                                                                           data-toggle="modal"> VER </a></span>
                                                    &nbsp;
                                                    <span class="label"><a data-log="14" class="log"
                                                                           href="{{$html['dfact']}}.php?id_factura=<?=$factura->{$html['id_factura']}?>"> XML</a></span>
                                                @else
                                                    <span class="label"><a data-target="#paquete_expirado"
                                                                           data-toggle="modal"> VER </a></span>&nbsp;
                                                    <span class="label"><a data-target="#paquete_expirado"
                                                                           data-toggle="modal"> XML</a></span>
                                                @endif

                                            @else
                                                <span class="label"><a data-target="#paquete_expirado"
                                                                       data-toggle="modal"> VER </a></span>
                                                &nbsp;
                                                <span class="label"><a data-target="#paquete_expirado"
                                                                       data-toggle="modal"> XML</a></span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php($contador_bloqueo++)
                                @endforeach
                                </tbody>
                            </table>
                            <div class="p-l-px23 p-r-px23 p-t-px20 p-b-px20 upgrade-cover"
                                 style="display: none;margin-left: -20px;" id="upgradeCover">
                                <div class="p-t-px16 p-b-px16 p-l-px25 p-r-px25"
                                     style="padding-left: 26px;margin-right: 20px">
                                    <h2><strong>Suscríbete para ver todas tus facturas.</strong></h2>
                                    <p>Tu plan ha expirado y solo puedes ver 5 facturas. <br>Por favor suscríbete a un plan
                                        para ver más.</p>
                                    <p>
                                        <a class="btn btn-primary green" href="?Modulo=Paquetes">Ver Planes</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            $('#monto_facturas').html('<?=$facturas->sum("total")?>');
            $('#datos_top').fadeIn();
            $('.actions').fadeIn();
        });
    </script>
@endsection