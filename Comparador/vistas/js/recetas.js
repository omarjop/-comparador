/********************************************** 
 * Controlando el detalle de la lista
 **********************************************/
$(".detalleLista").click(function(e){
    e.preventDefault();

    
    $("#recetasPorCategoria").hide();
    var idReceta = $(this).attr('id');
    var idReceta2 = $(this).attr('id');
    var datos = new FormData();
    var datos2 = new FormData();
    datos.append("idReceta", idReceta);
    let plantilla = " ";
    let plantilla2 = " ";
    let obj
    $.ajax({
        url:rutaOculta+"ajax/recetas.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){

           respuesta =respuesta.replace("[","");
           respuesta =respuesta.replace("]","");
            obj = JSON.parse(respuesta);
           
                            plantilla +='<h1 class= "textitulo">'+obj.nombreReceta+'</h1>'
                            plantilla +='<br>'
                            plantilla +='<div class="col-lg-6">'
                            plantilla +=  '<div class="card bg-dark text-white">'
                            
                            plantilla +=      '<img class="single-blog-img" src="http://localhost/comparador/vistas/img/usuario/pollo-con-jitomates-rostizados.jpg" alt="Blog Image">'
                            plantilla +=        '<div class="card-img-overlay">'
                            plantilla +=         '</div>'
                            plantilla +=    '</div>'
                            plantilla +='</div>'

                    
                    

                    datos2.append("idRecetaDos", idReceta2);
                    $.ajax({
                        url:rutaOculta+"ajax/recetas.ajax.php",
                        method:"POST",
                        data: datos2, 
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta2){
                              $(".barraProductos").hide(); 
                              respuesta2 =respuesta2.replace("[","");
                              respuesta2 =respuesta2.replace("]","");
                              var auxSplit = respuesta2.split("},");
                              
							  
                                        plantilla +='<div class="col-lg-6">'
                                        plantilla +=  '<div class="card bg-dark text-white">'                 
                                        plantilla +=        '<div class="card-img-overlay">'                                        
                                        plantilla +=                '<div class="textcaract"><i class="fa fa-clock-o tamanoicon"></i> Cocci&oacute;n: <h class="textsub"> '+obj.tiempo+' min</h></div>'
                                        plantilla +=                '<div class="card-text textcaract"><i class="fa fa-pie-chart tamanoicon " aria-hidden="true"></i> Porciones:  <h class="textsub">'+obj.porciones+'</h></div>'
                                        plantilla +=                '<div class="card-text textcaract"><i class="fa fa-tachometer tamanoicon" aria-hidden="true"></i> Dificultad:  <h class="textsub">'+obj.nombre+'</h></div><br>'
                                        plantilla +=                '<div class="card-text textcaract"><ul  class="pull-left">'
                                        plantilla +=                    '<a href="'+rutaOculta+'listas">'
                                        plantilla +=                        '<span  data-toggle="tooltip" title="Compara precio de receta">'
                                        plantilla +=                            '<img src="http://localhost/AdminComparador/vistas/img/iconos/lista32.png" class="img-responsive ">'
                                        plantilla +=                        '</span>'
                                        plantilla +=                     '</a>'
                                        plantilla +=                 '</ul></div>'
                                        plantilla +=         '</div>'
                                        plantilla +=    '</div>'
                                        plantilla +='</div>'


                     /*Muestra el detale e ingredientes*/
                                       
                                       plantilla +='<div class="col-lg-12">'
                                       plantilla +='<p class="card-text productoscss">Ingredientes</p>'
                                            for(var i=0;i<auxSplit.length;i++){
                                                  if(!auxSplit[i].includes("}")){
                                                      auxSplit[i] = auxSplit[i]+"}";
							                      }
                                                  var res = JSON.parse(auxSplit[i]);
                                                  plantilla +='<div class="col-lg-4">'
                                                  plantilla +='<p class="card-text colordivtexto">'+'('+res.cantidad+') '+res.Nombre+'</p>'
                                                  plantilla +='</div>'
                                            }
                                         plantilla +='</div>'
                                       
                                        plantilla +='<div class="col-lg-12">'
                                        plantilla +='<h5 class="card-title productoscss">Instrucciones</h5>'
                                        plantilla +=      '<p class="card-text colordivtexto">'+obj.contenido+'</p>'
                                        plantilla +='</div>'


                                        $("#recetaDesc").html(plantilla);

                          }
                     })



                            
      

           }

    }) 

})