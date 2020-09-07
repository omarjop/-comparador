<?php

class ControladorEliminarProductosTienda{

         public function EliminarProducto($valor){
            
            $objDelete = new ControladorUpdateDeleteInTables();
            $sql ="delete from  producto_has_empresa where Producto_idProducto = "+$valor;
            $resultado = $objDelete->deleteInTables($sql);
            echo "Valor: ".$valor." ".$resultado;
		 }
}