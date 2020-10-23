
<?php 
$resultado=null;
$controlNumerico=array();
$controlCaracter=array();

//----- Objeto de la clase estrucutra con los valores del control de la tabla
$objControlUnidad = new ControladorEstructuras();
$vectorControlUnidad= $objControlUnidad->returnControlUnidad();
for ($i=0;$i<count($vectorControlUnidad);$i++){
 
 $porciones = explode("-", $vectorControlUnidad[$i]);
 array_push($controlNumerico, $porciones[0]);
  array_push($controlCaracter, $porciones[1]);
}

  //--Boton del modal de agregar unidad, crea objeto de la clase controlador
if(isset($_POST["btnaddunidad"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorUnidad = $_POST["addunidad"]; 
    $valorControl= $_POST["selecontrol"];
   
     $objAdminAgregar->agregarCamposUnid("unidadmedida","nombreMedida",$valorUnidad,"control",$valorControl);
   }  

//--Boton del modal de eliminar , crea objeto de la clase controlador
if(isset($_POST["btnEliminarUnidad"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorUnidElim = $_POST["campoOculto2"]; 
     $objConsultaUnidad= new ControladorAdminSelect();
     $resultadoConsulta= $objConsultaUnidad->consultaPrevia($valorUnidElim,'producto','unidadMedida_idunidadMedida'); 
     if($resultadoConsulta==null){

        $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorUnidElim,"unidadmedida","idunidadMedida");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Unidad Medida eliminada exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar Unidad Medida, por favor intente nuevamente);</script>";                             
         }    

       }else{

          echo "<script>toastr.error('La unidad tiene productos asociados no se puede eliminar');</script>"; 
     }
      
    } 
 //--Boton del modal de editar, crea objeto de la clase controlador
if(isset($_POST["btnEditarUnidad"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idUnidadModif = $_POST["idunidadMedida"];
     $valorUnidades = $_POST["unidadEdit"];  
     $valorControlModif = $_POST["selecontrol2"]; 
     $resultadoModificar=$objAdminModificar->modifDosCampos("unidadmedida","idunidadMedida","nombreMedida",$valorUnidades,$idUnidadModif,"control",$valorControlModif);
                                                                                                            
      
        
    }                      

//-- Al entrar se visualizan todas las unidades existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("unidadmedida");
echo $resultado[0]["nombreMedida"];
  
//--Boton lupa consulta unidad

if(isset($_POST["lupaunidad"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorUnidad = $_POST["buscaunidad"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorUnidad,"unidadmedida","*","nombreMedida");
       
             if ($resultado==null){
               echo "<script>toastr.warning('La unidad de medida no existe');</script>"; 
             }
    } 
?>

<script type="text/javascript">

  function validarFormulario(formulario){
       var marca = formulario.addmarcas.value;
        if(validarNombreAndMarca(marca,"No es una unidad v&aacute;lida","addmarcas")!=true){
             return false;
		}
  return true;
 }
        
 //------funciones de validacion de cada uno de los campos
 function validarNombreAndMarca(valor,mensaje,campoForm){
      
         if (isNaN(parseInt(valor)) && (valor.length > 0)){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
		 } 
 }

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
              <button type="button" class="btn btn-warning botaddunidad colorbotonamarillo" >Agregar Unidad 
                </button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscadormarca">
                        <input type="search" name="buscaunidad" id="buscaunidad" class="form-control"  placeholder="Buscar unidad de medida">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaunidad" type="submit" name="lupaunidad" id="lupaunidad">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombreMedida"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span nombunidad = "<?php echo $resultado[$i]["nombreMedida"];?>" id = "<?php echo $resultado[$i]["idunidadMedida"];?>" idcontrol="<?php echo $resultado[$i]["control"];?>" class="fas fa-pen-alt editar"></span></p></a> 
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombreMedida"];?>" id = "<?php echo $resultado[$i]["idunidadMedida"];?>" class="far fa-trash-alt eliminar"></span></p></a>          
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
     $(".botaddunidad").click(function(){

         $("#modaddunidad").modal("show");  
      });
 });
  /*LLama el modal de editar */ 
 $(function(){
     $(".editar").click(function(){
         $(".idunidadMedida").attr('value',$(this).attr('id'));
         $(".unidadEdit").attr('value',$(this).attr('nombunidad'));   
         $("#modifiUnidad").modal("show");
         document.getElementById("selecontrol2").value=$(this).attr('idcontrol');
         
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

  <!-- Modal para agregar nueva  -->
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
                       
                         <input   type="text" class="form-control" id="addunidad" name ="addunidad" placeholder="Agregue unidad de medida" >  
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol" name="selecontrol"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($controlNumerico);$i++){?>
                               <option value="<?php echo $controlNumerico[$i]; ?>"><?php echo $controlCaracter[$i]; ?></option> 
                               <?php }?> 
                       </select>
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


 <!-- Modal que muestra el confirmar cuando se elimina  -->
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
                 
                        <!-- aqui va el mensaje que se pasa por parametro-->
                      <div class="modal-body mx-3">
                                <input   type="text" value ="" placeholder="Nombre Unidad" class="form-control unidadEdit" id="unidadEdit" name ="unidadEdit" required>  
                    </div>     
                      <div class="modal-body mx-3">       
                      <select class="form-control" onChange="mostrar(this.value);" id ="selecontrol2" name="selecontrol2"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($controlNumerico);$i++){?>
                               <option value="<?php echo $controlNumerico[$i]; ?>"><?php echo $controlCaracter[$i]; ?></option> 
                               <?php }?> 
                       </select>
                                             
                    <input   style="visibility: hidden;" type="text" value ="" placeholder="ID Marca" class="form-control idunidadMedida" id="idunidadMedida" name ="idunidadMedida"> 
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