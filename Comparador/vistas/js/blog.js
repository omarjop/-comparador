 $("#comentarioBlog").hide();
  var aux = true;
$(".click").click(function(e){
    e.preventDefault();  
    $("#listaBlogs").hide();

             var idBlog = $(this).attr('id');
             var rutaImagen = $(this).attr('ruta');
             var datos = new FormData();
             datos.append("idBlogFind", idBlog);
             let plantilla = " ";
             let obj

             $.ajax({
                 url:rutaOculta+"ajax/blog.ajax.php",
                 method:"POST",
                 data: datos, 
                 cache: false,
                 contentType: false,
                 processData: false,
                 success: function(respuesta){
                       
                           
                               respuesta =respuesta.replace("[","");
                               respuesta =respuesta.replace("]","");

                               obj = JSON.parse(respuesta);

                           
                            plantilla +='<h1 class= "textituloblog">'+obj.titulo+'</h1>'
                            plantilla +='<br>'
                            plantilla +='<div class="col-lg-12">'                        
                            plantilla +=  '<div class="card bg-dark text-white">'
                            plantilla +=      '<div class="single-blog-img">'
                            plantilla +=          '<a href="#"><img  src= '+rutaImagen+'vistas/img/blog/'+obj.imageDestacada+' alt="Blog Image" style="width: 1200px; height: 400px; "></a>'
                            plantilla +=            '<div class="card-img-overlay">'
                            plantilla +=            '</div>'
                            plantilla +=       '</div>'
                            plantilla +=    '</div>'
                            plantilla +='</div>'
					        plantilla +='<br>'


    
                                        plantilla +=         '</div>'
                                        plantilla +=    '</div>'
                                        plantilla +='</div>'

                                        plantilla +='<br>'
                                        plantilla +='<div class="col-lg-12 scrolldesblog">'
                                        plantilla +=      '<p class="card-text">'+obj.contenido+'</p>'
                                        plantilla +='</div>'

                             plantilla +='<div class="col-lg-12">'
                             plantilla +='<br>'
                             plantilla +='<br>'
                                        plantilla +=  '<div class="card bg-dark text-white">'                 
                                        plantilla +=        '<div class="card-img-overlay">'     
                                        plantilla +='            <div class="positionImagen" align="center">'
                                        plantilla +='               <img class="img-circle" src="http://localhost/AdminComparador/vistas/img/usuarios/perfil/'+obj.fotoPerfil+'" style="width: 90px; height: 90px; align:"center"; ">'                                                                                          
                                        plantilla +='            </div>'
                                        plantilla +='            <div class="positionImagen" align="center">'
                                        plantilla +=               '<h  align="center">'+obj.Nombres+' '+obj.Apellidos+'</h>'
                                        plantilla +='            </div>'
                                        
                                        
                                        plantilla +=             '<div class="container" align="center">'
                                        plantilla +=                '<div class="row">'
                                        
                                        plantilla +=                      '<ul>'
                                       
                                        plantilla +=                           '<li>'
                                        plantilla +=                               '<span data-toggle="tooltip" title="Compartir en redes">'                                      
                                        plantilla +=                                   '<i class="fa fa-share-alt tamanoicon" aria-hidden="true"></i>'
                                        plantilla +=                                '</span>'
                                        plantilla +=                                '<a href="http://facebook.com" target="_blank">'
                                        plantilla +=                                '<i class="fa fa-facebook fa-5x redSocial facebookBlanco b" aria-hidden="true" ></i>'
                                        plantilla +=                                '&nbsp;'
                                        plantilla +=                                '&nbsp;'
                                        plantilla +=                                '<a href="https://www.instagram.com" target="_blank">'
                                        plantilla +=                                '<i class="fa fa-instagram  redSocial facebookBlanco b" aria-hidden="true"></i>'
                                        plantilla +=                                '&nbsp;'
                                        plantilla +=                                '&nbsp;'
                                        plantilla +=                                '<a href="https://twitter.com/" target="_blank">'
                                        plantilla +=                                '<i class="fa fa-twitter redSocial facebookBlanco b" aria-hidden="true"></i>'
                                        plantilla +=                                '&nbsp;'
                                        plantilla +=                                '&nbsp;'
                                        plantilla +=                                '<a href="https://www.youtube.com" target="_blank">'
                                        plantilla +=                                '<i class="fa fa-youtube redSocial facebookBlanco b" aria-hidden="true"></i>'
                                        plantilla +=                                '</a>'
                                        plantilla +=                           '</li>'

                                        
                                        plantilla +=                      '</ul>'
                                        plantilla +=                    '</div>'
                                        plantilla +=                 '</div>'
                                        plantilla +=              '</div>'
                                        plantilla +='<br>'

                                        $(".idBlog").attr('value',idBlog);
                                        $("#comentarioBlog").show();
                                        verCommentForReceta(idBlog);
                                         $("#blogDesc").html(plantilla);
                             }

                   
              })


})




