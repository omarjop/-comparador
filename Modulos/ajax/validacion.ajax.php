<?php
require_once "../../AdminComparador/controladores/c_select_int_tables.php";
require_once "../../AdminComparador/modelos/m_select_all_tables.php";

class   AjaxProducto{
    	
    public $validarProducto;

    public function ajaxValidarProducto(){
        $datos = $this->validarProducto;
        $objSelect = new ControladorSelectsInTables();
        $datos = "'".$datos."'";
        $sql = "Select * from producto where Nombre = ".$datos;
        $respuesta = $objSelect->selectARowsInDb($sql);
        if ($respuesta!= null) {
	        echo json_encode($respuesta);
	    }else{
           echo json_encode(null);
		}
        
    }
   
     public function ajaxValidarNewProducto(){
        $datos = $this->validarProducto;
        $objSelect = new ControladorSelectsInTables();
        $datos = "'".$datos."'";
        //SELECT *  FROM marca t6 INNER JOIN(SELECT * from subcategoria t4 INNER JOIN(SELECT * from unidadmedida t3 INNER JOIN (SELECT DISTINCT idProducto,unidadMedida_idunidadMedida,subCategoria_idsubCategoria,Marca_idMarca,Referencia,Descripcion AS DescripcionP,pesoVolumen  FROM producto where Nombre = 'Arroz') t1 on t3.idUnidadMedida = t1.unidadMedida_idUnidadMedida) t5 ON t4.idsubCategoria = t5.subCategoria_idsubCategoria)t7 ON t6.idMarca = t7.Marca_idMarca
        $sql = "SELECT *  FROM marca t6 INNER JOIN(SELECT * from subcategoria t4 INNER JOIN(SELECT * from unidadmedida t3 INNER JOIN (SELECT DISTINCT idProducto,unidadMedida_idunidadMedida,subCategoria_idsubCategoria,Marca_idMarca,Referencia,Descripcion AS DescripcionP,pesoVolumen  FROM producto where Nombre = ".$datos.") t1 on t3.idUnidadMedida = t1.unidadMedida_idUnidadMedida) t5 ON t4.idsubCategoria = t5.subCategoria_idsubCategoria)t7 ON t6.idMarca = t7.Marca_idMarca";
        $respuesta = $objSelect->selectARowsInDb($sql);
        if ($respuesta!= null) {
	        echo json_encode($respuesta);
	    }else{
           echo json_encode(null);
		}
        
    }
}
/**
 * VALIDA y retorna los productos del campo auto completar
 */
if(isset($_POST["validarProducto"])){  
   $valProducto = new AjaxProducto();
    $valProducto -> validarProducto = $_POST["validarProducto"];
    $valProducto ->ajaxValidarProducto();
}


/*Valida los datos del producto cuando se registra uno nuevo*/
if(isset($_POST["newProduct"])){  
    $valProducto = new AjaxProducto();
    $valProducto -> validarProducto = $_POST["newProduct"];
    $valProducto ->ajaxValidarNewProducto();
}
