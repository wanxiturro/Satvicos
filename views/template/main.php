<?php

include './global/config.php';

$url_array = explode("/", $_SERVER["REQUEST_URI"]);
$web_dir_name = "/" . $url_array[1];
$web_root_dir = $_SERVER['DOCUMENT_ROOT'] . $web_dir_name;

date_default_timezone_set("America/Lima");

if (isset($_GET["url"])) {

    // Initialize and check session
    include $web_root_dir.'/global/session.php';

    // Load Web Functions
    include $web_root_dir."/modules/web_functions.php";
    $functions = new WebFunctions();

    // Web Header (Navbar)
    include $web_root_dir."/views/template/header.php";

    //Web Sidebar
    include $web_root_dir."/views/template/sidebar.php";

    // Web View (Content)
    $url = explode("/", $_GET["url"]);
    $url_complete = "";

    if (array_key_exists(2,$url)) {
        $folder = $url[1];
        $page_name = $url[2];
        $url_complete = $folder."/". $page_name;
    } else {
        $page_name = $url[1];
        $url_complete = $page_name;
    }
    
    include $web_root_dir."/views/".$url_complete.".php";

    // Web Footer
    include $web_root_dir."/views/template/footer.php";

    // AJAX Directory Path
    $ajax_dir_path = $functions->direct_sistema()."/ajax/".$page_name.".js?v=".SCRIPT_VER;

    // AJAX Directory Relative Path
    $ajax_dir_rel_path = $functions->directorio_carpetas()."/ajax/".$page_name.".js";

    // Check if an AJAX file for requested view exists 
    if (file_exists($ajax_dir_rel_path)) {
        echo '<script src="' . $ajax_dir_path . '"></script>';
    }

} else {
    // Show login page
    include $web_root_dir . "/views/login.php";
}

?>

<!--Rastreo de teclado -->
<script>
document.addEventListener('keydown', (event) => {
  if(event.key === "Escape") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/home"
    } else if (event.key === "F1") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/productos/listado-producto"; 
    } else if(event.key === "F2") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/proveedores/registro-proveedor"
    }else if(event.key === "F3") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/clientes/registro-cliente"
    }else if(event.key === "F4") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/productos/registro-producto"
    }else if(event.key === "F5") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/productos/actualizar-stock"
    }else if(event.key === "F6") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/entradas/entrada-producto"
    }else if(event.key === "F7") {
      event.preventDefault();
        window.location.href = " http://localhost/satvicos-master/views/salidas/salida-producto"
    }else if(event.key === "F8") {
      event.preventDefault();
        window.location.href = "http://localhost/satvicos-master/views/clientes/registro-cliente"
    }
});

</script>
