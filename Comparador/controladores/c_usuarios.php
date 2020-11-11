<?php


  class ControladorUsuarios{ 
    
    public function ctrlRegistroUsuario(){
        $url = Ruta::ctrlRuta();
        $mdlVista = Ruta::ctrlRutaServidor();
        /*******************************************
        * REGISTRAR USUARIO                        *
        ********************************************/
        if(isset($_POST["inputEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["inputEmail"]) &&
               preg_match('/^[a-zA-Z0-9]+$/',$_POST["inputPassword"])){

               /**  $encriptar  = crypt($_POST["inputPassword"], '$1$rasmusle$rISCgZzpwk3UhDidwXvin0');*/
               $contrasena = $_POST["inputPassword"];
               $encriptar = password_hash($contrasena, PASSWORD_DEFAULT, array("cost"=>12));
               $hoy = getdate();
                
                $encriptarEmail  =   md5($_POST["inputEmail"]);

                $datos = array("perfil"=>1,
                               "email"=>$_POST["inputEmail"],
                               "clave"=>$encriptar,
                               "verificacion"=>1,
                                "modoAcceso"=>"directo",
                                "fechaRegistro"=> $hoy,
                                "emailEncriptado"=>$encriptarEmail);
                $tabla= "usuario";
                $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla , $datos);
                
                if($respuesta=="ok"){

                    /**Verificar correo electoronico */
                    date_default_timezone_set("America/Bogota");

                    $mail = new PHPMailer;
                    $mail->CharSet ='UTF-8';
                    $mail-> isMail();
                    $mail->setFrom('omarjop@gmail.com', 'Tutoriales a tu Alcance');
                    $mail->addReplyto('omarjop@gmail.com', 'Tutoriales a tu Alcance');
                    $mail->Subject  = "por favor verifique su correo";
                    $mail->addAddress($_POST["inputEmail"]);
                    $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
	
                        <center>
                            
                            <img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">

                        </center>

                        <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                        
                            <center>
                            
                            <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-email.png">

                            <h3 style="font-weight:100; color:#999">VERIFIQUE SU DIRECCIÓN DE CORREO ELECTRÓNICO</h3>

                            <hr style="border:1px solid #ccc; width:80%">

                            <h4 style="font-weight:100; color:#999; padding:0 20px">Para comenzar a usar su cuenta de Tienda Virtual, debe confirmar su dirección de correo electrónico</h4>

                            <a href="'.$url.'verificar/'.$encriptarEmail.'" target="_blank" style="text-decoration:none">

                            <div style="line-height:60px; background:#0aa; width:60%; color:white">Verifique su dirección de correo electrónico</div>

                            </a>

                            <br>

                            <hr style="border:1px solid #ccc; width:80%">

                            <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

                            </center>

                        </div>

                    </div>');

                    $envio = $mail->Send();
                    if($envio){
                        echo '<script> 
                            swal({
                                    title: "¡ok!",
                                    text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico '.$_POST["inputEmail"].' para verificar la cuenta!",
                                    type: "success",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false
                                },
                                    function(isConfirm){
                                        if(isConfirm){
                                            history.back();
                                        }
                            });
                        
                        </script>';
                    }else{

                        echo '<script> 
                            swal({
                                    title: "¡ERROR!",
                                    text: "¡Ha ocurrido un problema enviando verifiacion de correo electronico a  '.$_POST["inputEmail"].$mail->ErrorInfo.'!",
                                    type: "error",
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                },

                                    function(isConfirm){
                                        if(isConfirm){
                                            history.back();
                                        }
                            });
                            
                        </script>';
                    }
                }

            }else{

                echo '<script> 
                    swal({
                            title: "¡ERROR!",
                            text: "¡Error al registrar el usuario, no se permiten caracteres  especiales!",
                            type: "error",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        },

                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                    });
                    
                </script>';

            }

        }

    }  

    /********************************************
     * Mostrar usuario                          *
     * ******************************************/
    static public function ctrlMostrarUsuario($item, $valor){

        $tabla = "usuario";

        $respuesta = ModeloUsuarios:: mdlMostrarUsuario($tabla, $item, $valor);

        return $respuesta;
    }

    /********************************************
     * Actualizar vericacion del correo usuario *
     * ******************************************/
    static public function ctrlActualizarUsuario($id, $item, $valor){

        $tabla = "usuario";

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item, $valor);

        return $respuesta;

    }
    /********************************************
     * INGRESO DE USUARIO                       *
     * ******************************************/
    public function ctrlIngresoUsuario(){

        if(isset($_POST["ingresoEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["ingresoEmail"]) &&
            preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingresoPassword"])){

                $clave = htmlentities(addslashes($_POST["ingresoPassword"]));
                
                $tabla = "usuario";
                $item = "correo";
                $valor = $_POST["ingresoEmail"];

                $respuesta = ModeloUsuarios::mdlMostrarUsuario($tabla, $item, $valor);

                if($respuesta["correo"] == $_POST["ingresoEmail"]  && password_verify($clave, $respuesta["Clave"])){

                    if($respuesta["verificar"] == 1){

                        echo '<script> 
                        swal({
                        title: "¡NO HA VERIFICADO SU CORREO ELECTRONICO!",
                        text: "¡Por favor revise la bandeja de entrada o la carpetad e SPAM  de su correo para verificar la direccion de correo electrónico '.$respuesta["correo"].'!",
                        type: "error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                        },
                            function(isConfirm){
                                if(isConfirm){
                                  history.back();
                                }
                        });
                
                        </script>';

                    }else{
                        if($respuesta["Perfil_idPerfil"] == 1){

                            $_SESSION["validarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta["idUsuario"];
                            $_SESSION["perfil"] = $respuesta["Perfil_idPerfil"];
                            $_SESSION["correo"] = $respuesta["correo"];
                            $_SESSION["password"] = $respuesta["Clave"];
                            $_SESSION["modoAcceso"] = $respuesta["modoAcceso"];
                            echo '<script> 
                                window.location = localStorage.getItem("rutaActual");
                            </script>';
                        }
                       /* if($respuesta["Perfil_idPerfil"] == 2){
                            echo '<script> 
                            alert("gola");
                                window.location = "../Modulos/index.php?id=2?usu=42";
                            </script>';

                        }*/
                    }
                }else{
                    echo '<script> 
                        swal({
                                title: "¡ERROR AL INGRESAR!",
                                text: "¡Por favor revise que el email exista o la contraseña coincida con la registrada!",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false

                            },

                                function(isConfirm){
                                    if(isConfirm){
                                        window.location = localStorage.getItem("rutaActual");
                                    }
                        });
                        
                    </script>';
                }

            }else{
                echo '<script> 
                    swal({
                            title: "¡ERROR!",
                            text: "¡Error al ingresar al sistema, no se permiten caracteres especiales!",
                            type: "error",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        },

                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                    });
                    
                </script>';
            }
            
        }
       
    }

    /********************************************
     * OLVIDO CONTRASEÑA *
     * ******************************************/
    public function ctrlOlvidoPassword(){

        if(isset($_POST["recuperarEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["recuperarEmail"])){
                
                /********************************************
                 * GENERAR CONTRASEÑA AÑEATORIA             *
                 * ******************************************/
                function generarPassword($longitud){
                    $key = "";
                    $pattern = "123456789abcdefghijklmnopqrstuwxyz";
                    $max = strlen($pattern);
                    for($i = 0; $i < $longitud; $i++){
                        $key .= $pattern{mt_rand(0,$max)};
                    }
                    return $key;
                }

                $pass =  generarPassword(10);
                $encriptarPass = password_hash($pass, PASSWORD_DEFAULT, array("cost"=>12));

                $tabla = "usuario";
                $item1 = "correo";
                $valor1 = $_POST["recuperarEmail"];

                $respuesta1 = ModeloUsuarios:: mdlMostrarUsuario($tabla, $item1, $valor1);

                if($respuesta1){

                    $id = $respuesta1["idUsuario"];
                    $item3 = "Clave";
                    $valor3 = $encriptarPass;
                    $respuestaA = ModeloUsuarios::mdlActualizarUsuario($tabla, $id, $item3, $valor3);
                    
                    if($respuestaA == "ok"){

                            date_default_timezone_set("America/Bogota");

                            $url = Ruta::ctrlRuta();

                            $mail = new PHPMailer;
                            $mail->CharSet ='UTF-8';
                            $mail-> isMail();
                            $mail->setFrom('omarjop@gmail.com', 'Tutoriales a tu Alcance');
                            $mail->addReplyto('omarjop@gmail.com', 'Tutoriales a tu Alcance');
                            $mail->Subject  = "Solicitud de nueva contraseña";
                            $mail->addAddress($_POST["recuperarEmail"]);
                            $mail->msgHTML('
                                    <div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
                                    
                                    <center>
                                        
                                        <img style="padding:20px; width:10%" src="http://tutorialesatualcance.com/tienda/logo.png">

                                    </center>

                                    <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                    
                                        <center>
                                        
                                        <img style="padding:20px; width:15%" src="http://tutorialesatualcance.com/tienda/icon-pass.png">

                                        <h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

                                        <hr style="border:1px solid #ccc; width:80%">

                                        <h4 style="font-weight:100; color:#999; padding:0 20px">Su Nueva contraseña : '.$pass.'</h4>

                                        <a href="'.$url.'" target="_blank" style="text-decoration:none">

                                        <div style="line-height:60px; background:#0aa; width:60%; color:white">Ingrese nuevamente al sitio. </div>

                                        </a>

                                        <br>

                                        <hr style="border:1px solid #ccc; width:80%">

                                        <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

                                        </center>

                                    </div>

                                </div>');

                            $envio = $mail->Send();
                            if($envio){
                                echo '<script> 
                                    swal({
                                            title: "¡ok!",
                                            text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electronico '.$_POST["recuperarEmail"].' para cambiar se contraseña!",
                                            type: "success",
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false
                                        },
                                            function(isConfirm){
                                                if(isConfirm){
                                                    history.back();
                                                }
                                    });
                                
                                </script>';
                            }else{

                                echo '<script> 
                                    swal({
                                            title: "¡ERROR!",
                                            text: "¡Ha ocurrido un problema enviando verifiacion de correo electronico a  '.$_POST["inputEmail"].$mail->ErrorInfo.'!",
                                            type: "error",
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false

                                        },

                                            function(isConfirm){
                                                if(isConfirm){
                                                    history.back();
                                                }
                                    });
                                    
                                </script>';
                            }
                    }

                }else{
                    
                    echo '<script> 
                        swal({
                                title: "¡ERROR!",
                                text: "¡El correo electónicono no existe en el sistema!",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false

                            },

                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                        });
                    
                    </script>';
                }      

            }else {
                echo '<script> 
                    swal({
                            title: "¡ERROR!",
                            text: "¡Error al enviar el correo electónico, está mal escrito!",
                            type: "error",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        },

                            function(isConfirm){
                                if(isConfirm){
                                    history.back();
                                }
                    });
                    
                </script>';
            }
        }

    }
     /********************************************
     *  REGISTRO CON REDES SOCIALES
     * ******************************************/

    static public function ctrlResgistroRedesSociales($datos){

        $tabla= "usuario";
        $item= "correo";
        $valor = $datos["email"];

        $emailRepetido = false;

        $respuesta0 = ModeloUsuarios:: mdlMostrarUsuario($tabla, $item, $valor);

        if($respuesta0){

            $emailRepetido = true;

        }else{

            $respuesta1 = ModeloUsuarios::mdlRegistroUsuario($tabla , $datos);

        }
        
        if( $emailRepetido || $respuesta1 =="ok"){


            $respuesta2 = ModeloUsuarios:: mdlMostrarUsuario($tabla, $item, $valor);

            if($respuesta2["modoAcceso"] == "facebook"){
                
                session_start();
                $_SESSION["validarSesion"] = "ok";
                $_SESSION["id"] = $respuesta2["idUsuario"];
                $_SESSION["perfil"] = $respuesta2["Perfil_idPerfil"];
                $_SESSION["correo"] = $respuesta2["correo"];
                $_SESSION["password"] = $respuesta2["Clave"];
                $_SESSION["modoAcceso"] = $respuesta2["modoAcceso"];
                echo "ok";
            }else{
                echo "";
            }

        }else{

            echo '<script> 
            swal({
                    title: "¡ERROR!",
                    text: "¡Error al iniciar sesíon con face!",
                    type: "error",
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                },

                    function(isConfirm){
                        if(isConfirm){
                            history.back();
                        }
            });
            
            </script>';

        }  
    }


  }