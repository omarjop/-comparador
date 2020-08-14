<?php


class ModeloInserttAllTables{

private $db;
private $servicio;


   /*Este metodo retorna resultado del insert hecho en tabla*/
    public function insertInTable($tabla,$into,$values){
       $objInsert = new ModeloInsertInTables();
       $result = $objInsert ->insertInTables($tabla,$into,$values);
       return $result;
    }

        

}