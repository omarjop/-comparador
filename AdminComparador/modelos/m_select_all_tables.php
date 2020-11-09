<?php
require_once "conexion.php";

class ModeloSelectAllTables{

private $db;
private $servicio;


   /*Este metodo retorna todos los registros de una tabla dada*/
    public function selectAllRows($tabla){

           try{
                   $this->db = Conexion::conectar();
                   $sql = "select * from ".$tabla;
                   foreach ($this->db->query($sql) as $res) {
                        $this->servicio[] = $res;
                    }
                    return $this->servicio;
                    $this->db = null;
              }catch(Exception $e){
                   return "Fallo";
			  }

    }
    
   public function selectARowForField($tabla,$campos,$condicion){
      try{
                   $this->db = Conexion::conectar();
                   $sql = "select ".$campos." from ".$tabla." where ".$condicion;
                   foreach ($this->db->query($sql) as $res) {
                        $this->servicio[] = $res;
                    }
                    return $this->servicio;
                    $this->db = null;
            }catch(Exception $e){
                   return "Fallo";
		}

    }

     public function selectARowsInDb($sql){
             try{
                   $this->db = Conexion::conectar();                  
                   foreach ($this->db->query($sql) as $res) {
                        $this->servicio[] = $res;
                    }
                    return $this->servicio;
                    $this->db = null;
            }catch(Exception $e){
                   return "Fallo";
		    }

     }

//Retorna todos los registros de una tabla
     public function selectTodosRegistros($tabla){
        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
        $stmt ->  execute();
        return  $stmt ->fetchAll(); 
        $stmt -> close();
        $stmt = null;
	 }
        

}