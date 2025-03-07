<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-md-12">
                    <div class="m-0 text-dark text-center text-lg">
                        <i class="fas fa-file-invoice"></i>&nbsp;&nbsp;Orden de entrada
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
                <form id="FRM_INSERT_ENTRADA" method="post" action="../../modules/entradas/pdf-entrada.php" enctype="multipart/form-data" target="_blank">
                    <input type="hidden" name="id_entrada">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-title">Datos de entrada</div>
                                </div>
                                <div class="col-md-9">
                                    <div class="" style="height: 2.2rem;">
                                        <div class="row ml-5">
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
                                                <select class="form-control select2" name="entrada_series">
                                                    <option value="F001" selected>F001</option>
                                                    <option value="F002">F002</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>N° entrada</label>
                                                <input type="text" class="form-control" placeholder="Correlativo de entrada" name="entrada_nro" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vendedor</label>
                                        <input type="text" class="form-control" placeholder="Vendedor de cotización" name="entrada_cotizvendedor" readonly>
                                    </div>
                                </div>
                                
                            </div>
                            -->
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Nᵒ guía / Orden</label>
                                        <input type="text" maxlength="11" class="form-control" name="entrada_cliruc" placeholder="Nᵒ entrada" required>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label><i class="fas fa-people-carry"></i> Proveedor</label>
                                        <select class="form-control select2" name="entrada_prov">
                                        <input type="hidden" name="entrada_prov_nombre">
                                        <input type="hidden" name="entrada_prov_rif">
                                        <input type="hidden" name="entrada_prov_address">
                                        <input type="hidden" name="entrada_prov_phone1">
                                        <input type="hidden" name="entrada_prov_phone2">

                                        </select>
                                    </div>
                                </div>
                                    <input type="hidden" name="entrada_cliente">
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de vencimiento del lote</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="Fecha de cotización" name="entrada_fecha" value="<?php echo date("Y-m-d"); ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Dirección de entrega</label>
                                        <input type="text" class="form-control" name="entrada_clidirecc" placeholder="Dirección" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Referencia</label>
                                        <input type="text" class="form-control" name="entrada_clirefer" placeholder="Referencia">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 d-none">

                                </div>
                                <!--<div class="col-md-3 d-none">
                                    <div class="form-group" id="div_diaspago">
                                        <label>Días de Pago</label>
                                        <input type="number" min="0" max="365" step="1" class="form-control" name="entrada_formpago" placeholder="Número de días">
                                    </div>
                                </div>
                                -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de entrada</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" class="form-control" name="entrada_fecentrega" value="<?php echo date('Y-m-d'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Tipo de Moneda</label>
                                    <select name="entrada_tipmon" class="form-control select2" required>
                                        <option value="">Seleccione moneda</option>
                                        <option value="Bs.s" selected>Moneda Nacional</option>
                                        <option value="US$">Divisa tipo dolar</option>
                                        <option value="EU€">Divisa tipo euro</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                        <label>Forma de Pago</label>
                                        <select name="entrada_formpagotext" class="form-control">
                                            <option value="">Seleccione</option>
                                            <option value="Contado">Contado</option>
                                            <option value="15 días">15 días</option>
                                            <option value="30 días">30 días</option>
                                            <option value="45 días">45 días</option>
                                            <option value="60 días">60 días</option>
                                            <option value="Otro">Especificar</option>
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
                                        <select class="form-control select2" name="entrada_producto">
                                            <option value="" selected></option>
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="entrada_nameprod">
                                <input type="hidden" name="entrada_codeprod">
                                <input type="hidden" name="entrada_prods">

                                <div class="col-md-2">
                                    <label>Precio</label>
                                    <input type="number" class="form-control" name="entrada_prodprecio" value="0" readonly>
                                </div>
                                <div class="col-md-2">
                                    <label>Cantidad</label>
                                    <input type="number" min="0" class="form-control" name="entrada_prodcant" placeholder="">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Descripción</label>
                                        <input type="text" class="form-control" name="entrada_proddesc" placeholder="Descripción de producto" readonly>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="entrada_stockprod">
                            <div class="row mt-3">
                                <div id="col-btn-add-prodtoentrada" class="col-md-12">
                                    <button type="button" id="btn-add-prodtoentrada" class="btn btn-primary btn-block"><i class="fa fa-save fa-1x"></i>&nbsp;&nbsp;<font>Agregar artículo</font></button>
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
                                <table id="table-productsentrada" name="entrada_products" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Código</th>
                                            <th>Nombre</th>
                                            <th>Descripción</th>
                                            <th>Precio Compra</th>
                                            <th>Cantidad</th>
                                            <th>Importe</th>
                                            <th>Almacén</th>
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
                                            <input type="number" name="entrada_porcdesc" placeholder="Porcentaje de descuento" min="0" step="5" value="0" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-8 text-right">
                                            <label>Valor Dscto.</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="entrada_cantdesc" placeholder="" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row mb-2">
                                        <div class="col-md-6 text-right">
                                            <label>Op. Gravada</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="entrada_opergrab" min="0" step="0.1" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 text-right">
                                            <label>I.V.A 16%</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="entrada_igv" min="0" step="0.1" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-6 text-right">
                                            <label>Total</label>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="entrada_total" class="form-control" required readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div id="col-btn-save-entradaprod" class="col-md-12">
                                    <button type="submit" id="btn-save-entradaprod" class="btn btn-success btn-block"><i class="fa fa-save fa-1x"></i>&nbsp;&nbsp;<font>Guardar entrada</font></button>
                                </div>
                                <input type="hidden" name="entrada_procesada" id="entrada_procesada" value="false">

                                <div id="col-btn-anular-entrada" class="col-md-4">
                                    <button type="button" id="btn-anular-entrada" class="btn btn-danger btn-block"><i class="fa fa-minus-circle fa-1x"></i>&nbsp;&nbsp;<font><b>Anular</b> entrada</font></button>
                                </div>
                                <div id="col-btn-pendiente-entrada" class="col-md-4">
                                    <button type="button" id="btn-pendiente-entrada" class="btn btn-warning btn-block"><i class="fa fa-dollar-sign fa-1x"></i>&nbsp;&nbsp;<font>Marcar como <b>Pendiente de Pago</b></font></button>
                                </div>
                                <div id="col-btn-cancelar-entrada" class="col-md-4">
                                    <button type="button" id="btn-cancelar-entrada" class="btn btn-success btn-block"><i class="fa fa-check-circle fa-1x"></i>&nbsp;&nbsp;<font>Marcar como <b>Cancelada</b></font></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

