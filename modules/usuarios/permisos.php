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