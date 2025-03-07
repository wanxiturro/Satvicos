<?php

if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

    require '../global/connection.php';

    $username = $_POST['txtUsername'];
    $password = $_POST['txtPassword'];
    $remember = isset($_POST['remember']) ? $_POST['remember'] : 0; // Capturamos si se marcó "Recuerdame"

    $sqlStatement = $pdo->prepare("SELECT u.id AS USERID, u.username AS USERNAME,
        u.password AS PASS, u.photo_url AS PHOTO_URL, e.job AS JOB,
        CONCAT(e.name, ' ', e.last_name_1) AS EMPLOYEE_NAME, u.permissions AS PERMISSION
        FROM tbl_user u JOIN tbl_employee e ON u.employee_id=e.id
        WHERE u.username=:username");

    $sqlStatement->bindParam("username", $username, PDO::PARAM_STR);
    $sqlStatement->execute();

    $rowsNumber = $sqlStatement->rowCount();

    if ($rowsNumber == 1) {

        $sqlData = $sqlStatement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $sqlData['PASS'])) {

            $sqlData['PASS'] = ""; // Limpiar la contraseña antes de guardarla

            if ($sqlData['PHOTO_URL'] == "") {
                $sqlData['PHOTO_URL'] = "default-avatar.png";
            }

    // ACÁ ESTAN LAS VARIBLES DE LOS ROLES Y LA DEFINICION DE "USER_TYPE" MENCIONADO POR EL IF DE LA COLUMNA "PERMISSIONS" 
        switch ($sqlData['PERMISSION']) {
            case 1:
                $sqlData['USER_TYPE'] = 'admin';
                $sqlData['PHOTO_URL'] = "admin-avatar.png";
                break;
            case 2:
                $sqlData['USER_TYPE'] = 'logistics';
                $sqlData['PHOTO_URL'] = "avatar1.png";
                break;
            case 3:
                $sqlData['USER_TYPE'] = 'sales';
                $sqlData['PHOTO_URL'] = "avatar4.png";
                break;
            default:
                $sqlData['USER_TYPE'] = 'common';
                $sqlData['PHOTO_URL'] = "default-avatar.png";
                break;
        }
    
            session_start();
            $_SESSION['loggedInUser'] = $sqlData;

            // Crear cookie si "Recuerdame" está marcado
            if ($remember == 1) {
                setcookie('rememberMe', $username, time() + (86400 * 7), "/"); // Cookie válida por 7 días
            }

            echo json_encode(array('error' => false, 'userType' => $sqlData['USER_TYPE']));

        } else {
            echo json_encode(array('error' => true));
        }

    } else {
        echo json_encode(array('error' => true));
    }
}
?>
