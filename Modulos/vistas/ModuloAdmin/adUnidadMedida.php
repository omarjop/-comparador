<?php 
$resultado=null;
//---- Objeto clase ControladorEstructuras para mostrar el valor del control de la unidad de medida
$objControlUnidad= new ControladorEstructuras();
$resultadoControl= $objControlUnidad->returnControlUnidad();
$controlNumerico=array();
$controlCaracter=array();
for ($i=0;$i<count($resultadoControl);$i++)
{

 $aux = explode("-",$resultadoControl[$i]); 
 array_push($controlNumerico, $aux[0]); 
 array_push($controlCaracter, $aux[1]); 
}
 

  //--Boton del modal de agregar unidad, crea objeto de la clase controlador
if(isset($_POST["btnaddunidad"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorUnidad = $_POST["addunidad"]; 
    $valorControl= $_POST["selecontrol"];
      echo "<script>toastr.info('$valorControl');</script>";
     $objAdminAgregar->agregarCamposUnid("unidadmedida","nombreMedida",$valorUnidad,"control",$valorControl);
                       
    } 
//--Boton del modal de eliminar unidad, crea objeto de la clase controlador    
if(isset($_POST["btnEliminarUnidad"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorUnidad = $_POST["campoOculto2"]; 
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorUnidad,"unidadmedida","producto","idunidadMedida","unidadMedida_idunidadMedida");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Unidad de Medida eliminada exitosamente');</script>";                              
      }else if ($resultadoEliminar=="Asociado"){
           echo "<script>toastr.error('La unidad no se puede eliminar, tiene productos asociados');</script>";
      }else{
           echo "<script>toastr.error('Error al eliminar unidad, por favor intente nuevamente);</script>";                             
      }

    }   
  //--Boton del modal de editar unidad, crea objeto de la clase controlador
if(isset($_POST["btnEditarUnidad"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idUnidadModif = $_POST["idunidadMedida"];
     $valorUnidad = $_POST["unidadEdit"];  
     $valorControl= $_POST["selecontrol"];
     $resultadoModificar=$objAdminModificar->modificarCampo("unidadmedida","idunidadMedida","nombreMedida",$valorUnidad,$idUnidadModif);
                                                                                                            
      
        
    }      
//-- Al entrar se visualizan todas las unidades existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("unidadMedida");

//--Boton lupa consulta unidad

if(isset($_POST["lupaunidad"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorUnidad = $_POST["buscaunidad"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorUnidad,"unidadmedida","*","nombreMedida");;
       
             if ($resultado==null){
               echo "<script>toastr.warning('La unidad no existe');</script>"; 
             }
    } 

?>
<script type="text/javascript">
/*Validación del campo de texto de agregar unidad de medida*/
  function validarFormulario(formulario){
       var unidmedida = formulario.addunidad.value;
        if(validarNombreAndUnidad(unidmedida,"No es una unidad v&aacute;lida","addunidad")==true){
             
           if(validarMarcaAndRango(unidmedida,"El nombre de la unidad es muy extenso","addunidad")!=true){
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
 function validarMarcaAndRango(valor,mensaje,campoForm){
      
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
            <h1 class="m-0 text-dark">Administraci&oacute;n Unidad Medida</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddmarca colorbotonamarillo" >Agregar Unidad</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscadormarca">
                        <input type="search" name="buscaunidad" id="buscaunidad" class="form-control"  placeholder="Buscar unidad de medida">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupamarca" type="submit" name="lupaunidad" id="lupaunidad" style ="height:100%;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
              </div>
             </form>
              </div>
          </div><!-- /.col -->

        <?php
           if ($resultado!= null){
            for ($i=0;$i<count($resultado);$i++){
             
        ?> 
          <ul class="list-group list-group-flush">
            <div class="row justify-content-center">
             <div class="col-11">
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombreMedida"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span unidmedida = "<?php echo $resultado[$i]["nombreMedida"];?>" id ="<?php echo $resultado[$i]["idunidadMedida"];?>" idcontrol="<?php echo $resultado[$i]["control"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombreMedida"];?>" id = "<?php echo $resultado[$i]["idunidadMedida"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
              </li>
               </div>
               </div>
            </ul>
       <?php } }?> 
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->


<script type="text/javascript">

/*LLama el modal de adicionar unidad*/ 
 $(function(){
     $(".botaddmarca").click(function(){
         $("#modaddunidad").modal("show");  
      });
 });
  /*LLama el modal de editar marca*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idunidadMedida").attr('value',$(this).attr('id'));
         $(".unidadEdit").attr('value',$(this).attr('unidmedida'));
         $(".controlEdit").attr('value',$(this).attr('idcontrol'));
         $("#modifiUnidad").modal("show");
         
      });
  });    
  $(function(){
    $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarunidad").modal("show");  
      });
  });
</script>


<!-- Modal para agregar nueva marca -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddunidad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar Unidad de Medida</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addunidad" name ="addunidad" placeholder="Agregue nombre de unidad" >  

                   </div>
                   <div class="form-group-inline col-md-10">
                   
                     <div class="col-md-6 col-lg-6">
                      <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol" name="selecontrol"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($controlNumerico);$i++){?>
                               <option value="<?php echo $controlNumerico[$i]; ?>"><?php echo $controlCaracter[$i]; ?></option> 
                               <?php }?> 
                       </select>
                      </div>
                    </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddunidad" id = "btnaddunidad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>

 <!-- Modal que muestra el confirmar cuando se elimina una marca -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarunidad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la unidad? </h5>
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
                                <button type="submit" name = "btnEliminarUnidad" id = "btnEliminarUnidad" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 

    <!-- Modal que muestra la unidad de medida al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modifiUnidad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar Unidad Medida </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="col-sm-2">
                                <h5 class="colortextoformulariosetiquetas">Unidad</h5>
                            </div>
                            <div class="col-sm-10">
                                <input   type="text" value ="" placeholder="Nombre Unidad" class="form-control unidadEdit" id="unidadEdit" name ="unidadEdit" required>  
                             </div>
                        </div>

                          <div class="row">
                            <div class="col-sm-2">
                                <h5 class="colortextoformulariosetiquetas">Control</h5>
                            </div>
                            <div class="col-sm-10">
                                <input   type="text" value ="" placeholder="Nombre Unidad" class="form-control controlEdit" id="controlEdit" name ="controlEdit" required>  
                             </div>
                        </div>
                        


                   </div>

                    <input   style="visibility: hidden;" type="text" value ="" placeholder="ID Marca" class="form-control idunidadMedida" id="idunidadMedida" name ="idunidadMedida"> 
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarUnidad" id = "btnEditarUnidad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
