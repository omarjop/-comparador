<?php


class ControladorRecetas{ 

  /**==========================================================
     METODO que retorna informacion entre el crece de tabla 
     categoria con recetas
  *==========================================================*/

  static public function ctrlMostrarRecetas($item1, $item2){

        $tabla1 = "categoria";
        $tabla2 = "recetas";
        $respuesta = ModeloReceta::mdlMostrarRecetas($tabla1, $tabla2, $item1, $item2);
        return $respuesta;

    }

   static public function ctrlMostrarRecetasPorCategoria($item1, $item2, $item3, $value1,$item4,$item5){

        $tabla1 = "recetas";
        $tabla2 = "categoria";
        $tabla3 = "dificultad";
        $respuesta = ModeloReceta::ctrlMostrarRecetasPorCategoria($tabla1, $tabla2, $item1, $item2, $item3, $value1,$item4,$item5,$tabla3);
        return $respuesta;

    }

    static public function ctrlConsultarReceta($item1,$item2,$item3,$idReceta){
        $tabla1 = "dificultad";
        $tabla2 = "recetas";
        $respuesta = ModeloReceta::ctrlConsultarReceta($tabla1,$tabla2,$item1,$item2,$item3,$idReceta);
        return $respuesta;
	}

    static public function ajaxConsultarProductoXReceta($item3,$idReceta){
        $tabla1 = "producto";
        $tabla2 = "Producto_has_Recetas";
        $respuesta = ModeloReceta::ajaxConsultarProductoXReceta($tabla1,$tabla2,$item3,$idReceta);
        return $respuesta;
	}

// metodos para rgistro y consulta de comentarios por receta
    static public function ctrlRegistroComentarios(){

          $datos = array(
             "idPersona"=>$_SESSION["id"],
             "idReceta"=>$_POST["idReceta"],
             "comentario"=>'<ul>'.$_POST["comentarioReceta"].'</ul>');

          $tabla= "comentariosrecetas";
          $respuesta = ModeloReceta::ctrlRegistroComentarios($tabla , $datos);

    }

    static public function ajaxConsultarComentariosXReceta($item3,$idReceta){
        $tabla1 = "comentariosRecetas";
        $respuesta = ModeloReceta::ajaxConsultarComentariosXReceta($tabla1,$item3,$idReceta);
        return $respuesta;
	}
   
}