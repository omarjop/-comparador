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
