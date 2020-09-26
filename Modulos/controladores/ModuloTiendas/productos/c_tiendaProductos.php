<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
     function mensajeCorrecto(mensaje){
        toastr.info(mensaje); 
	 }
     function mensajeError(mensaje){
        toastr.error(mensaje); 
	 }
</script>

<?php

class ControladorProductosTienda{

    public function registrarProducto($objTiendaInicial){
        if(isset($_POST["guardar"])){         
            $this->validarCampos($objTiendaInicial);
        }
    }

    private function validarCampos($objTiendaInicial){
            $objModel =  new modelosWork();
        
            $nombreProducto =  $_POST["nameProduct"];
            $precio  =  $_POST["price"];
            $unidaVolumen = $_POST["unit"];
            $volumenGrams =  $_POST["grams"];
            $volumenKiloGrams =  $_POST["kilograms"];
            $volumenMililitros =  $_POST["milliliters"];
            $volumenCntimetro =  $_POST["centimeters"];
            $referencia =  $_POST["Reference"];
            $marca =  $_POST["Brand"];
            $categoria = $_POST["Category"];
            $newCategory = $_POST["NewCategory"];
            $descripcion = $_POST["description"];
            $resultadoImagen = "Correcto";
            $unidad = $this->returnVolumen($unidaVolumen,$volumenGrams,$volumenKiloGrams,$volumenMililitros,$volumenCntimetro);
            $porciones = explode("-", $categoria);    
            $categoria = $porciones[0];
      // Validar el precio que este bien el formato
            $objValidarDato  = new ControladorAdjuntos();
            $resultado = $objValidarDato->isFloat($precio,"Precio");
            $resultadoNombre = $objValidarDato->isString($nombreProducto);
             
          
               $categoria = $this->validarCategoria($categoria,$objTiendaInicial,$newCategory);

                  if($categoria!="Error al registrar producto. Por favor comunicarse con el administrador."){
                           if($resultadoImagen == "Correcto"){
                                     $isMarca = $this->validarMarca($marca);
                                     if($isMarca!="Error al registrar producto. Por favor comunicarse con el administrador."){
                                          $returnrValue = $this->validarExisteProducto($categoria,$isMarca,$nombreProducto,$referencia,$descripcion,$imagen,$unidad,$objModel,$unidaVolumen,$objTiendaInicial,$precio,$imagenValue);                                                             
                                               if($returnrValue!="Error al registrar producto. Por favor comunicarse con el administrador."){     
                                                        echo "<script> mensajeCorrecto('".$returnrValue."'); </script>"; 
                                                    }else{
                                                       echo "<script> mensajeError('".$returnrValue."'); </script>";
													}           
							         }else{                                                             
                                          echo "<script> mensajeError('".$categoria."'); </script>";
							         }                

                           }else{                      
                                      echo "<script> mensajeError('No es una imagen correcta para adjuntar'); </script>"; 			      
                           }
                   }else{
                                echo "<script> mensajeError('".$categoria."'); </script>";
				   } 

	}

    private function validarCategoria($categoria,$objTiendaInicial,$newCategory){
             $returnValue="Error al registrar producto. Por favor comunicarse con el administrador.";
             $objSelects  = new ControladorSelectsInTables();
             $objInsert  = new ControladorInserttAllTables();
         
             $campos = "nombre";
             $condicion =" idsubCategoria = ".$categoria;
             $resultado = $objSelects->returnSelectARowForField("subcategoria",$campos,$condicion); 
             if($resultado!="Fallo"){
                       $idCategoriTienda = $objTiendaInicial->getIdCategoria();
                       if($resultado[0]["nombre"]!="Otros"){
                          $returnValue = $categoria;
			           }else{
                             $into = "Categoria_idCategoria,nombre,ruta";
                             $value = "'$idCategoriTienda'".","."'$newCategory'".","."'$newCategory'";
                             $result = $objInsert->insertInTable("subcategoria",$into,$value);
                             if($result!="Fallo"){
                                $returnValue = $result;
							 }
                             
			           }
			 }

       return $returnValue;
	}
    private function validarExtencionImagen($imagen){
            $objEstructura = new ControladorEstructuras();
            $objValidarAdjunto = new ControladorAdjuntos();
            $returnValue = "Correcto";

            $estructura = $objEstructura ->tiposDeImagen();
            foreach($estructura as $valor){
                 $resultado = $objValidarAdjunto->validaExtensionImagen($imagen,$valor);
                 if($resultado == 1){
                     $returnValue = "Correcto";
                     break;
			      }else{
                     $returnValue = "In Correcto";     
			      }
		    }
        return $returnValue ;
	}

    private function returnVolumen($unidaVolumen,$volumenGrams,$volumenKiloGrams,$volumenMililitros,$volumenCntimetro){
           $arrayReturn = "";    
           $aux = explode("-", $unidaVolumen);    
               switch ($aux[0]) {
                    case "gramos":
                        $arrayReturn = $volumenGrams;
                        break;
                    case "kilogramos":
                        $arrayReturn = $volumenKiloGrams;
                        break;
                    case "mililitros":
                        $arrayReturn = $volumenMililitros;
                        break;
                    case "centimetros":
                        $arrayReturn = $volumenCntimetro;
                        break;
                }

                return $arrayReturn;
	}