function validarsiesactivoBlog(sesion,idPersona){


    if(sesion == '0'){
            $("#modalIngreso").modal("show");
	}else{
             var comentario = $("#comentarioBlogValue").val();
             var idBlog = $("#idBlog").val();
               
                  if(aux !=false){
                          if(comentario!=""){ 
                                var datos = new FormData();
                                datos.append("addComentario", comentario);
                                datos.append("idBlogComment", idBlog);
                                datos.append("idPersona", idPersona);
                                let plantilla = " ";
                                let obj
                                $.ajax({
                                    url:rutaOculta+"ajax/blog.ajax.php",
                                    method:"POST",
                                    data: datos, 
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    async:false,
                                    success: function(respuesta){
                                               if(respuesta == "ok"){
                                                    verCommentForReceta(idBlog);
                                                    document.getElementById("comentarioBlogValue").value = "";
                                               }     

                                          }
                                     })
                          }
                  }else{
                      return false;        
				  }
	}
  
}

// Registra comentario por Blog

function verCommentForReceta(idBlog){
            var datos = new FormData();
            datos.append("comentariosXBlog", idBlog);
            let plantilla2 = " ";
            let obj
            $.ajax({
                url:rutaOculta+"ajax/blog.ajax.php",
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

                                       plantilla2 +='<div class="col-lg-12 scrollComentario">'
                                            for(var i=0;i<auxSplit2.length;i++){
                                                  if(!auxSplit2[i].includes("}")){
                                                      auxSplit2[i] = auxSplit2[i]+"}";
							                      }
                                                  var res2 = JSON.parse(auxSplit2[i]);
                                                  plantilla2 +='<div class="col-lg-12 ">'
                                                  plantilla2 +='<ul>'
                                                  plantilla2 +='   <table class="egt">'
                                                  plantilla2 +='      <tr>'

                                                  plantilla2 +='        <td >'
                                                  plantilla2 +='            <div class="positionImagen">'
                                                  plantilla2 +='               <img class="img-circle" src="http://localhost/AdminComparador/vistas/img/usuarios/perfil/'+res2.fotoPerfil+'" style="width: 45px; height: 45px; align:"left"; ">'                                                  
                                                  plantilla2 +='            </div>'
                                                  plantilla2 +='        </td>'
                                                  plantilla2 +='        <td>'
                                                  plantilla2 +='            <div class="informacionComment">'
                                                  plantilla2 +='                <strong>'+''+res2.Nombres+' '+res2.Apellidos+'</strong>'
                                                  plantilla2 +='                <h class="comentarioText">'+''+res2.descripcion+'</h>'                                                  
                                                  plantilla2 +='            </div>'
                                                  plantilla2 +='        <br>'
                                                  plantilla2 +='        </td>'
                                                  plantilla2 +='      </tr>'


                                                  plantilla2 +='    </table>'
                                                  plantilla2 +='</ul>'
                                                  plantilla2 +='</div>'
                                            }
                                         plantilla2 +='</div>'
                                         $("#comentariosXBlog").html(plantilla2);  
                                   }

                      }
                 })
}

//Valida las palabras obcenas

 $(document).ready(function(){
        $("input#comentarioBlogValue").on("keyup",function(){
               var valor = $(this).val();
              // alert(valor);
              // if(valor.includes(" ")){
                  
                        var datos = new FormData();
                        datos.append("palabraObcena", valor);
                        $.ajax({
                            url:rutaOculta+"ajax/recetas.ajax.php",
                            method:"POST",
                            data: datos, 
                            cache: false,
                            contentType: false,
                            processData: false,
                            async:false,
                            success: function(respuesta){
                             respuesta =respuesta.replace('"','');
                             respuesta =respuesta.replace('"','');
                             $(".alert").remove();
                                       if(respuesta != 'Correcto'){                                          
                                          $("#comentarioBlogValue").parent().after('<div class="alert alert-danger"><strong>CUIDADO:</strong> En el comentario se encuentran palabras obcenas como lo son ('+respuesta+') !</div>');
                                          aux = false;
                                       } else{
                                           $(".alert").remove();
                                          aux = true;
                                         
									   }    

                                  }
                             })

        });
   	
   });