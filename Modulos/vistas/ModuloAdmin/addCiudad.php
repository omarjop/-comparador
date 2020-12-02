

<?php 
$resultado=null;
 $result = ControladorSelectsInTables:: selectTodosRegistros("pais");

  //--Boton del modal de agregar ciudad, crea objeto de la clase controlador
if(isset($_POST["btnaddciudad"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorciudad = $_POST["addciudad"];
    $valorpais = $_POST["selecontrol"];  
     $objAdminAgregar->agregarCamposCiudad("ciudad","nombreCiudad",$valorciudad,"pais_idpais",$valorpais);
                       
    } 

//--Boton del modal de eliminar ciudad, crea objeto de la clase controlador
if(isset($_POST["btnEliminarciudad"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorciudad = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorciudad,"ciudad","idciudad");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('ciudad eliminada exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar ciudad, por favor intente nuevamente);</script>";                             
		 }
    } 

 //--Boton del modal de editar ciudad, crea objeto de la clase controlador
if(isset($_POST["btnEditarciudad"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idModif = $_POST["idciudad"];
     $valorciudad = $_POST["ciudadEdit"];
     $valorpaismod = $_POST["selecontrol2"];  
     $resultadoModificar=$objAdminModificar->modifDosCampos("ciudad","idciudad","nombreCiudad",$valorciudad,$idModif,"pais_idpais",$valorpaismod);                                                                                      
      
        
    } 
//-- Al entrar se visualizan todas las ciudads existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("ciudad");

//--Boton lupa consulta ciudad

if(isset($_POST["lupaciudad"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorciudad = $_POST["buscaciudads"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorciudad,"ciudad","*","nombreCiudad");
       
             if ($resultado==null){
               echo "<script>toastr.warning('La ciudad no existe');</script>"; 
             }
    } 

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar ciudad*/
  function validarFormulario(formulario){
       var ciudad = formulario.addciudad.value;
       var seleControlCat = formulario.selecontrol.value;
        if(validarNombreAndciudad(ciudad,"No es una ciudad v&aacute;lida","addciudad")==true && validarciudadAndRango(ciudad,"El nombre de la ciudad es muy extenso","addciudad")==true){
             
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
     
 //--------------------------------------------------------
   function validarFormulario2(formulario){
       var ciudadEdita = formulario.ciudadEdit.value;
       var seleControlCat = formulario.selecontrol2.value;
        if(validarNombreAndciudad(ciudadEdita,"No es una ciudad v&aacute;lida","ciudadEdit")==true && validarciudadAndRango(ciudadEdita,"El nombre de la ciudad es muy extenso","ciudadEdit")==true){
             
           if(validarNombreAndSelec(seleControlCat,"Seleccione una opci&oacute;n de control","selecontrol2")==true ){
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
 function validarNombreAndciudad(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
		 } 

 }
  //------funciones de validacion de cada uno de los campos
 function validarciudadAndRango(valor,mensaje,campoForm){
      
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
     $("#btnaddciudad").click(function(){
    
            var nombreAddCiudad = $("#addciudad").val();
            var nombreAddControl = $("#selecontrol").val();
            //alert(addCategoriaValue);
            var datos = new FormData();
            datos.append("nombreAddCiudad",nombreAddCiudad);
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
                              
                              toastr.error("La ciudad se encuentra registrada");
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
     $("#btnEditarciudad").click(function(){
    
            var nombreEditCiudad = $("#ciudadEdit").val();
            var nombreEditControl = $("#selecontrol2").val();
            //alert(addCategoriaValue);
            var datos = new FormData();
            datos.append("nombreEditCiudad",nombreEditCiudad);
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
                              
                              toastr.error("La ciudad se encuentra registrada");
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
            <h1 class="m-0 text-dark">Administraci&oacute;n Ciudad</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddciudad colorbotonamarillo" >Agregar ciudad</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-6 col-md-7 col-sm-9 col-xs-8" id="buscadorciudad">
                        <input type="search" name="buscaciudads" id="buscaciudads" class="form-control"  placeholder="Buscar ciudad">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaciudad" type="submit" name="lupaciudad" id="lupaciudad" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombreCiudad"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span ciudad = "<?php echo $resultado[$i]["nombreCiudad"];?>" id ="<?php echo $resultado[$i]["idciudad"];?>" idpais="<?php echo $resultado[$i]["pais_idpais"];?>"class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombreCiudad"];?>" id = "<?php echo $resultado[$i]["idciudad"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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

/*LLama el modal de adicionar ciudad*/ 
 $(function(){
     $(".botaddciudad").click(function(){
         $("#modaddciudad").modal("show");  
      });
  });

  /*LLama el modal de editar ciudad*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idciudad").attr('value',$(this).attr('id'));
         $(".ciudadEdit").attr('value',$(this).attr('ciudad'));
         $("#modificiudad").modal("show");
         document.getElementById("selecontrol2").value=$(this).attr('idpais');
      });
  });

  /*LLama el modal de eliminar ciudad*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarciudad").modal("show");  
      });
  });

</script>

  <!-- Modal para agregar nueva ciudad -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddciudad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar ciudad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addciudad" name ="addciudad" placeholder="Agregue nombre de ciudad" >  
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol" name="selecontrol"  required><option value = "seleccion">Seleccione Pais</option>
                               <?php for($i=0;$i<count($result);$i++){?>
                               <option value="<?php echo $result[$i]["idpais"]; ?>"><?php echo $result[$i]["nombrePais"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddciudad" id = "btnaddciudad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>



  <!-- Modal que muestra el confirmar cuando se elimina una ciudad -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarciudad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la ciudad? </h5>
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
                                <button type="submit" name = "btnEliminarciudad" id = "btnEliminarciudad" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 


  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modificiudad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar ciudad </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body mx-3">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                            <div class="modal-body mx-3 ">
                                <input   type="text" value ="" placeholder="Nombre ciudad" class="form-control ciudadEdit" id="ciudadEdit" name ="ciudadEdit" required>  
                             </div>
                        </div>
                      <div class="modal-body mx-3">  
                       <div class="modal-body mx-3">      
                      <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol2" name="selecontrol2"  required><option value = "seleccion">Seleccione Pais</option>
                               <?php for($i=0;$i<count($result);$i++){?>
                               <option value="<?php echo $result[$i]["idpais"];?>"><?php echo $result[$i]["nombrePais"]; ?></option> 
                               <?php }?> 
                       </select>                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID ciudad" class="form-control idciudad" id="idciudad" name ="idciudad">  
                   </div>
                   </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarciudad" id = "btnEditarciudad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
