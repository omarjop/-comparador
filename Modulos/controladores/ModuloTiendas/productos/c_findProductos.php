<?php

class ControladorFindProductosTienda{

         public function returnXSubCategoria($sql){
            $objSelect = new ControladorSelectsInTables();
            return $objSelect->selectARowsInDb($sql);
		 }

         public function autocompletar($valorBuscar,$idCategoria,$idTienda){
                                          
            $busqueda = "'%".$valorBuscar."%'";            
            $sqlAutocompletar = "SELECT DISTINCT * FROM Producto_has_empresa t5 INNER JOIN (SELECT DISTINCT * FROM unidadMedida t3 INNER JOIN (SELECT DISTINCT * FROM producto t1 INNER JOIN ( SELECT DISTINCT idsubCategoria FROM subcategoria where Categoria_idCategoria = ".$idCategoria." ) t2 ON t1.subCategoria_idsubCategoria = t2.idsubCategoria where t1.Nombre LIKE ".$busqueda.")t4 ON t3.idunidadMedida = t4.unidadMedida_idunidadMedida) t6 ON t5.Producto_idProducto = t6.idProducto where t5.Empresa_idEmpresa = ".$idTienda;
            $objSelect = new ControladorSelectsInTables();
            $resultado = $objSelect->selectARowsInDb($sqlAutocompletar);
            if($resultado==null){
               echo "<script>toastr.info('No se encontraron productos por el criterio de busqueda mencionado');</script>";                              
			}
            return $resultado;
		 }
}