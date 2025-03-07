$("#col-btn-anular-entrada").hide();
$("#col-btn-pendiente-entrada").hide();
$("#col-btn-cancelar-entrada").hide();

$("#btn-save-entradaprod").prop("disabled", true);
$("#btn-add-prodtoentrada").prop("disabled", true);
$("#btn-select-cotizacion").prop("disabled", true);
$("#btn-select-entrada").prop("disabled", true);
$('input[name="entrada_prodcant"]').prop("disabled", true);
$('#div_diaspago').hide();
$('input[name="entrada_formpago"]').prop("required",false);

$(document).ready(function(){
  $("#m_registro_entrada").attr("class","nav-link active");
  $("#m_registro_entrada").parent().attr("class","nav-item has-treeview menu-open");
  $("#m_entrada").attr("class","nav-link active");
  $(document).prop('title', 'Reporte de entradas - Satvicos');
});


$('select[name="entrada_formpagotext"]').on("change", function() {
  valtipo = $(this).val();
  cotiztipopago = $('input[name="entrada_formpago"]');
  div_tipopago = $('#div_diaspago');
  if(valtipo != ""){    
    if(valtipo == "Otro"){
      cotiztipopago.val("");
      cotiztipopago.prop("required",true);
      div_tipopago.show();
    } else {
      cotiztipopago.val(valtipo);
      cotiztipopago.prop("required",false);
      div_tipopago.hide();
    }
  }
});

$.post("../../modules/facturacion/listar-facturas.php", function(data) {
  $('select[name="entradas_listado"]').empty();
  $('select[name="entradas_listado"]').select2({
    data: JSON.parse(data)
  });
});

$('select[name="entradas_listado"]').on("change", function() {
  val_lstfacs = $(this).val();
  if (val_lstfacs != "" && val_lstfacs != null) {
    $("#btn-select-entrada").prop("disabled", false);
  } else {
    $("#btn-select-entrada").prop("disabled", true);
  }
});

$('input[name="entrada_valcliente"]').autocomplete({
  source: function(request, response) {
    $.getJSON("../../modules/clientes/obtener-clientes.php", { cotiz_nomcliente: $('input[name="entrada_valcliente"]').val() }, response);
  },
  select: function (event, ui) {
    $(this).val(ui.item.label);
    $('input[name="entrada_cliruc"]').val("");
    $('input[name="entrada_clidirecc"]').val("");
    $('input[name="entrada_clirefer"]').val("");
    if (ui.item.id != "" && ui.item.id != null) {
      $.post(
        "../../modules/clientes/consultar-cliente.php",
        { FILTER: ui.item.id },
        function(data) {
          var mydata = JSON.parse(data);
          $('input[name="entrada_cliente"]').val(mydata[0]["CODIGO"]);
          $('input[name="entrada_cliruc"]').val(mydata[0]["RUC"]);
          $('input[name="entrada_clidirecc"]').val(mydata[0]["DIRECC"]);
          //$('input[name="entrada_clirefer"]').val("No registrada");
        }
      );
    }
  }
});

buscarCorrelativo();

$.post("../../modules/usuarios/listar-usuarios-xtipo.php", function(data) {
  mydata = JSON.parse(data);
  data_users = mydata[0];
  user_id = mydata[1];
  user_job = mydata[2];

  $('select[name="entrada_usuario"]').empty();
  $('select[name="entrada_usuario"]').select2({
    data: data_users
  });

  $('select[name="entrada_usuario"]').val(user_id);
  $('select[name="entrada_usuario"]').trigger("change");
  $('input[name="entrada_usuarioid"]').val(user_id);
  
  if(user_job != "Secretaria" && user_job != "Secretario"){
    $('select[name="entrada_usuario"]').prop("disabled",true);
  }

});

$('select[name="entrada_usuario"]').on("change", function(){
  $('input[name="entrada_usuarioid"]').val($(this).val());
});

$.post("../../modules/cotizaciones/listar-cotizaciones.php", function(data) {
  $('select[name="entrada_listadocotiz"]').empty();
  $('select[name="entrada_listadocotiz"]').select2({
    data: JSON.parse(data)
  });
});

