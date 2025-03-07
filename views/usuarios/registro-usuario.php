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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-0">
                <div class="col-md-12">
                    <div class="m-0 text-dark text-center text-lg">
                        <i class="fas fa-user-cog"></i>&nbsp;&nbsp;Registro de Usuario
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div style="max-width: 1140px;margin: 0 auto;">
                <form id="FRM_INSERT_USUARIO" method="post" action="<?php echo $functions->direct_sistema(); ?>/modules/usuarios/insert-update-usuario.php" enctype="multipart/form-data" class="<?php echo !$is_admin ? 'form-disabled' : ''; ?>">
                    <input type="hidden" name="usuario_id">
                    <div class="card card-primary">
                        <div class="card-header">
                            <div class="card-title">Datos de Usuario</div>
                            <div class="float-right" style="height: 2rem; width: 150px">
                                <input type="text" placeholder="Código de usuario" class="form-control" name="usuario_codigo" readonly>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Usuario</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-at"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" placeholder="Ingrese nombre de usuario" name="usuario_nombre" pattern="[A-Za-z0-9_-]{1,50}" maxlength="50" autocomplete="username" <?php echo !$is_admin ? 'disabled' : ''; ?> required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label><i class="fas fa-user-tie"></i> Empleado</label>
                                        <select class="form-control select2" style="width: 100%;" name="usuario_empleado_id" <?php echo !$is_admin ? 'disabled' : ''; ?> required>
                                            <option value="">Seleccione empleado</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Fecha de Registro</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="far fa-calendar-alt"></i>
                                                </span>
                                            </div>
                                            <input type="date" id="usuario_fecreg" class="form-control" name="usuario_fecreg" defaultValue="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" readonly <?php echo !$is_admin ? 'disabled' : ''; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                    <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                            </div>
                                        <select class="form-control select3" style="width: 35%;" name="usuario_permissions" required >
                                            <option value="0">Seleccione un rol</option>
                                            <option value="4">Usuario</option>
                                            <option value="3">Ventas</option>
                                            <option value="2">Logistica</option>
                                            <option value="1">Administrador</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-secondary" id="password-card">
                                        <div class="card-header">
                                            <div id="password-card-header" class="btn-block" data-card-widget="collapse" data-toggle="tooltip" title="Colapsar"><i class="fas fa-plus"></i>&nbsp;&nbsp;<font>Contraseña</font></div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label id="pass-label-1"><font>Contraseña</font></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-key"></i>
                                                                </span>
                                                            </div>
                                                            <input type="password" id="usuario_pass" class="form-control" placeholder="Ingrese contraseña" name="usuario_pass" pattern="[A-Za-z0-9_-]{1,72}" maxlength="72" autocomplete="new-password" <?php echo !$is_admin ? 'disabled' : ''; ?> required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label id="pass-label-2"><font>Confirmar Contraseña</font></label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-key"></i>
                                                                </span>
                                                            </div>
                                                            <input type="password" id="usuario_pass_conf" class="form-control" placeholder="Confirme contraseña" name="usuario_pass_conf" pattern="[A-Za-z0-9_-]{1,72}" maxlength="72" autocomplete="new-password" <?php echo !$is_admin ? 'disabled' : ''; ?> required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div id="col-btn-save-user" class="col-md-12" style="alignment-baseline: central;">
                            <button type="submit" id="btn-save-user" class="btn btn-success btn-block" <?php echo !$is_admin ? 'disabled' : ''; ?>><i class="fa fa-save fa-1x"></i>&nbsp;&nbsp;<font>Crear Usuario</font></button>
                        </div>
                        <div id="col-btn-delete-user" class="col-md-6">
                            <button type="button" id="btn-delete-user" js-id="" class="btn btn-danger btn-block" <?php echo !$is_admin ? 'disabled' : ''; ?>><i class="fa fa-trash fa-1x"></i>&nbsp;&nbsp;Eliminar usuario</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Aquí verificamos si el usuario es admin -->
            <?php if ($is_admin): ?>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-usuarios" class="table table-bordered table-hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Nombre de Usuario</th>
                                        <th>Cód. Empleado</th>
                                        <th>Empleado</th>
                                        <th>Cargo</th>
                                        <th>Fec. Registro</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>001</td>
                                        <td>usuario1</td>
                                        <td>001</td>
                                        <td>Empleado 1</td>
                                        <td>Cargo 1</td>
                                        <td>2024-11-28</td>
                                    </tr>
                                    <tr>
                                        <td>002</td>
                                        <td>usuario2</td>
                                        <td>002</td>
                                        <td>Empleado 2</td>
                                        <td>Cargo 2</td>
                                        <td>2024-11-28</td>
                                    </tr>
                                    <!-- Agrega más registros aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <!-- Si el usuario no es admin, mostramos un mensaje en lugar de la tabla -->
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" style="width: 100%; text-align:center;">
                                <thead>
                                    <tr>
                                        <th>Acceso denegado</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>No tienes permisos</td>
                                    </tr>
                                <thead>
                                    <tr>
                                        <th>Acceso denegado</th>

                                    </tr>
                                </thead>
                                    <!-- Agrega más registros aquí -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
