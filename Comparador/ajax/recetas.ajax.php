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
    public function ajaxConsultarComentariosXReceta($idRecetaValue){
           $item3 = "Recetas_idRecetas";
           $respuesta = ControladorRecetas::ajaxConsultarComentariosXReceta($item3,$idRecetaValue);
           echo  json_encode ($respuesta);
	}
    public function ajaxAddComentario($comentario,$idRecetaComment,$idPersona){
           $respuesta = ControladorRecetas::ctrlRegistroComentarios($comentario,$idRecetaComment,$idPersona);
           echo ($respuesta);
	}
    public function ajaxValidarPalabraObcena($comentario){
        $respuesta = ControladorRecetas::ajaxValidarPalabraObcena($comentario);
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

if(isset($_POST["idComentarioXReceta"])){  
    $idReceta = new AjaxRecetas();
    $idRecetaValue = $_POST["idComentarioXReceta"];
    $idReceta ->ajaxConsultarComentariosXReceta($idRecetaValue);
}

if(isset($_POST["addComentario"])){  
    $idReceta = new AjaxRecetas();
    $comentario = $_POST["addComentario"];
    $idRecetaComment = $_POST["idRecetaComment"];
    $idPersona = $_POST["idPersona"];
    $idReceta ->ajaxAddComentario($comentario,$idRecetaComment,$idPersona);
}

if(isset($_POST["palabraObcena"])){
    $objReceta = new AjaxRecetas();
    $comentario = $_POST["palabraObcena"];
    $objReceta ->ajaxValidarPalabraObcena($comentario);
}