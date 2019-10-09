<?php

require_once 'models/producto.php';
require_once 'models/categoria.php';

class productoController {

    public function index() {
        $productos = new ProductoTienda();
        $productos_destacados = $productos->getHighlighted();

        if ($productos_destacados->num_rows >= 3){ // si hay 3 o mas productos con oferta, muestralos 
            require_once 'views/producto/destacados.php';
        }else{ // sino hay 3 o mas productos en oferta muestra todos los productos
            $productos_destacados = $productos->getNotHighlighted();
            require_once 'views/producto/destacados.php';
        }
        
        //renderizar vista
    }

    public function gestion() {
        Utils::isAdmin();
        //Instanciar el modelo producto
        $productos = new ProductoTienda();
        //Utilizar el método gestion del modelo para traer todos los productor y listarlos
        $listado_productos = $productos->gestion();
        //Enviar información a la vista
        require_once 'views/producto/gestion.php';
    }

    public function crear() {
        Utils::isAdmin();
        //Instancia objeto a CategoriaTienda y recuperar las categorias para realizar una etiqueta <select>
        $objeto_categoria = new CategoriaTienda();
        $categorias = $objeto_categoria->listar();

        require_once 'views/producto/crear.php';
    }

    public function save() {
        Utils::isAdmin();

        if ($_POST) {
            //Recoger los datos recibidos por el formulario POST
            $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            if (empty($_POST['oferta'])) {
                $oferta = 0;
            } else {
                $oferta = $_POST['oferta'];
            }
            //Validar los datos
            //Instanciar objeto del modelo ProductoTienda
            $producto_nuevo = new ProductoTienda();

            //setear los datos del objetos creado
            $producto_nuevo->setCategoria_id($categoria_id);
            $producto_nuevo->setNombre($nombre);
            $producto_nuevo->setDescripcion($descripcion);
            $producto_nuevo->setPrecio($precio);
            $producto_nuevo->setStock($stock);
            $producto_nuevo->setOferta($oferta);
            //Guardar la imagen sólo si el tipo de archivo cumple con el requisito de ser un tipo de dato imagen
            if (isset($_FILES['imagen'])) {
                $file = $_FILES['imagen'];
                $filename = $file['name'];
                $mimetype = $file['type'];
                //Indicará el tipo de MIME (extensión del archivo) entre muchos: 
                //"image/jpeg | application/msword | application/javascript | text/css"
                if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                    //cumple con la condición de ser un tipo de archivo de imagen, entonces podrá guardarse
                    if (!is_dir('uploads/images')) { // si no existe el directorio para subir las imagenes entra y crear el directorio
                        mkdir('uploads/images', 0777, true); //true porque es un directorio dentro de otro directorio
                    }
                    move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                    $producto_nuevo->setImagen($filename);
                }
            } else {
                $producto_nuevo->setImagen(null);
            }


            //Ejecutar query para crear el producto
            $producto_guardado = $producto_nuevo->save();

            //Enviar información a la vista
            if ($producto_guardado) {
                $_SESSION['producto_guardado'] = 'Producto creado satisfactoriamente';
            } else {
                $_SESSION['error_guardar'] = 'Ocurrió un error al guardar el producto';
            }
        } else {
            $_SESSION['error_datos'] = 'Tienes un error en los datos proporcionados';
        }
        $this->gestion();
    }

    public function editar() {
        Utils::isAdmin();
        $objeto_categoria = new CategoriaTienda();
        $categorias = $objeto_categoria->listar();
        if (isset($_GET['id'])) {
            $id_producto = $_GET['id'];
            $producto = new ProductoTienda();
            $producto->setId($id_producto);
            $edit = $producto->editar();
            if ($edit) {
                $_SESSION['edit'] = 'Producto editado satisfactoriamente';
            } else {
                $_SESSION['error_editar'] = 'Error al editar el producto.';
            }
            require_once 'views/producto/editar.php';
        } else {
            header('Location: ' . base_url);
        }
    }

    public function update() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id_producto = $_GET['id'];

            if ($_POST) {
                //Recoger los datos recibidos por el formulario POST
                $categoria_id = isset($_POST['categoria_id']) ? $_POST['categoria_id'] : false;
                $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
                $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
                $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
                $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
                if (empty($_POST['oferta'])) {
                    $oferta = 0;
                } else {
                    $oferta = $_POST['oferta'];
                }
                //Validar los datos
                //Instanciar objeto del modelo ProductoTienda
                $producto_editado = new ProductoTienda();

                //setear los datos del objeto
                $producto_editado->setId($id_producto);
                $producto_editado->setCategoria_id($categoria_id);
                $producto_editado->setNombre($nombre);
                $producto_editado->setDescripcion($descripcion);
                $producto_editado->setPrecio($precio);
                $producto_editado->setStock($stock);
                $producto_editado->setOferta($oferta);
                //Guardar la imagen sólo si el tipo de archivo cumple con el requisito de ser un tipo de dato imagen
                if (isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
                    //Indicará el tipo de MIME (extensión del archivo) entre muchos: 
                    //"image/jpeg | application/msword | application/javascript | text/css"
                    if ($mimetype == 'image/jpg' || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif') {
                        //cumple con la condición de ser un tipo de archivo de imagen, entonces podrá guardarse
                        if (!is_dir('uploads/images')) { // si no existe el directorio para subir las imagenes entra y crear el directorio
                            mkdir('uploads/images', 0777, true); //true porque es un directorio dentro de otro directorio
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto_editado->setImagen($filename);
                    }
                } else {
                    $producto_editado->setImagen(null);
                }

                //Ejecutar query para editar el producto
                $updated = $producto_editado->update();

                //Enviar información a la vista
                if ($updated) {
                    $_SESSION['updated'] = 'Producto editado satisfactoriamente';
                } else {
                    $_SESSION['error_guardar'] = 'Ocurrió un error al guardar el producto';
                }
            } else {
                $_SESSION['error_datos'] = 'Tienes un error en los datos proporcionados';
            }
        }

        $this->gestion();
    }

    public function eliminar() {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id_producto = $_GET['id'];
            $producto = new ProductoTienda();
            $producto->setId($id_producto);
            $delete = $producto->eliminar();
            if ($delete) {
                $_SESSION['producto_eliminado'] = 'El producto ha sido eliminado satisfactoriamente.';
                $this->gestion();
            }
        }
    }

    public function detalle() {
        if (isset($_GET['id'])) {
            $id_producto = $_GET['id'];
            $producto = new ProductoTienda();
            $producto->setId($id_producto);
            $show_product = $producto->showProductDetails();
            require_once 'views/producto/product_details.php';
        } else {
            header('Location:' . base_url);
        }
    }

}
