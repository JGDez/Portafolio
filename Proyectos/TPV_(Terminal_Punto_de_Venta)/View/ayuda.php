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

    <section id="secAyuda" class="alto100 flexColCent">
        <div class="fondo_TPV"></div>
        <div class="ancho80xC fondoNeutro espacio">
            <div class="btnArriba">
                <p><a href="#secAyuda">
                    <img src="<?= $rutaImgs ?>flechaArriba.png" alt="Flecha hacia arriba.">
                </a></p>
            </div>
        
            <h1 class="txt_centrado txtMayusculas">Guía de uso</h1>
            <p>Gracias por usar esta aplicación.</p>
            <p>En esta guía se explicarán los procedimientos para el uso del TPV.</p>
            <ul>
                <li><a href="#Entrar_en_la_aplicación">Entrar en la aplicación</a></li>
                <ul>
                    <li><a href="#Creación_una_tienda_nueva">Creación una tienda nueva</a></li>
                    <li><a href="#Edicion_de_los_datos_de_la_tienda">Edición de los datos de la tienda</a></li>
                </ul>
                <li><a href="#Categorias">Categorías</a></li>
                <li><a href="#Productos">Productos</a></li>
                <li><a href="#TPV_-_Caja">TPV - Caja</a></li>
            </ul>

            <h2 id="Entrar_en_la_aplicación" class="ancla">Entrar en la aplicación</h2>
            <p>Antes de utilizar el programa, es necesario elegir la tienda en la que te conectas, para ello, despliega la lista de tiendas y elige la que corresponda.</p>
            <img src="<?= $rutaImgs ?>Ayuda-Seleccionar_Tienda.png" alt="Desplegable para seleccionar la tienda o crear una nueva.">
            <p>También se puede crear una cuenta nueva dejando como opción <cite>...Nueva Tienda</cite>.</p>
            
            <h3 id="Creación_una_tienda_nueva" class="ancla">Creación una tienda nueva</h3>
            <p>Para crear una tienda nueva debes seguir estos pasos</p>
            <ul>
                <li>Si ya has elegido una tienda anteriormente, pulsa en <cite>Salir</cite>.</li>
                <li>En la pantalla para elegir tienda, selecciona la opción <cite>...Nueva Tienda</cite>.</li>
                <li>Completar los datos del formulario para la tienda nueva.</li>
                <img src="<?= $rutaImgs ?>Ayuda-Tienda_Nueva.png" alt="Formulario para una tienda nueva.">
                <li>Elegir una imagen para el logo de la tienda y para el logo en el Ticket de compra.</li>
                <li>Aceptar los datos una vez finalizado el formulario.</li>
            </ul>

            <h3 id="Edicion_de_los_datos_de_la_tienda" class="ancla">Edición de los datos de la tienda</h3>
            <p>Para editar los datos de la tienda, esta tiene que estar activa, siendo previamente elegida en la pantalla inicial.</p>
            <ul>
                <li>En el menú principal, ir a <cite>Configuración</cite> | <cite>La Tienda</cite>.</li>
                <li>Modificar los datos necearios.</li>
                <li>Pulsar en aceptar para aplicar los cambios.</li>
            </ul>

            <h2 id="Categorias" class="ancla">Categorías</h2>
            <p>Esta sección permite añadir, consultar, modificar y eliminar las categorías introducidas en la tienda para luego poder asignárselas a los productos.</p>
            <img src="<?= $rutaImgs ?>Ayuda-Lista_Categorias.png" alt="Tabla con categorías.">
            <p>Pulsando en el botón <cite>Añadir Categoría</cite> se accede al formulario para introducir una nueva categoría, incluída la posibilidad de asignarle un color para una mejor identificación.</p>
            <img src="<?= $rutaImgs ?>Ayuda-Aniadir_Editar_Categoria.png" alt="Formulario de categorías.">
            <p>Pulsando en el botón <cite>Editar</cite> se accede al formulario para modificar la categoría que figura en la misma línea, accediento al formulario de edición.</p>
            <p>Para eliminar una categoría, editar la categoría y en el formulario elegir el botón <cite>Eliminar</cite>.</p>

            <h2 id="Productos" class="ancla">Productos</h2>
            <p>Esta sección permite añadir, consultar, modificar y eliminar los productos introducidos en la tienda.</p>
            <img src="<?= $rutaImgs ?>Ayuda-Lista_Productos.png" alt="Tabla con productos.">
            <p>Pulsando en el botón <cite>Añadir Producto</cite> se accede al formulario para introducir un nuevo producto, incluída una foto que ayude a identificarlo.</p>
            <img src="<?= $rutaImgs ?>Ayuda-Aniadir_Editar_Producto.png" alt="Formulario de productos.">
            <p>Pulsando en el botón <cite>Editar</cite> se accede al formulario para modificar el producto que figura en la misma línea, accediento al formulario de edición.</p>
            <p>Para eliminar un producto, editar el producto y en el formulario elegir el botón <cite>Eliminar</cite>.</p>

            <h2 id="TPV_-_Caja" class="ancla">TPV - Caja</h2>
            <p>Este apartado permite registrar una venta. Esta sección tiene:</p>
            <img src="<?= $rutaImgs ?>Ayuda-TPV.png" alt="Representación de la sección de caja del TPV.">
            <ul>
                <li>Parte superior izquierda: Selector de categorías para filtrar la lista de productos.</li>
                <li>Parte inferior izquierda: Selector de productos a vender.</li>
                <li>Parte superior derecha: Lista de productos añadidos a la venta.</li>
                <li>Parte inferior derecha: Opciones disponibles para la venta.</li>
            </ul>
            <p>Para registrar una venta:</p>
            <ul>
                <li>En la parte superior derecha se puede elegir la categoría por la que filtrar los productos.</li>
                <li>En la parte inferior derecha, elegir el producto a añadir a la venta. Una vez pulsado se incluirá a la lista.</li>
                <li>Si se pulsa de nuevo en un producto que ha sido anteriormente añadido a la venta, este aumentará su cantidad en uno.</li>
                <li>Para eliminar un producto de la venta, seleccionar el producto deseado en la parte superior izquierda (este quedará marcado con un color diferente) y pusar en el botón eliminar en la parte inferior izquierda.</li>

            </ul>
        </div>
    </section>
</body>
</html>