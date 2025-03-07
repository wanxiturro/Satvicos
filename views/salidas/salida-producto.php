<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-md-12">
                    <div class="m-0 text-dark text-center text-lg">
                        <i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Orden de salida
                    </div>
                </div>
            </div>
            <div style="max-width: 1140px; margin: 0 auto;"></div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div style="max-width: 1140px; margin: 0 auto;">
                <div class="row mb-3">
                    <div class="col-md-6 float-right">
                        <div class="row">
                        </div>
                    </div>
                </div>
                <form id="FRM_INSERT_SALIDA" method="post" action="../../modules/salidas/pdf-salida.php" enctype="multipart/form-data" target="_blank">
                    <input type="hidden" name="id_salida">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-title">Datos de salida</div>
                                </div>
                                <div class="col-md-9">
                                    <div class="" style="height: 2.2rem;">
                                        <div class="row ml-5">
                                            <div class="col-md-2 text-right offset-md-7">
                                                <label>Estado:</label>
                                            </div>
                                            <div class="col-md-3 ">
                                                <select class="select2 form-control" name="salida_estado">
                                                    <option value="">Seleccione</option>
                                                    <option value="Vigente" selected>Vigente</option>
                                                    <option value="Pendiente">Pendiente de Pago</option>
                                                    <option value="Cancelada">Cancelada</option>
                                                    <option value="Anulada">Anulada</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                        <!--
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Serie</label>
                                                <select class="form-control select2" name="salida_series">
                                                    <option value="F001" selected>F001</option>
                                                    <option value="F002">F002</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>N° salida</label>
                                                <input type="text" class="form-control" placeholder="Correlativo de salida" name="salida_nro" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vendedor</label>
                                        <input type="text" class="form-control" placeholder="Vendedor de cotización" name="salida_cotizvendedor" readonly>
                                    </div>
                                </div>
                                
                            </div>
                            -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nᵒ salida</label>
                                        <input type="text" maxlength="11" class="form-control" name="salida_cliruc" placeholder="Nᵒ salida" required>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <label>Nombre del cliente</label>
                                        <input type="text" name="salida_valcliente" class="form-control" placeholder="Nombre de cliente" required>
                                    </div>
                                    <input type="hidden" name="salida_cliente">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de salida</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="Fecha de cotización" name="salida_fecha" value="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dirección de salida</label>
                                        <input type="text" class="form-control" name="salida_clidirecc" placeholder="Dirección" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dirección a entregar</label>
                                        <input type="text" class="form-control" name="salida_clirefer" placeholder="Dir. Ent">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>R.I.F</label>
                                        <input type="text" class="form-control" name="salida_clirif" placeholder="RIF">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 d-none">
                                    <div class="form-group">
                                        <label>Forma de Pago</label>
                                        <select name="salida_formpagotext" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="0">Contado</option>
                                            <option value="15">15 días</option>
                                            <option value="30">30 días</option>
                                            <option value="45">45 días</option>
                                            <option value="60">60 días</option>
                                            <option value="Otro">Especificar</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3 d-none">
                                    <div class="form-group" id="div_diaspago">
                                        <label>Días de Pago</label>
                                        <input type="number" min="0" max="365" step="1" class="form-control" name="salida_formpago" placeholder="Número de días">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de Entrega</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" name="salida_fecentrega" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Tipo de Moneda</label>
                                    <select name="salida_tipmon" class="form-control select2" required>
                                        <option value="">Seleccione moneda</option>
                                        <option value="Bs.s" selected>Moneda Nacional</option>
                                        <option value="US$">Divisa tipo dolar</option>
                                        <option value="EU€">Divisa tipo euro</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-danger">
                        <div class="card-header">
                            <div class="card-title"><i class="fas fa-box"></i>&nbsp;&nbsp;Productos</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Producto</label>
                                        <select class="form-control select2" name="salida_producto">
                                            <option value="" selected></option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="salida_nameprod">
                                <input type="hidden" name="salida_codeprod">
                                <input type="hidden" name="salida_prods">

                                <div class="col-md-2">
                                    <label>Precio Unitario</label>
                                    <input type="number" class="form-control" name="salida_prodprecio" value="0.00">
                                </div>
                                <div class="col-md-2">
                                    <label>Cantidad</label>
                                    <input type="number" min="0" class="form-control" name="salida_prodcant" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input type="text" class="form-control" name="salida_proddesc" placeholder="Descripción de producto" readonly>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="salida_stockprod">
                            <div class="row mt-3">
                                <div id="col-btn-add-prodtosalida" class="col-md-12">
                                    <button type="button" id="btn-add-prodtosalida" class="btn btn-primary btn-block"><i class="fa fa-save fa-1x"></i>&nbsp;&nbsp;<font>Agregar artículo</font></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-body">
                            <div>
                                <label>Haga doble clic sobre un ítem para eliminarlo del detalle</label>
                            </div>
                            <div class="table-responsive">
                                <table id="table-productssalida" name="salida_products" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Precio Venta</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                            <th>Almacen</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="row mb-2">
                                        <div class="col-md-8 text-right">
                                            <label>Descuento %</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="number" name="salida_porcdesc" placeholder="Porcentaje de descuento" min="0" step="5" value="0" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-8 text-right">
                                            <label>Valor Dscto.</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="salida_cantdesc" placeholder="" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-2">
                                        <div class="col-md-6 text-right">
                                            <label>Op. Gravada</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="salida_opergrab" min="0" step="0.1" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 text-right">
                                            <label>I.V.A 16%</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="salida_igv" min="0" step="0.1" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 text-right">
                                            <label>Total</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="salida_total" class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div id="col-btn-save-salidaprod" class="col-md-12">
                                    <button type="submit" id="btn-save-salidaprod" class="btn btn-success btn-block"><i class="fa fa-save fa-1x"></i>&nbsp;&nbsp;<font>Guardar salida</font></button>
                                </div>
                                <input type="hidden" name="salida_procesada" id="salida_procesada" value="false">

                                <div id="col-btn-anular-salida" class="col-md-4">
                                    <button type="button" id="btn-anular-salida" class="btn btn-danger btn-block"><i class="fa fa-minus-circle fa-1x"></i>&nbsp;&nbsp;<font><b>Anular</b> salida</font></button>
                                </div>
                                <div id="col-btn-pendiente-salida" class="col-md-4">
                                    <button type="button" id="btn-pendiente-salida" class="btn btn-warning btn-block"><i class="fa fa-dollar-sign fa-1x"></i>&nbsp;&nbsp;<font>Marcar como <b>Pendiente de Pago</b></font></button>
                                </div>
                                <div id="col-btn-cancelar-salida" class="col-md-4">
                                    <button type="button" id="btn-cancelar-salida" class="btn btn-success btn-block"><i class="fa fa-check-circle fa-1x"></i>&nbsp;&nbsp;<font>Marcar como <b>Cancelada</b></font></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

