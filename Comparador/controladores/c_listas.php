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
    static public function ctrlMostrarProductosListas($valor){

        $tabla1 = "producto_has_listacompra";
        $tabla2 = "producto";
        $item1 = "listaCompra_idListaCompra";
        $item2 = "idProducto";
        $item3 = "Producto_idProducto ";
        $respuesta = ModeloLista::mdlMostrarProductosListas($tabla1, $tabla2, $item1, $item2, $item3, $valor);
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

}