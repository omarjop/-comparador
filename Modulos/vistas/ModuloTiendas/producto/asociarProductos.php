
  <?php 
  $valuesMal = "cosa";
  $idCategoria = $objTiendaInicial->getIdCategoria();
  $idTienda = $objTiendaInicial->getIdEmpresa();
  $nitTienda = $objTiendaInicial->getNitEmpresa();
  $objSelect = new ControladorSelectsInTables();
  $objFinP = new ControladorFindProductosTienda();
  $objLog =  new ControladorWorkLogs();
  $objProducto = new ControladorProductosTienda();
  $objLog-> escribirEnLog("Consultar","INFO",$nitTienda,"Se inicia el proceso de Consultar Productos ");
  $valorResult = null;
  $subMensaje = "En este modulo podras asociar productos a tu tienda solo haciendo click en el boton agregar del producto que se desea";


  

      $sql = "SELECT DISTINCT * FROM subcategoria";
      $resultado = $objSelect->selectARowsInDb($sql);
      $mensaje ="Asociar Productos";

  
        if(isset($_POST["precioEdit"])){
             $precioAsociar= strval($_POST['precioEdit']);
             $idProductoAsociar = strval($_POST['idProductoAdd']);
             $objProducto->asociarProductoSeleccionado($idProductoAsociar,$precioAsociar,$idTienda);
             
	    }  

        

  ?>


  <div class="content-wrapper">
               <!-- Content Header (Page header) -->
                
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->

<div class="row">
		                <div class="col-sm-12">
                           <ol class="breadcrumb float-sm-right"> 
                                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="post">
                                      <div class="form-group">                                        
                                          <input type="text" name="BtnMiProducto" id="BtnMiProducto"  class="form-control" placeholder="Buscar producto"/>   
                                          
                                      </div>
                                    <form>
                           </ol>
                        </div>
                        

      </div>

