  <div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Cargar Producto por Archivo </h1><a title="Descargar formato excel" href="<?php  $objFile =  new ControladorRutasGenerales(); echo $objFile->nombreArchivoExcel('No');?>" download="<?php  $objFile =  new ControladorRutasGenerales(); echo $objFile->nombreArchivoExcel('Si');?>" style="color: blue; font-size:18px;"> <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span> Descargar formato excel</a>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
          <!-- Carta con archivo adjunto dentro-->


                                            <?php
                                                include "vistas/generales/buttonAttach.php";
                                            ?>



      <!-- Carta con archivo adjunto dentro-->
    </div>
    <!-- /.content-header -->





  </div>

  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>