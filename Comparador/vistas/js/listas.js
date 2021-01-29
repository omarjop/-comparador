
var idUsuario = $("#idUsuario").val();
var verLista= 0;
/********************************************** 
 * Controlando el menu izquierdo de
 **********************************************/
$(".listasFull").click(function(e){
    e.preventDefault();

    if(verLista == 1){
        location.reload();
        verLista = 0;
    }
    
    $(".listasborradasC").hide();
    $(".listaEditViewC").hide();
    $(".listasCompartidasD").hide();
    $(".listasRecetasR").hide();
    $(".listasfullC").show();
    $(".agragaProduct").hide(); 
})

$(".listasComp").click(function(e){
    e.preventDefault();
    $(".listasborradasC").hide();
    $(".listaEditViewC").hide();
    $(".listasfullC").hide();
    $(".listasRecetasR").hide();
    $(".listasCompartidasD").show();
    $("#ListasActualizadas").hide();
    $(".agragaProduct").hide(); 
})

$(".listasRecetas").click(function(e){
    e.preventDefault();
    $(".listasborradasC").hide();
    $(".listaEditViewC").hide();
    $(".listasfullC").hide();
    $(".listasCompartidasD").hide();
    $(".listasRecetasR").show();
    $(".agragaProduct").hide(); 
})

 $(".listasBorradas").click(function(e){
    e.preventDefault();
    $(".listasborradasC").show();
    $(".listaEditViewC").hide();
    $(".listasCompartidasD").hide();
    $(".listasRecetasR").hide();
    $(".listasfullC").hide();
    $(".agragaProduct").hide(); 
})

/********************************************** 
 * MULTIPLE SELECCION DEL LAS LISTAS
 * NO ESTA FUNCIONANDO 
 **********************************************/
$(document).ready(function(){
    
	// Select/Deselect checkboxes
    var checkbox = $("table tbody input[type='checkbox']");

	$(".table #selectAll").click(function(){
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
    $(".agragaProduct").hide(); 
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
            let plantilla2 = " ";
            plantilla +='<h2>'+obj.nombreLista+' <a onclick="activarFormulario(\''+obj.nombreLista+'\', '+obj.idListaCompra+')" id='+obj.idListaCompra+' class="btn cadena" data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true"></i></a></h2>'

            plantilla2 += ' <a onclick="activarFormularioProducto('+obj.idListaCompra+')" id='+obj.idListaCompra+' class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> <span>Agrara Producto</span></a>'
          //  plantilla2 += ' <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="fa fa-minus-circle"  aria-hidden="true"></i> <span>Eliminar</span></a>'					

            $("#nameList").html(plantilla);
            $("#botonesCabecera").html(plantilla2); 
            $(".listasfullC").hide();
            $(".listaEditViewC").show();
        }

    })
}

