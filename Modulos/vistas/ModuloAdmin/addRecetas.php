
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
                
                <!-- Inicio mostrar la lista de las recetas existentes se muestra con ajax-->
                 <ul class="listaRecetasView" id="listaRecetasView" > 
                    
                 </ul>
                  <ul class="descripcionRecetasView" id="descripcionRecetasView" > 
                    
                 </ul>
                 <!-- Fin mostrar la lista de las recetas existentes -->

         </div> <!-- Fin container -->
     </div> <!-- Fin container-fluid -->

</div>






<!-- Modal para agregar nueva  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" novalidate>
        <div class="modal fade" id="modaddReceta" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                  <div class="modal-dialog">
                           <div class="modal-content">
                                         <div class="modal-header " style ="background-color: #D0A20E;color:#FFFFFF; >
                                                    <h5  id="staticBackdropLabel"> Agregar Receta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                         </div>
                                         <div class="modal-body mx-3">
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
                                                        <input   type="text" class="form-control" id="nameReceta" name ="nameReceta" placeholder="Nombre de Receta" required>  
                                                  </div>


                                                  <div class="modal-body">                       
                                                        <input   type="text" class="form-control" id="timeReceta" name ="timeReceta" placeholder="Tiempo en minutos de preparacion" required>  
                                                  </div>
                                                  <div class="modal-body">                       
                                                        <input   type="text" class="form-control" id="porcionesReceta" name ="porcionesReceta" placeholder="Porciones" required>  
                                                  </div>
                                                  <div class="modal-body">                       
                                                        <textarea class="form-control" id="contenidoReceta" name="contenidoReceta" rows="3" placeholder="Contenido de la receta" required></textarea>
                                                  </div>
                                                  <div class="md-form mb-4 custom-file">
                                                         <input type="file" class="custom-file-input" id="imgReceta" name="imgReceta" lang="es"  >
                                                         <label class="custom-file-label" for="customFileLang">Seleccione Imagen Receta</label>
                                                  </div>
                                                  <div class="md-form mb-4 custom-file">
                                                         <input type="file" class="custom-file-input" id="videoReceta" name="videoReceta" lang="es"  >
                                                         <label class="custom-file-label" for="customFileLang">Seleccione Video Receta</label>
                                                  </div>
                                            </div>

                                         <div class="form-group">  
                                               <div class="modal-footer">         
                                                     <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>                                                                 
                                                     <a onclick="return validarDataFormulario();" style ="width:48%;" name = "btnaddReceta" id = "btnaddReceta"  class="btn btn-success colorbotonamarillo "><i class="fa fa-plus-circle" aria-hidden="true"></i> <span id = "1" class="">Agregar recetas</span></a>
                                                </div>
                                         </div>
                            </div>
                  </div>   
        </div>
  </form>

  <!-- Modal para editar receta  -->
  <form class="form needs-validation" name = "modaleDeEditar" method="post"  enctype="multipart/form-data" novalidate>
        <div class="modal fade" id="moduppReceta" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                  <div class="modal-dialog">
                           <div class="modal-content">
                                         <div class="modal-header " style ="background-color: #D0A20E;color:#FFFFFF; >
                                                    <h5  id="staticBackdropLabel"> Editar Receta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                         </div>
                                         <div class="modal-body mx-3">
                                                  <div class="modal-body">
                                                           <select class="form-control"  id ="dificultadRecetaUpdate" name="dificultadRecetaUpdate"  required><option value = "seleccion">Seleccione Dificultad</option>
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
                                                           <select class="form-control"  id ="categoriaRecetaUpdate" name="categoriaRecetaUpdate"  required><option value = "seleccion">Seleccione Categor&iacute;a</option>
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
                                                        <input   type="text" class="form-control" id="nameRecetaUpdate" name ="nameRecetaUpdate" value = "" placeholder="Nombre de Receta" required>  
                                                  </div>

                                                  <div class="modal-body">                       
                                                        <input   type="text" class="form-control" id="timeRecetaUpdate" name ="timeRecetaUpdate" placeholder="Tiempo en minutos de preparacion" required>  
                                                  </div>
                                                  <div class="modal-body">                       
                                                        <input   type="text" class="form-control" id="porcionesRecetaUpdate" name ="porcionesRecetaUpdate" placeholder="Porciones" required>  
                                                  </div>
                                                  <div class="modal-body">                       
                                                        <textarea class="form-control" id="contenidoRecetaUpdate" name="contenidoRecetaUpdate" rows="3" placeholder="Contenido de la receta" required></textarea>
                                                  </div>
                                                 
                                            </div>

                                         <div class="form-group">  
                                               <div class="modal-footer">         
                                                     <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>                                                                 
                                                     <a onclick="return modalExtra();" style ="width:48%;" name = "btneditReceta" id = "btneditReceta"  class="btn btn-success colorbotonamarillo "><i class="fa fa-plus-circle" aria-hidden="true"></i> <span id = "1" class="">Editar receta</span></a>
                                                </div>
                                         </div>
                            </div>
                  </div>   
        </div>
  </form>



<!-- Modal para agregar productos a receta  -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" novalidate>
        <div class="modal fade" id="modaddProductReceta" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                  <div class="modal-dialog modal-lg">
                           <div class="modal-content">
                                         <div class="modal-header " style ="background-color: #D0A20E;color:#FFFFFF; >
                                                    <h5  id="staticBackdropLabel"> Agregar productos a receta</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                         </div>
                                         <div class="modal-body ">
                                                    <ul class="listaProductXReceta" id="listaProductXReceta" > 
                    
                                                    </ul>  
                                                    <ul class="listaProductAddXReceta" id="listaProductAddXReceta" > 
                                                       
                                                    </ul> 
                                         </div>

                                         <div class="form-group">  
                                               <div class="modal-footer">         
                                                     <button type="submit" class="btn btn-secondary " style ="width:100%;"data-dismiss="modal">Salir</button>                                                                 
                                                     
                                                </div>
                                         </div>
                            </div>
                  </div>   
        </div>
  </form>


  <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarReceta" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la receta? </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="button" onclick="aceptarDeletteReceta()" name = "btneliminarReceta" id = "btneliminarReceta" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 