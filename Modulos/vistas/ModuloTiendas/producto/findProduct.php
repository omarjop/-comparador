
  <?php 
  $valuesMal = "cosa";
   if(isset($_POST["btnEliminarValue"])){                           
           /* $ingreso  = new ControladorEliminarProductosTienda();
            $ingreso ->EliminarProducto($_POST["campoOculto2"]);*/
            echo '<script>toastr.info('.$_POST["campoOculto2"].');</script>';
                            
    }
  
      $idTienda = $objTiendaInicial->getIdCategoria();
      $objSelect = new ControladorSelectsInTables();
      $objFinP = new ControladorFindProductosTienda();
      
      $valorResult = null;
      $sql = "SELECT  DISTINCT idsubCategoria ,nombre,ruta from subcategoria t3 INNER JOIN (SELECT DISTINCT subCategoria_idsubCategoria FROM producto t1 INNER JOIN ( SELECT Producto_idProducto FROM producto_has_empresa  where Empresa_idEmpresa = ".$idTienda." ) t2 ON t1.idProducto  = t2.Producto_idProducto) t4 ON t3.idsubCategoria  = t4.subCategoria_idsubCategoria";
      $resultado = $objSelect->selectARowsInDb($sql);
      $mensaje ="Productos a Consultar";

      if(isset($valorDeUrl)){
           $valorDeUrl = "'".$valorDeUrl."'";
           $squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idTienda."  and ruta = ".$valorDeUrl.") t2 ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.Producto_idProducto  = t4.idProducto) t6 ON t5.Producto_idProducto = t6.Producto_idProducto";
           $valorResult = $objFinP->returnXSubCategoria($squl1);
           $mensaje = "Categoria  ".$nombreSubCate;
	  }else{
           
           $squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idTienda.") t2 ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.Producto_idProducto  = t4.idProducto) t6 ON t5.Producto_idProducto = t6.Producto_idProducto";
           $valorResult = $objFinP->returnXSubCategoria($squl1);
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
		                <div class="col-sm-5">
                                <form class="form-horizontal" role="form">
                                      <div class="form-group">                                        
                                          <input type="text" class="autocomplete form-control" id="sampleAutocomplete" data-toggle="dropdown" />
                                          <ul class="dropdown-menu" role="menu">
                                              <li><a>Action</a></li>
                                              <li><a>Another action</a></li>
                                              <li><a>Something else here</a></li>
                                              <li><a>Separated link</a></li>
                                          </ul>
                                     
                                      </div>
                                    <form>
                        </div>

          <div class="col-sm-7">
                <ol class="breadcrumb float-sm-right">  
                        <li class="nav-item dropdown breadcrumb-item activ">

                                   <a class="nav-link" data-toggle="dropdown" href="#">
                                      <i class="fa fa-search" aria-hidden="true"> Consultar Mis Productos</i>                                 
                                    </a>


                                   <!-- SEARCH FORM -->

                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                       <?php for($i=0;$i<count($resultado);$i++){?>
                                          <a href="<?php echo $resultado[$i]["ruta"];?>" onclick="searchForCategory(<?php $resultado[$i]["idsubCategoria"];?>)" class="dropdown-item">
                                            <!-- Message Start -->
                                                <div class="media">
                                                      <img src="../AdminComparador/imagenes_productos/Producto.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                                      <div class="media-body">
                                                            <h3 class="dropdown-item-title">
                                                              <?php echo $resultado[$i]["nombre"];?>
                                                              <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                                            </h3>                                                       
                                                          </div>
                                                </div>
                                            <!-- Message End -->
                                          </a>
                                       <?php }?>
                                    </div>                            
                         </li> 
                </ol>
          </div><!-- /.col -->
      </div>

</div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

    <?php if(!isset($valorDeUrl)){
          for($i=0;$i<count($resultado);$i++){
           $ruta = $resultado[$i]["ruta"];
           $ruta =  "'".$ruta."'";
           $squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idTienda."  and ruta = ".$ruta.") t2 ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.Producto_idProducto  = t4.idProducto) t6 ON t5.Producto_idProducto = t6.Producto_idProducto";
           $valorResult = $objFinP->returnXSubCategoria($squl1);
           $mensaje = "Categoria  ".$resultado[$i]["nombre"];   
    
    ?>

                            <div class="col-lg-12">
                                   <div class="card" style="color:#AB6F14;font-size:140%;">
                                  <div class="card-body">                                          
                                      <footer class="" style="color:#AB6F14;font-size:110%;"><cite title="Source Title"><?php echo $mensaje;?></cite></footer>                    
                                  </div>
                                </div>
                        </div>


                      <div class="container-fluid">
                        <div class="row">
                        <form class="form needs-validation" method="post"  enctype="multipart/form-data"  > 
                         <?php if($valorResult!=null){for($j=0;$j<count($valorResult);$j++){?>
                              <div class="col-lg-3">
                                   
                                        <div class="card">
                                              <!--Imagen del producto-->
                                                    <div  style="alaing:center;display: flex;align-items: center;justify-content: center;">
                                                     <img  class="img-responsive imagen"  src="<?php 
                                                          if(!empty($valorResult[$j]["FotoPrincipal"])){
                                                               $imagen =$valorResult[$j]["FotoPrincipal"];
									                      }else{
                                                               $imagen ='../AdminComparador/imagenes_productos/producto.png';                          
										                  }
                                                          echo $imagen;
                                                      ?>" alt="Card image cap" style="width:160px;alaing:center;height:160px; display: flex;align-items: center;justify-content: center;"  
                                                           precio = "<?php echo "$".$valorResult[$j]["precioReal"];?>" 
                                                           nombreproducto ="<?php echo $valorResult[$j]["Nombre"];?>" 
                                                           descripcion ="<?php echo $valorResult[$j]["Descripcion"];?>" 
                                                           pesovolumen = "<?php  
                                                             $unidad =""; 
                                                              if ($valorResult[$j]["nombreMedida"]== 'gramos') {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== 'kilogramos'){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=='centimetros'){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=='mililitros'){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>" 
                                                              referencia = "<?php if($valorResult[$j]["Referencia"]!=""){echo $valorResult[$j]["Referencia"];}else {echo "Sin referencia";}?>"
                                                              marca ="<?php
                                                                  $marcaDes = $objSelect->selectARowsInDb("select Descripcion from marca where idMarca = ".$valorResult[$j]["Marca_idMarca"]);
                                                                  echo $marcaDes[0]["Descripcion"];
                                                              ?>">
                                                </div>
                                              <div class="card-body">
                                                    <h5 class="m-0"style="color:#136574;"></h5> <!--Nombre de tienda-->
                                                    <h5 class="m-0"style="color:#136574;"id="nombreProducto" value="<?php echo $valorResult[$j]["Nombre"];?>" ><?php echo $valorResult[$j]["Nombre"];?></h5><!--Nombre producto-->
                                                    
                                                    <!--Precio-->
                                                    <h6 class="card-title textoprecioproducto" style="color:#D0A20E;font-weight: bold;font-size:19px;font-family:sans-serif;"><?php echo "$".$valorResult[$j]["precioReal"];?></h6>
                                                    <!--Unidad de medida-->
                                                    <p class="card-text textounidad" style="color:#136574;font-weight: bold;"><?php  
                                                             $unidad =""; 
                                                              if ($valorResult[$j]["nombreMedida"]== 'gramos') {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== 'kilogramos'){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=='centimetros'){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=='mililitros'){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>
                                                    </p>
                                                        <p style ="position: absolute; right: 10;" data-placement="top" data-toggle="tooltip" title="Editar"><span class="fas fa-pen-alt"></span></p>
                                                        <p style ="position: absolute; right: 40;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span id = "<?php echo $valorResult[$j]["idProducto"];?>" class="far fa-trash-alt eliminar"></span></p>      
                                                                                                              
                                              </div>

                                         </div> 
                                         
             
                              </div>
                               
                          <?php }}?>
                    <?php }}else{?>
                       <div class="col-lg-12">
                                   <div class="card" style="color:#AB6F14;font-size:140%;">
                                  <div class="card-body">                                          
                                      <footer class="" style="color:#AB6F14;font-size:110%;"><cite title="Source Title"><?php echo $mensaje;?></cite></footer>                    
                                  </div>
                                </div>
                        </div>


                      <div class="container-fluid">
                        <div class="row">
                        <?php if($valorResult!=null){for($j=0;$j<count($valorResult);$j++){?>


                              <div class="col-lg-3">
                                        <div class="card">
                                              <!--Imagen del producto-->
                                                    <div  style="alaing:center;display: flex;align-items: center;justify-content: center;">
                                                     <img  class="img-responsive imagen"  src="<?php 
                                                          if(!empty($valorResult[$j]["FotoPrincipal"])){
                                                               $imagen =$valorResult[$j]["FotoPrincipal"];
									                      }else{
                                                               $imagen ='../AdminComparador/imagenes_productos/producto.png';                          
										                  }
                                                          echo $imagen;
                                                      ?>" alt="Card image cap" style="width:160px;alaing:center;height:160px; display: flex;align-items: center;justify-content: center;"  
                                                           precio = "<?php echo "$".$valorResult[$j]["precioReal"];?>" 
                                                           nombreproducto ="<?php echo $valorResult[$j]["Nombre"];?>" 
                                                           descripcion ="<?php echo $valorResult[$j]["Descripcion"];?>" 
                                                           pesovolumen = "<?php  
                                                             $unidad =""; 
                                                              if ($valorResult[$j]["nombreMedida"]== 'gramos') {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== 'kilogramos'){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=='centimetros'){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=='mililitros'){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>" 
                                                              referencia = "<?php if($valorResult[$j]["Referencia"]!=""){echo $valorResult[$j]["Referencia"];}else {echo "Sin referencia";}?>"
                                                              marca ="<?php
                                                                  $marcaDes = $objSelect->selectARowsInDb("select Descripcion from marca where idMarca = ".$valorResult[$j]["Marca_idMarca"]);
                                                                  echo $marcaDes[0]["Descripcion"];
                                                              ?>">
                                                </div>
                                              <div class="card-body">
                                                    <h5 class="m-0"style="color:#136574;"></h5> <!--Nombre de tienda-->
                                                    <h5 class="m-0"style="color:#136574;"id="nombreProducto" value="<?php echo $valorResult[$j]["Nombre"];?>" ><?php echo $valorResult[$j]["Nombre"];?></h5><!--Nombre producto-->
                                                    <!--Precio-->
                                                    <h6 class="card-title textoprecioproducto" style="color:#D0A20E;font-weight: bold;font-size:19px;font-family:sans-serif;"><?php echo "$".$valorResult[$j]["precioReal"];?></h6>
                                                    <!--Unidad de medida-->
                                                    <p class="card-text textounidad" style="color:#136574;font-weight: bold;"><?php  
                                                             $unidad =""; 
                                                              if ($valorResult[$j]["nombreMedida"]== 'gramos') {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== 'kilogramos'){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=='centimetros'){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=='mililitros'){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>
                                                    </p>
                                                      <p style ="position: absolute; right: 10;" data-placement="top" data-toggle="tooltip" title="Editar"><span class="fas fa-pen-alt"></span></p>
                                                        <p style ="position: absolute; right: 40;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span id = "<?php echo $valorResult[$j]["idProducto"];?>" class="far fa-trash-alt eliminar"></span></p>      
      
                                              </div>

                                         </div>      
             
                              </div>

                          <?php }}?>
                    <?php }?> 
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
      document.getElementById("precio").innerHTML= "Hoy "+$(this).attr('precio'); 
      document.getElementById("productoname").innerHTML= $(this).attr('nombreproducto');
      document.getElementById("description").innerHTML= $(this).attr('descripcion');
      document.getElementById("pesovolumenes").innerHTML= $(this).attr('pesovolumen');
      document.getElementById("referenciavalue").innerHTML= "Referencia "+$(this).attr('referencia');
      document.getElementById("marcavalue").innerHTML= "Marca "+$(this).attr('marca');
      $('#imagemodal').modal('show');
  });
  });

 
 $(function(){
     $(".eliminar").click(function(){
          //document.getElementById("idproduct").innerHTML= $(this).attr('id'); 
          //alert($(this).attr('id'));
          //$(".btnEliminar").attr('id',$(this).attr('id'));
          $(".campoOculto").attr('value',$(this).attr('id'));
         $("#eliminarp").modal("show");  
      });
  });

function eliminarProducto(){

}

</script>



  <!-- Creates the bootstrap modal where the image will appear -->
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
             <b> <i id="precio" style="color:#0AA778;font-size:140%;"></i></b><br>        
             <b id="pesovolumenes" style="color:#AB6F14;font-size:110%;"></b>
             <p id="description" style="color:#AB6F14;font-size:100%;font-family: Calibri"></p> 
             <b id="referenciavalue" style="color:#AB6F14;font-size:100%;font-family: Calibri"></b><br> 
             <b id="marcavalue" style="color:#AB6F14;font-size:100%;font-family: Calibri"></b>
            </div>
      </div>
          
         
      </div>
      
      <div class="modal-footer" style="background-color: #C4B59C;">
        <button type="button" class="btn btn-default colorbotonamarillo" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



 <form class="form needs-validation" method="post"  enctype="multipart/form-data"">
        <div class="modal fade" id="eliminarp" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
              <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF";" >
                <h5  id="staticBackdropLabel" > Esta seguro que que desea eliminar el producto? </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
               <!-- aqui va el mensaje que se pasa por parametro-->
                <input   type="text" value ="" class="campoOculto form-control" id="campoOculto2" name ="campoOculto2">               
                       
              </div>
                  
                <div class="form-group">  
                      <div class="modal-footer">         
                            <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                            <button type="submit" name = "btnEliminarValue" id = "btnEliminarValue" class="btn btn-primary"style ="background-color: #D64646;width:48%;">Eliminar</button>
                      </div>
                </div>
            </div>
          </div>
   
        </div>
  </form> 