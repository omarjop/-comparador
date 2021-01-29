
<style>

#autoCompletedList {
  color: hsl(0, 0%, 0%);
  padding: 0;
  margin: 0;
  list-style-type: none;
}
#autoCompletedList li {
  background: #424242;
  padding: 5px;
  color: hsl(0, 0%, 100%);
  border-bottom: dotted 1px hsl(0, 0%, 58%);
}
#autoCompletedList li:hover {
  background: hsl(0, 0%, 36%);
  cursor: pointer;
}
</style>



  <?php 
  $valuesMal = "cosa";
  $idCategoria = $objTiendaInicial->getIdCategoria();
  $idTienda = $objTiendaInicial->getIdEmpresa();
  $nitTienda = $objTiendaInicial->getNitEmpresa();
  $objSelect = new ControladorSelectsInTables();
  $objFinP = new ControladorFindProductosTienda();
  $objLog =  new ControladorWorkLogs();
  $valorResult = null;

  //--------------------------Se prepara data para el formulario de registro de producto----------------------------------------------
  /*Funcion que retorna la primera palabra de las unidades en pesos para poder de value en el campo select recibe parametro el vector*/
     function returnValues($arreglo){

          $values = array();
            if($arreglo!=null){
                  for($i=0;$i<count($arreglo);$i++){
                     $auxValue = $arreglo[$i]["nombreMedida"];
                     $aux = explode(" ",$auxValue);   
                     array_push($values, $aux[0]);
             
		          }
              }

          return $values;
     
	 }
     function returnUnidadLimpia($valor){
         $unidad =""; 
         $aux = explode("(",$valor);
         $unidad = $aux[1];
         $unidad = str_replace(')', " ", $unidad);
         return $unidad;
	 }
     
     $objEstuctura =  new ControladorEstructuras();
     $objSelect =  new ControladorSelectsInTables();

     $valorUnidades = $objSelect->returnSelectAllRows("unidadmedida");
     $values = returnValues($valorUnidades);

     $resultSelect = ControladorSelectsInTables:: selectTodosRegistros("categoria");
     $marcas = ControladorSelectsInTables:: selectTodosRegistros("marca");
     $tipoProducto = ControladorSelectsInTables:: selectTodosRegistros("tipoproducto");
     $objLog->escribirEnLogAdmin("AdminProducto","INFO","Se inicia la pagina para administrar productos");

  //--------------------------------------------------------------------------------------------------------------------------------------------------
     if(isset($_POST["btnEliminarValue1"])&& isset($_POST["campoOculto21"])){      
            $eliminarProducto  = new ControladorAdminEliminar();
            $eliminarProducto ->eliminarProductoAdmin($_POST["campoOculto21"]);             
    }
  
     if(isset($_POST["btnaddproducto1"])){
            $registroProducto  = new ControladorAdminInsert();
            $registroProducto ->agregarProducto('imgProducto');
	 }

      if(isset($_POST["btneditproducto"])){
            $registroProducto  = new ControladorAdminModificar();
            $registroProducto ->modificarProductoAdmin('imgProductoEdit');
	 }
  
  
  
      if(isset($valorDeUrl)){
           $valorDeUrl = "'".$valorDeUrl."'";
           $squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idCategoria."  and ruta = ".$valorDeUrl.") t2 ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.idunidadMedida  = t4.unidadMedida_idunidadMedida) t6 ON t5.Producto_idProducto = t6.idProducto where t5.Empresa_idEmpresa = ".$idTienda;
           $valorResult = $objFinP->returnXSubCategoria($squl1);
           $mensaje = "Categoria  ".$nombreSubCate;
	  }
   
        if(isset($_POST["BtnMiProductos1"])&& $_POST['BtnMiProductos1']!=null){
             $palabraclave = strval($_POST['BtnMiProductos1']);
             $valorResult = $objFinP->autocompletar($palabraclave,$idCategoria,$idTienda);
             $mensaje ="Productos a Consultar";
	    }  

          //jql que retorna las categorias
      $sql = "SELECT  DISTINCT idsubCategoria ,nombre,ruta from subcategoria t3 INNER JOIN (SELECT DISTINCT subCategoria_idsubCategoria FROM producto) t1 ON t3.idsubCategoria = t1.subCategoria_idsubCategoria";
      $resultado = $objSelect->selectARowsInDb($sql);
      $mensaje ="Productos a Consultar";

  ?>


  <div class="content-wrapper">
               <!-- Content Header (Page header) -->
                
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-4">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->

