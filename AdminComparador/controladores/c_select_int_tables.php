
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
}