

<?php 
$resultado=null;
//-- Al entrar se visualizan todas las marcas existentes
 $objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAllMarca();

  //--Boton del modal de agregar marca, crea objeto de la clase controlador
if(isset($_POST["btnaddmarca"])){                           
            $objAdminAgregar  = new ControladorAdminInsert();
            $valorMarca = $_POST["addmarcas"]; 

               $objAdminAgregar->agregaMarca($valorMarca);
           
            
    } 
//--Boton lupa consulta marca

if(isset($_POST["lupamarca"])){                           
            $objAdminSelecciona  = new ControladorAdminSelect();
            $valorMarca = $_POST["buscamarcas"]; 
            $resultado=$objAdminSelecciona->buscaMarca($valorMarca);
       
             if ($resultado==null){
               echo "<script>toastr.warning('La marca no existe');</script>"; 
             }
    } 
?>

<script type="text/javascript">

  function validarFormulario(formulario){
       var marca = formulario.addmarcas.value;
        if(validarNombreAndMarca(marca,"No es una marca v&aacute;lida","addmarcas")!=true){
             return false;
		}
  return true;
 }
        
 //------funciones de validacion de cada uno de los campos
 function validarNombreAndMarca(valor,mensaje,campoForm){
      
         if (isNaN(parseInt(valor)) && (valor.length > 0)){
              return true;
         }else{       
             toastr.error(mensaje);
             document.getElementById(campoForm).value = "";
             return false;
		 } 
 }

</script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Crear Marca</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddmarca colorbotonamarillo" >Agregar Marca</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscadormarca">
                        <input type="search" name="buscamarcas" id="buscamarcas" class="form-control"  placeholder="Buscar Marca">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupamarca" type="submit" name="lupamarca" id="lupamarca">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
              </div>
             </form>
              </div>
          </div><!-- /.col -->

       <?php
           if ($resultado!= null){
            for ($i=0;$i<count($resultado);$i++){
             
        ?> 
            <ul class="list-group list-group-flush">
              <li class="list-group-item list-group-item-light"><?php echo $resultado[$i]["Descripcion"];?>
                  <span class="badge badge-primary badge-pill">2</span>
                  <span class="badge badge-primary badge-pill" style=" text-align: right;">2</span>
              </li>

            </ul>
       <?php } }?> 
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

      <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
<div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
  
</div>
<script type="text/javascript">

/*LLama el modal de adicionar marca*/ 
 $(function(){
     $(".botaddmarca").click(function(){
         $("#modaddmarca").modal("show");  
      });
  });

</script>

  <!-- Modal para agregar nueva marca -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data" onSubmit="return validarFormulario(this);"novalidate>
        <div class="modal fade" id="modaddmarca" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">

          <div class="modal-dialog">
           <div class="modal-content">
                 <div class="modal-header" style ="background-color: #D0A20E;color:#FFFFFF;" >
                        <h5  id="staticBackdropLabel" > Agregar Marca</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>
                   <div class="modal-body">
                       
                         <input   type="text" class="form-control" id="addmarcas" name ="addmarcas" placeholder="Agregue nombre de marca" >  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary " style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddmarca" id = "btnaddmarca" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>

