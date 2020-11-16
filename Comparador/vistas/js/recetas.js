/********************************************** 
 * Controlando el detalle de la lista
 **********************************************/
$(".detalleLista").click(function(e){
    e.preventDefault();

    
    $("#recetasPorCategoria").hide();
    var idReceta = $(this).attr('id');
    var datos = new FormData();
    datos.append("idReceta", idReceta);

    $.ajax({
        url:rutaOculta+"ajax/recetas.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
           let plantilla = " ";

           /* plantilla += '<div>'
            plantilla += '<a href="">'
            plantilla += '<img src="http://localhost/comparador/vistas/img/usuario/pollo-con-jitomates-rostizados.jpg" alt="Blog Image">'
            plantilla +=  '</a>' 
            plantilla +=  '</div>'*/ 


            plantilla +='<div class="col-lg-8">'
            plantilla +=  '<div class="card bg-dark text-white">'
            plantilla +=      '<img class="card-img" src="http://localhost/comparador/vistas/img/usuario/pollo-con-jitomates-rostizados.jpg" alt="Blog Image">'
            plantilla +=        '<div class="card-img-overlay">'
            plantilla +=            '<h5 class="card-title">Card title</h5>'
            plantilla +=            '<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>'
            plantilla +=            '<p class="card-text">Last updated 3 mins ago</p>'
            plantilla +=         '</div>'
            plantilla +=    '</div>'
            plantilla +='</div>'

               $("#recetaDesc").html(plantilla);
               //$("#descripcionReceta").show();
        }

    }) 

})