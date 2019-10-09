<?php

function controller_autoload($classname){
    //Incluimos las clases (controladores para que carguen automáticamente, indicandole la ruta y los nombres de los ficheros
    include 'controllers/'.$classname.'.php';
}

spl_autoload_register('controller_autoload');