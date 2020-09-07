
<?php

class ControladorUpdateDeleteInTables{

        public function UpdateInTable($sql){
                $objUpdate = new ModeloUpdateInTables();
                $resultado =  $objUpdate->updateInTables($sql);
                return $resultado;
        }


        public function deleteInTables($sql){
                $objUpdate = new ModeloUpdateInTables();
                $resultado =  $objUpdate->deleteInTables($sql);
                return $resultado;
        }
        
}