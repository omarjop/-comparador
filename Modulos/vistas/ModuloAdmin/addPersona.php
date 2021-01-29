<?php 
$resultado=null;
 $resultadoPerfil = ControladorSelectsInTables:: selectTodosRegistros("perfil");
 $resultadoCiudad = ControladorSelectsInTables:: selectTodosRegistros("ciudad");
 $resultadoPais= ControladorSelectsInTables:: selectTodosRegistros("pais");
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("persona");

if(isset($_POST["lupapersona"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorpersona = $_POST["buscapersona"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorpersona,"persona","*","Nombres");
       
             if ($resultado==null){
               echo "<script>toastr.warning('La persona no existe');</script>"; 
             }
    } 

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Personas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">



                <a href="" class="btn btn-default btn-rounded colorbotonamarillo" data-toggle="modal" data-target="#modaddpersona" >
                Agregar Persona</a>

            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-6 col-md-7 col-sm-9 col-xs-8" id="buscadorpersona">
                        <input type="search" name="buscapersona" id="buscapersona" class="form-control"  placeholder="Buscar persona">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupapersona" type="submit" name="lupapersona" id="lupapersona" style ="height:100%;">
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
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["Nombres"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span ciudad = "<?php echo $resultado[$i]["Nombres"];?>" id ="<?php echo $resultado[$i]["idPersona"];?>" idPerfil="<?php echo $resultado[$i]["Usuario_idUsuario"];?>"class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["Nombres"];?>" id = "<?php echo $resultado[$i]["idPersona"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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



<!-- Modal para agregar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return registrousuarioadmin(this);"novalidate>
        <div class="modal fade" id="modaddpersona" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar Persona</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addCorreoPersona" name ="addCorreoPersona" placeholder="Agregar correo" required>  

                   </div>
                   <div class="modal-body">
                      <input   type="password" class="form-control" id="addNomPersona" name ="addNomPersona" placeholder="Agregar Nombre" required>
                   </div>
                   <div class="modal-body">
                      <input   type="password" class="form-control" id="addApePersona" name ="addApePersona" placeholder="Agregar Apellido" required>
                   </div> 
                   <div class="modal-body">
                      <input   type="password" class="form-control" id="addNumTelf" name ="addNumTelf" placeholder="Agregar Telefono" required>
                   </div>   
                   <div class="modal-body">
                      <input   type="password" class="form-control" id="addDirPersona" name ="addDirPersona" placeholder="Agregar Dirección" required>
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrarCiudadPais(this.value,'selectciudadper');" id ="selectPaisPersona" name="selectPaisPersona"  required><option value = "seleccion">Seleccione Pais</option>
                               <?php for($i=0;$i<count($resultadoPais);$i++){?>
                               <option value="<?php echo $resultadoPais[$i]["idpais"]; ?>"><?php echo $resultadoPais[$i]["nombrePais"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>                                                        
                    <div class="modal-body"  id= "ciudadPersona">                                      
                      <select class="form-control" name="selectciudadper" id ="    selectciudadper" required> 
                          <option value='seleccione'>Seleccione Ciudad</option> 
                      </select>
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selectPerfilPersona" name="selectPerfil"  required><option value = "seleccion">Seleccione Perfil</option>
                               <?php for($i=0;$i<count($resultadoPerfil);$i++){?>
                               <option value="<?php echo $resultadoPerfil[$i]["idPerfil"]; ?>"><?php echo $resultadoPerfil[$i]["Descripcion"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddPersona" id = "btnaddPersona" class="btn btn-primary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>