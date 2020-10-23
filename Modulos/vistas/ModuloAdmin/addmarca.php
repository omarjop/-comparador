

<?php 
$resultado=null;


  //--Boton del modal de agregar marca, crea objeto de la clase controlador
if(isset($_POST["btnaddmarca"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorMarca = $_POST["addmarcas"]; 
     $objAdminAgregar->agregarCampos("marca","Descripcion",$valorMarca);
                       
    } 

//--Boton del modal de eliminar marca, crea objeto de la clase controlador
if(isset($_POST["btnEliminarMarca"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorMarca = $_POST["campoOculto2"];  
     $objConsultaMarca= new ControladorAdminSelect();
     $resultadoConsulta= $objConsultaMarca->consultaPrevia($valorMarca,'producto','Marca_idMarca');
     
     if($resultadoConsulta==null){
       
        $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorMarca,"marca","idMarca");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Marca eliminada exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar marca, por favor intente nuevamente);</script>";                             
         }                 
     }else{

          echo "<script>toastr.error('La marca tiene productos asociados no se puede eliminar');</script>"; 
     }

        
    } 

 //--Boton del modal de editar marca, crea objeto de la clase controlador
if(isset($_POST["btnEditarMarca"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idMarkModif = $_POST["idMarca"];
     $valorMarca = $_POST["marcaEdit"];  
     $resultadoModificar=$objAdminModificar->modificarCampo("marca","idMarca","Descripcion",$valorMarca,$idMarkModif);
                                                                                                            
      
        
    } 
//-- Al entrar se visualizan todas las marcas existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("marca");

//--Boton lupa consulta marca

if(isset($_POST["lupamarca"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorMarca = $_POST["buscamarcas"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorMarca,"marca","*","Descripcion");;
       
             if ($resultado==null){
               echo "<script>toastr.warning('La marca no existe');</script>"; 
             }
    } 

?>

<script type="text/javascript">
/*Validación del campo de texto de agregar marca*/
  function validarFormulario(formulario){
       var marca = formulario.addmarcas.value;
        if(validarNombreAndMarca(marca,"No es una marca v&aacute;lida","addmarcas")==true){
             
           if(validarMarcaAndRango(marca,"El nombre de la marca es muy extenso","addmarcas")!=true){
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
 function validarNombreAndMarca(valor,mensaje,campoForm){
      
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
      
         if ((valor.length) > 20){
              
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
            <h1 class="m-0 text-dark">Administraci&oacute;n Marca</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddmarca colorbotonamarillo" >Agregar Marca</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscadormarca">
                        <input type="search" name="buscamarcas" id="buscamarcas" class="form-control"  placeholder="Buscar Marca">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupamarca" type="submit" name="lupamarca" id="lupamarca" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["Descripcion"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span marca = "<?php echo $resultado[$i]["Descripcion"];?>" id ="<?php echo $resultado[$i]["idMarca"];?>" class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["Descripcion"];?>" id = "<?php echo $resultado[$i]["idMarca"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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

/*LLama el modal de adicionar marca*/ 
 $(function(){
     $(".botaddmarca").click(function(){
         $("#modaddmarca").modal("show");  
      });
  });

  /*LLama el modal de editar marca*/ 
 $(function(){
     $(".editar").click(function(){
         $(".idMarca").attr('value',$(this).attr('id'));
         $(".marcaEdit").attr('value',$(this).attr('marca'));
         $("#modifiMarca").modal("show");
         
      });
  });

  /*LLama el modal de eliminar marca*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarmarca").modal("show");  
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



  <!-- Modal que muestra el confirmar cuando se elimina una marca -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarmarca" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la marca? </h5>
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
                                <button type="submit" name = "btnEliminarMarca" id = "btnEliminarMarca" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 


  <!-- Modal que muestra producto al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modifiMarca" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar Marca </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                        <div class="row">
                            <div class="col-sm-2">
                                <h5 class="colortextoformulariosetiquetas">Marca</h5>
                            </div>
                            <div class="col-sm-10">
                                <input   type="text" value ="" placeholder="Nombre Marca" class="form-control marcaEdit" id="marcaEdit" name ="marcaEdit" required>  
                             </div>
                        </div>
                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID Marca" class="form-control idMarca" id="idMarca" name ="idMarca">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarMarca" id = "btnEditarMarca" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Editar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
