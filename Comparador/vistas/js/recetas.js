/********************************************** 
 * Controlando el detalle de la lista
 **********************************************/
 $("#comentarioReceta").hide();
$(".detalleLista").click(function(e){
    e.preventDefault();

    
    $("#recetasPorCategoria").hide();
    var idReceta = $(this).attr('id');
    var idReceta2 = $(this).attr('id');
    var idReceta3 = $(this).attr('id');
    var datos = new FormData();
    var datos2 = new FormData();
    var datos3 = new FormData();
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
                                        plantilla +=                '<div class="card-text textcaract"><a href="#"><i class="fa fa-share-alt tamanoicon" aria-hidden="true"></i> </a></div><br>'
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
                                                  plantilla +='<div class="col-lg-3">'
                                                  plantilla +='<p class="card-text colordivtexto">'+'('+res.cantidad+') '+res.Nombre+'</p>'
                                                  plantilla +='</div>'
                                            }
                                         plantilla +='</div>'
                                       
                                        plantilla +='<div class="col-lg-12">'
                                        plantilla +='<h5 class="card-title productoscss">Instrucciones</h5>'
                                        plantilla +=      '<p class="card-text colordivtexto">'+obj.contenido+'</p>'
                                        plantilla +='</div>'

                                        $(".idReceta").attr('value',idReceta);
                                        $("#comentarioReceta").show();
                                        $("#recetaDesc").html(plantilla);

                          }
                     })


                    datos3.append("idComentarioXReceta", idReceta3);
                    $.ajax({
                        url:rutaOculta+"ajax/recetas.ajax.php",
                        method:"POST",
                        data: datos3, 
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(respuesta3){
                              
                              
                              if(respuesta3){
                                      respuesta3 =respuesta3.replace("[","");
                                      respuesta3 =respuesta3.replace("]","");
                                      var auxSplit2 = respuesta3.split("},");

                                       plantilla2 +='<div class="col-lg-12">'
                                            for(var i=0;i<auxSplit2.length;i++){
                                                  if(!auxSplit2[i].includes("}")){
                                                      auxSplit2[i] = auxSplit2[i]+"}";
							                      }
                                                  var res2 = JSON.parse(auxSplit2[i]);
                                                  plantilla2 +='<div class="col-lg-13">'
                                                  plantilla2 +='<ul>'
                                                  plantilla2 +=res2.descripcion
                                                  plantilla2 +='</ul>'
                                                  plantilla2 +='</div>'
                                            }
                                         plantilla2 +='</div>'
                                         $("#comentariosXReceta").html(plantilla2);
                               }
                              

                          }
                     })
                            
      

           }

    }) 

})

function validarsiesactivo(){
  // $('#modalDebeSesion').modal('show');
  alert();
}

