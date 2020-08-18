<?php

class ControladorProductosTienda{

    public function registrarProducto($objTiendaInicial,$imagenValue){
        if(isset($_POST["guardar"])){         
            $this->validarCampos($objTiendaInicial,$imagenValue);
        }
    }

    private function validarCampos($objTiendaInicial,$imagenValue){
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
            $imagen = $_FILES[$imagenValue]['name'];
            $descripcion = $_POST["description"];
            $resultadoImagen = "Correcto";
            $unidad = $this->returnVolumen($unidaVolumen,$volumenGrams,$volumenKiloGrams,$volumenMililitros,$volumenCntimetro);

      // Validar el precio que este bien el formato
            $objValidarDato  = new ControladorAdjuntos();
            $resultado = $objValidarDato->isFloat($precio,"Precio");
            $resultadoNombre = $objValidarDato->isString($nombreProducto);



               if($imagen!="" ){
                    $resultadoImagen = $this->validarExtencionImagen($imagenValue);    
			   }
           
          if($unidaVolumen!="seleccion"&&$categoria!="seleccion"){
                if($resultadoImagen == "Correcto"){

                           if($resultadoNombre=="Correcto"){

                                    if($resultado!="Correcto"){
                                            $objModel->modelInformativo($resultado." Por favor ingresar un valor numerico y los decimales con el caracter(.)"); 
			                        }else{
                                                        $isMarca = $this->validarMarca($marca);
                                                        if($isMarca!="Falla en registro de base de datos"){
                                                             $returnrValue = $this->validarExisteProducto($categoria,$isMarca,$nombreProducto,$referencia,$descripcion,$imagen,$unidad,$objModel,$unidaVolumen,$objTiendaInicial,$precio,$imagenValue);
                                                             $objModel->modelInformativo($returnrValue);
								                        }else{
                                                             $objModel->modelInformativo("No se puede registrar el producto se presentaron problemas con la Marca comunicarse con el administrador"); 
								                        } 
			                        }
                               }else{
                                    $objModel->modelInformativo($resultadoNombre);
				               }

                   }else{
                             $objModel->modelInformativo("No es una imagen correcta para adjuntar");
			       }
           }else{
                      $objModel->modelInformativo("Peso/Volumen o Categoria, seleccione una opcion valida");  
		   }

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
               switch ($unidaVolumen) {
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
             $idReturn="";

             $campos = "idMarca";
             $condicion =" Descripcion = "."'$marca'";
             $resultado = $objSelects->returnSelectARowForField("marca",$campos,$condicion); 
             if($resultado){
                $idReturn = $resultado[0]["idMarca"];
			 }else{
                 $idReturn = $this->registrarMarca($marca,$objSelects); 
			 }
       return $idReturn;
	}

    public function registrarMarca($marca,$objSelects){
         $idReturn="";
         $into = "Descripcion";
         $value = "'$marca'";
         $objInsert  = new ModeloInserttAllTables();
         $result = $objInsert->insertInTable("marca",$into,$value);
         if( $result != "Fallo"){
             $campos = "idMarca";
             $condicion =" Descripcion = "."'$marca'";
             $resultado = $objSelects->returnSelectARowForField("marca",$campos,$condicion); 
             $idReturn = $resultado[0]["idMarca"];
             
		 }else{
            $idReturn = "Falla en registro de base de datos";           
		 }
         return $idReturn;
	}

    public function validarExisteProducto($categoria,$isMarca,$nombreProducto,$referencia,$descripcion,$imagen,$unidad,$objModel,$unidaVolumen,$objTiendaInicial,$precio,$imagenValue){
             $returnValue ="";
             $objSelects  = new ControladorSelectsInTables();
             $objValidarAdjunto = new ControladorAdjuntos();
             $campos = "idProducto";
             $condicion =" subCategoria_idsubCategoria = "."'$categoria'"." and "." Marca_idMarca = "."'$isMarca'"." and "." Nombre = "."'$nombreProducto'"." and "." Referencia = "."'$referencia'"." and "." pesoVolumen = "."'$unidad'";
             $resultado = $objSelects->returnSelectARowForField("producto",$campos,$condicion); 
             $idTienda = $objTiendaInicial->getIdEmpresa();

           if($imagen!=""&&$imagen!=null){
                    $imagen = "../AdminComparador/imagenes_productos/".$imagen;
             }

         if($resultado){
                 
                  $idProducto =$resultado[0]["idProducto"];
                  $campos2 = "*";
                  $condicion2 =" Producto_idProducto = "."'$idProducto'"." and "." Empresa_idEmpresa = "."'$idTienda'";
                  $resultado2 = $objSelects->returnSelectARowForField("producto_has_empresa",$campos2,$condicion2); 

                    if($resultado2){
                       $returnValue = "No se registra el producto, ya existe un producto con las mismas caracteristicas";
					}else{
                           $returnValue = $this->validarInsertInTable($idProducto,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio);  
                           if($imagen!=""&&$imagen!=null){
                               $objValidarAdjunto->SubirArchivoImagen($imagenValue);
                           }
					}
         }else{
            
                   $into = "subCategoria_idsubCategoria,Marca_idMarca,Nombre,Referencia,Descripcion,FotoPrincipal,pesoVolumen";
                   $value = "'$categoria'".","."'$isMarca'".","."'$nombreProducto'".","."'$referencia'".","."'$descripcion'".","."'$imagen'".","."'$unidad'";
                   $objInsert  = new ModeloInserttAllTables();
                   $result = $objInsert->insertInTable("Producto",$into,$value);
                   $returnValue = $this->validarInsertInTable($result,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio);
                   if($imagen!=""&&$imagen!=null){
                               $objValidarAdjunto->SubirArchivoImagen($imagenValue);
                   }
                   
		 }
         return $returnValue;
	}

    private function validarInsertInTable($resultado,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio){
         $returnValue =""; 
           if($resultado != "Fallo"){
                   $intoAsociada = "Producto_idProducto,nombreMedida";
                   $valueAsociada = "'$resultado'".","."'$unidaVolumen'";
                   $result = $objInsert->insertInTable("unidadmedida",$intoAsociada,$valueAsociada);
                   $idTienda = $objTiendaInicial->getIdEmpresa();
                   $intoAsociada2 = "Producto_idProducto,Empresa_idEmpresa,precioReal";
                   $valueAsociada2 = "'$resultado'".","."'$idTienda'".","."'$precio'";
                   $objInsert->insertInTable("producto_has_empresa",$intoAsociada2,$valueAsociada2);
                         if($result!="Fallo"){
                                $returnValue = "Se registra con exito el Producto";
						 }


                    
		   }else{
                $returnValue = "No se puede registrar el producto, comunicarse con el administrador";
		   }
           return $returnValue;
	}

}