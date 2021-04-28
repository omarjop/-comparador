//--------------------------------------------------------------------------------------------------------


 var returnValue ;
 var returnValueDelete;
 var idRecetaDelette;
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
//----------------------------------------------------------------------------------
/*------LLama el modal de adicionar receta*/ 
var auxTimeReceta = false;
var auxPorcionesReceta = false;

 $(function(){
     $(".botonAddReceta").click(function(){
         $("#modaddReceta").modal("show");  
      });
 });



 /*------Metodo que valida la data del formulario*/
function validarDataFormulario(){    
    if(!validarOpcionTipoLista($("#dificultadReceta").val(),"seleccion")){
              $(".alert").remove();
              $("#videoReceta").parent().after('<div class="alert alert-danger" role="alert">El campo Dificultad de la receta no pude estar vacio</div>');         
     }else if(!validarOpcionTipoLista($("#categoriaReceta").val(),"seleccion")){
              $(".alert").remove();
              $("#videoReceta").parent().after('<div class="alert alert-danger" role="alert">El campo Categoria de la receta no pude estar vacio</div>');         
     }else if($("#nameReceta").val()==''){
              $(".alert").remove();
              $("#videoReceta").parent().after('<div class="alert alert-danger" role="alert">El campo Nombre de la receta no pude estar vacio</div>');    
     }else if(!auxTimeReceta){
              $(".alert").remove();
              $("#videoReceta").parent().after('<div class="alert alert-danger" role="alert">Formato invalido, solo numeros en  campo tiempo de preparacion o campo se encuentra vacio</div>');
	 }else if(!auxPorcionesReceta){
              $(".alert").remove();
              $("#videoReceta").parent().after('<div class="alert alert-danger" role="alert">Formato invalido, solo numeros en campo porciones o campo se encuentra vacio</div>');     
	 }else if($("#contenidoReceta").val()==''){
              $(".alert").remove();
              $("#videoReceta").parent().after('<div class="alert alert-danger" role="alert">El campo Contenido de la receta no pude estar vacio</div>');     
     }else if($("#imgReceta").val()==''){
              $(".alert").remove();
              $("#videoReceta").parent().after('<div class="alert alert-danger" role="alert">El campo Imagen de la receta no pude estar vacio</div>');     
	 }else{
              RegistrarReceta();              
	 }

}
//--Inicia ergistro en base---
 /*------Metodo que registra en base de datos la receta*/
 function RegistrarReceta(){
      var datos = new FormData();
      datos.append("dificultadReceta", $("#dificultadReceta").val());
      datos.append("categoriaReceta", $("#categoriaReceta").val());
      datos.append("nameReceta", $("#nameReceta").val());
      datos.append("timeReceta", $("#timeReceta").val());
      datos.append("porcionesReceta", $("#porcionesReceta").val());
      datos.append("contenidoReceta", $("#contenidoReceta").val());
      datos.append("videoReceta", $("#videoReceta").val());
      datos.append("imgRecetaAdd", $("#imgReceta").val());
      $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(!respuesta.includes("ok")){
                               toastr.error("Error al intentar registrar la receta");                               
                          }else{
                                //toastr.error("Registro exitoso"); 
                                $("#modaddReceta").modal("hide");
                                consultarAllRecetas();
                                limpiarCampos();
						  }

                     }                 

              })
 }
