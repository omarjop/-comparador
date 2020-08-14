<?php

class ControladorEstructuras{

        public function estructuraArchivoPlano(){
           return  array('String nombre','Float','String unidad peso','Float','String','String','String','String');
        }       

        public function unidadesProductos(){
           return  array('gramos (gr)','kilogramos (kg)','mililitros (ml)','centimetros cubicos (cm3)');
        }    

        public function unidadesProductosValues($unidad){ 
          
            $arrayReturn = Array();
               switch ($unidad) {
                    case "gramos":
                        $arrayReturn = array('1.5','10','20','25','50','75','100','125','200','250','300','500','750');
                        break;
                    case "kilogramos":
                        $arrayReturn = array('1','2','2.5','3','4','5','8','10','12','15','20');
                        break;
                    case "mililitros":
                        $arrayReturn = array('100','125','150','200','250','300','500','1000','1500','2000','2500','3000','4000','5000');
                        break;
                    case "centimetros":
                        $arrayReturn = array('100','125','150','200','250','300','500','1000','1500','2000','2500','3000','4000','5000');
                        break;
                }
           
           return $arrayReturn;
        }   

}