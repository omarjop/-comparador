
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Recetas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddRecetas colorbotonamarillo" >Agregar recetas</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-6 col-md-7 col-sm-9 col-xs-8" id="buscadorrecetas">
                        <input type="search" name="buscarecetass" id="buscarecetass" class="form-control"  placeholder="Buscar recetas">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo luparecetas" type="submit" name="luparecetas" id="luparecetas" style ="height:100%;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
              </div>
             </form>
              </div>
          </div><!-- /.col -->

       <?php
       $resultado = ControladorAdminInsert::ctrlMostrarRecetas();

           if ($resultado!= null){
                 foreach ($resultado as $key => $value) {            
         
        
                    echo'    <ul class="list-group list-group-flush">
                            <div class="row justify-content-center">
                                     <div class="col-11">
                                          <li class="list-group-item list-group-item-light">'.$value["nombreReceta"].'
                                              <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span recetas = "'.$value["nombreReceta"].'" id ="'.$value["idRecetas"].'" iddificultad="'.$value["dificultad_iddificultad"].'"class="fas fa-pen-alt editar"></span></p>
                                              <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "'.$value["nombreReceta"].'" id = "'.$value["idRecetas"].'" class="far fa-trash-alt eliminar"></span></p></a>   
                                          </li>
                                     </div>
                            </div>
                        </ul>';
       
                 } 
           }?> 
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
