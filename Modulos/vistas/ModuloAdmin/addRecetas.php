
<div class="content-wrapper">
     <div class="container-fluid">
         <div class="container">
             <div class="row mb-2">
                  <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Administraci&oacute;n Recetas</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                      <button type="button" class="btn btn-warning botonAddReceta colorbotonamarillo" >Agregar Recetas 
                        </button>
                    </ol>
                  </div>
             </div>  <!-- Fin row -->
                
                 <ul class="listaRecetasView" style=""> 
                    <div class="col-lg-9 col-md-9 col-sm-10 col-xs-12" id=""> <!-- Inicio mostrar recetas -->
                           <?php
                           $resultado = ControladorAdminInsert::ctrlMostrarRecetas();

                               if ($resultado!= null){
                                     foreach ($resultado as $key => $value) {            
         
        
                                        echo' 
                                                <div >    
                                                      <ul class="list-group list-group-flush" >
                                                        <div class="row justify-content-center" >
                                                                 <div class="col-11">
                                                                      <li class="list-group-item list-group-item-light">'.$value["nombreReceta"].'
                                                                          <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span recetas = "'.$value["nombreReceta"].'" id ="'.$value["idRecetas"].'" iddificultad="'.$value["dificultad_iddificultad"].'"class="fas fa-pen-alt editar"></span></p>
                                                                          <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "'.$value["nombreReceta"].'" id = "'.$value["idRecetas"].'" class="far fa-trash-alt eliminar"></span></p></a>   
                                                                      </li>
                                                                 </div>
                                                        </div>
                                                    </ul>
                                                </div>';
       
                                     } 
                               }?> 
                    </div><!-- Fin mostrar recetas -->
                 </ul>

         </div> <!-- Fin container -->
     </div> <!-- Fin container-fluid -->

</div>






<!-- Modal para agregar nueva  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddReceta" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                  <div class="modal-dialog">
                           <div class="modal-content">
                                         <div class="modal-header " style ="background-color: #D0A20E;color:#FFFFFF; >
                                                    <h5  id="staticBackdropLabel"> Agregar Receta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                         </div>

                                                  <div class="modal-body">
                                                           <select class="form-control"  id ="dificultadReceta" name="dificultadReceta"  required><option value = "seleccion">Seleccione Dificultad</option>
                                                                   <?php 
                                                                            $resultadoDificultad = ControladorAdminSelect::ctrlConsultaDificultad();
                                                                            if($resultadoDificultad!=null){
                                                                            foreach ($resultadoDificultad as $key => $value) {                                                                   
                                                                   ?>
                                                                   <option value="<?php echo $value['iddificultad']; ?>"><?php echo $value['nombre']; ?></option> 
                                                                   <?php }}?> 
                                                           </select>
                                                  </div>
                                                  <div class="modal-body">
                                                           <select class="form-control"  id ="categoriaReceta" name="categoriaReceta"  required><option value = "seleccion">Seleccione Categor&iacute;a</option>
                                                                   <?php 
                                                                            $resultadoCategoria = ControladorAdminSelect::ctrlConsultaCategoriaReceta();
                                                                            if($resultadoCategoria!=null){
                                                                            foreach ($resultadoCategoria as $key => $value) {                                                                   
                                                                   ?>
                                                                   <option value="<?php echo $value['idCategoria']; ?>"><?php echo $value['nombre']; ?></option> 
                                                                   <?php }}?> 
                                                           </select>
                                                  </div>

                                                  <div class="modal-body">                       
                                                        <input   type="text" class="form-control" id="timeReceta" name ="timeReceta" placeholder="Tiempo en minutos de preparacion">  
                                                  </div>
                                                  <div class="modal-body">                       
                                                        <input   type="text" class="form-control" id="porcionesReceta" name ="porcionesReceta" placeholder="Porciones">  
                                                  </div>
                                                  <div class="modal-body">                       
                                                        <textarea class="form-control" id="contenidoReceta" name="contenidoReceta" rows="3" placeholder="Contenido de la receta"></textarea>
                                                  </div>


                                         <div class="form-group">  
                                               <div class="modal-footer">         
                                                     <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                                     <button type="submit" name = "btnaddCategoria" id = "btnaddCategoria" class="btn btn-secondary colorbotonamarillo"  onclick="window.location.href="addCategorias" style ="width:48%;">Agregar</button>
                                                </div>
                                         </div>
                            </div>
                  </div>   
        </div>
  </form>