  
  
    <?php 
      $idTienda = $objTiendaInicial->getIdCategoria();
      $objSelect = new ControladorSelectsInTables();
      $objFinP = new ControladorFindProductosTienda();
      $sql = "SELECT  DISTINCT idsubCategoria ,nombre,ruta from subcategoria t3 INNER JOIN (SELECT DISTINCT subCategoria_idsubCategoria FROM producto t1 INNER JOIN ( SELECT Producto_idProducto FROM producto_has_empresa  where Empresa_idEmpresa = ".$idTienda." ) t2 ON t1.idProducto  = t2.Producto_idProducto) t4 ON t3.idsubCategoria  = t4.subCategoria_idsubCategoria";
      $resultado = $objSelect->selectARowsInDb($sql);
         
       $squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idTienda."  and nombre = 'Despensa') t2        ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.Producto_idProducto  = t4.idProducto) t6 ON t5.Producto_idProducto = t6.Producto_idProducto";
       $valorResult = $objFinP->returnXSubCategoria($squl1);
  ?>
  
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            

                    <li class="nav-item dropdown breadcrumb-item activ">
                                <a class="nav-link" data-toggle="dropdown" href="#">
                                  <i class="fa fa-search" aria-hidden="true"> Consultar mis producto</i>                                 
                                </a>
                           
                                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                   <?php for($i=0;$i<count($resultado);$i++){?>
                                      <a href="<?php echo $resultado[$i]["ruta"];?>" onclick="searchForCategory(<?php $resultado[$i]["idsubCategoria"];?>)" class="dropdown-item">
                                        <!-- Message Start -->
                                            <div class="media">
                                                  <img src="../AdminComparador/imagenes_productos/Producto.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
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
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

      <div class="container-fluid">
        <div class="row">
        <?php for($j=0;$j<count($valorResult);$j++){?>
              <div class="col-lg-3">
                        <div class="card">
                              <!--Imagen del producto-->
                                    <div  style="alaing:center;display: flex;align-items: center;justify-content: center;">
                                     <img  class="img-responsive imagen"  src="<?php 
                                          if(!empty($valorResult[$j]["FotoPrincipal"])){
                                               $imagen =$valorResult[$j]["FotoPrincipal"];
									      }else{
                                               $imagen ='../AdminComparador/imagenes_productos/producto.jpg';                          
										  }
                                          echo $imagen;
                                      ?>" alt="Card image cap" style="width:160px;alaing:center;height:160px; display: flex;align-items: center;justify-content: center;"  precio = "<?php echo "$".$valorResult[$j]["precioReal"];?>" nombreproducto ="<?php echo $valorResult[$j]["Nombre"];?>" descripcion ="<?php echo $valorResult[$j]["Descripcion"];?>" pesovolumen = "<?php  
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
                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>">
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
                                                          
                              </div>

                         </div>      
             
              </div>

         <?php }?>
          <!-- /.col-md-6 -->

		  
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
      document.getElementById("precio").innerHTML= $(this).attr('precio')+"<br/>"; 
      document.getElementById("productoname").innerHTML= $(this).attr('nombreproducto');
      document.getElementById("description").innerHTML= $(this).attr('descripcion');
      document.getElementById("pesovolumenes").innerHTML= $(this).attr('pesovolumen');
      $('#imagemodal').modal('show');
  });
});

</script>

  <!-- Creates the bootstrap modal where the image will appear -->
<div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
      <h4 id="productoname" style="color:#136574;" ></h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        
      </div>
      <div class="modal-body" style="background-image: url('../AdminComparador/imagenes_productos/fondo.jpg');width:100%; height: 50%;">
      <div  style="alaing:left;display: flex;align-items: left;justify-content: left;">
        <img src="" class="imagepreview" style="width: 200px; height: 240px;" >
         <p id="precio" style="color:#0AA778;font-size:120%;"></p>
        
         <p id="pesovolumenes" style="color:#AB6F14;font-size:110%;"></p>
         <p id="description" style="color:#AB6F14;font-size:100%;"></p> 
      </div>
          
         
      </div>
      
      <div class="modal-footer" style="background-color: #C4B59C;">
        <button type="button" class="btn btn-default colorbotonamarillo" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>