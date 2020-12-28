

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


    public function ajaxReturnDatosProducto($idProduct,$idSubCategoria){
       // echo "<script>toastr.error(''+".$idSubCategoria.");</script>"; 
        $objSelect = new ControladorSelectsInTables();
        $respuesta = null; 
        $sql = "select * from producto  t4 INNER JOIN (select categoria_idCategoria,idsubCategoria from subcategoria where idsubCategoria = ".$idSubCategoria.") t2 
                on t4.subCategoria_idsubCategoria  = t2.idsubCategoria and  t4.idProducto = ".$idProduct;

                
        //$sql = "SELECT * FROM producto where idProducto = ".$idProduct;
        $respuesta = $objSelect->selectARowsInDb($sql);

        if($respuesta!= null){
            echo json_encode($respuesta);
        }else{
           echo json_encode("No existe");
		}
        
    }

    public function ajaxReturnSubCategorias($idSubCategoria){
     
        $objSelect = new ControladorSelectsInTables();
        $respuesta = null;        

        $sql = "SELECT * FROM subcategoria where Categoria_idCategoria = ".$idSubCategoria;
        $respuesta = $objSelect->selectARowsInDb($sql);

        if($respuesta!= null){
            echo json_encode($respuesta);
        }else{
           echo json_encode("No existe");
		}
        
    }

    public function ajaxReturnAllRegistros($tabla,$columnaComparar,$idComprar){
     
        $objSelect = new ControladorSelectsInTables();
        $respuesta = null;        

        $sql = "SELECT * FROM ".$tabla." where ".$columnaComparar." = ".$idComprar;
        $respuesta = $objSelect->selectARowsInDb($sql);

        if($respuesta!= null){
            echo json_encode($respuesta);
        }else{
           echo json_encode("No existe");
		}
        
    }
    


    //------------------metodo que valida si existe registros
    public function ajaxValidarExisteRegistro($tabla,$columnaComparar,$valorComparar){
     
        $objSelect = new ControladorSelectsInTables();
        $valorComparar = "'".$valorComparar."'";
        
        $sql = "SELECT * FROM  ".$tabla." where ".$columnaComparar." = ".$valorComparar;
        $respuesta = $objSelect->selectARowsInDb($sql);
        if ($respuesta!= null ) {
            echo json_encode($respuesta);
        }else{
           echo json_encode("No existe");
        }
        
    }
        //------------------metodo que valida si existen dos registros
    public function ajaxValidarExisteDosRegistros($tabla,$columnaComparar1,$valorComparar1,$columnaComparar2,$valorComparar2){
     
        $objSelect = new ControladorSelectsInTables();
        $valorComparar1 = "'".$valorComparar1."'";
        $valorComparar2 = "'".$valorComparar2."'";
        $respuesta = null;
        $sql = "SELECT * FROM  ".$tabla." where ".$columnaComparar1." = ".$valorComparar1. " and ".$columnaComparar2." = ".$valorComparar2;
        $respuesta = $objSelect->selectARowsInDb($sql);

        if ($respuesta!= null ) {            
            echo json_encode($respuesta);
        }else{            
           echo json_encode("No existe");
        }
        
    }

    public function ajaxValidarExistePersonaRelacionada($correo){
        $objSelect = new ControladorSelectsInTables();
        $correoComparar = "'".$correo."'";
        $respuesta = null;
        $sql = "select * from persona t3 inner join (select * from Usuario   t1 inner join (select * from Perfil) t2 
                 on t1.Perfil_idPerfil = t2.idPerfil and t1.correo = ".$correoComparar.")t4 on t3.Usuario_idUsuario = t4.idUsuario ";
        $respuesta = $objSelect->selectARowsInDb($sql);                 


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

//Valida si el producto Existe y retorna su información
if(isset($_POST["idProductoFiendValue"])){  
    $valProducto = new AjaxProducto();
    $valProducto ->ajaxReturnDatosProducto($_POST["idProductoFiendValue"],$_POST["idSubCategoria"]);
}

//trae las sub categorias asociadas a una categoria
if(isset($_POST["findSubCategorias"])){  
    $valProducto = new AjaxProducto();
    $valProducto ->ajaxReturnAllRegistros("subcategoria","Categoria_idCategoria",$_POST["findSubCategorias"]);
}

//trae las unidades de peso volumen de las unidades de medida
if(isset($_POST["findUnidadMedida"])){  
    $valProducto = new AjaxProducto();
    $aux = $_POST["findUnidadMedida"];
    $valProducto ->ajaxReturnAllRegistros("pesovolumen","unidadMedida_idunidadMedida",$_POST["findUnidadMedida"]);
}

