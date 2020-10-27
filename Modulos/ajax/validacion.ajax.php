

<?php
require_once "../../AdminComparador/controladores/c_select_int_tables.php";
require_once "../../AdminComparador/modelos/m_select_all_tables.php";

class   AjaxProducto{
    	
    public $validarProducto;

    public function ajaxValidarProducto(){
        $datos = $this->validarProducto;
        $registrosErroneos = array();

        $objSelect = new ControladorSelectsInTables();
        $datos = "'%".$datos."%'";
        $sql = "Select * from producto where Nombre LIKE ".$datos;
        $respuesta = $objSelect->selectARowsInDb($sql);
       
        if ($respuesta!= null) {
           for($i=0;$i<count($respuesta);$i++){
               $datos = array(
                            "id" => $respuesta[$i]["idProducto"],
                            "nombre" => $respuesta[$i]["Nombre"]
                          );
			}  
            echo json_encode (array(
                                "datos" => $datos,
                                "error" => "No"
                            ));
                         //   echo json_encode($respuesta);
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

    public function ajaxValidarNewProductoAdd($nombre,$unidad){
     
        $objSelect = new ControladorSelectsInTables();
        $nombre = "'".$nombre."'";
        $unidad = "'".$unidad."'";
        
        $sql = "SELECT * FROM producto where Nombre = $nombre AND unidadMedida_idunidadMedida = $unidad";
        $respuesta = $objSelect->selectARowsInDb($sql);
        if ($respuesta!= null ) {
	        echo json_encode($respuesta);
	    }else{
           echo json_encode(null);
		}
        
    }

     public function ajaxValidarDeleteProducto($idProduct){
     
        $objSelect = new ControladorSelectsInTables();
        $respuesta = null;
        $respuesta2 = null;
        $respuesta3 = null;
        

        $sql2 = "SELECT * FROM producto_has_listacompra where Producto_idProducto = ".$idProduct;
        $respuesta2 = $objSelect->selectARowsInDb($sql2);
        $mensaje2 = "No se puede eliminar, el producto se encuentra asociado a una lista de compra";

        $sql3 = "SELECT * FROM producto_has_recetas where Producto_idProducto = ".$idProduct;
        $respuesta3 = $objSelect->selectARowsInDb($sql3);
        $mensaje3 = "No se puede eliminar, el producto se encuentra asociado a una receta";

        $mensaje4 = "No se puede eliminar, el producto se encuentra asociado a una lista de compra y a una receta";

        if ( $respuesta2!= null && $respuesta3!= null) {
	        echo json_encode(array(                                
                                "mensaje" => $mensaje4
                            ));
	    }else if($respuesta== null && $respuesta2!= null && $respuesta3== null){
            echo json_encode(array(                                
                                    "mensaje" => $mensaje2
                                ));
        }else if($respuesta== null && $respuesta2== null && $respuesta3!= null){
            echo json_encode(array(                                
                                    "mensaje" => $mensaje3
                                ));
        }else{
           echo json_encode("No existe");
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


/*Valida los datos del producto cuando se registra uno nuevo desde tiendas*/
if(isset($_POST["newProduct"])){  
    $valProducto = new AjaxProducto();
    $valProducto -> validarProducto = $_POST["newProduct"];
    $valProducto ->ajaxValidarNewProducto();
}


/*Valida los datos del producto cuando se registra uno nuevo desde la administración*/
if(isset($_POST["nombreAddP"])){  
    $valProducto = new AjaxProducto();
    $valProducto ->ajaxValidarNewProductoAdd($_POST["nombreAddP"],$_POST["unitAddP"]);
}

//Valida si el producto se encuentra asociado a una tienda sino no se elimina
if(isset($_POST["idProducto"])){  
    $valProducto = new AjaxProducto();
    $valProducto ->ajaxValidarDeleteProducto($_POST["idProducto"]);
}