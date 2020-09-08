<?php
/**se incluyen los controladores */
require_once "../AdminComparador/controladores/rutas/c_rutasGenerales.php";
require_once "../AdminComparador/controladores/registrarLogs/c_trabajo_con_logs.php";
require_once "controladores/ModuloTiendas/productos/c_adjuntarArchivo.php";
require_once "controladores/ModuloTiendas/productos/c_tiendaProductos.php";
require_once "controladores/c_plantilla.php";
require_once "controladores/ModuloTiendas/productos/c_elimarEditarProducto.php";
require_once "../AdminComparador/controladores/estructuras/estructuras.php";
require_once "../AdminComparador/controladores/c_select_int_tables.php"; // asi se incluye controlador desde otro controlador
require_once("../AdminComparador/modelos/m_select_all_tables.php");
require_once("../AdminComparador/modelos/m_update_delete_tables.php");
require_once "../AdminComparador/controladores/c_insert_in_tables.php"; // asi se incluye controlador desde otro controlador
require_once("../AdminComparador/modelos/m_insert_tables.php");
require_once "../AdminComparador/controladores/c_tiendas.php";
require_once "../AdminComparador/controladores/c_update_delete_in_tables.php";
require_once "vistas/generales/modelGeneral.php";
require_once "PHPExcel/Classes/PHPExcel.php";
require_once "controladores/ModuloTiendas/productos/c_findProductos.php";

//cuando la tienda inicie session debe llamar el controlador $plantilla =  new ControladorPlantilla();
//llega el id del usuario por get y con el consulto en base de datos y creo objeto tienda y usuario si lo tiene y envcio los dos
//objetos

$objTiendaInicial =  new Tiendas();
$objTiendaInicial->setIdEmpresa("1");
$objTiendaInicial->setNombreEmpresa("Empresa de morita");
$objTiendaInicial->setNitEmpresa("5555");
$objTiendaInicial->setIdCategoria("1");
$plantilla =  new ControladorPlantilla();
$valor = "prueba de objeto";

/*
   se envia el tipo de usuario en  una variable donde se definio que 1 es tienda ojo validar eso
*/
$tipoUser = 1;
$plantilla -> plantilla($objTiendaInicial,$tipoUser);


