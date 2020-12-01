
<?php 
$resultado=null;
$controlNumerico=array();
$controlCaracter=array();

//----- Objeto de la clase estrucutra con los valores del control de la tabla
$objControlCategoria = new ControladorEstructuras();
$vectorControlCategoria= $objControlCategoria->returnControlCategoria();
for ($i=0;$i<count($vectorControlCategoria);$i++){
 
 $porciones = explode("-", $vectorControlCategoria[$i]);
 array_push($controlNumerico, $porciones[0]);
  array_push($controlCaracter, $porciones[1]);
}

  //--Boton del modal de agregar unidad, crea objeto de la clase controlador
if(isset($_POST["btnaddCategoria"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorCategoria = $_POST["addCategoria"]; 
    $valorControl= $_POST["selecontrol"];
    $valorRuta=str_replace(' ', '', $valorCategoria);
    $objAdminAgregar->agregarCamposCategoria("categoria","nombre",$valorCategoria,"control",$valorControl,"ruta",$valorRuta);
   }  

//--Boton del modal de eliminar , crea objeto de la clase controlador
if(isset($_POST["btneliminarCateg"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorUnidElim = $_POST["campoOculto2"]; 
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorUnidElim,"categoria","idCategoria");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Categor&iacute;a eliminada exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar la categor&iacute;a, por favor intente nuevamente);</script>";                             
         }    
    
    } 
 //--Boton del modal de editar, crea objeto de la clase controlador
if(isset($_POST["btnEditarCategoria"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idUnidadModif = $_POST["idCategoria"];
     $valorCategoriaes = $_POST["categoriaEdit"];  
     $valorControlModif = $_POST["selecontrol2"]; 
     $resultadoModificar=$objAdminModificar->modifDosCampos("categoria","idCategoria","nombre",$valorCategoriaes,$idUnidadModif,"control",$valorControlModif);
                                                                                                            
      
        
    }                      

//-- Al entrar se visualizan todas las unidades existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("categoria");

  
//--Boton lupa consulta unidad

if(isset($_POST["lupaCategoria"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorCategoria = $_POST["buscaCategoria"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorCategoria,"categoria","*","nombre");
       
             if ($resultado==null){
               echo "<script>toastr.warning('La Categor&iacute;a no existe');</script>"; 
             }
    } 
?>

<script type="text/javascript">
/*Validación del campo de texto de agregar */
  function validarFormulario(formulario){
       var categoriaval = formulario.addCategoria.value;
       var seleControlCat = formulario.selecontrol.value;
        if(validarNombreAndUnidad(categoriaval,"No es una categor&iacute;a v&aacute;lida","addCategoria")==true &&
           validarUnidadAndRango(categoriaval,"El nombre de la categor&iacute;a es muy extenso","addCategoria")==true){
              
               if(validarNombreAndSelec(seleControlCat,"Seleccione una opci&oacute;n de control","selecontrol")==true ){
                  return true;
               }else{
                   return false;     
               }
        }else{
            return false;
        }
 
        
        
  return true;
 }
 //---------------------------------------------------------
   function validarFormulario2(formulario){
       var categoriavalEdi = formulario.categoriaEdit.value;
       var selecategoriaEditar = formulario.selecontrol2.value;
        if(validarNombreAndUnidad(categoriavalEdi,"No es una categor&iacute;a v&aacute;lida","categoriaEdit")==true &&
           validarUnidadAndRango(categoriavalEdi,"El nombre de la categor&iacute;a es muy extenso","categoriaEdit")==true){
              
               if(validarNombreAndSelec(selecategoriaEditar,"Seleccione una opci&oacute;n de control","selecontrol2")==true ){
                  return true;
               }else{
                   return false;     
               }
        }else{
            return false;
        }
 
        
        
  return true;
 }       
 //------funciones de validacion de cada uno de los campos
 function validarNombreAndUnidad(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
     } 

 }
  //------funciones de validacion de cada uno de los campos
 function validarUnidadAndRango(valor,mensaje,campoForm){
      
         if ((valor.length) > 50){
              
              toastr.error(mensaje);
              return false;
         }else{       

             return true;
     } 

 }
 //**********************************************************************/
    
 //------funciones de validacion del select control al adicionar
 function validarNombreAndSelec(valor,mensaje,campoForm){
      
         if (valor !="seleccion"){
              return true;
         }else{       
             toastr.error(mensaje);
             
             return false;
     } 

 }

var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnaddCategoria").click(function(){
    
            var nombreAddCategoria = $("#addCategoria").val();
            var nombreAddControl = $("#selecontrol").val();
            //alert(addCategoriaValue);
            var datos = new FormData();
            datos.append("nombreAddCategoria",nombreAddCategoria);
            datos.append("nombreAddControl",nombreAddControl);
         
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(respuesta.includes("No existe")){
                              $(".alert").remove();
                              returnValue = true;    
                      
                          }else{
                              
                              toastr.error("La categor&iacute;a se encuentra registrada");
                              returnValue = false;             
                          }


                    }

              })

            return returnValue;

        })
});

