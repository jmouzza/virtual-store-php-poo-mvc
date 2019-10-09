<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{
     public function listar_categorias(){
        //listar categorias en el menu
        $listar_categorias = new CategoriaTienda();
        $categorias = $listar_categorias->listar();
        require_once 'views/layout/header.php';
    }
    
    public function index(){ // gestionar categorías 
        Utils::isAdmin(); // unicamente podrá ser alcanzada por admin
        $listar_categorias = new CategoriaTienda();
        $categorias = $listar_categorias->listar();
        if($categorias == 'empty'){
            $_SESSION['categorias_empty'] = 'No hay categorías creadas en la base de datos';           
        }
        require_once 'views/categoria/index.php';
    }
    
    public function crear(){
        Utils::isAdmin(); // unicamente podrá ser alcanzada por admin
        require_once 'views/categoria/crear.php';
    }
    
    public function save(){
        Utils::isAdmin(); // unicamente podrá ser alcanzada por admin
        if(isset($_POST)){
            //recoger datos del formulario por POST
            $nombre_categoria = false;
            $nombre_categoria = $_POST['nombre'];
            //validar datos
            if(isset($nombre_categoria) && $nombre_categoria != false){
                //instanciar el modelo
                $nueva_categoria = new CategoriaTienda();
                $nueva_categoria->setNombre($nombre_categoria);
                //utilizar el metodo para guardar
                $categoria_guardada = $nueva_categoria->save(); 
                if($categoria_guardada){//se guardo la categoría
                    //devolver a la vista un resultado
                    $_SESSION['categoria_guardada'] = 'La categoría fue creada satisfactoriamente';
                }
                
            }else{
                $_SESSION['error_crearCategoria'] = 'Error al crear categoría';
            }
            require_once 'views/categoria/crear.php';
        }
    }
    public function ver(){
        if(isset($_GET['id'])){
            $id_categoria = $_GET['id'];
        
            $productos = new ProductoTienda();
            $productos->setCategoria_id($id_categoria);
            $productos_por_categoria = $productos->getProductsCategory();
        }else{
            header("Location: ".base_url);
        }
        require_once 'views/producto/categoria.php';
    }
   
}
