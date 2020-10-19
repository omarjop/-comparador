
<?php 
$resultado=null;

  //--Boton del modal de agregar unidad, crea objeto de la clase controlador
if(isset($_POST["btnaddunidad"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorUnidad = $_POST["addunidad"]; 
    $valorControl= $_POST["selecontrol"];
     
     $objAdminAgregar->agregarCamposUnid("unidadmedida","nombreMedida",$valorUnidad,"control",$valorControl);
                       

//-- Al entrar se visualizan todas las marcas existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAllMarca();

  //--Boton del modal de agregar marca, crea objeto de la clase controlador
if(isset($_POST["btnaddmarca"])){                           
            $objAdminAgregar  = new ControladorAdminInsert();
            $valorMarca = $_POST["addmarcas"]; 

               $objAdminAgregar->agregaMarca($valorMarca);
           
            

    } 
//--Boton lupa consulta marca

if(isset($_POST["lupamarca"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorMarca = $_POST["buscamarcas"]; 
            $resultado=$objAdminSelecciona->buscaMarca($valorMarca);
       
             if ($resultado==null){
               echo "<script>toastr.warning('La marca no existe');</script>"; 
             }
    } 
?>

<script type="text/javascript">

  function validarFormulario(formulario){
       var marca = formulario.addmarcas.value;
        if(validarNombreAndMarca(marca,"No es una marca v&aacute;lida","addmarcas")!=true){
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
              <button type="button" class="btn btn-warning botaddmarca colorbotonamarillo" >Agregar Unidad</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscadormarca">
                        <input type="search" name="buscamarcas" id="buscamarcas" class="form-control"  placeholder="Buscar Marca">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupamarca" type="submit" name="lupamarca" id="lupamarca">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["Descripcion"];?>
                  <p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span precio = "" id = "" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span id = "" class="far fa-trash-alt eliminar"></span></p></a>      
              </li>

            </ul>
       <?php } }?> 
        </div><!-- /.row -->
<<<<<<< HEAD
    </div><!-- /.container-fluid -->


=======
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
>>>>>>> 384f28666cdbd1390daedc2e5d2b581792129794
<script type="text/javascript">

/*LLama el modal de adicionar marca*/ 
 $(function(){
     $(".botaddmarca").click(function(){
<<<<<<< HEAD
         $("#modaddunidad").modal("show");  
      });
 });
  /*LLama el modal de editar marca*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idunidadMedida").attr('value',$(this).attr('id'));
         $(".unidadEdit").attr('value',$(this).attr('unidmedida'));
         //$("#controlEdit").attr('value',$(this).attr('idcontrol'));
        // document.getElementById("controlEdit").value=$(this).attr('idcontrol');
      
         $("#modifiUnidad").modal("show");
         document.getElementById("controlEdit").value=$(this).attr('idcontrol');
         
      });
  });    
  $(function(){
    $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarunidad").modal("show");  

         $("#modaddmarca").modal("show");  

      });
  });

</script>

  <!-- Modal para agregar nueva marca -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddmarca" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar Marca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addmarcas" name ="addmarcas" placeholder="Agregue nombre de marca" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddmarca" id = "btnaddmarca" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>

<<<<<<< HEAD
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
                       

                    <div class="form-group-inline col-md-8">
                   
                     <div class="col-md-6 col-lg-10">
                      <select class="form-control" onChange="mostrar(this.value);" id ="controlEdit" name="controlEdit"  required><option value = "seleccion">Seleccione Control</option>
                               <?php for($i=0;$i<count($controlNumerico);$i++){?>
                               <option value="<?php echo $controlNumerico[$i]; ?>"><?php echo $controlCaracter[$i]; ?></option> 
                               <?php }?> 
                       </select>
                      </div>
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

