<?php


class ControladorAdminSelect{
        public function buscaTabla($valorConsultar,$tabla,$columnaRetorna,$columnaCompara){
                 
           $objAdminSeleccionar  = new ControladorSelectsInTables();
           $valorConsultar = "'%".$valorConsultar."%'";
           $sql= "select ".$columnaRetorna." from ".$tabla." where ".$columnaCompara."  LIKE ".$valorConsultar;
           $resultado = $objAdminSeleccionar->selectARowsInDb($sql);

            return $resultado;
         }
         public function buscarAll($tabla){
                 
           $objAdminSeleccionar  = new ControladorSelectsInTables();
           $sql= "select  * from ".$tabla."";
           $resultado = $objAdminSeleccionar->selectARowsInDb($sql);
           return $resultado;
         }

          public function consultaPrevia($valorConsultar,$tabla,$columnaCompara){
                 
           $objAdminSeleccionar  = new ControladorSelectsInTables();
           //$valorConsultar = "'$valorConsultar'";
           $sql= "select * from ".$tabla." where ".$columnaCompara." =".$valorConsultar;
           $resultado = $objAdminSeleccionar->selectARowsInDb($sql);

            return $resultado;
         }



     

    //----------------------Inicio Administración Recetas-----------------------------------------------------
    static public function ctrlConsultaDificultad(){

        $tabla = "dificultad";
        $respuesta = ModeloAdminReceta::mdlMostrarRecetas($tabla);
        return $respuesta;

    }

    static public function ctrlConsultaCategoriaReceta(){

        $tabla = "categoria";
        $control = 1;
        $campo = "control";
        $respuesta = ModeloAdminReceta::mdlMostrarCategoriaRecetas($tabla,$campo,$control);
        return $respuesta;

    }

    static public function ctrlMostrarRecetaXId($idReceta){
        $tabla = "recetas";
        $campo = "idRecetas";
        $respuesta = ModeloAdminReceta::mdlMostrarRecetaXId($tabla,$campo,$idReceta);
        return $respuesta;          
	}

    static public function ctrlFindRecetaInDBXIdJoin($idReceta){
        $tabla = "recetas";
        $campo = "idRecetas";
        $tabla2 = "dificultad";
        $campo2 = "iddificultad";
        $respuesta = ModeloAdminReceta::mdlFindRecetaInDBXIdJoin($tabla,$campo,$tabla2,$campo2,$idReceta);
        return $respuesta;          
	}


    static public function ctrlMostrarProductos($idReceta){
        $tabla = "producto";
        $columna = "idProducto";
        $tabla2 = "producto_has_recetas";
        $columna2 = "Producto_idProducto";
        $columna3 = "Recetas_idRecetas";

        $respuesta = ModeloAdminReceta::mdlMostrarProductos($tabla,$columna,$tabla2,$columna2,$columna3,$idReceta);
        return $respuesta;       
	}


    static public function ctrlFindProductsRecetaInDBXId($idReceta){
        $tabla = "producto";
        $columna = "idProducto";
        $tabla2 = "producto_has_recetas";
        $columna2 = "Producto_idProducto";
        $columna3 = "Recetas_idRecetas";

        $respuesta = ModeloAdminReceta::mdlFindProductsRecetaInDBXId($idReceta,$tabla,$columna,$tabla2,$columna2,$columna3);
        return $respuesta;       
	}
    //----------------------Fin Administración Recetas--------------------------------------------------------

}