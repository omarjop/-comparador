<?php

class ControladorRutasGenerales{

        public function rutaArchivoAdjuntos(){
           return "archivos/";
        }

        public function rutaArchivosLogs(){
           return "bug&logs/";
        }

        public function extensionArchivosLogs($modulo){

                switch ($$accionActua) {
                        case "Adjuntar Archivo":
                            return "logTienda.log";
                            break;
                 }
        }

}