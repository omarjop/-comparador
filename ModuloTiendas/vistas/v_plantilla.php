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

    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


  <!-- jQuery -->
<script src="vistas/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="vistas/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="vistas/dist/js/adminlte.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<?php 
    


    if(isset($_GET['ruta'])){
       if($_GET['ruta'] == "producto" || $_GET['ruta'] == "findProduct"|| 
          $_GET['ruta'] == "attachFileProduct"||
          $_GET['ruta'] == "attachFileExcellProduct"||
          $_GET['ruta'] == "connectByApiRest"){
         
            include "vistas/modulos/cabezoteProducto.php";
            include "vistas/MenuTiendas/menu.php";
            include "vistas/producto/".$_GET['ruta'].".php";
          
	   }
	}else{
        
        include "vistas/modulos/cabezote.php";
        include "vistas/MenuTiendas/menu.php";
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
