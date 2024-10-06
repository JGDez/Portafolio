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
    <!-- Encabezado de la página -->
    <?php include(RUTA_VISTA."Layout/header.php") ?>
    <!-- Fin Encabezado de la página -->

    <div class="divForm">
        <h1 class="txt_centrado txtMayusculas">Crear nueva categoría</h1>
        <!-- Inicio Formulario -->
        <!--form action="<?php RUTA_CONTROLADOR.'actualizarCategoria.php' ?>" method="post"-->
        <form action="../Controller/actualizarCategoria.php" method="post">

            <!-- Datos de la categoría -->
            <div id="lista_form" class="ancho100xC">
                <div class="divInput">
                    <input type="hidden" name="id" id="id" value="<?= $categoria->getId() ?>">
                    <label for="nombre">Nombre</label><br>
                    <input type="text" name="nombre" id="nombre" value="<?= $categoria->getNombre() ?>" placeholder="Nombre de la categoría" required maxlength="50">
                </div>
                <div class="divInput">
                    <label for="descripcion">Descripción para la categoría</label><br>
                    <textarea type="text" name="descripcion" id="descripcion" maxlength="100" placeholder="Puedes escribir una descripción (máximo 100 caracteres)"><?= $categoria->getDescripcion() ?></textarea>
                </div>
                <div class="divInput ancho30xC">
                    <label for="color">Color</label><br>
                    <input type="color" name="color" id="color" value="<?= $categoria->getColor() ?>">
                </div>
                
                <!-- Botones del formulario -->
                <div>
                    <input type="submit" name="aceptar" value="Aceptar" class="btn btnOk">
                    <button type="button" name="cancelar" id="cancelar" class="btn btnNeutro" onclick="history.back();">Cancelar</button>
                    <button name="eliminar" class="btn btnPeligro">Eliminar</button>
                </div>
                <!-- Fin Botones del formulario -->
            </div>
            <!-- Fin de datos de la tienda -->

        </form>
        <!-- Fin Inicio Formulario -->
    </div>
</body>
<!-- Código JavaScript -->
<script src="<?= RUTA_JS.'foto.js'?>" ></script>
</html>