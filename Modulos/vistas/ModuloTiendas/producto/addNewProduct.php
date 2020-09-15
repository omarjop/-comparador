<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
    function mostrar(id) {

    var aux = id.split("-");
    id = aux[0];
        var unidades = ["gramos","kilogramos","mililitros","centimetros"];
        unidades.forEach(function(valor) {
                if(valor == id){
                   $("#".concat(valor)).show();               
			    }else{
                    $("#".concat(valor)).hide();  
               }
        });

    }
    
 function validarFormulario(formulario){
         
         var nombre = formulario.nameProduct.value;
         var precio = formulario.price.value;
         var pesoVolumen = formulario.unit.value;
         var marca = formulario.Brand.value;
         var categoria = formulario.Category.value;
         var gramos = formulario.grams.value;
         var kilogramos = formulario.kilograms.value;
         var mililitros = formulario.milliliters.value;
         var centimetros = formulario.centimeters.value;
         var nuevaCategoria = formulario.NewCategory.value;
         
         if(validarNombreAndMarca(nombre,"No es un nombre de producto v&aacute;lido","nameProduct")!=true){
             return false;
		 }
         if(validarPrecio(precio,"price")!=true){
             return false;
		 }
         if(validarPesoVolumenAndCategoria(pesoVolumen,"no es una unidad de peso o volumen no es v&aacute;lida","unit")!=true){
             return false;
		 }
         if(validarUnidades(pesoVolumen,gramos,kilogramos,mililitros,centimetros)!=true){
             return false;
		 }
         if(validarNombreAndMarca(marca,"No es un nombre de marca v&aacute;lido","Brand")!=true){
             return false;
		 }
         if(validarPesoVolumenAndCategoria(categoria,"Categor&iacute;a, seleccione una opci&oacute;n valida","Category")!=true){
             return false;
		 }
         if(validarNuevaCategoria(categoria,nuevaCategoria)!=true){
             return false;
		 }

         
     return true;
 }
 //------funciones de validacion de cada uno de los campos
 function validarNombreAndMarca(valor,mensaje,campoForm){
         if (isNaN(parseInt(valor))) {
              return true;
         }else{       
         //nameProduct
          toastr.error(mensaje);
          document.getElementById(campoForm).value = "";

                      
               return false;
		 } 
 }
 
  function validarPrecio(valor,campoForm){
            if(!valor.includes(',')){
                 if (isNaN(parseFloat(valor))) {
                      toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
                      //toastr.error("El valor ("+document.getElementById(campoForm).value+") "+mensaje);
                      document.getElementById(campoForm).value = "";
                      return false;
                 }else{
                      
                      return true;
		         } 
            }else{
                       toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
                       document.getElementById(campoForm).value = "";
                      return false;           
			}
 }

 function validarPesoVolumenAndCategoria(valor,mensaje,campoForm){
        if(valor == "seleccion"){
           toastr.error(mensaje);
           document.getElementById(campoForm).value = "";
           return false; 
		}else{
           return true;  
		}
 }

  function validarUnidades(valorPesoVolumen,gramos,kilogramos,mililitros,centimetros){
    
        if(valorPesoVolumen == "gramos"){
            if(gramos == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("grams").value = "";
               return false; 
		    }
		}else if(valorPesoVolumen == "kilogramos"){
            if(kilogramos == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("kilograms").value = "";
               return false; 
		    }
		}else if(valorPesoVolumen == "mililitros"){
            if(mililitros == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("milliliters").value = "";
               return false; 
		    }
		}else if(valorPesoVolumen == "centimetros"){
            if(centimetros == "seleccione"){
               toastr.error("El valor de peso o volumen no es v&aacute;lido");
               document.getElementById("centimeters").value = "";
               return false; 
		    }
		}  
  return true;
 }

 function validarNuevaCategoria(categoria,nuevaCategoria){
 
 var cate = categoria.split("-");
         if(cate[1] == "Otros"){
                if(!nuevaCategoria){
                    toastr.error('El campo nueva categor&iacute;a es requerido');       
                    document.getElementById("NewCategory").value = "";
                    return false;       
			    }
		 }
         return true;
 }

     
</script>
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
<?php 

/*Funcion que retorna la primera palabra de las unidades en pesos para poder de value en el campo select recibe parametro el vector*/
     function returnValues($arreglo){

          $values = array();
          for($i=0;$i<count($arreglo);$i++){
             $auxValue = $arreglo[$i]["nombreMedida"];
             $aux = explode(" ",$auxValue);   
             array_push($values, $aux[0]);
             
		  }

          return $values;
     
	 }
     
     $objEstuctura =  new ControladorEstructuras();
     $objSelect =  new ControladorSelectsInTables();

     $valorUnidades = $objSelect->returnSelectAllRows("unidadmedida");
     $values = returnValues($valorUnidades);

     $gramos = $objEstuctura->unidadesProductosValues("gramos");
     $kilogramos = $objEstuctura->unidadesProductosValues("kilogramos");
     $mililitros = $objEstuctura->unidadesProductosValues("mililitros");
     $centimetros = $objEstuctura->unidadesProductosValues("centimetros");
     
     $resultSelect = $objSelect->returnSelectAllRows("subcategoria");
