
<?php 
$resultado=null;
$controlNumerico=array();
$controlCaracter=array();

//----- Objeto  con valores tabla pais
 $resultSelect = ControladorSelectsInTables:: selectTodosRegistros("pais");


  //--Boton del modal de agregar unidad, crea objeto de la clase controlador
if(isset($_POST["btnaddCiudad"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorCiudad = $_POST["addCiudad"]; 
    $valorPais= $_POST["selePais"];
    $objAdminAgregar->agregarCamposCiudad("ciudad","nombreCiudad",$valorCiudad,"pais_idpais",$valorPais);
   }  

//--Boton del modal de eliminar , crea objeto de la clase controlador
if(isset($_POST["btneliminarCiudad"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorCiudadElim = $_POST["campoOculto2"]; 
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorCiudadElim,"ciudad","idciudad");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Ciudad eliminada exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar Ciudad, por favor intente nuevamente);</script>";                             
         }    


      
    } 
 //--Boton del modal de editar, crea objeto de la clase controlador
if(isset($_POST["btnEditarUnidad"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idCiudadModif = $_POST["idciudad"];
     $valorCiudades = $_POST["ciudadEdit"];  
     $valorControlModif = $_POST["selePais2"]; 
     $resultadoModificar=$objAdminModificar->modifDosCampos("ciudad","idciudad","nombreCiudad",$valorCiudades,$idCiudadModif,"pais_idpais",$valorControlModif);
                                                                                                            
      
        
    }                      

//-- Al entrar se visualizan todas las unidades existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("ciudad");

  
//--Boton lupa consulta unidad

if(isset($_POST["lupaCiudad"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorCiudad = $_POST["buscaCiudad"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorCiudad,"ciudad","*","nombreCiudad");
       
             if ($resultado==null){
               echo "<script>toastr.warning('La Ciudad no existe');</script>"; 
             }
    } 
?>

<script type="text/javascript">
/*Validación del campo de texto de agregar */
  function validarFormulario(formulario){
       var unidadVal = formulario.addCiudad.value;
       var seleUnidad = formulario.selePais.value;
        if(validarNombreAndUnidad(unidadVal,"No es una Ciudad v&aacute;lida","addCiudad")==true &&
           validarUnidadAndRango(unidadVal,"El nombre de la Ciudad es muy extenso","addCiudad")==true){
              
               if(validarNombreAndSelec(seleUnidad,"Seleccione una opci&oacute;n de Pa&iacute;s","selePais")==true ){
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
       var unidadValEdi = formulario.ciudadEdit.value;
       var seleUnidadEditar = formulario.selePais2.value;
        if(validarNombreAndUnidad(unidadValEdi,"No es una Ciudad v&aacute;lida","ciudadEdit")==true &&
           validarUnidadAndRango(unidadValEdi,"El nombre de la Ciudad es muy extenso","ciudadEdit")==true){
              
               if(validarNombreAndSelec(seleUnidadEditar,"Seleccione una opci&oacute;n de Pa&iacute;s","selePais2")==true ){
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
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
     } 

 }
  //------funciones de validacion de cada uno de los campos
 function validarUnidadAndRango(valor,mensaje,campoForm){
      
         if ((valor.length) > 20){
              
              toastr.error(mensaje);
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
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnaddCiudad").click(function(){
    
            var addCiudadValue = $("#addCiudad").val();
            //alert(addCiudadValue);
            var datos = new FormData();
            datos.append("addCiudadValue",addCiudadValue);
         
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
                              
                              toastr.error("La Ciudad se encuentra registrada");
                              returnValue = false;             
                          }


                    }

              })

            return returnValue;

        })
});



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
              <button type="button" class="btn btn-warning botaddCiudad colorbotonamarillo" >Agregar Ciudad 
                </button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8 " id="buscadormarca"  >
                        <input type="search" name="buscaCiudad" id="buscaCiudad" class="form-control"  placeholder="Buscar Ciudad"  style ="height:500%;>
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaCiudad" type="submit" name="lupaCiudad" id="lupaCiudad" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombreCiudad"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span nombCiudads = "<?php echo $resultado[$i]["nombreCiudad"];?>" id = "<?php echo $resultado[$i]["idciudad"];?>" idPais="<?php echo $resultado[$i]["pais_idpais"];?>" class="fas fa-pen-alt editar"></span></p></a> 
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombreCiudad"];?>" id = "<?php echo $resultado[$i]["idciudad"];?>" class="far fa-trash-alt eliminar"></span></p></a>          
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
     $(".botaddCiudad").click(function(){

         $("#modaddCiudad").modal("show");  
      });
 });
  /*LLama el modal de editar */ 
 $(function(){
     $(".editar").click(function(){
         $(".idciudad").attr('value',$(this).attr('id'));
         $(".ciudadEdit").attr('value',$(this).attr('nombCiudads'));   
         $("#modifiCiudad").modal("show");
         document.getElementById("selePais2").value=$(this).attr('idPais');
         
      });
  });    
  $(function(){
    $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarCiudad").modal("show");  

      });
  });

</script>

  <!-- Modal para agregar nueva  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddCiudad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header " style ="background-color: #D0A20E;color:#FFFFFF; >
                        <h5  id="staticBackdropLabel"> Agregar Ciudad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addCiudad" name ="addCiudad" placeholder="Agregue Ciudad">  
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selePais" name="selePais"  required><option value = "seleccion">Seleccione Pais</option>
                               <?php for($i=0;$i<count($resultSelect);$i++){?>
                               <option value="<?php echo $resultSelect[$i]["idpais"]; ?>"><?php echo $resultSelect[$i]["nombrePais"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddCiudad" id = "btnaddCiudad" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>


 <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarCiudad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la Ciudad </h5>
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
                                <button type="submit" name = "btneliminarCiudad" id = "btneliminarCiudad" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 

    <!-- Modal que muestra la unidad de medida al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifiCiudad" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar Ciudad </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                 
                        <!-- aqui va el mensaje que se pasa por parametro-->
                      <div class="modal-body mx-3">
                                <input   type="text" value ="" placeholder="Nombre Unidad" class="form-control ciudadEdit" id="ciudadEdit" name ="ciudadEdit" required>  
                    </div>     
                      <div class="modal-body mx-3">       
                      <select class="form-control" onChange="mostrar(this.value);" id ="selePais2" name="selePais2"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($resultSelect);$i++){?>
                               <option value="<?php echo $resultSelect[$i]["idpais"]; ?>"><?php echo $resultSelect[$i]["nombrePais"]; ?></option> 
                               <?php }?> 
                       </select>
                                             
                    <input   style="visibility: hidden;" type="text" value ="" placeholder="ID" class="form-control idciudad" id="idciudad" name ="idciudad"> 
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