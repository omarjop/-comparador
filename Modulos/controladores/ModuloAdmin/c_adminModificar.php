<?php


class ControladorAdminModificar{

    public function modificarCampo($tabla,$columnaCompara,$columnaModificar,$valor,$id){
         
        $objUpdate = new ControladorUpdateDeleteInTables();//UpdateInTable
        //$sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id;
        $valor = "'$valor'";
        $sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id; 
        $resultado = $objUpdate->UpdateInTable($sql);
        if($resultado=="Exitoso"){
           echo "<script>toastr.info('Registro modificado exitosamente');</script>";                              
	    }else{
           echo "<script>toastr.error('Error al modificar, por favor intente nuevamente.');</script>";                             
		}
         echo "<script>toastr.info('$sql');</script>"; 
    }

        public function modifDosCampos($tabla,$columnaCompara,$columnaModificar1,$valor1,$id,$columnaModificar2,$valor2){
         
        $objUpdate = new ControladorUpdateDeleteInTables();//UpdateInTable
        //$sql ="update ".$tabla." set ".$columnaModificar." = ".$valor." where ".$columnaCompara." = ".$id;
        $valor1 = "'$valor1'";
        $valor2 = "'$valor2'";
        $sql ="update ".$tabla." set ".$columnaModificar1." = ".$valor1."," .$columnaModificar2. "=" .$valor2. " where ".$columnaCompara." = ".$id; 
        $resultado = $objUpdate->UpdateInTable($sql);
        if($resultado=="Exitoso"){
           echo "<script>toastr.info('Registro modificado exitosamente');</script>";                              
        }else{
           echo "<script>toastr.error('Error al modificar, por favor intente nuevamente.');</script>";                             
        }
         echo "<script>toastr.info('$sql');</script>"; 
    }
}