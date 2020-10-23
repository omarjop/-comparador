<?php 
$resultado=null;

//-- Al entrar se visualizan todas las existentes
$objAdminSeleccionaTodos  = new ControladorAdminSelect();
$resultado=$objAdminSeleccionaTodos->buscarAll("marca");

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Administraci&oacute;n Tipo Empresa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <button type="button" class="btn btn-warning botaddmarca colorbotonamarillo" >Agregar Tipo Empresa</button>
            </ol>
            <form class="form needs-validation" method="post"  enctype="multipart/form-data">
             <div class="input-group col-lg-8 col-md-7 col-sm-9 col-xs-7" id="buscadormarca">
                        <input type="search" name="buscamarcas" id="buscamarcas" class="form-control"  placeholder="Buscar Tipo de Empresa">
                        <span  class="input-group-btn">
                            <a href="#">
                                <button class="btn btn-default backColor colorbotonamarillo lupamarca" type="submit" name="lupamarca" id="lupamarca" style ="height:100%;">
                                    <i class="fa fa-search"></i>
                                </button>
                            </a>
                        </span>
              </div>
             </form>
              </div>
          </div><!-- /.col -->


