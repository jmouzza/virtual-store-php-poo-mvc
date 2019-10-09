<!--BARRA LATERAL-->
                <aside id="sidebar">
                    <div id="login" class="block-aside">
                        <?php if(!isset($_SESSION['identity'])): ?>
                        <h3 class="titulos">Iniciar sesión</h3>
                            
                        <form action="<?=base_url?>usuario/login" method="post">
                            <label for="email">Usuario o Email</label>
                            <input type="email" name="email" required/>
                            <?php if(isset($_SESSION['email_fail'])): ?>
                            <p id='error_login'><?= $_SESSION['email_fail'] ?></p>
                            <?php
                            Utils::deleteSession('email_fail');
                            endif; ?>
                            <label for="password">Contraseña</label>
                            <input type="password" name="password" required/>
                            <?php if(isset($_SESSION['password_fail'])): ?>
                            <p id='error_login'><?= $_SESSION['password_fail'] ?></p>
                            <?php
                            Utils::deleteSession('password_fail');
                            endif; ?>
                            <input type="submit" value="Iniciar sesión"/>
                        </form>
                        <a id="registrarse" href="<?=base_url?>usuario/registro">Registrarse</a>
                        
                        <?php elseif(isset($_SESSION['identity'])): ?>
                        <h3 id="usuario_logueado">Bienvenido <?= $_SESSION['identity']->nombre ?></h3>
                        <ul id="botones-sidebar">
                            <?php if(isset($_SESSION['identity_admin'])) : ?>
                            <li>
                                <a href="<?=base_url?>categoria/index">Gestionar categorías</a>
                            </li>
                            <li>
                                <a href="<?=base_url?>producto/gestion">Gestionar productos</a>
                            </li>
                            <li>
                                <a href="<?=base_url?>pedido/gestion">Gestionar pedidos</a>
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?=base_url?>pedido/mispedidos">Mis pedidos</a>
                            </li>
                            
                            <li>
                                <a href="<?=base_url?>usuario/logout">Cerrar sesión</a>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>
                               
                </aside>

                <!--CONTENIDO CENTRAL CAMBIARA SEGUN EL CONTROLADOR REQUERIDO-->
                <div id="central">