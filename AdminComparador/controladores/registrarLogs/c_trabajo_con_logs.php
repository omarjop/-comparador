<?php

class ControladorWorkLogs{

     public function escribirEnLog($modulo,$tipoLog,$nit,$descripcion){
         $fecha = date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
         $descripcionLog = "[".$fecha."]"."[".$modulo."]"."[".$tipoLog."]".": ".$descripcion;
         $descripcionLog = $descripcionLog."\n";

          $objRutas =  new ControladorRutasGenerales();

         $file = fopen($objRutas ->rutaArchivosLogs().$nit."logTienda.log", "a");
          if($file){
               fwrite($file, $descripcionLog . PHP_EOL);
               fclose($file);          
		  }else{
                        echo "No se encuentra el archivo";  
		  }


	 }

     public function escribirEnLogAdmin($modulo,$tipoLog,$descripcion){
         $fecha = date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
         $descripcionLog = "[".$fecha."]"."[".$modulo."]"."[".$tipoLog."]".": ".$descripcion;
         $descripcionLog = $descripcionLog."\n";

          $objRutas =  new ControladorRutasGenerales();

         $file = fopen($objRutas ->rutaArchivosLogs().$nit."logAdministracion.log", "a");
          if($file){
               fwrite($file, $descripcionLog . PHP_EOL);
               fclose($file);          
		  }else{
                        echo "No se encuentra el archivo";  
		  }


	 }

     public function leerArchivoPlano($rutaArchivo,$eliminar){
         
         try{
                     $registros = array();                   

                     if(file_exists($rutaArchivo)){

                                $fp = fopen($rutaArchivo, "r");
                                while(!feof($fp)) {

                                    $linea = fgets($fp);
                                    array_push($registros, $linea);
                                }
                                if($eliminar=="Si"){                                   
                                    unlink($rutaArchivo);
                                }
                                fclose($fp);
                    }else{
                       return "La siguiente ruta de archivo no existe: ".$rutaArchivo;
					}
                    
                    return $registros;
            }catch(Exception $e){
                 return "Error leyendo el archivo: ".$rutaArchivo." El error: ".$e;
			}

     }

          public function leerArchivoExcel($archivo,$eliminar){
         
         try{
                     $registros = array();     
                     require_once 'PHPExcel/Classes/PHPExcel.php';
                     $inputFileType = PHPExcel_IOFactory::identify($archivo);
                     $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                     $objPHPExcel = $objReader->load($archivo);
                     $sheet = $objPHPExcel->getSheet(0); 
                     
                     $highestRow = $sheet->getHighestRow(); 
                     $highestColumn = $sheet->getHighestColumn();

                     
                     for ($row = 2; $row <= $highestRow; $row++){ 

                        $rgistro=""; 
                        $rgistro1=$sheet->getCell("A".$row)->getValue();
                        $rgistro2=$sheet->getCell("B".$row)->getValue();
                        $rgistro3=$sheet->getCell("C".$row)->getValue();
                        $rgistro4=$sheet->getCell("D".$row)->getValue();
                        $rgistro5=$sheet->getCell("E".$row)->getValue();
                        $rgistro6=$sheet->getCell("F".$row)->getValue();
                        $rgistro7=$sheet->getCell("G".$row)->getValue();
                        $rgistro8=$sheet->getCell("H".$row)->getValue();

                      
                        $rgistro = $sheet->getCell("A".$row)->getValue().";".$sheet->getCell("B".$row)->getValue().";".$sheet->getCell("C".$row)->getValue().";".$sheet->getCell("D".$row)->getValue().";".
                           $sheet->getCell("E".$row)->getValue().";".$sheet->getCell("F".$row)->getValue().";".$sheet->getCell("G".$row)->getValue().";".$sheet->getCell("H".$row)->getValue();
                           if(($rgistro1||$rgistro2||$rgistro3||$rgistro4||$rgistro5||$rgistro6||$rgistro7||$rgistro8)!=""){
                             array_push($registros, $rgistro);
					       }
                       
		               
                     }


                    return $registros;
            }catch(Exception $e){
                 return "Error leyendo el archivo: ".$rutaArchivo." El error: ".$e;
			}

     }

}