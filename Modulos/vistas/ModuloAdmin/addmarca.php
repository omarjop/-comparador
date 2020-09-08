<?php   
if(isset($_POST["btnaddmarca"])){                           
            $objAdminAgregar  = new ControladorAdminInsert();
            $valorMarca = $_POST["addmarcas"]; 

               $objAdminAgregar->agregaMarca($valorMarca);
           
            
    }  
?>

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
              <button type="button" class="btn btn-warning botaddmarca" >Agregar Marca</button>
            </ol>
          </div><!-- /.col -->
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


<script type="text/javascript">



/*LLama el modal de adicionar marca*/ 
 $(function(){
     $(".botaddmarca").click(function(){
         $("#modaddmarca").modal("show");  
      });
  });

</script>


  <!-- Modal para agregar nueva marca -->
  <form class="form needs-validation" method="post"  enctype="multipart/form-data">
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
                        <!-- aqui va el mensaje que se pasa por parametro-->
                         <input   type="text" class="form-control" id="addmarcas" name ="addmarcas" placeholder="Agregue nombre de marca">  
                   </div>
                  
                    <div class="form-group">  
                          <div class="modal-footer">         
                                <button type="submit" class="btn btn-secondary" style ="width:48%;"data-dismiss="modal">Cancelar</button>            
                                <button type="submit" name = "btnaddmarca" id = "btnaddmarca" class="btn btn-secondary colorbotonamarillo"style ="width:48%;">Agregar</button>
                          </div>
                    </div>
            </div>
          </div>   
        </div>
  </form>
