<?php

class CategoriaTienda{
    private $id, $nombre, $db;
    
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function __construct() {
        $this->db = Database::connect();
    }
    
    public function listar(){
        
        $sql = "SELECT * FROM categorias";
        $categorias = $this->db->query($sql);
        
        if($categorias->num_rows >= 1){//consiguió una o más categoría/s
            return $categorias;            
        }else{//tabla categorías vacía
            $categorias = 'empty';
            return $categorias;
        }
    }
    
    public function save(){
        $sql = "INSERT INTO categorias VALUES (null, '{$this->nombre}');";
        $guardar_categoria = $this->db->query($sql);
        return $guardar_categoria->fetch_object();
    }
    
    
    
}