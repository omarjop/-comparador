/********************************************** 
 * HERRRAMIENTA TOOLTIP esto es para usar los
 * tootip de boopstra
 **********************************************/
$('[data-toggle="tooltip"]').tooltip();


/********************************************** 
 * 
 **********************************************/
function initMap(){ 
    
    if(!!navigator.geolocation){
        var map;
        var mapOptions = {
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("google_canvas"), mapOptions);
		navigator.geolocation.getCurrentPosition(function(position){
            var geolocate = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            var infWindow = new google.maps.InfWindow({
                map: map,
                position: geolocate,
                content:
                '<h1>Esta es tu ubicacion con Geolocalizacion</h1>' +
                '<h2>Latitud:'+position.coords.latitude+'</h2>' +
                '<h2>Longitud:'+position.coords.longitude+'</h2>' 
            });
            map.setCenter(geolocate);
        });
        
    }else{
        document.getElementById("google_canvas").innerHTML = "No se soporta geolocalizacion";
    }
}


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
