 <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 colormenuprincipal">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="vistas/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light"><?php echo $objTiendaInicial->getNombreEmpresa();?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div >
        
      </div>
	  
<!-- Sidebar Menu desplegable-->
  <?php if($tipoUser==1){?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa fa-cube"></i>
              <p class="colortexto">
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            
              <li class="nav-item">
                <a href="producto" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear Producto</p>
                </a>
              </li>
            
               <li class="nav-item">
                <a href="attachFileProduct" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cargar Archivo Excel</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="asociarProductos" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Asociar Productos</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="connectByApiRest" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cargar por API REST</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="findProduct" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar Producto</p>
                </a>
              </li>
			  
            </ul>
          </li>
		  
<!-- Segunda opcion azul del menu desplegalble sucursales-->		  
		    <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class="colortexto">
                Sucursales
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Activar sucursal</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis sucursales</p>
                </a>
              </li>
            </ul>
          </li>
		  
<!-- Segunda opcion azul del menu desplegalble Publicidad-->		  
		    <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p class="colortexto">
                Publicidades
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Activar publicidad</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mis publicidades</p>
                </a>
              </li>
            </ul>
          </li>		  
		  
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Reportes
                <span class="right badge badge-danger">Ver</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
	  
	    <?php }?>


<!-- desde aqui comienza el menu de administrador-->

<?php if($tipoUser==2){?>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa fa-cube"></i>
              <p class="colortexto">
                Administracion
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="addCategorias" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categorias</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addCiudad" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ciudad</p>
                </a>
              </li>  
             <li class="nav-item">
                <a href="addDia" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dia Calendario</p>
                </a>
              </li>  
               <li class="nav-item">
                <a href="addDificultad" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dificultad</p>
                </a>
              </li>  
                                              
              <li class="nav-item">
                <a href="addmarca" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Marcas</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addPais" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pais</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="addPesoVolum" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Peso/Volumen</p>
                </a>
              </li>        
              <li class="nav-item">
                <a href="addPerfil" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Perfil</p>
                </a>
              </li>  
                <li class="nav-item">
                <a href="addPersona" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Personas</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="addNewProductAdmin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Productos</p>
                </a>
              </li>   
               <li class="nav-item">
                <a href="addRecetas" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Recetas</p>
                </a>
              </li>  
              <li class="nav-item">
                <a href="addSubCategoria" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subcategoria</p>
                </a>
              </li>        
              <li class="nav-item">
                <a href="addTipoEmpresa" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipo Empresa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addTipoPago" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipo Pago</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="addTipoProducto" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipo Producto</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="adUnidadMedida" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Unidad Medida</p>
                </a>
              </li>         
               <li class="nav-item">
                <a href="addUsuario" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Usuarios</p>
                </a>
              </li>    
            </ul>
          </li>
                    
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Reportes
                <span class="right badge badge-danger">Ver</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
	  
	    <?php }?>
	  
	  
	  
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>