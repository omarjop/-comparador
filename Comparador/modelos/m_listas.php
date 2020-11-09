<?php

require_once "conexion.php";

 class ModeloLista{

    static public function mdlAgregarLista($tabla1, $tabla2, $datos){

        $pdo=Conexion::conectar();
        $stmt = $pdo->prepare("INSERT INTO $tabla1(nombreLista, estado)
        VALUES  (:nombreLista, :estado)");

        $stmt->bindParam(":nombreLista", $datos["nombreLista"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);

        if($stmt->execute()){
            //este metodo permite obtener el ultimo id ingresado en la tabla qeu se acaba de hacer un incer. 
            $lastInsertId = $pdo->lastInsertId();

            $stmt = $pdo->prepare("INSERT INTO $tabla2(listaCompra_idListaCompra, Persona_idPersona, creadorLista)
            VALUES  (:listaCompra_idListaCompra, :Persona_idPersona, :creadorLista)");

            $stmt->bindParam(":listaCompra_idListaCompra",$lastInsertId, PDO::PARAM_INT);
            $stmt->bindParam(":Persona_idPersona", $datos["Persona_idPersona"], PDO::PARAM_INT);
            $stmt->bindParam(":creadorLista", $datos["Persona_idPersona"], PDO::PARAM_INT);

            if($stmt->execute()){
                return"ok";
            }else{
                return"Error";
            }

        }else{
            return"Error";
        }
        $stmt ->close();
        $stmt=null;
    }

    //**************************************************************** 
    // Mostra todas las listas que tiene un usuario                  *
    //**************************************************************** 
    static public function mdlMostrarListas($tabla1, $tabla2, $item1, $item2, $valor1, $valor2, $idlista){

        $stmt = Conexion::conectar()->prepare(" SELECT * 
                                                FROM $tabla1 A
                                                INNER JOIN $tabla2 B
                                                ON A.$item1 = :$item1
                                                WHERE A.$item2 = B.$idlista AND B.estado=$valor2
                                                ORDER BY $idlista DESC");
        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
            
    }
    //**************************************************************** 
    // Mostra todos los pruductos que una lista tiene asociado       *
    //**************************************************************** 
    static public function mdlMostrarProductosListas($tabla, $item1, $item2, $datos){

        $stmt = Conexion::conectar()->prepare(" SELECT nombreProducto, cantidad FROM $tabla WHERE $item1 = :$item1 AND $item2 = :$item2");
        $stmt -> bindParam(":".$item1, $datos["idList"], PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $datos["estadoProducto"], PDO::PARAM_INT);
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
            
    }
    //**************************************************************** 
     // Consulta una lista determinada segun su ID                   *
    //**************************************************************** 
     static public function mdlConsultarListas($tabla, $item, $valor){

        $stmt = Conexion::conectar()->prepare(" SELECT * FROM $tabla WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $valor, PDO::PARAM_INT);
        $stmt -> execute();
        return  $stmt ->fetch(); 
            
    }

     //**************************************************************** 
     // CONSULTA PARA CAMBIAR EL ESTADO O EL NOMBRE  DE UNA LISTA     *
    //****************************************************************
    static public function mdlCambiarEstadoLista($tabla, $item, $datos){

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item = :$item WHERE idListaCompra = :idListaCompra");

        if( $datos["control"] == 1){
            $stmt -> bindParam(":".$item, $datos["estado"], PDO::PARAM_STR);
        }else{
            $stmt -> bindParam(":".$item, $datos["estado"], PDO::PARAM_INT);
        }
        
        $stmt -> bindParam(":idListaCompra", $datos["idLista"], PDO::PARAM_INT);
        
        if($stmt -> execute()){
            return "ok";
        }else{
            return"Error";
        }

        $stmt -> close();
        $stmt = null;
    }

    
    //**************************************************************** 
     // Consulta una lista determinada segun su ID                   *
    //**************************************************************** 
    static public function mdlConsultarPrpduct($tabla){

        $stmt = Conexion::conectar()->prepare(" SELECT 	idProducto, Nombre FROM $tabla");
        $stmt -> execute();
        return  $stmt ->fetchAll(); 
            
    }

    //******************************************************************** 
     // Consulta si existe un producto que desea agregar sino lo agrega  *
    //******************************************************************** 
    static public function mdlAgregarProductosLista($tabla, $item, $datos){

        $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $datos["idProducto"], PDO::PARAM_INT);
        $stmt -> execute();
        if($stmt-> fetch()){
            return "ok";
        }else{
            return"Error";
        }
    }
 }
