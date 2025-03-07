$("#col-btn-anular-salida").hide();
$("#col-btn-pendiente-salida").hide();
$("#col-btn-cancelar-salida").hide();

$("#btn-save-salidaprod").prop("disabled", true);
$("#btn-add-prodtosalida").prop("disabled", true);
$("#btn-select-cotizacion").prop("disabled", true);
$("#btn-select-salida").prop("disabled", true);
$('input[name="salida_prodcant"]').prop("disabled", true);
$('#div_diaspago').hide();
$('input[name="salida_formpago"]').prop("required",false);

$(document).ready(function(){
  $("#m_registro_salida").attr("class","nav-link active");
  $("#m_registro_salida").parent().attr("class","nav-item has-treeview menu-open");
  $("#m_salidad").attr("class","nav-link active");
  $(document).prop('title', 'Reporte de salidas - Satvicos');
});


$('select[name="salida_formpagotext"]').on("change", function() {
  valtipo = $(this).val();
  cotiztipopago = $('input[name="salida_formpago"]');
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
  $('select[name="salidas_listado"]').empty();
  $('select[name="salidas_listado"]').select2({
    data: JSON.parse(data)
  });
});

$('select[name="salidas_listado"]').on("change", function() {
  val_lstfacs = $(this).val();
  if (val_lstfacs != "" && val_lstfacs != null) {
    $("#btn-select-salida").prop("disabled", false);
  } else {
    $("#btn-select-salida").prop("disabled", true);
  }
});

