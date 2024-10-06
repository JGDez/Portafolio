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
    <?php if(isset($tiendaAct)){
            include(RUTA_VISTA."Layout/header.php");    
        } else {
            include(RUTA_VISTA."Layout/header_SinTienda.php");
    } ?>
    <!-- Fin Encabezado de la página -->

    <div class="divForm">
        <h1 class="txt_centrado">Creación de tienda nueva</h1>
        <!-- Inicio Formulario -->
        <!--form action="<?php RUTA_CONTROLADOR.'aniadirTienda.php' ?>" enctype="multipart/form-data" method="post"-->
        <form action="../Controller/aniadirTienda.php" enctype="multipart/form-data" method="post">
            <div class="flexRow ancho100xC">
                
                <!-- Fotos para la tienda -->
                <div id="imagenes" class="ancho30xC">
                    <div class="imgLogo ancho80xC" id="cargaLogoTienda">
                        <h2>Logo de la tienda</h2>
                        <img src="/View/Imagenes/img_Defecto.png" alt="Logo de muestra" id="vistaLogoTienda" />
                        <input type="file" name="logoTienda" id="logoTienda" accept="image/*" />
                        <label for="logoTienda" class="btn btnNeutro">Cambiar foto</label>
                    </div>
                    <div class="imgLogo ancho80xC" id="cargaLogoTicket">
                    <h2>Logo para el ticket</h2>
                        <img src="/View/Imagenes/img_Defecto.png" alt="Logo de muestra" id="vistaLogoTicket" />
                        <input type="file" name="logoTicket" id="logoTicket" accept="image/*" required />
                        <label for="logoTicket" class="btn btnNeutro">Cambiar foto</label>
                    </div>
                </div>
                <!-- Fin Fotos para la tienda -->

                <!-- Columna de datos de la tienda -->
                <div id="lista_form" class="ancho70xC">
                    <div class="divInput ancho40xC">
                        <label for="cif_nif">C.I.F./N.I.F.</label><br>
                        <input type="text" name="cif_nif" id="cif_nif" placeholder="C.I.F. o N.I.F." required maxlength="9">
                    </div>
                    <div class="divInput">
                        <label for="nombre_Fis">Nombre Fiscal</label><br>
                        <input type="text" name="nombre_Fis" id="nombre_Fis" placeholder="Nombre Fiscal de la empresa" required maxlength="50">
                    </div>
                    <div class="divInput">
                        <label for="nombre_Com">Nombre Comercial</label><br>
                        <input type="text" name="nombre_Com" id="nombre_Com" placeholder="Nombre Comercial de la emrpesa" required maxlength="50">
                    </div>
                    <div class="flexRow">
                        <div class="ancho60xC divInput">
                            <label for="direccion">Dirección</label><br>
                            <input type="text" name="direccion" id="direccion" placeholder="Dirección postal" required maxlength="100">
                        </div>
                        <div class="ancho40xC divInput">
                            <label for="poblacion">Población</label><br>
                            <input type="text" name="poblacion" id="poblacion" placeholder="Población" required maxlength="50">
                        </div>
                    </div>
                    <div class="flexRow">
                        <div class="ancho40xC divInput">
                            <label for="cp">Código Postal</label><br>
                            <input type="text" name="cp" id="cp" placeholder="Código postal" required maxlength="5">
                        </div>
                        <div class="ancho40xC divInput">
                            <label for="provincia">Provincia</label><br>
                            <input type="text" name="provincia" id="provincia" placeholder="Provincia" required maxlength="50">
                        </div>
                    </div>
                    <div class="divInput">
                        <label for="email">Correo electrónico</label><br>
                        <input type="email" name="email" id="email" placeholder="Dirección de correo electrónico" maxlength="100">
                    </div>
                    <div class="flexRow">
                        <div class="ancho40xC divInput">
                            <label for="telef">Teléfono</label><br>
                            <input type="tel" name="telef" id="telef" placeholder="Número de teléfono" maxlength="15">
                        </div>
                        <div class="ancho40xC divInput">
                            <label for="movil">Móvil</label><br>
                            <input type="tel" name="movil" id="movil" placeholder="Número de móvil" maxlength="15">
                        </div>
                    </div>
                    
                    <!-- Botones del formulario -->
                    <div>
                        <input type="submit" name="aceptar" value="Aceptar" class="btn btnOk">
                        <input type="reset" value="Limpiar datos" class="btn btnNeutro">
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