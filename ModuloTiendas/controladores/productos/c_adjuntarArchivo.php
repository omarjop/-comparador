
<?php

class ControladorAdjuntos{

    public function SubirArchivoPlano($archivo,$ruta,$nitUser){
        
            $rutaFinal;
            $rutaFinal= $ruta.$nitUser."folder";
            $path = $rutaFinal;

            if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                             $rutaFinal= $rutaFinal."/";
                            $fichero_subido = $rutaFinal.basename($_FILES[$archivo]["name"]);          
                            if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $fichero_subido)) {
                                              return true;
                             } else {
                                              return false;
                            }

            }else{
                        $rutaFinal= $rutaFinal."/";
                        $fichero_subido = $rutaFinal.basename($_FILES[$archivo]["name"]);          
                        if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $fichero_subido)) {
                                          return true;
                         } else {
                                          return false;
                        }
                       
			}


    }

        public function SubirArchivoImagen($archivo){
        
            $rutaFinal;
            $rutaFinal= "../AdminComparador/imagenes_productos";
            $path = $rutaFinal;

            if (!file_exists($path)) {
                            mkdir($path, 0777, true);
                             $rutaFinal= $rutaFinal."/";
                            $fichero_subido = $rutaFinal.basename($_FILES[$archivo]["name"]);          
                            if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $fichero_subido)) {
                                              return true;
                             } else {
                                              return false;
                            }

            }else{
                        $rutaFinal= $rutaFinal."/";
                        $fichero_subido = $rutaFinal.basename($_FILES[$archivo]["name"]);          
                        if (move_uploaded_file($_FILES[$archivo]['tmp_name'], $fichero_subido)) {
                                          return true;
                         } else {
                                          return false;
                        }
                       
			}


    }


    public function validasiExtensionArchivo($archivo,$extension){
       
        if($_FILES[$archivo]['type'] != $extension){
          
           return false;  
		}else{
           
           return true;  
		}
	}

     public function validaExtensionImagen($archivo,$extension){
            $filename = $_FILES[$archivo]['name'];           
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if( $ext !== $extension) {
               return false; 
            }else{
               return true; 
			}

	}

    public function validarSubirArchivoPlano($objTiendaInicial,$rutaArchivoAleer){
          
          $returnMensaje = array();

          $objFile =  new ControladorWorkLogs();
          $objModel =  new modelosWork();
          $resultReadFile = $objFile ->leerArchivoExcel($rutaArchivoAleer,"Si");
          $registrosPorLinea = array();

           if (count($resultReadFile)==0 ){
    	          $objModel->modelVacio("El archivo se encuentra vacio");
	       }else{

                 foreach ($resultReadFile as $valorRegistro) {
                            if(strlen ($valorRegistro)){
                                  $valorRegistro = $valorRegistro."<br>";    
                                  array_push($registrosPorLinea, $valorRegistro);                                          
                              }
	               
                    }

                    
                    $returnMensaje = $this->validarRegistros($objTiendaInicial,$registrosPorLinea); 
                    $returnMensaje[0] = str_replace('<br>', '', $returnMensaje[0]);
                    $objModel->modelRegistrosErroneo($returnMensaje);
                    
	       }


           
      
	}

    public function validarRegistros($objTiendaInicial,$resultReadFile){
         $registrosErroneos = array();
         $enviarRegistro = array();
         $enviarArregloDeArreglo = array();
         $objEstructura =  new ControladorEstructuras();
          $objModel =  new modelosWork();
         $estructura = $objEstructura -> estructuraArchivoPlano();
         $countRegistrosExitosos=0;
         $totalRegistros=0;

         for ($i=0;$i<count($resultReadFile);$i++) {
                 $registrosReturn = $this->validarFormatoRegistro($resultReadFile[$i],$estructura);
                 
                if($registrosReturn!="Correcto"){
                    //$registrosReturn = $registrosReturn."<br>";
                     array_push($registrosErroneos, $registrosReturn);
                     array_push($enviarRegistro, $resultReadFile[$i]);
                     
			     }else{
                    // se envia el registro a la tabla de la base de datos y retornar mensaje de exito
                    $countRegistrosExitosos+=1;
                    $this->ValidaYRegistraEnBaseDatos($objTiendaInicial,$resultReadFile[$i]);
                    //echo $registrosReturn."Registro a base de datos"."<br>";
				 }   
                  $totalRegistros+=1;
         }
      
         array_push($registrosErroneos, strval($countRegistrosExitosos));
         array_push($enviarRegistro, strval($totalRegistros));
         array_push($enviarArregloDeArreglo, $enviarRegistro);
         array_push($enviarArregloDeArreglo, $registrosErroneos);
         return $enviarArregloDeArreglo;
    	                     
    }
//Desde aqui se inicia el registro en base de datos.
    private function ValidaYRegistraEnBaseDatos($objTiendaInicial,$valorRegistro){
            $imagen=null;
            $porciones="";            
            $objRegistroProdcut = new ControladorProductosTienda();
            $objSelect = new ControladorSelectsInTables();
            $objModel =  new modelosWork();
            $porciones = $this->lismpiarString($valorRegistro);
            $idMarca = $objRegistroProdcut->validarMarca($porciones[5]);
            $aux = $porciones[6];

            $ValueCampo = " nombre = "."'$aux'";
            $idCategoria = $objSelect->returnSelectARowForField("subcategoria","idsubCategoria",$ValueCampo);
            
            $auxUnidad = $porciones[3];
                $auxUnidad = str_replace('<br>', '', $auxUnidad);
                $auxUnidad = preg_replace("/[\r\n|\n|\r]+/", PHP_EOL, $auxUnidad);  
                
            
             if($idMarca!="Falla en registro de base de datos"){
                  $returnrValue = $objRegistroProdcut->validarExisteProducto($idCategoria[0]["idsubCategoria"],$idMarca,$porciones[0],$porciones[4],$porciones[7],$imagen,$auxUnidad,$objModel,$porciones[2],$objTiendaInicial,$porciones[1],$imagen);                  
                 // echo $returnrValue;
			 }else{
                  //$objModel->modelInformativo("No se puede registrar el producto se presentaron problemas con la Marca comunicarse con el administrador"); 
			 } 
            
	}

