<?php

class ProductoTienda{
    private $id, $categoria_id, $nombre, $descripcion, $precio, $stock, $oferta, $fecha, $imagen; 
    private $db;
    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId() {
        return $this->id;
    }

    function getCategoria_id() {
        return $this->categoria_id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getDescripcion() {
        return $this->descripcion;
    }

    function getPrecio() {
        return $this->precio;
    }

    function getStock() {
        return $this->stock;
    }

    function getOferta() {
        return $this->oferta;
    }

    function getFecha() {
        return $this->fecha;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCategoria_id($categoria_id) {
        $this->categoria_id = $this->db->real_escape_string($categoria_id);
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    function setImagen($imagen) {
        $this->imagen = $this->db->real_escape_string($imagen);
    }

    public function gestion(){
        $sql = "SELECT p.*, c.nombre AS 'categoria' FROM productos p"
                . " INNER JOIN categorias c ON c.id = p.categoria_id;";
       
        $resultado = $this->db->query($sql);
        return $resultado;
    }
    
    public function save(){
        if($this->imagen != null){
            $sql = "INSERT INTO productos VALUES(null,{$this->categoria_id},'{$this->nombre}','{$this->descripcion}',{$this->precio},{$this->stock},{$this->oferta},CURDATE(),'{$this->imagen}');";
        }else{
            $sql = "INSERT INTO productos VALUES(null,{$this->categoria_id},'{$this->nombre}','{$this->descripcion}',{$this->precio},{$this->stock},{$this->oferta},CURDATE(), null);";
        }
        
        $guardar_producto = $this->db->query($sql);
        return $guardar_producto;
        
    }
    
    public function eliminar(){
        $sql = "DELETE FROM productos WHERE id = {$this->id}";
        $delete = $this->db->query($sql);
        return $delete;
    }
    
    public function editar(){
        $query = "SELECT * FROM productos WHERE id = {$this->id};";
        $edit = $this->db->query($query);
        return $edit;
    }
    public function update(){
        if($this->imagen != null){
            $query = "UPDATE productos SET ".
                  "categoria_id = '{$this->categoria_id}', ".
                  "nombre = '{$this->nombre}', ".
                  "descripcion = '{$this->descripcion}', ".
                  "precio = '$this->precio', ".
                  "stock = '$this->stock', ".
                  "oferta = '$this->oferta', ".
                  "imagen = '{$this->imagen}' ".        
                  "WHERE id = {$this->id};";
        }else{
            $query = "UPDATE productos SET ".
                  "nombre = '{$this->nombre}', ".
                  "descripcion = '{$this->descripcion}', ".
                  "precio = '$this->precio', ".
                  "stock = '$this->stock', ".
                  "oferta = '$this->oferta' ".
                  "WHERE id = {$this->id};";
        }
        
                  
          
        $updated = $this->db->query($query);
        return $updated;
    }
    
    public function getHighlighted(){
        $sql = "SELECT p.*, c.nombre AS 'categoria' FROM productos p"
                ." INNER JOIN categorias c ON c.id = p.categoria_id "
                ."WHERE oferta != 0 "
                ."ORDER BY id DESC LIMIT 9;";
        
       $destacados = $this->db->query($sql);
        return $destacados;
    }
    public function getNotHighlighted(){
        $sql = "SELECT p.*, c.nombre AS 'categoria' FROM productos p "
                ."INNER JOIN categorias c ON c.id = p.categoria_id "
                ."ORDER BY id DESC LIMIT 9;";
        $destacados = $this->db->query($sql);
        return $destacados;
    }
    
    public function getProductsCategory(){
        //mostrar los productos por categoria en menú
        $sql = "SELECT p.*, c.nombre AS 'categoria' FROM productos p "
                ."INNER JOIN categorias c ON c.id = p.categoria_id "
                ."WHERE p.categoria_id = {$this->categoria_id} "
                ."ORDER BY id DESC;";
        $productos_por_categoria = $this->db->query($sql);
        return $productos_por_categoria;
    }
    
    public function showProductDetails(){
        $sql = "SELECT * FROM productos WHERE id = {$this->id};";
        $show_product = $this->db->query($sql);
        return $show_product->fetch_object();
    }
    
    public function getActualStock(){
        $sql = "SELECT stock FROM productos WHERE id = {$this->id};";
        $get_stock = $this->db->query($sql);
        return $get_stock->fetch_object();
    }
    
    public function updateStock(){
        $query = "UPDATE productos SET ".
                "stock = '$this->stock' ".                    
                "WHERE id = {$this->id};";
                $stock_updated = $this->db->query($query);
        return $stock_updated;
    }
    
               
}