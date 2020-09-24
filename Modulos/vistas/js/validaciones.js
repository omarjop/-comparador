 //-----------------------------------Funciones para validar precio de un producto------------------------------------ 
  function validarAsociarProducto(formulario){
         var precio = formulario.precioEdit.value;
         if(validarPrecio(precio,"precioEdit")!=true){
             return false;
		 }
  }

  function validarPrecio(valor,campoForm){
            if(!valor.includes(',')){
                 if (isNaN(parseFloat(valor))) {
                      toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
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
 ale
 //-----------------------------------Funciones para autocampletar en consulta pruebas------------------------------------
 $("#BtnMiProducto").change(function(){
    
    var producto = $("#BtnMiProducto").val();
    alert();
   /* var datos = new FormData();
    datos.append("validarProducto", producto);

    $.ajax({
        url:"http://localhost/-comparador/Modulos/vistas/ajax/validacion.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
              $("#auxx").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>funciona</div>');
              if(respuesta){
                    $("#auxx").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>funciona</div>');
              }else{
                    $("#auxx").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>funciona</div>');  
			  }
        }

    })*/

 })