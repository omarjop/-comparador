<?php

require_once "conexion.php";

 class ModeloUsuarios{

    static public function mdlRegistroUsuario($tabla , $datos){

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(Perfil_idPerfil, correo, Clave, verificar, modoAcceso, fechaRegistro, emailEncriptado)
                 VALUES  (:Perfil_idPerfil, :correo, :Clave, :verificar, :modoAcceso, :fechaRegistro, :emailEncriptado)");
        
        $stmt->bindParam(":Perfil_idPerfil", $datos["perfil"], PDO::PARAM_INT);
        $stmt->bindParam(":correo", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":Clave", $datos["clave"], PDO::PARAM_STR);
        $stmt->bindParam(":verificar", $datos["verificacion"], PDO::PARAM_INT);
        $stmt->bindParam(":modoAcceso", $datos["modoAcceso"], PDO::PARAM_STR);
        $stmt->bindParam(":fechaRegistro", $datos["fechaRegistro"], PDO::PARAM_STR);
        $stmt->bindParam(":emailEncriptado", $datos["emailEncriptado"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        }else{
            return"Error";
        }
        $stmt->close();
        $stmt=null;
    }

    /**Mostrar Usuario */
    static public function mdlMostrarUsuario($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt ->  execute();
        return $stmt -> fetch();
        $stmt -> close();
        $stmt = null;

    }

    /**************************************************
     * Actualizar campo verificar de la tabla usuario *
     * ************************************************/
    static public function mdlActualizarUsuario($tabla, $id, $item, $valor){
        
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE idUsuario = :idUsuario");

        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);
        $stmt -> bindParam(":idUsuario", $id, PDO::PARAM_INT);
        
        if($stmt -> execute()){
            return "ok";
        }else{
            return"Error";
        }

        $stmt -> close();
        $stmt = null;


    }
 }