
<?php
// Verificar si el usuario es un administrador
$is_admin = ($_SESSION['loggedInUser']['USER_TYPE'] === 'admin');

if ($is_admin !== true){
    echo "<style> /* Aplica el cursor 'not-allowed' en el formulario o en los campos deshabilitados */
    .form-disabled {
        cursor: not-allowed;
    }
    
    /* Para deshabilitar visualmente los formularios */
    .form-disabled input, .form-disabled select, .form-disabled button {
        pointer-events: none;
        background-color: #f1f1f1;
        color: #ccc;
    }
    
    
    /* También podemos aplicarlo a los campos deshabilitados directamente */
    input:disabled, select:disabled, button:disabled {
        cursor: not-allowed;
    }
        </style>";
}
?>

<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="<?php echo $functions->direct_paginas()."home" ?>" class="brand-link">
      <img src="<?php echo $functions->direct_sistema(); ?>/img/logo_blanco2.png" alt="Satvicos Logo" width="35" height="35" style="margin-right: 7px;"
           style="opacity: .8">
      <span class="brand-text font-weight-dark text-white"><strong>Satvicos</strong> Alimentos</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      <div class="form-inline mt-2">
        <div class="input-group" data-widget="sidebar-search" data-not-found-text="No se encontraron resultados">
          <input class="form-control form-control-sidebar" type="search" placeholder="Buscar" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

<?php if ($is_admin): include "sidebar-sections/admin.php" ?>      
  <?php else: include "sidebar-sections/logistica.php"?>
  <?php endif; ?>