/*------Cuando carga la pagina de recetas consulta las recetas registradas*/
$(document).ready(function(){ 
     rutaActual = window.location.toString();
     if(rutaActual.includes("addRecetas")){    
     $('#descripcionRecetasView').hide();
        consultarAllRecetas();
     }
});
 /*------consulta todas las recetas registradas*/
 function consultarAllRecetas(){
     var datos = new FormData();
     datos.append("recetas", "nulo");
            
            let plantilla2 = " ";
            let obj
            $.ajax({
                url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                method:"POST",
                data: datos, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta3){
                                 if(respuesta3){
                                      respuesta3 =respuesta3.replace("[","");
                                      respuesta3 =respuesta3.replace("]","");
                                      var auxSplit2 = respuesta3.split("},");

                                       plantilla2 +='<div class="col-lg-9 col-md-9 col-sm-10 col-xs-12" id="">'
                                            for(var i=0;i<auxSplit2.length;i++){
                                                  if(!auxSplit2[i].includes("}")){
                                                      auxSplit2[i] = auxSplit2[i]+"}";
							                      }
                                                  var res2 = JSON.parse(auxSplit2[i]);
                                                  plantilla2 +='<div>'
                                                  plantilla2 +='        <ul class="list-group list-group-flush" >'
                                                  plantilla2 +='               <div class="row justify-content-center" >'
                                                  plantilla2 +='                    <div class="col-12">'

                                                  plantilla2 +='                         <li class="list-group-item list-group-item-light"><a href="javascript:descriptReceta('+res2.idRecetas+')" data-toggle="tooltip" title="Ver descripcion de receta">'+res2.nombreReceta+'</a>'
                                                  plantilla2 +='                            <a href="javascript:eliminarRecetaAdm('+res2.idRecetas+')"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span  id = "'+res2.idRecetas+'" class="far fa-trash-alt eliminarrecetaf"></span></p></a>  '                                                  
                                                  plantilla2 +='                          </li>'
                                                  plantilla2 +='                     </div>'
                                                  plantilla2 +='                </div>'
                                                  plantilla2 +='         </ul>'
                                                  plantilla2 +='</div>'
    
                                            }
                                         plantilla2 +='</div>'
                                         $("#listaRecetasView").html(plantilla2);  
                                   }

                      }
                 })
 }
 /*------Metodo que muestra la descripcion de la receta*/
 function descriptReceta(idReceta){

      let plantilla22 = " ";
      var datoss = new FormData();
      datoss.append("idRecetaFindProduct", idReceta);

$.ajax({
                url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                method:"POST",
                data: datoss, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuestaFinal){
                
                                 if(respuestaFinal.length >6){
                                      respuestaFinal =respuestaFinal.replace("[","");
                                      respuestaFinal =respuestaFinal.replace("]","");
                                      var auxSplit2 = respuestaFinal.split("},");

                                       plantilla22 +='<div class="row">'
                                            for(var i=0;i<auxSplit2.length;i++){
                                                  if(!auxSplit2[i].includes("}")){
                                                      auxSplit2[i] = auxSplit2[i]+"}";
							                      }
                                                  var res22 = JSON.parse(auxSplit2[i]);
                                                  plantilla22 +='<div >'
                                                  
                                                  
                                                  plantilla22 +='                    <div >'                                                            
                                                  plantilla22 +='                         <li class="list-group-item list-group-item-light">'+res22.Nombre
                                                  plantilla22 +='                         </li>'
                                                  plantilla22 +='                     </div>'                      
                                                 
                                                  plantilla22 +='</div>'
                                                  
                                            }
                                            
                                         plantilla22 +='</div>'                                         
                                         
                                   }

                      }
                 })




     $('#listaRecetasView').hide();
     var datos = new FormData();
      datos.append("idRecetaFindAdmin", idReceta);
      
        let plantilla2 = " ";      
            let obj
            $.ajax({
                url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                method:"POST",
                data: datos, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta3){
                //alert(respuesta3);
                          if(respuesta3){        
                                      respuesta3 =respuesta3.replace("[","");
                                      respuesta3 =respuesta3.replace("]","");
                                      var res2 = JSON.parse(respuesta3);

                                        plantilla2 +='<div class="col-lg-9 col-md-9 col-sm-10 col-xs-12" id="">'
                                           
                                                  
                                                  plantilla2 +='<div class="card">'
                                                  plantilla2 +='  <h5 class="card-header textituloAdmin">'+res2.nombreReceta+'</h5>'
                                                  plantilla2 +='  <div class="card-body">'
                                                  plantilla2 +=''
                                                  plantilla2 +='     <p class="card-text "><h class="texSubTitulo">Cocci&oacute;n:</h> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+res2.tiempo+' min</p> '
                                                  plantilla2 +='     <p class="card-text "><h class="texSubTitulo">Porciones:</h>&nbsp;&nbsp;&nbsp;'+res2.porciones+'</p>'
                                                  plantilla2 +='     <p class="card-text "><h class="texSubTitulo">Dificultad:</h>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+res2.nombre+'</p>'
                                                  plantilla2 +='     '                                                  
                                                  plantilla2 +='   </div>'
                                                  plantilla2 +='</div>'

                                                  plantilla2 +='<div class="card">'
                                                  plantilla2 +='  <h5 class="card-header textituloAdmin">Ingredientes</h5>'
                                                  plantilla2 +='  <div class="card-body">'                                                  
                                                  plantilla2 +='     <p class="card-text">'+plantilla22+'</p>'
                                                                                                   
                                                  plantilla2 +='   </div>'
                                                  plantilla2 +='</div>'

                                                  plantilla2 +='<div class="card">'
                                                  plantilla2 +='  <h5 class="card-header textituloAdmin">Contenido</h5>'
                                                  plantilla2 +='  <div class="card-body">'                                                  
                                                  plantilla2 +='     <p class="card-text">'+res2.contenido+'</p>'
                                                  plantilla2 +='     <a href="javascript:modalEditarReceta('+res2.idRecetas+')" class="btn btn-primary colorbotonamarillo">Editar receta</a>'
                                                  plantilla2 +='     <a href="javascript:addProducts('+res2.idRecetas+')" class="btn btn-primary colorbotonamarillo">Agregar o eliminar producto</a>'
                                                  plantilla2 +='   </div>'
                                                  plantilla2 +='</div>'    
                                          
                                         plantilla2 +='</div>'
                                         $("#descripcionRecetasView").html(plantilla2);                                           
                                         $('#descripcionRecetasView').show();
                                                                                 
                          }

                      }
                 })
 }
 /*------Metodo que limpia los campos del formulario de registro de receta*/
 function limpiarCampos(){
    document.getElementById("nameReceta").value = null;
    document.getElementById("dificultadReceta").value = "seleccion";
    document.getElementById("categoriaReceta").value = "seleccion";
    document.getElementById("timeReceta").value = null;
    document.getElementById("porcionesReceta").value = null;
    document.getElementById("contenidoReceta").value = null;
 }
 /*------Metodo que valida un campo de tipo lista no selecciones la opcion por defecto*/
 function validarOpcionTipoLista(valorDeCampo,opcion){
   var valorReturn = true;  
        if(valorDeCampo == opcion){
            valorReturn = false;
		}
   return valorReturn;
 }
 /*------Metodo que  valida que el valor dado sea numerico con decimales con delimitador la (,)*/
 function validarNumericoDecimal(valor,campoMensaje){
   var valoresAceptados = /^\d*\.?\d*$/;
       if (!valor.match(valoresAceptados)){
            $(campoMensaje).parent().after('<div class="alert alert-danger" role="alert">Valor no num&eacute;rico, los decimales con el caracter(.)</div>');
            return false;
       } else {
            return true;
      }
 }
  /*------Metodo que  valida que el valor dado sea numerico con decimales con delimitador la (,)*/
 function validarNumericoEntero(valor,campoMensaje,mensaje){
   var valoresAceptados = /^\d*$/;
       if (!valor.match(valoresAceptados)){
            $(campoMensaje).parent().after('<div class="alert alert-danger" role="alert">'+mensaje+'</div>');
            return false;
       } else {
            return true;
      }
 }
 /*------Ajax que valida en tiempo real el valor que se va ingresando en el campo de tiempo receta*/
  $(document).ready(function(){
        $("input#timeReceta").on("keyup",function(){
             $(".alert").remove();
              var valorTimaReceta = $(this).val();
                  if(valorTimaReceta!=''){
                          var resultado = validarNumericoDecimal(valorTimaReceta,"#timeReceta");                          
                          if(resultado == true){
                             $(".alert").remove();
                             auxTimeReceta = true;
			              }else{
                               auxTimeReceta = false;              
						  }
                  }else{
                     auxTimeReceta = false; 
				  }
        });
   	
   });

    /*------Ajax que valida las porciones en la receta receta*/
  $(document).ready(function(){
        $("input#porcionesReceta").on("keyup",function(){
             $(".alert").remove();
              var valorTimaReceta = $(this).val();
                  if(valorTimaReceta!=''){
                          var resultado = validarNumericoEntero(valorTimaReceta,"#porcionesReceta","El valor de las porciones debe ser num&eacute;rico");                          
                          if(resultado == true){
                             $(".alert").remove();
                             auxPorcionesReceta = true;
			              }else{
                             auxPorcionesReceta = false;              
						  }
                  }else{                         
                      auxPorcionesReceta = false;   
				  }
        });
   	
   });

