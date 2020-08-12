

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    function mostrar(id) {

        var unidades = ["gramos","kilogramos","mililitros"];
        unidades.forEach(function(valor) {
                if(valor == id){
                   $("#".concat(valor)).show();               
			    }else{
                    $("#".concat(valor)).hide();  
               }
        });

    }
</script>


<!------------------------------------------------------------------------------------------------------------------------>
  <div class="container">
  <div class="abs-center">
    <div class="row">

                <form class="form needs-validation" method="post" novalidate>
                    

                    

                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                <div class="col-md-58">
                                                    <input id="fname" name="name" type="text" placeholder="Nombre producto" class="form-control" required>
                                                      <div class="valid-tooltip">
                                                        Looks good!
                                                      </div>
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                <div class="col-md-58">
                                                    <input id="lname" name="name" type="text" placeholder="Precio" class="form-control">
                                            </div>

                                            <div class="form-group">
                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                            <div class="col-md-58">
                                                <select class="form-control" onChange="mostrar(this.value);">
                                                      <option class="form-control">Seleccione Peso/Volumen</option>
                                                      <option value="gramos">gramos (gr)</option>
                                                      <option value="kilogramos">kilogramos (kg)</option>
                                                      <option value="mililitros">mililitros (ml)</option>
                                                      <option>centimetros cubicos (cm3)</option>
                                                </select>
                                            </div>
                                         </div>
                                         
                                                            
                                                                         <div class="form-group"  id= "gramos">
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control">                                                                                      
                                                                                      <option>1,5</option>
                                                                                      <option>10</option>
                                                                                      <option>20</option>
                                                                                      <option>25</option>
                                                                                      <option>50</option>
                                                                                      <option>75</option>
                                                                                      <option>100</option>
                                                                                      <option>125</option>
                                                                                      <option>200</option>
                                                                                      <option>250</option>
                                                                                      <option>300</option>                                                                                      
                                                                                      <option>500</option>
                                                                                      <option>450</option>                                                                                      
                                                                                </select>
                                                                            </div>
                                                                         </div>

                                                                                                                                     
                                                                         <div class="form-group" id= "kilogramos">
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control">                                                                                      
                                                                                      <option>1</option>
                                                                                      <option>2</option>
                                                                                      <option>2.5</option>
                                                                                      <option>3</option>
                                                                                      <option>4</option>
                                                                                      <option>5</option>
                                                                                      <option>5</option>
                                                                                      <option>10</option>
                                                                                      <option>12</option>
                                                                                      <option>15</option>
                                                                                      <option>20</option>                                                                                                                                                                                                                                                                 
                                                                                </select>
                                                                            </div>
                                                                         </div>

                                                                         <div class="form-group" id= "mililitros">
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control">                                                                                      
                                                                                      <option>100</option>
                                                                                      <option>125</option>
                                                                                      <option>150</option>
                                                                                      <option>200</option>
                                                                                      <option>250</option>
                                                                                      <option>300</option>
                                                                                      <option>500</option>
                                                                                      <option>1000</option>
                                                                                      <option>1500</option>
                                                                                      <option>2000</option>
                                                                                      <option>2500</option>                                                                                      
                                                                                      <option>3000</option>
                                                                                      <option>4000</option> 
                                                                                      <option>5000</option> 
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


 <?php
      if(isset($_POST['guardar'])){
         //echo "funciona";
      }
  ?>