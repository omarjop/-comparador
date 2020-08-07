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

}