<?php
/**se incluyen los controladores */
require_once "controladores/rutas/c_rutasGenerales.php";
require_once "controladores/registrarLogs/c_trabajo_con_logs.php";
require_once "controladores/productos/c_adjuntarArchivo.php";
require_once "controladores/productos/c_tiendaProductos.php";
require_once "controladores/c_plantilla.php";
require_once "controladores/estructuras/estructuras.php";
require_once "../AdminComparador/controladores/c_select_int_tables.php"; // asi se incluye controlador desde otro controlador
require_once("../AdminComparador/modelos/m_select_all_tables.php");
require_once "../AdminComparador/controladores/c_insert_in_tables.php"; // asi se incluye controlador desde otro controlador
require_once("../AdminComparador/modelos/m_insert_tables.php");
require_once "../AdminComparador/controladores/c_tiendas.php";
require_once "vistas/generales/modelGeneral.php";
require_once "PHPExcel/Classes/PHPExcel.php";

//cuando la tienda inicie session debe llamar el controlador $plantilla =  new ControladorPlantilla();

$objTiendaInicial =  new Tiendas();
$objTiendaInicial->setIdEmpresa("1");
$objTiendaInicial->setNombreEmpresa("Empresa de prueba");
$objTiendaInicial->setNitEmpresa("5555");
$plantilla =  new ControladorPlantilla();
$valor = "prueba de objeto";
$plantilla -> plantilla($objTiendaInicial);


