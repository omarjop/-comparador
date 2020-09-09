<?php


class ControladorAdminSelect{
        public function buscaMarca($valorMarca){
                 
           $objAdminSeleccionar  = new ControladorSelectsInTables();
           $valorMarca = "'%".$valorMarca."%'";
          // $sql= "SELECT Descripcion FROM marca WHERE Descripcion LIKE %".$valorMarca."%";
            $sql= "select Descripcion from marca where Descripcion  LIKE ".$valorMarca;
           //$sql= "select  * from marca";
            $resultado = $objAdminSeleccionar->selectARowsInDb($sql);

            return $resultado;
         }
         public function buscarAllMarca(){
                 
           $objAdminSeleccionar  = new ControladorSelectsInTables();
           $sql= "select  * from marca";
           $resultado = $objAdminSeleccionar->selectARowsInDb($sql);
           return $resultado;
         }
}