//todos los siguientes metodos son los de valdar si el registro cumple con el minimo requerido para poder ser registrado en base detos
    private function validarFormatoRegistro($valorRegistro,$estructura){
            $valorOriginal = "";
            $porciones="";
            
            $resultadiFormato="";
            $porciones = $this->lismpiarString($valorRegistro);
                 
                      if(sizeof($porciones)>3){
                            $resultadiFormato = $this->validarFormato($porciones,$estructura,$valorRegistro);
                            return $resultadiFormato;
				      }else{
                            $resultadiFormato= " Registro incompleto ";                               
				      }
            return $resultadiFormato;
	}

    private function lismpiarString($valorRegistro){           
            
         $porciones="";
         if($valorRegistro!=null){
                $valorRegistro = str_replace('<br>', '', $valorRegistro);
                $valorRegistro = preg_replace("/[\r\n|\n|\r]+/", PHP_EOL, $valorRegistro);                        
                $porciones = explode(";", $valorRegistro);        
		 }       
         return $porciones;   
	}

    private function validarFormato($registroSplit,$estructura,$valorRegistro){  
          $returnFormato = "Correcto";
          $tamanio = count($estructura);
          $requeridos = $this->validarRequeridos($registroSplit);

            
                if($requeridos=="Correcto"){
                      for ($i=0;$i<$tamanio;$i++) {
                             if($i==0 ||$i==1 || $i==2 || $i==3){
                                    $returnFormato = $this->comparatorIntFloat($estructura[$i],$registroSplit[$i]);   
                                    if($returnFormato!="Correcto"){
                                       $returnFormato = "(".$registroSplit[$i].") ".$returnFormato;
                                       break;
						            }
				             }
                      }
                   }else{
                            $returnFormato = $requeridos;
				   }
           return $returnFormato;
	}
       
    private function validarRequeridos($registroSplit){
          $returnFormato = "Correcto";
          $tamanio = count($registroSplit);

          for ($i=0;$i<$tamanio;$i++) {
                if(($i==0 || $i==1 || $i==4 || $i==5 || $i==6)&&$registroSplit[$i]==""){
                            //$returnFormato = "El nombre del producto es indispensable";
                            $returnFormato = $this->vakidaMensaje($i);
                            if($returnFormato!="Correcto"){
                               break;
							}
				}
          }
          return $returnFormato;
	}

    private function vakidaMensaje($i){
       $returnFormato = "Correcto";
              switch ($i) {
                        case 0:
                            $returnFormato = "La celda Nombre Producto no puede estar vacia ";
                            break;
                        case 1:
                             $returnFormato =  "La celda Precio no puede estar vacia ";
                            break;
                        case 4:
                             $returnFormato =  "La celda Referencia no puede estar vacia ";
                            break;
                        case 5:
                             $returnFormato =  "La celda Marca no puede estar vacia ";
                            break;
                        case 6:
                             $returnFormato =  "La celda Categoria no puede estar vacia ";
                            break;
                  }
                  return $returnFormato;
	}
	
    private function comparatorIntFloat($stuct,$parteRegistro){
       $valorReturn = "Correcto";
        if($stuct=="Int"){
            $valorReturn = $this->isInt($parteRegistro," cantidad ");
		}else if($stuct=="Float"){
            $valorReturn = $this->isFloat($parteRegistro," precio o valor numerico de peso o volumen ");
		}else if($stuct=="String nombre"){
            $valorReturn = $this->isString($parteRegistro);
		}else if($stuct=="String unidad peso"&&$parteRegistro!=""){
            $valorReturn = $this->isStringUnidad($parteRegistro);
		}

        return $valorReturn;
	}

    public function isInt($parteRegistro,$mensaje){
           try{                   
                   if (is_numeric($parteRegistro)){
                      return "Correcto";
	               }else{
                      return "No es una ".$mensaje." valida";
	               }
		   }catch(Exception $e){
                return "No es una ".$mensaje." valida";
		   }
           
           
	}
    public function isFloat($parteRegistro,$mensaje){
               try{                   
                  
                   if (is_numeric($parteRegistro)){
                      return "Correcto";
	               }else{
                      return "No es un ".$mensaje." valido";
	               }
		   }catch(Exception $e){
                return "No es un ".$mensaje." valido";
		   }

	}

        public function isString($parteRegistro){

               try{                   
                  
                   if (is_numeric($parteRegistro)){
                      return "No es un nombre de producto valido";                      
	               }else{
                      return "Correcto";
	               }
		   }catch(Exception $e){
                return "Para ser un valor flotante.";
		   }

	}

    
    public function isStringUnidad($parteRegistro){
         $unidades = Array("Kilogramo (Kg)","Gramos (gr)","Mililitros (ml)","Centímetros cúbicos (cm3)");
         $valorReturn = "El valor de la unidad peso/volumen no cincide con la lista mostrada en el excel";
         foreach($unidades as $unidad){
              if($unidad==$parteRegistro){
                  $valorReturn = "Correcto";
                  break;
              }
		 }

         return $valorReturn;
	 }
    

}