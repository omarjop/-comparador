var item = 0;
var item = 0;
var itemPaginacion = $("#paginacion li");
var interrumpirCiclo = false;
var imgProducto = $(".imgProducto");
var titulo1 = $("#slide h1");
var titulo2 = $("#slide h2");
var titulo3 = $("#slide h3");
var btnVerProducto = $("#slide  button");
var detenerIntervalo =  false;

$("#slide ul li").css({"width":100/$("#slide ul li").length +"%"})
$("#slide ul ").css({"width":$("#slide ul li").length*100 +"%"})
/** Efectos para imagenes https://easings.net/   
/** ================================================
 * ANIMACION PARA LAS IMAGENES Y PARA LOS TEXTOS
 * ================================================*/
$(imgProducto[item]).animate({"top":-10 +"%", "opacity":0}, 100)
$(imgProducto[item]).animate({"top":30 +"px", "opacity":1}, 600)

$(titulo1[item]).animate({"top":-10 +"%", "opacity":0}, 100)
$(titulo1[item]).animate({"top":30 +"px", "opacity":1}, 600)

$(titulo2[item]).animate({"top":-10 +"%", "opacity":0}, 100)
$(titulo2[item]).animate({"top":30 +"px", "opacity":1}, 600)

$(titulo3[item]).animate({"top":-10 +"%", "opacity":0}, 100)
$(titulo3[item]).animate({"top":30 +"px", "opacity":1}, 600)

$(btnVerProducto[item]).animate({"top":-10 +"%", "opacity":0}, 100)
$(btnVerProducto[item]).animate({"top":30 +"px", "opacity":1}, 600)


$( "#paginacion li" ).click(function() {
   
    item = $(this).attr("item")-1;
    movimientoSlide(item);
})
function movimientoSlide(item){


    $("#slide ul").animate({"left": item * -100 + "%"}, 1000);

    $("#paginacion li").css({"opacity":.5})
    $(itemPaginacion[item]).css({"opacity":1})
    interrumpirCiclo = true;
    /**animacion para la imagen */
    $(imgProducto[item]).animate({"top":-10 +"%", "opacity":0}, 100)
    $(imgProducto[item]).animate({"top":30 +"px", "opacity":1}, 600)

    $(titulo1[item]).animate({"top":-10 +"%", "opacity":0}, 100)
    $(titulo1[item]).animate({"top":30 +"px", "opacity":1}, 600)
    
    $(titulo2[item]).animate({"top":-10 +"%", "opacity":0}, 100)
    $(titulo2[item]).animate({"top":30 +"px", "opacity":1}, 600)
    
    $(titulo3[item]).animate({"top":-10 +"%", "opacity":0}, 100)
    $(titulo3[item]).animate({"top":30 +"px", "opacity":1}, 600)

    $(btnVerProducto[item]).animate({"top":-10 +"%", "opacity":0}, 100)
    $(btnVerProducto[item]).animate({"top":30 +"px", "opacity":1}, 600)

}
/** =============================================
 * FUNCION PARA AVANZAR ( DERECHA) 
 * =============================================*/
function avanzar(){
    if(item == $("#slide ul li").length-1){
        item = 0 ;
    }else{
        item++
    }
    interrumpirCiclo = true;
    movimientoSlide(item);
}

/** =============================================
 * FLECHA AVANZAR ( DERECHA) 
 * =============================================*/
$("#slide #avanzar").click(function(){
    avanzar();
    interrumpirCiclo = true;
})

/** =============================================
 *  FLECHA RETROCEDER (IZQUIERDA)
 *============================================ */
$("#slide #retroceder").click(function(){
    console.log(item);
    if(item == 0){
        item = $("#slide ul li").length - 1 ;
    }else{
        item--
    }
    movimientoSlide(item);
    interrumpirCiclo = true;
})

/** ===================================================
 * intervalo de tiempo para que se mueva el slide solo
 *====================================================*/
setInterval(function(){
    if (interrumpirCiclo){

        interrumpirCiclo = false;
        detenerIntervalo =  false;
        $("#slide ul li").finish();

    }else{
        if(!detenerIntervalo){
            avanzar();
        }
    }
}, 2000)

/** ===================================================
 * APARECER FLECHAS 
 *====================================================*/
$("#slide").mouseover(function(){

    $("#slide #retroceder").css({"opacity":1})
    $("#slide #avanzar").css({"opacity":1})
    detenerIntervalo =  true;

})
$("#slide").mouseout(function(){
    
    $("#slide #retroceder").css({"opacity":0})
    $("#slide #avanzar").css({"opacity":0})
    detenerIntervalo = false  
})