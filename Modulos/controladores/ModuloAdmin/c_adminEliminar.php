<?php


class ControladorAdminEliminar{




   /*Este metodo retorna resultado del delete hecho en tabla*/

         public function eliminarCampo($valor,$tabla,$columnaCompara){

         	
            $objDelete = new ControladorUpdateDeleteInTables();
            $sql ="delete from  ".$tabla." where ".$columnaCompara." = ".$valor;
            $resultado = $objDelete->deleteInTables($sql);
            return $resultado;
		 }

         public function eliminarProductoAdmin($id){
                 //if(isset($_POST["btnEliminarValue"])){
                            $resultado = $this->eliminarCampo($id,"producto","idProducto");
                            if($resultado=="Exitoso"){
                               echo "<script>toastr.info('Producto eliminado exitosamente');</script>";                              
                             }else{
                               echo "<script>toastr.error('Error al eliminar producto, por favor intente nuevamente);</script>";                             
                             } 
                // }
		 }

         public function ctrlDeleeRecetaInDBXId($idReceta,$tabla,$columna){
              $respuesta = ModeloAdminReceta::ctrlDeleeRecetaInDBXId($idReceta,$tabla,$columna);
              return $respuesta;             
		 }

         public function ctrlDeleeProductFromReceta($idReceta,$idProducto,$tabla,$columna,$columna1){
              $respuesta = ModeloAdminReceta::mdlDeleeProductFromReceta($idReceta,$idProducto,$tabla,$columna,$columna1);
              return $respuesta;             
		 }

}