<?php


// Habilitar visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$mensaje = '';

// Verificar si se enviaron productos
if (isset($_POST['entrada_prods']) && !empty($_POST['entrada_prods'])) {
    $productos = json_decode($_POST['entrada_prods'], true); // Decodificar JSON
} else {
    echo "ERROR: No se enviaron productos.";
    exit;
}

// Verificar si el método es POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    session_start();

    try {
        foreach ($productos as $producto) {
            // Recibir datos del producto
            $mov_type = 1; // Tipo de movimiento (entrada)
            $prod = intval($producto[0]); // ID del producto
            $cant = intval($producto[5]); // Cantidad
            $obs = trim($producto[3]); // Observaciones
            $fec_venc = $_POST['entrada_fecha'];
            $user_id = $_SESSION['loggedInUser']['USERID']; // Usuario actual

            // Consultar stock actual del producto
            $sqlStock = $pdo->prepare("SELECT stock_quantity FROM tbl_product WHERE id=?");
            $sqlStock->execute([$prod]);
            $stock_actual = $sqlStock->fetchColumn();

            if ($stock_actual === false) {
                $mensaje = "ERROR: Producto no encontrado (ID: $prod)";
                continue;
            }

            // Calcular nuevo stock
            $new_stock = $stock_actual + $cant;

            // Registrar la entrada en el historial
            $sqlStatement = $pdo->prepare(
                "INSERT INTO tbl_warehouse_movement (type, product_id, quantity, observation, expiration_date, user_id)
                VALUES (?, ?, ?, ?, ?, ?)"
            );
            $sqlStatement->execute([$mov_type, $prod, $cant, $obs, $fec_venc, $user_id]);

            // Actualizar stock del producto
            $sqlUpdateStock = $pdo->prepare("UPDATE tbl_product SET stock_quantity=? WHERE id=?");
            $sqlUpdateStock->execute([$new_stock, $prod]);

            $mensaje = "OK_INSERT";
        }
    } catch (PDOException $e) {
        $mensaje = "ERROR: " . $e->getMessage();
    }
} else {
    $mensaje = "ERROR: Método no permitido.";
}

// Enviar respuesta
$mensaje;
?>
