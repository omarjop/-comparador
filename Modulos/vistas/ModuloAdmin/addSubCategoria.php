
<?php 
$resultado=null;
 $result = ControladorSelectsInTables:: selectTodosRegistros("categoria");


  //--Boton del modal de agregar unidad, crea objeto de la clase categoria_idCategoriaador
if(isset($_POST["btnaddsubcategoria"])){                           
    $objAdminAgregar  = new ControladorAdminInsert();
    $valorsubcategoria = $_POST["addsubcategoria"]; 
    $valorcategoria_idCategoria= $_POST["selectCategoria"];
    $valorRuta=str_replace(' ', '', $valorsubcategoria);
    $objAdminAgregar->agregarCampossubcategoria("subcategoria","categoria_idCategoria",$valorcategoria_idCategoria,"nombre",$valorsubcategoria,"ruta",$valorRuta);
   }  

//--Boton del modal de eliminar , crea objeto de la clase categoria_idCategoriaador
if(isset($_POST["btneliminarCateg"])){                           
     $objAdminEliminar  = new ControladorAdminEliminar();
     $valorUnidElim = $_POST["campoOculto2"]; 
     $resultadoEliminar=$objAdminEliminar->eliminarCampo($valorUnidElim,"subcategoria","idsubCategoria");  
        if($resultadoEliminar=="Exitoso"){
           echo "<script>toastr.info('Subcategor&iacute;a eliminada exitosamente');</script>";                              
         }else{
           echo "<script>toastr.error('Error al eliminar la subcategor&iacute;a, por favor intente nuevamente);</script>";                             
         }    
    
    } 
 //--Boton del modal de editar, crea objeto de la clase categoria_idCategoriaador
if(isset($_POST["btnEditarsubcategoria"])){                           
     $objAdminModificar  = new ControladorAdminModificar();
     $idUnidadModif = $_POST["idsubCategoria"];
     $valorsubcategoriaes = $_POST["subcategoriaEdit"];  
     $valorcategoria_idCategoriaModif = $_POST["selecategoria_idCategoria2"]; 
     $resultadoModificar=$objAdminModificar->modifDosCampos("subcategoria","idsubCategoria","nombre",$valorsubcategoriaes,$idUnidadModif,"categoria_idCategoria",$valorcategoria_idCategoriaModif);
                                                                                                            
      
        
    }                      

//-- Al entrar se visualizan todas las unidades existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("subcategoria");

  
//--Boton lupa consulta unidad

