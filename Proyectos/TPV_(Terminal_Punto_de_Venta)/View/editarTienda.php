<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPV</title>
    <link rel="stylesheet" href="<?= RUTA_CSS.'header.css' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS.'estilos.css' ?>">
</head>
<body>
    <?php include(RUTA_VISTA."Layout/header.php") ?>

    <div class="divForm">
        <h1 class="txt_centrado txtMayusculas">Editar Tienda</h1>
        <!-- Inicio Formulario -->
        <form action="<?= RUTA_CONTROLADOR.'actualizarTienda.php' ?>" enctype="multipart/form-data" method="post">
            <div class="flexRow ancho100xC">
                
                <!-- Fotos para la tienda -->
                <div id="imagenes" class="ancho30xC">
                    <div class="imgLogo ancho80xC" id="cargaLogoTienda">
                        <h2>Logo de la tienda</h2>
                        <img src="<?= $rutaLogos.$tienda->getLogoTienda() ?>" alt="Logo" id="vistaLogoTienda" />
                        <input type="file" name="logoTienda" id="logoTienda" accept="image/*" value="<?= $rutaLogos.$tienda->getLogoTienda() ?>" />
                        <label for="logoTienda" class="btn btnNeutro">Cambiar foto</label>
                    </div>
                    <div class="imgLogo ancho80xC" id="cargaLogoTicket">
                    <h2>Logo para el ticket</h2>
                        <img src="<?= $rutaLogos.$tienda->getLogoTicket() ?>" alt="Logo de muestra" id="vistaLogoTicket" />
                        <input type="file" name="logoTicket" id="logoTicket" accept="image/*" />
                        <label for="logoTicket" class="btn btnNeutro">Cambiar foto</label>
                    </div>
                </div>
                <!-- Fin Fotos para la tienda -->

                <!-- Columna de datos de la tienda -->
                <div id="lista_form" class="ancho70xC">
                    <div class="divInput ancho40xC">
                        <label for="cif_nif">C.I.F./N.I.F.</label><br>
                        <input type="text" name="cif_nif" id="cif_nif" value="<?= $tienda->getCifNif() ?>" placeholder="C.I.F. o N.I.F." required>
                    </div>
                    <div class="divInput">
                        <label for="nombre_Fis">Nombre Fiscal</label><br>
                        <input type="text" name="nombre_Fis" id="nombre_Fis" value="<?= $tienda->getNombreFis() ?>" placeholder="Nombre Fiscal de la empresa" required>
                    </div>
                    <div class="divInput">
                        <label for="nombre_Com">Nombre Comercial</label><br>
                        <input type="text" name="nombre_Com" id="nombre_Com" value="<?= $tienda->getNombreCom() ?>" placeholder="Nombre Comercial de la emrpesa" required>
                    </div>
                    <div class="flexRow">
                        <div class="ancho60xC divInput">
                            <label for="direccion">Dirección</label><br>
                            <input type="text" name="direccion" id="direccion" value="<?= $tienda->getDireccion() ?>" placeholder="Dirección postal" required>
                        </div>
                        <div class="ancho40xC divInput">
                            <label for="poblacion">Población</label><br>
                            <input type="text" name="poblacion" id="poblacion" value="<?= $tienda->getPoblacion() ?>" placeholder="Población" required>
                        </div>
                    </div>
                    <div class="flexRow">
                        <div class="ancho40xC divInput">
                            <label for="cp">Código Postal</label><br>
                            <input type="text" name="cp" id="cp" value="<?= $tienda->getCp() ?>" placeholder="Código postal" required>
                        </div>
                        <div class="ancho40xC divInput">
                            <label for="provincia">Provincia</label><br>
                            <input type="text" name="provincia" id="provincia" value="<?= $tienda->getProvincia() ?>" placeholder="Provincia" required>
                        </div>
                    </div>
                    <div class="divInput">
                        <label for="email">Correo electrónico</label><br>
                        <input type="email" name="email" id="email" value="<?= $tienda->getEmail() ?>" placeholder="Dirección de correo electrónico">
                    </div>
                    <div class="flexRow">
                        <div class="ancho40xC divInput">
                            <label for="telef">Teléfono</label><br>
                            <input type="text" name="telef" id="telef" value="<?= $tienda->getTelef() ?>" placeholder="Número de teléfono">
                        </div>
                        <div class="ancho40xC divInput">
                            <label for="movil">Móvil</label><br>
                            <input type="text" name="movil" id="movil" value="<?= $tienda->getMovil() ?>" placeholder="Número de móvil">
                        </div>
                    </div>
                    
                    <!-- Botones del formulario -->
                    <div class="espacioFin">
                        <input type="submit" name="aceptar" value="Aceptar" class="btn btnOk">
                        <button name="cancelar" class="btn btnNeutro">Cancelar</button>
                        <button name="eliminar" class="btn btnPeligro">Eliminar</button>
                    </div>
                    <!-- Fin Botones del formulario -->
                </div>
                <!-- Fin Columna de datos de la tienda -->

            </div>
        </form>
        <!-- Fin Inicio Formulario -->
    </div>
</body>
<!-- Código JavaScript -->
<script src="<?= RUTA_JS.'logoTienda.js'?>" ></script>
</html>