</div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
                           <div class="col-lg-12">
                                   <div class="card" style="color:#AB6F14;font-size:140%;">
                                  <div class="card-body">                                          
                                      <footer class="" style="color:#AB6F14;font-size:110%;"><cite title="Source Title"><?php echo $mensaje;?></cite></footer>                    
                                      <i><h5 style="color:#AB6F14;font-size:70%;"><?php echo $subMensaje;?></h5></i>
                                 </div>
                                </div>
                        </div>
    <?php 
           //echo "<script>toastr.info('+$idTienda+');</script>";  
           $sqlExisteXEmpresa = "SELECT * FROM producto_has_empresa WHERE Empresa_idEmpresa = ".$idTienda;
           $valorAux = $objFinP->returnXSubCategoria($sqlExisteXEmpresa);
           //echo "<script>toastr.info('".count($valorAux)."');</script>";  
            if($valorAux!=null&&$valorAux!="Fallo"){
               
                   $squl1 = "SELECT * from unidadmedida t3 INNER JOIN (SELECT  * FROM producto as t1 where t1.idProducto NOT IN (SELECT Producto_idProducto FROM producto_has_empresa  where Empresa_idEmpresa = ".$idTienda.")) t4  ON t3.idunidadMedida = t4.unidadMedida_idunidadMedida";                   
                   $valorResult = $objFinP->returnXSubCategoria($squl1);
                   
			}else{
            
                   $squl1 = "SELECT * from unidadmedida t3 INNER JOIN (SELECT DISTINCT * FROM producto) t1 on t3.idunidadMedida = t1.unidadMedida_idunidadMedida"; 
                   $valorResult = $objFinP->returnXSubCategoria($squl1);
			}
           

   
    
    ?>
  

                      <div class="container-fluid">
                        <div class="row">
                        <form class="form needs-validation" method="post"  enctype="multipart/form-data"  > 
                         <?php if($valorResult!=null&&$valorResult!="Fallo"){for($j=0;$j<count($valorResult);$j++){?>
                              <div class="col-lg-3">
                                   
                                        <div class="card">
                                              <!--Imagen del producto-->
                                                    <div  style="alaing:center;display: flex;align-items: center;justify-content: center;">
                                                   <a >  <img  class="img-responsive "  src="<?php 
                                                          if(!empty($valorResult[$j]["FotoPrincipal"])){
                                                               $imagen =$valorResult[$j]["FotoPrincipal"];
									                      }else{
                                                               $imagen ='../AdminComparador/imagenes_productos/producto.png';                          
										                  }
                                                          echo $imagen;
                                                      ?>" alt="Card image cap" style="width:160px;alaing:center;height:160px; display: flex;align-items: center;justify-content: center;"  
                                                           
                                                          </a>
                                                </div>
                                              <div class="card-body">
                                                    <h5 class="m-0"style="color:#136574;"></h5> <!--Nombre de tienda-->
                                                    <h5 class="m-0"style="color:#136574;"id="nombreProducto" value="<?php echo $valorResult[$j]["Nombre"];?>" ><?php echo $valorResult[$j]["Nombre"];?></h5><!--Nombre producto-->
                                                    
                                                    <!--Precio-->
                                                    <h6 class="card-title textoprecioproducto" style="color:#D0A20E;font-weight: bold;font-size:19px;font-family:sans-serif;"></h6>
                                                    <!--Unidad de medida-->
                                                    <p class="card-text textounidad" style="color:#136574;font-weight: bold;"><?php  
                                                             $unidad =""; 
                                                              if ($valorResult[$j]["nombreMedida"]== 'gramos (gr)') {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== 'kilogramos (kg)'){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=='centimetros cubicos (cm3)'){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=='mililitros (ml)'){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>
                                                    </p>
                                                        
                                                        <button type="button" class="btn btn-success colorbotonamarillo imagen" style ="width:100%;"
                                                                 src="<?php 
                                                          if(!empty($valorResult[$j]["FotoPrincipal"])){
                                                               $imagen =$valorResult[$j]["FotoPrincipal"];
									                      }else{
                                                               $imagen ='../AdminComparador/imagenes_productos/producto.png';                          
										                  }
                                                          echo $imagen;
                                                      ?>" 
                                                      nombreproducto ="<?php echo $valorResult[$j]["Nombre"];?>" 
                                                      descripcion ="<?php echo $valorResult[$j]["Descripcion"];?>" 
                                                      pesovolumen = "<?php  
                                                             $unidad =""; 
                                                              if ($valorResult[$j]["nombreMedida"]== 'gramos (gr)') {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== 'kilogramos (kg)'){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=='centimetros cubicos (cm3)'){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=='mililitros (ml)'){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>" 
                                                       referencia = "<?php if($valorResult[$j]["Referencia"]!=""){echo $valorResult[$j]["Referencia"];}else {echo "Sin referencia";}?>"
                                                       idProductoAddd = "<?php echo $valorResult[$j]["idProducto"];?>"
                                                       marca ="<?php
                                                                  $marcaDes = $objSelect->selectARowsInDb("select Descripcion from marca where idMarca = ".$valorResult[$j]["Marca_idMarca"]);
                                                                  echo $marcaDes[0]["Descripcion"];
                                                              ?>">Agregar</button>                                                                                                         
                                                                                                         
                                              </div>

                                         </div> 
                                         
             
                              </div>
                               
                          <?php }}?>
                    
          <!-- /.col-md-6 -->
          </form>
		        <div class="modal-footer">

          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




<script type="text/javascript">

$(function(){
     $(".imagen").click(function(){
      var imagenValue = $(this).attr('src');
      $(".imagepreview").attr('src',imagenValue);
      //document.getElementById("precio").innerHTML= "Hoy "+$(this).attr('precio'); 
      document.getElementById("productoname").innerHTML= $(this).attr('nombreproducto');
      document.getElementById("description").innerHTML= $(this).attr('descripcion');
      document.getElementById("pesovolumenes").innerHTML= $(this).attr('pesovolumen');
      document.getElementById("referenciavalue").innerHTML= "Referencia "+$(this).attr('referencia');
      document.getElementById("marcavalue").innerHTML= "Marca "+$(this).attr('marca');
      $(".idProductoAdd").attr('value',$(this).attr('idProductoAddd'));
      $('#imagemodal').modal('show');
  });
  });

// Valida si el campo esta vacio y es requerido ponerlo en rojo cuando se da click
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();



</script>



  <!-- Modal que muestra producto al dar click en la imagen -->
<form class="form " method="post"  enctype="multipart/form-data" onSubmit="return validarAsociarProducto(this);">

        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              <h4  style="color:#136574;" ><i id="productoname"></i></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        
              </div>
              <div class="modal-body" style="background-image: url('../AdminComparador/imagenes_productos/fondo.jpg');width:100%; height: 50%;">
              <div  style="alaing:left;display: flex;align-items: left;justify-content: left;">
                <img src="" class="imagepreview" style="width: 200px; height: 240px;" >

                    <div>
                     <b> <i id="precio" style="color:#0AA778;font-size:140%;" name="precio"></i></b><br>        
                     <b id="pesovolumenes" style="color:#AB6F14;font-size:110%;"></b>
                     <p id="description" style="color:#AB6F14;font-size:100%;font-family: Calibri"></p> 
                     <b id="referenciavalue" style="color:#AB6F14;font-size:100%;font-family: Calibri"></b><br> 
                     <b id="marcavalue" style="color:#AB6F14;font-size:100%;font-family: Calibri"></b>
                     <input  style="visibility: hidden;" type="text" style ="width:80%;" value="" class="form-control idProductoAdd" id="idProductoAdd" name ="idProductoAdd">  
                    </div>
              </div>          
         
              </div>

                    <div class="modal-footer" style="background-color: #C4B59C;">
                    <input   type="text" style ="width:80%;" placeholder="Precio del producto" class="form-control precioEdit" id="precioEdit" name ="precioEdit">  
                <button type="submit" class="btn btn-default colorbotonamarillo" >Agregar</button>
              </div>



            </div>
          </div>
        </div>
</form>
