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
  $objLog-> escribirEnLog("Consultar","INFO",$nitTienda,"Se inicia el proceso de Consultar Productos ");
  $valorResult = null;


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
      $sql = "SELECT  DISTINCT idsubCategoria ,nombre,ruta from subcategoria t3 INNER JOIN (SELECT DISTINCT subCategoria_idsubCategoria FROM producto t1 INNER JOIN ( SELECT Producto_idProducto FROM producto_has_empresa  where Empresa_idEmpresa = ".$idTienda." ) t2 ON t1.idProducto  = t2.Producto_idProducto) t4 ON t3.idsubCategoria  = t4.subCategoria_idsubCategoria";
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
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->

<div class="row">
		                <div class="col-sm-5">
                                <form class="form-signin" role="form" enctype="multipart/form-data" method="post" action="" name="formulario" id="formulario">
                                      <div class="form-group">                                        
                                          <input type="text" name="BtnMiProducto" id="BtnMiProducto"  class="form-control" placeholder="Buscar producto" />   

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


  function validarFormulario(formulario){
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



//----------------------------------funcion para autocompletar

/*
    $(document).ready(function(){
	$("input#BtnMiProducto").on("keydown",function(){
		var valor = $(this).val();
        $("div#mensaje p").html(valor);
	});

   });*/

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
                               respuesta =respuesta.replace("[","");
                               respuesta =respuesta.replace("]","");
                               var res = JSON.parse(respuesta);
                                    
                                           // for (i = 0; i < res.datos.length; i++) {                                                      
                                                      $("#BtnMiProducto").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>existe '+respuesta+'</div>');  
                                                // }


                                        
			              }




                    }

              })

        })
});


/*BtnMiProducto.addEventListener('keyup', (event) => {
 
   if (!document.querySelector("#autoCompletedList")) {

        ul = document.createElement('ul');
        ul.setAttribute('id', 'autoCompletedList');
        BtnMiProducto.after(ul);
        
    }

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {

        if (xhr.readyState < 4) { }
    }
     xhr.onload = function () {

        if (xhr.status == 200) {
      
            var res = JSON.parse(this.responseText);
             // alert(xhr.status);
            // remove elements
            lista = document.querySelector('#autoCompletedList');
            lista.innerHTML = "";

            if (!res.error) {
                 
                for (i = 0; i < res.datos.length; i++) {
 
                    let id = res.datos[i].id;
                    let nombre = res.datos[i].nombre;

                    li = document.createElement("li");
                    li.setAttribute('class', 'item' + res.datos[i].id);
                    li.innerHTML = res.datos[i].nombre;
                    lista.prepend(li);
 
                    document.querySelector('.item' + id).addEventListener('click', () => {
                        document.querySelector("#BtnMiProducto").value = nombre;
                        lista.innerHTML = "";
                    })
                }
            }
 
         }
    }
    xhr.open('post', 'http://localhost/-comparador/Modulos/ajax/validacion.ajax.php', true);
    // form data
    let form = document.querySelector('#formulario');
    data = new FormData(form);
    xhr.send(data);
})*/
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
  <form class="form " method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);">
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