$.post(
  "../../modules/productos/listar-productos-xprov.php",
  { ESTADO: 1 },
  function(data) {
    $('select[name="entrada_producto"]').empty();
    $('select[name="entrada_producto"]').select2({
      data: JSON.parse(data)
    });
  }
);

$('select[name="entrada_producto"]').on("change", function() {
  DATA_ID = $(this).val();
  $('input[name="entrada_prodcant"]').val(0);
  $('input[name="entrada_nameprod"]').val("");
  $('input[name="entrada_proddesc"]').val("");
  $('input[name="entrada_prodprecio"]').val("");
  $('input[name="entrada_stockprod"]').val("");
  $('input[name="entrada_codeprod"]').val("");
  if (DATA_ID != "" && DATA_ID != null) {
    $('input[name="entrada_prodcant"]').prop("disabled", false);
    $.post(
      "../../modules/productos/consultar-productos.php",
      { FILTER: DATA_ID, ESTADO: "1" },
      function(data) {
          var mydata = JSON.parse(data);
          let stock_producto = parseInt(mydata[0]["CANTIDAD"]);
          
          // Asignar valores obtenidos al formulario
          $('input[name="entrada_codeprod"]').val(mydata[0]["CODPROD"]);
          $('input[name="entrada_nameprod"]').val(mydata[0]["NOMBRE"]);
          $('input[name="entrada_proddesc"]').val(mydata[0]["DESCRIPTION"]);
          $('input[name="entrada_prodprecio"]').val(mydata[0]["PRECIOC"]);
          $('input[name="entrada_stockprod"]').val(mydata[0]["CANTIDAD"]);
  
          // Obtener y guardar el valor de "almacén"
          let almacen = mydata[0]["ALMACEN"]; // Suponiendo que el campo "almacen" viene en la respuesta
  
          if (stock_producto <= 7000) {
             
              $("#btn-add-prodtoentrada").data("almacen", almacen); // Guardar "almacen" para su uso posterior
          }
      }
  );
  
  } else {
    $('input[name="entrada_prodcant"]').prop("disabled", true);
  }
});

$('input[name="entrada_prodcant"]').on("change", function() {
  cant_prod = parseInt($(this).val());
  stock_prod = parseInt($('input[name="entrada_stockprod"]').val());
  select_prod = $('select[name="entrada_producto"]').val();

  if (cant_prod > 0) {
    $("#btn-add-prodtoentrada").prop("disabled", false);
  } else {
    $("#btn-add-prodtoentrada").prop("disabled", true);
    $.Notification.notify(
      "error",
      "bottom-right",
      "Cantidad no válida",
      "Ingrese una cantidad válida para el producto"
    );
  }
});

var tbl_prodentrada = $("#table-productsentrada").DataTable({
  "language": { "url": "../../plugins/datatables/Spanish.json" }
});

var total_temporal = 0;
tbl_prodentrada.columns([0]).visible(false);

var tbl_data = "";

