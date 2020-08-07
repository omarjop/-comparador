
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


    public function validasiExtensionArchivo($archivo,$extension){
        if($_FILES[$archivo]['type'] != $extension){
           return false;  
		}else{
           return true;  
		}
	}


    public function validarSubirArchivoPlano($rutaArchivoAleer){
          
          $returnMensaje = array();

          $objFile =  new ControladorWorkLogs();
          $objModel =  new modelosWork();
          $resultReadFile = $objFile ->leerArchivoPlano($rutaArchivoAleer,"Si");
          $registrosPorLinea = array();

           if (count($resultReadFile)<2 && strlen($resultReadFile[0]) == 0){
    	          $objModel->modelVacio("El archivo se encuentra vacio");
	       }else{

                 foreach ($resultReadFile as $valorRegistro) {
                            if(strlen ($valorRegistro)){
                                  $valorRegistro = $valorRegistro."<br>";    
                                  array_push($registrosPorLinea, $valorRegistro);                                          
                              }
	               
                    }

                    
                    $returnMensaje = $this->validarRegistros($registrosPorLinea); 
                    $returnMensaje[0] = str_replace('<br>', '', $returnMensaje[0]);
                    $objModel->modelRegistrosErroneo($returnMensaje);
                    
	       }


           
      
	}

    public function validarRegistros($resultReadFile){
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
                    echo $registrosReturn."Registro a base de datos"."<br>";
				 }   
                  $totalRegistros+=1;
         }
      
         array_push($registrosErroneos, strval($countRegistrosExitosos));
         array_push($enviarRegistro, strval($totalRegistros));
         array_push($enviarArregloDeArreglo, $enviarRegistro);
         array_push($enviarArregloDeArreglo, $registrosErroneos);
         return $enviarArregloDeArreglo;
    	                     
    }

    private function validarFormatoRegistro($valorRegistro,$estructura){
            $valorOriginal = "";
            $porciones="";
            
            $resultadiFormato="";
            $valorRegistro = str_replace('<br>', '', $valorRegistro);
            $valorRegistro = preg_replace("/[\r\n|\n|\r]+/", PHP_EOL, $valorRegistro);
            
            if(strpos($valorRegistro, ";")){                  
                 $porciones = explode(";", $valorRegistro);
                 
                      if(sizeof($porciones)>3){
                            $resultadiFormato = $this->validarFormato($porciones,$estructura,$valorRegistro);
                            return $resultadiFormato;
				      }else{
                            $resultadiFormato= " Registro incompleto ";                               
				      }

            }else{   
                 $resultadiFormato =  "Error de estructura, falta el delimitador (;)";                
			}
            return $resultadiFormato;
	}

    private function validarFormato($registroSplit,$estructura,$valorRegistro){  
          $returnFormato = "Correcto";
          $tamanio = count($estructura);

          for ($i=0;$i<$tamanio;$i++) {
                 if($i==0 ||$i==1 || $i==2){
                        $returnFormato = $this->comparatorIntFloat($estructura[$i],$registroSplit[$i]);   
                        if($returnFormato!="Correcto"){
                           $returnFormato = "(".$registroSplit[$i].") ".$returnFormato;
                           break;
						}
				 }
          }
          return $returnFormato;
	}
       
	
    private function comparatorIntFloat($stuct,$parteRegistro){
        if($stuct=="Int"){
            return $this->isInt($parteRegistro," cantidad ");
		}else if($stuct=="Float"){
            return $this->isFloat($parteRegistro," precio ");
		}else if($stuct=="String"){
            return $this->isString($parteRegistro);
		}
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
    

}