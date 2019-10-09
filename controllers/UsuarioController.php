<?php
//Modelo usuario disponoible
require_once 'models/usuario.php';

class usuarioController{
    public function index(){
        require_once 'views/producto/destacados.php';
    }
    public function registro(){
        require_once 'views/usuario/registro.php';
    }
    public function save(){
        session_start();
        if(isset($_POST)){
            //Recoger los datos recibidos por POST
            $nombre = $_POST['nombre'];
            $apellidos = $_POST['apellidos'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            
            //Array de posibles errores en las validaciones
            $errores = array(); //se define como un array vacio, en cual se llenará si alguna validación no cumple
            //Validar los datos antes de guardarlos en la base de datos

            /* ----- Validando el nombre ----- */
            if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
                $nombre_validado = $nombre;
            } else {
                $errores['nombre'] = "El nombre ingresado no es válido"; // añadir un indice al array de errores
            }

            /* ----- Validando los apellidos ----- */
            if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
                $apellidos_validado = $apellidos;
            } else {
                $errores['apellidos'] = "Los apellidos ingresados no son válidos";
            }

            /* ----- Validando el email ----- */
            if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $email_validado = $email;
            } else {
                $errores['email'] = "El email ingresado no es válido";
            }

            /* ----- Validando la password ----- */
            if (!empty($password)) {
                $password_validado = $password;
            } else {
                $errores['password'] = "La contraseña está vacía";
            }
            
            if(count($errores) == 0){
                $usuario = new UsuarioTienda();
                $usuario->setNombre($nombre_validado);
                $usuario->setApellidos($apellidos_validado);
                $usuario->setEmail($email_validado);
                $usuario->setPassword($password_validado);
                $save = $usuario->save();
                
                if($save){
                    $_SESSION['sign_up_completed']='Usuario registrado correctamente';
                }else{
                    $_SESSION['sign_up_failed']='Fallo el registro';
                }
            }else{//encontro un error al hacer la validación
                $_SESSION['errores'] = $errores;
            }
        }else{ //No habria $_POST
            $_SESSION['sign_up_failed']='Fallo el registro';
        }
        require_once 'views/usuario/registro.php';
    }
    public function login(){
        if(isset($_POST)){
            //Recoger los datos del formulario
            $email = $_POST['email'];
            $password = $_POST['password'];
           
            //Intanciar el modelo + método y enviar datos
            $usuario = new UsuarioTienda();
            //Consulta a la base de datos
            $identificacion = $usuario->login($email,$password);
            //Crear una sesión 
           if($identificacion == 'email_fail'){
               $_SESSION['email_fail'] = 'Email no registrado.';
           }
            if($identificacion && is_object($identificacion)){//Usuario verificado y devuelve el objeto
               $_SESSION['identity'] = $identificacion;
               
               if($identificacion->rol == 'admin'){
                   $_SESSION['identity_admin'] = true;
               }
            }elseif (!isset ($_SESSION['identity']) && !isset ($_SESSION['email_fail'])) {
                $_SESSION['password_fail'] = 'Contraseña incorrecta.';
            }
        }
        header('Location:'.base_url.'index.php');
    }
    public function logout(){
        if(isset($_SESSION['identity'])){
            Utils::deleteSession('identity');
        }
        if(isset($_SESSION['identity_admin'])){
            Utils::deleteSession('identity_admin');
        }
        if(isset($_SESSION['carrito'])){
            Utils::deleteSession('carrito');
        }
        header('Location:'.base_url.'index.php');
    }
}

