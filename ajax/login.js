$(document).on('submit', '#login-form', function(event){
    event.preventDefault();

    var rememberMe = $('#remember').is(':checked') ? 1 : 0;

    var formData = $(this).serialize() + '&remember=' + rememberMe;

    $.ajax({
        url: 'modules/login.php',
        type: 'POST',
        dataType: 'json',
        data: formData,
        beforeSend: function(){
            $('#btnLogin').val('Validando...');
        }
    })
    .done(function(response){
        if(response.error == null){
            console.log(response);
            toastr.error(response, 'Error desconocido');
            return;
        }
        if(!response.error){
            location.href = 'views/home';
        }else{
            toastr.error('Las credenciales que ha ingresado no son válidas','Acceso Denegado:');
            $('#btnLogin').val('Ingresar');
        }        
    })
    .fail(function(response){
        console.log(response.responseText);
        toastr.error(response.responseText,'Error de respuesta del servidor');
    })
    .always(function(){
        //console.log('AJAX call complete');
    });
});

// Notificación de registro de usuario
$(document).ready(function() { 
    $('#registerLink').on('click', function(e) { 
        e.preventDefault(); 
        toastr.error('Diríjase a un superior para que lo registre al sistema.', 'Acceso Denegado:'); 
        $('#btnLogin').val('Ingresar'); 
    }); 
}); 

// Notificación de olvido de contraseña
$(document).ready(function() { 
    $('#passwordLink').on('click', function(e) { 
        e.preventDefault(); 
        toastr.error('Diríjase a un superior para que reestablezca su contraseña.', 'Acceso Denegado:'); 
        $('#btnLogin').val('Ingresar'); 
    }); 
});
