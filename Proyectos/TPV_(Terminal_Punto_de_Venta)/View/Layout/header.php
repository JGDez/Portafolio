<header>
    <section class="secMenu">
        <div class="cent-Cont-Vert">
            <a href="/Controller/index.php">
                <img src="<?= $rutaLogos.$tiendaAct->getLogoTienda() ?>" alt="<?= $tiendaAct->getNombreCom() ?>" class="imgLogo">
            </a>
        </div>
        <nav>
            <ul>
                <a href="/Controller/index.php"><li>Inicio</li></a>
                <a href="/Controller/tpv.php"><li>Caja</li></a>
                <a href="/Controller/listaProductos.php"><li>Productos</li></a>
                <a href="/Controller/listaCategorias.php"><li>Categorías</li></a>
                <a href="#"><li>Tickets</li></a>
                <li class="submenu">Configuracion
                    <ul class="submenu-contenido">
                        <a href="/Controller/editarTienda.php"><li>La Tienda</li></a>
                        <a href="#"><li>Tipos de IVA</li></a>
                        <a href="/Controller/ayuda.php"><li>Ayuda</li></a>
                    </ul>
                </li>
            </ul>
            <ul class="finMenu">
                <li><a href="/Controller/salir.php?Salir=Si">Salir</a></li>
            </ul>
        </nav>
    </section>
    <section class="espacioMenu"></section>
</header>