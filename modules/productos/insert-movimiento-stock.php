<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    require '../../global/connection.php';
    session_start();
  
    $tipo = $_POST['mov_tipo'];
    $prod = $_POST['mov_prod_code'];
    $guia_orden = trim($_POST['mov_guia_orden']);
    $prov = $_POST['mov_prov'];
    $fec_venc = $_POST['mov_fec_venc'];
    $obs = trim($_POST['mov_obs']);
    $cant = $_POST['mov_cantidad'];
    $user_id = $_SESSION['loggedInUser']['USERID'];

    $mov_type = 0;
    $sqlStatement = "";
    $stock_actual = 0;

    // Determinar el tipo de movimiento
    if ($tipo == "Ingreso") {
        $mov_type = 1;
    } else if ($tipo == "Ajuste") {
        $mov_type = 2;
    } else if ($tipo == "Salida") {  // Tipo de movimiento de salida
        $mov_type = 3;
    } else {
        echo "ERROR";
        return;
    }

    try {
        // INGRESO ALMACÉN
        if ($mov_type == 1) {
            $sqlStatement = $pdo->prepare("INSERT INTO tbl_warehouse_movement(type,product_id,quantity,observation,provider_id,doc_reference,expiration_date,user_id) VALUES(?,?,?,?,?,?,?,?)");
            $sqlStatement->execute([$mov_type, $prod, $cant, $obs, $prov, $guia_orden, $fec_venc, $user_id]);

            // Actualizar stock producto
            $sqlStatement = $pdo->prepare("SELECT * FROM tbl_product WHERE id=?");
            $sqlStatement->execute([$prod]);
            if ($sqlStatement->rowCount() > 0) {
                while ($statementItem = $sqlStatement->fetch()) {
                    $stock_actual = $statementItem["stock_quantity"];
                }
                $new_stock = $stock_actual + $cant;

                $update_producto = $pdo->prepare("UPDATE tbl_product SET stock_quantity=? WHERE id=?");
                $update_producto->execute([$new_stock, $prod]);
            } else {
                echo "ERROR";
                return;
            }
        }

        // AJUSTE DE STOCK
        else if ($mov_type == 2) {
            $sqlStatement = $pdo->prepare("INSERT INTO tbl_warehouse_movement(type,product_id,quantity,observation,expiration_date,user_id) VALUES(?,?,?,?,?,?)");
            $sqlStatement->execute([$mov_type, $prod, $cant, $obs, $fec_venc, $user_id]);

            // Actualizar stock producto
            $sqlStatement = $pdo->prepare("SELECT * FROM tbl_product WHERE id=?");
            $sqlStatement->execute([$prod]);
            if ($sqlStatement->rowCount() > 0) {
                while ($statementItem = $sqlStatement->fetch()) {
                    $stock_actual = $statementItem["stock_quantity"];
                }
                $new_stock = $stock_actual + $cant;  // Puedes ajustar esta lógica si el ajuste puede ser negativo

                $update_producto = $pdo->prepare("UPDATE tbl_product SET stock_quantity=? WHERE id=?");
                $update_producto->execute([$new_stock, $prod]);
            } else {
                echo "ERROR";
                return;
            }
        }

        // SALIDA DE STOCK
        else if ($mov_type == 3) {
            $sqlStatement = $pdo->prepare("INSERT INTO tbl_warehouse_movement(type,product_id,quantity,observation,expiration_date,user_id) VALUES(?,?,?,?,?,?)");
            $sqlStatement->execute([$mov_type, $prod, $cant, $obs, $fec_venc, $user_id]);

            // Actualizar stock producto
            $sqlStatement = $pdo->prepare("SELECT * FROM tbl_product WHERE id=?");
            $sqlStatement->execute([$prod]);
            if ($sqlStatement->rowCount() > 0) {
                while ($statementItem = $sqlStatement->fetch()) {
                    $stock_actual = $statementItem["stock_quantity"];
                }

                // Verificar si hay suficiente stock para la salida
                if ($stock_actual >= $cant) {
                    // Si hay suficiente stock, restamos la cantidad
                    $new_stock = $stock_actual - $cant;

                    $update_producto = $pdo->prepare("UPDATE tbl_product SET stock_quantity=? WHERE id=?");
                    $update_producto->execute([$new_stock, $prod]);
                } else {
                    echo "ERRORES";
                    return;
                }
            } else {
                echo "ERRORES";
                return;
            }
        }

        echo "OK_INSERT";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

} else {
    echo "ERROR";
}
