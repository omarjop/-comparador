<?php
    $url = Ruta::ctrlRuta();    
    $servidor = Ruta::ctrlRutaServidor();  
    session_start();
?>
<!-- TOP -->
<div  class="container-fluid barraSuperior" id="top">  
    <div class="container">
        <div class="row">
            <!--- AVISO INFORMATIVO -->
            <diV class="col-lg-3 col-md-8 col-sm-12 col-xs-12 social">
                <ul>
                    <li>
                        <a href="http://facebook.com" target="_blank">
                        <i class="fa fa-facebook redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com" target="_blank"
                        <i class="fa fa-instagram  redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://twitter.com/" target="_blank">
                        <i class="fa fa-twitter redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.youtube.com/" target="_blank">
                        <i class="fa fa-youtube redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!--- REGISTRO -->
            <diV class="col-lg-9 col-md-4 col-sm-12 col-xs-12 registro">
                <ul>
                <?php 
                    
                    if(isset($_SESSION["validarSesion"])){

                        if($_SESSION["validarSesion"] == "ok"){

                            if($_SESSION["modoAcceso"] == "directo" || $_SESSION["modoAcceso"] == "facebook"){
                                echo '
                                    <li>
                                        <img class="img-circle" src="'.$servidor.'/vistas/img/usuarios/default/anonymous.png" width="4%">
                                    </li>
                                
                                    <li>|</li>
                                    <li><a href="'.$url.'perfil">Ver perfil</a></li>
                                    <li>|</li>
                                    <li><a href="'.$url.'salir" class="salida">Salir</a></li>
                                ';

                            }
                        }
                    }else {
                        echo '

                        <li><a href="#modalIngreso" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i> Ingresar</a></li>
                        <li>|</li>
                        <li><a href="#modalRegistro" data-toggle="modal"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear cuenta</a></li>
    
                        ';

                    }
                ?>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- HEADER -->
<header class="container-fluid">
    <div class="container">
        <div class="row" id="cabezote">
            <!-- ===========================  
                lOGOTIPO
            =============================-->
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12" id="logotipo">
                <a href="<?php echo $url ?>">
                    <img src="http://localhost/AdminComparador/vistas/img/plantilla/logo.png" class="img-responsive">
                </a>
               
            </div>
       
            <!-- =======================
            BLOQUE CATEGORIAS Y BUSCADOR
            ==========================-->
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                        
                    <div class="input-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="buscador">
                        <input type="search" name="buscar" class="form-control" placeholder="Que quieres buscar...">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
                    </div>
            </div>

            <!-- ====================
            MENU DE SERVICIOS
            ========================-->
         <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 " id="carrito">
                <li>
              <?php 
                    
                if(isset($_SESSION["validarSesion"])){
                    if($_SESSION["validarSesion"] == "ok"){
                        echo '
                        ';
                     }
                }
                    
                ?>
                    <ul  class="pull-right">
                        <a href="<?php echo $url;?>listas">
                            <span  data-toggle="tooltip" title="Listas">
                                <img src="http://localhost/AdminComparador/vistas/img/iconos/lista32.png" class="img-responsive ">
                            </span>
                           <!-- <h5>Listas</h5> -->
                        </a>
                    </ul>
                    

                    <ul class="pull-right">
                        <a href="<?php echo $url;?>blog">
                            <span data-toggle="tooltip" title="Blog">
                                <img src="http://localhost/AdminComparador/vistas/img/iconos/blogs32.png" class="img-responsive ">
                            </span>
                           <!-- <h5>Blogs</h5> -->
                        </a>
                    </ul>

                    <ul class="pull-right">
                        <a href="<?php echo $url;?>tiendas">
                            <span data-toggle="tooltip" title="Tiendas">
                                <img src="http://localhost/AdminComparador/vistas/img/iconos/tienda32.png" class="img-responsive ">
                            </span>
                          <!--  <h5>Tiendas</h5> -->
                        </a>
                    </ul>
                            <ul class="pull-right">
                        <a href="<?php echo $url;?>recetas">
                            <span data-toggle="tooltip" title="Recetas">
                                <img src="http://localhost/AdminComparador/vistas/img/iconos/receta32.png" class="img-responsive ">
                            </span>
                            <!-- <h5>Recetas</h5>-->
                        </a>
                    </ul>
                    
                </li>
            </div>
            
        </div>
    </div>
</header>


<!-- ==================================
VENTANA MODAL PARA EL INICIO DE SESÍON
======================================-->
<div class="modal fade modalFormulario" id="modalIngreso" tabindex="-1" role="dialog" aria-labelledby="modalIngreso" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modalTitulo">

        <h3 class="colorbarra">INICIAR SESÍON</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <div class="controlar">
        <div class="col-xs-12 espacio">
            <div class="col-md-12 espacio">
                <form method="post" class="form-signin">
                    <div id="logreg-forms">     
                                    
                        <button class="btn facebook-btn social-btn facebook" type="button"><span><i class="fa fa-facebook"></i> Iniciar con Facebook</span> </button>
                        <button class="btn google-btn social-btn" type="button"><span><i class="fa fa-google-plus"></i> Iniciar con Google+</span> </button>
                        <p><br></p>
                        <div class="form-group">
                            <div class="input-group">
                                <span  class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="email" class="form-control" id="ingresoEmail" name="ingresoEmail" placeholder="Direccion de correo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span  class="input-group-addon">
                                    <i class="glyphicon glyphicon-envelope"></i>
                                </span>
                                <input type="password" id="ingresoPassword"  name="ingresoPassword" class="form-control" autocomplete="on" placeholder="Password" required="">
                            </div>
                        </div>
                        <?php  
                            $ingreso  = new ControladorUsuarios();
                            $ingreso ->ctrlIngresoUsuario();
                        ?>
                        <div>

                        <a href="#modalPassword" data-dismiss="modal" data-toggle="modal" >¿Olvidaste tu contraseña?</a>

                        </div>
                        <br>
                        <button type="submit" class="btn btn-success btn-block btnIngreso" ><i class="fa fa-sign-in"></i> INICIAR SESÍON</button>
                        

                    </div>
                </form>  
            </div>
        </div>
        </div>
      <div class="modal-footer">
      ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
      </div>


    </div>
  </div>
