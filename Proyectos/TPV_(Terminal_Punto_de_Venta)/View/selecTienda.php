<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TPV</title>
    <!-- link rel="stylesheet" href="../View/css/header.css" -->
    <link rel="stylesheet" href="<?= RUTA_CSS.'header.css' ?>">
    <link rel="stylesheet" href="<?= RUTA_CSS.'estilos.css' ?>">
</head>
<body>
    <?php if(isset($tiendaAct)){
        include(RUTA_VISTA."Layout/header.php");
    } else {
        include(RUTA_VISTA."Layout/header_SinTienda.php");
    } ?>

    <section id="pagSelecTienda"  class="alto100 flexColCent flexColCentV">
        <div class="fondo_TPV"></div>
        <h1 class="txt_centrado">Seleccionar Tienda</h1>
        <div class="ancho60xC elemCentH">
            <form action="activarTienda.php" method="POST">
                <div class="flexColCent ancho60xC elemCentH">
                    <div class="divInput elemCentH">
                        <select name="selTienda" id="selTienda">
                            <option value="nuevaTienda">...Nueva Tienda</option>
                            <?php foreach ($tiendas['tiendas'] as $tienda): ?>
                                <option value="<?= $tienda->getId() ?>"><?= $tienda->getNombreCom() ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="elemCentH anchoAjustado">
                        <input type="submit" name="btnSelTienda" value="Seleccionar" class="btn btnOk">
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>