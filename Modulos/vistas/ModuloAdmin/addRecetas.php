

<?php 
$resultado=null;
 $resultCat = ControladorSelectsInTables:: selectTodosRegistros("categoria");
 $resultDif = ControladorSelectsInTables:: selectTodosRegistros("dificultad");

  //--Boton del modal de agregar recetas, crea objeto de la clase controlador
if(isset($_POST["btnaddRecetas"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorrecetas = $_POST["addRecetas"];
    $valorDificultad = $_POST["selecontrol"];  
     $objAdminAgregar->agregarCamposrecetas("recetas","Nombre",$valorrecetas,"dificultad_iddificultad",$valorDificultad);
                       
    } 

//--Boton del modal de eliminar recetas, crea objeto de la clase controlador
if(isset($_POST["btnEliminarrecetas"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorrecetas = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorrecetas,"recetas","idRecetas");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Receta eliminada exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar receta, por favor intente nuevamente);</script>";                             
		 }
    } 

 //--Boton del modal de editar recetas, crea objeto de la clase controlador
if(isset($_POST["btnEditarrecetas"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idModif = $_POST["idRecetas"];
     $valorrecetas = $_POST["recetasEdit"];
     $valorDificultadmod = $_POST["selecontrol2"];  
     $resultadoModificar=$objAdminModificar->modifDosCampos("recetas","idRecetas","Nombre",$valorrecetas,$idModif,"dificultad_iddificultad",$valorDificultadmod);                                                                                      
      
        
    } 
//-- Al entrar se visualizan todas las recetass existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("recetas");

//--Boton lupa consulta recetas

if(isset($_POST["luparecetas"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorrecetas = $_POST["buscarecetass"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorrecetas,"recetas","*","Nombre");
       
             if ($resultado==null){
               echo "<script>toastr.warning('La receta no existe');</script>"; 
             }
    } 

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar recetas*/
  function validarFormulario(formulario){
       var recetas = formulario.addRecetas.value;
       var seleControlCat = formulario.selecontrol.value;
        if(validarNombreAndrecetas(recetas,"No es una receta v&aacute;lida","addRecetas")==true && validarrecetasAndRango(recetas,"El nombre de la recetas es muy extenso","addRecetas")==true){
             
           if(validarNombreAndSelec(seleControlCat,"Seleccione una opci&oacute;n de dificultad","selecontrol")==true ){
              return true;
           }else{
               return false;     
           }
        }else{
            return false;
        }
             
  return true;
 }
     
 //--------------------------------------------------------
   function validarFormulario2(formulario){
       var recetasEdita = formulario.recetasEdit.value;
       var seleControlCat = formulario.selecontrol2.value;
        if(validarNombreAndrecetas(recetasEdita,"No es una receta v&aacute;lida","recetasEdit")==true && validarrecetasAndRango(recetasEdita,"El nombre de la recetas es muy extenso","recetasEdit")==true){
             
           if(validarNombreAndSelec(seleControlCat,"Seleccione una opci&oacute;n de dificultad","selecontrol2")==true ){
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
 function validarNombreAndrecetas(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
		 } 

 }
  //------funciones de validacion de cada uno de los campos
 function validarrecetasAndRango(valor,mensaje,campoForm){
      
         if ((valor.length) > 20){
              
              toastr.error(mensaje);
              document.getElementById(campoForm).value = "";
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

 //--------------------------------------------------------------------------------------------------
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnaddRecetas").click(function(){
    
            var nombreaddRecetas = $("#addRecetas").val();
            var nombreAddControl = $("#selecontrol").val();
            //alert(addCategoriaValue);
            var datos = new FormData();
            datos.append("nombreaddRecetas",nombreaddRecetas);
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
                              
                              toastr.error("La receta se encuentra registrada");
                              returnValue = false;             
                          }


                    }

              })

            return returnValue;

        })
});

//**********************************************************************/
//-----------------------------------------------------------------------------------------------
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnEditarrecetas").click(function(){
    
            var nombreEditrecetas = $("#recetasEdit").val();
            var nombreEditControl = $("#selecontrol2").val();
            //alert(addCategoriaValue);
            var datos = new FormData();
            datos.append("nombreEditrecetas",nombreEditrecetas);
            datos.append("nombreEditControl",nombreEditControl);
         
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
                              
                              toastr.error("La recetas se encuentra registrada");
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
            <h1 class="m-0 text-dark">Administraci&oacute;n Recetas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddRecetas colorbotonamarillo" >Agregar recetas</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-6 col-md-7 col-sm-9 col-xs-8" id="buscadorrecetas">
                        <input type="search" name="buscarecetass" id="buscarecetass" class="form-control"  placeholder="Buscar recetas">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo luparecetas" type="submit" name="luparecetas" id="luparecetas" style ="height:100%;">
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
            <div class="row justify-content-center">
             <div class="col-11">
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombreReceta"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span recetas = "<?php echo $resultado[$i]["nombreReceta"];?>" id ="<?php echo $resultado[$i]["idRecetas"];?>" iddificultad="<?php echo $resultado[$i]["dificultad_iddificultad"];?>"class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombreReceta"];?>" id = "<?php echo $resultado[$i]["idRecetas"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
              </li>
               </div>
               </div>
            </ul>
       <?php } }?> 
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
  

      <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>

  
</div>
<script type="text/javascript">

/*LLama el modal de adicionar recetas*/ 
 $(function(){
     $(".botaddRecetas").click(function(){
         $("#modaddRecetas").modal("show");  
      });
  });

  /*LLama el modal de editar recetas*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idRecetas").attr('value',$(this).attr('id'));
         $(".recetasEdit").attr('value',$(this).attr('recetas'));
         $("#modifirecetas").modal("show");
         document.getElementById("selecontrol2").value=$(this).attr('iddificultad');
      });
  });

  /*LLama el modal de eliminar recetas*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarrecetas").modal("show");  
      });
  });

</script>

  <!-- Modal para agregar nueva recetas -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddRecetas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar recetas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addRecetas" name ="addRecetas" placeholder="Agregue nombre de recetas" >  
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol" name="selecontrol"  required><option value = "seleccion">Seleccione Dificultad</option>
                               <?php for($i=0;$i<count($resultDif);$i++){?>
                               <option value="<?php echo $resultDif[$i]["iddificultad"]; ?>"><?php echo $resultDif[$i]["nombre"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddRecetas" id = "btnaddRecetas" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>



  <!-- Modal que muestra el confirmar cuando se elimina una recetas -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarrecetas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la recetas? </h5>
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
                                <button type="submit" name = "btnEliminarrecetas" id = "btnEliminarrecetas" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 


  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifirecetas" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar recetas </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body mx-3">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                            <div class="modal-body mx-3 ">
                                <input   type="text" value ="" placeholder="Nombre recetas" class="form-control recetasEdit" id="recetasEdit" name ="recetasEdit" required>  
                             </div>
                        </div>
                      <div class="modal-body mx-3">  
                       <div class="modal-body mx-3">      
                      <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol2" name="selecontrol2"  required><option value = "seleccion">Seleccione Dificultad</option>
                               <?php for($i=0;$i<count($resultDif);$i++){?>
                               <option value="<?php echo $resultDif[$i]["iddificultad"];?>"><?php echo $resultDif[$i]["nombre"]; ?></option> 
                               <?php }?> 
                       </select>                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID recetas" class="form-control idRecetas" id="idRecetas" name ="idRecetas">  
                   </div>
                   </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarrecetas" id = "btnEditarrecetas" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
