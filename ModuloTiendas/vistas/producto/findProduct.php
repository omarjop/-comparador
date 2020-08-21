  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Consultar Producto</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <?php for($i=0;$i<20;$i++){?>
              <div class="col-lg-3">
                        <div class="card" >
                              <div class="card-header">
                                <h5 class="m-0">Nombre producto</h5>
                              </div>
                              <img class="card-img-top" src="../AdminComparador/imagenes_productos/nohayProducto.jpg" alt="Card image cap"  >
                              <div class="card-body">
                                <h6 class="card-title">25000$</h6>
                                <p class="card-text">x 1000 g</p>
                                
                              </div>
                        </div>      
             
              </div>
         <?php }?>
          <!-- /.col-md-6 -->
          
		  
		  
		  
		  
		  
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->