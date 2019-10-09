<?php
require_once 'models/pedido.php';
require_once 'models/producto.php';
class pedidoController{
    public function hacer(){
        
        require_once 'views/pedido/hacer.php';
    }
    public function add(){
        if($_POST && isset($_SESSION['identity'])){
            //Reducir el stock
            foreach ($_SESSION['carrito'] as $index => $producto) {
            $id_producto = $producto['id_producto'];
            $unidades = $producto['unidades'];
            //obtener el stock actual por producto
            $stock_por_producto = new ProductoTienda();
            $stock_por_producto->setId($id_producto);
            $stock_por_producto = $stock_por_producto->getActualStock();
            //Si la cantidad de productos solicitado es mayor al stock disponible
            if($stock_por_producto->stock<$unidades){
                $stock_insuficiente = new ProductoTienda();
                $stock_insuficiente->setId($id_producto);
                $stock_insuficiente = $stock_insuficiente->showProductDetails();
                require 'views/pedido/no_stock.php';
                die();
            }
            //Operacion para descontar las unidades del pedido del stock
            $actualizar_stock = $stock_por_producto->stock-$unidades;
            //update del stock del pedido actual
            $actualizando_stock = new ProductoTienda();
            $actualizando_stock->setId($id_producto);
            $actualizando_stock->setStock($actualizar_stock);
            $actualizando_stock->updateStock();
            }
            
            //importando el id del usuario que mantiene la sesion activa
            $usuario_id= $_SESSION['identity']->id;
            //importanto el coste de los stats del carrito
            $statsCarrito = Utils::statsCarrito();
            $coste = $statsCarrito['total'];
            //RECOGER LOS DATOS QUE LLEGAN POR POST Y GUARDAR
            $region = isset($_POST['region']) ? $_POST['region'] : false;
            $comuna = isset($_POST['comuna']) ? $_POST['comuna'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $pedido = new PedidoTienda();
            $pedido->setUsuario_id($usuario_id);
            $pedido->setRegion($region);
            $pedido->setComuna($comuna);
            $pedido->setDireccion($direccion);
            $pedido->setCoste($coste);
            $pedido_guardado = $pedido->guardar();
            $linea_pedido = $pedido->guardar_linea();
            
            
            
            if($pedido_guardado && $linea_pedido){
                $_SESSION['pedido_guardado'] = 'Su pedido fue recibido y está en proceso';
                require_once 'views/pedido/done.php';
            }else{
                $_SESSION['pedido_no_guardado'] = 'Ocurrió un error al confirmar su pedido';
                require_once 'views/pedido/fail.php';
            }
            
        }else{
            //Error o de identificación o en recepción por POST
            header('Location:'.base_url);
        }
    }
    public function mispedidos(){
        $id_usuario = $_SESSION['identity']->id;
        $pedidos_usuario = new PedidoTienda();
        //Sacar los pedidos del usuario
        $pedidos_usuario->setUsuario_id($id_usuario);
        $pedidos = $pedidos_usuario->getAllByUser();
        if(is_object($pedidos) && $pedidos->num_rows > 0){
            require_once 'views/pedido/mis_pedidos.php';
        }else{
            require_once 'views/pedido/sinpedidos.php';
        }
    }
    public function detail(){
        if(isset($_GET)){
            $pedido_id = $_GET['id'];
            $detalle_pedido = new PedidoTienda();
            $detalle_pedido->setId($pedido_id);
            $detalle_pedido = $detalle_pedido->getPedidoDetail();
            require_once 'views/pedido/pedidodetail.php';
        }else{
            header("Location:".base_url);
        }
    }
    public function gestion(){
        $pedidos = new PedidoTienda();
        $pedidos = $pedidos->getAll();
        require_once 'views/pedido/gestion.php';
    }
    public function estado(){
        //Id del producto a modificar el estado
        $pedido_id = $_POST['pedido_id'];
        $estado = $_POST['estado'];
        //Verificar que opcion será el nuevo estado del pedido
        if($estado == 'confirm'){
            $estado = 'Pendiente';
        }elseif($estado == 'preparation'){
            $estado = 'En preparación';
        }elseif($estado == 'ready'){
            $estado = 'Preparado para enviar';
        }elseif($estado == 'sended'){ 
            $estado = 'Enviado';
        }
        $pedidos = new PedidoTienda();
        //Setear el id del pedido a modificar
        $pedidos->setId($pedido_id);
        $pedidos->setEstado($estado);
        $pedidos = $pedidos->updatePedidoStatus();
        //Ejecutar la query para modificar el estado con UPDATE
        
        header('Location: '.base_url.'pedido/gestion');
    }
}
