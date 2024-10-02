<?php
    session_start(); //Inicio de sesión
    if (!isset($_SESSION["carroCompra"])){
        $_SESSION["carroCompra"] = array(); //Array que contiene los productos comprados
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online (Ej. 5 / 7.Sesiones y Cookies)</title>
    <link rel="stylesheet" href="css/Ej05.css">
</head>
<body>
    <!--
        Ejercicio 5
        Crea una tienda on-line sencilla con un catálogo de productos y un carrito de la compra. Un
        catálogo de cuatro o cinco productos será suficiente. De cada producto se debe conocer al menos
        la descripción y el precio. Todos los productos deben tener una imagen que los identifique. Al lado
        de cada producto del catálogo deberá aparecer un botón Comprar que permita añadirlo al carrito.
        Si el usuario hace clic en el botón Comprar de un producto que ya estaba en el carrito, se deberá
        incrementar el número de unidades de dicho producto. Para cada producto que aparece en el carrito,
        habrá un botón Eliminar por si el usuario se arrepiente y quiere quitar un producto concreto del
        carrito de la compra. A continuación se muestra una captura de pantalla de una posible solución.

    -->

    <!-- Lógica con PHP -->
    <?php
        //Declaración de variables
        //Array con los productos de libros
        $libros = array(
            "9788418971273" => [
                "titulo" => "JAVA 17 FUNDAMENTOS PRACTICOS DE PROGRAMACION",
                "autor" => "JOSE MARIA VEGAS GERTRUDIX",
                "sinopsis" => "Java está presente a nuestro alrededor, se utiliza en servidores, en aplicaciones de escritorio, en dispositivos multimedia, en teléfonos móviles e incluso en juegos como el popular Minecraft. De ahí que haya estado presente en la cotidianidad de tus padres, está en la nuestra y estará presente en la de tus hijos.",
                "precio" => 28.40,
                "imgUrl" => "9788418971273.jpg",
            ],
            "9788441549241" => [
                "titulo" => "CURSO INTENSIVO DE PYTHON (3ª ED.)",
                "autor" => "ERIC MATTHES",
                "sinopsis" => "Este superventas mundial es una guía al lenguaje de programación Python. Gracias a esta trepidante y completa introducción a Python, no tardará en empezar a escribir programas, resolver problemas y desarrollar aplicaciones que funcionen.",
                "precio" => 49.87,
                "imgUrl" => "9788441549241.jpg",
            ],
            "9788441532106" => [
                "titulo" => "CODIGO LIMPIO: MANUAL DE ESTILO PARA EL DESARROLLO ÁGIL DE SOFTWARE",
                "autor" => "ROBERT C. MARTIN",
                "sinopsis" => "Cada año, se invierten innumerables horas y se pierden numerosos recursos debido a código mal escrito, ralentizando el desarrollo, disminuyendo la productividad, generando graves fallos e incluso pudiendo acabar con la organización o empresa.",
                "precio" => 49.87,
                "imgUrl" => "9788441532106.jpg",
            ],
            "9788484689881" => [
                "titulo" => "INTELIGENCIA ARTIFICIAL Y BIOÉTICA",
                "autor" => "RAFAEL AMO USANOS",
                "sinopsis" => "Este libro aborda las complejas interacciones entre la inteligencia artificial (IA) y los dilemas éticos en el campo de la medicina. A través de contribuciones de varios expertos, se exploran temas como la autonomía del paciente, la justicia en la atención médica, la privacidad de los datos y la responsabilidad en el uso de la IA.",
                "precio" => 19.95,
                "imgUrl" => "9788484689881.jpg",
            ],
        );

        /*Array con los productos añadidos al carro de la compra.
         * ISBN => [
         * "cantidad" => valor
         * ]
        */
        $carroCompra = array();
        $rutaImgs = "imagenes/"; //Ruta relativa del directorio de las imágenes.
        $cantProd = 0; //Cantidad de elementos del producto
        $carroCompra = $_SESSION["carroCompra"]; //Recuperar el carro desde la variable de sesión


        //Si se pulsa el botón comprar en algún producto se añade o aumenta la cantidad
        if (isset($_POST["btnComprar"])){

            //Comprobar si existe el producto en el carro, recuperar la cantidad anterior
            if (array_key_exists($_POST["btnComprar"], $carroCompra)){
                $cantProd = $carroCompra[$_POST["btnComprar"]];
            }

            $cantProd++; //Aumentar en 1 su cantidad
            //Actualizar el producto
            $carroCompra[$_POST["btnComprar"]] = $cantProd;
            
            //Actualizar la variable de sesión
            $_SESSION["carroCompra"] = $carroCompra;
        }

        //Disminuir en 1 el producto indicado
        if (isset($_POST['btnEliminar'])){
            //Recuperar la cantidad del producto
            $cantProd = $carroCompra[$_POST["btnEliminar"]];

            //Comprobar si se va a eliminar el producto y en caso contrario, disminuirlo en 1.
            if ($cantProd > 1){
                $cantProd--;
                $carroCompra[$_POST["btnEliminar"]] = $cantProd;
            } else {
                unset($carroCompra[$_POST["btnEliminar"]]);
            }
            
            //Actualizar la variable de sesión
            $_SESSION["carroCompra"] = $carroCompra;
        }

        
        //Borrar sesión
        if (isset($_POST['eliminarSesion'])){
            session_unset();
            session_destroy();
            header("refresh:0,"); //Necesario recargar la página
        }
    ?>
    <!-- Parte visible HTML -->
    <h1>TIENDA ON-LINE (Con sesiones)</h1>

    <div id="tienda" class="sec2Col">
        <div id="productos">
            <h2>Productos</h2>
            <form action="#" method="post" name="frmComp" class="bordeSup">
                <?php foreach ($libros as $isbn => $datosLib): ?>
                    <div id="prod" class="sec2Col bordeSup">
                        <img src="<?= $rutaImgs.$datosLib['imgUrl'] ?>" alt="<?= $datosLib['titulo'] ?>">
                        <div>
                            <p><?= $datosLib['titulo'] ?></p>
                            <p><?= $datosLib['autor'] ?></p>
                            <p><?= $datosLib['sinopsis'] ?></p>
                            <p class="precio"><?= $datosLib['precio'] ?> €</p>
                            <button type="submit" name="btnComprar" value="<?= $isbn ?>">Comprar</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </form>
            <div id="listaProd">

            </div>
        </div>

        <!-- Sección del carro de compra -->
        <div id="carro">
            <h2>Carrito</h2>
            
            <!-- Lista de productos del carro de la compra -->
            <div id="prodsCarro" class="sec2Col bordeSup">
                <?php if (count($carroCompra) > 0): ?>
                    <form action="#" method="post" name="frmCarroCompra">
                        <?php foreach ($carroCompra as $isbn => $cant): ?>

                            <!-- Producto del carro -->
                            <div id="prod" class="sec2Col bordeSup">
                                <img src="<?= $rutaImgs.$libros[$isbn]['imgUrl'] ?>" alt="<?= $libros[$isbn]['titulo'] ?>">
                                <div>
                                    <p><?= $libros[$isbn]['titulo'] ?></p>
                                    <p class="precio"><?= $libros[$isbn]['precio'] ?> €</p>
                                    <p>Unidades: <?= $cant ?></p>
                                    <button type="submit" name="btnEliminar" value="<?= $isbn ?>">Eliminar</button>
                                </div>
                            </div>
                            <!-- Fin del producto del carro -->

                        <?php endforeach; ?>
                        <div class="bordeSup">
                            <form action="#" method="post">
                                <button type="submit" name="eliminarSesion">Realizar pedido</button>
                            </form>
                        </div>
                    </form>
                <?php endif; ?>
                <!-- Botón que simula el procesar el pedido eliminando la sesión -->
            </div>
        </div>
    </div>

</body>
</html>