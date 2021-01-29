
<?php 
$resultado=null;
 $result = ControladorSelectsInTables:: selectTodosRegistros("perfil");


  //--Boton del modal de agregar unidad, crea objeto de la clase Perfil_idPerfilador
if(isset($_POST["btnaddusuario"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorusuario = $_POST["addusuario"]; 
    $valorCategoria= $_POST["selectPerfil"];
    $valorclave=str_replace(' ', '', $valorusuario);
    /*$objAdminAgregar->agregarCamposusuario("usuario","Perfil_idPerfil",$valorCategoria,"correo",$valorusuario,"clave",$valorclave);*/
   }  

//--Boton del modal de eliminar , crea objeto de la clase Perfil_idPerfilador
if(isset($_POST["btneliminarUsu"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorUnidElim = $_POST["campoOculto2"]; 
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorUnidElim,"usuario","idUsuario");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Usuario eliminado exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar Usuario, por favor intente nuevamente);</script>";                             
         }    
    
    } 
 //--Boton del modal de editar, crea objeto de la clase Perfil_idPerfilador
if(isset($_POST["btnEditarusuario"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idUsuarioModif = $_POST["idUsuario"];
     $valorusuarios = $_POST["usuarioEdit"];  
     $valorCategoriaEdit = $_POST["selectPerfil2"]; 
     $resultadoModificar=$objAdminModificar->modifDosCampos("usuario","idUsuario","correo",$valorusuarios,$idUsuarioModif,"Perfil_idPerfil",$valorCategoriaEdit);
                                                                                                            
      
        
    }                      

//-- Al entrar se visualizan todas las unidades existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("usuario");

  
//--Boton lupa consulta unidad

if(isset($_POST["lupaUsuario"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorusuario = $_POST["buscaUsuario"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorusuario,"usuario","*","correo");
       
             if ($resultado==null){
               echo "<script>toastr.warning('Usuario no existe');</script>"; 
             }
    } 
?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Usuarios</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              

                  <a href="" class="btn btn-default btn-rounded colorbotonamarillo" data-toggle="modal" data-target="#modaddusuarios" >
                                Agregar Usuario</a>

            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8 " id="buscadormarca"  >
                        <input type="search" name="buscaUsuario" id="buscaUsuario" class="form-control"  placeholder="Buscar Usuario"  style ="height:500%;>
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaUsuario" type="submit" name="lupaUsuario" id="lupaUsuario" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["correo"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span nombusuario = "<?php echo $resultado[$i]["correo"];?>" id = "<?php echo $resultado[$i]["idUsuario"];?>" idcategoria ="<?php echo $resultado[$i]["Perfil_idPerfil"];?>" class="fas fa-pen-alt editar"></span></p></a> 
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["correo"];?>" id = "<?php echo $resultado[$i]["idUsuario"];?>" class="far fa-trash-alt eliminar"></span></p></a>          
              </li>

            </ul>
       <?php  } }?> 
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->



      </div><!-- /.container-fluid -->
    </div>

      <!-- Perfil_idPerfil Sidebar -->
  <aside class="Perfil_idPerfil-sidebar Perfil_idPerfil-sidebar-dark">
    <!-- Perfil_idPerfil sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
  
</div>


  <!-- Modal para agregar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return registrousuarioadmin(this);"novalidate>
        <div class="modal fade" id="modaddusuarios" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addusuario" name ="addusuario" placeholder="Agregar correo usuario" required>  

                   </div>
                   <div class="modal-body">
                      <input   type="password" class="form-control" id="addPassusuario" name ="addPassusuario" placeholder="Agregar contraseña" required>
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selectPerfil" name="selectPerfil"  required><option value = "seleccion">Seleccione Perfil</option>
                               <?php for($i=0;$i<count($result);$i++){?>
                               <option value="<?php echo $result[$i]["idPerfil"]; ?>"><?php echo $result[$i]["Descripcion"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddusuario" id = "btnaddusuario" class="btn btn-primary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>



 <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarCateg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar el Usuario? </h5>
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
                     <input  style="visibility: hidden;" type="text" value ="" class="campoOculto form-Perfil_idPerfil" id="campoOculto2" name ="campoOculto2">               
                       
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btneliminarUsu" id = "btneliminarUsu" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 

    <!-- Modal que muestra la unidad de medida al dar click en el boton de editar -->


  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifiusuario" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar Usuario </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body mx-3">
                        <!-- aqui va el mensaje que se pasa por parametro-->
                            <div class="modal-body mx-3 ">
                                <input   type="text" value ="" placeholder="correo ciudad" class="form-control usuarioEdit" id="usuarioEdit" name ="usuarioEdit" required>  
                             </div>
                        </div>
                      <div class="modal-body mx-3">  
                       <div class="modal-body mx-3">      
                      <select class="form-control" onChange="mostrar(this.value);" id ="selectPerfil2" name="selectPerfil2"  required><option value = "seleccion">Seleccione Perfil</option>
                               <?php for($i=0;$i<count($result);$i++){?>
                               <option value="<?php echo $result[$i]["idPerfil"];?>"><?php echo $result[$i]["Descripcion"]; ?></option> 
                               <?php }?> 
                       </select>                        
                        <input   style="visibility: hidden;" type="text" value ="" placeholder="ID usuario" class="form-control idUsuario" id="idUsuario" name ="idUsuario">  
                   </div>
                   </div>
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarusuario" id = "btnEditarusuario" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>

