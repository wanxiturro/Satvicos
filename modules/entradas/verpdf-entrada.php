
<?php
require '../../global/connection.php';

if (isset($_GET['id_pdf']) && isset($_GET['action'])) {
    $id_pdf = $_GET['id_pdf'];
    $action = $_GET['action'];

    // Consultar la base de datos para obtener la ruta del archivo
    $sql = $pdo->prepare("SELECT path_arch FROM tbl_pdf_entry WHERE id_pdf = :id_pdf");
    $sql->bindParam(':id_pdf', $id_pdf, PDO::PARAM_INT);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        $filePath = $row['path_arch'];

        if (file_exists($filePath)) {
            if ($action === "view") {
                // Mostrar el archivo en el navegador
                header('Content-Type: application/pdf');
                header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
                readfile($filePath);
            } elseif ($action === "download") {
                // Forzar la descarga del archivo
                header('Content-Type: application/pdf');
                header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
                readfile($filePath);
            }
        } else {
            echo "Error: El archivo no existe.";
        }
    } else {
        echo "Error: No se encontró un registro para el ID proporcionado.";
    }
} else {
    echo "Error: Parámetros inválidos.";
}
?>
