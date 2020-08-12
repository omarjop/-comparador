function registroUsuario(){

    /**Validar Email*/
    var email = $("#inputEmail").val();
    
    if(email != ""){

        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;   

         if(!expresion.test(email)){
             
            $("#inputEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>');
            return false;
         }
    } else{
        $("#inputEmail").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Este campo es obligatorio</div>');
         return false;

    }

    /**Valida Contraseña*/
    var passWord = $("#inputPassword").val();
        
    if(passWord != ""){

        var expresion = /^[a-zA-Z0-9]*$/;   

        if(!expresion.test(passWord)){

            $("#inputPassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se aceptan caracteres especales</div>');
            return false;
        }
    } else{
        $("#inputPassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Este campo es obligatorio</div>');
        return false;

    }


    /**Validar terminos y condiciones */
    var politicas = $("#regPoliticas:checked").val(); 
    if (politicas != "on"){
        
        $("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>');
        return false;
    }
    return true;
}


