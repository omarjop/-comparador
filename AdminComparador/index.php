<?php

require_once "controladores/c_plantilla.php";
require_once "controladores/c_select_int_tables.php";
require_once("modelos/m_select_all_tables.php");
require_once("modelos/m_insert_tables.php");

$plantilla =  new ControladorPlantilla();
$plantilla -> plantilla();



