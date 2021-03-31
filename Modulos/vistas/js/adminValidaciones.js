//--------------------------------------------------------------------------------------------------------


var returnValue ;
 var returnValueDelete ;
 $(".formularioAddRecetas").hide();

/*Metodo que valda la información del formulario al dar clic en el boton de agregar*/
    function validarFormulario2(formulario){

         var nombre = formulario.nameProducto1.value;
         var pesoVolumen = formulario.unitt1.value;
         var marca = formulario.marca1.value;
         var categoria = formulario.CategoryAdd.value;


        

                 if(validarNombreAndMarca(nombre,"No es un nombre de producto v&aacute;lido","nameProducto1")!=true){
                   returnValue = false;
                    // return false;
		         }

                 if(validarPesoVolumenAndCategoria(pesoVolumen,"no es una unidad de peso o volumen no es v&aacute;lida","unitt1")!=true){
                     returnValue = false;
                     //return false;
		         }
                 if(validarNombreAndMarca(marca,"No es un nombre de marca v&aacute;lido","marca1")!=true){
                     returnValue = false;
                    // return false;
		         }
                 if(validarPesoVolumenAndCategoria(categoria,"Categor&iacute;a, seleccione una opci&oacute;n valida","Category1")!=true){
                     returnValue = false;
                    // return false;
		         }

                     if(returnValue!=true){
                        returnValue = false;   
					 }else{
                        returnValue = true;              
					 }
 
     
     return returnValue;
 }
 //------funciones de validacion de cada uno de los campos
 function validarNombreAndMarca(valor,mensaje,campoForm){
               if(valor == "seleccione"){
           toastr.error(mensaje);
           //document.getElementById(campoForm).value = "";
           return false; 
		}else{
           return true;  
		}
 }
 
  function validarPrecio(valor,campoForm){

            if(!valor.includes(',')){
                 if (isNaN(parseFloat(valor))) {
                      toastr.error("No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)");
                      //toastr.error("El valor ("+document.getElementById(campoForm).value+") "+mensaje);
                      //$("#"+campoForm).parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>No es un precio v&aacute;lido Por favor ingresar un valor num&eacute;rico y los decimales con el caracter(.)</div>');  
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
        if(valor == "seleccione"){
           toastr.error(mensaje);
           //document.getElementById(campoForm).value = "";
           return false; 
		}else{
           return true;  
		}
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



 $(function(){
     $("#btnaddproducto1").click(function(){
         
         if(returnValue!=false){
            
                          var nombreAddP = $("#nameProducto1").val();
                          var unitAddP = $("#unidadNumericaAdd").val();
                          var aux  = unitAddP.split("-");
                          unitAddP = aux[1];


                            var datos = new FormData();
            
                            datos.append("nombreAddP", nombreAddP);
                            datos.append("unitAddP", unitAddP);
         
                            $.ajax({
                   
                                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                                    method:"POST",
                                    data: datos, 
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    async:false,
                                    success: function(respuesta){
                                    
                                    if(respuesta.includes("null")){                          
                                                 $(".alert").remove();                                             
                                                 returnValue =  true;

                                          }else{
                                                 toastr.error('El producto ya se encuentra registrado');                               
                                                 returnValue = false;                              
			                              }


                                    }

                              })
                   }

              return returnValue;
              
      });     

  });


  //valida si puede o no eliminar producto
   $(function(){
     $("#btnEliminarValue").click(function(){
          


                            var idProducto = $("#campoOculto2").val();
                           var datos = new FormData();
            
                            datos.append("idProducto", idProducto);
         
                            $.ajax({
                   
                                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                                    method:"POST",
                                    data: datos, 
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    async:false,
                                    success: function(respuesta){
                                          if(respuesta.includes("No existe")){                          
                                             $(".alert").remove();
                                             returnValueDelete =  respuesta;
                                          }else{   
                                            var res = JSON.parse(respuesta);
                                            toastr.error(res.mensaje);
                                            returnValueDelete = false;                              
			                              }


                                    }

                              })

              return returnValueDelete;
      });     

  });

  $(document).ready(function(){
       $("#btnCancelarDe").click(function(){
        $(".alert").remove();   
         returnValueDelete = true; 
        })
});


//valida el precio
$(document).ready(function(){
       $("#price1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});

  //valida referencia
$(document).ready(function(){
       $("#Reference1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});
  //valida peso volumen
$(document).ready(function(){
       $("#unit1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});
  //valida marca
$(document).ready(function(){
       $("#marca1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});
  //validacategoria
$(document).ready(function(){
       $("#Category1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});

  //validar unidad peso volumen
$(document).ready(function(){
       $("#unitt1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});

//------------------------------------------------------------------
//validar gramos
$(document).ready(function(){
       $("#unitt1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});
$(document).ready(function(){
       $("#grams1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});
$(document).ready(function(){
       $("#kilograms1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});
$(document).ready(function(){
       $("#mililitros1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});
$(document).ready(function(){
       $("#centimetros1").change(function(){
        $(".alert").remove();   
         returnValue = true; 
        })
});

//------------------------------------------------------------------

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

//--------------------------------------------------------------------------------------------------------
/*auto completar al agregar nuevo producto*/
$(document).ready(function(){
       $("#nameProducto1").change(function(){
          
            /*var producto = $("#nameProducto1").val();
            var datos = new FormData();
            datos.append("newProduct", producto);
         
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(respuesta.includes("null")){
                          $(".alert").remove();
                          returnValue = true;    
                                document.getElementById("Reference1").value = null;
                                document.getElementById("description1").value = null;
                                document.getElementById("Brand1").value = null;
                                document.getElementById("CategoryAdd").value = "seleccion";
                                document.getElementById("unitt1").value = "seleccion";
                                document.getElementById("grams1").value = "seleccione";
                          }else{
                               respuesta =respuesta.replace("[","");
                               respuesta =respuesta.replace("]","");
                               document.getElementById("Reference1").value = JSON.parse(respuesta).Referencia;
                               document.getElementById("description1").value = JSON.parse(respuesta).DescripcionP; 
                               document.getElementById("marca1").value = JSON.parse(respuesta).idMarca; 
                               document.getElementById("CategoryAdd").value = JSON.parse(respuesta).idsubCategoria+'-'+JSON.parse(respuesta).nombre; 
                               var nombreMedidda =  JSON.parse(respuesta).nombreMedida;
                               var aux = nombreMedidda.split(" ");
                               document.getElementById("unitt1").value = aux[0]+'1'+'-'+JSON.parse(respuesta).idunidadMedida;
                               mostrar2(aux[0]+'1'+'-'+JSON.parse(respuesta).idunidadMedida);
                               document.getElementById(returnUnidad(aux[0]+'1')).value = JSON.parse(respuesta).pesoVolumen;
                               
			              }


                    }

              })*/

        })
});

function returnUnidad(unidad){
     var returnValue = "";

     switch (unidad) {
          case 'gramos1':
            returnValue = "grams1";
            break;
          case 'kilogramos1':
            returnValue = "kilograms1";
            break;
          case 'mililitros1':
            returnValue = "milliliters1";
            break;
          case 'centimetros1':
            returnValue = "centimeters1";
            break;

        }
        return returnValue;
}





















$(function(){
     $(".imagen").click(function(){
      var imagenValue = $(this).attr('src');
      $(".imagepreview").attr('src',imagenValue);
     // document.getElementById("precio").innerHTML= "Hoy "+$(this).attr('precio'); 
      document.getElementById("productoname").innerHTML= $(this).attr('nombreproducto');
      document.getElementById("description").innerHTML= $(this).attr('descripcion');
      document.getElementById("pesovolumenes").innerHTML= $(this).attr('pesovolumen');
      document.getElementById("referenciavalue").innerHTML= "Referencia "+$(this).attr('referencia');
      document.getElementById("marcavalue").innerHTML= "Marca "+$(this).attr('marca');
      $('#imagemodal').modal('show');
  });
  });

/*LLama el modal de eliminar producto*/ 
 $(function(){
     $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));         
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta')+'  '+$(this).attr('unidad'); 
        $(".imagedelete").attr('src', $(this).attr('src'));
         $("#eliminarp").modal("show");  
      });
  });



  function validarFormularioEdit(formulario){
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

// Valida si el campo esta vacio y es requerido ponerlo en rojo cuando se da click
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


 $(document).ready(function(){
        $("#BtnMiProductos").on("keydown",function(){
    
            var producto = $("#BtnMiProductos").val();
            var datos = new FormData();
            datos.append("validarProducto", producto);

            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){

                   /* var res = JSON.parse(respuesta);
                    $("#BtnMiProducto").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>'+respuesta+' </div>');  */
                          if(respuesta.includes("null")){
                                $("#BtnMiProductos").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>No existe kjom</div>');  
                          }else{
                               /*respuesta =respuesta.replace("[","");
                               respuesta =respuesta.replace("]","");*/
                               var res = JSON.parse(respuesta);
                                    
                                           // for (i = 0; i < res.datos.length; i++) {                                                      
                                                      $("#BtnMiProductos").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong>existe jhon</div>');  
                                             //    }


                                        
			              }




                    }

              })

        })
});

function mostrarSubCategoriaAdmin(categoria,campo){
         
      var datos = new FormData();
      datos.append("findSubCategorias", categoria);
      $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(!respuesta.includes("No existe")){
                                          $(".alert").remove();
                                          returnValue = true;    


                               
                                       var x = document.getElementById(campo);                                    

                                      for (let i = x.options.length; i >= 0; i--) {
                                        x.remove(i);
                                      }

                                       var select = document.getElementById(campo); 
                                       respuesta =respuesta.replace("[","");
                                       respuesta =respuesta.replace("]","");
                                       var auxSplit = respuesta.split("},");
                                       for(var i=0;i<auxSplit.length;i++){
                                           if(!auxSplit[i].includes("}")){
                                               auxSplit[i] = auxSplit[i]+"}";
							               }
                                             var res = JSON.parse(auxSplit[i]);
                                             var option = document.createElement("option");
                                              option.value = res.idsubCategoria;
                                              option.innerHTML = res.nombre;
                                              select.appendChild(option);
                                                              
							           }

			              }else{
                                                             
                                       var x = document.getElementById(campo);                                    

                                      for (let i = x.options.length; i >= 0; i--) {
                                        x.remove(i);
                                      }
                                      var select = document.getElementById(campo); 
                                      var option = document.createElement("option");
                                      option.value = "seleccion";
                                      option.innerHTML = "Seleccione Sub Categor&iacutea";
                                      select.appendChild(option);
						  }


                    }

              })
}

 /*Metodo que valida si muestra los campos de unidades y si no los oculta*/
   function mostrarUnidadNumericaPesoVolumen(id,campo) {
            
      
            var datos = new FormData();
      datos.append("findUnidadMedida", id);
      $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(!respuesta.includes("No existe")){
                                          $(".alert").remove();
                                          returnValue = true;    


                               
                                       var x = document.getElementById(campo);                                    

                                      for (let i = x.options.length; i >= 0; i--) {
                                        x.remove(i);
                                      }

                                       var select = document.getElementById(campo); 
                                       respuesta =respuesta.replace("[","");
                                       respuesta =respuesta.replace("]","");
                                       var auxSplit = respuesta.split("},");
                                       for(var i=0;i<auxSplit.length;i++){
                                           if(!auxSplit[i].includes("}")){
                                               auxSplit[i] = auxSplit[i]+"}";
							               }
                                             var res = JSON.parse(auxSplit[i]);
                                             var option = document.createElement("option");
                                              option.value = res.idclasificacion;
                                              option.innerHTML =res.equivalencia+' '+res.simbolo;
                                              select.appendChild(option);
                                                              
							           }

			              }else{
                                                             
                                       var x = document.getElementById(campo);                                    

                                      for (let i = x.options.length; i >= 0; i--) {
                                        x.remove(i);
                                      }
                                      var select = document.getElementById(campo); 
                                      var option = document.createElement("option");
                                      option.value = "seleccion";
                                      option.innerHTML = "Seleccione unidad de medida";
                                      select.appendChild(option);
						  }


                    }

              })

    }

//-------------------------------------------------------------------------------------------
//------------------------Validaciones para editar productos en administración---------------



     /*Llama el modal de editar producto*/
  $(function(){
     $(".editarAdminProducto").click(function(){
         //$(".nameProducto1").attr('value',$(this).attr('nombre'));
        //$(".idProduct").attr('value',$(this).attr('id'));
       
         $("#modificarpp").modal("show");  
        
      });
  });

  function mostrarDatosAdminEdit(id,idsubCategoria){

           //alert(idSubCategoria);
            var datos = new FormData();
            datos.append("idProductoFiendValue", id);
            datos.append("idSubCategoria", idsubCategoria);
           
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){

                      
                          if(!respuesta.includes("No existe")){
                                  $(".alert").remove();
                                  returnValue = true;   
                                  
                                       
                                       respuesta =respuesta.replace("[","");
                                       respuesta =respuesta.replace("]","");
                                       document.getElementById("Reference1AdminEdit").value = JSON.parse(respuesta).Referencia;
                                       document.getElementById("description1AdminEdit").value = JSON.parse(respuesta).Descripcion; 
                                       document.getElementById("marca1AdminEdit").value = JSON.parse(respuesta).Marca_idMarca; 
                                       document.getElementById("nameProductoAdminEdit").value = JSON.parse(respuesta).Nombre; 
                                       document.getElementById("tipoProductAdminEdit").value = JSON.parse(respuesta).tipoProducto_idtipoProducto
                                       document.getElementById("unitt1AdminEdit").value = JSON.parse(respuesta).unidadMedida_idunidadMedida;
                                       document.getElementById("CategoryAddAdminEdit").value = JSON.parse(respuesta).categoria_idCategoria;
                                       document.getElementById("idProductValueAdmin").value = JSON.parse(respuesta).idProducto;
                                       mostrarUnidadNumericaPesoVolumen(JSON.parse(respuesta).unidadMedida_idunidadMedida,'unidadNumericaAddAdminEdit'); 
                                       document.getElementById("unidadNumericaAddAdminEdit").value = JSON.parse(respuesta).idclasificacion;
                                       mostrarSubCategoriaAdmin(JSON.parse(respuesta).categoria_idCategoria,'subCategoryAddAdminEdit');
                                       document.getElementById("subCategoryAddAdminEdit").value = JSON.parse(respuesta).subCategoria_idsubCategoria;
                               
			              }


                    }

              })

     $("#modificarpp").modal("show");  
  }
  

  //-----------------------------------Validaciones de administración------------------------

  /*LLama el modal de editar */ 
 /*$(function(){
     $(".editar").click(function(){
         $(".idUsuario").attr('value',$(this).attr('id'));
         $(".usuarioEdit").attr('value',$(this).attr('nombusuario'));   
         $("#modifiusuario").modal("show");
             document.getElementById("selectPerfil2").value=$(this).attr('idCategoria');
         
      });
  });  

  $(function(){
    $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarCateg").modal("show");  

      });
  });*/



//----------------------------------------------------------------------------------
//-------------Inicio Validacion Administracion usuario-----------------------------

//------Valida formulario registro de usuario
function registrousuarioadmin(formulario){
    var email = $("#addusuario").val();
    var contrasena = $("#addPassusuario").val();

    /*if(validarPasswordUsuario(contrasena) != true){
      return false;
    }*/
    
    


    return true;
}
//---------------Funcion que valida la estructura de correo  con expresión regular y que elñ campo sea diligenciado

var returnValue = true;
 $(document).ready(function(){
     $("#addusuario").change(function(){
   
           var email = $("#addusuario").val();        
            if(email != ""){

                var expresion = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;   
        
            if(!expresion.test(email)){
             
            //$("#addusuario").parent().before('<div class="alert alert-warning "><strong>ERROR:</strong> Escriba correctamente el correo electrónico</div>');   
                 toastr.error("Escriba correctamente el correo electrónico");
                 returnValue = false;
              }
         
    } else{
        //$("#addusuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Este campo es obligatorio</div>');
        toastr.error("El correo es obligatorio");
         returnValue = false;

    } 


            return returnValue;

        })
})
//------------------------ Valida que el correo no exista

var returnValue = true;
 $(document).ready(function(){
     $("#addusuario").change(function(){
   
           var correoUsuario = $("#addusuario").val();        
            
            var datos = new FormData();
            datos.append("correoUsuario",correoUsuario);
            
         
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(respuesta.includes("No existe")){
                              $(".alert").remove();
                              returnValue = true;    
                      
                          }else{
                              
                              toastr.error("El correo se encuentra registrado");
                              returnValue = false;             
                          }


                    }

              })

            return returnValue;

        })
})
 //-----------Valida Contraseña caracteres especiales con expresion regular y que no este vacio

function validarPasswordUsuario(passUsuario){
     var passWord = $("#addPassusuario").val();
        
    if(passWord != ""){

        var expresion = /^[a-zA-Z0-9]*$/;   

        if(!expresion.test(passWord)){

            //$("#addPassusuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se aceptan caracteres especiales</div>');
            toastr.error("No se aceptan caracteres especiales");
            return false;
        }
    } else{
        //$("#addPassusuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Este campo es obligatorio</div>');
        toastr.error("La contraseña es obligatorio");
        return false;

    }
}  

var returnValue = true;
 $(document).ready(function(){
     $("#addPassusuario").change(function(){
   
           var passWord = $("#addPassusuario").val();
        
    if(passWord != ""){

              var expresion = /^[a-zA-Z0-9]*$/;  

              if(!expresion.test(passWord)){

                  //$("#addPassusuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> No se aceptan caracteres especiales</div>');
                  toastr.error("No se aceptan caracteres especiales");
                  returnValue =  false;
              }
          } else{
              //$("#addPassusuario").parent().before('<div class="alert alert-warning"><strong>ERROR:</strong> Este campo es obligatorio</div>');
              toastr.error("La contraseña es obligatorio");
              returnValue = false;

          }

            return returnValue;



        })
})  
//-------------Fin Validacion Administracion usuario--------------------------------
 //----------------------------------------------------------------------------------
 


 //----------------------------------------------------------------------------------
//-------------Inicio Validacion Administracion Persona------------------------------

//----------Valida si el correo diligenciado esta registrado y trae los datos de la persona

 $(document).ready(function(){
     $("#addCorreoPersona").change(function(){
   
           var correoPersona = $("#addCorreoPersona").val();        
            
            var datos = new FormData();
            datos.append("correoPersona",correoPersona);
            
         
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(respuesta.includes("No existe")){
                              $(".alert").remove();  
                      
                          }else{
                              
                              toastr.error("El correo se encuentra registrado");           
                          }


                    }

              })

            return returnValue;

        })
})

  /*Función que muestra las ciudades del pais seleccionado*/
   function mostrarCiudadPais(idpais,nombreSelectCiudad) {
            
      
      var datos = new FormData();
      datos.append("BuscaCiudadPais", idpais);
      $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                         alert(respuesta);
                          if(!respuesta.includes("No existe")){
                                          $(".alert").remove();
                                          returnValue = true;    
                                         

                               
                                       var x = document.getElementById(nombreSelectCiudad);                                    

                                      for (let i = x.options.length; i >= 0; i--) {
                                        x.remove(i);
                                      }
                                          
                                       var select = document.getElementById(nombreSelectCiudad); 
                                       respuesta =respuesta.replace("[","");
                                       respuesta =respuesta.replace("]","");
                                       var auxSplit = respuesta.split("},");
                                       for(var i=0;i<auxSplit.length;i++){
                                           if(!auxSplit[i].includes("}")){
                                               auxSplit[i] = auxSplit[i]+"}";
                             }
                                             var res = JSON.parse(auxSplit[i]);
                                             var option = document.createElement("option");
                                              option.value = res.idciudad;
                                              option.innerHTML = res.nombreCiudad;
                                              select.appendChild(option);
                                                              
                         }

                    }else{
                                                             
                                       var x = document.getElementById(nombreSelectCiudad);                                    

                                      for (let i = x.options.length; i >= 0; i--) {
                                        x.remove(i);
                                      }
                                      var select = document.getElementById(nombreSelectCiudad); 
                                      var option = document.createElement("option");
                                      option.value = "seleccione";
                                      option.innerHTML = "Seleccione Ciudad";
                                      select.appendChild(option);
              }


                    }

              })

    }
//-------------Fin Validacion Administracion Receta---------------------------------

/*function mostrarFormulario(){
     $(".listaRecetasView").hide();
     $(".formularioAddRecetas").show();
     return true;
}*/

/*LLama el modal de adicionar receta*/ 
 $(function(){
     $(".botonAddReceta").click(function(){
         $("#modaddReceta").modal("show");  
      });
 });
//----------------------------------------------------------------------------------
