<?php

class Utils{
    public static function deleteSession($name){
        if(isset($_SESSION[$name])){
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
       return $name;
    }
    public static function isAdmin(){ //función que podrá ser llamada para confirmar si el usuario que navega es Admin
        if(!isset($_SESSION['identity_admin'])){ // no es admin
            header("Location:".base_url);  // reenvialo al index
        }else{ // SI ES ADMIN
            return true;
        }
        
    }
    public static function statsCarrito(){
        $stats = array(
            "count" => 0,
            "total" => 0
        );
        
        if(isset($_SESSION['carrito'])){
            foreach($_SESSION['carrito'] as $producto){
                $stats['total'] += ($producto['precio_final']*$producto['unidades']);
            }
        }else{
           header:('Location:'.base_url.'carrito/index'); 
        }
        return $stats;
    }
    public static function formatoNumeros($numero){
        $formateado = number_format($numero, 2, ",", ".");
        return $formateado;
    }
}