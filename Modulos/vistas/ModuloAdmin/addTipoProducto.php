<?php 
$resultado=null;



  //--Boton del modal de agregar, crea objeto de la clase controlador
if(isset($_POST["btnaddTipoProducto"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorTProducto= $_POST["addTipoProducto"]; 
   $objAdminAgregar->agregarCamposTProducto("tipoproducto","descripcion",$valorTProducto);
                       
    } 
    //--Boton del modal de eliminar , crea objeto de la clase controlador
if(isset($_POST["btnEliminarTProducto"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorTProdElimina = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorTProdElimina,"tipoproducto","idtipoProducto");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Tipo de producto eliminado');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar, por favor intente nuevamente);</script>";                             
         }    
   }
    //--Boton del modal de editar, crea objeto de la clase controlador
if(isset($_POST["btnEditarTProducto"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idTProdModif = $_POST["idtipoProducto"];
     $valorTipoProducto = $_POST["tipoproductoEdit"];  
     $resultadoModificar=$objAdminModificar->modificarCampo("tipoproducto","idtipoProducto","descripcion",$valorTipoProducto,$idTProdModif);
                                                                                                            
      
        
    } 

//-- Al entrar se visualizan todas las existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("tipoproducto");

if(isset($_POST["lupaTipoProducto"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorTipoProducto = $_POST["buscaTipoProducto"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorTipoProducto,"tipoproducto","*","descripcion");;
       
             if ($resultado==null){
               echo "<script>toastr.warning('El tipo de producto no existe');</script>"; 
             }
    }   
   

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar */
  function validarFormulario(formulario){
       var tproducto = formulario.addTipoProducto.value;

        if(validarNombreTipoProducto(tproducto,"No es un tipo de producto v&aacute;lido","addTipoProducto")==true){
             
           if(validaRangoTipoProducto(tproducto,"El nombre es muy extenso","addTipoProducto")!=true){
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
       var tproductoEdit = formulario.tipoproductoEdit.value;
       

        if(validarNombreTipoProducto(tproductoEdit,"No es un tipo de producto v&aacute;lido","tipoproductoEdit")==true){
             
           if(validaRangoTipoProducto(tproductoEdit,"El nombre es muy extenso","tipoproductoEdit")!=true){
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
 function validarNombreTipoProducto(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
     } 

 }
  //------funciones de validacion de cada uno de los campos
 function validaRangoTipoProducto(valor,mensaje,campoForm){
      
         if ((valor.length) > 30){
              
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
     $("#btnaddTipoProducto").click(function(){
          
         if(returnValue!=false){
                          var nombreAddTipoProd = $("#addTipoProducto").val();
                          var datos = new FormData();
            
                            datos.append("nombreAddTipoProd", nombreAddTipoProd);
                            datos.append("nombreAddTipoProd", nombreAddTipoProd);
         
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
                                            toastr.error("El tipo de producto se encuentra registrado");                             
                                            returnValue = false;                              
                                    }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


$(document).ready(function(){
        $("#addTipoProducto").on("keydown",function(){
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
            <h1 class="m-0 text-dark">Admin. Tipo Producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddTipoProducto colorbotonamarillo" >Agregar Tipo Prod.</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8" id="buscaTipoProducto">
                        <input type="search" name="buscaTipoProducto" id="buscaTipoProducto" class="form-control"  placeholder="Buscar Tipo Prod">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaTipoProducto" type="submit" name="lupaTipoProducto" id="lupaTipoProducto" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["descripcion"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span tproducto = "<?php echo $resultado[$i]["descripcion"];?>" id ="<?php echo $resultado[$i]["idtipoProducto"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["descripcion"];?>" id = "<?php echo $resultado[$i]["idtipoProducto"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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
     $(".botaddTipoProducto").click(function(){
         $("#modaddtipoproducto").modal("show");  
      });
  });
   /*LLama el modal de eliminar */ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#modeliminatipop").modal("show");  
      });
  });

  /*LLama el modal de editar marca*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idtipoProducto").attr('value',$(this).attr('id'));
         $(".tipoproductoEdit").attr('value',$(this).attr('tproducto'));
         $("#modmodiftipop").modal("show");
         
      });
  });

</script>

  <!-- Modal para agregar  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddtipoproducto" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar tipo de producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addTipoProducto" name ="addTipoProducto" placeholder="Agregue tipo de producto" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddTipoProducto" id = "btnaddTipoProducto" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>

   <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="modeliminatipop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

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
                                <button type="submit" name = "btnEliminarTProducto" id = "btnEliminarTProducto" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 
 <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modmodiftipop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar tipo de producto </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="modal-body mx-1 ">
                                <input   type="text" value ="" placeholder="Tipo de Empresa" class="form-control tipoproductoEdit" id="tipoproductoEdit" name ="tipoproductoEdit" required>  
                             </div>
                        </div>
                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID T Empresa" class="form-control idtipoProducto" id="idtipoProducto" name ="idtipoProducto">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarTProducto" id = "btnEditarTProducto" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>