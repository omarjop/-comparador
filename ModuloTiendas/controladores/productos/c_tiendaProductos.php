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
            $imagen = "null"; //$_POST["image"];
            $descripcion = $_POST["description"];

            $unidad = $this->returnVolumen($unidaVolumen,$volumenGrams,$volumenKiloGrams,$volumenMililitros,$volumenCntimetro);

      // Validar el precio que este bien el formato
            $objValidarDato  = new ControladorAdjuntos();
            $resultado = $objValidarDato->isFloat($precio,"Precio");
            $resultadoNombre = $objValidarDato->isString($nombreProducto);


               if($resultadoNombre=="Correcto"){

                        if($resultado!="Correcto"){
                                $objModel->modelInformativo($resultado." por favor ingresar un valor numerico y los decimales con el caracter(.)"); 
			            }else{
                                            $isMarca = $this->validarMarca($marca);
                                            if($isMarca!="Falla en registro de base de datos"){
                                                 $this->validarExisteProducto($categoria,$isMarca,$nombreProducto,$referencia,$descripcion,$imagen,$unidad,$objModel,$unidaVolumen,$objTiendaInicial,$precio);
								            }else{
                                                 $objModel->modelInformativo("No se puede registrar el producto se presentaron problemas con la Marca comunicarse con el administrador"); 
								            } 
			            }
                   }else{
                        $objModel->modelInformativo($resultadoNombre);
				   }


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


    private function validarMarca($marca){
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
                 $idMarca = $this->registrarMarca($marca,$objSelects); 
			 }
       return $idReturn;
	}

    private function registrarMarca($marca,$objSelects){
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

    private function validarExisteProducto($categoria,$isMarca,$nombreProducto,$referencia,$descripcion,$imagen,$unidad,$objModel,$unidaVolumen,$objTiendaInicial,$precio){

             $objSelects  = new ControladorSelectsInTables();
             $campos = "idProducto";
             $condicion =" subCategoria_idsubCategoria = "."'$categoria'"." and "." Marca_idMarca = "."'$isMarca'"." and "." Nombre = "."'$nombreProducto'"." and "." Referencia = "."'$referencia'"." and "." pesoVolumen = "."'$unidad'";
             $resultado = $objSelects->returnSelectARowForField("producto",$campos,$condicion); 
             $idTienda = $objTiendaInicial->getIdEmpresa();

         if($resultado){
                 
                  $idProducto =$resultado[0]["idProducto"];
                  $campos2 = "*";
                  $condicion2 =" Producto_idProducto = "."'$idProducto'"." and "." Empresa_idEmpresa = "."'$idTienda'";
                  $resultado2 = $objSelects->returnSelectARowForField("producto_has_empresa",$campos2,$condicion2); 
                    if($resultado2){
                        $objModel->modelInformativo("No se registrael producto, ya existe un producto con las mismas caracteristicas"); 
					}else{
                           $into = "subCategoria_idsubCategoria,Marca_idMarca,Nombre,Referencia,Descripcion,FotoPrincipal,pesoVolumen";
                           $value = "'$categoria'".","."'$isMarca'".","."'$nombreProducto'".","."'$referencia'".","."'$descripcion'".","."'$imagen'".","."'$unidad'";
                           $objInsert  = new ModeloInserttAllTables();
                           $result = $objInsert->insertInTable("Producto",$into,$value);
                           $this->validarInsertInTable($result,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio);                    
					}
         }else{
            
                   $into = "subCategoria_idsubCategoria,Marca_idMarca,Nombre,Referencia,Descripcion,FotoPrincipal,pesoVolumen";
                   $value = "'$categoria'".","."'$isMarca'".","."'$nombreProducto'".","."'$referencia'".","."'$descripcion'".","."'$imagen'".","."'$unidad'";
                   $objInsert  = new ModeloInserttAllTables();
                   $result = $objInsert->insertInTable("Producto",$into,$value);
                   $this->validarInsertInTable($result,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio);
                   
		 }
	}

    private function validarInsertInTable($resultado,$objModel,$unidaVolumen,$objInsert,$objTiendaInicial,$precio){


           if($resultado != "Fallo"){
                   $intoAsociada = "Producto_idProducto,nombreMedida";
                   $valueAsociada = "'$resultado'".","."'$unidaVolumen'";
                   $result = $objInsert->insertInTable("unidadmedida",$intoAsociada,$valueAsociada);
                   $idTienda = $objTiendaInicial->getIdEmpresa();
                   $intoAsociada2 = "Producto_idProducto,Empresa_idEmpresa,precioReal";
                   $valueAsociada2 = "'$resultado'".","."'$idTienda'".","."'$precio'";
                   $objInsert->insertInTable("producto_has_empresa",$intoAsociada2,$valueAsociada2);
                         if($result!="Fallo"){
                                $objModel->modelInformativo("Se registra con exito el Producto");
						 }
                    
		   }else{
                $objModel->modelInformativo("No se puede registrar el producto error en insert comunicar con administrador"); 
		   }
	}

}