<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPV</title>
    <link rel="icon" type="image/x-icon" href="<?= $rutaImgs.'favicon.png' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS . 'estilos.css' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS . 'header.css' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS . 'tablas.css' ?>">
</head>

<body>
    <?php include(RUTA_VISTA . "Layout/header.php") ?>
    <!-- Sección para el espacio del TPV -->
    <section class="ancho100xC flexRow ajusteCompV ajusteCompH" id="secTPV">
        <!-- Sección para la ventana modal de pago -->
        <dialog id="dialogoCobrar">
            <form action="../Controller/tpvAcciones.php" method="post" id="cobrarModal" onsubmit="return false;" class="flexColCentV">
                <section>
                    <div class="anchoAjustado flexRow elemCentH espacioFin">
                        <div>Total:</div>
                        <div id="importeTotal"><?= number_format($totalesCaja, 2) ?> €</div>
                    </div>
                    <div class="anchoAjustado flexRow elemCentH espacioFin divInput">
                        <label for="entregado">Entregado:</label>
                        <input type="number" name="entregado" id="entregado" value="<?= number_format(0, 2) ?>" class="modal_Input" min="0" step="0.01" required>
                    </div>
                    <div class="anchoAjustado flexRow elemCentH">
                        <div>Devolución:</div>
                        <div id="devolucion"></div>
                    </div>
                </section>
                
                <menu>
                    <button id="btnCancelarModal" name="btnCancelarModal" type="reset" class="btn btnNeutro">Cancelar</button>
                    <button type="button" id="btnCobrarModal" name="btnCobrarModal" class="btn btnOk">Cobrar</button>
                </menu>
                <div id="msgContenedor"></div>
            </form>
        </dialog>
        <!-- Fin Sección para la ventana modal de pago -->
        
        <!-- Sección para el espacio al lado izquierdo -->
        <section class="ancho50xC alto100" id="secIzq">
            <!-- Sección para los productos a comprar -->
            <section id="secCaja" class="alto60 bordeSimple sepInicio">
                <div id="divTabla" class="barraV">
                    <table>
                        <thead>
                            <tr>
                                <th hidden></th>
                                <th>Uds.</th>
                                <th>Producto</th>
                                <th>Dto.</th>
                                <th>Importe</th>
                            </tr>
                        </thead>
                        <tbody id="elementosCaja">
                            <?php foreach ($productosCaja as $idProd => $prodCaja) : ?>
                                <tr>
                                    <td name="idProd" hidden><?= $idProd ?></td>
                                    <td><?= $prodCaja['uds'] ?></td>
                                    <td><?= $prodCaja['producto'] ?></td>
                                    <td><?= number_format($prodCaja['descuento'], 2) ?></td>
                                    <td><?= number_format($prodCaja['importe'] * $prodCaja['uds'], 2) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Sección para totales -->
                <section id="secTotales" class="">
                    <div class="flexRow">
                        <div>Total:</div>
                        <div><?= number_format($totalesCaja, 2) ?> €</div>
                    </div>
                    <div class="flexRow">
                        <div>Entregado:</div>
                        <div><?= number_format(0, 2) ?> €</div>
                    </div>
                    <div class="flexRow">
                        <div>Devolución:</div>
                        <div><?= number_format(0, 2) ?> €</div>
                    </div>
                </section>
            </section>
            <!-- Fin Sección para los productos a comprar -->
            <!-- Sección para el teclado y opciones -->
            <section id="secOpciones" class="alto40 bordeSimple sepInicio">
                <form action="../Controller/tpvAcciones.php" method="post">
                    <button name="eliminarProd" id="eliminarProd" value="" class="espacioFin btnProd" disabled>
                        <img class="MxAncho70xC MxAlto60xC" src="<?= $rutaImgs ?>CuboBasura.png" alt="Icono eliminar producto">
                        <div>Eliminar producto</div>
                    </button>
                </form>
                <button name="btnCobrar" id="btnCobrar" value="" class="espacioFin btnProd" <?php if (count($productosCaja) == 0) echo "disabled" ?> >
                    <img class="MxAncho70xC MxAlto60xC" src="<?= $rutaImgs ?>ticket.png" alt="Icono de un ticket de compra">
                    <div>Cobrar Productos</div>
                </button>
            </section>
            <!-- Fin Sección para el teclado y opciones -->
        </section>
        <!-- Fin Sección para el espacio al lado izquierdo -->

        <!-- Sección para el espacio al lado derecho -->
        <section class="ancho50xC alto100" id="secDcha">
            <!-- Sección para las categorías -->
            <section id="secCategorias" class="alto30 bordeSimple sepInicio barraV">
                <form action="../Controller/tpvAcciones.php" method="post">
                    <button name="selCategoria" value="%" class="anchoAjustado espacioFin btn btnCategoria txtMayusculas" style="background-color: white;">Todas</button>
                </form>
                <?php foreach ($categorias['Categorias'] as $categoria) : ?>
                    <form action="../Controller/tpvAcciones.php" method="post">
                        <button name="selCategoria" value="<?= $categoria->getId() ?>" class="anchoAjustado espacioFin btn btnCategoria" style="background-color: <?= $categoria->getColor() ?>;"><?= $categoria->getNombre() ?></button>
                    </form>
                <?php endforeach; ?>
            </section>
            <!-- Fin Sección para las categorías -->
            <!-- Sección para los productos -->
            <section id="secProductos" class="alto70 bordeSimple sepInicio barraV">
                <?php foreach ($productos['Productos'] as $producto) : ?>
                    <form action="../Controller/tpvAcciones.php" method="post">
                        <button name="selProducto" value="<?= $producto->getId() ?>" class="espacioFin btnProd">
                            <img class="MxAncho70xC MxAlto80xC" src="<?= $rutaProds . $producto->getImagenProd() ?>" alt="<?= $producto->getNombre() ?>" title="<?= $producto->getNombre() ?>">
                            <div class="truncado"><?= $producto->getNombre() ?></div>
                        </button>
                    </form>
                <?php endforeach; ?>
            </section>
            <!-- Fin Sección para los productos -->
        </section>
        <!-- Fin Sección para el espacio al lado derecho -->
    </section>
    <!-- Fin Sección para el espacio del TPV -->
</body>
<!-- Código JavaScript -->
<script src="<?= RUTA_JS . 'tpv.js' ?>"></script>

</html>