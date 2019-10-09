<?php
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'helpers/utils.php';
require_once 'config/parameters.php';
session_start();
$menu_categorias = new categoriaController();
$categorias = $menu_categorias->listar_categorias();
require_once 'views/layout/sidebar.php';
function showError(){
    $error = new errorController();
    $error->index();
}
if(isset($_GET['controller'])){
    $nombre_controlador = $_GET['controller'].'Controller';
}else{
    $nombre_controlador = 'productoController';
}

if(@class_exists($nombre_controlador)){
    $controlador = new $nombre_controlador();
    
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }else{
        $action = 'index';
        $controlador->$action();
    }
}else{
     showError();
}
require_once 'views/layout/footer.php';
?>
  