$("#btn-add-prodtoentrada").click(function () {
  let idprod = $('select[name="entrada_producto"]').val();
  let cod_prod = $('input[name="entrada_codeprod"]').val();
  let producto = $('input[name="entrada_nameprod"]').val();
  let descripcion = $('input[name="entrada_proddesc"]').val();
  let precio = parseFloat($('input[name="entrada_prodprecio"]').val());
  let cantidad = parseInt($('input[name="entrada_prodcant"]').val());
  let almacen = $("#btn-add-prodtoentrada").data("almacen"); // Obtener el valor de "almacén" almacenado
  let importe = precio * cantidad;
  var importe_actual = importe;

  if (idprod && cantidad > 0) {
    $("#btn-add-prodtoentrada").prop("disabled", true);

    // Verificar si el producto ya está en la tabla
    tbl_prodentrada.rows(function (idx, data) {
        if (data.producto === producto) {
            importe += parseFloat(data.importe);
            cantidad += parseInt(data.cantidad);
            return true;
        }
        return false;
    }).remove();

    // Añadir producto a la tabla
    tbl_prodentrada.row.add({
        0: idprod,
        1: cod_prod,
        2: producto,
        3: descripcion,
        4: precio.toFixed(2),
        5: cantidad,
        6: importe.toFixed(2),
        7: almacen, // Añadir "almacén" a la fila

    }).draw();

  tbl_data = tbl_prodentrada
    .rows()
    .data()
    .toArray();

  opergrab =
    $('input[name="entrada_opergrab"]').val() != ""
      ? $('input[name="entrada_opergrab"]').val()
      : 0;
  importe_totactual = parseFloat(opergrab);
  importe_totactual += importe_actual;
  new_igv = importe_totactual * 0.16;
  new_total = importe_totactual + new_igv;

  total_temporal = new_total;

  $('input[name="entrada_opergrab"]').val(importe_totactual.toFixed(2));
  $('input[name="entrada_igv"]').val(new_igv.toFixed(2));
  $('input[name="entrada_total"]').val(new_total.toFixed(2));

  $('input[name="entrada_prodcant"]').val(0);
  $('input[name="entrada_prodprecio"]').val(0.00);

  $.Notification.notify(
    "success",
    "bottom-right",
    "Producto añadido",
    "El producto ha sido agregado a la entrada correctamente"
  );

  if (tbl_data.length > 0) {
    $("#btn-save-entradaprod").prop("disabled", false);
    porc_desc = parseFloat($('input[name="entrada_porcdesc"]').val()) / 100;
    val_desc = new_total * porc_desc;
    $('input[name="entrada_cantdesc"]').val(val_desc.toFixed(3));
  } else {
    $('input[name="entrada_cantdesc"]').val(0);
    $('input[name="entrada_porcdesc"]').val(0);
    $("#btn-save-entradaprod").prop("disabled", true);
    total_temporal = 0;
  }
} else {
  $('select[name="entrada_producto"]').focus();
  $.Notification.notify(
    "error",
    "bottom-right",
    "Error al añadir",
    "Seleccione un producto de la lista"
  );
}
});


$('select[name="entrada_listadocotiz"]').on("change", function() {
  val_lstcotiz = $(this).val();
  if (val_lstcotiz != "" && val_lstcotiz != null) {
    $("#btn-select-cotizacion").prop("disabled", false);
  } else {
    $("#btn-select-cotizacion").prop("disabled", true);
  }
});

