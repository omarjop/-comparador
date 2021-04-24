

<?php
require_once "../controladores/ModuloAdmin/c_adminAgregar.php";
require_once "../controladores/ModuloAdmin/c_adminEliminar.php";
require_once "../controladores/ModuloAdmin/c_adminSelecciona.php";
require_once "../modelos/m_recetas.php";

class   AjaxRecetAll{
    	
    
    
    public function ajaxAddRecetaInDB($datos){
        $respuesta =  ControladorAdminInsert::ctlRegitrarRecetasInDB($datos);
        echo  json_encode ($respuesta);              
    }

    public function ajaxFindRecetaInDB(){
        $respuesta = ControladorAdminInsert::ctrlMostrarRecetas();
        echo  json_encode ($respuesta);              
    }

    public function ajaxFindRecetaInDBXId($idReceta){
        $respuesta = ControladorAdminSelect::ctrlMostrarRecetaXId($idReceta);
        echo  json_encode ($respuesta);      
	}

    public function ajaxFindProductoInDB($idReceta){
        $respuesta = ControladorAdminSelect::ctrlMostrarProductos($idReceta);
        echo  json_encode ($respuesta);      
	}

     public function ajaxFindRecetaInDBXIdJoin($idReceta){
        $respuesta = ControladorAdminSelect::ctrlFindRecetaInDBXIdJoin($idReceta);
        echo  json_encode ($respuesta);      
	}

    public function ajaxDeleeRecetaInDBXId($idReceta,$tabla,$columna){
        $respuesta = ControladorAdminEliminar::ctrlDeleeRecetaInDBXId($idReceta,$tabla,$columna);
        echo  json_encode ($respuesta);      
	}

    public function ajaxFindProductsRecetaInDBXId($idReceta){
        $respuesta = ControladorAdminSelect::ctrlFindProductsRecetaInDBXId($idReceta);
        echo  json_encode ($respuesta);     
	}
    public function ajaxQuitarProductoDeReceta($idReceta,$idProducto){
        $respuesta = ControladorAdminEliminar::ctrlDeleeProductFromReceta($idReceta,$idProducto,"producto_has_recetas","Recetas_idRecetas","Producto_idProducto");
        echo  json_encode ($respuesta);  
	}
    public function ajaxAsociarProductoDeReceta($datos,$tabla){
         $respuesta =  ControladorAdminInsert::ctlAsociarProductInReceta($datos,$tabla);
         echo  json_encode ($respuesta);     
	}

}



//Llama metodo para registrar una receta en la administracion
if(isset($_POST["imgRecetaAdd"])){  
    $adminReceta = new AjaxRecetAll();

    $dificultadReceta = $_POST["dificultadReceta"];
    $categoriaReceta = $_POST["categoriaReceta"];
    $nameReceta = $_POST["nameReceta"];
    $timeReceta = $_POST["timeReceta"];
    $porcionesReceta = $_POST["porcionesReceta"];
    $contenidoReceta = $_POST["contenidoReceta"];
    $imgRecetaAdd = $_POST["imgRecetaAdd"];

    $datos = array(
             "dificultadReceta"=>$dificultadReceta,
             "categoriaReceta" =>$categoriaReceta,
             "nameReceta"      =>$nameReceta,
             "timeReceta"      =>$timeReceta,
             "porcionesReceta" =>$porcionesReceta,
             "contenidoReceta" =>$contenidoReceta,
             "videoReceta"     =>NULL,
             "imgRecetaAdd"    =>$imgRecetaAdd,
             "idPersona"       =>"1",
             "calificacion"    =>"0",
             "votos"           =>"0");
    $adminReceta ->ajaxAddRecetaInDB($datos);

}
//Llama el metodo para consultar todas las recetas
if(isset($_POST["recetas"])){ 
    $adminReceta = new AjaxRecetAll();
    $adminReceta->ajaxFindRecetaInDB();
}
//Llama el metodo para consultar datos de la receta que se va a editar
if(isset($_POST["idRecetaFind"])){ 
    $adminReceta = new AjaxRecetAll();
    $idRecetaFind = $_POST["idRecetaFind"];
    $adminReceta->ajaxFindRecetaInDBXId($idRecetaFind);
}
//Llama el metodo para consultar todos los productos
if(isset($_POST["productos"])){ 
    $idReceta = $_POST["productos"];
    $adminReceta = new AjaxRecetAll();
    $adminReceta->ajaxFindProductoInDB($idReceta);
}
//Llama el metodo para consultar datos de la receta que se va a mostrar en la administracion
if(isset($_POST["idRecetaFindAdmin"])){ 
    $adminReceta = new AjaxRecetAll();
    $idRecetaFind = $_POST["idRecetaFindAdmin"];
    $adminReceta->ajaxFindRecetaInDBXIdJoin($idRecetaFind);
}
//Llama el metodo que envia a eliminar receta dado el id
if(isset($_POST["idRecetaDeleteAdmin"])){ 
    $adminReceta = new AjaxRecetAll();
    $idRecetaDelete = $_POST["idRecetaDeleteAdmin"];   
    $adminReceta->ajaxDeleeRecetaInDBXId($idRecetaDelete,"recetas","idRecetas");
}

//Llama el metodo que consulta los productos de una receta
if(isset($_POST["idRecetaFindProduct"])){ 
    $adminReceta = new AjaxRecetAll();
    $idRecetaProducts = $_POST["idRecetaFindProduct"];   
    $adminReceta->ajaxFindProductsRecetaInDBXId($idRecetaProducts,);
}

//Llama el metodo que quita un producto que esta en una receta
if(isset($_POST["idRecetaDeleteProductAdmin"])){ 
    $adminReceta = new AjaxRecetAll();
    $idReceta = $_POST["idRecetaDeleteProductAdmin"];   
    $idProducto = $_POST["idProductDeleteProductAdmin"];   
    $adminReceta->ajaxQuitarProductoDeReceta($idReceta,$idProducto);
}

//Llama el metodo que asocia productos a una receta
if(isset($_POST["idRecetaAsocProductAdmin"])){ 
    $adminReceta = new AjaxRecetAll();
    $idReceta = $_POST["idRecetaAsocProductAdmin"];   
    $idProducto = $_POST["idProductAsocProductAdmin"];
    $cantidadProducto = $_POST["cantidadProducto"];

    $datos = array(
             "idreceta"        =>$idReceta,
             "idproducto"      =>$idProducto,
             "cantproducto"    =>$cantidadProducto);

    $adminReceta->ajaxAsociarProductoDeReceta($datos,"producto_has_recetas");
}