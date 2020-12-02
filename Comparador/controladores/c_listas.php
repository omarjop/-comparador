<?php


class ControladorListas{ 

    /**==========================================================
     * METODO PARA INSERTAR UNA NUEVA LISTA Y CONTROLA LAS COOKIE
     *==========================================================*/
    static public function ctrlCrearLista($idUsu){

        if(isset($_POST["nombreLista"])){
            
          //  if(preg_match('/^[\D\s]{2,20}+$/i', $_POST["nombreLista"])){

                if(isset($_SESSION["id"])){

                    $tabla1 = "listacompra";
                    $tabla2 = "listacompra_has_persona";
                    $datos = array("Persona_idPersona"=>$idUsu,
                                "nombreLista"=>$_POST["nombreLista"],                
                                "estado"=>1);

                    $respuesta = ModeloLista::mdlAgregarLista($tabla1, $tabla2, $datos);
  
                    if($respuesta == "ok"){
                        echo '<script> 
                        swal({
                                title: "¡ok!",
                                text: "¡Su lista se ha creado sastifactoriamente!",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                            });
                        
                        </script>';
                    
                    }else{

                        echo '<script> 
                        swal({
                                title: "¡ERROR!",
                                text: "¡Hubo un error: su lista no pudo ser creada !",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                            });
                        
                        </script>';
                    }
                }else{
                    
                    setcookie("lista-compra", $_POST["nombreLista"], time() + 3600); 

                    echo '<script> 
                        swal({
                                title: "¡ERROR!",
                                text: "¡Se a creado una Cookie!'.$_COOKIE["lista-compra"].'",
                                type: "success",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                        });
                    </script>';
                }

           /* }else{
                echo '<script> 
                        swal({
                                title: "¡ERROR!",
                                text: "¡Error al crear la Lista, no se permiten caracteres especiales!",
                                type: "error",
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
                            },
                                function(isConfirm){
                                    if(isConfirm){
                                        history.back();
                                    }
                        });
                </script>';
            }*/

        }
    }

    /**==========================================================
     * METODO PARA CONSULTAR LAS LISTAS DE UN USUARIO
     *==========================================================*/
    static public function ctrlMostrarListas($item1, $item2, $valor1, $valor2){

        $tabla1 = "ListaCompra_has_Persona";
        $tabla2 = "listacompra";
        $idlista = "idListaCompra";
        $respuesta = ModeloLista::mdlMostrarListas($tabla1, $tabla2, $item1, $item2, $valor1, $valor2, $idlista);
        return $respuesta;

    }
    /**==========================================================
     * METODO PARA CONSULTAR LOS PRODUCTOS QUE UNA LISTA TIENE
     *==========================================================*/
    static public function ctrlMostrarProductosListas($datos){

        $tabla = "productoslista";
        $item1 = "listaCompra_idListaCompra";
        $item2 = "estado";
        $respuesta = ModeloLista::mdlMostrarProductosListas($tabla, $item1, $item2, $datos);
        return $respuesta;

    }

    /**==========================================================
     * METODO PARA CONSULTAR LAS LISTAS DE UN USUARIO
     *==========================================================*/
    static public function ctrlConsultarListas($valor){

        $tabla = "listacompra";
        $item = "idListaCompra";
        $respuesta = ModeloLista::mdlConsultarListas($tabla, $item, $valor);
        return $respuesta;

    }
    /**==========================================================
     * METODO PARA CONSULTAR TODOS LOS PRODUCTOS 
     *==========================================================*/
    static public function ctrlConsultarPrpduct(){
        $tabla = "producto";
        $respuesta = ModeloLista::mdlConsultarPrpduct($tabla);
        return $respuesta;
    }
    
    /**==========================================================
     * METODO PARA CAMBIAR EL ESTADO DE UNA LISTA
     *==========================================================*/
    static public function ctrlCambiarEstadoLista($datos){
        $tabla = "listacompra";
        $item = "estado";
        $respuesta = ModeloLista::mdlCambiarEstadoLista($tabla, $item, $datos);
        return $respuesta;
    }

    /**==========================================================
     * METODO PARA CAMBIAR EL NOMBNRE DE LA LISTA
     *==========================================================*/
    static public function ctrlCambiarNombreLista($datos){
        $tabla = "listacompra";
        $item = "nombreLista";
        $respuesta = ModeloLista::mdlCambiarEstadoLista($tabla, $item, $datos);
        return $respuesta;
    }

    /**==========================================================
     * METODO PARA AGREGAR PRODUCTOS A LA LISTA
     *==========================================================*/
    static public function ctrlAgregarProductosLista($datos){
        $tabla = "productoslista";
        $item1 = "idProducto";
        $item2 = "listaCompra_idListaCompra";
        $item3 = "nombreProducto";
        $respuesta = ModeloLista::mdlAgregarProductosLista($tabla, $item1, $item2, $item3, $datos);
        return $respuesta;
    }
    static public function ctrlCambiarEstadoProductoLista($datos){
        $tabla = "productoslista"; //tabla que se va a actualizar
        $item1 = "idproductosLista"; //campo que se va a comparar
        $item2 = "estado"; //campo que se va a modificar
        $item3 = "listaCompra_idListaCompra"; //campo que se va a comparar
        $respuesta = ModeloLista::mdlCambiarEstadoProductoLista($tabla, $item1, $item2, $item3, $datos);
        return $respuesta;
    }

    /**==========================================================
    * METODO PARA ELIMINAR UN PRODUCTO DE UNA LISTA             *
    *==========================================================*/
    static public function ctrlEliminarProductoLista($datos){
        $tabla = "productoslista";
        $item1 = "idproductosLista";
        $respuesta = ModeloLista::mdlEliminarProductoLista($tabla, $item1,$datos);
        return $respuesta;
    }

}

