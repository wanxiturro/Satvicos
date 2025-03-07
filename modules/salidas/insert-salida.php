<?php

$mensaje = '';

if (isset($_POST['salida_prods'])) {
    $productos = json_decode($_POST['salida_prods'], true);  // Decodificar el JSON recibido
} else {
    $productos = $pdf->Cell(0,6,mb_convert_encoding("Ningun producto por salir", 'ISO-8859-1', 'UTF-8'),1,0,'C');  // Si no se reciben productos, mostrar un mensaje de error
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();
    foreach ($productos as $producto) {
        // Recibir datos del formulario
        $mov_type = 3;
        $prod = $producto[0]; // ID del producto
        $cant = intval($producto[5]); // Cantidad a salir
        $obs = trim($producto[3]); // Observaciones
        $fec_venc = $_POST['salida_fecha'];
        $user_id = $_SESSION['loggedInUser']['USERID']; // Usuario actual
    }

    try {
        // 1. Consultar stock actual y precio del producto
        $sqlStock = $pdo->prepare("SELECT stock_quantity, unit_price FROM tbl_product WHERE id=?");
        $sqlStock->execute([$prod]);
        $product = $sqlStock->fetch(PDO::FETCH_ASSOC);

        if ($product === false) {
            $mensaje = "ERROR: Producto no encontrado.";
            return;
        }

        $stock_actual = $product['stock_quantity'];
        $precio_unitario = $product['unit_price'];  // Usar "unit_price" como el nombre de la columna para el precio

        // 2. Verificar si hay stock suficiente
        if ($stock_actual >= $cant) {
            $new_stock = $stock_actual - $cant;
            $total_compra = $precio_unitario * $cant;  // Calcular el total de la compra

            // 3. Registrar la salida en el historial
            $sqlStatement = $pdo->prepare("INSERT INTO tbl_warehouse_movement(type, product_id, quantity, observation, expiration_date, user_id) VALUES(?,?,?,?,?,?)");
            $sqlStatement->execute([$mov_type, $prod, $cant, $obs, $fec_venc, $user_id]);

            // 4. Registrar la compra en tbl_shopping
            $client_id = $_POST['salida_cliente'];
            $fecha_compra = date("Y-m-d H:i:s");  // Fecha y hora de la compra

            // Insertar el registro de compra en tbl_shopping
            $sqlShopping = $pdo->prepare("INSERT INTO tbl_shopping (client_id, product_id, quantity, fecha_compra, total_compra) VALUES (?, ?, ?, ?, ?)");
            $sqlShopping->execute([$client_id, $prod, $cant, $fecha_compra, $total_compra]);

            // 5. Actualizar el stock del producto
            $sqlUpdateStock = $pdo->prepare("UPDATE tbl_product SET stock_quantity=? WHERE id=?");
            $sqlUpdateStock->execute([$new_stock, $prod]);

            $mensaje = "OK_INSERT";
        } else {
            $mensaje = "ERROR: No hay suficiente stock.";
        }

    } catch (PDOException $e) {
        $mensaje = "ERROR: " . $e->getMessage();
    }
} else {
    $mensaje = "ERROR: Solicitud inválida.";
}

$mensaje;
?>
