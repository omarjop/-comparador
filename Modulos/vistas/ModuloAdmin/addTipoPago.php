

<?php 
$resultado=null;


  //--Boton del modal de agregar tipo_pago, crea objeto de la clase controlador
if(isset($_POST["btnaddTipoPago"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valortipo_pago = $_POST["addTipoPago"]; 
	  $valordesc_pago = $_POST["addDescripcionPago"];
    $objAdminAgregar->agregarCamposTipoPago("tipo_pago","Tipo_pago",$valortipo_pago,"Descripcion_pago",$valordesc_pago);
                       
    } 

//--Boton del modal de eliminar tipo_pago, crea objeto de la clase controlador
if(isset($_POST["btnEliminartipo_pago"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valortipo_pago = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valortipo_pago,"tipo_pago","idTipo_pago");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Tipo de pago eliminado exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar el Tipo de pago, por favor intente nuevamente);</script>";                             
         }                      
    } 

 //--Boton del modal de editar tipo_pago, crea objeto de la clase controlador
if(isset($_POST["btnEditartipo_pago"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idTipoPagoModif = $_POST["idtipo_pago"];
     $valortipo_pago = $_POST["tipo_pagoEdit"]; 
     $valordesc_pago= $_POST["desc_pagoEdit"];       
     $resultadoModificar=$objAdminModificar->modifDosCampos("tipo_pago","idTipo_pago","Tipo_pago",$valortipo_pago,$idTipoPagoModif,"Descripcion_pago",$valordesc_pago);
        
    } 
//-- Al entrar se visualizan todas las tipo_pagos existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("tipo_pago");

//--Boton lupa consulta tipo_pago

if(isset($_POST["lupatipo_pago"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valortipo_pago = $_POST["buscatipo_pagos"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valortipo_pago,"tipo_pago","*","Descripcion");
       
             if ($resultado==null){
               echo "<script>toastr.warning('El tipo de pago no existe');</script>"; 
             }
    } 

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar tipo_pago*/
  function validarFormulario(formulario){
       var tipo_pago = formulario.addTipoPago.value;
        if(validarNombreAndtipo_pago(tipo_pago,"No es un tipo de pago v&aacute;lido","addTipoPago")==true){
             
           if(validartipo_pagoAndRango(tipo_pago,"El nombre del tipo de pago es muy extenso","addTipoPago")!=true){
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
       var tipo_pagoEdita = formulario.tipo_pagoEdit.value;
       var desc_pagoEditar = formulario.desc_pagoEdit.value;

        if(validarNombreAndtipo_pago(tipo_pagoEdita,"No es un tipo de pago v&aacute;lida","tipo_pagoEdit")==true && validartipo_pagoAndRango(tipo_pagoEdita,"El nombre del tipo de pago es muy extenso","tipo_pagoEdit")!=true){
             
           if(validardesc_pagoAndRango(desc_pagoEditar,"La descripcion es muy extensa","desc_pagoEdit")!=true){
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
 function validarNombreAndtipo_pago(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
		 } 

 }
  //------funciones de validacion de cada uno de los campos
 function validartipo_pagoAndRango(valor,mensaje,campoForm){
      
         if ((valor.length) > 20){
              
              toastr.error(mensaje);
              document.getElementById(campoForm).value = "";
              return false;
         }else{       

             return true;
		 } 

 }
   //------funciones de validacion de cada uno de los campos
 function validardesc_pagoAndRango(valor,mensaje,campoForm){
      
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
     $("#btnaddTipoPago").click(function(){
          
         if(returnValue!=false){
                          var nombreAddtipo_pago = $("#addTipoPago").val();
                          var datos = new FormData();
            
                            datos.append("nombreAddtipo_pago", nombreAddtipo_pago);
                            datos.append("nombreAddtipo_pago", nombreAddtipo_pago);
         
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
                                            toastr.error("La tipo_pago se encuentra registrada");                             
                                            returnValue = false;                              
                                    }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


$(document).ready(function(){
        $("#addTipoPago").on("keydown",function(){
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
            <h1 class="m-0 text-dark">Administraci&oacute;n Tipo de Pago</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddtipo_pago colorbotonamarillo" >Agregar Tipo Pago</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-6 col-md-7 col-sm-9 col-xs-8" id="buscadortipo_pago">
                        <input type="search" name="buscatipo_pagos" id="buscatipo_pagos" class="form-control"  placeholder="Buscar tipo de pago">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupatipo_pago" type="submit" name="lupatipo_pago" id="lupatipo_pago" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["Tipo_pago"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span tipo_pago = "<?php echo $resultado[$i]["Tipo_pago"];?>" id ="<?php echo $resultado[$i]["idTipo_pago"];?>" desTipoPago="<?php echo $resultado[$i]["Descripcion_pago"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["Tipo_pago"];?>" id = "<?php echo $resultado[$i]["idTipo_pago"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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

/*LLama el modal de adicionar tipo_pago*/ 
 $(function(){
     $(".botaddtipo_pago").click(function(){
         $("#modaddtipo_pago").modal("show");  
      });
  });

  /*LLama el modal de editar tipo_pago*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idTipo_pago").attr('value',$(this).attr('id'));
         $(".tipo_pagoEdit").attr('value',$(this).attr('tipo_pago'));
         $(".desc_pagoEdit").attr('value',$(this).attr('desTipoPago'));
         
         $("#modifitipo_pago").modal("show");
         
      });
  });

  /*LLama el modal de eliminar tipo_pago*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminartipo_pago").modal("show");  
      });
  });

</script>

  <!-- Modal para agregar nueva tipo_pago -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddtipo_pago" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar tipo de pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body mx-3">
                       
                         <input   type="text" class="form-control" id="addTipoPago" name ="addTipoPago" placeholder="Nombre de tipo de pago" >  
                    </div>
                    <div class="modal-body mx-3">     
                         <input   type="text" class="form-control" id="addDescripcionPago" name ="addDescripcionPago" placeholder="Descripcion de tipo de pago" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddTipoPago" id = "btnaddTipoPago" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>



  <!-- Modal que muestra el confirmar cuando se elimina un tipo_pago -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminartipo_pago" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar el tipo de pago? </h5>
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
                                <button type="submit" name = "btnEliminartipo_pago" id = "btnEliminartipo_pago" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 


  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifitipo_pago" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar tipo de pago </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body mx-3">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">

                   <div class="modal-body mx-3">
                       
                         <input   type="text" value ="" class="form-control tipo_pagoEdit" id="tipo_pagoEdit" name ="tipo_pagoEdit" placeholder="Nombre de tipo de pago" required >  
                    </div>
                    <div class="modal-body mx-3">     
                         <input   type="text" value ="" class="form-control desc_pagoEdit" id="desc_pagoEdit" name ="desc_pagoEdit" placeholder="Descripcion de tipo de pago" required>  
                   </div>
                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID tipo_pago" class="form-control idTipo_pago" id="idTipo_pago" name ="idtipo_pago">  
                   </div>
                   </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditartipo_pago" id = "btnEditartipo_pago" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
