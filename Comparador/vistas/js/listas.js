var idUsuario = $("#idUsuario").val();
var verLista= 0;
/********************************************** 
 * Controlando el menu izquierdo de
 **********************************************/
$(".listasFull").click(function(e){
    e.preventDefault();
    $(".listasborradasC").hide();
    $(".listaEditViewC").hide();
    $(".listasCompartidasD").hide();
    $(".listasRecetasR").hide();
    $(".listasfullC").show();
    
})

$(".listasComp").click(function(e){
    e.preventDefault();
    $(".listasborradasC").hide();
    $(".listaEditViewC").hide();
    $(".listasfullC").hide();
    $(".listasRecetasR").hide();
    $(".listasCompartidasD").show();
    $("#ListasActualizadas").hide();

})

$(".listasRecetas").click(function(e){
    e.preventDefault();
    $(".listasborradasC").hide();
    $(".listaEditViewC").hide();
    $(".listasfullC").hide();
    $(".listasCompartidasD").hide();
    $(".listasRecetasR").show();
})

 $(".listasBorradas").click(function(e){
    e.preventDefault();
    $(".listasborradasC").show();
    $(".listaEditViewC").hide();
    $(".listasCompartidasD").hide();
    $(".listasRecetasR").hide();
    $(".listasfullC").hide();
})

/********************************************** 
 * MULTIPLE SELECCION DEL LAS LISTAS
 **********************************************/
$(document).ready(function(){

	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			})
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			})
		} 
	})
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	})
})

/********************************************************* 
 * AJAX PARA CARGAR INFORMACIOND EN UNA LISTA DEFINIDA 
 * DESDE EL BOTTON DE VER Y EDITAR LISTA DE MIS LISAS 
 * CARGADAS
 *********************************************************/
$(".listEditView").click(function(e){
    e.preventDefault();
    console.log("pruebas");
    var select = document.querySelector('.follow-us');
    var idLista = select.querySelectorAll("a.listEditView");
    var idLista = this.id;

    //Consulta nombre de la lista y pintar la cabecera de las tabla
    pintarCabeceraLista(idLista);

    //Consultar los productos asociados a una lista
    var idLista2 = this.id;
    pintarProductosLista(idLista2);
    
})
function pintarCabeceraLista(idLista){
    var datos = new FormData();
    datos.append("idLista", idLista);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            let obj = JSON.parse(respuesta);
            let plantilla = " ";
            plantilla +='<h2>'+obj.nombreLista+' <a onclick="activarFormulario(\''+obj.nombreLista+'\', '+obj.idListaCompra+')" id='+obj.idListaCompra+' class="btn cadena" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>'
                
            $("#nameList").html(plantilla);
            $(".listasfullC").hide();
            $(".listaEditViewC").show();
        }

    })
}
function activarFormulario(name, id){
    let plantilla = " ";
    plantilla +=' <input type="text" class="form-control is-valid" id="newNameList" name="newNameList" placeholder="" value="' + name + '" required>'
    plantilla +='<button type="button" onclick="cambiarNombreListaF('+ id +')" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i>Cambiar</button>'
    plantilla +='<button type="button" onclick="pintarCabeceraLista(' + id + ')" class="btn btn-danger"><i class="fa fa-minus-circle"  aria-hidden="true"></i> Cancelar</button>'
    $("#nameList").html(plantilla);
    
}
function cambiarNombreListaF(id){
    var newName = $("#newNameList").val();

    if (newName.length > 0){
        var datos = new FormData();
        datos.append("nameChange", newName);
        datos.append("idChange", id);
        $.ajax({
            url:rutaOculta+"ajax/lista.ajax.php",
            method:"POST",
            data: datos, 
            cache: false,
            contentType: false,
            processData: false,
            success: function(respuesta){
               if(respuesta == "ok"){
                    pintarCabeceraLista(id);
                    verLista = 1;
                }
            }

        })
    }else{
        swal("El nombre es incorrecto!")

    }
}
function pintarProductosLista(idLista2){

    var datos = new FormData();
    datos.append("idLista2", idLista2);
    let plantilla = " ";
    $("#productos").html(plantilla);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            let obj = JSON.parse(respuesta);
            let plantilla = " ";
            if(obj.length > 0){
                
                obj.forEach(obj =>{
                    plantilla +='<tr>'
                    plantilla +='   <th scope="row">'
                    plantilla +='       <span class="custom-checkbox">'
                    plantilla +='           <input type="checkbox" id="checkbox1" name="options[]" value="1">'
                    plantilla +='           <label for="checkbox1"></label>'
                    plantilla +='       </span>'
                    plantilla +='   </th>'
                    plantilla +='   <td>'+obj.Nombre+'</td>'
                    plantilla +='   <td>'+obj.Cantidad+'</td>'
                    plantilla +='   <td>'
                    plantilla +='       <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" title="Edit"></i></a>'
                    plantilla +='       <a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="fa fa-trash-o" aria-hidden="true" data-toggle="tooltip" title="Delete"></i></a>'
                    plantilla +='   </td>'
                    plantilla +='</tr>'
                });
                $("#productos").html(plantilla);
              
            }
        }

    })
}
/********************************************************* 
 * METODO PARA ELIMINAR UNA LISTA DE LAS LISTAS CREADAS 
 * PASARLA A LA LISTA DE PAPELERA
 *********************************************************/
