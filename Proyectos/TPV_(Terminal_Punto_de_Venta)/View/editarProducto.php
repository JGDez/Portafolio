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
        <h1 class="txt_centrado txtMayusculas">Editar producto</h1>
        <!-- Inicio Formulario -->
        <!--form action="<?php RUTA_CONTROLADOR.'actualizarProducto.php' ?>" enctype="multipart/form-data" method="post"-->
        <form action="../Controller/actualizarProducto.php" enctype="multipart/form-data" method="post">
            <div class="flexRow ancho100xC">
    
                <!-- Foto del producto -->
                <div id="imagenes" class="ancho30xC">
                    <div class="imgLogo ancho80xC" id="cargaImgProd">
                        <h2>Imagen del producto</h2>
                        <input type="hidden" name="imgOrig" id="imgOrig" value="<?= $producto->getImagenProd() ?>">
                        <img src="<?= $rutaProds.$producto->getImagenProd() ?>" alt="Foto del producto" id="vistaImg" />
                        <input type="file" name="Img" id="Img" accept="image/*" value="<?= $rutaProds.$producto->getImagenProd() ?>"/>
                        <label for="Img" class="btn btnNeutro">Cambiar Imagen</label>
                    </div>
                </div>
                <!-- Fin Fotos del producto -->
    
                <!-- Datos del producto -->
                <div id="lista_form" class="ancho70xC">
                    <input type="hidden" name="id" id="id" value="<?= $producto->getId() ?>">
                    <div class="divInput">
                        <label for="codigo">Código</label><br>
                        <input type="text" name="codigo" id="codigo" value="<?= $producto->getCodigo() ?>" placeholder="Código del producto" required maxlength="20">
                    </div>
                    <div class="divInput">
                        <label for="nombre">Nombre</label><br>
                        <input type="text" name="nombre" id="nombre" value="<?= $producto->getNombre() ?>" placeholder="Nombre del producto" required maxlength="50">
                    </div>
                    <div class="divInput">
                        <label for="descripcion">Descripción del producto</label><br>
                        <textarea type="text" name="descripcion" id="descripcion" maxlength="250" placeholder="Puedes escribir una descripción (máximo 250 caracteres)"><?= $producto->getDescripcion() ?></textarea>
                    </div>
                    <div class="divInput">
                        <label for="categoria">Categoría</label><br>
                        <select name="categoria" id="categoria">
                            <?php foreach ($categorias['Categorias'] as $categoria): ?>
                                <option value="<?= $categoria->getId() ?>" <?php if ($categoria->getId() == $producto->getCategoria()) echo 'selected="true"'; ?>><?= $categoria->getNombre() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="divInput">
                        <label for="precioBruto">Precio bruto</label><br>
                        <input type="number" name="precioBruto" id="precioBruto" step="0.01" min="0" value="<?= $producto->getPrecioBruto() ?>" required>
                    </div>
                    <div class="divInput">
                        <label for="iva">I.V.A.</label><br>
                        <select name="iva" id="iva">
                            <?php foreach ($tipos_iva['TiposIVA'] as $tipo_IVA): ?>
                                <option value="<?= $tipo_IVA->getId() ?>" <?php if ($tipo_IVA->getId() == $producto->getIva()) echo 'selected="true"'; ?>><?= $tipo_IVA->getValor_IVA() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="divInput">
                        <label for="precioUlCom">Precio última compra</label><br>
                        <input type="number" name="precioUlCom" id="precioUlCom" step="0.01" min="0" value="<?= $producto->getPrecioUlCom() ?>" required>
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
            </div>

        </form>
        <!-- Fin Inicio Formulario -->
    </div>
</body>
<!-- Código JavaScript -->
<script src="<?= RUTA_JS.'SubirFoto.js'?>" ></script>
</html>