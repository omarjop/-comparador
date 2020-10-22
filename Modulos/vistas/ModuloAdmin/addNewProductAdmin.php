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
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    function mostrar(id) {

    var aux = id.split("-");
    id = aux[0];
        var unidades = ["gramos","kilogramos","mililitros","centimetros"];
        unidades.forEach(function(valor) {
                if(valor == id){
                   $("#".concat(valor)).show();               
			    }else{
                    $("#".concat(valor)).hide();  
               }
        });

    }
    
 
     
</script>
<script>
 var returnValue ;




function validarFormulario(formulario){
         
         var nombre = formulario.nameProduct.value;
         var precio = formulario.price.value;
         var pesoVolumen = formulario.unit.value;
         var marca = formulario.marca.value;
         var categoria = formulario.Category.value;
         var gramos = formulario.grams.value;
         var kilogramos = formulario.kilograms.value;
         var mililitros = formulario.milliliters.value;
         var centimetros = formulario.centimeters.value;

                 if(validarNombreAndMarca(nombre,"No es un nombre de producto v&aacute;lido","nameProduct")!=true){
                   returnValue = false;
                    // return false;
		         }
                 if(validarPrecio(precio,"price")!=true){
                   returnValue = false;
                     //return false;
		         }
                 if(validarPesoVolumenAndCategoria(pesoVolumen,"no es una unidad de peso o volumen no es v&aacute;lida","unit")!=true){
                     returnValue = false;
                     //return false;
		         }
                 if(validarUnidades(pesoVolumen,gramos,kilogramos,mililitros,centimetros)!=true){
                     returnValue = false;
                     ///return false;
		         }
                 if(validarNombreAndMarca(marca,"No es un nombre de marca v&aacute;lido","marca")!=true){
                     returnValue = false;
                    // return false;
		         }
                 if(validarPesoVolumenAndCategoria(categoria,"Categor&iacute;a, seleccione una opci&oacute;n valida","Category")!=true){
                     returnValue = false;
                    // return false;
		         }

                     if(returnValue!=true){
                        returnValue = false;   
					 }else{
                        returnValue = true;              
					 }
 
     
     return returnValue;
 }
 //------funciones de validacion de cada uno de los campos
 function validarNombreAndMarca(valor,mensaje,campoForm){
               if(valor == "seleccione"){
           toastr.error(mensaje);
           //document.getElementById(campoForm).value = "";
           return false; 
		}else{
           return true;  
		}
 }
 
  function validarPrecio(valor,campoForm){

            if(!valor.includes(',')){
                 if (isNaN(parseFloat(valor))) {
                      toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
                      //toastr.error("El valor ("+document.getElementById(campoForm).value+") "+mensaje);
                      //$("#"+campoForm).parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)</div>');  
                      document.getElementById(campoForm).value = "";
                      return false;
                 }else{
                      
                      return true;
		         } 
            }else{
                       toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
                       document.getElementById(campoForm).value = "";
                      return false;           
			}
 }

 function validarPesoVolumenAndCategoria(valor,mensaje,campoForm){
        if(valor == "seleccion"){
           toastr.error(mensaje);
           //document.getElementById(campoForm).value = "";
           return false; 
		}else{
           return true;  
		}
 }

  function validarUnidades(valorPesoVolumen,gramos,kilogramos,mililitros,centimetros){
    
        if(valorPesoVolumen == "gramos"){
            if(gramos == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("grams").value = "";
               return false; 
		    }
		}else if(valorPesoVolumen == "kilogramos"){
            if(kilogramos == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("kilograms").value = "";
               return false; 
		    }
		}else if(valorPesoVolumen == "mililitros"){
            if(mililitros == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("milliliters").value = "";
               return false; 
		    }
		}else if(valorPesoVolumen == "centimetros"){
            if(centimetros == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("centimeters").value = "";
               return false; 
		    }
		}  
  return true;
 }

 function validarNuevaCategoria(categoria,nuevaCategoria){
 
 var cate = categoria.split("-");
         if(cate[1] == "Otros"){
                if(!nuevaCategoria){
                    toastr.error('El campo nueva categor&iacute;a es requerido');       
                    document.getElementById("NewCategory").value = "";
                    return false;       
			    }
		 }
         return true;
 }



 $(function(){
     $("#btnaddproducto").click(function(){
          
         if(returnValue!=false){
                          var nombreAddP = $("#nameProduct").val();
                          //var unitAddP = $("#unit").val();
                         // alert(nombreAddP)

                            var datos = new FormData();
            
                            datos.append("nombreAddP", nombreAddP);
         
                            $.ajax({
                   
                                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                                    method:"POST",
                                    data: datos, 
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    async:false,
                                    success: function(respuesta){
                                          if(respuesta.includes("null")){                          
                                             $(".alert").remove();
                                             returnValue =  true;
                                          }else{
                                          $("#nameProduct").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>El producto ya se encuentra registrado</div>');                               
                                             returnValue = false;                              
			                              }


                                    }

                              })
                   }

              return returnValue;
              
      });

      

  });


