<?php

require_once "conexion2.php";

 class ModeloAdminReceta{


    //**************************************************************** 
    // Muestra todas los blogs registrados en la base de datos
    //**************************************************************** 

    static public function mdlMostrarRecetas($tabla){

        $stmt = Conexion2::conectar2()->prepare("select * from $tabla");        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
     }

 }