//************************************************************ */
//activa formilario para cambiar el nombre de la lista
//************************************************************ */
function activarFormulario(name, id){
    
    let plantilla = " ";
    plantilla += ' <form>'
    plantilla += '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">' 
    plantilla +=' <input type="text" class="form-control"  id="newNameList" name="newNameList" placeholder="" value="' + name + '" required="">'
    plantilla += '</div>'
    plantilla += '<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">' 
    plantilla +='<a onclick="pintarCabeceraLista(' + id + ')" class="btn btn-danger pull-left"><i class="fa fa-thumbs-o-down "  aria-hidden="true"></i>Cancelar</a>'
    plantilla +='<a onclick="cambiarNombreListaF('+ id +')" class="btn btn-success pull-left"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>Cambiar</a>'
    plantilla += '</div>'
    plantilla += ' <form>'
    $("#nameList").html(plantilla);
    
}
//************************************************************ */
//activa formilario para agragar productos a la Lista
//************************************************************ */
function activarFormularioProducto(idL){
    
    var idLis = idL;
    let plantilla = " ";
  //  plantilla += '<legend>Agregue productos a tu lista</legend>'
    plantilla += '<div class="col-lg-10 col-md-9 col-sm-12 col-xs-12">   ' 
    plantilla += '    <div class="input-group">'
    plantilla += '        <input id="inputEntidadesLst" list="productosSelect" name="inputEntidadesLst" type="text" class="form-control" placeholder="Nombre del producto Ej: Arroz Primor" autocomplete="on" required="" style="width: 390px;">'
    plantilla += '        <input id="cantidadProducto" name="cantidadProducto" type="text" class="form-control" placeholder="cantidad Ej: 2" autocomplete="on" required="" style="width: 156px;">'
    plantilla += '        <div class="input-group-btn">'
    plantilla += '        <button onclick="agregarProductoLista('+idLis+')" class="btn btn-success">'
    plantilla += '            <i class="fa fa-product-hunt"></i> Agregar'
    plantilla += '        </div>'
    plantilla += '    </div>'
    plantilla += '</div>'
    plantilla += '<div class="col-lg-2 col-md-9 col-sm-12 col-xs-12">'
    plantilla += '    <a onclick="ocultarFormularioProducto()" class="btn btn-info">¡Ya terminé !</a>'
    plantilla += '</div>'
    var datos = new FormData();
    datos.append("consultaProduct", idLis);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            let obj = JSON.parse(respuesta);
            
            if(obj.length > 0){
                plantilla += '<datalist id="productosSelect">'
                obj.forEach(obj =>{
                    plantilla += '<option data-ejemplo='+obj.idProducto+' value="'+obj.Nombre.toString()+'"></option> '
                });
                plantilla += '</datalist>'
                $("#AgregaProducto").html(plantilla);
            }
        }
    })
    $(".agragaProduct").show();  
    $(".alert").remove();
}
function ocultarFormularioProducto(){
    $(".agragaProduct").hide(); 
} 

