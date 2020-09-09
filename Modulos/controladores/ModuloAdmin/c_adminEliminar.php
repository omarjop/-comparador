<?php


class ControladorAdminEliminar{




   /*Este metodo retorna resultado del delete hecho en tabla*/

         public function eliminarCampo($valor,$tabla,$columnaCompara){
            $objDelete = new ControladorUpdateDeleteInTables();
            $sql ="delete from  ".$tabla." where ".$columnaCompara." = ".$valor;
            $resultado = $objDelete->deleteInTables($sql);
            return $resultado;
		 }

}