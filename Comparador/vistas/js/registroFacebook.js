$(".facebook").click(function(){

    FB.login(function(response){
        validarUsuario();
    }, {scope: 'public_profile, email'})

})
/** ==================================================
 * VALIDAR INGRESO
 * ====================================================
*/
function validarUsuario(){
    FB.getLoginStatus(function(response){
        statusChangeCallback(response);
    })
}

/** ==================================================
 * VALIDAR EL CAMBIO DE ESTADO DE FACEBOOK
 * ====================================================
*/

function statusChangeCallback(response){

    if(response.status === 'connected'){

        textApi();

    }else{

        swal({
            title: "¡ERROR!",
            text: "¡Error al iniciar con Facebook!",
            type: "error",
            confirmButtonText: "Cerrar",
            closeOnConfirm: false

        },

            function(isConfirm){
                if(isConfirm){
                    window.location = localStorage.getItem('rutaActual');
        }
        });
    }
}

/** ==================================================
 * VALIDAR EL CAMBIO DE ESTADO DE FACEBOOK
 * ====================================================
*/

function textApi(){
    $hoy = Date();
    console.log($hoy);
    FB.api('/me?fields=id,name, email, picture', function(response){

        if(response.email == null){

            swal({
                title: "¡ERROR!",
                text: "¡Para poder ingresar debes proporsionar la informacion del correo electronico!",
                type: "error",
                confirmButtonText: "Cerrar",
                closeOnConfirm: false
    
            },
    
                function(isConfirm){
                    if(isConfirm){
                        window.location = localStorage.getItem('rutaActual');
            }
            });

        }else{
            var email = response.email;
            var nombre = (response.name);
            var foto = "http://graph.facebook.com/"+response.id+"/picture?type=large";

            var datos = new FormData();
            datos.append("email", email);
            $.ajax({
                url:rutaOculta+"ajax/usuario.ajax.php",
                method:"POST",
                data: datos, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta){

                    if(respuesta == "ok"){

                        window.location = localStorage.getItem("rutaActual");

                    }else{
                        swal({
                            title: "¡ERROR!",
                            text: "¡El correo electronico "+email+" ya esta registrado con un metodo diferente a facebook!",
                            type: "error",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                            
                            },
                            
                            function(isConfirm){
                                if(isConfirm){
                                   FB.getLoginStatus(function(response){

                                       if(response.status === 'connected'){

                                           FB.logout(function(response){

                                                deleteCookie("628429304487987");
                                                
                                                setTimeout(function(){
                                                    window.location = rutaOculta+"salir";
                                                }, 500)
                                           });

                                           function deleteCookie(name){

                                               document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';

                                           }
                                       }
                                   })
                                }
                        });

                    }

                }
            })
        }
    })
}
/** ==================================================
 * SALIR DE FACEBOOK
 * ====================================================
*/
$(".salida").click(function(){

    /**e.preventDefault();*/

    FB.getLoginStatus(function(response){
 
         if(response.status === 'connected'){
 
             FB.logout(function(response){
 
                 deleteCookie("628429304487987");
                 
                 setTimeout(function(){
                     window.location = rutaOculta+"salir";
                 }, 500)
             });
 
             function deleteCookie(name){
 
                 document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
 
             }
         }
     })
})