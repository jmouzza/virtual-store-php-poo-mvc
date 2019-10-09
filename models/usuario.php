<?php

class UsuarioTienda{
    private $id, $nombre, $apellidos, $email, $password, $rol, $imagen, $db;
    
    function __construct() {
        //Conexión a la base de datos orientada a objetos, clase guardada en config
        $this->db = Database::connect();
    }
    function getId() {
        return $this->id;
    }

    function getNombre() {
        return $this->nombre;
    }

    function getApellidos() {
        return $this->apellidos;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getRol() {
        return $this->rol;
    }

    function getImagen() {
        return $this->imagen;
    }

    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    function setEmail($email) {
        $this->email = $this->db->real_escape_string($email);
        
    }

    function setPassword($password) {
        $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]);
     
    }

    function setRol($rol) {
        $this->rol = $rol;
    }

    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    public function save(){
        $sql = "INSERT INTO usuarios VALUES(null,'{$this->getNombre()}','{$this->getApellidos()}','{$this->getEmail()}','{$this->getPassword()}','user',null);";
        $save = $this->db->query($sql);
        return $save;        
    }
    
    public function login($email, $password){
        $result = false;
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);
              
        if($login && $login->num_rows == 1){//existe el email o usuario en la base de datos
            $usuario = $login->fetch_object();
            
            //Verificar la contraseña
            $password_verificado = password_verify($password, $usuario->password);
            
            if($password_verificado){//usuario y contraseña verificados
                $result = $usuario; 
            }else{//contraseña no coincide
                
            }
        }else{ //no existe el email o usuario en la base de datos
            $result = 'email_fail';
        }
        return $result;
    }

}