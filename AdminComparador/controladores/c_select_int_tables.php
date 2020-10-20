
<?php

class ControladorSelectsInTables{

        public function returnSelectAllRows($tabla){
                $objSelect = new ModeloSelectAllTables();
                $resultado =  $objSelect->selectAllRows($tabla);
                return $resultado;
        }

         public function returnSelectARowForField($tabla,$campo,$valueCampare){
                $objSelect = new ModeloSelectAllTables();
                $resultado =  $objSelect->selectARowForField($tabla,$campo,$valueCampare);
                return $resultado;
        }

         public function selectARowsInDb($sql){
                $objSelect = new ModeloSelectAllTables();
                $resultado =  $objSelect->selectARowsInDb($sql);
                return $resultado;
        }
        //retorna todos los registros  de una tabla
         public function selectTodosRegistros($tabla){
                $resultado = ModeloSelectAllTables:: selectTodosRegistros($tabla);
                return $resultado;
        }

        
}