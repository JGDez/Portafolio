<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 10 del libro (5. Arrays)</title>
    <link rel="stylesheet" href="css/Ej10.css">
</head>
<body>
    <!--
        Ejercicio 10
        Realiza un programa que escoja al azar 10 cartas de la baraja española y que diga cuántos puntos
        suman según el juego de la brisca. Emplea un array asociativo para obtener los puntos a partir del
        nombre de la figura de la carta. Asegúrate de que no se repite ninguna carta, igual que si las hubieras
        cogido de una baraja de verdad.
    -->

    <!-- Lógica con PHP -->
    <?php
        $esFin=false;
        //Declarar variables
        $numeros = array ("As", 2, 3, 4, 5, 6, 7, "Sota", "Caballo", "Rey"); //Array con los números y figuras de la baraja
        $palos = array ("Oros", "Copas", "Espadas", "Bastos"); //Array con los palos de la baraja
        $puntosBrisca = array (
            "As" => 11,
            3 => 10,
            "Sota" => 2,
            "Caballo" => 3,
            "Rey" => 4,

        ); //Puntos a cada número de la baraja
        $baraja = array(); //Array con todas las cartas de la baraja.
        $barajaJuego = array(); //Array con las cartas para el juego (poder quitar y devolver cartas)
        $manoJugador = array(); //Serie de cartas del jugador.
        $ptsJugador = 0; //Puntos conseguidos por el jugador
        $nCartasMano = 10; //Número de cartas en la mano.
        $posCarta; //Posición de la baraja escogida.


        //Generar la baraja española.
        foreach ($palos as $palo){
            foreach ($numeros as $numero){
                array_push($baraja,["numero" => $numero, "palo" => $palo]);
            }
        }

        //Escoger 10 cartas de la baraja de forma aleatoria
        $barajaJuego = $baraja;
        for ($i = 0; $i < $nCartasMano; $i++){
            $posCarta = rand(0,count($barajaJuego)-1); //Generar una posición aleatoria para quitar de la baraja
            array_push($manoJugador,$barajaJuego[$posCarta]); //Pasar la carta de la posición a la mano del jugador
            array_splice($barajaJuego,$posCarta,1); //Quitar la carta de la posición de la baraja.
        }
        
        //Puntuar cartas:
        foreach ($manoJugador as $carta){
            if(array_key_exists($carta["numero"],$puntosBrisca)){
                $ptsJugador += $puntosBrisca[$carta["numero"]]; //Sumar los puntos de la carta
            }
        }
    ?>
    <!-- Parte visible HTML -->
    <div class="margen">
    <h1 class="centrarTxt" >Listar todas las cartas</h1>
</div>
<div class="columnas">
    <div class="col1">
        <p class="centrarTxt tamMedio"> Has conseguido un total de <?= $ptsJugador ?> puntos y tus cartas son:</p>
        <ul class="form">
            <?php foreach ($manoJugador as $carta): ?>
                <li class="tamMedio"><?= $carta["numero"] ?> de <?= $carta["palo"] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    
</div>

</body>
</html>