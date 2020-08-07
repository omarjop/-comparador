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

    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plugins/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plugins/font-awesome.min.css">

    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/cabecera.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/plantilla.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/slide.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/servicios.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/ofertas.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/productos.css">
    <link rel="stylesheet" href="<?php echo $url ?>vistas/css/testimonio.css">

    <script src="https://maps.googleapis.com/maps/api/js? key=3.exp&libraries=places"></script>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300&display=swap" rel="stylesheet">
   
    <script src="<?php echo $url ?>vistas/js/plugins/jquery.min.js"></script>
    <script src="<?php echo $url ?>vistas/js/plugins/popper.min.js"></script>
    <script src="<?php echo $url ?>vistas/js/plugins/bootstrap.min.js"></script>

    
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

                include "modulos/error404.php";
            }
        }else{

            include "modulos/slide.php";
            include "modulos/v_servicios.php";
            include "modulos/ofertas.php";
            include "modulos/testimonio.php";
            
        }

    ?>

<script src="<?php echo $url ?>vistas/js/slider.js"></script> 
<script src="<?php echo $url ?>vistas/js/ofertas.js"></script> 
<script src="<?php echo $url ?>vistas/js/herramienta.js"></script> 
</body>
</html>