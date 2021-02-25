<?php

require_once "conexion.php";

 class ModeloReceta{

     //**************************************************************** 
    // Muestra todas las categorias que tienen recetas en la tabla de recetas
    //**************************************************************** 

    static public function mdlMostrarRecetas($tabla1, $tabla2, $item1, $item2){

        $stmt = Conexion::conectar()->prepare(" SELECT DISTINCT nombre,ruta,count(nombre) as cantidad
                                                FROM $tabla1 A                                               
                                                INNER JOIN (SELECT DISTINCT * FROM $tabla2) B ON A.$item1 = B.$item2 group by A.nombre");
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 

     }

    //**************************************************************** 
    // Muestra todas las recetas por la categoria seleccionada
    //**************************************************************** 

    static public function ctrlMostrarRecetasPorCategoria($tabla1, $tabla2, $item1, $item2, $item3, $value1,$item4,$item5,$tabla3){

        $stmt = Conexion::conectar()->prepare(" select * from $tabla3 t1 inner join (SELECT * 
                                                FROM $tabla1 WHERE $item1 IN (SELECT $item2 FROM $tabla2 WHERE $item3 = :$item3))t2 on t1.$item4 = t2.$item5");
        $stmt -> bindParam(":".$item3, $value1, PDO::PARAM_STR);
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 

     }

     static public function ctrlConsultarReceta($tabla1,$tabla2,$item1,$item2,$item3,$idReceta){
        $stmt = Conexion::conectar()->prepare(" select * from $tabla1 t1 inner join (SELECT * 
                                                FROM $tabla2 WHERE $item3 = :$item3)t2 on t1.$item1 = t2.$item2");
        $stmt -> bindParam(":".$item3, $idReceta, PDO::PARAM_STR);
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
	 }

      static public function ajaxConsultarProductoXReceta($tabla1,$tabla2,$item3,$idReceta){
        $stmt = Conexion::conectar()->prepare(" select * from $tabla1  t1 inner join  (select * from $tabla2 where $item3 = :$item3) t2
                                                on t1.idProducto = t2.Producto_idProducto");
        $stmt -> bindParam(":".$item3, $idReceta, PDO::PARAM_STR);
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
	 }



    //**************************************************************** 
    // Registra los comentarios hechos en la receta
    //**************************************************************** 
    static public function ctrlRegistroComentarios($tabla , $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Persona_idPersona, Recetas_idRecetas ,descripcion)
                 VALUES  (:idPersona, :idReceta, :comentario)");
        
        $stmt->bindParam(":idPersona", $datos["idPersona"], PDO::PARAM_INT);
        $stmt->bindParam(":idReceta", $datos["idReceta"], PDO::PARAM_STR);
        $stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return"Error";
        }
        $stmt->close();
        $stmt=null;
    }

    static public function ajaxConsultarComentariosXReceta($tabla1,$item3,$idReceta){
        $stmt = Conexion::conectar()->prepare("select * from Persona t1 inner join(select * from $tabla1 where $item3 = :$item3) t2
                                               ON t1.Usuario_idUsuario = t2.Persona_idPersona order by t2.idcomentariosRecetas desc");
        $stmt -> bindParam(":".$item3, $idReceta, PDO::PARAM_STR);
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
	 }

     static public function ajaxValidarPalabraObcena($item,$palabras){
        $stmt = Conexion::conectar()->prepare("select * from palabrasobscena where $item in(:$item)");
        $stmt -> bindParam(":".$item, $palabras, PDO::PARAM_STR);
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
	 }


 }