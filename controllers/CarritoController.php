<?php
require_once 'models/producto.php';
class CarritoController{
    public function index(){
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
            require_once 'views/carrito/index.php';
        }else{
            require_once 'views/carrito/empty.php';
        }
        
    }
    public function add(){
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('Location:' . base_url);
        }

        //Si la sesión existe entonces verifica si es un producto que ya esta en el carrito para sumarle 1 unidad
        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $index => $elemento){
              if($elemento['id_producto'] == $producto_id){ 
                  $_SESSION['carrito'][$index]['unidades']++;
                  $counter++;
              }
            }
        }  
        
        //Al no existir ese producto en el carrito agrega 1
        if(!isset($counter) || $counter == 0) {
            $producto = new ProductoTienda();
            $producto->setId($producto_id);
            $producto = $producto->showProductDetails();
            if (is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "oferta" => $producto->oferta,
                    "precio_final" => ($producto->precio - $producto->oferta),
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function remove(){
        if(isset($_GET['index'])){
            $index_to_remove = $_GET['index'];
            unset($_SESSION['carrito'][$index_to_remove]);
            if(empty($_SESSION['carrito'])){
                    Utils::deleteSession('carrito');
            }
            header('Location:'.base_url.'carrito/index');
        }
    }
    public function delete(){
        Utils::deleteSession('carrito');
        header('Location:'.base_url.'carrito/index');
    }
    public function up(){
        if(isset($_GET['index'])){
            $index_to_increase = $_GET['index'];
            $_SESSION['carrito'][$index_to_increase]['unidades']++;
            
        }
        header('Location:'.base_url.'carrito/index');
    }
    public function down(){
        if(isset($_GET['index'])){
            $index_to_decrease = $_GET['index'];
            $_SESSION['carrito'][$index_to_decrease]['unidades']--;
            if($_SESSION['carrito'][$index_to_decrease]['unidades'] == 0){
                unset($_SESSION['carrito'][$index_to_decrease]);
                if(empty($_SESSION['carrito'])){
                    Utils::deleteSession('carrito');
                }
            }
            
        }
        header('Location:'.base_url.'carrito/index');
    }
    
}

