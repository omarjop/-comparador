/**=================================================
 * CAPTURAR RUTA ACTUAL
 ==================================================*/
var rutaActual = location.href;

$(".btnIngreso").click(function(){

    localStorage.setItem("rutaActual", rutaActual);
})

/**=================================================
 * FORMATEAR LOS CAMPOS
 ==================================================*/
$("input").focus(function(){

    $(".alert").remove();
})

/**=================================================
 * VALIDAR USUARIO REPETIDO
 ==================================================*/
 var rutaOculta = $("#rutaOculta").val();
 var bandera = false;
 var correoAux = "";

 $("#inputEmail").change(function(){

    var email = $("#inputEmail").val();
    var datos = new FormData();
    datos.append("validarEmail", email);

    $.ajax({
        url:rutaOculta+"ajax/usuario.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta == "false"){
                $(".alert").remove();
                bandera = false;
            }else{
                
                var modo = JSON.parse(respuesta).modoAcceso;
                var correo = JSON.parse(respuesta).correo;
                
                if(modo = "directo"){
                    modo = "esta pagina";
                    if (correo != correoAux){
                        bandera= false;
                        $(".alert").remove();
                    }
                }
                if(!bandera){
                    $("#regPoliticas").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> El correo electrónico '+correo+' ya Existe, usted se registro a través de '+modo+'</div>');
                    bandera = true; 
                    correoAux = correo;
                }
            }
        }

    })

 })
/**=================================================
 * VALIDAR CAMPOS DE REGISTROS  
 ==================================================*/
function registroUsuario(){
    $(".alert").remove();
    var email = $("#inputEmail").val();
    if(email != ""){

        var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;   
        
        if(!expresion.test(email)){
             
            $("#inputEmail").parent().before('<div class="alert alert-warning "><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>');   
            return false;
        }
        if(bandera){
            $("#inputEmail").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong> El correo electrónico ya existe en la base de datos, por favor ingrese otro diferente</div>');
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

            $("#inputPassword").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se aceptan caracteres especiales</div>');
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


