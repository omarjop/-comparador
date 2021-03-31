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
    //----------------------Fin Administración Recetas--------------------------------------------------------

}