<?php 
$resultado=null;
 $result = ControladorSelectsInTables:: selectTodosRegistros("perfil");
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
              <button type="button" class="btn btn-warning botaddusuario colorbotonamarillo" >Agregar Personas</button>
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
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span ciudad = "<?php echo $resultado[$i]["Nombres"];?>" id ="<?php echo $resultado[$i]["idPerfil"];?>" idPerfil="<?php echo $resultado[$i]["Perfil_idPerfil"];?>"class="fas fa-pen-alt editar"></span></p>
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["Nombres"];?>" id = "<?php echo $resultado[$i]["idPerfil"];?>" class="far fa-trash-alt eliminar"></span></p></a>      
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