<?php
require_once "conexion.php";

class ModeloInsertInTables{

private $db;
private $servicio;


   /*Este metodo realiza un insert a cualquier tabla parametros de entrada nombre de tabla, into y values*/
    public function insertInTables($tabla,$into,$values){
           try{
                   $this->db = Conexion::conectar();
                    $sql = "INSERT INTO ".$tabla."(".$into.") VALUES (".$values.")";
                    $result = $this->db->query($sql);

                    if ($result) {                        
                        return $this->db->lastInsertId(); //Retorna el id del registro inseertado
                    } else {
                        return "Fallo";
                    }
               }catch(Exception $e){
                   return "Fallo";
			   }
    }


        

}