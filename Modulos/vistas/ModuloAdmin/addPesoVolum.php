
<?php 
$resultado=null;
$controlNumerico=array();
$controlCaracter=array();

//----- Objeto  con valores tabla unidad medida
 $result = ControladorSelectsInTables:: selectTodosRegistros("unidadmedida");


  //--Boton del modal de agregar unidad, crea objeto de la clase controlador
if(isset($_POST["btnaddpesovolumen"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorpesovolumen = $_POST["addpesovolumen"]; 
    $valorUnidadMed= $_POST["selecontrol"];
    $objAdminAgregar->agregarCampospesovolumen("pesovolumen","medida",$valorpesovolumen,"unidadMedida_idunidadMedida",$valorUnidadMed);

   }  

//--Boton del modal de eliminar , crea objeto de la clase controlador
if(isset($_POST["btneliminarpesovolumen"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorpesovolumenElim = $_POST["campoOculto2"]; 
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorpesovolumenElim,"pesovolumen","idpesoVolumen");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Valor de peso-volumen eliminado exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar valor de peso-volumen, intente nuevamente);</script>";                             
         }    


      
    } 
 //--Boton del modal de editar, crea objeto de la clase controlador
if(isset($_POST["btnEditarUnidad"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idpesoVolumenModif = $_POST["idpesoVolumen"];
     $valorpesovolumenes = $_POST["pesovolumenEdit"];  
     $valorControlModif = $_POST["selecontrol2"]; 
     $resultadoModificar=$objAdminModificar->modifDosCampos("pesovolumen","idpesoVolumen","medida",$valorpesovolumenes,$idpesoVolumenModif,"unidadMedida_idunidadMedida",$valorControlModif);
                                                                                                            
      
        
    }                      

//-- Al entrar se visualizan todas las unidades existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("pesovolumen");

  
//--Boton lupa consulta unidad

if(isset($_POST["lupapesovolumen"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorpesovolumen = $_POST["buscapesovolumen"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorpesovolumen,"pesovolumen","*","medida");
       
             if ($resultado==null){
               echo "<script>toastr.warning('El registro de peso-volumen no existe');</script>"; 
             }
    } 
?>

<script type="text/javascript">
/*Validación del campo de texto de agregar */
  function validarFormulario(formulario){
       var unidadVal = formulario.addpesovolumen.value;
       var seleUnidad = formulario.selecontrol.value;
        if(validarNombreAndUnidad(unidadVal,"No es una medida de peso-volumen v&aacute;lida","addpesovolumen")==true)
		{  
               if(validarNombreAndSelec(seleUnidad,"Seleccione una opci&oacute;n de Unidad de Medida","selecontrol")==true ){
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
       var unidadValEdi = formulario.pesovolumenEdit.value;
       var seleUnidadEditar = formulario.selecontrol2.value;
        if(validarNombreAndUnidad(unidadValEdi,"No es una medida de peso volumen v&aacute;lida","pesovolumenEdit")==true){
              
		if(validarNombreAndSelec(seleUnidadEditar,"Seleccione una opci&oacute;n de Unida Medida","selecontrol2")==true ){
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
      
         if ((parseInt(valor))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
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

//********************************************************************/


</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Peso Volumen</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddpesovolumen colorbotonamarillo" >Agregar pesovolumen 
                </button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8 " id="buscadormarca"  >
                        <input type="search" name="buscapesovolumen" id="buscapesovolumen" class="form-control"  placeholder="Buscar pesovolumen"  style ="height:500%;>
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupapesovolumen" type="submit" name="lupapesovolumen" id="lupapesovolumen" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["medida"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span nombpesovolumens = "<?php echo $resultado[$i]["medida"];?>" id = "<?php echo $resultado[$i]["idpesoVolumen"];?>" idUnidad="<?php echo $resultado[$i]["unidadMedida_idunidadMedida"];?>" class="fas fa-pen-alt editar"></span></p></a> 
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["medida"];?>" id = "<?php echo $resultado[$i]["idpesoVolumen"];?>" class="far fa-trash-alt eliminar"></span></p></a>          
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
     $(".botaddpesovolumen").click(function(){

         $("#modaddpesovolumen").modal("show");  
      });
 });
  /*LLama el modal de editar */ 
 $(function(){
     $(".editar").click(function(){
         $(".idpesoVolumen").attr('value',$(this).attr('id'));
         $(".pesovolumenEdit").attr('value',$(this).attr('nombpesovolumens'));   
         $("#modifipesovolumen").modal("show");
         document.getElementById("selecontrol2").value=$(this).attr('idUnidad');
         
      });
  });    
  $(function(){
    $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarpesovolumen").modal("show");  

      });
  });

</script>

  <!-- Modal para agregar nueva  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddpesovolumen" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header " style ="background-color: #D0A20E;color:#FFFFFF; >
                        <h5  id="staticBackdropLabel"> Agregar peso/volumen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addpesovolumen" name ="addpesovolumen" placeholder="Agregue pesovolumen">  
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol" name="selecontrol"  required><option value = "seleccion">Seleccione Unidad</option>
                               <?php for($i=0;$i<count($result);$i++){?>
                               <option value="<?php echo $result[$i]["idunidadMedida"]; ?>"><?php echo $result[$i]["nombreMedida"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddpesovolumen" id = "btnaddpesovolumen" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>


 <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarpesovolumen" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la pesovolumen </h5>
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
                                <button type="submit" name = "btneliminarpesovolumen" id = "btneliminarpesovolumen" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 

    <!-- Modal que muestra la unidad de medida al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifipesovolumen" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar pesovolumen </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                 
                        <!-- aqui va el mensaje que se pasa por parametro-->
                      <div class="modal-body mx-3">
                                <input   type="text" value ="" placeholder="Nombre Unidad" class="form-control pesovolumenEdit" id="pesovolumenEdit" name ="pesovolumenEdit" required>  
                    </div>     
                      <div class="modal-body mx-3">       
                      <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol2" name="selecontrol2"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($result);$i++){?>
                               <option value="<?php echo $result[$i]["idunidadMedida"]; ?>"><?php echo $result[$i]["nombreMedida"]; ?></option> 
                               <?php }?> 
                       </select>
                                             
                    <input   style="visibility: hidden;" type="text" value ="" placeholder="ID" class="form-control idpesoVolumen" id="idpesoVolumen" name ="idpesoVolumen"> 
                     </div>  
                    <div class="form-group">  
                          <div class="modal-footer d-flex justify-content-center">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarUnidad" id = "btnEditarUnidad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
          
          </div>   
        </div>
      </div> 
  </form>