if(isset($_POST["lupaCategoria"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorsubcategoria = $_POST["buscaCategoria"]; 
            $resultado=$objAdminSelecciona->buscaTabla($valorsubcategoria,"subcategoria","*","nombre");
       
             if ($resultado==null){
               echo "<script>toastr.warning('La subcategor&iacute;a no existe');</script>"; 
             }
    } 
?>

<script type="text/javascript">
/*Validación del campo de texto de agregar */
  function validarFormulario(formulario){
       var subcategoriaval = formulario.addsubcategoria.value;
       var selecategoria_idCategoriaCat = formulario.selectCategoria.value;
        if(validarNombreAndUnidad(subcategoriaval,"No es una subcategor&iacute;a v&aacute;lida","addsubcategoria")==true &&
           validarUnidadAndRango(subcategoriaval,"El nombre de la subcategor&iacute;a es muy extenso","addsubcategoria")==true){
              
               if(validarNombreAndSelec(selecategoria_idCategoriaCat,"Seleccione una opci&oacute;n de categor&iacute;a","selectCategoria")==true ){
                  return true;
               }else{
                   return false;     
               }
        }else{
            return false;
        }
 
        
        
  return true;
 }
 //---------------------------------------------------------
   function validarFormulario2(formulario){
       var subcategoriavalEdi = formulario.subcategoriaEdit.value;
       var selesubcategoriaEditar = formulario.selecategoria_idCategoria2.value;
        if(validarNombreAndUnidad(subcategoriavalEdi,"No es una subcategor&iacute;a v&aacute;lida","subcategoriaEdit")==true &&
           validarUnidadAndRango(subcategoriavalEdi,"El nombre de la subcategor&iacute;a es muy extenso","subcategoriaEdit")==true){
              
               if(validarNombreAndSelec(selesubcategoriaEditar,"Seleccione una opci&oacute;n de categoria_idCategoria","selecategoria_idCategoria2")==true ){
                  return true;
               }else{
                   return false;     
               }
        }else{
            return false;
        }
 
        
        
  return true;
 }       
 //------funciones de validacion de cada uno de los campos
 function validarNombreAndUnidad(valor,mensaje,campoForm){
      
         if ((isNaN(parseInt(valor)))&& (valor !="")){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
     } 

 }
  //------funciones de validacion de cada uno de los campos
 function validarUnidadAndRango(valor,mensaje,campoForm){
      
         if ((valor.length) > 50){
              
              toastr.error(mensaje);
              return false;
         }else{       

             return true;
     } 

 }
 //**********************************************************************/
    
 //------funciones de validacion del select categoria_idCategoria al adicionar
 function validarNombreAndSelec(valor,mensaje,campoForm){
      
         if (valor !="seleccion"){
              return true;
         }else{       
             toastr.error(mensaje);
             
             return false;
     } 

 }
//--------------------------------------------------------------------------------
var returnValue = true;
//validar que no exista el registro con accion de boton
 $(function(){
     $("#btnaddsubcategoria").click(function(){
    
            var nombreAddsubcategoria = $("#addciudad").val();
            var nombreAddCategoria = $("#selectCategoria").val();
            //alert(addCategoriaValue);
            var datos = new FormData();
            datos.append("nombreAddsubcategoria",nombreAddsubcategoria);
            datos.append("nombreAddCategoria",nombreAddCategoria);
         
            $.ajax({
                    url:"http://localhost/-comparador/Modulos/ajax/validacion.ajax.php",
                    method:"POST",
                    data: datos, 
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success: function(respuesta){
                          if(respuesta.includes("No existe")){
                              $(".alert").remove();
                              returnValue = true;    
                      
                          }else{
                              
                              toastr.error("La ciudad se encuentra registrada");
                              returnValue = false;             
                          }


                    }

              })

            return returnValue;

        })
});

//**********************************************************************/
//
//**********************************************************************/
//--------------------------------------------------------------------------------------------

</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Admin. Subcategor&iacute;as</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddsubcategoria colorbotonamarillo" >Agregar subcategoria 
                </button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-5 col-md-7 col-sm-9 col-xs-8 " id="buscadormarca"  >
                        <input type="search" name="buscaCategoria" id="buscaCategoria" class="form-control"  placeholder="Buscar categorias"  style ="height:500%;>
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupaCategoria" type="submit" name="lupaCategoria" id="lupaCategoria" style ="height:100%;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
              </div>
             </form>
              </div>
          </div><!-- /.col -->

       <?php
          if ($resultado!= null && $resultado!= "Fallo" ){
            for ($i=0;$i<count($resultado);$i++){
             
        ?> 
            <ul class="list-group list-group-flush">
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["nombre"];?>
                  <a href="#"><p style ="position: absolute; right: 10; top:20;" data-placement="top" data-toggle="tooltip" title="Editar"><span nombsubcategoria = "<?php echo $resultado[$i]["nombre"];?>" id = "<?php echo $resultado[$i]["idsubCategoria"];?>" idcategoria_idCategoria="<?php echo $resultado[$i]["categoria_idCategoria"];?>" class="fas fa-pen-alt editar"></span></p></a> 
                  <a href="#"><p style ="position: absolute; right: 40; top:20;" data-placement="top" data-toggle="tooltip" title="Eliminar"><span etiqueta = "<?php echo $resultado[$i]["nombre"];?>" id = "<?php echo $resultado[$i]["idsubCategoria"];?>" class="far fa-trash-alt eliminar"></span></p></a>          
              </li>

            </ul>
       <?php  } }?> 
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->



      </div><!-- /.container-fluid -->
    </div>

      <!-- categoria_idCategoria Sidebar -->
  <aside class="categoria_idCategoria-sidebar categoria_idCategoria-sidebar-dark">
    <!-- categoria_idCategoria sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
  
</div>

<script type="text/javascript">

/*LLama el modal de adicionar*/ 
 $(function(){
     $(".botaddsubcategoria").click(function(){

         $("#modaddsubcategoria").modal("show");  
      });
 });
  /*LLama el modal de editar */ 
 $(function(){
     $(".editar").click(function(){
         $(".idsubCategoria").attr('value',$(this).attr('id'));
         $(".subcategoriaEdit").attr('value',$(this).attr('nombsubcategoria'));   
         $("#modifisubcategoria").modal("show");
         document.getElementById("selecategoria_idCategoria2").value=$(this).attr('idcategoria_idCategoria');
         
      });
  });    
  $(function(){
    $(".eliminar").click(function(){
         $(".campoOculto").attr('value',$(this).attr('id'));
         document.getElementById("etiquetaEliminar").innerHTML= $(this).attr('etiqueta'); 
         $("#eliminarCateg").modal("show");  

      });
  });

</script>

  <!-- Modal para agregar nueva ciudad -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddsubcategoria" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar Subcategoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addsubcategoria" name ="addsubcategoria" placeholder="Agregue Subcategoria" >  
                   </div>
                   <div class="modal-body">
                    <select class="form-control" onChange="mostrar(this.value);" id ="selectCategoria" name="selectCategoria"  required><option value = "seleccion">Seleccione Categoria</option>
                               <?php for($i=0;$i<count($result);$i++){?>
                               <option value="<?php echo $result[$i]["idCategoria"]; ?>"><?php echo $result[$i]["nombre"]; ?></option> 
                               <?php }?> 
                       </select>
                     </div>                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddsubcategoria" id = "btnaddsubcategoria" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>



 <!-- Modal que muestra el confirmar cuando se elimina  -->
 <form class="form needs-validation" method="post"  enctype="multipart/form-data">
        <div class="modal fade" id="eliminarCateg" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D64646;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Esta seguro que desea eliminar la subcategor&iacute;a? </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">

                   <div class="row">
                                <div class="col-sm-12">
                                   <div class="card" style="background-color: #E5E5E5;font-size:140%;">
                                      <div class="card-body">                                          
                                          <footer class="" style="font-size:110%;"><cite title="Source Title" id="etiquetaEliminar"></cite> </footer>                                                              
                                      </div>
                                </div>
                                </div>
                         </div>

                    <!-- aqui va el mensaje que se pasa por parametro-->
                     <input  style="visibility: hidden;" type="text" value ="" class="campoOculto form-categoria_idCategoria" id="campoOculto2" name ="campoOculto2">               
                       
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btneliminarCateg" id = "btneliminarCateg" class="btn btn-secondary"style ="background-color: #D64646;width:48%;">Aceptar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form> 

    <!-- Modal que muestra la unidad de medida al dar click en el boton de editar -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario2(this);"novalidate>
        <div class="modal fade" id="modifisubcategoria" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true" >
          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Editar Subcategor&iacute;a </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>           
                        <!-- aqui va el mensaje que se pasa por parametro-->
                    <div class="modal-body mx-3">
                        <div class="modal-body mx-3 ">
                            <input   type="text" value ="" placeholder="Nombre Unidad" class="form-categoria_idCategoria subcategoriaEdit" id="subcategoriaEdit" name ="subcategoriaEdit" required>  
                       </div> 
                      </div>      
                      <div class="modal-body mx-3">       
                      <select class="form-categoria_idCategoria" onChange="mostrar(this.value);" id ="selecategoria_idCategoria2" name="selecategoria_idCategoria2"  required><option value = "seleccion">Seleccione categoria_idCategoria</option>
                               <?php for($i=0;$i<count($categoria_idCategoriaNumerico);$i++){?>
                               <option value="<?php echo $categoria_idCategoriaNumerico[$i]; ?>"><?php echo $categoria_idCategoriaCaracter[$i]; ?></option> 
                               <?php }?> 
                       </select>                                             
                    <input   style="visibility: hidden;" type="text" value ="" placeholder="ID" class="form-categoria_idCategoria idsubCategoria" id="idsubCategoria" name ="idsubCategoria"> 
                   </div>  
                    <div class="form-group">  
                          <div class="modal-footer d-flex justify-content-center">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnEditarsubcategoria" id = "btnEditarsubcategoria" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Guardar</button>
                          </div>
                    </div>         
          </div>   
        </div>
      </div> 
  </form>