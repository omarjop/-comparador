

<?php 
$resultado=null;


  //--Boton del modal de agregar dia, crea objeto de la clase controlador
if(isset($_POST["btnadddia"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valordia = $_POST["adddias"]; 
     $objAdminAgregar->agregarCampoDia("dia","Descripcion",$valordia);
                       
    } 

//--Boton del modal de eliminar dia, crea objeto de la clase controlador
if(isset($_POST["btnEliminardia"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valordia = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valordia,"dia","idDia");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('D&iacute;a eliminado exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar D&iacute;a, por favor intente nuevamente);</script>";                             
         }                 
    
    } 

 //--Boton del modal de editar dia, crea objeto de la clase controlador
if(isset($_POST["btnEditardia"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idDiaModif = $_POST["idDia"];
     $valordia = $_POST["diaEdit"];  
     $resultadoModificar=$objAdminModificar->modificarCampo("dia","idDia","Descripcion",$valordia,$idDiaModif);
                                                                                                            
      
        
    } 
//-- Al entrar se visualizan todas las dias existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("dia");

//--Boton lupa consulta dia

if(isset($_POST["lupadia"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valordia = $_POST["buscadias"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valordia,"dia","*","Descripcion");
       
             if ($resultado==null){
               echo "<script>toastr.warning('El D&iacute;a no existe');</script>"; 
             }
    } 

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar dia*/
  function validarFormulario(formulario){
       var dia = formulario.adddias.value;
        if(validarNombreAnddia(dia,"No es un d&iacute;a v&aacute;lido","adddias")==true){
             
           if(validardiaAndRango(dia,"El nombre del d&icute;a es muy extenso","adddias")!=true){
              return false;
           }else{
               return true;     
           }
        }else{
            return false;
        }
        
        
        
  return true;
 }
     
 //--------------------------------------------------------
   function validarFormulario2(formulario){
       var diaEdita = formulario.diaEdit.value;
        if(validarNombreAnddia(diaEdita,"No es un d&iacute;a v&aacute;lido","diaEdit")==true){
             
           if(validardiaAndRango(diaEdita,"El nombre del d&icute;a es muy extenso","diaEdit")!=true){
              return false;
           }else{
               return true;     
           }
        }else{
            return false;
        }
        
        
        
  return true;
 }       
 //------funciones de validacion de cada uno de los campos
 function validarNombreAnddia(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
		 } 

 }
  //------funciones de validacion de cada uno de los campos
 function validardiaAndRango(valor,mensaje,campoForm){
      
         if ((valor.length) > 20){
              
              toastr.error(mensaje);
              document.getElementById(campoForm).value = "";
              return false;
         }else{       

             return true;
		 } 

 }
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnadddia").click(function(){
          
         if(returnValue!=false){
                          var nombreAddDia = $("#adddias").val();
                          var datos = new FormData();
            
                            datos.append("nombreAddDia", nombreAddDia);
         
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
                                             returnValue =  true;
                                          }else{
                                            toastr.error("El D&iacute;a se encuentra registrado");                             
                                            returnValue = false;                              
                                    }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


$(document).ready(function(){
        $("#adddias").on("keydown",function(){
          returnValue = true;
     });
});
//**********************************************************************/
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnEditardia").click(function(){
          
         if(returnValue!=false){
                          var nombreDiaEdit = $("#diaEdit").val();
                          var datos = new FormData();
            
                            datos.append("nombreDiaEdit", nombreDiaEdit);
         
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
                                             returnValue =  true;
                                          }else{
                                            toastr.error("El D&iacute;a se encuentra registrado");                             
                                            returnValue = false;                              
                                    }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


$(document).ready(function(){
        $("#adddias").on("keydown",function(){
          returnValue = true;
     });
});
//**********************************************************************/



</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Tabla D&iacute;a</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botadddia colorbotonamarillo" >Agregar D&iacute;a</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-6 col-md-7 col-sm-9 col-xs-8" id="buscadordia">
                        <input type="search" name="buscadias" id="buscadias" class="form-control"  placeholder="Buscar D&iacute;a">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupadia" type="submit" name="lupadia" id="lupadia" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["Descripcion"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span dia = "<?php echo $resultado[$i]["Descripcion"];?>" id ="<?php echo $resultado[$i]["idDia"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["Descripcion"];?>" id = "<?php echo $resultado[$i]["idDia"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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

/*LLama el modal de adicionar dia*/ 
 $(function(){
     $(".botadddia").click(function(){
         $("#modadddia").modal("show");  
      });
  });

  /*LLama el modal de editar dia*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idDia").attr('value',$(this).attr('id'));
         $(".diaEdit").attr('value',$(this).attr('dia'));
         $("#modifidia").modal("show");
         
      });
  });

  /*LLama el modal de eliminar dia*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminardia").modal("show");  
      });
  });

</script>

  <!-- Modal para agregar nueva dia -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modadddia" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar D&iacute;a</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="adddias" name ="adddias" placeholder="Agregue nombre de d&iacute;a" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnadddia" id = "btnadddia" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>



  <!-- Modal que muestra el confirmar cuando se elimina una dia -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminardia" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar el d&iacute;a? </h5>
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
                                <button type="submit" name = "btnEliminardia" id = "btnEliminardia" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 


  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifidia" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar D&iacute;a </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="modal-body mx-1 ">
                                <input   type="text" value ="" placeholder="Nombre dia" class="form-control diaEdit" id="diaEdit" name ="diaEdit" required>  
                             </div>
                        </div>
                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID d&iacute;a" class="form-control idDia" id="idDia" name ="idDia">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditardia" id = "btnEditardia" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