?>


<!------------------------------------------------------------------------------------------------------------------------>






    <div class="row">
       <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
         <div class="btn-center" >
         <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);" novalidate>
                                           <div class="form-group">
                                           
                                                <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                <div class="col-md-58">
                                                
                                                    <input id="nameProduct" name="nameProduct" type="text" placeholder="Nombre producto" class="form-control"   oninput="check_text(this);" required>

                                            </div>



                                            <div class="form-group">
                                                <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                <div class="col-md-58">
                                                    <input id="price" name="price" type="text" placeholder="Precio" class="form-control" required>
                                                </div>
                                           </div>

                                            <div class="form-group">
                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                            <div class="col-md-58">
                                             
                                                <select class="form-control" onChange="mostrar(this.value);" id ="unit" name="unit" required>
                                                      <option value = "seleccion">Seleccione Peso/Volumen</option>
                                                       <?php for($i=0;$i<count($valorUnidades);$i++){?>
                                                            <option value='<?php echo $values[$i]."-".$valorUnidades[$i]["idunidadMedida"];?>'><?php echo $valorUnidades[$i]["nombreMedida"];?></option>
                                                       <?php }?>
                                                </select>
                                            </div>
                                         </div>
                                         
                                                            
                                                                         <div class="form-group"  id= "gramos" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="grams" id ="grams" required>  
                                                                                        <option value='seleccione'>Seleccione Gramos</option> 
                                                                                     <?php for($i=0;$i<count($gramos);$i++){?>
                                                                                        <option value='<?php echo $gramos[$i];?>'><?php echo $gramos[$i];?></option>  
                                                                                     <?php }?>
                                                                                </select>
                                                                            </div>
                                                                         </div>

                                                                                                                                     
                                                                         <div class="form-group" id= "kilogramos" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="kilograms" id="kilograms" required>   
                                                                                        <option value='seleccione'>Seleccione Kilogramos</option> 
                                                                                     <?php for($i=0;$i<count($kilogramos);$i++){?>
                                                                                        <option value='<?php echo $kilogramos[$i];?>'><?php echo $kilogramos[$i];?></option>  
                                                                                     <?php }?>                                                                                                                                                                                                                                                                
                                                                                </select>
                                                                            </div>
                                                                         </div>

                                                                         <div class="form-group" id= "mililitros" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="milliliters" id ="milliliters" required>         
                                                                                        <option value='seleccione'>Seleccione Mililitros</option> 
                                                                                     <?php for($i=0;$i<count($mililitros);$i++){?>
                                                                                        <option value='<?php echo $mililitros[$i];?>'><?php echo $mililitros[$i];?></option>  
                                                                                     <?php }?>  
                                                                                </select>
                                                                            </div>
                                                                         </div>



                                                                         <div class="form-group" id= "centimetros" >
                                                                            <span class="col-md-1 col-md-offset-2 text-center"></span>
                                                                            <div class="col-md-58">
                                                                                <select class="form-control" name="centimeters" id ="centimeters" required>   
                                                                                        <option value='seleccione'>Seleccione cm3</option> 
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
                                    </div>

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-center"></span>                            
                                            <input id="Brand" name="Brand" type="text" placeholder="Marca" class="form-control" required>
                                    </div>

                                     <div class="form-group">
                                       <span class="col-md-1 col-md-offset-2 text-center"></span>
                                            <div class="col-md-58">
                                            
                                                <select class="form-control" id="Category" name="Category" onChange="mostrarNuevaCategoria(this.value);" required >
                                                      <option value = "seleccion">Seleccione Categor&iacutea</option>     
                                                      <?php for($i=0;$i<count($resultSelect);$i++){?>
                                                           <option value = "<?php echo $resultSelect[$i]["idsubCategoria"]."-".$resultSelect[$i]["nombre"];?>"><?php echo $resultSelect[$i]["nombre"];?></option>
                                                      <?php }?>
                                                </select>
                                            </div>
                                     </div>

        

                                    <div class="form-group">
                                        <span class="col-md-1 col-md-offset-2 text-left"></span>
                                        <div class="col-md-100">
                                            <textarea class="form-control" id="message" name="description" placeholder="Breve descripci&oacute;n del producto" rows="7"></textarea>
                                        </div>
                                    </div>
  
                                         <?php  
                                            $registro  = new ControladorProductosTienda();
                                            $registro ->registrarProducto($objTiendaInicial);
                                        ?>

                        <div class="form-group ">
                            <div class="col-md-12 text-center ">
                                <button type="submit" class="btn btn-primary btn-lg colorbotonamarillo" id="guardar" name="guardar" >Guardar</button>
                            </div>
                        </div>
                    
                </form>
            </div>
        </div>
    </div>

 <?php

     echo '    
             <script type="text/javascript">
                      mostrar("l");
                      
                      
            </script>'; 


  ?>
