<?php
require_once "conexion.php";

class ModeloSelectAllTables{

private $db;
private $servicio;


   /*Este metodo retorna todos los registros de una tabla dada*/
    public function selectAllRows($tabla){
           $this->db = Conexion::conectar();
           $sql = "select * from ".$tabla;
           foreach ($this->db->query($sql) as $res) {
                $this->servicio[] = $res;
            }
            return $this->servicio;
            $this->db = null;
    }
    
   public function selectARowForField($tabla,$campos,$condicion){
           $this->db = Conexion::conectar();
           $sql = "select ".$campos." from ".$tabla." where ".$condicion;
           foreach ($this->db->query($sql) as $res) {
                $this->servicio[] = $res;
            }
            return $this->servicio;
            $this->db = null;
    }
        

}