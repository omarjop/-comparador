<?php 
$resultado=null;



  //--Boton del modal de agregar, crea objeto de la clase controlador
if(isset($_POST["btnaddTipoEmpresa"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();

    $valorTEmpresa= $_POST["addTipoEmpresa"]; 
    
     $objAdminAgregar->agregarCamposTEmp("tipoempresa","descripcion",$valorTEmpresa);
                       
    } 
    //--Boton del modal de eliminar , crea objeto de la clase controlador
if(isset($_POST["btnEliminarTEmpresa"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorTEmpElimina = $_POST["campoOculto2"];  
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorTEmpElimina,"tipoempresa","idtipoEmpresa");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Tipo de empresa eliminada');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar, por favor intente nuevamente);</script>";                             
         }    
   }
    //--Boton del modal de editar, crea objeto de la clase controlador
if(isset($_POST["btnEditarTEmpresa"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idTEmpreModif = $_POST["idtipoEmpresa"];
     $valorTipoEmpresa = $_POST["tipoempresaEdit"];  
     $resultadoModificar=$objAdminModificar->modificarCampo("tipoempresa","idtipoEmpresa","descripcion",$valorTipoEmpresa,$idTEmpreModif);
                                                                                                            
      
        
    } 

if(isset($_POST["lupaTipoEmpresa"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorTipoEmpresa = $_POST["buscaTipoEmpresa"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorTipoEmpresa,"tipoempresa","*","descripcion");;
       
             if ($resultado==null){
               echo "<script>toastr.warning('El tipo de empresa no existe');</script>"; 
             }
    }   
   
//-- Al entrar se visualizan todas las existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("tipoempresa");
?>

<script type="text/javascript">
/*Validación del campo de texto de agregar */
  function validarFormulario(formulario){
       var tempresa = formulario.addTipoEmpresa.value;

        if(validarNombreTipoEmpresa(tempresa,"No es un tipo de empresa v&aacute;lido","addTipoEmpresa")==true){
             
           if(validaRangoTipoEmpresa(tempresa,"El nombre es muy extenso","addTipoEmpresa")!=true){
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
       var tempresaEdit = formulario.tipoempresaEdit.value;
       

        if(validarNombreTipoEmpresa(tempresaEdit,"No es un tipo de empresa v&aacute;lido","tipoempresaEdit")==true){
             
           if(validaRangoTipoEmpresa(tempresaEdit,"El nombre es muy extenso","tipoempresaEdit")!=true){
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
 function validarNombreTipoEmpresa(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
     } 

 }
  //------funciones de validacion de cada uno de los campos
 function validaRangoTipoEmpresa(valor,mensaje,campoForm){
      
         if ((valor.length) > 50){
              
              toastr.error(mensaje);
              document.getElementById(campoForm).value = "";
              return false;
         }else{       

             return true;
     } 

 }
//**********************************************************************/
</script>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin. Tipo Empresa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddTipoEmpresa colorbotonamarillo" >Agregar Tipo Emp</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8" id="buscaTipoEmpresa">
                        <input type="search" name="buscaTipoEmpresa" id="buscaTipoEmpresa" class="form-control"  placeholder="Buscar Tipo Emp">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaTipoEmpresa" type="submit" name="lupaTipoEmpresa" id="lupaTipoEmpresa" style ="height:100%;">
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
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span tempresa = "<?php echo $resultado[$i]["descripcion"];?>" id ="<?php echo $resultado[$i]["idtipoEmpresa"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["descripcion"];?>" id = "<?php echo $resultado[$i]["idtipoEmpresa"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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
     $(".botaddTipoEmpresa").click(function(){
         $("#modaddtipoempresa").modal("show");  
      });
  });
   /*LLama el modal de eliminar */ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#modeliminatipoe").modal("show");  
      });
  });

  /*LLama el modal de editar marca*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idtipoEmpresa").attr('value',$(this).attr('id'));
         $(".tipoempresaEdit").attr('value',$(this).attr('tempresa'));
         $("#modmodiftipoe").modal("show");
         
      });
  });

</script>

  <!-- Modal para agregar  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddtipoempresa" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar tipo de empresa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addTipoEmpresa" name ="addTipoEmpresa" placeholder="Agregue tipo de empresa" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddTipoEmpresa" id = "btnaddTipoEmpresa" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>

   <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="modeliminatipoe" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

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
                                <button type="submit" name = "btnEliminarTEmpresa" id = "btnEliminarTEmpresa" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 
 <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modmodiftipoe" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar tipo de empresa </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="modal-body mx-1 ">
                                <input   type="text" value ="" placeholder="Tipo de Empresa" class="form-control tipoempresaEdit" id="tipoempresaEdit" name ="tipoempresaEdit" required>  
                             </div>
                        </div>
                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID T Empresa" class="form-control idtipoEmpresa" id="idtipoEmpresa" name ="idtipoEmpresa">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarTEmpresa" id = "btnEditarTEmpresa" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>