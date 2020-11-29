/********************************************** 
 * HERRRAMIENTA TOOLTIP esto es para usar los
 * tootip de boopstra
 **********************************************/
$('[data-toggle="tooltip"]').tooltip();

/********************************************** 
 * CUADRICULA O LISTA
 **********************************************/
var btnList = $(".btnList");

for (var i = 0 ; i < btnList.length ; i++ ) {
    

    $("#btnList"+i).click(function(){ 

        var numero = $(this).attr("id").substr(-1);
        $(".list"+numero).show();
        $(".grid"+numero).hide();

        $("#btnGrid"+numero).removeClass("backColor");
        $("#btnList"+numero).addClass("backColor");
    })

    $("#btnGrid"+i).click(function(){ 

        var numero = $(this).attr("id").substr(-1);
        $(".list"+numero).hide();
        $(".grid"+numero).show();

        $("#btnGrid"+numero).addClass("backColor");
        $("#btnList"+numero).removeClass("backColor");
    })
}
//************************************************** */
//FUNCION PARA AUBIR AO INICIO DE LA PAGINA 
//************************************************** */
$(document).ready(function(){
    $(window).scroll(function(){
        if($(this).scrollTop() > 100){
            $('#scroll').fadeIn();
        }else{
            $('#scroll').fadeOut();
        }
    });
    $('#scroll').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});
//************************************************** */
//FIN FUNCION PARA AUBIR AO INICIO DE LA PAGINA 
//************************************************** */


/*$(document).ready(function() {
    var $magic = $(".magic"), magicWHalf = $magic.width() / 2;
    
   $(document).on("mousemove", function(e) {
        if(e.pageY > 1300 && e.pageY < 1400){
            console.log(e.pageY);
            $magic.css({"left": e.pageX -80 , "top": e.pageY - 1300});
        }
      
     // console.log( e.pageX);
    });
    
  });*/