<?php
require_once "../controladores/c_plantilla.php";
require_once "../modelos/plantilla_modelo.php";

class   AjaxPlantilla{

    public function ajaxEstiloPlantilla(){
        $respuesta = ControladorPlantilla::ctrlEstiloPlantila();
        echo json_encode($respuesta);
    }
}
$obj = new AjaxPlantilla();
$obj -> ajaxEstiloPlantilla();