//--Inicio  Rergistro de producto por receta---
function addProducts(idReceta){ 

        let plantilla2 = " ";
        let plantilla22 = " ";

        var datos = new FormData();
        datos.append("productos", idReceta);

        var datoss = new FormData();
        datoss.append("idRecetaFindProduct", idReceta);


            $.ajax({
                url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                method:"POST",
                data: datos, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuesta3){

                                 if(respuesta3){
                                      respuesta3 =respuesta3.replace("[","");
                                      respuesta3 =respuesta3.replace("]","");
                                      var auxSplit2 = respuesta3.split("},");

                                       plantilla2 +='<div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 scrollComentario" id="">'
                                            for(var i=0;i<auxSplit2.length;i++){
                                                  if(!auxSplit2[i].includes("}")){
                                                      auxSplit2[i] = auxSplit2[i]+"}";
							                      }
                                                  var res2 = JSON.parse(auxSplit2[i]);/*-- aquie se muestra los productos con la cantidad y boton de agregar*/
                                                  plantilla2 +='<div>'
                                                  plantilla2 +='        <ul class="list-group list-group-flush" >'
                                                  plantilla2 +='               <div class="row" >'
                                                  plantilla2 +='                    <div class="col-12">'

                                                  plantilla2 +='                         <li class="list-group-item list-group-item-light">'+res2.Nombre
                                                  plantilla2 +='                            <a href="javascript:addCantidadProducts('+res2.idProducto+')"><p style ="position: absolute; right: 70; top:20;" data-placement="top" data-toggle="tooltip" title="Agregar productos"><span   class="	fas fa-plus-square addProducts"></span></p></a>'
                                                  plantilla2 +='                            <div class="row" >'
                                                  plantilla2 +='                                <div class="col-4" >'
                                                  plantilla2 +='                                    <input  style="display: none;"  type="text" class="form-control" id = "'+res2.idProducto+'" name ="'+res2.idProducto+'" placeholder="Cantidad">'                                                  
                                                  plantilla2 +='                                </div>'
                                                  plantilla2 +='                                <div class="col-4" >'
                                                  plantilla2 +='                                    <a href="javascript:agregarProductosReceta('+res2.idProducto+','+idReceta+')" style="display: none;  color: white; background:#2996D3;width:90px; height:36px" style ="width:10%;" id = "'+res2.idProducto+"btn"+'" name = "'+res2.idProducto+'"   class="btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> <span id = "'+res2.idProducto+'" class="">Add</span></a>'                           
                                                  plantilla2 +='                                </div>'
                                                  plantilla2 +='                            </div>'
                                                  plantilla2 +='                          </li>'
                                                  plantilla2 +='                     </div>'
                                                  plantilla2 +='                </div>'
                                                  plantilla2 +='         </ul>'
                                                  plantilla2 +='</div>'
                                                  
                                            }
                                            
                                         plantilla2 +='</div>'
                                         
                                         $("#listaProductXReceta").html(plantilla2);
                                   }

                      }
                 })