function agregarProductoLista(idLis){

    $(".alert").remove();
    
    var namePrdouct = $("#inputEntidadesLst").val();
    var cantidadProduct = $("#cantidadProducto").val();
    var idProducto = $("#productosSelect").find('option[value="'+namePrdouct+'"]').data("ejemplo");
    

    if(typeof idProducto === 'undefined'){
        idProducto = 0;   
    }
    if(namePrdouct == "" || namePrdouct.length < 0 ){
        $("#AgregaProducto").parent().before('<div class="alert alert-info"><strong>ERROR:</strong>¡El nombre del producto es incorrecto!</div>');
        $("#inputEntidadesLst").css({"border":'1px solid #e08282be'});
        return false;
    }else{
        $("#inputEntidadesLst").css({"border":'1px solid #d8d8da'});
    }
    if(cantidadProduct == 0 || cantidadProduct.length > 3 || cantidadProduct == null || /^\s+$/.test(cantidadProduct) || isNaN(cantidadProduct)){
        $("#AgregaProducto").parent().before('<div class="alert alert-info"><strong>ERROR:</strong>¡La cantidad del producto es incorrecto!</div>');
        $("#cantidadProducto").css({"border":'1px solid #e08282be'});
        return false;
    }else{
        $("#cantidadProducto").css({"border":'1px solid #d8d8da'});
        var datos = new FormData();
        datos.append("idListaP", idLis);
        datos.append("nameProducto", namePrdouct);
        datos.append("idProcduto", idProducto);
        datos.append("cantidadProduct", cantidadProduct);
        datos.append("idusu", idUsuario);
        $.ajax({
             url:rutaOculta+"ajax/lista.ajax.php",
             method:"POST",
             data: datos, 
             cache: false,
             contentType: false,
             processData: false,
             success: function(respuesta){
                 if(respuesta=="ok1"){
                    $("#AgregaProducto").parent().before('<div class="alert alert-danger"><strong>ERROR:</strong>¡El Producto ya existe en tu Lista!</div>');
                 }else{
                   // toastr.info("hola");
                    $("#AgregaProducto").parent().before('<div class="alert alert-success"><strong>ERROR:</strong>¡El producto fue agregado a tu lista!</div>');
                    pintarProductosLista(idLis);
                    setTimeout(activarFormularioProducto,4000, idLis);
                 }
                
             }
        })
    }
    
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
                     // Ayuda a recargar una sola porcion de codigo obligatorio el espacio load(" #RecargarListas"); 
                  //  $("#RecargarListas").load(" #RecargarListas"); 
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
    datos.append("estadoProducto", 1); /*ESTADO 1 PARA LOS PRODUCTOS ACTIVOS EN LA LISTA */
    let plantilla = " ";
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
                    plantilla +='           <input type="checkbox" id="checkbox1" onclick="productoComprado('+obj.idproductosLista+','+idLista2+', 2)" name="options[]" value='+obj.idproductosLista+'>'
                    plantilla +='           <label for="checkbox1"></label>'
                    plantilla +='       </span>'
                    plantilla +='   </th>'
                    plantilla +='   <td>'+obj.nombreProducto+'</td>'
                    plantilla +='   <td>'+obj.cantidad+'</td>'
                    plantilla +='   <td>KG</td>'
                    plantilla +='   <td>'
                    plantilla +='       <a href="#editProducto"  data-toggle="modal"><i class="fa fa-pencil" aria-hidden="true" data-toggle="tooltip" title="Editar"></i></a>'
                    plantilla +='       <a onclick="eliminarProductoLista('+obj.idproductosLista+','+idLista2+')" class="delete" ><i class="fa fa-trash-o" aria-hidden="true" data-toggle="tooltip" title="Eliminar"></i></a>'
                    plantilla +='   </td>'
                    plantilla +='</tr>'
                   
                }); 
                $("#productos").html(plantilla);        
            }else{
             
                $("#productos").html(plantilla);   
            }
        }
    })

    var datos = new FormData();
    datos.append("idLista2", idLista2);
    datos.append("estadoProducto", 2); /*ESTADO 2 PARA LOS PRODUCTOS QUE ESTAN COMPRADO */

    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            let obj = JSON.parse(respuesta);
            let plantilla3 = " ";
            let plantilla2 = " ";
            if(obj.length > 0){
                
                plantilla2 +='<div class="comprado">'
                plantilla2 +='  <div class="row">'
                plantilla2 +='    <div class="col-lg-9 col-md-9 col-sm-6 col-xs-12">'
                plantilla2 +='        <h4>Productos comprados</h4>'
                plantilla2 +='   </div> '
                plantilla2 +='  </div>'
                plantilla2 +='</div>'
                $(".productosComprados").html(plantilla2); 
                obj.forEach(obj =>{
                   
                    plantilla3 +='<tr>'
                    plantilla3 +='   <th scope="row">'
                    plantilla3 +='      <a onclick="productoComprado('+obj.idproductosLista+','+idLista2+', 1)" ><i class="fa fa-check-square-o" aria-hidden="true" data-toggle="tooltip" title="Regresa a: ¡Por comprar!"></i></a>'
                    plantilla3 +='   </th>'
                    plantilla3 +='   <td>'+obj.nombreProducto+'</td>'
                    plantilla3 +='</tr>'
                   
                }); 
                $("#productosCompradosList").html(plantilla3);        
            }else{
                $(".productosComprados").html(plantilla2); 
                $("#productosCompradosList").html(plantilla3); 
            }
        }
    })
}
/********************************************************* 
 * METODO PARA CAMBIAR EL ESTADO DE UN PRODUCTO DE UNA LISTA 
 *********************************************************/
function eliminarProductoLista(idproductolistaeliminar, idLista2Actualizar){

    var datos = new FormData();
    datos.append("idproductolistaeliminar", idproductolistaeliminar);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta == "ok"){
                swal("Producto eliminado con éxito.", "")
                    setTimeout(function () {             
                }, 100);
                pintarProductosLista(idLista2Actualizar)
            }
        }
    })
}
/********************************************************* 
 * METODO PARA CAMBIAR EL ESTADO DE UN PRODUCTO DE UNA LISTA 
 *********************************************************/
function productoComprado(idproductoComprado, idListaProductoComprado, estadoProductoComprado){

    var datos = new FormData();
    datos.append("idproductoComprado", idproductoComprado);
    datos.append("idListaProductoComprado", idListaProductoComprado);
    datos.append("estadoProductoComprado", estadoProductoComprado);
    $.ajax({
        url:rutaOculta+"ajax/lista.ajax.php",
        method:"POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            if(respuesta == "ok"){
                pintarProductosLista(idListaProductoComprado)
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
                               location.reload();
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
                                location.reload();
                                
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
            window.location = localStorage.getItem("rutaActual");
        }

    })
}

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
