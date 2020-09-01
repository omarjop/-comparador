<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta  name="title" content="comparador">
    <meta  name="description" content="describir la pagina">
    <meta  name="keyword" content="todas las palabras claves separadas con  comas ,">
    <title>Comparador</title>
    <?php
        /** Mantener la ruta fija del proyecto*/
        $url = Ruta::ctrlRuta();
        
    ?>

    <!---   PLUGINS DE CSS-->
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plugins/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plugins/sweetalert.css">
    
    <!--  Hojas de Estilos personalizadas-->

    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/cabecera.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plantilla.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/slide.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/servicios.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/ofertas.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/productos.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/testimonio.css">
    

    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   
    <script src="<?php echo $url ?>vistas/js/plugins/jquery.min.js"></script>
    <script src="<?php echo $url ?>vistas/js/plugins/bootstrap.min.js"></script>
    <script src="<?php echo $url ?>vistas/js/plugins/sweetalert.min.js"></script>
    

    
</head>
<body>
    <?php  
        /**CABEZOTE DE LA PAGINA */
        include "modulos/cabezote.php";
       
        /** se valida si existe la variable ruta que es la que esta de finida 
         * en el archivo htacces*/
        $rutas = array();
        $ruta =  null;

        if(isset($_GET["ruta"])){

            $rutas = explode("/", $_GET["ruta"]); /**el explode ayuda a separar la url por / */
            
            $item = "ruta";
            $valor = $_GET["ruta"];

            $rutaCategoria = ControladorProductos::CtrlMostrarCategorias($item, $valor);
            
            if($valor == $rutaCategoria["ruta"]){
                $ruta = $valor;
            }
            if($ruta != null){
            
                include "modulos/productos.php"; 

            } else{
                
                if($rutas[0] == "verificar" || $rutas[0] == "salir"){

                    include "modulos/".$rutas[0].".php";

                }else{

                    include "modulos/error404.php";

                }
            }
        }else{

            include "modulos/slide.php";
            include "modulos/v_servicios.php";
            include "modulos/ofertas.php";
            include "modulos/testimonio.php";
            
        }

    ?>
<input type="hidden" value="<?php echo $url; ?>" id="rutaOculta">

<!--=====================================
JAVASCRIPT PERSONALIZADO
======================================--> 
<script src="<?php echo $url ?>vistas/js/slider.js"></script> 
<script src="<?php echo $url ?>vistas/js/ofertas.js"></script> 
<script src="<?php echo $url ?>vistas/js/herramienta.js"></script> 
<script src="<?php echo $url ?>vistas/js/usuario.js"></script> 
<script src="<?php echo $url ?>vistas/js/registroFacebook.js"></script> 

<!--=====================================
INICIO SE SESION CON FACEBOOK 
======================================--> 
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '628429304487987',
      cookie     : true,
      xfbml      : true,
      version    : 'v8.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

</body>
</html>