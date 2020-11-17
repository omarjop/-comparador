

<?php 
$resultado=null;


  //--Boton del modal de agregar dificultad, crea objeto de la clase controlador
if(isset($_POST["btnadddificultad"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valordificultad = $_POST["adddificultads"]; 
     $objAdminAgregar->agregarCampodificultad("dificultad","nombre",$valordificultad);
                       
    } 

//--Boton del modal de eliminar dificultad, crea objeto de la clase controlador
if(isset($_POST["btnEliminardificultad"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valordificultad = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valordificultad,"dificultad","iddificultad");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Registro eliminado exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar, por favor intente nuevamente);</script>";                             
         }                 
    
    } 

 //--Boton del modal de editar dificultad, crea objeto de la clase controlador
if(isset($_POST["btnEditardificultad"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $iddificultadModif = $_POST["iddificultad"];
     $valordificultad = $_POST["dificultadEdit"];
     echo "<script>toastr.info('$valordificultad');</script>";  
     $resultadoModificar=$objAdminModificar->modificarCampo("dificultad","iddificultad","nombre",$valordificultad,$iddificultadModif);
                                                                                                            
      
        
    } 
//-- Al entrar se visualizan todas las dificultads existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("dificultad");

//--Boton lupa consulta dificultad

if(isset($_POST["lupadificultad"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valordificultad = $_POST["buscadificultads"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valordificultad,"dificultad","*","nombre");
       
             if ($resultado==null){
               echo "<script>toastr.warning('El registro no existe');</script>"; 
             }
    } 

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar dificultad*/
  function validarFormulario(formulario){
       var dificultad = formulario.adddificultads.value;
        if(validarNombreAnddificultad(dificultad,"No es un nombre de dificultad v&aacute;lido","adddificultads")==true){
             
           if(validardificultadAndRango(dificultad,"El nombre es muy extenso","adddificultads")!=true){
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
       var dificultadEdita = formulario.dificultadEdit.value;
        if(validarNombreAnddificultad(dificultadEdita,"No es un registro v&aacute;lido","dificultadEdit")==true){
             
           if(validardificultadAndRango(dificultadEdita,"El nombre es muy extenso","dificultadEdit")!=true){
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
 function validarNombreAnddificultad(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
		 } 

 }
  //------funciones de validacion de cada uno de los campos
 function validardificultadAndRango(valor,mensaje,campoForm){
      
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
     $("#btnadddificultad").click(function(){
          
         if(returnValue!=false){
                          var nombreAdddificultad = $("#adddificultads").val();
                          var datos = new FormData();
            
                            datos.append("nombreAdddificultad", nombreAdddificultad);
         
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
                                            toastr.error("La dificultad se encuentra registrada");                             
                                            returnValue = false;                              
                                    }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


$(document).ready(function(){
        $("#adddificultads").on("keydown",function(){
          returnValue = true;
     });
});
//**********************************************************************/
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnEditardificultad").click(function(){
          
         if(returnValue!=false){
                          var nombredificultadEdit = $("#dificultadEdit").val();
                          var datos = new FormData();
            
                            datos.append("nombredificultadEdit", nombredificultadEdit);
         
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
                                            toastr.error("La dificultad se encuentra registrado");                             
                                            returnValue = false;                              
                                    }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


$(document).ready(function(){
        $("#adddificultads").on("keydown",function(){
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
            <h1 class="m-0 text-dark">Administraci&oacute;n Tabla Dificultad</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botadddificultad colorbotonamarillo" >Agregar Dificultad</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-6 col-md-7 col-sm-9 col-xs-8" id="buscadordificultad">
                        <input type="search" name="buscadificultads" id="buscadificultads" class="form-control"  placeholder="Buscar Dificultad">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupadificultad" type="submit" name="lupadificultad" id="lupadificultad" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombre"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span dificultad = "<?php echo $resultado[$i]["nombre"];?>" id ="<?php echo $resultado[$i]["iddificultad"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombre"];?>" id = "<?php echo $resultado[$i]["iddificultad"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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

/*LLama el modal de adicionar dificultad*/ 
 $(function(){
     $(".botadddificultad").click(function(){
         $("#modadddificultad").modal("show");  
      });
  });

  /*LLama el modal de editar dificultad*/ 
 $(function(){
     $(".editar").click(function(){
         $(".iddificultad").attr('value',$(this).attr('id'));
         $(".dificultadEdit").attr('value',$(this).attr('dificultad'));
         $("#modifidificultad").modal("show");
         
      });
  });

  /*LLama el modal de eliminar dificultad*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminardificultad").modal("show");  
      });
  });

</script>

   <!-- Modal para agregar nueva  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modadddificultad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar Dificultad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="adddificultads" name ="adddificultads" placeholder="Agregue nombre de dificultad" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnadddificultad" id = "btnadddificultad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>



<!-- Modal que muestra el confirmar cuando se elimina -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminardificultad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la dificultad? </h5>
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
                                <button type="submit" name = "btnEliminardificultad" id = "btnEliminardificultad" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 



  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifidificultad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar Dificultad </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="modal-body mx-1 ">
                                <input   type="text" value ="" placeholder="Nombre dificultad" class="form-control dificultadEdit" id="dificultadEdit" name ="dificultadEdit" required>  
                             </div>
                        </div>
                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID d&iacute;a" class="form-control iddificultad" id="iddificultad" name ="iddificultad">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditardificultad" id = "btnEditardificultad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
