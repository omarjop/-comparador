<?php
require_once "conexion.php";

class ModeloUpdateInTables{

private $db;
private $servicio;


   /*Este metodo realiza un insert a cualquier tabla parametros de entrada nombre de tabla, into y values*/
    public function updateInTables($sql){
           try{
                   $this->db = Conexion::conectar();                   
                    $result = $this->db->query($sql);
                    if ($result) {                        
                        return "Exitoso";
                    } else {
                        return "Fallo";
                    }
               }catch(Exception $e){
                   return "Fallo";
			   }
    }

        public function deleteInTables($sql){
           try{
                   $this->db = Conexion::conectar();                   
                    $result = $this->db->query($sql);
                    if ($result) {                        
                        return "Exitoso";
                    } else {
                        return "Fallo";
                    }
               }catch(Exception $e){
                   return "Fallo";
			   }
    }

        

}