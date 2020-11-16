<!--  
BANNER
-->
<?php
    $url = Ruta::ctrlRuta();   
?>

<figure class="banner">
    <img src="http://localhost/AdminComparador/vistas/img/blog/portada.jpg" class="img-responsive" width="100%">
  
    <div class="textoBanner textoIzq">

        <h1 style="color:#fff">BLOG</h1>

    </div>

</figure>

<div class="container-fluid well well-sm barraProductos">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 organizarProductos">
               <span class="visible-lg visible-md visible-sm pull-left textmenuamarillo"> Recetas</span>
                <div class="btn-group pull-right">

                    <button type="button" class="btn btn-default btnGrid" id="btnGrid0">
                        <i class="fa fa-th" aria-hidden="true"></i>
                        <span class="visible-lg visible-md visible-sm pull-right"> GRID</span>
                    </button>

                    <button type="button" class="btn btn-default btnList" id="btnList0">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span class="visible-lg visible-md visible-sm pull-right"> Lista</span>
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<!---========================================  
MOSTRAR UNA LISTA DE 6 BLOGS POR CADA PAGINA
===========================================-->
<div class="container-fluid blogs">
    <div class="container">
	    <div class="row">

    <!---========================================  
    BLOG EN CUADRICULA
    ===========================================-->
            <ul class="grid0" id="recetasPorCategoria">
               
               <!--Inicia cuadro de receta categoria-->
                  <?php

                       $item1 = "idCategoria";
                       $item2 = "categoria_idCategoria";
                       $mostrarRecetas = ControladorRecetas::ctrlMostrarRecetas($item1, $item2);
                       
                       if(isset($ruta)){
                           $item1 = "categoria_idCategoria";
                           $item2 = "idCategoria";
                           $item3 = "ruta";
                           $item4 = "iddificultad";
                           $item5 = "dificultad_iddificultad";
                           $mostrarRecetas = ControladorRecetas::ctrlMostrarRecetasPorCategoria($item1, $item2, $item3, $ruta,$item4,$item5); 

                                foreach ($mostrarRecetas as $key => $value) {
                                       echo ' <div class="col-sm-4 col-xs-12">
                                            <div class="single-blog">
                                                <div class="single-blog-img">
                                                    <a href="#" class="detalleLista" id="'.$value["idRecetas"].'"><img src="'.$url.'vistas/img/usuario/pollo-con-jitomates-rostizados.jpg" alt="Blog Image"></a>
                                                </div>
                                                <div class="blog-content-box">
                                                    <div class="blog-post-date">
                                                        <span>'.$value["porciones"].'</span>
                                                        <span>Porciones</span>
                                                    </div>
                                                    <div class="blog-content ">
                                                    <h class= "sutitulosubreceta">'.$value["nombreReceta"].'</h>
                                                    </div>
                                                    <div>
                                                        <div class="meta-post">
                                                             <div class="col-lg-12">
                                                                <span data-toggle="tooltip" title="Comentarios"><a href="#"><i class="fa fa-commenting-o"></i> 12 M</a></span>
                                                                <span data-toggle="tooltip" title="Tiempo de preparacion"><i class="fa fa-clock-o"></i> '.$value["tiempo"].'min</span>
                                                                <span data-toggle="tooltip" title="Dificultad"><i ></i> '.$value["nombre"].'</span>
                                                                <span data-toggle="tooltip" title="Compartir"><a href="#"><i class="fa fa-share-alt"></i> </a></span>
                                                              </div>
                                                     </div>
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>'; 
                                 }

                       }else{
                               foreach ($mostrarRecetas as $key => $value) {
                                       echo ' <div class="col-sm-4 col-xs-12">
                                                    <div class="single-blog">
                                                        <div class="single-blog-img">
                                                            <a href='.$value["ruta"].'><img src="'.$url.'vistas/img/usuario/pollo-con-jitomates-rostizados.jpg" alt="Blog Image"></a>
                                                        </div>
                                                        <div >                                                    
                                                                   <h1 class= "titulocategoriaenrecetas">'.$value["nombre"].'</h1>
                                                         
                                                        </div>
                                                     </div>
                                               </div>';   
                                 }
                              }
                   ?>
                <!--Finaliza cuadro de receta categoria-->
 

            </ul> 

            <!--Inicio cuadro descripcion receta -->
                <ul class="grid0" id="descripcionReceta">
                        <div class="col-sm-12 col-xs-12">
                             <div class="single-blog">
                                 <div class="single-blog-img" id="recetaDesc">                                     
                                 </div>

                                 <div>
                                      <h1 class= "titulocategoriaenrecetas"></h1>                              
                                 </div>
                              </div>
                        </div>
                </ul>
            <!--Finaliza cuadro descripcion receta -->
	    </div>
    </div>
</div>