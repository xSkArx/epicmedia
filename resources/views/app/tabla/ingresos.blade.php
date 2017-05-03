<div class="col-md-6 col-sm-6">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption">
                <i class="icon-cloud-upload font-green-jungle"></i>
                <span class="caption-subject font-green-jungle sbold uppercase">INGRESOS</span> <span
                        class="caption-helper"> del {{strtoupper($fechas[0]->format('d/M/Y'))}}
                    al {{strtoupper($fechas[1]->format('d/M/Y'))}}</span>
            </div>
        </div>
        <div class="portlet-body ingresos_shep">
            <div class="row">
                <div class="col-md-12">
                    <div class="dashboard-stat green-jungle">
                        <div class="visual">
                            <i class="fa fa-cloud-upload"></i>
                        </div>
                        <div class="details">
                            <div class="number">Total: $ <span data-counter="counterup"
                                                               data-value="{{number_format($facturas['emitidas']->sum('total'), 2)}}">0.00</span>
                            </div>
                            <div class="desc"><span data-counter="counterup"
                                                    data-value="{{$facturas['emitidas']->count()}}">0</span> {{($facturas['emitidas']->count() == 1) ? 'Factura' : 'Facturas'}}
                            </div>
                        </div>
                        <a class="more" href="app/facturas/ingresos"> Consultar
                            <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if(!$facturas['emitidas']->count())
                        @if(!$sesionEmpresa->primera_descarga)
                            <h4>
                                <center>No se encontraron facturas de Ingresos.</center>
                            </h4>
                        @endif
                    @else
                        <div class="portlet-body">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#overview1_1" data-toggle="tab"> Facturas </a>
                                    </li>
                                    @if($usuario->vip)
                                        <li>
                                            <a href="#overview1_2" data-toggle="tab"> Clientes </a>
                                        </li>
                                        <li>
                                            <a href="#overview1_3" data-toggle="tab"> Métodos de Pago </a>
                                        </li>
                                    @endif
                                </ul>
                                <div class="tab-content scroller" id="datos_ingresos" style="height: 400px;"
                                     data-always-visible="1" data-rail-visible="0">
                                    <!--Facturas-emitidas-->
                                    <div class="tab-pane active" id="overview1_1">
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
                                                @foreach($facturas['emitidas'] as $factura)
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
                                                                            href="formatos/factura_html.php?t=2&i={{$factura->id_factura_emitida}}"
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
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($facturas['emitidas']->count())
                        <p class="text-right">
                            <br/>
                            <a data-log="5" class="log btn btn-sm green-jungle" href="app/facturas/ingresos">Ir a
                                Ingresos</a>
                        </p>
                    @endif
                </div>
            </div>
            @if(!$usuario->vip)
                @if($sessionEmpresa->facturasEmitidas->count() >= 5)
                    <center><span>Últimas 5 Facturas<br><a href="app/planes" style="text-decoration: underline">Mejora tu Plan para ver más</a><br></span>
                    </center>
                @endif
            @endif
        </div>
    </div>
</div>