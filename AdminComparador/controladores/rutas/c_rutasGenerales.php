<?php

class ControladorRutasGenerales{

        public function rutaArchivoAdjuntos(){
           return "../AdminComparador/archivos/";
        }

        public function rutaArchivosLogs(){
           return "../AdminComparador/bug&logs/";
        }
        public function nombreArchivoExcel($rturnName){
          if($rturnName=="Si"){
            return "NombreAPP Formato de carga.xls";
		  }else{
            return "../AdminComparador/formatos descargar/NombreAPP Formato de carga.xls";
		  }
           
        }
        //NombreAPP Formato de carga

        public function extensionArchivosLogs($modulo){

                switch ($accionActua) {
                        case "Adjuntar Archivo":
                            return "logTienda.log";
                            break;
                 }
        }

}