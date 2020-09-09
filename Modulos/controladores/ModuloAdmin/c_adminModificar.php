<?php


class ControladorAdminModificar{

    public function modificarCampo($tabla,$columnaCompara,$columnaModificar,$valor,$id){
         
        $objUpdate = new ControladorUpdateDeleteInTables();//UpdateInTable
        //$sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id;
        $valor = "'$valor'";
        $sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id; 
        $resultado = $objUpdate->UpdateInTable($sql);
        if($resultado=="Exitoso"){
           echo "<script>toastr.info('Marca modificada exitosamente');</script>";                              
	    }else{
           echo "<script>toastr.error('Error al modificar marca, por favor intente nuevamente.');</script>";                             
		}
         echo "<script>toastr.info('$sql');</script>"; 
    }
}