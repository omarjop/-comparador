<?php


class ControladorAdminEliminar{




   /*Este metodo retorna resultado del delete hecho en tabla*/

         public function eliminarCampo($valor,$tabla,$columnaCompara){

         	
            $objDelete = new ControladorUpdateDeleteInTables();
            $sql ="delete from  ".$tabla." where ".$columnaCompara." = ".$valor;
            $resultado = $objDelete->deleteInTables($sql);
            return $resultado;
		 }

         public function eliminarProductoAdmin(){
                 if(isset($_POST["btnEliminarValue"])){
                            $resultado = $this->eliminarCampo($_POST["campoOculto2"],"producto","idProducto");
                            if($resultado=="Exitoso"){
                               echo "<script>toastr.info('Producto eliminado exitosamente');</script>";                              
                             }else{
                               echo "<script>toastr.error('Error al eliminar producto, por favor intente nuevamente);</script>";                             
                             } 
                 }
		 }

}