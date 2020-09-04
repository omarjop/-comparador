<?php

class ControladorEliminarProductosTienda{

         public function EliminarProducto($valor){
            $objSelect = new ControladorSelectsInTables();
            $sql ="select * from producto where idProducto = "+$valor;
            $resultado = $objSelect->selectARowsInDb($sql);
		 }
}