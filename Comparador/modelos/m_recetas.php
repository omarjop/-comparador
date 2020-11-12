<?php

require_once "conexion.php";

 class ModeloReceta{

     //**************************************************************** 
    // Muestra todas las categorias que tienen recetas en la tabla de recetas
    //**************************************************************** 

    static public function mdlMostrarRecetas($tabla1, $tabla2, $item1, $item2){

        $stmt = Conexion::conectar()->prepare(" SELECT DISTINCT nombre,ruta 
                                                FROM $tabla1 A                                               
                                                INNER JOIN (SELECT DISTINCT * FROM $tabla2) B ON A.$item1 = B.$item2");
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 

     }

    //**************************************************************** 
    // Muestra todas las recetas por la categoria seleccionada
    //**************************************************************** 

    static public function ctrlMostrarRecetasPorCategoria($tabla1, $tabla2, $item1, $item2, $item3, $value1){

        $stmt = Conexion::conectar()->prepare(" SELECT * 
                                                FROM $tabla1 WHERE $item1 IN (SELECT $item2 FROM $tabla2 WHERE $item3 = :$item3)");
        $stmt -> bindParam(":".$item3, $value1, PDO::PARAM_STR);
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 

     }
 }