$(".listDelete").click(function(e){
    e.preventDefault();
    var select = document.querySelector('.follow-us');
    var idListaDelete = select.querySelectorAll("a.listDelete");
    var idListaDelete = this.id;
    var datos = new FormData();
    datos.append("idListaDelete", idListaDelete);
    datos.append("estado", 2);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta == "ok"){
                
                    swal({
                        title: "¡SU LISTA HA SIDO BORRADA TEMPORALMENTE!",
                        text: "¡Puede recuperarla o eliminarle definitivamente en el panel papelera !",
                        type: "error",
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    },

                        function(isConfirm){
                            if(isConfirm){
                                window.location = localStorage.getItem("rutaActual");
                            }
                });

            }
            
        }

    })

})
/********************************************************* 
 * METODO PARA RECUPERAR UNA LISTA DE LAS LISTAS DE PAPELERA 
 * Y PASARLA A MIS LISTA CREADAS
 *********************************************************/
$(".recuperarlista").click(function(e){
    e.preventDefault();
    var select = document.querySelector('.follow-us');
    var idListaRecuperar = select.querySelectorAll("a.recuperarlista");
    var idListaRecuperar = this.id;
    var datos = new FormData();
    datos.append("idListaDelete", idListaRecuperar);
    datos.append("estado", 1);
    swal({
        title: "¡TU LISTA ESTA A PUNTO DE SER RECUPERADA!",
        text: "Una vez culmine el proceso puedes ver tu lista recuperada en el panel de mis listas creadas",
        type: "success",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Recuperar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false,
        closeOnCancel: false

    },

        function(isConfirm){
            if(isConfirm){
                $.ajax({
                    url:rutaOculta+"ajax/lista.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(respuesta){
                        if(respuesta == "ok"){
                            swal("BUEN TRABAJO!", "Tu lista fue recuperada con éxito.!", "success")
                            setTimeout(function () {
                                window.location = localStorage.getItem("rutaActual");
                                
                              }, 1000);
                            
                        }
                    }
                })
               
            }else {
                swal("¡LA RECUPERACIÓN DE LA LISTA FUE CANCELADO!"," ",  "error");
              }
    });
})

/*****************************************************************
 * METODO PARA CONSULTAR TODAS LAS LISTAS ACTIVAS DE UN USUARIO
 *****************************************************************/
function actualizarListasUsuario(){
    var item1 = "Persona_idPersona";
    var item2 = "listaCompra_idListaCompra";
    var valor1 = idUsuario;
    var valor2 = "1";
    var datos = new FormData();
    datos.append("item1", item1);
    datos.append("item2", item2);
    datos.append("valor1", valor1);
    datos.append("valor2", valor2);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            let obj = JSON.parse(respuesta);
            let plantilla = " ";
            plantilla +='<div class="col-lg-9 col-md-9 col-sm-10 col-xs-12 text-center" id="infoListas">' 
            plantilla +='<div class="p-3 mb-2 titiloInf"><i class="fa fa-list"></i> Mis listas creadas</div>'
            plantilla +='<div class="row">'
            obj.forEach(obj =>{
                plantilla +='<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 text-center" id="infoListas">'
                plantilla +='    <div class="cnt-block equal-hight" style="height: 220px;">'
                plantilla +='        <figure><img src="'+rutaOculta+'vistas/img/usuario/listas-de-verificacion1.png" class="img-responsive" alt=""></figure>'
                plantilla +='        <h3>'+obj.nombreLista+'</h3>'
                plantilla +='        <ul class="follow-us clearfix">'
                plantilla +='            <li><span data-toggle="tooltip" title="Comparar lista"><a href="#"><i class="fa fa-refresh" aria-hidden="true"></i></a> </span></li>'
                plantilla +='            <li><span data-toggle="tooltip" title="Ver y editar lista"><a class="listEditView" href="#" id='+obj.idListaCompra+'><i class="fa fa-eye" aria-hidden="true"></i></a></li>'
                plantilla +='            <li><span data-toggle="tooltip" title="Compartir lista"><a href="#" value='+obj.nombreLista+'><i class="fa fa-share-alt" aria-hidden="true"></i></a></li>'
                plantilla +='            <li><span data-toggle="tooltip" title="Elimirar lista"><a class="listDelete" href="#"  id='+obj.idListaCompra+'><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>'
                plantilla +='            <li><span data-toggle="tooltip" title="Programar lista"><a href="#"><i class="fa fa-calendar" aria-hidden="true"></i></a> </span></li>'
                plantilla +='        </ul>'
                plantilla +='    </div>'
                plantilla +='</div>'
            });
            plantilla +='</div>'
            plantilla +='</div>'
            plantilla +='</div>'
            $(".listasfullC").hide();
            $(".ListasActualizadas").html(plantilla);
        }

    })
}
/*****************************************************************
 * METODO PARA CONSULTAR TODAS LAS LISTAS BORRADAS DE UN USUARIO
 *****************************************************************/
/*function actualizarListasBorradas(){
    var item1 = "Persona_idPersona";
    var item2 = "listaCompra_idListaCompra";
    var valor1 = idUsuario;
    var valor2 = "2";
    var datos = new FormData();
    datos.append("item1", item1);
    datos.append("item2", item2);
    datos.append("valor1", valor1);
    datos.append("valor2", valor2);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            let obj = JSON.parse(respuesta);
            let plantilla = "";
            if(obj.length > 0){
                
                obj.forEach(obj =>{
                    plantilla +="<li> hola</li>"
                  // console.log(obj.Persona_idPersona);
                 // console.log(obj.nombreLista);
                });
                $("#listasdeletes").html(plantilla);
                $(".listasborradasC").hide();
                $("#listasdeletes").show();
              
            }else{

            }
            
        }

    })
}*/