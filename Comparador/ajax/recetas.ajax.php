<?php
require_once "../controladores/c_recetas.php";
require_once "../modelos/m_recetas.php";


class   AjaxRecetas{
    public function ajaxConsultarReceta($idRecetaValue){
           $item1 = "iddificultad";
           $item2 = "dificultad_iddificultad";
           $item3 = "idRecetas";
           $respuesta = ControladorRecetas::ctrlConsultarReceta($item1,$item2,$item3,$idRecetaValue);
           echo  json_encode ($respuesta);
	}
    public function ajaxConsultarProductoXReceta($idRecetaValue){
           $item3 = "Recetas_idRecetas";
           $respuesta = ControladorRecetas::ajaxConsultarProductoXReceta($item3,$idRecetaValue);
           echo  json_encode ($respuesta);
	}
}


if(isset($_POST["idReceta"])){  
    $idReceta = new AjaxRecetas();
    $idRecetaValue = $_POST["idReceta"];
    $idReceta ->ajaxConsultarReceta($idRecetaValue);
}

if(isset($_POST["idRecetaDos"])){  
    $idReceta = new AjaxRecetas();
    $idRecetaValue = $_POST["idRecetaDos"];
    $idReceta ->ajaxConsultarProductoXReceta($idRecetaValue);
}