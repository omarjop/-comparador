<?php
require_once "../controladores/c_usuarios.php";
require_once "../modelos/m_usuarios.php";

$fecha= date("Y-m-d H:i:s");
class   AjaxUsuario{
    	
    public $validarEmail;

  /**   $fechaActual = date('d-m-Y H:i:s');*/

    public function ajaxValidarEmail(){
        $datos = $this->validarEmail;
        $respuesta = ControladorUsuarios::ctrlMostrarUsuario("correo", $datos);
        echo json_encode($respuesta);
    }
    /**
     * 
     * RESGISTRO CON FACEBOOK
     */

     public $email;

     public function ajaxRegistroFacebook(){

        $datos = array("perfil"=>1,
                        "email"=>$this->email,
                        "clave"=>"null",
                        "verificacion"=>0,
                        "modoAcceso"=>"facebook",
                        "fechaRegistro"=>"00:00:00",
                        "emailEncriptado"=>"null");

        $respuesta = ControladorUsuarios::ctrlResgistroRedesSociales($datos);
        echo $respuesta;
     }

}
/**
 * VALIDA USUARIO EXISTENTE
 */
if(isset($_POST["validarEmail"])){  
    $valEmail = new AjaxUsuario();
    $valEmail -> validarEmail = $_POST["validarEmail"];
    $valEmail ->ajaxValidarEmail();
}

/**
 * REGISTRO COIN FACEBOOK
 */
if(isset($_POST["email"])){
    $regFacebook = new AjaxUsuario();
    $regFacebook -> email = $_POST["email"];
    $regFacebook ->ajaxRegistroFacebook();   
}