<div class="row">



                        
          <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">  
                        <li class="nav-item dropdown breadcrumb-item activ">

                                   <a class="nav-link" data-toggle="dropdown" href="#">
                                      <i class="fa fa-search" aria-hidden="true"> Consultar Productos</i>                                 
                                    </a>

                                 
                                   <!-- SEARCH FORM -->

                                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                             
                                       <?php if($resultado!="Fallo" && $resultado!=null){ for($i=0;$i<count($resultado);$i++){?>
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
                                       <?php }}?>
                                    </div>                            
                         </li> 
                </ol>
          </div><!-- /.col -->

          		                <div class="col-sm-4">
                                <form class="form-signin" role="form" enctype="multipart/form-data" method="post" action="" name="formulario" id="formulario">
                                      <div class="form-group">                                        
                                          <input type="text" name="BtnMiProductos1" id="BtnMiProductos1"  class="form-control" placeholder="Buscar producto" data-target="#modalLoginAvatar"/>   

                                      </div>
                                 <form>


                        </div>


                        <div class="col-sm-4">


                            <div class="text-center">
                              <a href="" class="btn btn-default btn-rounded colorbotonamarillo" data-toggle="modal" data-target="#modalContactForm" value "1" onclick="mostrar2('1-0');">
                                Agregar Producto</a>
                            </div>
                        </div>


      </div>

</div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

    <?php if(!isset($valorDeUrl)&& $resultado!="Fallo"&& $valorResult ==null&&isset($resultado)){
          for($i=0;$i<count($resultado);$i++){
           $ruta = $resultado[$i]["ruta"];
           $ruta =  "'".$ruta."'";
           $idSub = $resultado[$i]["idsubCategoria"];
            $idSub =  "'".$idSub."'";
           //$squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idCategoria."  and ruta = ".$ruta.") t2 ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.Producto_idProducto  = t4.idProducto) t6 ON t5.Producto_idProducto = t6.Producto_idProducto";
           $squl1 = "SELECT * FROM clasificacion t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria,ruta FROM subcategoria where idsubCategoria = ".$idSub.")     t2 ON t1.subCategoria_idsubCategoria = t2.idsubCategoria)t4 ON t3.idclasificacion = t4.clasificacion_idclasificacion";	  
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
                                                   <a href="#">  <img  class="img-responsive imagen"  src="<?php 
                                                          if(!empty($valorResult[$j]["FotoPrincipal"])){
                                                               $imagen =$valorResult[$j]["FotoPrincipal"];
									                      }else{
                                                               $imagen ='../AdminComparador/imagenes_productos/producto.png';                          
										                  }
                                                          echo $imagen;
                                                      ?>" alt="Card image cap" style="width:160px;alaing:center;height:160px; display: flex;align-items: center;justify-content: center;"  
                                                           nombreproducto ="<?php echo $valorResult[$j]["Nombre"];?>" 
                                                           descripcion ="<?php echo $valorResult[$j]["Descripcion"];?>" 
                                                           pesovolumen = "<?php  
                                                              $unidad = ($valorResult[$j]["simbolo"]);
                                                              echo $valorResult[$j]["equivalencia"].$unidad;?>" 
                                                              referencia = "<?php if($valorResult[$j]["Referencia"]!=""){echo $valorResult[$j]["Referencia"];}else {echo "Sin referencia";}?>"
                                                              marca ="<?php
                                                                  $marcaDes = $objSelect->selectARowsInDb("select Descripcion from marca where idMarca = ".$valorResult[$j]["Marca_idMarca"]);
                                                                  echo $marcaDes[0]["Descripcion"];
                                                              ?>"</a>
                                                </div>
                                              <div class="card-body">
                                                    <h5 class="m-0"style="color:#136574;"></h5> <!--Nombre de tienda-->
                                                    <h5 class="m-0"style="color:#136574;"id="nombreProducto" value="<?php echo $valorResult[$j]["Nombre"];?>" ><?php echo $valorResult[$j]["Nombre"];?></h5><!--Nombre producto-->
                                                    
                                                    <!--Precio-->
                                                   <!-- <h6 class="card-title textoprecioproducto" style="color:#D0A20E;font-weight: bold;font-size:19px;font-family:sans-serif;"><?php echo "$".$valorResult[$j]["precioReal"];?></h6>-->
                                                    <!--Unidad de medida-->
                                                    <p class="card-text textounidad" style="color:#136574;font-weight: bold;"><?php  
                                                              $unidad = ($valorResult[$j]["simbolo"]);
                                                              echo $valorResult[$j]["equivalencia"].$unidad;?>
                                                    </p>
                                                       <a href="#"><p style ="position: absolute; right: 10;" onclick="mostrarDatosAdminEdit(this.id,'<?php echo $valorResult[$j]["subCategoria_idsubCategoria"];?>');" id ="<?php echo $valorResult[$j]["idProducto"];?>" data-placement="top" data-toggle="tooltip" title="Editar"><span nombre = "<?php echo $valorResult[$j]["Nombre"];?>" 
                                                                                                                                                                   id = "<?php echo $valorResult[$j]["idProducto"];?>" class="fas fa-pen-alt"></span></p></a>
                                                        <a href="#"><p style ="position: absolute; right: 40;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span id = "<?php echo $valorResult[$j]["idProducto"];?>" etiqueta ="<?php echo $valorResult[$j]["Nombre"];?>" 
                                                                                                                                                                            unidad = "<?php  
                                                             $unidad =($valorResult[$j]["simbolo"]);
                                                              echo $valorResult[$j]["equivalencia"].$unidad;?>" class="far fa-trash-alt eliminar" src="<?php echo $imagen;?>"></span></p></a>      
                                                                                                              
                                              </div>

                                         </div> 
                                         
             
                              </div>
                               
                          <?php }}?>
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







  <!-- Modal que muestra producto al dar click en la imagen -->
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


