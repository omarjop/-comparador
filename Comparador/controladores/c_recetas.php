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

   static public function ctrlMostrarRecetasPorCategoria($item1, $item2, $item3, $value1){

        $tabla1 = "recetas";
        $tabla2 = "categoria";
        $respuesta = ModeloReceta::ctrlMostrarRecetasPorCategoria($tabla1, $tabla2, $item1, $item2, $item3, $value1);
        return $respuesta;

    }

}