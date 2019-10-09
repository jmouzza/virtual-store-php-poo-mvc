<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Tienda JM</title>
        <link rel="stylesheet" href="assets/css/styles.css"/>    
    </head>
    <body>
        <div id="container">
            <!-- CABECERA/LOGO -->
            <header id="header">

                <div id="logo">
                    <img src="assets/img/camiseta.png"/>
                    <a href="index.php">Tienda virtual JM</a>
                </div>
            </header>
            <!--MENU-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="index.php">INICIO</a>
                    </li>
                    <li>
                        <a href="#">CATEGORIA 1</a>
                    </li>
                    <li>
                        <a href="#">CATEGORIA 2</a>
                    </li>
                    <li>
                        <a href="#">CATEGORIA 3</a>
                    </li>
                    <li>
                        <a href="#">CATEGORIA 4</a>
                    </li>
                    <li>
                        <a href="#">CARRITO</a>
                    </li>
                </ul>
            </nav>
            <div id="contenido">
                <!--BARRA LATERAL-->
                <aside id="sidebar">
                    <div id="login" class="block-aside">
                        <h3 id="login-titulo">Iniciar sesión</h3>
                        <form action="#" method="post">
                            <label for="email">Usuario o Email</label>
                            <input type="email" name="email"/>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password"/>
                            <input type="submit" value="Iniciar sesión"/>
                        </form>
                        <ul id="botones-sidebar">
                            <li>
                                <a href="#">Mis pedidos</a>
                            </li>
                            <li>
                                <a href="#">Gestionar categorías</a>
                            </li>
                            <li>
                                <a href="#">Gestionar productos</a>
                            </li>
                        </ul>  <!--Fin botones-sidebar-->   
                    </div> <!--Fin login-->
                </aside>

                <!--CONTENIDO CENTRAL-->
                <div id="central">
                    <h2 id="destacados">Productos Destacados</h2>

                    <div class="product">
                        <img src="assets/img/camiseta.png"/>
                        <h2>Camiseta azul holgada</h2>
                        <p>Descripción del producto</p>
                        <p>CLP 15.000</p>
                        <a href="#" class="button">COMPRAR</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/camiseta.png"/>
                        <h2>Camiseta azul holgada</h2>
                        <p>Descripción del producto</p>
                        <p>CLP 15.000</p>
                        <a href="#" class="button">COMPRAR</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/camiseta.png"/>
                        <h2>Camiseta azul holgada</h2>
                        <p>Descripción del producto</p>
                        <p>CLP 15.000</p>
                        <a href="#" class="button">COMPRAR</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/camiseta.png"/>
                        <h2>Camiseta azul holgada</h2>
                        <p>Descripción del producto</p>
                        <p>CLP 15.000</p>
                        <a href="#" class="button">COMPRAR</a>
                    </div>
                    <div class="product">
                        <img src="assets/img/camiseta.png"/>
                        <h2>Camiseta azul holgada</h2>
                        <p>Descripción del producto</p>
                        <p>CLP 15.000</p>
                        <a href="#" class="button">COMPRAR</a>
                    </div>

                </div> <!--Fin Central-->
            </div><!--Fin Contenido-->
        </div> <!--Fin Contenedor-->
        <!-- PIE DE PAGINA -->
        <div class="clearfix"></div>
        <footer id="footer">
            <p>Desarrollado por Jesús Mouzza &copy; <?= date('Y') ?></p>
        </footer>
    </div>
</body>
</html>
