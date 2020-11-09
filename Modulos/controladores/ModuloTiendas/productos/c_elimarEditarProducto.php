<?php

class ControladorEliminarEditarProductosTienda{

         public function EliminarProducto($valor,$idEmpresaValue){
            $objDelete = new ControladorUpdateDeleteInTables();
            $sql ='delete from  producto_has_empresa where Producto_idProducto = '.$valor.' and Empresa_idEmpresa = '.$idEmpresaValue;
            $resultado = $objDelete->deleteInTables($sql);
            return $resultado;
		 }

         public function EditarProducto($id,$valor,$idEmpresaValue,$nitTienda,$objLog){
         
            $objUpdate = new ControladorUpdateDeleteInTables();
            $sql ='update  producto_has_empresa set precioReal = '.$valor.' where Producto_idProducto ='.$id.' and Empresa_idEmpresa = '.$idEmpresaValue;
            $resultado = $objUpdate->UpdateInTable($sql);
             if($resultado=="Exitoso"){
                 $objLog-> escribirEnLog("Consultar Producto Tienda","INFO",$nitTienda,"Se edita el producto con exito");              
                 echo "<script>toastr.info('Producto modificado exitosamente');</script>";                              
			  }else{
                 $objLog-> escribirEnLog("Consultar Producto Tienda","WARNING",$nitTienda,"Falla la edicion del producto para la tienda"); 
                 echo "<script>toastr.error('Error al modificar producto, por favor intente nuevamente.');</script>";                             
			  }
		 }
}