// Example starter JavaScript for disabling form submissions if there are invalid fields
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

//--------------------------------------------------------------------------------------------------------
/*auto completar al agregar nuevo producto*/
$(document).ready(function(){
       $("#nameProduct").change(function(){
    
            var producto = $("#nameProduct").val();
            var datos = new FormData();
            datos.append("newProduct", producto);
         
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(respuesta.includes("null")){
                          $(".alert").remove();
                          returnValue = true;    
                                document.getElementById("Reference").value = null;
                                document.getElementById("description").value = null;
                                document.getElementById("Brand").value = null;
                                document.getElementById("Category").value = "seleccion";
                                document.getElementById("unit").value = "seleccion";
                                document.getElementById("grams").value = "seleccione";
                                document.getElementById("kilograms").value = "seleccione";
                                document.getElementById("milliliters").value = "seleccione";
                                document.getElementById("centimeters").value = "seleccione";
                          }else{
                               respuesta =respuesta.replace("[","");
                               respuesta =respuesta.replace("]","");
                               document.getElementById("Reference").value = JSON.parse(respuesta).Referencia;
                               document.getElementById("description").value = JSON.parse(respuesta).DescripcionP; 
                               document.getElementById("marca").value = JSON.parse(respuesta).idMarca; 
                               document.getElementById("Category").value = JSON.parse(respuesta).idsubCategoria+'-'+JSON.parse(respuesta).nombre; 
                               var nombreMedidda =  JSON.parse(respuesta).nombreMedida;
                               var aux = nombreMedidda.split(" ");
                               document.getElementById("unit").value = aux[0]+'-'+JSON.parse(respuesta).idunidadMedida;
                               mostrar(aux[0]+'-'+JSON.parse(respuesta).idunidadMedida);
                               document.getElementById(returnUnidad(aux[0])).value = JSON.parse(respuesta).pesoVolumen;
                               
			              }


                    }

              })

        })
});
//valida el precio
$(document).ready(function(){
       $("#price").change(function(){
         returnValue = true; 
        })
});



function returnUnidad(unidad){
     var returnValue = "";

     switch (unidad) {
          case 'gramos':
            returnValue = "grams";
            break;
          case 'kilogramos':
            returnValue = "kilograms";
            break;
          case 'mililitros':
            returnValue = "milliliters";
            break;
          case 'centimetros':
            returnValue = "centimeters";
            break;

        }
        return returnValue;
}

