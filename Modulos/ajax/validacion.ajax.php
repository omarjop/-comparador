<?php
require_once "../../AdminComparador/controladores/c_select_int_tables.php";
require_once "../../AdminComparador/modelos/m_select_all_tables.php";

class   AjaxProducto{
    	
    public $validarProducto;

    public function ajaxValidarProducto(){
        $datos = $this->validarProducto;
        $objSelect = new ControladorSelectsInTables();
        $datos = "'".$datos."'";
        $sql = "Select Nombre from producto where Nombre = ".$datos;
        $respuesta = $objSelect->selectARowsInDb($sql);
        if ($respuesta!= null) {
	        echo json_encode($respuesta);
	    }else{
           echo json_encode(null);
		}
        
    }
   

}
/**
 * VALIDA y retorna los productos
 */
if(isset($_POST["validarProducto"])){  
   // echo "<script>toastr.error('Entra');</script>";                             
    $valProducto = new AjaxProducto();
    $valProducto -> validarProducto = $_POST["validarProducto"];
    $valProducto ->ajaxValidarProducto();
}