$("#btn-select-entrada").click(function() {
  DATA_ID = $('select[name="entradas_listado"]').val();
  if (DATA_ID != "" && DATA_ID != null) {

    $('input[name="id_entrada"]').val("");
    $('select[name="entrada_estado"]').val("1");

    Swal.fire({
      html: "<h4>Cargando datos de entrada</h4>",
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    });

    $.post(
      "../../modules/entrada/consultar-entrada.php",
      { FILTER: DATA_ID, ESTADO:"ALL" },
      function(data) {
        var data_json = JSON.parse(data);

        if(data_json.length > 0){

          id_entrada = data_json[0]["CODIGOID"];
          est_entrada = data_json[0]["ESTADO"];

          $("#col-btn-save-entradaprod").hide("fast");

          if(est_entrada == 1) //VIGENTE
          {
            $("#btn-anular-entrada").prop("disabled",false);
            $("#btn-pendiente-entrada").prop("disabled",false);
            $("#btn-cancelar-entrada").prop("disabled",false);
          }
          else if (est_entrada == 2) //ANULADA
          {
            $("#btn-anular-entrada").prop("disabled",true);
            $("#btn-pendiente-entrada").prop("disabled",false);
            $("#btn-cancelar-entrada").prop("disabled",false);
          }
          else if (est_entrada == 3) //PENDIENTE DE PAGO
          {
            $("#btn-anular-entrada").prop("disabled",false);
            $("#btn-pendiente-entrada").prop("disabled",true);
            $("#btn-cancelar-entrada").prop("disabled",false);
          }
          else if (est_entrada == 4) //CANCELADA
          {
            $("#btn-anular-entrada").prop("disabled",false);
            $("#btn-pendiente-entrada").prop("disabled",false);
            $("#btn-cancelar-entrada").prop("disabled",true);
          }

          $('select[name="entrada_estado"]').prop("disabled",true);

          $('input[name="id_entrada"]').val(id_entrada);
          
          $("#btn-anular-entrada").attr("js-id",id_entrada);
          $("#btn-pendiente-entrada").attr("js-id",id_entrada);
          $("#btn-cancelar-entrada").attr("js-id",id_entrada);

          $('select[name="entrada_series"]').val(data_json[0]["SERIE"]);
          $('select[name="entrada_series"]').trigger("change");
          $('select[name="entrada_series"]').prop("disabled",true);

          $('input[name="entrada_nro"]').val(data_json[0]["CODIGO_CORRELATIVO"]);
          $('input[name="entrada_nro"]').prop("disabled",true);
          
          $('select[name="entrada_estado"]').val(est_entrada);
          $('input[name="entrada_valcliente"]').focus();
          $('input[name="entrada_fecha"]').val(data_json[0]["FECREG"]);
          $('select[name="entrada_usuario"]').val(data_json[0]["USER_ID"]);
          $('select[name="entrada_usuario"]').trigger("change");
          $('input[name="entrada_usuarioid"]').val(data_json[0]["USER_ID"]);

          $('input[name="entrada_cliente"]').val(data_json[0]["CLIENTID"]);
          $('input[name="entrada_valcliente"]').val(data_json[0]["CLIENTNAME"]);
          
          $('input[name="entrada_cliruc"]').val(data_json[0]["CLIENTRUC"]);
          $('input[name="entrada_clidirecc"]').val(data_json[0]["CLIENTADDR"]);
          $('input[name="entrada_clirefer"]').val(data_json[0]["CLIENTREFER"]);

          $('select[name="entrada_formpagotext"]').val(data_json[0]["PAY_DAYS"]);
          $('select[name="entrada_formpagotext"]').trigger("change");

          if ($('select[name="entrada_formpagotext"]').val() == null) {
            $('select[name="entrada_formpagotext"]').val("Otro");
            $('select[name="entrada_formpagotext"]').trigger("change");
            $('#div_diaspago').show();
            $('input[name="entrada_formpago"]').prop("required",true);
            $('input[name="entrada_formpago"]').val(data_json[0]["PAY_DAYS"] );
          }

          $('input[name="entrada_fecentrega"]').val(data_json[0]["DELIV_DATE"]);

          $('select[name="entrada_tipmon"]').val(data_json[0]["CURRENCY"]);
          $('select[name="entrada_tipmon"]').trigger("change");

          $('input[name="entrada_porcdesc"]').val(data_json[0]["DESC_RATE"]);
          $('input[name="entrada_cantdesc"]').val(data_json[0]["DESC_VAL"]);
          $('input[name="entrada_opergrab"]').val(parseFloat(data_json[0]["TOTAL_SUB"]).toFixed(2));
          $('input[name="entrada_igv"]').val(parseFloat(data_json[0]["TOTAL_TAX"]).toFixed(2));
          $('input[name="entrada_total"]').val(parseFloat(data_json[0]["TOTAL_NET"]).toFixed(2));

          total_temporal = data_json[0]["TOTAL_NET"];
          codigo_idfac = data_json[0]["CODIGOID"];

          $.post(
            "../../modules/entrada/consultar-detalle-entrada.php",
            { FAC_ID: codigo_idfac },
            function(data) {
              $('select[name="entrada_producto"]').val("");
              $('select[name="entrada_producto"]').trigger("change");
              $('input[name="entrada_proddesc"]').val("");
              $('input[name="entrada_prodprecio"]').val("");
              $('input[name="entrada_prodcant"]').val(0);
              $("#btn-add-prodtoentrada").prop("disabled", true);
              $("#btn-save-entradaprod").prop("disabled", false);
  
              tbl_prodentrada.clear().draw();
              detafact_prods = JSON.parse(data);
              for (i = 0; i < detafact_prods.length; i++) {
                var precio = parseFloat(detafact_prods[i]["PRECIOUNIT"]).toFixed(2);
                var importe = parseFloat(detafact_prods[i]["IMPORTE"]).toFixed(2);

                tbl_prodentrada.rows
                  .add([
                    {
                      0: detafact_prods[i]["IDPROD"],
                      1: detafact_prods[i]["CODPROD"],
                      2: detafact_prods[i]["NOMBRE"],
                      3: detafact_prods[i]["DESCRIP"],
                      4: precio,
                      5: detafact_prods[i]["CANTIDAD"],
                      6: importe
                    }
                  ])
                  .draw();
              }
            }
          ).then(function() {
            Swal.close();
          });
        }
        $("#col-btn-save-entradaprod").hide("fast");
        $("#col-btn-anular-entrada").show("fast");        
        $("#col-btn-pendiente-entrada").show("fast");        
        $("#col-btn-cancelar-entrada").show("fast");
      }
    );

  }
});

