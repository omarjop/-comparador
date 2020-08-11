<?php
/**se incluyen los controladores */
require_once "controladores/rutas/c_rutasGenerales.php";
require_once "controladores/registrarLogs/c_trabajo_con_logs.php";
require_once "controladores/c_adjuntarArchivo.php";
require_once "controladores/c_tiendaProductos.php";
require_once "controladores/c_plantilla.php";
require_once "controladores/estructuras/estructuras.php";
require_once "../AdminComparador/controladores/prueba.php"; // asi se incluye controlador desde otro controlador
require_once "vistas/generales/modelGeneral.php";
require_once "PHPExcel/Classes/PHPExcel.php";

$plantilla =  new ControladorPlantilla();
$plantilla -> plantilla();
