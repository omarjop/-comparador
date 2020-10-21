<?php
    $url = Ruta::ctrlRuta();    
    if(isset($_SESSION["id"])){
        $idUsu = $_SESSION["id"];
    }else{
        $idUsu = 10;
    }
?>
<div class="container-fluid">
    <div class="container">
    
        <!---========================================  
        MENÚ DE LISTA 
        ===========================================-->
        
        <div class=" colorFondo col-lg-3 col-md-3 col-sm-2 col-xs-12" >   
        
            <div class=" mt-3 pb-3 mb-3 d-flex text-center">
                <img src="<?php echo $url ?>vistas/img/usuario/listas-de-verificacion.png" class="img-rounded elevation-2" alt="">
            </div>
            <ul class="nav flex-column ">
                <li class="nav-item">
                    <a class="nav-link " href="#modalListaCompra" data-toggle="modal"> <i class="fa fa-plus-circle"></i> Crear nueva lista</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url;?>listas"> <i class="fa fa-list"></i>Mis listas creadas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $url;?>listas-compartidas"> <i class="fa fa-share-alt"></i> Listas compartidas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="<?php echo $url;?>listas-de-recetas"> <i class="fa fa-cutlery"></i> Listas de recetas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url;?>papelera"> <i class="fa fa-trash"></i> Papelera</a>
                </li>
                <h3> Mis Listas</h3>
                
                <div class="scrollLista">
                    <?php  
                        if(isset($_SESSION["id"])){
                            $item1 = "Persona_idPersona";
                            $item2 = "listaCompra_idListaCompra";
                            $valor1 = strval($idUsu);
                            $valor2 = "1";
                            $mostrarListas = ControladorListas::ctrlMostrarListas($item1, $item2, $valor1, $valor2); 
                            $cantidadLista = sizeof($mostrarListas);
                            foreach ($mostrarListas as $key => $value) {
                                echo '
                                    <li class="nav-item">
                                        <a class="listEditView" href="#" id="'.$value["idListaCompra"].'"> <img src="'.$url.'vistas/img/usuario/memorandum.png">'.$value["nombreLista"].'</a>
                                    </li>
                                ';
                           }
                        }else{/*.$_COOKIE['lista-compra'].*/
                            echo' 
                            <li class="nav-item">
                                <a class="nav-link " href="#"> <img src="'.$url.'vistas/img/usuario/memorandum.png" class="img-rounded" alt="">Preubas</a>
                            </li>
                            
                            ';

                        }
                    ?>
                </div>
            </ul>
        </div>
        <!---========================================  
        LISTAS COMPARTIDAS style="display:none"
        ===========================================-->
        <ul class="listasCompartidasD">
            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 text-center" id="infoListas">
                <?php  
                    if(isset($_SESSION["id"])){
                        $item1 = "Persona_idPersona";
                        $item2 = "listaCompra_idListaCompra";
                        $valor1 = strval($idUsu);
                        $valor2 = "3";
                        $listasCompartidas = ControladorListas::ctrlMostrarListas($item1, $item2, $valor1, $valor2); 
                        $cantidadListaCom = sizeof($listasCompartidas);
                        
                        if($cantidadListaCom > 0){
                            echo '
                            <div class="p-3 mb-2 titiloInf"><i class="fa fa-share-alt"></i> Tus listas compartidas</div>
                            <div class="row">';
                            foreach ($listasCompartidas as $key => $value) {
                                echo' <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" id="infoListas">
                                        
                                        <div class="cnt-block equal-hight" style="height: 220px;">
                                            <figure><img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-responsive" alt=""></figure>
                                            <h3><a href="http://www.webcoderskull.com/">'.$value["nombreLista"].'</a></h3>
                                                <ul class="follow-us clearfix">
                                                <li><span data-toggle="tooltip" title="Comparar lista"><a href="#"><i class="fa fa-refresh" aria-hidden="true"></i></a> </span></li>
                                                <li><span data-toggle="tooltip" title="Ver y editar lista"><a href="#" id="'.$value["idListaCompra"].'"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Compartir lista"><a href="#" value="'.$value["nombreLista"].'"><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Elimirar lista"><a href="#modalEliminarLista" data-toggle="modal"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Programar lista"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i></a> </span></li>
                                            </ul>
                                        </div>
                        
                                    </div>';
                            }
                        }else{
                            echo '
                                <li>
                                    <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                                    <div class="h-30"></div>
                                    <p> No tienes listas compartidas. <br> crea una lista y compártela con tus amigos. </p>
                                    <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Crear Lista</button>

                                </li>';
                        }               
                    }else{

                        echo '
                        <li>
                            <img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-rounded elevation-2" alt="">
                            <div class="h-30"></div>
                            <p> No tienes listas compartidas.</p>
                            <button type="button" class="btn backColor" data-toggle="modal" data-target="#modalListaCompra"><i class="fa fa-sign-in"></i> Crear Lista</button>

                        </li>';
                    }
                ?>
            </div>
        </ul>


    </div>
</div>

<!-- =======================================
VENTANA MODAL PARA CREAR LISTAS DE COMPRA
============================================-->
<div class="modal fade modalFormulario" id="modalListaCompra" tabindex="-1" role="dialog" aria-labelledby="modalListaCompra" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modalTitulo">

            <h3 class="colorbarra"><i class="fa fa-list" aria-hidden="true"></i> CREAR LISTA</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>

            <div class="controlar">
            <div class="col-xs-12 espacio">
                <div class="col-md-12 espacio">
                    <form method="post" class="form-signin">
                        <div id="logreg-forms">     
                        
                            <div class="form-group">
                                <label for="validation01">Como quieres llamar a tu lista. </label>
                                <input type="text" class="form-control is-valid" id="nombreLista" name="nombreLista"
                                        placeholder="Nombre de tu lista" value="" required>
                            </div>
                            <?php  
                            /**AQUI PUEDO COLOCAR UNA CONDISION PARA VALIDAR LA VARIABLE DE SESION 
                                * DEL USUARIO SI EXISTE LLAMO AL CONTROLADOR 
                                */
                                $crearLista = new ControladorListas();
                                $crearLista->ctrlCrearLista($idUsu); 
                            ?>
                            <button type="submit" class="btn backColor btn-block" ><i class="fa fa-sign-in"></i> CREAR LISTA</button>
                        </div>
                    </form>  
                </div>
            </div>
            </div>
            <div class="modal-footer"> </div>
        </div>
    </div>
</div>