$("#btn-select-cotizacion").click(function() {

  var DATA_ID = $('select[name="entrada_listadocotiz"]').val();
  
  if (DATA_ID != "" && DATA_ID != null) {

    $('input[name="id_entrada"]').val("");
    $('select[name="entrada_estado"]').val("1");

    Swal.fire({
      html: "<h4>Cargando datos de entrada</h4>",
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    });

    buscarCorrelativo();

    $.post("../../modules/cotizaciones/consultar-cotizacion.php",
      { FILTER: DATA_ID, ESTADO: "ALL" }, function(data) {

        var data_json = JSON.parse(data);
        $('input[name="entrada_valcliente"]').focus();
        $('input[name="entrada_fecha"]').val(data_json[0]["FECREG"]);
        $('select[name="entrada_usuario"]').val(data_json[0]["USER_ID"]);
        $('select[name="entrada_usuario"]').trigger("change");
        $('input[name="entrada_usuarioid"]').val(data_json[0]["USER_ID"]);

        $('input[name="entrada_cliente"]').val(data_json[0]["CLIENTID"]);
        $('input[name="entrada_valcliente"]').val(data_json[0]["CLIENTNAME"]);
        
        $('input[name="entrada_cliruc"]').val(data_json[0]["CLIENTRUC"]);
        $('input[name="entrada_clidirecc"]').val(data_json[0]["CLIENTADDR"]);
        $('input[name="entrada_clirefer"]').val(data_json[0]["CLIENTREFER"]);

        $('select[name="entrada_formpagotext"]').val(data_json[0]["PAY_DAYS"]);
        $('select[name="entrada_formpagotext"]').trigger("change");

        if ($('select[name="entrada_formpagotext"]').val() == null) {
          $('select[name="entrada_formpagotext"]').val("Otro");
          $('select[name="entrada_formpagotext"]').trigger("change");
          $('#div_diaspago').show();
          $('input[name="entrada_formpago"]').prop("required",true);
          $('input[name="entrada_formpago"]').val(data_json[0]["PAY_DAYS"] );
        }

        $('input[name="entrada_fecentrega"]').val(data_json[0]["DELIV_DATE"]);

        $('select[name="entrada_tipmon"]').val(data_json[0]["CURRENCY"]);
        $('select[name="entrada_tipmon"]').trigger("change");

        $('input[name="entrada_porcdesc"]').val(data_json[0]["DESC_RATE"]);
        $('input[name="entrada_cantdesc"]').val(data_json[0]["DESC_VAL"]);
        $('input[name="entrada_opergrab"]').val(parseFloat(data_json[0]["TOTAL_SUB"]).toFixed(2));
        $('input[name="entrada_igv"]').val(parseFloat(data_json[0]["TOTAL_TAX"]).toFixed(2));
        $('input[name="entrada_total"]').val(parseFloat(data_json[0]["TOTAL_NET"]).toFixed(2));

        total_temporal = data_json[0]["TOTAL_NET"];
        codigo_idcotiz = data_json[0]["CODIGOID"];

        $.post("../../modules/cotizaciones/consultar-detalle-cotizacion.php",
          { IDCOTIZ: codigo_idcotiz }, function(data) {
            $('select[name="entrada_producto"]').val("");
            $('select[name="entrada_producto"]').trigger("change");
            $('input[name="entrada_proddesc"]').val("");
            $('input[name="entrada_prodprecio"]').val("");
            $('input[name="entrada_prodcant"]').val(0);
            $("#btn-add-prodtoentrada").prop("disabled", true);
            $("#btn-save-entradaprod").prop("disabled", false);

            tbl_prodentrada.clear().draw();
            detacotiz_json = JSON.parse(data);
            for (i = 0; i < detacotiz_json.length; i++) {
              var precio = parseFloat(detacotiz_json[i]["PRECIOUNIT"]).toFixed(2);
              var importe = parseFloat(detacotiz_json[i]["IMPORTE"]).toFixed(2);

              tbl_prodentrada.rows
                .add([
                  {
                    0: detacotiz_json[i]["IDPROD"],
                    1: detacotiz_json[i]["CODPROD"],
                    2: detacotiz_json[i]["NOMBRE"],
                    3: detacotiz_json[i]["DESCRIP"],
                    4: precio,
                    5: detacotiz_json[i]["CANTIDAD"],
                    6: importe
                  }
                ])
                .draw();
            }
          }
        );
      }
    ).then(function() {
      Swal.close();
    });
  }

});

