/*
--- Ejercicio 10 del Boletín 6: DOM ---
    Trata de hacer el juego de piedra, papel o tijera con una interfaz de
    usuario en la que pueda interaccionar de forma cómoda y amigable.
*/
   
//Declaración de variables para el juego de piedra, papel, tijera
let opJugador; //Opción elegida por el jugador
let opPC; //Opción sacada por el PC
let ganaJu = false; //Contiene resultado de la partida
let msg = ""; //Mensaje para cuando no se elije la opción correcta.
const figuras = ["Piedra", "Papel", "Tijera"]; //Contiene las figuras del juego

//capturar elementos del DOM
let btnJuego = document.getElementById("botonJuego"); //Elemento botón para jugar o resetear el juego
let piezasJugador = document.getElementById("seccionJugador"); //Div donde están las piezas del jugador
let piezasPC = document.getElementById("seccionPC"); //Div donde están las piezas del PC
let msgs = document.getElementById("mensajes"); //Div para mostrar mensajes al jugador

/* --- SECCIÓN DE FUNCIONES DEL JUEGO --- */

/**
 * Inicializa los valores para un juego nuevo
 */
function inicializarJuego(){
    //Recorre las piezas del jugador para reserarlas a valores por defecto
    for (pieza of piezasJugador.querySelectorAll("img")){
        pieza.setAttribute("class", "noSelec");
    }
    //Recorre las piezas del PC para reserarlas a valores por defecto
    for (pieza of piezasPC.querySelectorAll("img")){
        pieza.setAttribute("class", "noSelec");
    }
    //Pone las secciones a valores por defecto
    msgs.innerHTML = "";
    btnJuego.innerHTML = "Jugar";
    opJugador = null; //Inicializa la opción elegida por el jugador.
    opPC = null;
}

function selecFigura(fSelec, piezas){
    console.log("Haciendo");
    for (pieza of piezas.querySelectorAll("img")){
        if (pieza.id == fSelec.id) {
            pieza.classList.replace("noSelec", "siSelec");
        } else {
            pieza.classList.replace("siSelec", "noSelec");
        }
    }
}

function navegarPiezasPC() {
    let nVeces = 5;
    let espera = 3000;
    let figura;
    let figAleatoria;
    
    for (let i = 0; i < nVeces; i++){
        figAleatoria = Math.floor(Math.random() * figuras.length);
        figura = document.getElementById("fig" + figuras[figAleatoria] + "PC");
        console.log("Figura",figura);
        setTimeout(selecFigura(figura, piezasPC), espera);
    }

    return figAleatoria;
}

function jugar(){
//Generar tirada del PC
//Hacer movimiento

opPC = navegarPiezasPC();
console.log("Op Jug",opJugador);
console.log("Op PC",opPC);

ganaJu = false; //Inicializa el control de si gana el jugador.

/* Combinaciones ganadoras
- 0.Piedra gana a 2.tijera
- 2.Tijera gana a 1.papel
- 1.Papel gana a  0.piedra
*/

//Comprobar si gana el jugador
switch (opJugador){
    case 0:
        if (opPC == 2){
            ganaJu = true;
        }
        break;
    case 1:
        if (opPC == 0){
            ganaJu = true;
        }
        break;
    case 2:
        if (opPC == 1){
            ganaJu = true;
        }
        break;
}


//Informar del resultado
msg.innerHTML = ""; //Quitar cualquier otro mensaje
if(opJugador == opPC){
    msgs.innerHTML = `¡Empate! Hemos sacado ${figuras[opPC]}`;
} else if (!ganaJu){
    msgs.innerHTML = `Has perdido, ${figuras[opPC]} gana a ${figuras[opJugador]}`;
} else if (ganaJu){
    msgs.innerHTML = `Has ganado, ${figuras[opJugador]} gana a ${figuras[opPC]}`;
}
}

/* --- Eventos --- */

/**
 * Al pulsar en una plabra de la frase desordenada
 * Mueve la palabra pulsada de la frase desordenada a la ordenada
 */
piezasJugador.addEventListener("click", function(e){
    //comprueba cual ha sido el elemento clicado
    let figSel = e.target;
    //Establece la opción del jugador
    opJugador = figuras.indexOf(figSel.name);
    //Modifica el estilo de las figuras según la selección del jugador
    selecFigura(figSel, piezasJugador);
});

btnJuego.addEventListener("click", function(){
    if(opPC == null){
        //Comprobar si el jugador ha elegido una figura
        if(opJugador != null){
            jugar();
            btnJuego.innerHTML = "Jugar otra vez";
        } else {
            msgs.innerHTML = "Tienes que elegir una opción"
        }
    } else {
        inicializarJuego();
    }
})


/* --- Programa principal --- */
//Reiniciar el juego
inicializarJuego();
