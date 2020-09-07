<?php

class ControladorEliminarProductosTienda{

         public function EliminarProducto($valor,$idEmpresaValue){
            $objDelete = new ControladorUpdateDeleteInTables();
            $sql ='delete from  producto_has_empresa where Producto_idProducto = '.$valor.' and Empresa_idEmpresa = '.$idEmpresaValue;
            $resultado = $objDelete->deleteInTables($sql);
            return $resultado;
		 }
}