$("#table-productsentrada").on("dblclick", "tr", function() {
  var data_row = tbl_prodentrada.row(this).data();
  var row_id = data_row[0];
  var importe_prod = data_row[6];

  opergrab =
    $('input[name="entrada_opergrab"]').val() != ""
      ? $('input[name="entrada_opergrab"]').val()
      : 0;
  importe_totactual = parseFloat(opergrab);
  importe_totactual -= importe_prod;
  new_igv = importe_totactual * 0.16;
  new_total = importe_totactual + new_igv;

  total_temporal = new_total;

  $('input[name="entrada_opergrab"]').val(importe_totactual.toFixed(2));
  $('input[name="entrada_igv"]').val(new_igv.toFixed(2));
  $('input[name="entrada_total"]').val(new_total.toFixed(2));

  tbl_prodentrada
    .rows(tbl_prodentrada.row(this))
    .remove()
    .draw();

  tbl_data = tbl_prodentrada
    .rows()
    .data()
    .toArray();

  $('input[name="entrada_prodcant"]').val(0);
  $("#btn-add-prodtoentrada").prop("disabled", true);

  $.Notification.notify(
    "success",
    "bottom-right",
    "Producto eliminado",
    "El producto ha sido eliminado correctamente"
  );

  if (tbl_data.length > 0) {
    //$("#btn-save-entradaprod").prop("disabled", false);
    porc_desc = parseFloat($('input[name="entrada_porcdesc"]').val()) / 100;
    val_desc = new_total * porc_desc;
    $('input[name="entrada_cantdesc"]').val(val_desc.toFixed(3));
  } else {
    $("#btn-save-entradaprod").prop("disabled", true);
    $('input[name="entrada_cantdesc"]').val(0);
    $('input[name="entrada_porcdesc"]').val(0);
    total_temporal = 0;
  }
});

$('input[name="entrada_porcdesc"]').on("change", function() {
  num_desc = parseFloat($(this).val());
  if (isNaN(num_desc)) num_desc=0;

  porc_desc = num_desc / 100;
  total_actual = parseFloat($('input[name="entrada_total"]').val());
  val_desc = total_actual * porc_desc;
  $('input[name="entrada_cantdesc"]').val(val_desc.toFixed(3));

  total_desc = total_temporal - val_desc;
  $('input[name="entrada_total"]').val(total_desc.toFixed(2));
});

$("#FRM_INSERT_ENTRADA").submit(function(e) {
  e.preventDefault();
  var tbl_data = tbl_prodentrada.rows().data().toArray(); // Capturamos los datos de la tabla
  $("input[name='entrada_prods']").val(JSON.stringify(tbl_data)); // Asignamos los datos al campo oculto
  this.submit(); // Ahora enviamos el formulario
});

