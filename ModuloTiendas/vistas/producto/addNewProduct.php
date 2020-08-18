

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    function mostrar(id) {

        var unidades = ["gramos","kilogramos","mililitros","centimetros"];
        unidades.forEach(function(valor) {
                if(valor == id){
                   $("#".concat(valor)).show();               
			    }else{
                    $("#".concat(valor)).hide();  
               }
        });

    }

     function mostrarNuevaCategoria(id) {

         var nombres = id.split("-");
        var unidades = ["Otros"];
        unidades.forEach(function(valor) {
                if(valor == nombres[1]){
                   $("#".concat("NewCategory")).show();               
			    }else{
                    $("#".concat("NewCategory")).hide();  
               }
        });

         // $("#".concat("NewCategory")).hide();  

    }

</script>
<?php 


/*Funcion que retorna la primera palabra de las unidades en pesos para poder de value en el campo select recibe parametro el vector*/
     function returnValues($arreglo){

          $values = array();
          for($i=0;$i<count($arreglo);$i++){
             $aux = explode(" ", $arreglo[$i]);   
             array_push($values, $aux[0]);
             
		  }

          return $values;
     
	 }
     
     $objEstuctura =  new ControladorEstructuras();
     $valorUnidades = $objEstuctura->unidadesProductos();
     $values = returnValues($valorUnidades);

     $gramos = $objEstuctura->unidadesProductosValues("gramos");
     $kilogramos = $objEstuctura->unidadesProductosValues("kilogramos");
     $mililitros = $objEstuctura->unidadesProductosValues("mililitros");
     $centimetros = $objEstuctura->unidadesProductosValues("centimetros");

     $objSelect =  new ControladorSelectsInTables();
     $resultSelect = $objSelect->returnSelectAllRows("subcategoria");
     //echo $objTiendaInicial->getNombreEmpresa();


?>


<!------------------------------------------------------------------------------------------------------------------------>
  <div class="container">
  <div class="abs-center">
    <div class="row">

                <form class="form needs-validation" method="post"  enctype="multipart/form-data">
                    

                    

                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                <div class="col-md-58">
                                                    <input id="validationServer03" name="nameProduct" type="text" placeholder="Nombre producto" class="form-control"  required oninput="check_text(this);">
                                                </div>
                                            </div>



                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                <div class="col-md-58">
                                                    <input id="lname" name="price" type="text" placeholder="Precio" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                            <div class="col-md-58">
                                             
                                                <select class="form-control" onChange="mostrar(this.value);" name="unit">
                                                      <option value = "seleccion">Seleccione Peso/Volumen</option>
                                                       <?php for($i=0;$i<count($valorUnidades);$i++){?>
                                                            <option value='<?php echo $values[$i];?>'><?php echo $valorUnidades[$i];?></option>
                                                       <?php }?>
                                                </select>
                                            </div>
                                         </div>
                                         
                                                            
                                                                         <div class="form-group"  id= "gramos" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="grams">  
                                                                                     <?php for($i=0;$i<count($gramos);$i++){?>
                                                                                        <option value='<?php echo $gramos[$i];?>'><?php echo $gramos[$i];?></option>  
                                                                                     <?php }?>
                                                                                </select>
                                                                            </div>
                                                                         </div>

                                                                                                                                     
                                                                         <div class="form-group" id= "kilogramos" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="kilograms">                                                                                      
                                                                                     <?php for($i=0;$i<count($kilogramos);$i++){?>
                                                                                        <option value='<?php echo $kilogramos[$i];?>'><?php echo $kilogramos[$i];?></option>  
                                                                                     <?php }?>                                                                                                                                                                                                                                                                
                                                                                </select>
                                                                            </div>
                                                                         </div>

                                                                         <div class="form-group" id= "mililitros" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="milliliters">                                                                                      
                                                                                     <?php for($i=0;$i<count($mililitros);$i++){?>
                                                                                        <option value='<?php echo $mililitros[$i];?>'><?php echo $mililitros[$i];?></option>  
                                                                                     <?php }?>  
                                                                                </select>
                                                                            </div>
                                                                         </div>



                                                                         <div class="form-group" id= "centimetros" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="centimeters">                                                                                      
                                                                                     <?php for($i=0;$i<count($centimetros);$i++){?>
                                                                                        <option value='<?php echo $centimetros[$i];?>'><?php echo $centimetros[$i];?></option>  
                                                                                     <?php }?>  
                                                                                </select>
                                                                            </div>
                                                                         </div>




                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></span>
                                        <div class="col-md-58">
                                            <input id="lname" name="Reference" type="text" placeholder="Referencia" class="form-control" required>
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></span>                            
                                            <input id="lname" name="Brand" type="text" placeholder="Marca" class="form-control" required>
                                    </div>

                                     <div class="form-group">
                                       <span class="col-md-1 col-md-offset-2 text-center"></span>
                                            <div class="col-md-58">
                                            
                                                <select class="form-control" name="Category" onChange="mostrarNuevaCategoria(this.value);" required >
                                                      <option value = "seleccion">Seleccione Categoria</option>     
                                                      <?php for($i=0;$i<count($resultSelect);$i++){?>
                                                           <option value = "<?php echo $resultSelect[$i]["idsubCategoria"]."-".$resultSelect[$i]["nombre"];?>"><?php echo $resultSelect[$i]["nombre"];?></option>
                                                      <?php }?>
                                                </select>
                                            </div>
                                     </div>

                                    <div class="form-group" id ="NewCategory">
                                        <span class="col-md-1 col-md-offset-2 text-center"></span>
                                        
                                            <input id="lname" name="NewCategory" type="text" placeholder="Escriba nueva categoria" class="form-control" >
                                    </div>


                               <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="imageSubir" name="imageSubir">
                                  <label class="custom-file-label" for="customFileLangHTML" data-browse="Seleccionar">Seleccione imagen del producto</label>
                                </div>


                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-left"></span>
                                        <div class="col-md-100">
                                            <textarea class="form-control" id="message" name="description" placeholder="Breve descripcion del producto" rows="7"></textarea>
                                        </div>
                                    </div>


              
  
                                         <?php  
                                            $registro  = new ControladorProductosTienda();
                                            $registro ->registrarProducto($objTiendaInicial,'imageSubir');
                                        ?>

                        <div class="form-group ">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class="btn btn-primary btn-lg colorbotonamarillo" id="guardar" name="guardar">Guardar</button>
                            </div>
                        </div>
                    
                </form>
       
        </div>
    </div>

</div>


 <?php

     echo '    
             <script type="text/javascript">
                      mostrar("gramos");
                      mostrarNuevaCategoria("c");
            </script>'; 


  ?>