$(document).ready(function(){
    $("#m_registro_salida").attr("class","nav-link active");
    $("#m_registro_salida").parent().attr("class","nav-item has-treeview menu-open");
    $("#m_salida_listado").attr("class","nav-link active");
    $(document).prop('title', 'Historial de salidas - Satvicos');
});

$(document).ready(function () {
    var tabla_salidas = $('#table-salidas').DataTable({
        ajax: {
            url: "../../modules/salidas/history-salida.php",
            type: "POST",
        },
        columns: [
            { data: "ID" },
            { data: "ID_REPORTE" },
            { data: "NOMBRE_USUARIO" },
            { data: "FECHA_CREACION" },
            { data: "PRODUCTOS" },
            { data: "CANTIDAD" },
            
        ],
        order: [[0, "DESC"]],
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fa fa-plus-square fa-1x"></i>&nbsp;&nbsp;Registrar salidas',
                action: function ( e, dt, node, config ) {
                    window.location.assign("../../views/salidas/salida-producto");
                }
            },
            {
                extend: 'csv',
                text: '<i class="fa fa-file-csv"></i>&nbsp;&nbsp;Descargar CSV'
            },
            {
                extend: 'excel',
                text: '<i class="fa fa-file-excel"></i>&nbsp;&nbsp;Descargar Excel'
            },
            {
                extend: 'print',
                text: '<i class="fa fa-print"></i>&nbsp;&nbsp;Imprimir'
            }
        ],
        language: {
            url: "../../plugins/datatables/Spanish.json"
        }
    });

    // Menú contextual
    $.contextMenu({
        selector: "#table-salidas tbody tr",
        callback: function (key, options) {
            var data = tabla_salidas.row(this).data();
            if (key === "view") {
                window.open(`../../modules/salidas/verpdf-salida.php?id_pdf=${data.ID}&action=view`, "_blank");
            } else if (key === "download") {
                window.location.href = `../../modules/salidas/verpdf-salida.php?id_pdf=${data.ID}&action=download`;
            }
        },
        items: {
            view: { name: "Visualizar", icon: "fa fa-eye" },
            download: { name: "Descargar", icon: "fa fa-download" },
            sep1: "---------",
            quit: {
              name: "Cancelar",
              icon: function($element, key, item) {
                return "context-menu-icon context-menu-icon-quit";
              }
            }
        }
    });

    $('#table-salidas tbody').on('contextmenu', function (e) {
        e.preventDefault();
    });

    $('#table-salidas tbody').on('click', 'tr', function () {
        var data = tabla_salidas.row(this).data();
        window.open(`../../modules/salidas/verpdf-salida.php?id_pdf=${data.ID}&action=view`, "_blank");
    });
});