$("#FRM_INSERT_entrada").submit(function (e) {
  $.ajax({
    type: "POST",
    url: url,
    data: formData_rec,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function () {
      Swal.fire({
        html: "<h4>Guardando entrada</h4>",
        allowOutsideClick: false,
        onBeforeOpen: () => { 
          Swal.showLoading();
        },
      });
    },
    success: function (data) {
      Swal.close(); // Detener la animación en todos los casos
      if (data === "ERROR") {
        $.Notification.notify(
          "error",
          "bottom-right",
          "Error de guardado",
          "No se pudo guardar la entrada"
        );
      } else if (data === "OK_INSERT") {
        $('input[name="entrada_valcliente"]').val("");
        $('input[name="entrada_fecha"]').focus();
        $.Notification.notify(
          "success",
          "bottom-right",
          "Entrada guardada",
          "Datos almacenados"
        );

        postCambioEstado();

        $.post("../../modules/entrada/listar-entradas.php", function (data) {
          $('select[name="entradas_listado"]').empty();
          $('select[name="entradas_listado"]').select2({
            data: JSON.parse(data),
          });
        });

        // Abrir el PDF
        var pdfUrl = "../../modules/entrada/pdf-entrada.php?id=RECENT_ENTRY_ID"; // Ajusta el parámetro
        window.open(pdfUrl, "_blank"); // Abre el PDF en una nueva pestaña
      }
    },
    error: function () {
      Swal.close(); // Cerrar animación en caso de error
      $.Notification.notify(
        "error",
        "bottom-right",
        "Error",
        "Ocurrió un error al procesar la solicitud"
      );
    },
    complete: function () {
      // Volver a habilitar el botón de enviar después de la respuesta
      submitButton.prop("disabled", false);
    },
  });
});


$("#btn-nuevafac").click(function (e) {
    e.preventDefault();
    location.reload();
});

$("#btn-anular-entrada").click(function() {
  element = $(this);
  id_val = element.attr("js-id");
  if (id_val != "" && id_val != null) {
    Swal.fire({
      title: "¿Está seguro de ANULAR esta entrada?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Anular",
      cancelButtonText: "Cancelar"
    }).then(result => {
      if (result.value) {
        $.post(
          "../../modules/entrada/cambiar-estado-doc.php",
          { TIPO_DOC: 'INVOICE', ID_DOC: id_val, ESTADO_DOC : 2},
          function(data) {
            if (data == true) {
              postCambioEstado();
              
              $.Notification.notify(
                "success",
                "bottom-right",
                "entrada Anulada",
                "La entrada fue ANULADA con éxito"
              );
            }else{
              $.Notification.notify(
                "error",
                "bottom-right",
                "Error",
                "La entrada no pudo ser ANULADA"
              );
            }
          }
        );
      }
    });
  }
});

$("#btn-pendiente-entrada").click(function() {
  element = $(this);
  id_val = element.attr("js-id");
  if (id_val != "" && id_val != null) {
    Swal.fire({
      title: "¿Está seguro de marcar como PENDIENTE DE PAGO esta entrada?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Marcar como PENDIENTE",
      cancelButtonText: "Cancelar"
    }).then(result => {
      if (result.value) {
        $.post(
          "../../modules/entrada/cambiar-estado-doc.php",
          { TIPO_DOC: 'INVOICE', ID_DOC: id_val, ESTADO_DOC : 3},
          function(data) {
            if (data == true) {
              postCambioEstado();

              $.Notification.notify(
                "success",
                "bottom-right",
                "entrada Pendiente de Pago",
                "La entrada fue marcada como PENDIENTE DE PAGO con éxito"
              );
            }else{
              $.Notification.notify(
                "error",
                "bottom-right",
                "Error",
                "La entrada no pudo ser marcada como PENDIENTE DE PAGO"
              );
            }
          }
        );
      }
    });
  }
});

