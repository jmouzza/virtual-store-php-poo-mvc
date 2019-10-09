<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <title>Tienda JM</title>
        <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css"/>    
    </head>
    <body>
        <div id="container">
            <!-- CABECERA/LOGO -->
            <header id="header">
                
                <div id="logo">
                    <a href="index.php"><img src="<?=base_url?>assets/img/tienda-virtual.png"/></a>
                    <a href="index.php">JM STORE</a>
                </div>
            </header>
            <!--MENU-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>">INICIO</a>
                    </li>
                    <?php while ($categoria = $categorias->fetch_object()): ?>
                        <li>
                            <a href="<?=base_url?>categoria/ver&id=<?= $categoria->id ?>"><?= strtoupper($categoria->nombre); ?></a>
                        </li>
                    <?php endwhile; ?>
                    <li>
                        <?php if(isset($_SESSION['carrito'])): ?>
                        <a style="color:white; font-size: 14px;" href="<?=base_url?>carrito/index">CARRITO</a>
                        <?php else: ?>
                        <a href="<?=base_url?>carrito/index">CARRITO</a>
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>
            <div id="contenido">