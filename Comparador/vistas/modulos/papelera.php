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
        LISTAS BORRADAS style="display:none"
        ===========================================-->
        <ul class="listasborradasC">
       
            <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 text-center" id="infoListas"> 
            
                <?php  
                    if(isset($_SESSION["id"])){
                        
                        $item1 = "Persona_idPersona";
                        $item2 = "listaCompra_idListaCompra";
                        $valor1 = strval($idUsu);
                        $valor2 = "2";
                        $mostrarListasBorradas = ControladorListas::ctrlMostrarListas($item1, $item2, $valor1, $valor2); 
                        $cantidadLista = sizeof($mostrarListasBorradas);
                       if($cantidadLista > 0){
                            echo '<div class="p-3 mb-2 titiloInf"><i class="fa fa-trash"></i> Tus Listas Borradas</div>';
                            foreach ($mostrarListasBorradas as $key => $value) {
                                echo '
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" id="infoListas">
                                            
                                        <div class="cnt-block equal-hight" style="height: 220px;">
                                            <figure><img src="'.$url.'vistas/img/usuario/listas-de-verificacion1.png" class="img-responsive" alt=""></figure>
                                            <h3><a href="http://www.webcoderskull.com/">'.$value["nombreLista"].'</a></h3>
                                            <ul class="follow-us clearfix">
                                                <li><span data-toggle="tooltip" title="Recuperar lista"><a class="recuperarlista" href="#"  id="'.$value["idListaCompra"].'"><i class="fa fa-recycle" aria-hidden="true"></i></a></li>
                                                <li><span data-toggle="tooltip" title="Borrado total"><a href="#modalEliminarLista" data-toggle="modal"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                
                                    </div>
                                    ';
                            }
                       }else{
                            echo' 
                            <li>
                                <img src="'.$url.'vistas/img/usuario/basura.png" class="img-rounded elevation-2" alt=""> 
                                <div class="h-30"></div>
                                <p> La lista eliminada va a la papelera. Si necesita <br> la lista de la papelera, puedes recuperarla. </p>
                            </li>
                            ';
                       }
                    }else{/*.$_COOKIE['lista-compra'].*/
                        echo' 
                        <li>
                            <img src="'.$url.'vistas/img/usuario/basura.png" class="img-rounded elevation-2" alt=""> 
                            <div class="h-30"></div>
                            <p> La lista eliminada va a la papelera. Si necesita <br> la lista de la papelera, puedes recuperarla. </p>
                        </li>
                        ';
                    }
                ?>
            </div>
        </ul>

    </div>
</div>