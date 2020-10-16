<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddproduct colorbotonamarillo" >Agregar Producto</button>
            </ol>
                         <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">                           
                                       
                                            <!-- Message Start -->
                                                <div class="media">
                                                      <img src="../AdminComparador/imagenes_productos/Producto.png" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                                                      <div class="media-body">
                                                            <h3 class="dropdown-item-title">
                                                              <?php echo "Producto";?>
                                                              <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                                            </h3>                                                       
                                                       </div>
                                                </div>
                                            <!-- Message End -->
                                         
                                      
                         </div> 
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscadorproducto">
                        <input type="search" name="buscaproductos" id="buscaproductos" class="form-control"  placeholder="Buscar Productos">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupamarca" type="submit" name="lupaproducto" id="lupaproducto" style ="height:100%;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
              </div>
             </form>


           </div>

                                


          </div><!-- /.col -->






                <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
