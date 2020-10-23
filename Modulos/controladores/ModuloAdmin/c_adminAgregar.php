<?php


class ControladorAdminInsert{




   /*Este metodo retorna resultado del insert hecho en tabla*/
    public function agregarCampos($tabla,$columna,$valorAgregar){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("marca","Descripcion","'$valorAgregar'");
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego la marca correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar la marca.Codigo: '+".$resultado.");</script>";                             
			  }

    

        
    }
        public function agregarCamposUnid($tabla,$columna,$valorAgregar,$columna2,$valorAgregar2){
            $objAdminAgregar  = new ControladorInserttAllTables();

            $resultado= $objAdminAgregar->insertInTable("unidadmedida","nombreMedida,control","'$valorAgregar'".",".$valorAgregar2);
      
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego la unidad correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar la unidad.Codigo: '+".$resultado.");</script>";                             
              }

    

        
    }
}