var titulo = "Productos en receta";

        $.ajax({
                url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                method:"POST",
                data: datoss, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuestaFinal){
                                 if(respuestaFinal.length >6){
                                      respuestaFinal =respuestaFinal.replace("[","");
                                      respuestaFinal =respuestaFinal.replace("]","");
                                      var auxSplit2 = respuestaFinal.split("},");
                                       
                                       
                                       plantilla22 +='<div class="card">'
                                       plantilla22 +='  <h5 class="card-header textituloAdmin">'+titulo+'</h5>'                   
                                       plantilla22 +='</div>'
                                       plantilla22 +='<div class="row" >'

                                            for(var i=0;i<auxSplit2.length;i++){
                                                  if(!auxSplit2[i].includes("}")){
                                                      auxSplit2[i] = auxSplit2[i]+"}";
							                      }
                                                  var res22 = JSON.parse(auxSplit2[i]);
                                                  plantilla22 +='<div >'
                                           
                                                  plantilla22 +='                    <div >'                                                            
                                                  plantilla22 +='                         <li class="list-group-item list-group-item-light">'+res22.Nombre
                                                  plantilla22 +='                            <div class="row" >'
                                                  plantilla22 +='                                <div class="col-4" >'
                                                  plantilla22 +='                                    <input  style="display: none;"  type="text" class="form-control" id = "'+res22.idProducto+"cant"+ '" name ="'+res22.idProducto+'" value="'+res22.cantidad+'" placeholder="Cantidad">'                                                  
                                                  plantilla22 +='                                </div>'
                                                  plantilla22 +='                                <div class="col-4" >'
                                                  plantilla22 +='                                    <a href="javascript:editaCantidad('+res22.idProducto+','+idReceta+')" style="display: none;  color: white; background:#2996D3;width:90px; height:36px" style ="width:10%;" id = "'+res22.idProducto+"btnEdit"+'" name = "'+res22.idProducto+'"   class="btn"><i class="fa fa-plus-circle" aria-hidden="true"></i> <span id = "'+res22.idProducto+'" class="">Editar</span></a>'                           
                                                  plantilla22 +='                                </div>'
                                                  plantilla22 +='                            </div>'
                                                  plantilla22 +='                         <a href="javascript:editarCantProductXReceta('+res22.idProducto+','+idReceta+')"><span class="fas fa-pen-alt "  data-toggle="tooltip" title="Editar cantidad de producto"></span></a> '
                                                  plantilla22 +='                         <a href="javascript:desasociarProductXReceta('+res22.idProducto+','+idReceta+')"><span   class="far fa-trash-alt " data-toggle="tooltip" title="Quitar producto de receta"></span></a>          '
                                                  plantilla22 +='                         </li>'
                                                  plantilla22 +='                     </div>' 
                                                  
                     
                                                 
                                                  plantilla22 +='</div>'
                                                  
                                            }                                         

                                         plantilla22 +='</div>'
                                         
                                         $("#listaProductAddXReceta").html(plantilla22);                                           
                                         $("#modaddProductReceta").modal("show");                                   }else{
                                         
					               }
                                   if(respuestaFinal.length < 7){
                                            $("#modaddProductReceta").modal("show");                   
								   }

                 }
        })

         
   return true;
}

