<?php
class ControladorProductos{
    
    static public function CtrlMostrarCategorias( $item, $valor){
        $tabla = "categoria";
        $respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

}