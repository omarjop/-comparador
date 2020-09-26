
<?php

require_once "../AdminComparador/controladores/c_select_int_tables.php";
class ControladorAdminEliminar{




   /*Este metodo retorna resultado del delete hecho en tabla*/

         public function eliminarCampo($valor,$tablaElim,$tablaVerif,$columnaElim,$columnaVerif){
            
            $objConsulta = new ControladorSelectsInTables();
            $objDelete = new ControladorUpdateDeleteInTables();
            $sqlVerifica = "select *from ".$tablaVerif." where ".$columnaVerif."= ".$valor;
            $resultadoVerifica = $objConsulta->selectARowsInDb($sqlVerifica);
          
            if (!$resultadoVerifica){
               $sql ="delete from  ".$tablaElim." where ".$columnaElim." = ".$valor;
               $resultado = $objDelete->deleteInTables($sql);
               return $resultado;

            }else{

            	return "Asociado";
            }

               

		 }

}