<?php
session_start();
if (isset($_SESSION['loggedInUser'])) {
  header('Location: views/home');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Satvicos alimentos</title>
  <meta name="description" content="Empresa Venezolana dedicada a la IMPORTACIÓN, COMERCIALIZACIÓN Y DISTRIBUCIÓN de productos del rubro alimenticios.">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Satvicos alimentos">
  <meta property="og:site" content="Satvicos alimentos">
  <meta property="og:url" content="https://satvicosalimentos.com">
  <meta property="og:description" content="Bienvenido a Satvicos alimentos. Inicie sesión para continuar.">
  <meta property="og:image" content="https://duolabgroup.com/duolab/img/duolabgroup_logo.png">

  <meta property="twitter:title" content="Satvicos alimentos">
  <meta property="twitter:description" content="Bienvenido al sistema de Alimentos Satvicos. Inicie sesión para continuar.">
  <meta name="twitter:image" content="https://duolabgroup.com/duolab/img/duolabgroup_logo.png">
  <meta name="twitter:card" content="summary_large_image">
  <!--<meta name="instagram:site" content="@softwans">-->
  
  <meta name="theme-color" content="#e9ecef">
  <meta name="author" content="Juan Cumana">
  
  <link rel="icon" href="./img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
  <link rel="icon" href="./img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/icheck-bootstrap/3.0.1/icheck-bootstrap.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
  <!-- AdminLTE Template Style -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <!-- <a href="#" class="h1"><b>Satvicos </b>Alimentos</a> -->
      <img class="mb-0" src="./img/logo.png" width="225" height="225">
    </div>
    <div class="card-body">
      <p class="login-box-msg">Ingrese sus credenciales para acceder</p>

      <form id="login-form">
        <div class="input-group mb-3">
          <input type="text" name="txtUsername" pattern="[A-Za-z0-9_-]{1,50}" maxlength="50" class="form-control" placeholder="Usuario" required="" autofocus="" autocomplete="username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="txtPassword" pattern="[A-Za-z0-9_-]{1,72}" maxlength="72" class="form-control" placeholder="Contraseña" required="" autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
           <div class="col-1">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" checked>
              <label for="remember">
                Recuerdame
              </label>
            </div>
          </div> 
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" id="btnLogin" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <p class="mb-1" style="display: flex; justify-content: center; align-items: center; margin-top: 15px;">
        <a href="error.php" id="registerLink">Registrarse</a>
      </p>
      
      <p class="mb-1" style="display: flex; justify-content: center; align-items: center; margin-top: 15px;">
        <a href="error.php" id="passwordLink">He olvidado mi contraseña</a>
      </p>
      
      
      <p class="mt-5 mb-3 text-muted text-center">© 2024 Softwans</p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

<script type="text/javascript">
  toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "preventDuplicates": true,
    "onclick": null,
    "showDuration": "500",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }
</script>
<script src="./ajax/login.js"></script>

</body>
</html>