<!-- Modal que muestra el confirmar cuando se elimina un producto -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data" >
        <div class="modal fade" id="eliminarp" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <i><h5  id="staticBackdropLabel" > Esta seguro que que desea eliminar el producto? </h5></i>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                    <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                                <div class="col-sm-12">
                                   <div class="card" style="background-color: #E5E5E5;font-size:140%;">
                                      <div class="card-body">                                          
                                          <footer class="" style="font-size:110%;"><cite title="Source Title" id="etiquetaEliminar"></cite><img src=""  align="right" class="imagedelete" style="width: 70px; height: 60px;" > </footer>                                                              
                                      </div>
                                   
                                 </div>
                         </div>

                        </div>
                     <input  style="visibility: hidden;" type="text" value ="" class="campoOculto form-control" id="campoOculto21" name ="campoOculto21">                                      
                   </div>
                  


                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" name = "btnCancelarDe" id = "btnCancelarDe" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEliminarValue1" id = "btnEliminarValue1" class="btn btn-secondary"style ="background-color: #D64646;width:48%;" >Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 


  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form " method="post"  enctype="multipart/form-data" >
        <div class="modal fade" id="modificarpp"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

            <div class="modal-dialog" role="document">
                       <div class="modal-content">
                                 <div class="modal-header text-center" style ="background-color: #D0A20E;color:#FFFFFF;">
                                                <h4 class="modal-title w-100 ">Campos editables</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                 </div>
                                              <div class="modal-body mx-3">
                                                        <div class="md-form mb-4">
                                                              <input id="nameProductoAdminEdit" name="nameProductoAdminEdit" type="text" placeholder="Nombre producto" class="form-control"   required>                                      
                                                            </div>

                                                            <div class="md-form mb-4">                                      
                                                                        <select class="form-control"  id ="tipoProductAdminEdit" name="tipoProductAdminEdit" required>
                                                                              <option value = "seleccione">Seleccione Tipo/Producto</option>
                                                                               <?php for($i=0;$i<count($tipoProducto);$i++){?>
                                                                                    <option value='<?php echo $tipoProducto[$i]["idtipoProducto"];?>'><?php echo $tipoProducto[$i]["descripcion"];?></option>
                                                                               <?php }?>
                                                                        </select>
                                                            </div>

                                                            <div class="md-form mb-4">                                      
                                                                        <select class="form-control" onChange="mostrarUnidadNumericaPesoVolumen(this.value,'unidadNumericaAddAdminEdit');" id ="unitt1AdminEdit" name="unitt1AdminEdit" required>
                                                                              <option value = "seleccione">Seleccione Peso/Volumen</option>
                                                                               <?php for($i=0;$i<count($valorUnidades);$i++){?>
                                                                                    <option value='<?php echo $valorUnidades[$i]["idunidadMedida"];?>'><?php echo $valorUnidades[$i]["nombreMedida"];?></option>
                                                                               <?php }?>
                                                                        </select>
                                                            </div>

                                                            <div class="md-form mb-4"  id= "gramos1">                                      
                                                                     <select class="form-control" name="unidadNumericaAddAdminEdit" id ="unidadNumericaAddAdminEdit" required>  
                                                                             <option value='seleccione'>Seleccione unidad de medida</option> 
                                                                     </select>
                                                            </div>

                                                             <div class="md-form mb-4">
                                                              <input id="Reference1AdminEdit" name="Reference1AdminEdit" type="text" placeholder="Referencia" class="form-control" required>
                                                             </div>

                                                            <div class="md-form mb-4">
                                                                    <select class="form-control" name="marca1AdminEdit" id ="marca1AdminEdit" required>  
                                                                             <option value='seleccione'>Seleccione marca</option> 
                                                                          <?php for($i=0;$i<count($marcas);$i++){?>
                                                                             <option value='<?php echo $marcas[$i]["idMarca"];?>'><?php echo $marcas[$i]["Descripcion"];?></option>  
                                                                          <?php }?>
                                                                     </select>
                                                            </div>


                                                             <div class="md-form mb-4">
                                                                      <select class="form-control" id="CategoryAddAdminEdit" name="CategoryAddAdminEdit" onChange="mostrarSubCategoriaAdmin(this.value,'subCategoryAddAdminEdit');" required >
                                                                              <option value = "seleccione">Seleccione Categor&iacutea</option>     
                                                                              <?php for($i=0;$i<count($resultSelect);$i++){?>
                                                                                   <option value = "<?php echo $resultSelect[$i]["idCategoria"];?>"><?php echo $resultSelect[$i]["nombre"];?></option>
                                                                              <?php }?>
                                                                        </select>
                                                              </div>

                                                                <div class="md-form mb-4">
                                                                          <select class="form-control" id="subCategoryAddAdminEdit" name="subCategoryAddAdminEdit"  required >
                                                                                  <option value = "seleccion">Seleccione Sub Categor&iacutea</option>     
                                                                            </select>
                                                                </div>

                                                                <div class="md-form mb-4 custom-file">
                                                                     <input type="file" class="custom-file-input" id="imgProductoEdit" name="imgProductoEdit" lang="es" >
                                                                     <label class="custom-file-label" for="customFileLang">Seleccione Imagen Producto</label>
                                                                </div>

                                                                <div class="md-form">
                                                                  <i class="fas fa-pencil prefix grey-text"></i>
                                                                  <textarea class="form-control" id="description1AdminEdit" name="description1AdminEdit" placeholder="Breve descripci&oacute;n del producto" rows="3"></textarea>
                                                                </div>

                                                                <div class="md-form mb-4">
                                                                   <input style="visibility: hidden;"  type="text" class="campoOculto form-control" id="idProductValueAdmin" name ="idProductValueAdmin">                                      
                                                                </div>
                                                                

                                              </div>




                                   <div class="form-group">  
                                          <div class="modal-footer d-flex justify-content-center">         
                                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button> 
                                                <button type="submit" class="btn btn-primary  colorbotonamarillo" style ="width:48%;" id="btneditproducto" name="btneditproducto" >Editar</button>
                                          </div>
                                    </div>
                                              </div>
                     </div>                    
             </div>
         </div>
  </form>




  <!--Modal para el registro de producto-->

  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);" novalidate >
            <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                     <div class="modal-header text-center" style ="background-color: #D0A20E;color:#FFFFFF;">
                                    
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                     </div>
                                  <div class="modal-body mx-3">
                                    <div class="md-form mb-4">
                                      <input id="nameProducto1" name="nameProducto1" type="text" placeholder="Nombre producto" class="form-control"   required>                                      
                                    </div>

                                    <div class="md-form mb-4">                                      
                                                <select class="form-control"  id ="tipoProduct" name="tipoProduct" required>
                                                      <option value = "seleccione">Seleccione Tipo/Producto</option>
                                                       <?php for($i=0;$i<count($tipoProducto);$i++){?>
                                                            <option value='<?php echo $tipoProducto[$i]["idtipoProducto"];?>'><?php echo $tipoProducto[$i]["descripcion"];?></option>
                                                       <?php }?>
                                                </select>
                                    </div>

                                    <div class="md-form mb-4">                                      
                                                <select class="form-control" onChange="mostrarUnidadNumericaPesoVolumen(this.value,'unidadNumericaAdd');" id ="unitt1" name="unitt1" required>
                                                      <option value = "seleccione">Seleccione Peso/Volumen</option>
                                                       <?php for($i=0;$i<count($valorUnidades);$i++){?>
                                                            <option value='<?php echo $valorUnidades[$i]["idunidadMedida"];?>'><?php echo $valorUnidades[$i]["nombreMedida"];?></option>
                                                       <?php }?>
                                                </select>
                                    </div>

                                     <div class="md-form mb-4"  id= "gramos1">                                      
                                             <select class="form-control" name="unidadNumericaAdd" id ="unidadNumericaAdd" required>  
                                                     <option value='seleccione'>Seleccione unidad de medida</option> 
                                             </select>
                                    </div>




                                    <div class="md-form mb-4">
                                      <input id="Reference1" name="Reference1" type="text" placeholder="Referencia" class="form-control" required>
                                    </div>

                                    <div class="md-form mb-4">
                                            <select class="form-control" name="marca1" id ="marca1" required>  
                                                     <option value='seleccione'>Seleccione marca</option> 
                                                  <?php for($i=0;$i<count($marcas);$i++){?>
                                                     <option value='<?php echo $marcas[$i]["idMarca"];?>'><?php echo $marcas[$i]["Descripcion"];?></option>  
                                                  <?php }?>
                                             </select>
                                    </div>

                                   <div class="md-form mb-4">
                                              <select class="form-control" id="CategoryAdd" name="CategoryAdd" onChange="mostrarSubCategoriaAdmin(this.value,'subCategoryAdd');" required >
                                                      <option value = "seleccione">Seleccione Categor&iacutea</option>     
                                                      <?php for($i=0;$i<count($resultSelect);$i++){?>
                                                           <option value = "<?php echo $resultSelect[$i]["idCategoria"];?>"><?php echo $resultSelect[$i]["nombre"];?></option>
                                                      <?php }?>
                                                </select>
                                    </div>

                                    <div class="md-form mb-4">
                                              <select class="form-control" id="subCategoryAdd" name="subCategoryAdd"  required >
                                                      <option value = "seleccion">Seleccione Sub Categor&iacutea</option>     
                                                </select>
                                    </div>

                                    <div class="md-form mb-4 custom-file">
                                         <input type="file" class="custom-file-input" id="imgProducto" name="imgProducto" lang="es"  required>
                                         <label class="custom-file-label" for="customFileLang">Seleccione Imagen Producto</label>
                                    </div>

                                    <div class="md-form">
                                      <i class="fas fa-pencil prefix grey-text"></i>
                                      <textarea class="form-control" id="description1" name="description1" placeholder="Breve descripci&oacute;n del producto" rows="3"></textarea>
                                    </div>

                                  </div>



                                   <div class="form-group">  
                                          <div class="modal-footer d-flex justify-content-center">         
                                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button> 
                                                <button type="submit" class="btn btn-primary  colorbotonamarillo" style ="width:48%;" id="btnaddproducto1" name="btnaddproducto1" >Agregar</button>
                                          </div>
                                    </div>
                </div>
              </div>
            </div>
  </form>


  