</div>


<!-- ======================================
VENTANA MODAL PARA RECUPERAR LA CONTRASEÑA
==========================================-->
<div class="modal fade modalFormulario" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="modalPassword" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content modalTitulo">

        <h3 class="colorbarra">¿Has olvidado tu contraseña?</h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <div class="controlar">
        <div class="col-xs-12 espacio">
            <div class="col-md-12 espacio">
                <form method="post" class="form-signin">
                    <div id="logreg-forms">     
                                    
                        <h5 text-muted>Por motivos de seguridad, tu clave olvidada debe ser reemplazada por una nueva (no recuperada), para ésto, ingresa el mail que registraste en comparador.com.co</h5>
                        <br>
                        <div class="form-group">
                            <div class="input-group">
                                <span  class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                <input type="email" class="form-control" id="recuperarEmail" name="recuperarEmail" placeholder="Dirección de correo registrado" required>
                            </div>
                        </div>
                        <?php  
                            $password = new ControladorUsuarios();
                            $password ->ctrlOlvidoPassword(); 
                        ?>
                        
                        <button type="submit" class="btn btn-success btn-block" ><i class="fa fa-sign-in"></i> RECUPERAR CONTRASEÑA</button>

                    </div>
                </form>  
            </div>
        </div>
        </div>
        <div class="modal-footer">
        ¿No tienes una cuenta registrada? | <strong><a href="#modalRegistro" data-dismiss="modal" data-toggle="modal">Registrarse</a></strong>
        </div>
    </div>
  </div>
</div>

<!-- ==========================
VENTANA MODAL PARA EL REGISTRO
=============================-->
<div class="modal fade modalFormulario" id="modalRegistro" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-content modal-dialog">
        <div class="modal-body modalTitulo">

            <h3 class="colorbarra"> CREAR UNA CUENTA</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                    <div class="stepwizard-step">
                        <a href="#usu" type="button" class="btn btn-primary btn-circle"><i class="fa fa-user"></i></a>
                        <p>Registro Usuario</p>
                    </div>
                    <div class="stepwizard-step">
                        <a href="#tienda" type="button" class="btn btn-default btn-circle"><i class="fa fa-home"></i></a>
                        <p>Registro Tienda</p>
                    </div>
                </div>
            </div>

            <div class="separar"></div>
            <hr>
            <div class="controlar">
                <!-- ==========================
                REGISTRO PARA USUARIOS
                =============================-->
                <div class="row setup-content" id="usu">
                    <div class="col-xs-12  espacio">
                        <div class="col-md-12 espacio">
                            <form method="post" onsubmit="return registroUsuario()" class="form-signin">
                                <div id="logreg-forms">
                                   <!-- <h3>USUARIO</h3>  -->
                                    <div class="social-login">
                                        <button class="btn facebook-btn social-btn facebook" type="button"><span><i class="fa fa-facebook"></i> Iniciar con Facebook</span> </button>
                                        <button class="btn google-btn social-btn google" type="button"><span><i class="fa fa-google-plus"></i> Iniciar con Google+</span> </button>
                                        
                                        <p><br></p>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span  class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span>
                                                <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Direccion de correo" autocomplete="on" required="" autofocus="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span  class="input-group-addon">
                                                    <i class="glyphicon glyphicon-envelope"></i>
                                                </span>
                                                <input type="password" id="inputPassword"  name="inputPassword" class="form-control" autocomplete="on" placeholder="Password" required="">
                                            </div>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" required="" id="regPoliticas">
                                            <label class="form-check-label" for="exampleCheck1"><a href="">Politica y Condiciones de uso</a></label>
                                            <h5>Al registrarse, Usted Acepta nuestras Condiciones de uso y politica de privacidad</h5>
                                        </div>
                                        <?php  
                                            $registro  = new ControladorUsuarios();
                                            $registro ->ctrlRegistroUsuario();
                                        ?>
                                        <button class="btn btn-success btn-block" type="submit"><i class="fa fa-sign-in"></i> Registrarme</button>
                                        
                                    </div>
                                </div>  
                            </form>  
                        </div>
                    </div>
                </div>
                <!-- ==========================
                REGISTRO PARA TIENDAS
                =============================-->
                <div class="row setup-content" id="tienda">
                    <div class="col-xs-12 espacio">
                        <div class="col-md-6 espacio">
                            <form  method="post" onclass="form-signin">
                                <div id="logreg-forms">
                                    <div class="social-login">
                                        <h3>Registra tu <b>Tienda<b></h3>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span  class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span>
                                               <!--  <input type="text" class="form-control text-uppercase" id="regTienda" name="regTienda" placeholder="Email address" autocomplete="on" required="" autofocus=""> -->
                                            </div>
                                        </div>
                                    
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span  class="input-group-addon">
                                                    <i class="glyphicon glyphicon-envelope"></i>
                                                </span>
                                             <!--   <input type="password" id="regPasswordTienda" name="regPasswordTienda" class="form-control" placeholder="Password" required="" autocomplete="on"> -->
                                            </div>
                                        </div>
                                        
                                        <button class="btn btn-success btn-block" type="submit"><i class="fa fa-sign-in"></i> Registrarse</button>
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