    public function validarMarca($marca){
             $marca = strtolower($marca);    
             $marca = ucwords($marca);
             $objSelects  = new ControladorSelectsInTables();
             $idReturn="Error al registrar producto. Por favor comunicarse con el administrador.";

             $campos = "idMarca";
             $condicion =" Descripcion = "."'$marca'";
             $resultado = $objSelects->returnSelectARowForField("marca",$campos,$condicion); 

               if($resultado!="Fallo"){
                     if($resultado){
                        $idReturn = $resultado[0]["idMarca"];
			         }else{
                         $idReturn = $this->registrarMarca($marca,$objSelects); 
			         }
               }

       return $idReturn;
	}

    public function registrarMarca($marca,$objSelects){
         $idReturn="";
         $into = "Descripcion";
         $value = "'$marca'";
         $objInsert  = new ControladorInserttAllTables();
         $result = $objInsert->insertInTable("marca",$into,$value);
         if( $result != "Fallo"){
             $campos = "idMarca";
             $condicion =" Descripcion = "."'$marca'";
             $resultado = $objSelects->returnSelectARowForField("marca",$campos,$condicion); 
             $idReturn = $resultado[0]["idMarca"];
             
		 }else{
            $idReturn = "Error al registrar producto. Por favor comunicarse con el administrador.";           
		 }
         return $idReturn;
	}

    public function validarExisteProducto($categoria,$isMarca,$nombreProducto,$referencia,$descripcion,$imagen,$unidad,$objModel,$unidaVolumen,$objTiendaInicial,$precio,$imagenValue){
             $aux = explode("-", $unidaVolumen);
             $returnValue ="Error al registrar producto. Por favor comunicarse con el administrador.";
             $objSelects  = new ControladorSelectsInTables();
             $objValidarAdjunto = new ControladorAdjuntos();
             $campos = "idProducto";
             $condicion =" subCategoria_idsubCategoria = "."'$categoria'"." and "." Marca_idMarca = "."'$isMarca'"." and "." Nombre = "."'$nombreProducto'"." and "." Referencia = "."'$referencia'"." and "." pesoVolumen = "."'$unidad'";
             $resultado = $objSelects->returnSelectARowForField("producto",$campos,$condicion); 
             $idTienda = $objTiendaInicial->getIdEmpresa();


                    $imagen = "../AdminComparador/imagenes_productos/producto.png";


     if($resultado!="Fallo"){
                     if($resultado){
                 
                              $idProducto =$resultado[0]["idProducto"];
                              $campos2 = "*";
                              $condicion2 =" Producto_idProducto = "."'$idProducto'"." and "." Empresa_idEmpresa = "."'$idTienda'";
                              $resultado2 = $objSelects->returnSelectARowForField("producto_has_empresa",$campos2,$condicion2); 

                                if($resultado2){
                                   $returnValue = "No se registra el producto, ya existe un producto con las mismas caracteristicas";
					            }else{
                                       $returnValue = $this->validarInsertInTable($idProducto,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio);  
					            }
                     }else{
            
                               $into = "unidadMedida_idunidadMedida,subCategoria_idsubCategoria,Marca_idMarca,Nombre,Referencia,Descripcion,FotoPrincipal,pesoVolumen";
                               $value = "'$aux[1]'".","."'$categoria'".","."'$isMarca'".","."'$nombreProducto'".","."'$referencia'".","."'$descripcion'".","."'$imagen'".","."'$unidad'";
                               $objInsert  = new ControladorInserttAllTables();
                               $result = $objInsert->insertInTable("Producto",$into,$value);
                               $returnValue = $this->validarInsertInTable($result,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio);

                   
		             }
             
             }
         return $returnValue;
	}

    private function validarInsertInTable($resultado,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio){
         $returnValue =""; 
           if($resultado != "Fallo"){
                   $idTienda = $objTiendaInicial->getIdEmpresa();
                   $intoAsociada2 = "Producto_idProducto,Empresa_idEmpresa,precioReal";
                   $result = $valueAsociada2 = "'$resultado'".","."'$idTienda'".","."'$precio'";
                   $objInsert->insertInTable("producto_has_empresa",$intoAsociada2,$valueAsociada2);
                         if($result!="Fallo"){
                                $returnValue = "Se registra el producto exitosamente";
						 }


                    
		   }else{
                $returnValue = "No se puede registrar el producto, comunicarse con el administrador";
		   }
           return $returnValue;
	}

//-----------------------------------Metodos para asociar Productos por empresa-----------------------------

    public function asociarProductoSeleccionado($idProductoAdd,$precioProductoAdd,$idTienda){
        $objInsert  = new ControladorInserttAllTables();
        $intoAsociada2 = "Producto_idProducto,Empresa_idEmpresa,precioReal";
        $valueAsociada2 = "'$idProductoAdd'".","."'$idTienda'".","."'$precioProductoAdd'";
        $result = $objInsert->insertInTable("producto_has_empresa",$intoAsociada2,$valueAsociada2);
        if($result!="Fallo"){
           echo "<script>toastr.info('Se asocia correcta mente el producto');</script>";
		}else{
           echo "<script>toastr.info('Se presenta un error asociando el producto');</script>";
		}
	}

}