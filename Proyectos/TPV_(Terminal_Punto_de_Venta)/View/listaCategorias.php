<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPV</title>
    <link rel="stylesheet" href="<?= RUTA_CSS.'header.css' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS.'estilos.css' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS.'tablas.css' ?>">
</head>
<body>
    <?php include(RUTA_VISTA."Layout/header.php") ?>
    <h1 class="txt_centrado txtMayusculas">Lista de categorías</h1>

    <section id="tabla" class="secTabla ancho80xC elemCentH">
        <div class="espacioFin">
            <a href="<?= URL_CONTROLADOR.'altaCategoria.php' ?>" class="btn btnNeutro">Añadir Categoría</a>
        </div>
        <!-- Tabla con los dados de la BD -->
        <table class="ancho100xC">
            <!-- Cabecera de la tabla -->
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th class="anchoAjustado">Color</th>
                    <th></th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla -->
            <tbody>
                <?php foreach ($categorias['Categorias'] as $categoria): ?>
                    <form action="<?= RUTA_CONTROLADOR ?>editarCategoria.php" method="post">
                        <tr>
                            <td>
                                <!-- Elemento para guardar el ID del registro que se quiere modificar -->
                                <input type="text" name="id" value="<?= $categoria->getId() ?>" hidden>
                                <?= $categoria->getNombre()?>
                            </td>
                            <td><?= $categoria->getDescripcion() ?></td>
                            <td>
                                <div style="background-color: <?= $categoria->getColor() ?>; height: 2rem;"></div>
                            </td>
                            <td class="anchoAjustado">
                                <button name="editar" id="btnEditar" class="btn btnNeutro">Editar</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Sección para Paginador -->
        <?php if ($contaPagsCategorias->numPaginas() > 1): ?>
            <form action="#" method="post">
                <p class="txtCentrado anchoAjustado elemCentH">
                    <button type="submit" name="btnAnterior" id="btnAnterior" class="btn" <?php if ($contaPagsCategorias->numPagina() == 1) echo "disabled"; ?> >< Anterior</button>
                    Página <?= ($contaPagsCategorias->numPagina()) ?> de <?= $contaPagsCategorias->numPaginas() ?>
                    <button type="submit" name="btnSiguiente" id="btnSiguiente" class="btn" <?php if ($contaPagsCategorias->numPagina() == $contaPagsCategorias->numPaginas()) echo "disabled"; ?> >Siguiente ></button>
                </p>
            </form>
        <?php endif; ?>
        <!-- Fin Sección para Paginador -->
    </section>
</body>
</html>