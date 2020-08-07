<?php
    $url = Ruta::ctrlRuta();    
?>
<!-- TOP -->
<div  class="container-fluid barraSuperior" id="top">  
    <div class="container">
        <div class="row">
            <!--- AVISO INFORMATIVO -->
            <diV class="col-lg-9 col-md-8 col-sm-12 col-xs-12 social">
                <ul>
                    <li>
                        <a href="http://facebook.com" target="_blank">
                        <i class="fa fa-facebook redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://google.com" target="_blank">
                        <i class="fa fa-google-plus redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://facebook.com" target="_blank"
                        <i class="fa fa-instagram  redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://facebook.com" target="_blank">
                        <i class="fa fa-twitter redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li>
                        <a href="http://facebook.com" target="_blank">
                        <i class="fa fa-youtube redSocial facebookBlanco" aria-hidden="true"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!--- REGISTRO -->
            <diV class="col-lg-3 col-md-4 col-sm-8 col-xs-12 registro">
                <ul>
                    <li><a href="#modalIngreso" data-toggle="modal"><i class="fa fa-sign-in" aria-hidden="true"></i> Ingresar</a></li>
                    <li>|</li>
                    <li><a href="#modalrRegistro" data-toggle="modal"><i class="fa fa-user-plus" aria-hidden="true"></i> Crear cuenta</a></li>
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
                
                    <!-- ====================
                    BOTON DE CATEGORIAS
                    ========================-->
                    <div class="col-lg-4 col-md-5 col-sm-3 col-xs-5 backColor" id="btnCategorias" >
                        <ul>
                            <li class="upper-links dropdown"><a class="links" href="#">CATEGORÍAS<span class="pull-right"><i class="fa fa-bars" aria-hidden="true"></i></span> </a> 
                                <ul class="dropdown-menu">
                                    <?php 
                                        $item = null;
                                        $valor =   null;
                                        $categorias = ControladorProductos::CtrlMostrarCategorias($item, $valor);
                                        
                                        foreach ($categorias as $key => $value) {
                                            echo '
                                            <li><a href="'.$value["ruta"].'"  class="pixelCategorias"> '.$value["nombre"].'</a></li>                                 
                                            ';
                                        }
                                    ?>  
                                </ul>  
                            </li>
                        </ul>
                    </div>
                        
                    <!-- ====================
                    BUSCADOR
                    ========================-->
                    <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscador">
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
                <a href="#">
                    <button class="btn btn-default pull-right" data-toggle="tooltip" data-placement="bottom" title="Crea tus Listas">
                        <i class="fa fa-list -alt" aria-hidden="true"style=" font-size:30px;"></i>
                    </button>
                </a>
                <a href="#">
                    <button class="btn btn-default pull-right" data-toggle="tooltip" data-placement="bottom" title="Blog">
                        <i class="fa fa-comments-o" aria-hidden="true" style=" font-size:30px;"></i>
                    </button>
                </a>
                <a href="#">
                    <button class="btn btn-default pull-right" data-toggle="tooltip" data-placement="bottom" title="Controlar gastos">
                        <i class="fa fa-money " aria-hidden="true"style=" font-size:30px;"></i>
                    </button>
                </a>
                <a href="#">
                    <button class="btn btn-default pull-right" data-toggle="tooltip" data-placement="bottom" title="Blog">
                        <i class="fa fa-bullhorn" aria-hidden="true"style=" font-size:30px;"></i>
                    </button>
                </a>
            </div>
            
        </div>
    </div>
</header>
<!-- ==========================
VENTANA MODAL PARA EL REGISTRO
=============================-->
<div class="modal fade modalFormulario" id="modalrRegistro" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-content modal-dialog">
        <div class="modal-body modalTitulo">

            <h3 class="backColor"> CREAR UNA CUENTA</h3>
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
                            <form  method="post" onclass="form-signin">
                                <div id="logreg-forms">
                                   <!-- <h3>USUARIO</h3>  -->
                                    <div class="social-login">
                                        <button class="btn facebook-btn social-btn" type="button"><span><i class="fa fa-facebook"></i> Sign in with Facebook</span> </button>
                                        <button class="btn google-btn social-btn" type="button"><span><i class="fa fa-google-plus"></i> Sign in with Google+</span> </button>
                                        
                                        <p style="text-align:center">   </p>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span  class="input-group-addon">
                                                    <i class="glyphicon glyphicon-user"></i>
                                                </span>
                                                <input type="email" class="form-control text-uppercase" id="inputEmail" name="inputEmail" placeholder="Email address" required="" autofocus="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span  class="input-group-addon">
                                                    <i class="glyphicon glyphicon-envelope"></i>
                                                </span>
                                                <input type="password" id="inputPassword"  name="inputPassword" class="form-control" placeholder="Password" required="">
                                            </div>
                                        </div>
                                        <div class="form-group form-check">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1" required="">
                                            <label class="form-check-label" for="exampleCheck1"><a href="">Terminos y Condiciones de uso</a></label>
                                            <h5>Al registrarse, Usted Acepta nuestras Condiciones de uso y politica de privacidad</h5>
                                        </div>
                                       
                                        <button class="btn btn-success btn-block" type="submit"><i class="fa fa-sign-in-alt"></i> Enviar</button>
                                        
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
                           <!-- Autocomplete location search input --> 
                            <div class="form-group">
                                <label>Location:</label>
                                <input type="text" class="form-control" id="search_input" placeholder="Type address..." />
                                <input type="hidden" id="loc_lat" />
                                <input type="hidden" id="loc_long" />
                            </div>

                            <!-- Display latitude and longitude -->
                            <div class="latlong-view">
                                <p><b>Latitude:</b> <span id="latitude_view"></span></p>
                                <p><b>Longitude:</b> <span id="longitude_view"></span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>