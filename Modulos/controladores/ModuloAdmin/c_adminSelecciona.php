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
}