$("#btn-cancelar-entrada").click(function() {
  element = $(this);
  id_val = element.attr("js-id");
  if (id_val != "" && id_val != null) {
    Swal.fire({
      title: "¿Está seguro de marcar como CANCELADA esta entrada?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Marcar como CANCELADA",
      cancelButtonText: "Cancelar"
    }).then(result => {
      if (result.value) {
        $.post(
          "../../modules/entrada/cambiar-estado-doc.php",
          { TIPO_DOC: 'INVOICE', ID_DOC: id_val, ESTADO_DOC : 4},
          function(data) {
            if (data == true) {
              postCambioEstado();

              $.Notification.notify(
                "success",
                "bottom-right",
                "entrada Cancelada",
                "La entrada fue marcada como CANCELADA con éxito"
              );
            }else{
              $.Notification.notify(
                "error",
                "bottom-right",
                "Error",
                "La entrada no pudo ser marcada como CANCELADA"
              );
            }
          }
        );
      }
    });
  }
});

function postCambioEstado(){
  $('select[name="entrada_estado"]').val("1");
  $('input[name="entrada_fecha"]').focus();
  tbl_prodentrada.clear().draw();

  $("#FRM_INSERT_entrada")
    .find("input, textarea, select")
    .val("");

  $("#FRM_INSERT_entrada")[0].reset();

  $('select[name="entrada_producto"]').trigger("change");
  $("#btn-add-prodtoentrada").prop("disabled", false);              
  $('input[name="id_entrada"]').val("");
  $('input[name="entrada_valcliente"]').val("");

  $("#btn-save-entradaprod").prop("disabled", true);
  $("#col-btn-save-entradaprod").show();
  $("#col-btn-anular-entrada").hide();
  $("#col-btn-pendiente-entrada").hide();
  $("#col-btn-cancelar-entrada").hide();

  $('select[name="entrada_formpagotext"]').prop("disabled",false);
  $('#div_diaspago').hide();
  $('input[name="entrada_formpago"]').prop("required",false);

  $('select[name="entrada_series"]').prop("disabled",false);
  $('input[name="entrada_nro"]').prop("disabled",false);
  $('select[name="entrada_series"]').trigger("change");
  $('select[name="entrada_estado"]').prop("disabled",false);
}

$(document).ready(function() {
  var cookie_idfact = leer_cookie('COOKIE_ID_FACT');
  if (cookie_idfact != "") {
    setTimeout(function(){
      $('select[name="entradas_listado"]').val(cookie_idfact);
      $('select[name="entradas_listado"]').trigger("change");
      $('#btn-select-entrada').trigger("click");
      eliminar_cookie("COOKIE_ID_FACT");
    },500);
  }
});

function buscarCorrelativo(){
  serieentrada = $('select[name="entrada_series"]').val();
  
  $.post("../../modules/facturacion/obtener-correlativo-doc.php",
    { TIPO_DOC: "INVOICE", SERIE: serieentrada }, function(data) {
    if(data != "" && data != null){
      $('input[name="entrada_nro"]').val(data);
    }
  });
}

$( 'select[name="entrada_series"]' ).change(function() {
  idDoc = $('input[name="id_entrada"]').val();
  if (idDoc == "") buscarCorrelativo();
});

$.post(
  "../../modules/proveedores/listar-proveedores.php",
  function (data) {
      $('select[name="entrada_prov"]').empty();
      $('select[name="entrada_prov"]').select2({
          data: JSON.parse(data)
      });
  }
);

$('select[name="entrada_prov"]').on('change', function() {
  var selectedData = $(this).select2('data')[0];
  
  $('input[name="entrada_prov_nombre"]').val(selectedData.text);
  $('input[name="entrada_prov_rif"]').val(selectedData.rif);
  $('input[name="entrada_prov_address"]').val(selectedData.dir);
  $('input[name="entrada_prov_phone1"]').val(selectedData.telf);
  $('input[name="entrada_prov_phone2"]').val(selectedData.telf2);
});

  
  $("#rbtnIngreso").on("change", function(){
      checkTipoMov();
  })
  
  $("#rbtnAjuste").on("change", function(){
      checkTipoMov();
  })