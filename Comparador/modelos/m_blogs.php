<?php

require_once "conexion.php";

 class ModeloBlog{


    //**************************************************************** 
    // Muestra todas los blogs registrados en la base de datos
    //**************************************************************** 

    static public function ctrlMostrarBlogs($tabla,$tabla1){

        $stmt = Conexion::conectar()->prepare("select * from $tabla1 t1 INNER JOIN (select * from $tabla)t2 on t1.idPersona = t2.Persona_idPersona");        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 

     }

         static public function mdlMostrarBlogsForRuta($tabla , $item, $valor){

        if($item !=  "control"){
            
            $stmt = Conexion::conectar()->prepare("SELECT *  from Persona t1 INNER JOIN (SELECT * FROM $tabla WHERE $item = :$item) t2 on t1.idPersona = t2.Persona_idPersona");
            $stmt -> bindParam(":".$item, $valor,  PDO::PARAM_STR);
            $stmt -> execute();
            return  $stmt ->fetch(); 

        }else{
            
            $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $stmt -> execute();
            return  $stmt ->fetchAll(); 
        }
        $stmt ->  close();
        $stmt = null;
       
    }

        //**************************************************************** 
    // Registra los comentarios hechos en el blog
    //**************************************************************** 
    static public function mdlRegistroComentarios($tabla , $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Persona_idPersona, blog_idblog ,descripcion)
                 VALUES  (:idPersona, :idBlog, :comentario)");
        
        $stmt->bindParam(":idPersona", $datos["idPersona"], PDO::PARAM_INT);
        $stmt->bindParam(":idBlog", $datos["idBlog"], PDO::PARAM_STR);
        $stmt->bindParam(":comentario", $datos["comentario"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return"Error";
        }
        $stmt->close();
        $stmt=null;
    }


    static public function ajaxValidarPalabraObcena($item,$palabras){
        $stmt = Conexion::conectar()->prepare("select * from palabrasobscena where $item in(:$item)");
        $stmt -> bindParam(":".$item, $palabras, PDO::PARAM_STR);
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
	 }

     static public function mdlConsultarComentariosXBlog($tabla1,$item3,$idReceta){
        $stmt = Conexion::conectar()->prepare("select * from Persona t1 inner join(select * from $tabla1 where $item3 = :$item3) t2
                                               ON t1.Usuario_idUsuario = t2.Persona_idPersona order by t2.idcomentarios desc");
        $stmt -> bindParam(":".$item3, $idReceta, PDO::PARAM_STR);
        
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
	 }

 }