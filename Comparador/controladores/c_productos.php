<?php
class ControladorProductos{
    
    static public function CtrlMostrarCategorias( $item, $valor){
        $tabla = "tipotienda";
        $respuesta = ModeloProductos::mdlMostrarCategorias($tabla, $item, $valor);
        return $respuesta;
    }

}