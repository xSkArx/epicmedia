<div class="col-md-6 col-sm-6">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-cloud-upload font-red"></i>
                <span class="caption-subject font-red sbold uppercase">gastos</span> <span
                        class="caption-helper"> del {{strtoupper($fechas[0]->format('d/M/Y'))}}
                    al {{strtoupper($fechas[1]->format('d/M/Y'))}}</span>
            </div>
        </div>
        <div class="portlet-body gastos_shep">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-stat red">
                        <div class="visual">
                            <i class="fa fa-cloud-download"></i>
                        </div>
                        <div class="details">
                            <div class="number">Total: $ <span data-counter="counterup"
                                                               data-value="{{number_format($facturas['recibidas']->sum('total'), 2)}}">0.00</span>
                            </div>
                            <div class="desc"><span data-counter="counterup"
                                                    data-value="{{$facturas['recibidas']->count()}}">0</span> {{($facturas['recibidas']->count() == 1) ? 'Factura' : 'Facturas'}}
                            </div>
                        </div>
                        <a class="more" href="app/facturas/gastos"> Consultar
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(!$facturas['recibidas']->count())
                        @if(!$sesionEmpresa->primera_descarga)
                            <h4>
                                <center>No se encontraron facturas de gastos.</center>
                            </h4>
                        @endif
                    @else
                        <div class="portlet-body">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#overview_1" data-toggle="tab"> Facturas </a>
                                    </li>
                                    @if($usuario->vip)
                                        <li>
                                            <a href="#overview_2" data-toggle="tab"> Proveedores </a>
                                        </li>
                                        <li>
                                            <a href="#overview_3" data-toggle="tab"> Métodos de Pago </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content scroller" id="datos_gastos" style="height: 400px;"
                                     data-always-visible="1" data-rail-visible="0">
                                    <!--Facturas-recibidas-->
                                    <div class="tab-pane active" id="overview_1">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="110"> Fecha</th>
                                                    <th> Razón Social</th>
                                                    <th> Total</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($facturas['recibidas'] as $factura)
                                                    <tr>
                                                        <td>{{strtoupper(Jenssegers\Date\Date::parse($factura->fecha)->format('d/M/Y'))}}</td>
                                                        <td>{{$factura->razon_social}}</td>
                                                        <td align="right">{{number_format($factura->total, 2)}}</td>
                                                        <td>

                                                            @if (!$usuario->vip)
                                                                <span class="label label-sm font-grey-mint"> <a
                                                                            data-target="#paquete_expirado"
                                                                            data-toggle="modal"> VER </a> </span>

                                                            @else
                                                                <span class="label label-sm font-grey-mint"> <a
                                                                            href="formatos/factura_html.php?t=2&i={{$factura->id_factura_recibida}}"
                                                                            data-target="#verFactura"
                                                                            data-toggle="modal"> VER </a> </span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @if($usuario->vip)
                                        <div class="tab-pane" id="overview_2">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th> Proveedor</th>
                                                        <th> Total</th>
                                                        <th></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $ff = $facturas['recibidas']->groupBy('rfc')->sortByDesc(function ($rfc) {
                                                            return $rfc->sum('total');
                                                        });
                                                    @endphp
                                                    @foreach ($ff as $rfc => $factura)
                                                        <tr>
                                                            <td>
                                                                {{$factura->first()->razon_social}}
                                                            </td>
                                                            <td align="right"> {{number_format($factura->sum('total'), 2)}}</td>
                                                            <td>
                                                                <span class="label label-sm font-grey-mint"><a
                                                                            href="facturas/ingresos/proveedor/{{$rfc}}"> VER </a></span>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="overview_3">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th> Método de Pago</th>
                                                        <th> Total</th>
                                                        <!--<th> </th>-->
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @php
                                                        $ff = $facturas['recibidas']->groupBy('metodo_real')->sortByDesc(function ($rfc) {
                                                            return $rfc->sum('total');
                                                        });
                                                    @endphp
                                                    @foreach ($ff as $metodo_real => $factura)
                                                        <tr>
                                                            <td>
                                                                {{$metodo_real}}
                                                            </td>
                                                            <td align="right"> {{number_format($factura->sum('total'), 2) }} </td>
                                                            <!--<td>
                                                                <span class="label label-sm font-grey-mint"> VER </span>
                                                            </td>-->
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($facturas['recibidas']->count())
                        <p class="text-right">
                            <br/>
                            <a data-log="5" class="log btn btn-sm red" href="app/facturas/gastos">Ir a
                                gastos</a>
                        </p>
                    @endif
                </div>
            </div>
            @if(!$usuario->vip)
                @if($sessionEmpresa->facturasRecibidas->count() >= 5)
                    <center><span>Últimas 5 Facturas<br><a href="app/planes" style="text-decoration: underline">Mejora tu Plan para ver más</a><br></span>
                    </center>
                @endif
            @endif
        </div>
    </div>
</div>