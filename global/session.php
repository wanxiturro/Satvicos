<?php

session_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();  // Solo se inicia si no está activa
}

if (!isset($_SESSION['loggedInUser'])) {
	header("Location: ../../index.php");
}else{
	//print_r($_SESSION['loggedInUser']);
}

?>