function addCantidadProducts(id){
$(".alert").remove();
if ($("#"+id).is (':hidden')){
   $("#"+id).css("display", "block");
   document.getElementById(id).value = null;
   $("#"+id+"btn").css("display", "block");   
}else{
   $("#"+id).css("display", "none");
   document.getElementById(id).value = null;
   $("#"+id+"btn").css("display", "none");   
}


}

function reAddCantidadProducts2(id){
$(".alert").remove();
if ($("#"+id+"cant").is (':hidden')){
   $("#"+id+"cant").css("display", "block");
   //document.getElementById(id+"cant").value = null;
   $("#"+id+"btnEdit").css("display", "block");   
}else{
   $("#"+id+"cant").css("display", "none");
  //document.getElementById(id+"cant").value = null;
   $("#"+id+"btnEdit").css("display", "none");   
}
}


function cargar(id){
   $(".alert").remove();
   $("#"+id).css("display", "none");
   $("#"+id+"btn").css("display", "none");   
}

function reCargar2(id){
   $(".alert").remove();
   $("#"+id+"cant").css("display", "none");
   $("#"+id+"btnEdit").css("display", "none");   
}
//--Finaliza Rergistro de producto por receta---

//--Finaliza ergistro en base---

//--Inicia edicion en base---
function modalEditarReceta(id){
     var datos = new FormData();
      datos.append("idRecetaFind", id);
            
            let obj
            $.ajax({
                url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                method:"POST",
                data: datos, 
                cache: false,
                contentType: false,
                processData: false,
                success: function(respuestaReceta){
                          if(respuestaReceta){                          
                               
                                      respuestaReceta =respuestaReceta.replace("[","");
                                      respuestaReceta =respuestaReceta.replace("]","");
                                      
                                           var res2 = JSON.parse(respuestaReceta);
                                           document.getElementById("dificultadRecetaUpdate").value = res2.categoria_idCategoria;
                                           document.getElementById("categoriaRecetaUpdate").value = res2.categoria_idCategoria;
                                           document.getElementById("nameRecetaUpdate").value = res2.nombreReceta;
                                           document.getElementById("timeRecetaUpdate").value = res2.tiempo;
                                           document.getElementById("porcionesRecetaUpdate").value = res2.porciones;
                                           document.getElementById("contenidoRecetaUpdate").value = res2.contenido; 
                                           
                                       $("#moduppReceta").modal("show");
                                        
                          }

                      }
                 })
	  }
