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
    //**************************************************************** 
    // Metodo que registra las recetas en base de datos
    //**
      static public function mdlRegitrarRecetasInDB($tabla,$datos){

             $stmt = Conexion2::conectar2()->prepare("INSERT INTO $tabla(dificultad_iddificultad,categoria_idCategoria,Persona_idPersona,nombreReceta,calificacion,contarVotos,tiempo,porciones,rutaImagen,rutaVideo,contenido)
                                                    VALUES  (:dificultad, :categoria, :idpersona, :nombre, :calificacion, :votos, :tiempo, :porciones, :imgReceta, :video, :contenido)");
        
            $stmt->bindParam(":dificultad", $datos["dificultadReceta"], PDO::PARAM_INT);
            $stmt->bindParam(":categoria", $datos["categoriaReceta"], PDO::PARAM_INT);
            $stmt->bindParam(":idpersona", $datos["idPersona"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nameReceta"], PDO::PARAM_STR);
            $stmt->bindParam(":calificacion", $datos["calificacion"], PDO::PARAM_INT);
            $stmt->bindParam(":votos", $datos["votos"], PDO::PARAM_INT);
            $stmt->bindParam(":tiempo", $datos["timeReceta"], PDO::PARAM_INT);

            $stmt->bindParam(":porciones", $datos["porcionesReceta"], PDO::PARAM_INT);
            $stmt->bindParam(":imgReceta", $datos["imgRecetaAdd"], PDO::PARAM_STR);
            $stmt->bindParam(":video", $datos["videoReceta"], PDO::PARAM_STR);
            $stmt->bindParam(":contenido", $datos["contenidoReceta"], PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return"Error"+$datos;
            }
            $stmt->close();
            $stmt=null;
      }

    //**************************************************************** 
    // Metodo que consulta receta dado el id
    //**
    static public function mdlMostrarRecetaXId($tabla,$campo,$idReceta){
            $stmt = Conexion2::conectar2()->prepare("select * from $tabla where $campo = :$campo ");   
            $stmt -> bindParam(":".$campo, $idReceta,  PDO::PARAM_STR);
            $stmt -> execute();
            return  $stmt ->fetchAll();   
    }

    //**************************************************************** 
    // Metodo que consulta receta dado el id y relacionada con otra tabla
    //**
    static public function mdlFindRecetaInDBXIdJoin($tabla,$campo,$tabla2,$campo2,$idReceta){
            $stmt = Conexion2::conectar2()->prepare("select * from $tabla2 t1 inner join(select * from $tabla where $campo = :$campo)t2 on t1.$campo2 = t2.$campo");   
            $stmt -> bindParam(":".$campo, $idReceta,  PDO::PARAM_STR);
            $stmt -> execute();
            return  $stmt ->fetchAll();   
    }

    //**************************************************************** 
    // Metodo que consulta todos los productos
    //**
    static public function mdlMostrarProductos($tabla,$columna,$tabla2,$columna2,$columna3,$idReceta){
            $stmt = Conexion2::conectar2()->prepare("select * from $tabla where $columna not in (select $columna2 from $tabla2 where $columna3 = :$columna3)");   
            $stmt -> bindParam(":".$columna3, $idReceta,  PDO::PARAM_INT);
            $stmt -> execute();
            return  $stmt ->fetchAll();   
    }

    //**************************************************************** 
    // Metodo que elimina la receta y sus productos asociados
    //**
    static public function ctrlDeleeRecetaInDBXId($idReceta,$tabla,$columna){
            $stmt = Conexion2::conectar2()->prepare("delete from $tabla where $columna = :$columna"); 
            $stmt -> bindParam(":".$columna, $idReceta,  PDO::PARAM_INT);
            $stmt -> execute();
            return  $stmt ->fetchAll();   
    }

    //**************************************************************** 
    // Metodo que consulta todos los productos relacionados a una receta
    //**
    static public function mdlFindProductsRecetaInDBXId($idReceta,$tabla,$columna,$tabla2,$columna2,$columna3){
            $stmt = Conexion2::conectar2()->prepare("select * from $tabla t3 inner join (select * from $tabla2 where $columna3 = :$columna3) t4
                                                     on t3.$columna = t4.$columna2 ");   
            $stmt -> bindParam(":".$columna3, $idReceta,  PDO::PARAM_INT);
            $stmt -> execute();
            return  $stmt ->fetchAll();   
    }

    //**************************************************************** 
    // Metodo que elimina producto asociado a receta
    //**
    static public function mdlDeleeProductFromReceta($idReceta,$idProducto,$tabla,$columna,$columna1){
            $stmt = Conexion2::conectar2()->prepare("delete from $tabla where $columna = :$columna and $columna1 = :$columna1"); 
            $stmt -> bindParam(":".$columna, $idReceta,  PDO::PARAM_INT);
            $stmt -> bindParam(":".$columna1, $idProducto,  PDO::PARAM_INT);
            $stmt -> execute();
            return  $stmt ->fetchAll();   
    }

    //**************************************************************** 
    // Metodo que asocia un producto a una receta
    //**
      static public function mdlAsociarProductInReceta($datos,$tabla){

             $stmt = Conexion2::conectar2()->prepare("INSERT INTO $tabla(Producto_idProducto,Recetas_idRecetas,cantidad)
                                                    VALUES  (:producto, :receta, :cantidad)");
                                                   
        
            $stmt->bindParam(":producto", $datos["idproducto"], PDO::PARAM_INT);
            $stmt->bindParam(":receta", $datos["idreceta"], PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $datos["cantproducto"], PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return"Error"+$datos;
            }
            $stmt->close();
            $stmt=null;
      }
    //**************************************************************** 
    // Metodo que edita la cantidad de producto de una receta
    //**
      static public function mdlEditarCantidadProductoReceta($datos,$tabla){

             $stmt = Conexion2::conectar2()->prepare("UPDATE $tabla SET cantidad = :cantidad WHERE Producto_idProducto = :producto AND Recetas_idRecetas = :receta");                                                   
        
            $stmt->bindParam(":producto", $datos["idproducto"], PDO::PARAM_INT);
            $stmt->bindParam(":receta", $datos["idreceta"], PDO::PARAM_INT);
            $stmt->bindParam(":cantidad", $datos["cantproducto"], PDO::PARAM_STR);

            if($stmt->execute()){
                return "ok";
            }else{
                return"Error"+$datos;
            }
            $stmt->close();
            $stmt=null;
      }
 }