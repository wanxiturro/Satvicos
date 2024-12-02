<?php 

session_start();
session_unset();  // Limpiar las variables de sesión
session_destroy();



header("Location: ../");

?>