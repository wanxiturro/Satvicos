<?php

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    require '../../global/connection.php';

    $u_usuario = trim($_POST['usuario_nombre']);
    $u_password = trim($_POST['usuario_pass']);
    $u_empid = $_POST['usuario_empleado_id'];
    $u_peruser = $_POST['usuario_permissions'];  // Corregido el error aquí
    $u_fecreg = date("Y-m-d H:i:s");
    $u_iduser = $_POST['usuario_id'];

    // Verificar si el nombre de usuario ya existe
    if ($u_iduser == "" || $u_iduser == null) {
        $sqlStatement = $pdo->prepare("SELECT * FROM tbl_user WHERE username=:usuario");
        $sqlStatement->bindParam("usuario", $u_usuario, PDO::PARAM_STR);
    } else {
        $sqlStatement = $pdo->prepare("SELECT * FROM tbl_user WHERE (username=:usuario) AND (id <> :iduser)");
        $sqlStatement->bindParam("usuario", $u_usuario, PDO::PARAM_STR);
        $sqlStatement->bindParam("iduser", $u_iduser, PDO::PARAM_INT);
    }

    $sqlStatement->execute();
    $rowsNumber = $sqlStatement->rowCount();
    if ($rowsNumber == 0) {

        if ($u_password != "" && $u_password != null){
            $hashedPassword = password_hash($u_password, PASSWORD_DEFAULT);
        }

        if ($u_iduser == "" || $u_iduser == null) {
            // Insertar nuevo usuario
            $sqlStatement = $pdo->prepare("INSERT INTO tbl_user(username, password, employee_id, registration_date, permissions) VALUES(?,?,?,?,?)");
            if ($sqlStatement) {
                $sqlStatement->execute([$u_usuario, $hashedPassword, $u_empid, $u_fecreg, $u_peruser]);
                echo "OK_INSERT";
            } else {
                echo "ERROR";
            }
        } else {
            // Actualizar usuario existente
            if ($u_password == "" || $u_password == null) {
                // Actualizar sin cambiar la contraseña
                $sqlStatement = $pdo->prepare("UPDATE tbl_user SET username=?, employee_id=?, permissions=? WHERE id=?");
                $sqlParameters = [$u_usuario, $u_empid, $u_peruser, $u_iduser];
            } else {
                // Actualizar con la nueva contraseña
                $sqlStatement = $pdo->prepare("UPDATE tbl_user SET username=?, password=?, employee_id=?, permissions=? WHERE id=?");
                $sqlParameters = [$u_usuario, $hashedPassword, $u_empid, $u_peruser, $u_iduser];
            }
            if ($sqlStatement) {
                $sqlStatement->execute($sqlParameters);
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
?>
