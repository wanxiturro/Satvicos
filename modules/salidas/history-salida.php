<?php
require '../../global/connection.php';

$sqlStatement = $pdo->prepare("
    SELECT 
        t.id_pdf AS ID,
        t.id_report AS ID_REPORTE,
        t.name_user AS NOMBRE_USUARIO,
        t.path_arch AS RUTA_ARCHIVO,
        t.f_operacion AS FECHA_CREACION,
        t.report_products AS PRODUCTOS,
        t.report_cant AS CANTIDAD
    FROM tbl_pdf_exit t
    ORDER BY t.id_pdf DESC
");

$sqlStatement->execute();
$rowsNumber = $sqlStatement->rowCount();
$json_data = array();

if ($rowsNumber > 0) {        
    foreach ($sqlStatement as $ROW) {
        $ROWDATA['ID'] = $ROW["ID"];
        $ROWDATA['ID_REPORTE'] = $ROW["ID_REPORTE"];
        $ROWDATA['NOMBRE_USUARIO'] = $ROW["NOMBRE_USUARIO"];
        $ROWDATA['PRODUCTOS'] = $ROW["PRODUCTOS"] ?? ''; // Asegurarse de que no está vacío
        $ROWDATA['CANTIDAD'] = $ROW["CANTIDAD"] ?? ''; // Asegurarse de que no está vacío
        $ROWDATA['RUTA_ARCHIVO'] = $ROW["RUTA_ARCHIVO"];
        $ROWDATA['FECHA_CREACION'] = date("d/m/Y H:i:s", strtotime($ROW["FECHA_CREACION"])); // Formatear la fecha
        
        array_push($json_data, $ROWDATA);
    }        
}
echo json_encode(array("data" => $json_data));
?>
