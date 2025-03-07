$(document).ready(function(){
    $("#m_registro_entrada").attr("class","nav-link active");
    $("#m_registro_entrada").parent().attr("class","nav-item has-treeview menu-open");
    $("#m_entrada_listado").attr("class","nav-link active");
    $(document).prop('title', 'Historial de entradas - Satvicos');
});

$(document).ready(function () {
    var tabla_entradas = $('#table-entradas').DataTable({
        ajax: {
            url: "../../modules/entradas/history-entrada.php",
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
                text: '<i class="fa fa-plus-square fa-1x"></i>&nbsp;&nbsp;Registrar entradas',
                action: function ( e, dt, node, config ) {
                    window.location.assign("../../views/entradas/entrada-producto");
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
        selector: "#table-entradas tbody tr",
        callback: function (key, options) {
            var data = tabla_entradas.row(this).data();
            if (key === "view") {
                window.open(`../../modules/entradas/verpdf-entrada.php?id_pdf=${data.ID}&action=view`, "_blank");
            } else if (key === "download") {
                window.location.href = `../../modules/entradas/verpdf-entrada.php?id_pdf=${data.ID}&action=download`;
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

    $('#table-entradas tbody').on('contextmenu', function (e) {
        e.preventDefault();
    });

    $('#table-entradas tbody').on('click', 'tr', function () {
        var data = tabla_entradas.row(this).data();
        window.open(`../../modules/entradas/verpdf-entrada.php?id_pdf=${data.ID}&action=view`, "_blank");
    });
});
