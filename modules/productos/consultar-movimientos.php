<?php
require '../../global/connection.php';

// Define the content type as JSON
header('Content-Type: application/json');

// Start the SQL query
$sqlStatement = $pdo->prepare("SELECT t.id AS ID, "
    . "t.type AS TIPO, t.quantity AS CANTIDAD, t.observation AS OBSERVACION, t.doc_reference as DOC_REFERENCIA, "
    . "t.expiration_date AS FECVENC, t.registration_date AS FECREG, "
    . "tp.code AS CODIGO_PRODUCTO, tp.name AS NOMBRE_PRODUCTO, tpr.business_name AS NOMBRE_PROVEEDOR, tu.username AS NOMBRE_USUARIO, tp.warehouse AS ALMACEN "
    . "FROM tbl_warehouse_movement t "
    . "JOIN tbl_product tp on tp.id=t.product_id "
    . "LEFT JOIN tbl_provider tpr on tpr.id=t.provider_id "
    . "JOIN tbl_user tu on tu.id=t.user_id "
    . "ORDER BY t.id DESC");

$sqlStatement->execute();
$rows = $sqlStatement->fetchAll(PDO::FETCH_ASSOC);
$json_data = array();

if (!empty($rows)) {
    foreach ($rows as $ROW) {
        $ROWDATA = array(); // Ensure to initialize the array

        // Assign values to $ROWDATA
        $ROWDATA['ID'] = $ROW["ID"];

        // Check the movement type
        if ($ROW["TIPO"] == 1) {
            $ROWDATA['TIPO'] = "Ingreso Almacén";
        } elseif ($ROW["TIPO"] == 2) {
            $ROWDATA['TIPO'] = "Ajuste Stock";
        } elseif ($ROW["TIPO"] == 3) {
            $ROWDATA['TIPO'] = "Retiro del Almacén";
        }

        $ROWDATA['CANTIDAD'] = $ROW["CANTIDAD"];
        $ROWDATA['FECREG'] = date("d/m/Y H:i", strtotime($ROW["FECREG"]));
        $ROWDATA['NOMBRE_USUARIO'] = $ROW["NOMBRE_USUARIO"];
        $ROWDATA['CODIGO_PRODUCTO'] = $ROW["CODIGO_PRODUCTO"];
        $ROWDATA['NOMBRE_PRODUCTO'] = $ROW["NOMBRE_PRODUCTO"];
        $ROWDATA['ALMACEN'] = $ROW["ALMACEN"] == 0 ? "CEDIS" : "MERMA";
        
        $ROWDATA['DOC_REFERENCIA'] = empty($ROW["DOC_REFERENCIA"]) ? "-" : $ROW["DOC_REFERENCIA"];
        $ROWDATA['FECVENC'] = empty($ROW["FECVENC"]) ? "-" : date("d/m/Y", strtotime($ROW["FECVENC"]));
        $ROWDATA['NOMBRE_PROVEEDOR'] = empty($ROW["NOMBRE_PROVEEDOR"]) ? "-" : $ROW["NOMBRE_PROVEEDOR"];
        $ROWDATA['OBSERVACION'] = empty($ROW["OBSERVACION"]) ? "-" : $ROW["OBSERVACION"];

        // Add to JSON data
        array_push($json_data, $ROWDATA);
    }
}

// Check if $json_data is empty or not
if (empty($json_data)) {
    echo json_encode(array("data" => [])); // If no data, respond with an empty array
} else {
    echo json_encode(array("data" => $json_data)); // Respond with the data
}
?>
