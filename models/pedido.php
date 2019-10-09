<?php

class PedidoTienda{
    public $id, $usuario_id, $region, $comuna, $direccion, $coste, $estado, $db;
    
    public function __construct() {
        $this->db= Database::connect();
    }
    function getUsuario_id() {
        return $this->usuario_id;
    }

    function getRegion() {
        return $this->region;
    }

    function getComuna() {
        return $this->comuna;
    }

    function getDireccion() {
        return $this->direccion;
    }

    function getCoste() {
        return $this->coste;
    }

    function getEstado() {
        return $this->estado;
    }
    function setId($id) {
        $this->id = $id;
    }

    
    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    function setRegion($region) {
        $this->region = $this->db->real_escape_string($region);
    }

    function setComuna($comuna) {
        $this->comuna = $this->db->real_escape_string($comuna);
    }

    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    function setCoste($coste) {
        $this->coste = $coste;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    public function guardar(){
        $sql = "INSERT INTO pedidos VALUE(null,{$this->usuario_id},'{$this->region}','{$this->comuna}','{$this->direccion}',{$this->coste},'Pendiente',CURDATE(),CURTIME());";
        $pedido_guardado = $this->db->query($sql);
        return $pedido_guardado;
    }
    public function guardar_linea(){
        //obtener el id del pedido para almacenarlo en la tabla linea_pedido tantas veces hayan productos
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido_id';";
        $consulta = $this->db->query($sql);
        $pedido_id = $consulta->fetch_object()->pedido_id;
        foreach ($_SESSION['carrito'] as $indice => $elemento){
            $producto = $elemento['producto'];
                        
            $sql2 = "INSERT INTO lineas_pedidos VALUE (null,{$pedido_id},{$producto->id},{$elemento['unidades']});";
            $save_linea_producto = $this->db->query($sql2);
        }
        return $save_linea_producto;
    }
    
    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
                ."WHERE p.usuario_id = {$this->usuario_id} ORDER BY id DESC;";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }
    
    public function getPedidoDetail(){
        $sql = "SELECT lp.*, p.imagen, p.nombre, pe.estado, CONCAT(u.nombre,' ', u.apellidos) AS 'cliente' FROM lineas_pedidos lp "
                ."INNER JOIN productos p ON p.id = lp.producto_id "
                ."INNER JOIN pedidos pe ON pe.id = lp.pedido_id "
                ."INNER JOIN usuarios u ON pe.usuario_id = u.id "
                ."WHERE lp.pedido_id = {$this->id};";
                
        $query = $this->db->query($sql);
        return $query;
    }
    public function getAll(){
        $sql = "SELECT * FROM pedidos;";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }
    public function updatePedidoStatus(){
        $query = "UPDATE pedidos SET "
                  ."estado = '{$this->estado}' "
                  ."WHERE id = {$this->id};";
        $updated = $this->db->query($query);
        return $updated;
    }


    
}
