




  <div class="container">
  <div class="abs-center">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form needs-validation" method="post" novalidate>
                    

                    

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-58">
                                <input id="fname" name="name" type="text" placeholder="Nombre producto" class="form-control" required>
                                <div  class="invalid-tooltip">
                                    Please provide a valid city.
                                 </div>
                            </div>
                        </div>



                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-58">
                                <input id="lname" name="name" type="text" placeholder="Precio" class="form-control">
                        </div>

                        </div>
                    <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"></span>
                        <div class="col-md-58">
                            <select class="form-control">
                                  <option class="form-control">Seleccione Peso/Volumen</option>
                                  <option>gramos (gr)</option>
                                  <option>kilogramos (kg)</option>
                                  <option>mililitros (ml)</option>
                                  <option>centimetros cubicos (cm3)</option>
                            </select>
                        </div>
                     </div>


                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-58">
                                <input id="lname" name="name" type="text" placeholder="Referencia" class="form-control">
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>                            
                                <input id="lname" name="name" type="text" placeholder="Marca" class="form-control">
                        </div>

                         <div class="form-group">
                           <span class="col-md-1 col-md-offset-2 text-center"></span>
                        <div class="col-md-58">
                            <select class="form-control">
                                  <option class="form-control">Categoria</option>
                                  <option>Despensa</option>
                                  <option>Bebidas</option>
                                  <option>Vinos y Licores</option>
                                  <option>Pollo, carnes y pescado</option>
                                  <option>Pasabocas y dulces</option>
                            </select>
                        </div>
                     </div>


                     <div class="custom-file">
                      <input type="file" class="custom-file-input" id="customFileLangHTML">
                      <label class="custom-file-label" for="customFileLangHTML" data-browse="Seleccionar">Seleccione imagen del producto</label>
                    </div>


                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-left"></span>
                            <div class="col-md-100">
                                <textarea class="form-control" id="message" name="message" placeholder="Breve descripcion del producto" rows="7"></textarea>
                            </div>
                        </div>



                        <div class="form-group ">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class="btn btn-primary btn-lg colorbotonamarillo" name="guardar">Guardar</button>
                            </div>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>

</div>


 <?php
      if(isset($_POST['guardar'])){
         //echo "funciona";
      }
  ?>