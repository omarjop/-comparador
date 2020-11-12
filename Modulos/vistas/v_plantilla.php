<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">


  <title>AdminLTE 3 | Starter</title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="vistas/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/adminlte.min.css">
  <link href="vistas/estilos/Stilos.css" rel="stylesheet" type="text/css" />
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  	<link rel="stylesheet" href="http://cdn.static.w3big.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="alert/jAlert-v3.min.js"></script>
<link rel="stylesheet" href="alert/jAlert-v3.css" />


 <script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1/jquery.min.js"></script>

 <!--librerias para el autocompletar del consultar------------>
     <script src="bootstrap-autocomplete.min.js"></script>
     <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@v2.3.5/dist/latest/bootstrap-autocomplete.min.js"></script>
     <script src="https://cdn.jsdelivr.net/gh/xcash/bootstrap-autocomplete@master/dist/latest/bootstrap-autocomplete.min.js"></script> 
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

  <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
  <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
  <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  <link rel="stylesheet" href="jqueryui/style.css">



    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/typeahead.js"></script>




 <script src="https://code.jquery.com/jquery-3.5.0.js"></script>


  <!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
<script src="http://localhost/-comparador/Modulos/vistas/js/adminValidaciones.js"></script> 



</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php 
    


    if(isset($_GET['ruta'])){
               if(($_GET['ruta'] == "producto" || $_GET['ruta'] == "findProduct"|| 
                  $_GET['ruta'] == "attachFileProduct"||
                  $_GET['ruta'] == "attachFileExcellProduct"||
                  $_GET['ruta'] == "connectByApiRest"||$_GET['ruta'] =="asociarProductos") && $tipoUser == 1){
         
                    include "vistas/modulos/cabezoteProducto.php";
                    include "vistas/Menus/menu.php";
                    include "vistas/ModuloTiendas/producto/".$_GET['ruta'].".php";

	           }else if(($_GET['ruta'] == "addmarca" || $_GET['ruta'] == "adUnidadMedida"|| 
              $_GET['ruta'] == "addTipoEmpresa" || $_GET['ruta'] == "addTipoProducto"|| $_GET['ruta'] == "addCategorias"|| $_GET['ruta'] == "addPais"|| $_GET['ruta'] == "addPerfil"|| $_GET['ruta'] == "addCiudad"||  $_GET['ruta'] == "addDia"||  $_GET['ruta'] == "addTipoPago"||$_GET['ruta'] == "addNewProductAdmin")&& $tipoUser == 2){

                    include "vistas/modulos/cabezoteProducto.php";
                    include "vistas/Menus/menu.php";
                    include "vistas/ModuloAdmin/".$_GET['ruta'].".php";
               }else{

                            $rutas = array();
                            $ruta =  null;
                            $rutas = explode("/", $_GET["ruta"]); /**el explode ayuda a separar la url por / */
                            var_dump($_GET["ruta"]);
                            $item = "*";
                            $valorDeUrl = null;
                            $valorDeUrl = $_GET["ruta"];
                            $valorAux = "'".$valorDeUrl."'";
                            $condicion =" ruta = ".$valorAux;

                            $objSelect = new ControladorSelectsInTables();
                            $resultSubCategoria = $objSelect->returnSelectARowForField("subcategoria",$item,$condicion);
                            
                         if($resultSubCategoria){
                                    $nombreSubCate = $resultSubCategoria[0]["nombre"] ;
                            
                                    if($valorDeUrl == $resultSubCategoria[0]["ruta"]){
                                            $ruta = $valorDeUrl;
                                     }
                                        if($ruta != null){   
                                              include "vistas/modulos/cabezoteProducto.php";
                                              include "vistas/Menus/menu.php";
                                              include "vistas/ModuloTiendas/producto/findProduct.php"; 
                                        }else{
                                            include "vistas/modulos/cabezoteProducto.php";
                                            include "vistas/Menus/menu.php";
                                            include "vistas/error404.php";
                                        }
                          }else{
                                            include "vistas/modulos/cabezoteProducto.php";
                                            include "vistas/Menus/menu.php";
                                            include "vistas/error404.php";                                
							}
	           }
	}else{
        
        include "vistas/modulos/cabezote.php";
        include "vistas/Menus/menu.php";
        include "vistas/modulos/cuerpo.php";
        
	}
    
    include "vistas/modulos/footer.php";
?>

  <!-- Navbar -->
 

 

  <!-- Content Wrapper. Contains page content -->

  <!-- /.control-sidebar -->

  <!-- Main Footer -->

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

</div>
 
              
</body>
</html>

