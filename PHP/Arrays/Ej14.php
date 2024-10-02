<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 14 del libro (5. Arrays)</title>
    <link rel="stylesheet" href="css/Ej14.css">
</head>
<body>
    <!--
        Ejercicio 14
        Escribe un programa que, dada una posición en un tablero de ajedrez, nos diga a qué casillas podría
        saltar un alfil que se encuentra en esa posición. Indícalo de forma gráfica sobre el tablero con un
        color diferente para estas casillas donde puede saltar la figura. El alfil se mueve siempre en diagonal.
        El tablero cuenta con 64 casillas. Las columnas se indican con las letras de la “a” a la “h” y las filas
        se indican del 1 al 8.
    -->

    <!-- Lógica con PHP -->
    <?php
        //Declarar variables
        $tablero = array(); //Array que representa a un tablero de ajedrez
        $posAlfil = array(); //Posición que ocupa el alfil (columna,fila)
        $columnas = array("A","B","C","D","E","F","G","H");
        $filas = array(8,7,6,5,4,3,2,1);
        $colAct; //Índice de la columna actual
        $filAct; //Índice de la fila actual
        $posPosibles = array(); //Array de posiciones posibles a mover el alfil (coumna,fila)

        $posAlfil = array("C",8); //Posición inicial por si no se ha indicado
        if ($_GET) $posAlfil = array($_GET["columna"],$_GET["fila"]);

        //Calcular posiciones posibles
        //Posiciones Inferiores derecha a la posición actual del alfil
        $colAct = array_search($posAlfil[0],$columnas) +1; //colocarlo en la siguiente columna a la actual
        $filAct = array_search($posAlfil[1],$filas) + 1; //colocarlo en la siguiente fila a la actual
        while ($colAct < count($columnas) && $filAct < count($filas)){
            array_push($posPosibles,[$columnas[$colAct],$filas[$filAct]]);
            $colAct++;
            $filAct++;
        }
        //Posiciones Inferiores izquierda a la posición actual del alfil
        $colAct = array_search($posAlfil[0],$columnas) -1; //colocarlo en la anterior columna a la actual
        $filAct = array_search($posAlfil[1],$filas) + 1; //colocarlo en la siguiente fila a la actual
        while ($colAct >= 0 && $filAct < count($filas)){
            array_push($posPosibles,[$columnas[$colAct],$filas[$filAct]]);
            $colAct--;
            $filAct++;
        }

        //Posiciones Superiores derecha a la posición actual del alfil
        $colAct = array_search($posAlfil[0],$columnas) +1; //colocarlo en la siguiente columna a la actual
        $filAct = array_search($posAlfil[1],$filas) - 1; //colocarlo en la anterior fila a la actual
        while ($colAct < count($columnas) && $filAct >= 0){
            array_push($posPosibles,[$columnas[$colAct],$filas[$filAct]]);
            $colAct++;
            $filAct--;
        }

        //Posiciones Superiores izquierda a la posición actual del alfil
        $colAct = array_search($posAlfil[0],$columnas) - 1; //colocarlo en la anterior columna a la actual
        $filAct = array_search($posAlfil[1],$filas) - 1; //colocarlo en la anterior fila a la actual
        while ($colAct >= 0 && $filAct >= 0){
            array_push($posPosibles,[$columnas[$colAct],$filas[$filAct]]);
            $colAct--;
            $filAct--;
        }
    ?>
    <!-- Parte visible HTML -->
    <div class="margen">
    <h1 class="centrarTxt" >Mostrar posiciones en que se puede mover el alfil en el ajedrez</h1>
</div>
<div class="columnas">
    <div class="col1">
        <form action="#" method="get">
            <p class="tamMedio centrarTxt">Indica la columna y fila que ocupa el alfil</p>
            <div class="cenAdap tamMedio">
                <select name="columna" id="">
                    <!-- Generar lista de opciones de fila -->
                    <?php foreach ($columnas as $c): ?>
                        <option value="<?= $c ?>"><?= $c ?></option>
                    <?php endforeach; ?>
                </select>
                <select name="fila" id="">
                    <!-- Generar lista de opciones de fila -->
                    <?php foreach ($filas as $f): ?>
                        <option value="<?= $f ?>"><?= $f ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <input type="submit" value="Consultar">
        </form>
        
    </div>

    <div class="col2">
        <div class="tablero">
            <!-- Título superior de las columnas -->
            <div class="fTablero">
                <div></div><!--Primera casilla vacía -->
                <?php foreach ($columnas as $c): ?>
                    <div class="tituloCol"><?= $c ?></div>
                <?php endforeach ?>
                <div></div><!--Primera casilla vacía -->
            </div>
            <!-- Fin título superior de las columnas -->
            
            <!-- Cada fila del tablero -->
            <?php foreach ($filas as $f): ?>
                <div class="fTablero f<?= $f%2 ?>">
                    <div class="tituloFil"><?= $f ?></div> <!-- Celda con su número -->
                    <?php for ($i = 0; $i < count($columnas) ; $i++): ?>
                        <?php if (in_array([$columnas[$i],$f],$posPosibles)): ?>
                            <div class="casilla casSelec" id="<?= ($f).$columnas[$i] ?>"></div>
                            <?php else: ?>
                                <?php if ([$columnas[$i],$f] == $posAlfil): ?>
                                    <div class="casilla" id="<?= $columnas[$i].($f) ?>"><img src="imagenes/pieza-de-ajedrez-alfil.png" alt="Alfil" srcset=""></div>
                                <?php else: ?>
                                    <div class="casilla" id="<?= $columnas[$i].($f) ?>"></div>
                                <?php endif; ?>
                        <?php endif; ?>
                    <?php endfor; ?>
                    <div class="tituloFil"><?= $f ?></div> <!-- Celda con su número -->
                </div>
            <?php endforeach; ?>
            <!-- Fin de cada fila del tablero -->

            <!-- Título inferior de las columnas -->
            <div class="fTablero">
                <div></div><!--Primera casilla vacía -->
                <?php foreach ($columnas as $c): ?>
                    <div class="tituloCol"><?= $c ?></div>
                <?php endforeach ?>
                <div></div><!--Primera casilla vacía -->
            </div>
            <!-- Fin título inferior de las columnas -->
        </div>
    </div>
    
    
</div>

</body>
</html>