//-----------------------------------------------------------------------------------------------
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnEditarCategoria").click(function(){
    
            var nombreAddCategoria = $("#categoriaEdit").val();
            var nombreAddControl = $("#selecontrol2").val();
            //alert(addCategoriaValue);
            var datos = new FormData();
            datos.append("nombreAddCategoria",nombreAddCategoria);
            datos.append("nombreAddControl",nombreAddControl);
         
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(respuesta.includes("No existe")){
                              $(".alert").remove();
                              returnValue = true;    
                      
                          }else{
                              
                              toastr.error("La categor&iacute;a se encuentra registrada");
                              returnValue = false;             
                          }


                    }

              })

            return returnValue;

        })
});
//--------------------------------------------------------------------------------------------

</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Categor&iacute;as</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddCategoria colorbotonamarillo" >Agregar Categoria 
                </button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8 " id="buscadormarca"  >
                        <input type="search" name="buscaCategoria" id="buscaCategoria" class="form-control"  placeholder="Buscar categorias"  style ="height:500%;>
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaCategoria" type="submit" name="lupaCategoria" id="lupaCategoria" style ="height:100%;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
              </div>
             </form>
              </div>
          </div><!-- /.col -->

       <?php
          if ($resultado!= null && $resultado!= "Fallo" ){
            for ($i=0;$i<count($resultado);$i++){
             
        ?> 
            <ul class="list-group list-group-flush">
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombre"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span nombCategoria = "<?php echo $resultado[$i]["nombre"];?>" id = "<?php echo $resultado[$i]["idCategoria"];?>" idcontrol="<?php echo $resultado[$i]["control"];?>" class="fas fa-pen-alt editar"></span></p></a> 
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombre"];?>" id = "<?php echo $resultado[$i]["idCategoria"];?>" class="far fa-trash-alt eliminar"></span></p></a>          
              </li>

            </ul>
       <?php  } }?> 
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->



      </div><!-- /.container-fluid -->
    </div>

      <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
  
</div>

<script type="text/javascript">

/*LLama el modal de adicionar*/ 
 $(function(){
     $(".botaddCategoria").click(function(){

         $("#modaddCategoria").modal("show");  
      });
 });
  /*LLama el modal de editar */ 
 $(function(){
     $(".editar").click(function(){
         $(".idCategoria").attr('value',$(this).attr('id'));
         $(".categoriaEdit").attr('value',$(this).attr('nombCategoria'));   
         $("#modifiCategoria").modal("show");
         document.getElementById("selecontrol2").value=$(this).attr('idcontrol');
         
      });
  });    
  $(function(){
    $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarCateg").modal("show");  

      });
  });

</script>

  <!-- Modal para agregar nueva  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddCategoria" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header " style ="background-color: #D0A20E;color:#FFFFFF; >
                        <h5  id="staticBackdropLabel"> Agregar Categor&iacute;a</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addCategoria" name ="addCategoria" placeholder="Agregue Categoría">  
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol" name="selecontrol"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($controlNumerico);$i++){?>
                               <option value="<?php echo $controlNumerico[$i]; ?>"><?php echo $controlCaracter[$i]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddCategoria" id = "btnaddCategoria" class="btn btn-secondary colorbotonamarillo"  onclick="window.location.href="addCategorias" style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>


 <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarCateg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la categor&iacute;a? </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">

                   <div class="row">
                                <div class="col-sm-12">
                                   <div class="card" style="background-color: #E5E5E5;font-size:140%;">
                                      <div class="card-body">                                          
                                          <footer class="" style="font-size:110%;"><cite title="Source Title" id="etiquetaEliminar"></cite> </footer>                                                              
                                      </div>
                                </div>
                                </div>
                         </div>

                    <!-- aqui va el mensaje que se pasa por parametro-->
                     <input  style="visibility: hidden;" type="text" value ="" class="campoOculto form-control" id="campoOculto2" name ="campoOculto2">               
                       
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btneliminarCateg" id = "btneliminarCateg" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 

    <!-- Modal que muestra la unidad de medida al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifiCategoria" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar la categor&iacute;a </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>           
                        <!-- aqui va el mensaje que se pasa por parametro-->
                    <div class="modal-body mx-3">
                        <div class="modal-body mx-3 ">
                            <input   type="text" value ="" placeholder="Nombre Unidad" class="form-control categoriaEdit" id="categoriaEdit" name ="categoriaEdit" required>  
                       </div> 
                      </div> 
                    <div class="modal-body mx-3">     
                      <div class="modal-body mx-3">       
                      <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol2" name="selecontrol2"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($controlNumerico);$i++){?>
                               <option value="<?php echo $controlNumerico[$i]; ?>"><?php echo $controlCaracter[$i]; ?></option> 
                               <?php }?> 
                       </select>                                             
                    <input   style="visibility: hidden;" type="text" value ="" placeholder="ID" class="form-control idCategoria" id="idCategoria" name ="idCategoria"> 
                   </div>
                  </div>   
                    <div class="form-group">  
                          <div class="modal-footer d-flex justify-content-center">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarCategoria" id = "btnEditarCategoria" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>         
          </div>   
        </div>
      </div> 
  </form>