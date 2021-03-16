<?php
class Conexion2{
    public function conectar2(){
        $link =  new PDO("mysql:host=localhost;dbname=comparador", 
                         "root", 
                         "", 
                         array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                               PDO::MYSQL_ATTR_INIT_COMMAND =>"SET NAMES utf8")
                        );
        return $link;
    }

}