$('input[name="salida_valcliente"]').autocomplete({
  source: function(request, response) {
    $.getJSON("../../modules/clientes/obtener-clientes.php", { cotiz_nomcliente: $('input[name="salida_valcliente"]').val() }, response);
  },
  select: function (event, ui) {
    $(this).val(ui.item.label);
    $('input[name="salida_clirif"]').val("");
    $('input[name="salida_clirefer"]').val("");
    $('input[name="salida_clirefer"]').val("");
    if (ui.item.id != "" && ui.item.id != null) {
      $.post(
        "../../modules/clientes/consultar-cliente.php",
        { FILTER: ui.item.id },
        function(data) {
          var mydata = JSON.parse(data);
          $('input[name="salida_cliente"]').val(mydata[0]["CODIGO"]);
          $('input[name="salida_clirif"]').val(mydata[0]["RUC"]);
          $('input[name="salida_clirefer"]').val(mydata[0]["DIRECC"]);
          //$('input[name="salida_clirefer"]').val("No registrada");
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

  $('select[name="salida_usuario"]').empty();
  $('select[name="salida_usuario"]').select2({
    data: data_users
  });

  $('select[name="salida_usuario"]').val(user_id);
  $('select[name="salida_usuario"]').trigger("change");
  $('input[name="salida_usuarioid"]').val(user_id);
  
  if(user_job != "Secretaria" && user_job != "Secretario"){
    $('select[name="salida_usuario"]').prop("disabled",true);
  }

});

$('select[name="salida_usuario"]').on("change", function(){
  $('input[name="salida_usuarioid"]').val($(this).val());
});

$.post("../../modules/cotizaciones/listar-cotizaciones.php", function(data) {
  $('select[name="salida_listadocotiz"]').empty();
  $('select[name="salida_listadocotiz"]').select2({
    data: JSON.parse(data)
  });
});

$.post(
  "../../modules/productos/listar-productos-xprov.php",
  { ESTADO: 1 },
  function(data) {
    $('select[name="salida_producto"]').empty();
    $('select[name="salida_producto"]').select2({
      data: JSON.parse(data)
    });
  }
);

$('select[name="salida_producto"]').on("change", function() {
  DATA_ID = $(this).val();
  $('input[name="salida_prodcant"]').val(0);
  $('input[name="salida_nameprod"]').val("");
  $('input[name="salida_proddesc"]').val("");
  $('input[name="salida_prodprecio"]').val("");
  $('input[name="salida_stockprod"]').val("");
  $('input[name="salida_codeprod"]').val("");
  if (DATA_ID != "" && DATA_ID != null) {
    $('input[name="salida_prodcant"]').prop("disabled", false);
    $.post(
      "../../modules/productos/consultar-productos.php",
      { FILTER: DATA_ID, ESTADO: "1" },
      function(data) {
          var mydata = JSON.parse(data);
          let stock_producto = parseInt(mydata[0]["CANTIDAD"]);
          
          // Asignar valores obtenidos al formulario
          $('input[name="salida_codeprod"]').val(mydata[0]["CODPROD"]);
          $('input[name="salida_nameprod"]').val(mydata[0]["NOMBRE"]);
          $('input[name="salida_proddesc"]').val(mydata[0]["DESCRIPTION"]);
          $('input[name="salida_prodprecio"]').val(mydata[0]["PRECIO"]);
          $('input[name="salida_stockprod"]').val(mydata[0]["CANTIDAD"]);
  
          // Obtener y guardar el valor de "almacén"
          let almacen = mydata[0]["ALMACEN"]; // Suponiendo que el campo "almacen" viene en la respuesta
  
          if (stock_producto <= 0) {
              $.Notification.notify(
                  "error",
                  "bottom-right",
                  "Stock agotado",
                  "Producto seleccionado no cuenta con existencias"
              );
              $("#btn-add-prodtosalida").prop("disabled", true);
          } else {
              $("#btn-add-prodtosalida").data("almacen", almacen); // Guardar "almacen" para su uso posterior
          }
      }
  );
  
  } else {
    $('input[name="salida_prodcant"]').prop("disabled", true);
  }
});



$('input[name="salida_prodcant"]').on("change", function() {
  cant_prod = parseInt($(this).val());
  stock_prod = parseInt($('input[name="salida_stockprod"]').val());
  select_prod = $('select[name="salida_producto"]').val();

  if (cant_prod <= stock_prod) {
    tbl_data = tbl_prodsalida
      .rows()
      .data()
      .toArray();

    var cantidad_final = 0;
    cantidad_final += cant_prod;

    if (tbl_data.length > 0) {
      for (i = 0; i < tbl_data.length; i++) {
        id_prod = tbl_data[i][0];
        cant_agreg = parseInt(tbl_data[i][5]);
        if (select_prod == id_prod) {
          cantidad_final += cant_agreg;
        }
      }
      //console.log(cantidad_final);
      if (cantidad_final > stock_prod) {
        $("#btn-add-prodtosalida").prop("disabled", true);
        $.Notification.notify(
          "error",
          "bottom-right",
          "Stock insuficiente",
          "Producto no cuenta con stock suficiente"
        );
      } else if (cantidad_final <= stock_prod) {
        $("#btn-add-prodtosalida").prop("disabled", false);
      }
    } else {
      $("#btn-add-prodtosalida").prop("disabled", false);
    }
  } else if (cant_prod > stock_prod) {
    $("#btn-add-prodtosalida").prop("disabled", true);
    $.Notification.notify(
      "error",
      "bottom-right",
      "Stock insuficiente",
      "Producto no cuenta con stock suficiente"
    );
  }
});

var tbl_prodsalida = $("#table-productssalida").DataTable({
  "language": {"url": "../../plugins/datatables/Spanish.json"}
});

var total_temporal = 0;
tbl_prodsalida.columns([0]).visible(false);

var tbl_data = "";

$("#btn-add-prodtosalida").click(function () {
  let idprod = $('select[name="salida_producto"]').val();
  let cod_prod = $('input[name="salida_codeprod"]').val();
  let producto = $('input[name="salida_nameprod"]').val();
  let descripcion = $('input[name="salida_proddesc"]').val();
  let precio = parseFloat($('input[name="salida_prodprecio"]').val());
  let cantidad = parseInt($('input[name="salida_prodcant"]').val());
  let almacen = $("#btn-add-prodtosalida").data("almacen"); // Obtener el valor de "almacén" almacenado
  let importe = precio * cantidad;
  var importe_actual = importe;


  if (idprod && cantidad > 0) {
      $("#btn-add-prodtosalida").prop("disabled", true);

      // Verificar si el producto ya está en la tabla
      tbl_prodsalida.rows(function (idx, data) {
          if (data.producto === producto) {
              importe += parseFloat(data.importe);
              cantidad += parseInt(data.cantidad);
              return true;
          }
          return false;
      }).remove();

      // Añadir producto a la tabla
      tbl_prodsalida.row.add({
          0: idprod,
          1: cod_prod,
          2: producto,
          3: descripcion,
          4: precio.toFixed(2),
          5: cantidad,
          6: importe.toFixed(2),
          7: almacen, // Añadir "almacén" a la fila

      }).draw();

    tbl_data = tbl_prodsalida
      .rows()
      .data()
      .toArray();

    opergrab =
      $('input[name="salida_opergrab"]').val() != ""
        ? $('input[name="salida_opergrab"]').val()
        : 0;
    importe_totactual = parseFloat(opergrab);
    importe_totactual += importe_actual;
    new_igv = importe_totactual * 0.16;
    new_total = importe_totactual + new_igv;

    total_temporal = new_total;

    $('input[name="salida_opergrab"]').val(importe_totactual.toFixed(2));
    $('input[name="salida_igv"]').val(new_igv.toFixed(2));
    $('input[name="salida_total"]').val(new_total.toFixed(2));

    $('input[name="salida_prodcant"]').val(0);
    $('input[name="salida_prodprecio"]').val(0.00);

    $.Notification.notify(
      "success",
      "bottom-right",
      "Producto añadido",
      "El producto ha sido agregado a la salida correctamente"
    );

    if (tbl_data.length > 0) {
      $("#btn-save-salidaprod").prop("disabled", false);
      porc_desc = parseFloat($('input[name="salida_porcdesc"]').val()) / 100;
      val_desc = new_total * porc_desc;
      $('input[name="salida_cantdesc"]').val(val_desc.toFixed(3));
    } else {
      $('input[name="salida_cantdesc"]').val(0);
      $('input[name="salida_porcdesc"]').val(0);
      $("#btn-save-salidaprod").prop("disabled", true);
      total_temporal = 0;
    }
  } else {
    $('select[name="salida_producto"]').focus();
    $.Notification.notify(
      "error",
      "bottom-right",
      "Error al añadir",
      "Seleccione un producto de la lista"
    );
  }
});

$('select[name="salida_listadocotiz"]').on("change", function() {
  val_lstcotiz = $(this).val();
  if (val_lstcotiz != "" && val_lstcotiz != null) {
    $("#btn-select-cotizacion").prop("disabled", false);
  } else {
    $("#btn-select-cotizacion").prop("disabled", true);
  }
});

$("#btn-select-salida").click(function() {
  DATA_ID = $('select[name="salidas_listado"]').val();
  if (DATA_ID != "" && DATA_ID != null) {

    $('input[name="id_salida"]').val("");
    $('select[name="salida_estado"]').val("1");

    Swal.fire({
      html: "<h4>Cargando datos de salida</h4>",
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    });

    $.post(
      "../../modules/salida/consultar-salida.php",
      { FILTER: DATA_ID, ESTADO:"ALL" },
      function(data) {
        var data_json = JSON.parse(data);

        if(data_json.length > 0){

          id_salida = data_json[0]["CODIGOID"];
          est_salida = data_json[0]["ESTADO"];

          $("#col-btn-save-salidaprod").hide("fast");

          if(est_salida == 1) //VIGENTE
          {
            $("#btn-anular-salida").prop("disabled",false);
            $("#btn-pendiente-salida").prop("disabled",false);
            $("#btn-cancelar-salida").prop("disabled",false);
          }
          else if (est_salida == 2) //ANULADA
          {
            $("#btn-anular-salida").prop("disabled",true);
            $("#btn-pendiente-salida").prop("disabled",false);
            $("#btn-cancelar-salida").prop("disabled",false);
          }
          else if (est_salida == 3) //PENDIENTE DE PAGO
          {
            $("#btn-anular-salida").prop("disabled",false);
            $("#btn-pendiente-salida").prop("disabled",true);
            $("#btn-cancelar-salida").prop("disabled",false);
          }
          else if (est_salida == 4) //CANCELADA
          {
            $("#btn-anular-salida").prop("disabled",false);
            $("#btn-pendiente-salida").prop("disabled",false);
            $("#btn-cancelar-salida").prop("disabled",true);
          }

          $('select[name="salida_estado"]').prop("disabled",true);

          $('input[name="id_salida"]').val(id_salida);
          
          $("#btn-anular-salida").attr("js-id",id_salida);
          $("#btn-pendiente-salida").attr("js-id",id_salida);
          $("#btn-cancelar-salida").attr("js-id",id_salida);

          $('select[name="salida_series"]').val(data_json[0]["SERIE"]);
          $('select[name="salida_series"]').trigger("change");
          $('select[name="salida_series"]').prop("disabled",true);

          $('input[name="salida_nro"]').val(data_json[0]["CODIGO_CORRELATIVO"]);
          $('input[name="salida_nro"]').prop("disabled",true);
          
          $('select[name="salida_estado"]').val(est_salida);
          $('input[name="salida_valcliente"]').focus();
          $('input[name="salida_fecha"]').val(data_json[0]["FECREG"]);
          $('select[name="salida_usuario"]').val(data_json[0]["USER_ID"]);
          $('select[name="salida_usuario"]').trigger("change");
          $('input[name="salida_usuarioid"]').val(data_json[0]["USER_ID"]);

          $('input[name="salida_cliente"]').val(data_json[0]["CLIENTID"]);
          $('input[name="salida_valcliente"]').val(data_json[0]["CLIENTNAME"]);
          
          $('input[name="salida_cliruc"]').val(data_json[0]["CLIENTRUC"]);
          $('input[name="salida_clidirecc"]').val(data_json[0]["CLIENTADDR"]);
          $('input[name="salida_clirefer"]').val(data_json[0]["CLIENTREFER"]);

          $('select[name="salida_formpagotext"]').val(data_json[0]["PAY_DAYS"]);
          $('select[name="salida_formpagotext"]').trigger("change");

          if ($('select[name="salida_formpagotext"]').val() == null) {
            $('select[name="salida_formpagotext"]').val("Otro");
            $('select[name="salida_formpagotext"]').trigger("change");
            $('#div_diaspago').show();
            $('input[name="salida_formpago"]').prop("required",true);
            $('input[name="salida_formpago"]').val(data_json[0]["PAY_DAYS"] );
          }

          $('input[name="salida_fecentrega"]').val(data_json[0]["DELIV_DATE"]);

          $('select[name="salida_tipmon"]').val(data_json[0]["CURRENCY"]);
          $('select[name="salida_tipmon"]').trigger("change");

          $('input[name="salida_porcdesc"]').val(data_json[0]["DESC_RATE"]);
          $('input[name="salida_cantdesc"]').val(data_json[0]["DESC_VAL"]);
          $('input[name="salida_opergrab"]').val(parseFloat(data_json[0]["TOTAL_SUB"]).toFixed(2));
          $('input[name="salida_igv"]').val(parseFloat(data_json[0]["TOTAL_TAX"]).toFixed(2));
          $('input[name="salida_total"]').val(parseFloat(data_json[0]["TOTAL_NET"]).toFixed(2));

          total_temporal = data_json[0]["TOTAL_NET"];
          codigo_idfac = data_json[0]["CODIGOID"];

          $.post(
            "../../modules/salida/consultar-detalle-salida.php",
            { FAC_ID: codigo_idfac },
            function(data) {
              $('select[name="salida_producto"]').val("");
              $('select[name="salida_producto"]').trigger("change");
              $('input[name="salida_proddesc"]').val("");
              $('input[name="salida_prodprecio"]').val("");
              $('input[name="salida_prodcant"]').val(0);
              $("#btn-add-prodtosalida").prop("disabled", true);
              //$("#btn-save-salidaprod").prop("disabled", false);
  
              tbl_prodsalida.clear().draw();
              detafact_prods = JSON.parse(data);
              for (i = 0; i < detafact_prods.length; i++) {
                var precio = parseFloat(detafact_prods[i]["PRECIOUNIT"]).toFixed(2);
                var importe = parseFloat(detafact_prods[i]["IMPORTE"]).toFixed(2);

                tbl_prodsalida.rows
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
        $("#col-btn-save-salidaprod").hide("fast");
        $("#col-btn-anular-salida").show("fast");        
        $("#col-btn-pendiente-salida").show("fast");        
        $("#col-btn-cancelar-salida").show("fast");
      }
    );

  }
});

$("#btn-select-cotizacion").click(function() {

  var DATA_ID = $('select[name="salida_listadocotiz"]').val();
  
  if (DATA_ID != "" && DATA_ID != null) {

    $('input[name="id_salida"]').val("");
    $('select[name="salida_estado"]').val("1");

    Swal.fire({
      html: "<h4>Cargando datos de salida</h4>",
      allowOutsideClick: false,
      onBeforeOpen: () => {
        Swal.showLoading();
      }
    });

    buscarCorrelativo();

    $.post("../../modules/cotizaciones/consultar-cotizacion.php",
      { FILTER: DATA_ID, ESTADO: "ALL" }, function(data) {

        var data_json = JSON.parse(data);
        $('input[name="salida_valcliente"]').focus();
        $('input[name="salida_fecha"]').val(data_json[0]["FECREG"]);
        $('select[name="salida_usuario"]').val(data_json[0]["USER_ID"]);
        $('select[name="salida_usuario"]').trigger("change");
        $('input[name="salida_usuarioid"]').val(data_json[0]["USER_ID"]);

        $('input[name="salida_cliente"]').val(data_json[0]["CLIENTID"]);
        $('input[name="salida_valcliente"]').val(data_json[0]["CLIENTNAME"]);
        
        $('input[name="salida_cliruc"]').val(data_json[0]["CLIENTRUC"]);
        $('input[name="salida_clidirecc"]').val(data_json[0]["CLIENTADDR"]);
        $('input[name="salida_clirefer"]').val(data_json[0]["CLIENTREFER"]);

        $('select[name="salida_formpagotext"]').val(data_json[0]["PAY_DAYS"]);
        $('select[name="salida_formpagotext"]').trigger("change");

        if ($('select[name="salida_formpagotext"]').val() == null) {
          $('select[name="salida_formpagotext"]').val("Otro");
          $('select[name="salida_formpagotext"]').trigger("change");
          $('#div_diaspago').show();
          $('input[name="salida_formpago"]').prop("required",true);
          $('input[name="salida_formpago"]').val(data_json[0]["PAY_DAYS"] );
        }

        $('input[name="salida_fecentrega"]').val(data_json[0]["DELIV_DATE"]);

        $('select[name="salida_tipmon"]').val(data_json[0]["CURRENCY"]);
        $('select[name="salida_tipmon"]').trigger("change");

        $('input[name="salida_porcdesc"]').val(data_json[0]["DESC_RATE"]);
        $('input[name="salida_cantdesc"]').val(data_json[0]["DESC_VAL"]);
        $('input[name="salida_opergrab"]').val(parseFloat(data_json[0]["TOTAL_SUB"]).toFixed(2));
        $('input[name="salida_igv"]').val(parseFloat(data_json[0]["TOTAL_TAX"]).toFixed(2));
        $('input[name="salida_total"]').val(parseFloat(data_json[0]["TOTAL_NET"]).toFixed(2));

        total_temporal = data_json[0]["TOTAL_NET"];
        codigo_idcotiz = data_json[0]["CODIGOID"];

        $.post("../../modules/cotizaciones/consultar-detalle-cotizacion.php",
          { IDCOTIZ: codigo_idcotiz }, function(data) {
            $('select[name="salida_producto"]').val("");
            $('select[name="salida_producto"]').trigger("change");
            $('input[name="salida_proddesc"]').val("");
            $('input[name="salida_prodprecio"]').val("");
            $('input[name="salida_prodcant"]').val(0);
            $("#btn-add-prodtosalida").prop("disabled", true);
            $("#btn-save-salidaprod").prop("disabled", false);

            tbl_prodsalida.clear().draw();
            detacotiz_json = JSON.parse(data);
            for (i = 0; i < detacotiz_json.length; i++) {
              var precio = parseFloat(detacotiz_json[i]["PRECIOUNIT"]).toFixed(2);
              var importe = parseFloat(detacotiz_json[i]["IMPORTE"]).toFixed(2);

              tbl_prodsalida.rows
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

$("#table-productssalida").on("dblclick", "tr", function() {
  var data_row = tbl_prodsalida.row(this).data();
  var row_id = data_row[0];
  var importe_prod = data_row[6];

  opergrab =
    $('input[name="salida_opergrab"]').val() != ""
      ? $('input[name="salida_opergrab"]').val()
      : 0;
  importe_totactual = parseFloat(opergrab);
  importe_totactual -= importe_prod;
  new_igv = importe_totactual * 0.16;
  new_total = importe_totactual + new_igv;

  total_temporal = new_total;

  $('input[name="salida_opergrab"]').val(importe_totactual.toFixed(2));
  $('input[name="salida_igv"]').val(new_igv.toFixed(2));
  $('input[name="salida_total"]').val(new_total.toFixed(2));

  tbl_prodsalida
    .rows(tbl_prodsalida.row(this))
    .remove()
    .draw();

  tbl_data = tbl_prodsalida
    .rows()
    .data()
    .toArray();

  $('input[name="salida_prodcant"]').val(0);
  $("#btn-add-prodtosalida").prop("disabled", true);

  $.Notification.notify(
    "success",
    "bottom-right",
    "Producto eliminado",
    "El producto ha sido eliminado correctamente"
  );

  if (tbl_data.length > 0) {
    //$("#btn-save-salidaprod").prop("disabled", false);
    porc_desc = parseFloat($('input[name="salida_porcdesc"]').val()) / 100;
    val_desc = new_total * porc_desc;
    $('input[name="salida_cantdesc"]').val(val_desc.toFixed(3));
  } else {
    $("#btn-save-salidaprod").prop("disabled", true);
    $('input[name="salida_cantdesc"]').val(0);
    $('input[name="salida_porcdesc"]').val(0);
    total_temporal = 0;
  }
});

$('input[name="salida_porcdesc"]').on("change", function() {
  num_desc = parseFloat($(this).val());
  if (isNaN(num_desc)) num_desc=0;

  porc_desc = num_desc / 100;
  total_actual = parseFloat($('input[name="salida_total"]').val());
  val_desc = total_actual * porc_desc;
  $('input[name="salida_cantdesc"]').val(val_desc.toFixed(3));

  total_desc = total_temporal - val_desc;
  $('input[name="salida_total"]').val(total_desc.toFixed(2));
});

$("#FRM_INSERT_SALIDA").submit(function(e) {
    e.preventDefault();
    var tbl_data = tbl_prodsalida.rows().data().toArray(); // Capturamos los datos de la tabla
    $("input[name='salida_prods']").val(JSON.stringify(tbl_data)); // Asignamos los datos al campo oculto
    this.submit(); // Ahora enviamos el formulario
});


$("#FRM_INSERT_salida").submit(function(e) {
  console.log("Valor de tbl_data:", tbl_data);
  console.log("Valor de salida_prods en formData_rec:", formData_rec.get("salida_prods"));
  e.preventDefault();
  var form = $(this);
  if (!form.length) {
      console.error("Formulario #FRM_INSERT_entrada no encontrado.");
      return;
  }
  var form = $(this);
  var idform = form.attr("id");
  var url = form.attr("action");
  tbl_data = tbl_prodsalida.rows().data().toArray();
  var formElement = document.getElementById(idform);
  var formData_rec = new FormData(formElement);
  formData_rec.append("salida_prods", JSON.stringify(tbl_data));
  $.ajax({
    type: "POST",
    url: url,
    data: formData_rec,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend: function() {
      Swal.fire({
        html: "<h4>Guardando salida</h4>",
        allowOutsideClick: false,
        onBeforeOpen: () => {
          Swal.showLoading();
        }
      });
    },
    success: function(data) {
      //console.log(data);
      if (data == "ERROR") {
        $.Notification.notify(
          "error",
          "bottom-right",
          "Error de guardado",
          "No se pudo guardar la salida"
        );
        Swal.close();

      } else if (data == "OK_INSERT") {
        $('input[name="salida_valcliente"]').val("");
        $('input[name="salida_fecha"]').focus();
        $.Notification.notify(
          "success",
          "bottom-right",
          "salida guardada",
          "Datos almacenados"
        );

        postCambioEstado();
        
        $.post("../../modules/salida/listar-salidas.php", function(data) {
        $('select[name="salidas_listado"]').empty();
        $('select[name="salidas_listado"]').select2({
          data: JSON.parse(data)
          });
        });

        Swal.close();
      }
    }
  });
});

$("#btn-nuevafac").click(function (e) {
    e.preventDefault();
    location.reload();
});

$("#btn-anular-salida").click(function() {
  element = $(this);
  id_val = element.attr("js-id");
  if (id_val != "" && id_val != null) {
    Swal.fire({
      title: "¿Está seguro de ANULAR esta salida?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Anular",
      cancelButtonText: "Cancelar"
    }).then(result => {
      if (result.value) {
        $.post(
          "../../modules/salida/cambiar-estado-doc.php",
          { TIPO_DOC: 'INVOICE', ID_DOC: id_val, ESTADO_DOC : 2},
          function(data) {
            if (data == true) {
              postCambioEstado();
              
              $.Notification.notify(
                "success",
                "bottom-right",
                "salida Anulada",
                "La salida fue ANULADA con éxito"
              );
            }else{
              $.Notification.notify(
                "error",
                "bottom-right",
                "Error",
                "La salida no pudo ser ANULADA"
              );
            }
          }
        );
      }
    });
  }
});

$("#btn-pendiente-salida").click(function() {
  element = $(this);
  id_val = element.attr("js-id");
  if (id_val != "" && id_val != null) {
    Swal.fire({
      title: "¿Está seguro de marcar como PENDIENTE DE PAGO esta salida?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Marcar como PENDIENTE",
      cancelButtonText: "Cancelar"
    }).then(result => {
      if (result.value) {
        $.post(
          "../../modules/salida/cambiar-estado-doc.php",
          { TIPO_DOC: 'INVOICE', ID_DOC: id_val, ESTADO_DOC : 3},
          function(data) {
            if (data == true) {
              postCambioEstado();

              $.Notification.notify(
                "success",
                "bottom-right",
                "salida Pendiente de Pago",
                "La salida fue marcada como PENDIENTE DE PAGO con éxito"
              );
            }else{
              $.Notification.notify(
                "error",
                "bottom-right",
                "Error",
                "La salida no pudo ser marcada como PENDIENTE DE PAGO"
              );
            }
          }
        );
      }
    });
  }
});

$("#btn-cancelar-salida").click(function() {
  element = $(this);
  id_val = element.attr("js-id");
  if (id_val != "" && id_val != null) {
    Swal.fire({
      title: "¿Está seguro de marcar como CANCELADA esta salida?",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Marcar como CANCELADA",
      cancelButtonText: "Cancelar"
    }).then(result => {
      if (result.value) {
        $.post(
          "../../modules/salida/cambiar-estado-doc.php",
          { TIPO_DOC: 'INVOICE', ID_DOC: id_val, ESTADO_DOC : 4},
          function(data) {
            if (data == true) {
              postCambioEstado();

              $.Notification.notify(
                "success",
                "bottom-right",
                "salida Cancelada",
                "La salida fue marcada como CANCELADA con éxito"
              );
            }else{
              $.Notification.notify(
                "error",
                "bottom-right",
                "Error",
                "La salida no pudo ser marcada como CANCELADA"
              );
            }
          }
        );
      }
    });
  }
});

function postCambioEstado(){
  $('select[name="salida_estado"]').val("1");
  $('input[name="salida_fecha"]').focus();
  tbl_prodsalida.clear().draw();

  $("#FRM_INSERT_salida")
    .find("input, textarea, select")
    .val("");

  $("#FRM_INSERT_salida")[0].reset();

  $('select[name="salida_producto"]').trigger("change");
  $("#btn-add-prodtosalida").prop("disabled", false);              
  $('input[name="id_salida"]').val("");
  $('input[name="salida_valcliente"]').val("");

  $("#btn-save-salidaprod").prop("disabled", true);
  $("#col-btn-save-salidaprod").show();
  $("#col-btn-anular-salida").hide();
  $("#col-btn-pendiente-salida").hide();
  $("#col-btn-cancelar-salida").hide();

  $('select[name="salida_formpagotext"]').prop("disabled",false);
  $('#div_diaspago').hide();
  $('input[name="salida_formpago"]').prop("required",false);

  $('select[name="salida_series"]').prop("disabled",false);
  $('input[name="salida_nro"]').prop("disabled",false);
  $('select[name="salida_series"]').trigger("change");
  $('select[name="salida_estado"]').prop("disabled",false);
}

$(document).ready(function() {
  var cookie_idfact = leer_cookie('COOKIE_ID_FACT');
  if (cookie_idfact != "") {
    setTimeout(function(){
      $('select[name="salidas_listado"]').val(cookie_idfact);
      $('select[name="salidas_listado"]').trigger("change");
      $('#btn-select-salida').trigger("click");
      eliminar_cookie("COOKIE_ID_FACT");
    },500);
  }
});

function buscarCorrelativo(){
  seriesalida = $('select[name="salida_series"]').val();
  
  $.post("../../modules/facturacion/obtener-correlativo-doc.php",
    { TIPO_DOC: "INVOICE", SERIE: seriesalida }, function(data) {
    if(data != "" && data != null){
      $('input[name="salida_nro"]').val(data);
    }
  });
}

$( 'select[name="salida_series"]' ).change(function() {
  idDoc = $('input[name="id_salida"]').val();
  if (idDoc == "") buscarCorrelativo();
});