<?php

require_once "conexion2.php";

 class ModeloAdminReceta{


    //**************************************************************** 
    // Muestra todas las recetas registradas en la base de datos
    //**************************************************************** 

    static public function mdlMostrarRecetas($tabla){

        $stmt = Conexion2::conectar2()->prepare("select * from $tabla");        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
     }
    //**************************************************************** 
    // Muestra todas las categorias de recetas registradas en la base de datos
    //**
    static public function mdlMostrarCategoriaRecetas($tabla,$campo,$control){

        $stmt = Conexion2::conectar2()->prepare("select * from $tabla where $campo = :$campo ");   
        $stmt -> bindParam(":".$campo, $control,  PDO::PARAM_STR);
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
     }

 }