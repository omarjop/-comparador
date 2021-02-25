<!--  
BANNER
-->
<?php
    $url2 = Ruta::ctrlRutaServidor();     
?>
<figure class="banner">
    <img src="http://localhost/AdminComparador/vistas/img/blog/blog.jpg" class="img-responsive" width="100%">
  
    <div class="textoBanner textoIzq">

        <h1 style="color:#fff">BLOG</h1>

    </div>

</figure>

<div class="container-fluid well well-sm barraProductos">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 organizarProductos">

                
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
    
    <ul class="grid0" id="listaBlogs">
            
            <?php
                        $blogsValue = ControladorBlogs::ctrlMostrarBlogs();  
                               if($blogsValue!=null){
                                    foreach ($blogsValue as $key => $value) {
                                              if($value["estado"]==2){
                                                     $blogsFecha = ControladorBlogs::ctrlReturnFechaForm($value["fechaCreacion"]);  
                                                   echo ' <div class="col-sm-4 col-xs-12">
                                                        <div class="single-blog">
                                                            <div class="single-blog-img">
                                                                <a href="#"  class="click" id="'.$value["idblog"].'" ruta = "'.$url2.'"><img src="'.$url2.'vistas/img/blog/'.$value["imageDestacada"].'" alt="Blog Image"></a>
                                                            </div>
                                                            <div class="blog-content-box">
                                                                <div class="blog-post-date">
                                                                    <span>'.$blogsFecha.'</span>
                                                                </div>
                                                                <div class="blog-content">
                                                                <h4><a href="#" class="click">'.$value["titulo"].'</a></h4>
                                                                </div>
                                                                <div>
                                                                    <div class="meta-post">
                                                                        <span><a href="#"><i class="fa fa-user usuario"></i>'.$value["Nombres"].' '.$value["Apellidos"].'</a></span>
                                                                       </div>
                                                                    <div class="exerpt">
                                                                       '.$value["descripcion"].'
                                                                    </div>
                                                                    <a href="#" class="btn-two click"  id="'.$value["idblog"].'" ruta = "'.$url2.'">Ver mas</a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>';
                                                 }
                                        }
                                  }
                
                ?>
                



                

            </ul>  


<!--Inicio cuadro descripcion receta -->
                <ul class="grid0" id="descripcionBlog">
                        <div class="col-sm-12 col-xs-12">
                             <div class="single-blog">
                                 <div class="single-blog-img" id="blogDesc">                                     
                                 </div>
                             </div>

                             <div>
                                      <h1 class= "titulocategoriaenrecetas"></h1>  
                                      <div class="col-sm-12 col-xs-12" id="comentarioBlog">
                                            <div id="comentario">
                                                     <form >
                                                         <div class="row">
                                                             <div class="col-sm-12 col-xs-12">
                                                             <input style="visibility: hidden;"  type="text" value ="" class="form-control idBlog" id="idBlog" name ="idBlog">  
                                                                   <input type="text" class="form-control" id="comentarioBlogValue" name="comentarioBlogValue" placeholder="Enviar un comentario" required>                                                                  
                                                                        
                                                                  <div class="input-group-append"> 
                                                                   <a onclick="return validarsiesactivoBlog(<?php  if(isset($_SESSION["validarSesion"])){
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
                                                  <div class="single-blog-img col-sm-12 col-xs-12" id="comentariosXBlog" name="comentariosXBlog">                                     
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


