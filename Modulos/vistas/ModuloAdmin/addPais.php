<?php 
$resultado=null;



  //--Boton del modal de agregar, crea objeto de la clase controlador
if(isset($_POST["btnaddPais"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();

    $valorPais= $_POST["addpais"]; 
    
     $objAdminAgregar->agregarCamposPais("pais","nombrePais",$valorPais);
                       
    } 
    //--Boton del modal de eliminar , crea objeto de la clase controlador
if(isset($_POST["btnEliminarPais"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorPaisElimina = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorPaisElimina,"pais","idpais");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Registro pais eliminado');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar, por favor intente nuevamente);</script>";                             
         }    
   }
    //--Boton del modal de editar, crea objeto de la clase controlador
if(isset($_POST["btnEditarPais"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idPaisModif = $_POST["idpais"];
     $valorpais = $_POST["paisEdit"];  
     $resultadoModificar=$objAdminModificar->modificarCampo("pais","idpais","nombrePais",$valorpais,$idPaisModif);
                                                                                                            
      
        
    } 

 //-- Al entrar se visualizan todas las existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("pais");   

if(isset($_POST["lupapais"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorpais = $_POST["buscapais"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorpais,"pais","*","nombrePais");;
       
             if ($resultado==null){
               echo "<script>toastr.warning('El registro del Pais no existe');</script>"; 
             }
    }   
   

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar */
  function validarFormulario(formulario){
       var tpais = formulario.addpais.value;

        if(validarNombrepais(tpais,"No es un Pais v&aacute;lido","addpais")==true){
             
           if(validaRangopais(tpais,"El nombre es muy extenso","addpais")!=true){
              return false;
           }else{
               return true;     
           }
        }else{
            return false;
        }
        
        
        
  return true;
 }
   
  //------------------------------------------------------
    function validarFormulario2(formulario){
       var tpaisEdit = formulario.paisEdit.value;
       

        if(validarNombrepais(tpaisEdit,"No es un Pais v&aacute;lido","paisEdit")==true){
             
           if(validaRangopais(tpaisEdit,"El nombre es muy extenso","paisEdit")!=true){
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
 function validarNombrepais(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
     } 

 }
  //------funciones de validacion de cada uno de los campos
 function validaRangopais(valor,mensaje,campoForm){
      
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
     $("#btnaddPais").click(function(){
          
         if(returnValue!=false){
                          var nombreAddPais = $("#addpais").val();
                          var datos = new FormData();
            
                            datos.append("nombreAddPais", nombreAddPais);
                            datos.append("nombreAddPais", nombreAddPais);
         
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
                                            toastr.error("El Pais se encuentra registrado");                             
                                            returnValue = false;                              
                                    }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


$(document).ready(function(){
        $("#addpais").on("keydown",function(){
          returnValue = true;
     });
});
//**********************************************************************/
//**********************************************************************/
</script>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Pa&iacute;s</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddpais colorbotonamarillo" >Agregar Pais</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8" id="buscapais">
                        <input type="search" name="buscapais" id="buscapais" class="form-control"  placeholder="Buscar Pais">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupapais" type="submit" name="lupapais" id="lupapais" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombrePais"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span tpais = "<?php echo $resultado[$i]["nombrePais"];?>" id ="<?php echo $resultado[$i]["idpais"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombrePais"];?>" id = "<?php echo $resultado[$i]["idpais"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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

/*LLama el modal de adicionar */ 
 $(function(){
     $(".botaddpais").click(function(){
         $("#modaddpais").modal("show");  
      });
  });
   /*LLama el modal de eliminar */ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#modeliminapais").modal("show");  
      });
  });

  /*LLama el modal de editar marca*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idpais").attr('value',$(this).attr('id'));
         $(".paisEdit").attr('value',$(this).attr('tpais'));
         $("#modmodifpais").modal("show");
         
      });
  });

</script>

  <!-- Modal para agregar  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddpais" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar Pa&iacute;s</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addpais" name ="addpais" placeholder="Agregue Pais" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddPais" id = "btnaddPais" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>

   <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="modeliminapais" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar? </h5>
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
                                <button type="submit" name = "btnEliminarPais" id = "btnEliminarPais" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 
 <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modmodifpais" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar Pa&iacute; </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="modal-body mx-1 ">
                                <input   type="text" value ="" placeholder="Pais" class="form-control paisEdit" id="paisEdit" name ="paisEdit" required>  
                             </div>
                        </div>
                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID Pais" class="form-control idpais" id="idpais" name ="idpais">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarPais" id = "btnEditarPais" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>