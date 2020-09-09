<?php

class ControladorFindProductosTienda{

         public function returnXSubCategoria($sql){
            $objSelect = new ControladorSelectsInTables();
            return $objSelect->selectARowsInDb($sql);
		 }

         public function autocompletar($valorBuscar,$idTienda){
            $busqueda = "'%".$valorBuscar."%'";
            $sqlAutocompletar = "SELECT * FROM Producto_has_empresa t5 INNER JOIN (SELECT * FROM unidadMedida t3 INNER JOIN (SELECT * FROM producto t1 INNER JOIN ( SELECT idsubCategoria FROM subcategoria where Categoria_idCategoria = ".$idTienda." ) t2 ON t1.subCategoria_idsubCategoria = t2.idsubCategoria where t1.Nombre LIKE ".$busqueda.")t4 ON t3.Producto_idProducto = t4.idProducto) t6 ON t5.Producto_idProducto = t6.Producto_idProducto";
            $objSelect = new ControladorSelectsInTables();
            $resultado = $objSelect->selectARowsInDb($sqlAutocompletar);
            if($resultado==null){
               echo "<script>toastr.info('No se encontraron productos por el criterio de busqueda mencionado');</script>";                              
			}
            return $resultado;
		 }
}