<?php
require_once "../controladores/c_usuarios.php";
require_once "../modelos/m_usuarios.php";

class   AjaxUsuario{

    public $validarEmail;

    public function ajaxValidarEmail(){
        $datos = $this->validarEmail;
        $respuesta = ControladorUsuarios::ctrlMostrarUsuario("correo", $datos);
        echo json_encode($respuesta);
    }
}
if(isset($_POST["validarEmail"])){
    $valEmail = new AjaxUsuario();
    $valEmail -> validarEmail = $_POST["validarEmail"];
    $valEmail ->ajaxValidarEmail();

   
}