<?php
/**se incluyen los controladores */
require_once "controladores/c_plantilla.php";
require_once "controladores/c_servicios.php";
require_once "controladores/c_slider.php";
require_once "controladores/c_productos.php";
require_once "controladores/c_usuarios.php";
require_once "controladores/c_listas.php";

/**se incluyen los Modelos */
require_once "modelos/rutas.php";
require_once "modelos/m_productos.php";
require_once "modelos/m_usuarios.php";
require_once "modelos/m_listas.php";

require_once "PHPMailer/PHPMailerAutoload.php";

$plantilla = new ControladorPlantilla();
$plantilla ->plantilla();