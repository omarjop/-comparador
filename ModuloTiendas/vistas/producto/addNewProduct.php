




  <div class="container">
  <div class="abs-center">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form" method="post">
                    

                    

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-58">
                                <input id="fname" name="name" type="text" placeholder="Nombre producto" class="form-control">
                            </div>
                        </div>

                    <div class="form-group">
                    <span class="col-md-1 col-md-offset-2 text-center"></span>
                    <div class="col-md-58">
                        <select class="form-control">
                          <option>Seleccione Peso/Volumen</option>
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
                                <input id="lname" name="name" type="text" placeholder="Precio" class="form-control">
                            </div>
                        </div>

                        




                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                            <div class="col-md-5">
                                <input id="phone" name="phone" type="text" placeholder="Cantidad inventario" class="form-control">
                            </div>
                        </div>





                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-left"></span>
                            <div class="col-md-100">
                                <textarea class="form-control" id="message" name="message" placeholder="Breve descripcion del producto" rows="7"></textarea>
                            </div>
                        </div>



                        <div class="form-group ">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class="btn btn-primary btn-lg colorbotonverde" name="guardar">Guardar</button>
                            </div>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>

</div>


 <?php
      if(isset($_POST['guardar'])){
         echo "funciona";
      }
  ?>