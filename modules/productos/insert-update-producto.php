<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    require '../../global/connection.php';

    if (isset($_POST['producto_estado'])) {
        $p_estado = $_POST['producto_estado'];
        $p_estado = $p_estado == "on" ? 0 : 1;
    } else {
        $p_estado = 1;
    }

    $p_code = strtoupper(trim($_POST['producto_code']));
    $p_nombre = trim($_POST['producto_nombre']);
    $p_desc = trim($_POST['producto_description']);
    $p_marca = trim($_POST['producto_marca']);
    $p_unitvalue = $_POST['producto_unitvalue'];
    $p_precio = $_POST['producto_precio'];
    $p_precioC = $_POST['producto_precioC'];
    $p_idprod = $_POST['producto_id'];

    // Validar y traducir la variable de almacén
    $p_warehouse = isset($_POST['producto_almacenvalue']) ? intval($_POST['producto_almacenvalue']) : null;
    if ($p_warehouse !== 0 && $p_warehouse !== 1) {
        echo "ERROR";
        exit;
    }

    // Traducción de valores del almacén
    $warehouse_name = $p_warehouse === 0 ? "CEDIS" : "MERMA";

    if ($p_idprod == "" || $p_idprod == null) {
        $sqlStatement = $pdo->prepare("SELECT * FROM tbl_product WHERE name=:nameprod");
        $sqlStatement->bindParam("nameprod", $p_nombre, PDO::PARAM_STR);
    } else {
        $sqlStatement = $pdo->prepare("SELECT * FROM tbl_product WHERE name=:nameprod AND id <> :idprod");
        $sqlStatement->bindParam("nameprod", $p_nombre, PDO::PARAM_STR);
        $sqlStatement->bindParam("idprod", $p_idprod, PDO::PARAM_INT);
    }
    $sqlStatement->execute();
    $rowsNumber = $sqlStatement->rowCount();
    if ($rowsNumber == 0) {
        if ($p_idprod == "" || $p_idprod == null) {
            $sqlStatement = $pdo->prepare(
                "INSERT INTO tbl_product(code, brand, name, description, unit_price, unit_saleprice, unit_value, active_status, warehouse) 
                 VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );
            if ($sqlStatement) {
                $sqlStatement->execute([$p_code, $p_marca, $p_nombre, $p_desc, $p_precio, $p_precioC, $p_unitvalue, $p_estado, $p_warehouse]);
                echo "OK_INSERT";
            } else {
                echo "ERROR";
            }
        } else {
            $sqlStatement = $pdo->prepare(
                "UPDATE tbl_product 
                 SET code=?, brand=?, name=?, description=?, unit_price=?, unit_saleprice=?, unit_value=?, active_status=?, warehouse=? 
                 WHERE id=?"
            );
            if ($sqlStatement) {
                $sqlStatement->execute([$p_code, $p_marca, $p_nombre, $p_desc, $p_precio, $p_precioC, $p_unitvalue, $p_estado, $p_warehouse, $p_idprod]);
                echo "OK_UPDATE";
            } else {
                echo "ERROR";
            }
        }
    } else {
        echo "EXISTE";
    }
} else {
    echo "ERROR";
}