//--Finaliza edicion en base---

//--Inicio eliminar receta-----
function eliminarRecetaAdm(idReceta){
    $("#eliminarReceta").modal("show");
    idRecetaDelette = idReceta; 
}
function aceptarDeletteReceta(){
    
      var datos = new FormData();
      datos.append("idRecetaDeleteAdmin", idRecetaDelette);
      $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          consultarAllRecetas();
                          $("#eliminarReceta").modal("hide"); 
                     }                 

              })
    // idRecetaDelette id receta a eliminar
       
}
//--Fin eliminar receta

//--Inicio de desasociar producto de Receta
function desasociarProductXReceta($idProducto,$idReceta){
      var datos = new FormData();
      datos.append("idRecetaDeleteProductAdmin", $idReceta);
      datos.append("idProductDeleteProductAdmin", $idProducto);
      $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          addProducts($idReceta); 
                          descriptReceta($idReceta);
                     }                 

              })
}
//--Fin de desasociar producto de Receta


//--Inicio asociar producto a receta
function agregarProductosReceta(idProducto,idReceta){
      $(".alert").remove();
      var datos = new FormData();
      var cantidad = document.getElementById(idProducto).value;

      if(cantidad!=""){
      $(".alert").remove();
                  datos.append("idRecetaAsocProductAdmin", idReceta);
                  datos.append("idProductAsocProductAdmin", idProducto);
                  datos.append("cantidadProducto",cantidad);

                  $.ajax({
                                url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                                method:"POST",
                                data: datos, 
                                cache: false,
                                contentType: false,
                                processData: false,
                                async:false,
                                success: function(respuesta){
                                      if(respuesta.includes("ok")){
                                            cargar(idProducto);
                                            addProducts(idReceta); 
                                            descriptReceta(idReceta);                                
                                
						              }

                                 }                 

                          })
                }else{
                      $("#"+idProducto).parent().after('<div class="alert alert-danger" role="alert">El campo cantidad no pude estar vacio</div>');             
				}
              
}
//--Fin asociar producto a receta

//--Inicio de editar cantidad de producto asociado a Receta
function editarCantProductXReceta(idProducto,idReceta){
   reAddCantidadProducts2(idProducto); 
}

function editaCantidad($idProducto,$idReceta){
$(".alert").remove();
   var datos = new FormData();
      var cantidad = document.getElementById($idProducto+"cant").value;
      if(cantidad!=""){
      $(".alert").remove();
              datos.append("idRecetaEditCantProductAdmin", $idReceta);
              datos.append("idProductoEditCantProductAdmin", $idProducto);
              datos.append("cantidad", cantidad);
              $.ajax({
                            url:"http://localhost/-comparador/Modulos/ajax/adminRecetas.ajax.php",
                            method:"POST",
                            data: datos, 
                            cache: false,
                            contentType: false,
                            processData: false,
                            async:false,
                            success: function(respuesta){
                                  if(respuesta.includes("ok")){
                                      reCargar2($idProducto);
                                  }
                          
                         
                             }                 

                      })
          }else{
             $("#"+$idProducto+"cant").parent().after('<div class="alert alert-danger" role="alert">El campo cantidad no pude estar vacio</div>');     
		  }
}
//--Fin de editar cantidad de producto asociado a Receta