</script>
  <?php 
  $valuesMal = "cosa";
  $idCategoria = $objTiendaInicial->getIdCategoria();
  $idTienda = $objTiendaInicial->getIdEmpresa();
  $nitTienda = $objTiendaInicial->getNitEmpresa();
  $objSelect = new ControladorSelectsInTables();
  $objFinP = new ControladorFindProductosTienda();
  $objLog =  new ControladorWorkLogs();
  //$objLog-> escribirEnLog("Consultar","INFO",$nitTienda,"Se inicia el proceso de Consultar Productos ");
  $valorResult = null;

  //--------------------------Se prepara data para el formulario de registro de producto----------------------------------------------
  /*Funcion que retorna la primera palabra de las unidades en pesos para poder de value en el campo select recibe parametro el vector*/
     function returnValues($arreglo){

          $values = array();
          for($i=0;$i<count($arreglo);$i++){
             $auxValue = $arreglo[$i]["nombreMedida"];
             $aux = explode(" ",$auxValue);   
             array_push($values, $aux[0]);
             
		  }

          return $values;
     
	 }
     
     $objEstuctura =  new ControladorEstructuras();
     $objSelect =  new ControladorSelectsInTables();

     $valorUnidades = $objSelect->returnSelectAllRows("unidadmedida");
     $values = returnValues($valorUnidades);

     $gramos = $objEstuctura->unidadesProductosValues("gramos");
     $kilogramos = $objEstuctura->unidadesProductosValues("kilogramos");
     $mililitros = $objEstuctura->unidadesProductosValues("mililitros");
     $centimetros = $objEstuctura->unidadesProductosValues("centimetros");     
     $resultSelect = $objSelect->returnSelectAllRows("subcategoria");

     //-----------Retorna las marcas para mostrar en el capo de registro------
     $marcas = ControladorSelectsInTables:: selectTodosRegistros("marca");


  //--------------------------------------------------------------------------------------------------------------------------------------------------
   if(isset($_POST["btnEliminarValue"])&& isset($_POST["campoOculto2"])){      
            $ingreso  = new ControladorEliminarEditarProductosTienda();
            $id = $_POST["campoOculto2"]; 
            $objLog-> escribirEnLog("Consultar Producto Tienda","INFO",$nitTienda,"Se procede a eliminar el producto con id: ".$id); 
            $idEmpresa = $objTiendaInicial->getIdEmpresa();
            $resultadoEliminar = $ingreso ->EliminarProducto($id,$idEmpresa);          
            
              if($resultadoEliminar=="Exitoso"){
                 $objLog-> escribirEnLog("Consultar Producto Tienda","INFO",$nitTienda,"Se procede a elimina con exito el producto "); 
                 echo "<script>toastr.info('Producto eliminado exitosamente');</script>";                              
			  }else{
                 echo "<script>toastr.error('Error al eliminar producto, por favor intente nuevamente');</script>";                             
                 $objLog-> escribirEnLog("Consultar Producto Tienda","WARNING",$nitTienda,"Falla la eliminacion del producto para la tienda"); 
			  }
            
    }

        if(isset($_POST["btnEditarValue"])){
             $id = $_POST["idProduct"]; 
             $objLog-> escribirEnLog("Consultar Producto Tienda","INFO",$nitTienda,"Se procede a editar el producto con id: ".$id);              
             $precio = $_POST["precioEdit"];
             $idEmpresa = $objTiendaInicial->getIdEmpresa();
             $objActualizar  = new ControladorEliminarEditarProductosTienda();
             $objActualizar ->EditarProducto($id,$precio,$idEmpresa,$nitTienda,$objLog); 
	    }
  
  //jql que retorna las categorias
      $sql = "SELECT  DISTINCT idsubCategoria ,nombre,ruta from subcategoria t3 INNER JOIN (SELECT DISTINCT subCategoria_idsubCategoria FROM producto) t1 ON t3.idsubCategoria = t1.subCategoria_idsubCategoria";
      $resultado = $objSelect->selectARowsInDb($sql);
      $mensaje ="Productos a Consultar";

      if(isset($valorDeUrl)){
           $valorDeUrl = "'".$valorDeUrl."'";
           $squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idCategoria."  and ruta = ".$valorDeUrl.") t2 ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.idunidadMedida  = t4.unidadMedida_idunidadMedida) t6 ON t5.Producto_idProducto = t6.idProducto where t5.Empresa_idEmpresa = ".$idTienda;
           $valorResult = $objFinP->returnXSubCategoria($squl1);
           $mensaje = "Categoria  ".$nombreSubCate;
	  }
   
        if(isset($_POST["BtnMiProducto"])&& $_POST['BtnMiProducto']!=null){
             $palabraclave = strval($_POST['BtnMiProducto']);
             $valorResult = $objFinP->autocompletar($palabraclave,$idCategoria,$idTienda);
             $mensaje ="Productos a Consultar";
	    }  

        

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
                                      <i class="fa fa-search" aria-hidden="true"> Consultar Mis Productos</i>                                 
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
                                          <input type="text" name="BtnMiProducto" id="BtnMiProducto"  class="form-control" placeholder="Buscar producto" data-target="#modalLoginAvatar"/>   

                                      </div>
                                 <form>


                        </div>


                        <div class="col-sm-4">


                            <div class="text-center">
                              <a href="" class="btn btn-default btn-rounded colorbotonamarillo" data-toggle="modal" data-target="#modalContactForm">
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
           //$squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN  (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria  where Categoria_idCategoria = ".$idCategoria."  and ruta = ".$ruta.") t2 ON t1.subCategoria_idsubCategoria  = t2.idsubCategoria)t4 ON t3.Producto_idProducto  = t4.idProducto) t6 ON t5.Producto_idProducto = t6.Producto_idProducto";
           $squl1 = "SELECT * FROM Producto_has_empresa t5 INNER JOIN (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria,ruta FROM subcategoria where Categoria_idCategoria = ".$idCategoria." and ruta = ".$ruta.")     t2 ON t1.subCategoria_idsubCategoria = t2.idsubCategoria)t4 ON t3.idunidadMedida = t4.unidadMedida_idunidadMedida) t6 ON t5.Producto_idProducto = t6.idProducto where t5.Empresa_idEmpresa = ".$idTienda;	  
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
                                                           precio = "<?php echo "$".$valorResult[$j]["precioReal"];?>" 
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
                                                              marca ="<?php
                                                                  $marcaDes = $objSelect->selectARowsInDb("select Descripcion from marca where idMarca = ".$valorResult[$j]["Marca_idMarca"]);
                                                                  echo $marcaDes[0]["Descripcion"];
                                                              ?>"</a>
                                                </div>
                                              <div class="card-body">
                                                    <h5 class="m-0"style="color:#136574;"></h5> <!--Nombre de tienda-->
                                                    <h5 class="m-0"style="color:#136574;"id="nombreProducto" value="<?php echo $valorResult[$j]["Nombre"];?>" ><?php echo $valorResult[$j]["Nombre"];?></h5><!--Nombre producto-->
                                                    
                                                    <!--Precio-->
                                                    <h6 class="card-title textoprecioproducto" style="color:#D0A20E;font-weight: bold;font-size:19px;font-family:sans-serif;"><?php echo "$".$valorResult[$j]["precioReal"];?></h6>
                                                    <!--Unidad de medida-->
                                                    <p class="card-text textounidad" style="color:#136574;font-weight: bold;"><?php  
                                                             $unidad =""; 
                                             if ($valorResult[$j]["nombreMedida"]== "gramos (gr)") {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== "kilogramos (kg)"){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=="centimetros cubicos (cm3)"){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=="mililitros (ml)"){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>
                                                    </p>
                                                        <p style ="position: absolute; right: 10;" data-placement="top" data-toggle="tooltip" title="Editar"><span precio = "<?php echo $valorResult[$j]["precioReal"];?>" 
                                                                                                                                                                   id = "<?php echo $valorResult[$j]["idProducto"];?>" class="fas fa-pen-alt editar"></span></p>
                                                        <a href="#"><p style ="position: absolute; right: 40;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span id = "<?php echo $valorResult[$j]["idProducto"];?>" etiqueta ="<?php echo $valorResult[$j]["Nombre"];?>" 
                                                                                                                                                                            unidad = "<?php  
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
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>" class="far fa-trash-alt eliminar" src="<?php echo $imagen;?>"></span></p></a>      
                                                                                                              
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
                        <?php if($valorResult!=null && $valorResult!="Fallo" && $resultado!="Fallo"){for($j=0;$j<count($valorResult);$j++){?>
                        

                              <div class="col-lg-3">
                                        <div class="card">
                                              <!--Imagen del producto-->
                                                    <div  style="alaing:center;display: flex;align-items: center;justify-content: center;">
                                                    <a href="#"> <img  class="img-responsive imagen"  src="<?php 
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
                                                              marca ="<?php
                                                                  $marcaDes = $objSelect->selectARowsInDb("select Descripcion from marca where idMarca = ".$valorResult[$j]["Marca_idMarca"]);
                                                                  echo $marcaDes[0]["Descripcion"];
                                                              ?>"></a>
                                                </div>
                                              <div class="card-body">
                                                    <h5 class="m-0"style="color:#136574;"></h5> <!--Nombre de tienda-->
                                                    <h5 class="m-0"style="color:#136574;"id="nombreProducto" value="<?php echo $valorResult[$j]["Nombre"];?>" ><?php echo $valorResult[$j]["Nombre"];?></h5><!--Nombre producto-->
                                                    <!--Precio-->
                                                    <h6 class="card-title textoprecioproducto" style="color:#D0A20E;font-weight: bold;font-size:19px;font-family:sans-serif;"><?php echo "$".$valorResult[$j]["precioReal"];?></h6>
                                                    <!--Unidad de medida-->
                                                    <p class="card-text textounidad" style="color:#136574;font-weight: bold;"><?php  
                                                             $unidad =""; 
                                                              if ($valorResult[$j]["nombreMedida"]== "gramos (gr)") {
                                                                         $unidad ="g";
                                                              }else if($valorResult[$j]["nombreMedida"]== "kilogramos (kg)"){
                                                                          $unidad ="kg";
											                  }else if($valorResult[$j]["nombreMedida"]=="centimetros cubicos (cm3)"){
                                                                          $unidad ="cm3";
											                  }else if($valorResult[$j]["nombreMedida"]=="mililitros (ml)"){
                                                                          $unidad ="ml";
											                  }
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>
                                                    </p>
                                                      <a href="#"><p style ="position: absolute; right: 10;" data-placement="top" data-toggle="tooltip" title="Editar"><span precio = "<?php echo $valorResult[$j]["precioReal"];?>" 
                                                                                                                                                                   id = "<?php echo $valorResult[$j]["idProducto"];?>" class="fas fa-pen-alt editar"></span></p></a>
                                                      <a href="#"><p style ="position: absolute; right: 40;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span id = "<?php echo $valorResult[$j]["idProducto"];?>" etiqueta ="<?php echo $valorResult[$j]["Nombre"];?>" 
                                                                                                                                                                            unidad = "<?php  
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
                                                              echo $valorResult[$j]["pesoVolumen"].$unidad;?>" class="far fa-trash-alt eliminar" src="<?php echo $imagen;?>"></span></p></a>      

      
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

/*LLama el modal de eliminar producto*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));         
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta')+'  '+$(this).attr('unidad'); 
        $(".imagedelete").attr('src', $(this).attr('src'));
         $("#eliminarp").modal("show");  
      });
  });

  /*Llama el modal de editar producto*/
  $(function(){
     $(".editar").click(function(){
         $(".precioEdit").attr('value',$(this).attr('precio'));
         $(".idProduct").attr('value',$(this).attr('id'));
         $("#modificarp").modal("show");  
      });
  });
  //precioEdit


  function validarFormularioEdit(formulario){
       var precio = formulario.precioEdit.value;
         if(validarPrecio(precio,"precioEdit")!=true){
             return false;
		 }
 }

   function validarPrecio(valor,campoForm){
            if(!valor.includes(',')){
                 if (isNaN(parseFloat(valor))) {
                      toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
                      document.getElementById(campoForm).value = "";
                      return false;
                 }else{
                      
                      return true;
		         } 
            }else{
                       toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
                       document.getElementById(campoForm).value = "";
                      return false;           
			}
 }

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


 $(document).ready(function(){
        $("#BtnMiProducto").on("keydown",function(){
    
            var producto = $("#BtnMiProducto").val();
            var datos = new FormData();
            datos.append("validarProducto", producto);

            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){

                   /* var res = JSON.parse(respuesta);
                    $("#BtnMiProducto").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>'+respuesta+' </div>');  */
                          if(respuesta.includes("null")){
                                $("#BtnMiProducto").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>No existe </div>');  
                          }else{
                               /*respuesta =respuesta.replace("[","");
                               respuesta =respuesta.replace("]","");*/
                               var res = JSON.parse(respuesta);
                                    
                                           // for (i = 0; i < res.datos.length; i++) {                                                      
                                                      $("#BtnMiProducto").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>existe '+res.datos.length+'</div>');  
                                             //    }


                                        
			              }




                    }

              })

        })
});



