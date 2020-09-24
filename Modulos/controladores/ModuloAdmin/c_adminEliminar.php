<?php


class ControladorAdminEliminar{




   /*Este metodo retorna resultado del delete hecho en tabla*/

         public function eliminarCampo($valor,$tablaElim,$tablaVerif,$columnaElim,$columnaVerif){
            $objDelete = new ControladorUpdateDeleteInTables();
            $objConsulta = new returnSelectAllRows();
            $sqlVerifica = "select *from ".$tablaVerif."where ".$columnaVerif."= ".$valor;
            $resultadoVerifica=$objConsulta->selectARowsInDb($sqlVerifica);
            if (resultadoVerifica!=null){
               $sql ="delete from  ".$tablaElim." where ".$columnaElim." = ".$valor;
               $resultado = $objDelete->deleteInTables($sql);
               return $resultado;
            }else{

            	return "Asociado";
            }

               

		 }

}