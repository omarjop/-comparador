<?php

  class ControladorUsuarios{ 
    
    public function ctrlRegistroUsuario(){

        /*******************************************
        * REGISTRAR USUARIO                        *
        ********************************************/
        if(isset($_POST["inputEmail"])){

            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["inputEmail"]) &&
               preg_match('/^[a-zA-Z0-9]+$/',$_POST["inputPassword"])){

                $encriptar  = crypt($_POST["inputPassword"], '$1$rasmusle$rISCgZzpwk3UhDidwXvin0');
                
                $encriptarEmail  =   md5($_POST["inputEmail"]);

                $datos = array("perfil"=>1,
                               "email"=>$_POST["inputEmail"],
                               "clave"=>$encriptar,
                               "verificacion"=>1,
                                "modoAcceso"=>"Directo",
                                "emailEncriptado"=>$encriptarEmail);
                $tabla= "usuario";
                $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla , $datos);
                if($respuesta=="ok"){

                    /**Verificar correo electoronico */
                    date_default_timezone_set("America/Bogota");

                    $url = Ruta::ctrlRuta();

                    $mail = new PHPMailer;
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

  }