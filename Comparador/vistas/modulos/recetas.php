<!--  
BANNER
-->
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
            <ul class="grid0">
               
               <!--Inicia cuadro de receta categoria-->
                  <?php

                       $item1 = "idCategoria";
                       $item2 = "categoria_idCategoria";
                       $mostrarRecetas = ControladorRecetas::ctrlMostrarRecetas($item1, $item2);
                       
                       if(isset($ruta)){
                           $item1 = "categoria_idCategoria";
                           $item2 = "idCategoria";
                           $item3 = "ruta";
                           $mostrarRecetas = ControladorRecetas::ctrlMostrarRecetasPorCategoria($item1, $item2, $item3, $ruta); 

                                foreach ($mostrarRecetas as $key => $value) {
                                       echo ' <div class="col-sm-4 col-xs-12">
                                            <div class="single-blog">
                                                <div class="single-blog-img">
                                                    <a href="blog_single.html"><img src="http://demos.codexcoder.com/labartisan/html/heaven-hands-demo/images/home-blog-01.jpg" alt="Blog Image"></a>
                                                </div>
                                                <div class="blog-content-box">
                                                    <div class="blog-post-date">
                                                        <span>10</span>
                                                        <span>FEB 2020</span>
                                                    </div>
                                                    <div class="blog-content">
                                                    <h4><a href="">'.$value["nombreReceta"].'</a></h4>
                                                    </div>
                                                    <div>
                                                        <div class="meta-post">
                                                           
                                                            <span><a href="#"><i class="fa fa-commenting-o"></i> 12 M</a></span>
                                                            <span><i class="fa fa-thumbs-o-up"></i> 1</span>
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
                                                    <a href="blog_single.html"><img src="http://demos.codexcoder.com/labartisan/html/heaven-hands-demo/images/home-blog-01.jpg" alt="Blog Image"></a>
                                                </div>
                                                <div class="blog-content-box">
                                                    <div class="blog-post-date">
                                                        <span>10</span>
                                                        <span>FEB 2020</span>
                                                    </div>
                                                    <div class="blog-content">
                                                    <h4><a href='.$value["ruta"].'>'.$value["nombre"].'</a></h4>
                                                    </div>
                                                    <div>
                                                       
                                                        

                                                    </div>
                                                </div>
                                            </div>
                                        </div>';   
                                 }
                              }
                   ?>
                <!--Finaliza cuadro de receta categoria-->
 

            </ul> 
	    </div>
    </div>
</div>