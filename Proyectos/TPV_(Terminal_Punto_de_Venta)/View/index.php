<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPV</title>
    <link rel="icon" type="image/x-icon" href="<?= $rutaImgs.'favicon.png' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS.'header.css' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS.'estilos.css' ?>">
</head>
<body>
    <?php include(RUTA_VISTA."Layout/header.php") ?>
    <section id="paginaInicio" class="alto100 flexColCent flexColCentV">
        <div class="fondo_TPV"></div>
        <div id="enlacesInicio" class="ancho50xC alto70 elemCentH">
            <a href="/Controller/tpv.php" class="espacioFin btnProd flexColCent  flexColCentV ">
                <img  src="<?= $rutaImgs ?>TPV.png" alt="Libro de dudas y guía" class="ancho70xC">
                <div>Caja</div>
            </a>
            <a href="/Controller/listaProductos.php" class="espacioFin btnProd flexColCent  flexColCentV ">
                <img  src="<?= $rutaImgs ?>Productos.png" alt="Libro de dudas y guía" class="ancho70xC">
                <div>Productos</div>
            </a>
            <a href="/Controller/listaCategorias.php" class="espacioFin btnProd flexColCent  flexColCentV ">
                <img  src="<?= $rutaImgs ?>Categorias.png" alt="Libro de dudas y guía" class="ancho70xC">
                <div>Categorías</div>
            </a>
            <a href="#" class="espacioFin btnProd flexColCent  flexColCentV ">
                <img  src="<?= $rutaImgs ?>ticket.png" alt="Libro de dudas y guía" class="ancho70xC">
                <div>Tickets</div>
            </a>
            <a href="/Controller/editarTienda.php" class="espacioFin btnProd flexColCent  flexColCentV ">
                <img  src="<?= $rutaLogos.$tiendaAct->getLogoTienda() ?>" alt="Libro de dudas y guía" class="ancho70xC">
                <div>La Tienda</div>
            </a>
            <a href="/Controller/ayuda.php" class="espacioFin btnProd flexColCent  flexColCentV ">
                <img  src="<?= $rutaImgs ?>Ayuda.png" alt="Libro de dudas y guía" class="ancho70xC">
                <div>Ayuda</div>
            </a>
            <a href="/Controller/salir.php?Salir=Si" class="espacioFin btnProd flexColCent  flexColCentV ">
                <img  src="<?= $rutaImgs ?>Salir.png" alt="Libro de dudas y guía" class="ancho70xC">
                <div>Salir</div>
            </a>
        </div>
    </section>
</body>
</html>