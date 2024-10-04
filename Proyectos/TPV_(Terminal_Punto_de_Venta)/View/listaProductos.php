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
    <h1 class="txt_centrado">LISTA DE PRODUCTOS</h1>

    <!-- Sección para la tabla de productos_Jo$productos_Join -->
    <section id="tabla" class="secTabla ancho80xC elemCentH">
        <div class="espacioFin txtMayusculas">
            <a href="<?= URL_CONTROLADOR.'altaProducto.php' ?>" class="btn btnNeutro">Añadir Producto</a>
        </div>
        <!-- Tabla con los dados de la BD -->
        <table class="ancho100xC">
            <!-- Cabecera de la tabla -->
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Precio bruto</th>
                    <th>I.V.A.</th>
                    <th>Precio última compra</th>
                    <th></th>
                </tr>
            </thead>
            <!-- Cuerpo de la tabla -->
            <tbody>
                <?php foreach ($productos_Join['Productos_Join'] as $producto): ?>
                    <form action="<?= RUTA_CONTROLADOR ?>editarProducto.php" method="post">
                        <tr>
                            <td>
                                <!-- Elemento para guardar el ID del registro que se quiere modificar -->
                                <input type="text" name="id" value="<?= $producto->getId() ?>" hidden>
                                <?= $producto->getCodigo()?>
                            </td>
                            <td class="truncado"><?= $producto->getNombre()?></td>
                            <td class="truncado"><?= $producto->getDescripcion() ?></td>
                            <td><?= $producto->getCategoria() ?></td>
                            <td><?= $producto->getPrecioBruto() ?></td>
                            <td><?= $producto->getIva() ?></td>
                            <td><?= $producto->getPrecioUlCom() ?></td>
                            <td class="anchoAjustado">
                                <button name="editar" id="btnEditar" class="btn btnNeutro">Editar</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>
        <!-- Sección para Paginador -->
        <?php if ($contaPagsProductos->numPaginas() > 1): ?>
            <form action="#" method="post">
                <p class="txtCentrado anchoAjustado elemCentH">
                    <button type="submit" name="btnAnterior" id="btnAnterior" class="btn" <?php if ($contaPagsProductos->numPagina() == 1) echo "disabled"; ?> >< Anterior</button>
                    Página <?= ($contaPagsProductos->numPagina()) ?> de <?= $contaPagsProductos->numPaginas() ?>
                    <button type="submit" name="btnSiguiente" id="btnSiguiente" class="btn" <?php if ($contaPagsProductos->numPagina() == $contaPagsProductos->numPaginas()) echo "disabled"; ?> >Siguiente ></button>
                </p>
            </form>
        <?php endif; ?>
        <!-- Fin Sección para Paginador -->
    </section>
    <!-- Fin Sección para la tabla de productos_Jo$productos_Join -->

</body>
</html>