<?php


class ControladorAdminInsert{




   /*Este metodo retorna resultado del insert hecho en tabla*/
    public function agregaMarca($valorMarca){
            $objAdminAgregar  = new ControladorInserttAllTables();
            $resultado= $objAdminAgregar->insertInTable("marca","Descripcion","'$valorMarca'");
            if ($resultado!='Fallo') {
                echo "<script>toastr.info('Se agrego la marca correctamente');</script>";    
         
            }else{
                 echo "<script>toastr.error('Error al agregar la marca.Codigo: '+".$resultado.");</script>";                             
			  }

    

        
    }
}