<?php
require '../../global/connection.php';
$FILTER_PROD = $_POST["FILTER"];
$ESTADO_PROD = $_POST["ESTADO"];

if ($FILTER_PROD == "ALL") {

    $sqlquery_adic = "";
    if ($ESTADO_PROD != "ALL") {
        $sqlquery_adic = " WHERE tp.active_status = $ESTADO_PROD ";
    }

    $sqlStatement = $pdo->prepare(
        "SELECT 
            tp.id AS IDPROD, 
            tp.code AS CODE, 
            tp.description AS DESCPROD, 
            tp.name AS NOMPROD, 
            tp.brand AS MARCA, 
            tp.stock_quantity AS CANTIDAD, 
            ROUND(tp.unit_price, 2) AS PRECIO, 
            ROUND(tp.unit_saleprice, 2) AS PRECIOC, 
            tp.unit_value AS VALORMEDIDA, 
            tp.registration_date AS FECREG, 
            tp.active_status AS ESTADO, 
            tp.warehouse AS ALMACEN 
         FROM tbl_product tp 
         $sqlquery_adic 
         ORDER BY tp.id DESC"
    );
    $sqlStatement->execute();
    $rowsNumber = $sqlStatement->rowCount();
    $json_data = array();
    if ($rowsNumber > 0) {
        foreach ($sqlStatement as $ROW) {
            $ROWDATA['ID'] = $ROW["IDPROD"];
            $ROWDATA['CODIGO'] = $ROW["CODE"];
            $ROWDATA['NOMBRE'] = $ROW["NOMPROD"];
            $ROWDATA['DESCPROD'] = $ROW["DESCPROD"];
            $ROWDATA['MARCA'] = $ROW["MARCA"];
            $ROWDATA['CANTIDAD'] = $ROW["CANTIDAD"];
            $ROWDATA['PRECIO'] = $ROW["PRECIO"];
            $ROWDATA['PRECIOC'] = $ROW["PRECIOC"];
            $ROWDATA['VALORMEDIDA'] = $ROW["VALORMEDIDA"];
            $ROWDATA['FECREG'] = date("d/m/Y H:i", strtotime($ROW["FECREG"]));
            $ROWDATA['ESTADO'] = $ROW["ESTADO"] == 1 ? "Activo" : "Inactivo";

            $ROWDATA['ALMACEN'] = $ROW["ALMACEN"] == 0 ? "CEDIS" : "MERMA";

            if ($ROW["VALORMEDIDA"] == "") {
                $ROWDATA['VALORMEDIDA'] = "-";
            } else {
                $ROWDATA['VALORMEDIDA'] = $ROW["VALORMEDIDA"];
            }

            array_push($json_data, $ROWDATA);
        }
    }
    echo json_encode(array("data" => $json_data));
} else {
    $ID_REAL = str_replace("PROD-", "", $FILTER_PROD);

    $sqlquery_adic = "";
    if ($ESTADO_PROD != "ALL") {
        $sqlquery_adic = " AND active_status = $ESTADO_PROD";
    }

    $sqlStatement = $pdo->prepare(
        "SELECT 
            id, 
            code, 
            description, 
            name, 
            brand, 
            stock_quantity, 
            unit_value, 
            unit_price, 
            unit_saleprice,
            active_status, 
            warehouse 
         FROM tbl_product 
         WHERE id=:PRODID $sqlquery_adic"
    );
    $sqlStatement->bindParam("PRODID", $ID_REAL, PDO::PARAM_INT);
    $sqlStatement->execute();
    $rowsNumber = $sqlStatement->rowCount();
    $json_data = array();

    if ($rowsNumber > 0) {
        foreach ($sqlStatement as $ROW) {
            $ROWDATA['CODIGO'] = $ROW["id"];
            $ROWDATA['CODPROD'] = $ROW["code"];
            $ROWDATA['DESCRIPTION'] = $ROW["description"];
            $ROWDATA['NOMBRE'] = $ROW["name"];
            $ROWDATA['MARCA'] = $ROW["brand"];
            $ROWDATA['CANTIDAD'] = $ROW["stock_quantity"];
            $ROWDATA['UNITVALUE'] = $ROW["unit_value"];
            $ROWDATA['PRECIO'] = $ROW["unit_price"];
            $ROWDATA['PRECIOC'] = $ROW["unit_saleprice"];
            $ROWDATA['ESTADO'] = $ROW["active_status"] == 1 ? false : true;

            // Traducción del almacén
            $ROWDATA['ALMACEN'] = $ROW["warehouse"] == 0 ? "CEDIS" : "MERMA";

            array_push($json_data, $ROWDATA);
        }
    }
    echo json_encode($json_data);
}
