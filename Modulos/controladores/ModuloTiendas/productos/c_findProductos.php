<?php

class ControladorFindProductosTienda{

         public function returnXSubCategoria($sql){
            $objSelect = new ControladorSelectsInTables();
            return $objSelect->selectARowsInDb($sql);
		 }
}