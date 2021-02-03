<!--  
BANNER
-->
<?php
    $url = Ruta::ctrlRuta(); 
    
?>
<figure class="banner">
    <img src="http://localhost/AdminComparador/vistas/img/recetas/cocina.jpg" class="img-responsive" width="100%">
  
    <div class="textoBanner textoIzq">

        <h1 style="color:#fff">RECETAS</h1>

    </div>

</figure>

<div class="container-fluid well well-sm barraProductos">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 organizarProductos">
               
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
                                      <div class="col-sm-12 col-xs-12" id="comentarioReceta">
                                            <div id="comentario">
                                                     <form >
                                                         <div class="row">
                                                             <div class="col-sm-12 col-xs-12">
                                                             <input style="visibility: hidden;"  type="text" value ="" class="form-control idReceta" id="idReceta" name ="idReceta">  
                                                                   <input type="text" class="form-control" id="comentarioRecetaValue" name="comentarioRecetaValue" placeholder="Enviar un comentario" required>                                                                  
                                                                        
                                                                  <div class="input-group-append"> 
                                                                   <a onclick="return validarsiesactivo(<?php  if(isset($_SESSION["validarSesion"])){
                                                                                                             if($_SESSION["validarSesion"] == "ok"){
                                                                                                                  $persona = $_SESSION["id"];
                                                                                                                  $variable = '1';
                                                                                                             }else{
                                                                                                                $variable = '0';
                                                                                                                $persona = '0';
																											 }
                                                                                                         }else{
                                                                                                            $variable = '0';
																										 }
                                                                                                         echo $variable;?>,<?php 
                                                                                                         if(isset($_SESSION["validarSesion"])){
                                                                                                             if($_SESSION["validarSesion"] == "ok"){
                                                                                                                  $persona = $_SESSION["id"];
                                                                                                                  $variable = '1';
                                                                                                             }else{
                                                                                                                $variable = '0';
                                                                                                                $persona = '0';
																											 }
                                                                                                         }else{
                                                                                                            $variable = '0';
                                                                                                             $persona = '0';
																										 }
                                                                                                            
                                                                                                      echo $persona;?>);" id = "1"  class="btn btn-success botonComentario "><i class="fa fa-plus-circle" aria-hidden="true"></i> <span id = "1" class="enviaComentario">Enviar</span></a>
                                                                </div>
                                                             </div>
                                                         </div>
                                                      <br>
                                                </form>
                                            </div>
                                        <div id="mensaje">
                                         <h class="textoComentarioTitulo" >Comentarios</h>
                                         <p></p>
                                         </div>
                                         <br></br>
                                         <div class="row">
                                              <div class="single-blog-img col-sm-12 col-xs-12" id="comentariosXReceta" name="comentariosXReceta">                                     
                                              </div> 
                                          </div> 
                                      </div>
                                 </div>

                              </div>
                        </div>
                </ul>
            <!--Finaliza cuadro descripcion receta -->
            
	    </div>
    </div>
</div>





