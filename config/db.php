<?php

/*CLASE CON METODOS ESTATICOS*/

class Database{
    public static function connect(){
        $db = new mysqli('localhost','root','','tienda_master');
        $db->query("SET NAMES 'utf8'");
        return $db; //aqui devuelve el objeto $db que tiene la conexion a la base de datos
    }
}