//Valida si la marca existe
if(isset($_POST["nombreAddMarca"])){  
    $valMarca = new AjaxProducto();
    $valMarca ->ajaxValidarExisteRegistro("marca","Descripcion",$_POST["nombreAddMarca"]);
}
//Valida si existe la unidad de medida 
if(isset($_POST["addunidadValue"])){  
    $valUnidadMedida = new AjaxProducto();
    $valUnidadMedida ->ajaxValidarExisteRegistro("unidadmedida","nombreMedida",$_POST["addunidadValue"]);
}
//Valida si existe el tipo de empresa
if(isset($_POST["nombreAddTipoEmp"])){  
    $valTipoEmpresa = new AjaxProducto();
    $valTipoEmpresa ->ajaxValidarExisteRegistro("tipoempresa","descripcion",$_POST["nombreAddTipoEmp"]);
}
//Valida si existe el tipo de producto
if(isset($_POST["nombreAddTipoProd"])){  
    $valTipoProd = new AjaxProducto();
    $valTipoProd ->ajaxValidarExisteRegistro("tipoproducto","descripcion",$_POST["nombreAddTipoProd"]);
}
//Valida si existe el pais
if(isset($_POST["nombreAddPais"])){  
    $valPais = new AjaxProducto();
    $valPais ->ajaxValidarExisteRegistro("pais","nombrePais",$_POST["nombreAddPais"]);
}
//Valida si existe el perfil
if(isset($_POST["nombreAddPerfil"])){  
    $valPerfil = new AjaxProducto();
    $valPerfil ->ajaxValidarExisteRegistro("perfil","Descripcion",$_POST["nombreAddPerfil"]);
}
//Valida si existe el tipo de pago
if(isset($_POST["nombreAddtipo_pago"])){  
    $valTipoPago = new AjaxProducto();
    $valTipoPago ->ajaxValidarExisteRegistro("tipo_pago","Tipo_pago",$_POST["nombreAddtipo_pago"]);
}
if(isset($_POST["nombreAddDia"])){  
    $valDia = new AjaxProducto();
    $valDia ->ajaxValidarExisteRegistro("dia","Descripcion",$_POST["nombreAddDia"]);
}
if(isset($_POST["nombreDiaEdit"])){  
    $valDiaEdit = new AjaxProducto();
    $valDiaEdit ->ajaxValidarExisteRegistro("dia","Descripcion",$_POST["nombreDiaEdit"]);
}
if(isset($_POST["nombreAddCategoria"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteDosRegistros("categoria","nombre",$_POST["nombreAddCategoria"],"control",$_POST["nombreAddControl"]);
}
if(isset($_POST["nombreAdddificultad"])){  
    $valDificultad = new AjaxProducto();
    $valDificultad ->ajaxValidarExisteRegistro("dificultad","nombre",$_POST["nombreAdddificultad"]);
}
if(isset($_POST["nombredificultadEdit"])){  
    $valDificultad = new AjaxProducto();
    $valDificultad ->ajaxValidarExisteRegistro("dificultad","nombre",$_POST["nombredificultadEdit"]);
}
if(isset($_POST["nombreAddCiudad"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteDosRegistros("ciudad","nombreCiudad",$_POST["nombreAddCiudad"],"pais_idpais",$_POST["nombreAddControl"]);
}
if(isset($_POST["nombreEditCiudad"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteDosRegistros("ciudad","nombreCiudad",$_POST["nombreEditCiudad"],"pais_idpais",$_POST["nombreEditControl"]);
}
if(isset($_POST["addpesovolumen"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteDosRegistros("pesovolumen","unidadMedida_idUnidadMedida",$_POST["nombreAddControl"],"medida",$_POST["addpesovolumen"]);
}
if(isset($_POST["nombreAddSubCat"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteDosRegistros("subcategoria","nombre",$_POST["nombreAddSubCat"],"categoria_idCategoria",$_POST["nombreAddControl"]);
}
if(isset($_POST["nombreEditSubCat"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteDosRegistros("subcategoria","nombre",$_POST["nombreEditSubCat"],"categoria_idCategoria",$_POST["nombreEditControl"]);
}
if(isset($_POST["correoUsuario"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteRegistro("usuario","correo",$_POST["correoUsuario"]);
}
if(isset($_POST["nombreEditUsuario"])){  
    $valCategoria = new AjaxProducto();
    $valCategoria ->ajaxValidarExisteDosRegistros("subcategoria","correo",$_POST["nombreEditUsuario"],"Perfil_idPerfil",$_POST["nombreEditControl"]);
}

if(isset($_POST["addCorreoPersona"])){  
    $valAddPersona = new AjaxProducto();
    $valAddPersona ->ajaxValidarExistePersonaRelacionada($_POST["addCorreoPersona"]);
}
//Consulta las ciudades del pais seleccionado en addPersona
if(isset($_POST["BuscaCiudadPais"])){  
    $valCiudadPersona = new AjaxProducto();
    $valCiudadPersona ->ajaxReturnAllRegistros("ciudad","pais_idpais",$_POST["BuscaCiudadPais"]);
}