</script>



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
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
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
                     <input  style="visibility: hidden;" type="text" value ="" class="campoOculto form-control" id="campoOculto2" name ="campoOculto2">                                      
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEliminarValue" id = "btnEliminarValue" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 


  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form " method="post"  enctype="multipart/form-data" >
        <div class="modal fade" id="modificarp" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <i><h5  id="staticBackdropLabel" > Datos editables por producto </h5></i>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="col-sm-2">
                                <h5 class="colortextoformulariosetiquetas">Precio</h5>
                            </div>
                            <div class="col-sm-10">
                                <input   type="text" value ="" placeholder="Precio producto" class="form-control precioEdit" id="precioEdit" name ="precioEdit">  
                             </div>
                        </div>
                        
                        <input style="visibility: hidden;"  type="text" value ="" class="form-control idProduct" id="idProduct" name ="idProduct">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" name = "btnCancelarValue" id = "btnCancelarValue" class="btn btn-secondary" style ="width:48%;" onclick="history.go(0)">Cancelar</button>            
                                <button type="submit" name = "btnEditarValue" id = "btnEditarValue" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar Cambios</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>




  <!--Modal para el registro de producto-->

  <form class="form needs-validation" method="post"  enctype="multipart/form-data"onSubmit="return validarFormulario(this);" novalidate >
            <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
              aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                     <div class="modal-header text-center" style ="background-color: #D0A20E;color:#FFFFFF;">
                                    <h4 class="modal-title w-100 ">Registro de Producto</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                     </div>
                                  <div class="modal-body mx-3">
                                    <div class="md-form mb-4">
                                      <input id="nameProduct" name="nameProduct" type="text" placeholder="Nombre producto" class="form-control"   oninput="check_text(this);" required>                                      
                                    </div>

                                    <div class="md-form mb-4">
                                     <input id="price" name="price" type="text" placeholder="Precio" class="form-control" >
                                    </div>

                                    <div class="md-form mb-4">                                      
                                                <select class="form-control" onChange="mostrar(this.value);" id ="unit" name="unit" required>
                                                      <option value = "seleccion">Seleccione Peso/Volumen</option>
                                                       <?php for($i=0;$i<count($valorUnidades);$i++){?>
                                                            <option value='<?php echo $values[$i]."-".$valorUnidades[$i]["idunidadMedida"];?>'><?php echo $valorUnidades[$i]["nombreMedida"];?></option>
                                                       <?php }?>
                                                </select>
                                    </div>

                                     <div class="md-form mb-4"  id= "gramos">                                      
                                             <select class="form-control" name="grams" id ="grams" required>  
                                                     <option value='seleccione'>Seleccione Gramos</option> 
                                                  <?php for($i=0;$i<count($gramos);$i++){?>
                                                     <option value='<?php echo $gramos[$i];?>'><?php echo $gramos[$i];?></option>  
                                                  <?php }?>
                                             </select>
                                    </div>

                                     <div class="md-form mb-4"  id= "kilogramos"> 
                                         <select class="form-control" name="kilograms" id="kilograms" required>   
                                                  <option value='seleccione'>Seleccione Kilogramos</option> 
                                               <?php for($i=0;$i<count($kilogramos);$i++){?>
                                                  <option value='<?php echo $kilogramos[$i];?>'><?php echo $kilogramos[$i];?></option>  
                                               <?php }?>                                                                                                                                                                                                                                                                
                                          </select>
                                     </div>

                                      <div class="md-form mb-4"  id= "mililitros"> 
                                         <select class="form-control" name="milliliters" id ="milliliters" required>         
                                              <option value='seleccione'>Seleccione Mililitros</option> 
                                              <?php for($i=0;$i<count($mililitros);$i++){?>
                                                 <option value='<?php echo $mililitros[$i];?>'><?php echo $mililitros[$i];?></option>  
                                              <?php }?>  
                                         </select>
                                     </div>

                                      <div class="md-form mb-4"  id= "centimetros"> 
                                          <select class="form-control" name="centimeters" id ="centimeters" required>   
                                                  <option value='seleccione'>Seleccione cm3</option> 
                                               <?php for($i=0;$i<count($centimetros);$i++){?>
                                                  <option value='<?php echo $centimetros[$i];?>'><?php echo $centimetros[$i];?></option>  
                                               <?php }?>  
                                          </select>
                                     </div>


                                    <div class="md-form mb-4">
                                      <input id="Reference" name="Reference" type="text" placeholder="Referencia" class="form-control" required>
                                    </div>

                                    <div class="md-form mb-4">
                                            <select class="form-control" name="marca" id ="marca" required>  
                                                     <option value='seleccione'>Seleccione marca</option> 
                                                  <?php for($i=0;$i<count($marcas);$i++){?>
                                                     <option value='<?php echo $marcas[$i]["idMarca"];?>'><?php echo $marcas[$i]["Descripcion"];?></option>  
                                                  <?php }?>
                                             </select>
                                    </div>

                                   <div class="md-form mb-4">
                                              <select class="form-control" id="Category" name="Category" onChange="mostrarNuevaCategoria(this.value);" required >
                                                      <option value = "seleccion">Seleccione Categor&iacutea</option>     
                                                      <?php for($i=0;$i<count($resultSelect);$i++){?>
                                                           <option value = "<?php echo $resultSelect[$i]["idsubCategoria"]."-".$resultSelect[$i]["nombre"];?>"><?php echo $resultSelect[$i]["nombre"];?></option>
                                                      <?php }?>
                                                </select>
                                    </div>

                                    <div class="md-form mb-4 custom-file">
                                         <input type="file" class="custom-file-input" id="customFileLang" lang="es" required>
                                         <label class="custom-file-label" for="customFileLang">Seleccione Imagen Producto</label>
                                    </div>

                                    <div class="md-form">
                                      <i class="fas fa-pencil prefix grey-text"></i>
                                      <textarea class="form-control" id="description" name="description" placeholder="Breve descripci&oacute;n del producto" rows="3"></textarea>
                                    </div>

                                  </div>

                                   <div class="form-group">  
                                          <div class="modal-footer d-flex justify-content-center">         
                                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                                <button type="submit" name = "btnaddproducto" id = "btnaddproducto" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                                          </div>
                                    </div>
                </div>
              </div>
            </div>
  </form>





   <?php

     echo '    
             <script type="text/javascript">
                      mostrar("l");
                      
                      
            </script>'; 


  ?>