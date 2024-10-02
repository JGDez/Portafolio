/*
--- Ejercicio 9 del Boletín 6: DOM ---
    Haz un pequeño juego de palabras que siga estas reglas:
    ○ Crea un array con 20 frases.
    ○ Selecciona de forma aleatoria una de las 20 frases y desordena las
    palabras que la componen.
    ○ Muestra al usuario las palabras desordenadas, para que luego, cuando
    pinche en una palabra se muestre debajo, de forma que podría ir
    montando la frase que cree que es la correcta.
    ○ Una vez la frase del usuario esté montada, debe pulsar un botón de
    validación para que compruebe si ha acertado o no.
*/
   
//Declaración de variables
const frases = [ //Lista de imágenes para adivinar
    "No hay caminos para la paz; la paz es el camino",
    "Lo peor que hacen los malos es obligarnos a dudar de los buenos",
    "Cada día sabemos más y entendemos menos",
    "Hay un placer mayor que matar, dejar vivir",
    "El dinero no puede comprar la vida",
    "Hay dos cosas que son infinitas: el universo y la estupidez humana; de la primera no estoy muy seguro",
    "Pienso, luego existo",
    "Lo que no te mata, te hace más fuerte",
    "No abras los labios si no estás seguro de que lo que vas a decir es más hermoso que el silencio",
    "De humanos es errar y de necios permanecer en el error",
    "La verdadera sabiduría está en reconocer la propia ignorancia",
    "La peor experiencia es la mejor maestra",
    "Los amigos se convierten con frecuencia en ladrones de nuestro tiempo",
    "Un amigo de todos es un amigo de nadie",
    "Hace falta toda una vida para aprender a vivir",
    "Estos son mis principios y si no te gustan, tengo otros",
    "Es mejor permanecer callado y parecer tonto que hablar y despejar las dudas definitivamente",
    "La inspiración existe, pero tiene que encontrarte trabajando",
    "Ojo por ojo y el mundo acabará ciego",
    "Solo sé que no sé nada",
    "Nunca rompas el silencio si no es para mejorarlo",
    "El único hombre que no se equivoca es el que nunca hace nada"
];
//capturar elementos del DOM
let btnJugar = document.getElementById("botonJugar"); //Elemento botón Jugar
let btnComp = document.getElementById("botonComp"); //Elemento botón Comprobar
let palabrasFrase = document.getElementById("fraseDesordenada"); //Div donde está la frase desordenada
let palabrasJugador = document.getElementById("fraseJugador"); //Div donde está la frase ordenada por el jugador
let resultado = document.getElementById("resultado"); //Div donde está el mensaje del resultado de la partida

//Variables
let fraseJuego = ""; //Frase elegida del array
let fraseDesordenada; //Palabras de la frase desordenadas
let fraseJugador = ""; //Frase del jugador

function desordenarFrase(frase){
    return frase.split(" ").sort(function(){return 0.5 - Math.random()});
}   

function generarCodDesordenadas(arrLista){
    let codLista = ""; //Código con los párrafos que contiene las palabras del array pasado
    let contDiv=0; //Contador de párrafos generados para crear el ID.
    for (pal of arrLista){
        contDiv++
        codLista += `<p id="palDes${2}">${pal}</p>`;
    }
    
    return codLista;
}

/**
 * Limpia los elementos del juego anterior, si los hubiera y 
 * genera la frase desordenada situándola en su sitio del HTML.
 */
function generarFrase() {
    limpiarJuego();
    //Escoger una frase aleatoria
    fraseJuego = frases[Math.floor(Math.random() * frases.length)];
    fraseDesordenada = desordenarFrase(fraseJuego);
    palabrasFrase.innerHTML = generarCodDesordenadas(fraseDesordenada);
}

/**
 * Limpia los elementos del juego anterior, si los hubiera.
 */
function limpiarJuego(){
    //Inicializar juego
    palabrasFrase.innerHTML = "";
    palabrasJugador.innerHTML = "";
    resultado.innerHTML = "";
    document.getElementById("contenedorJuego").classList.remove("gana", "pierde");
}

/* --- Eventos --- */
/**
 * Comprueba cuando se pulsa en el botón Jugar y genera la frase
 * desordenada situándola en su sitio del HTML.
 */
btnJugar.addEventListener("click", generarFrase);

/**
 * Al pulsar en una plabra de la frase desordenada
 * Mueve la palabra pulsada de la frase desordenada a la ordenada
 */
palabrasFrase.addEventListener("click", function(e){
    //comprueba cual ha sido el elemento clicado
    let palSel = e.target;
    //Recuperar el elemento que corresponde a la palabra pulsada
    palSel.remove();
    //Pasar la palabra pulsada de desordenadas a las elegidas por el usuario

    //fraseDesordenada.remove(document.getElementById(idE));
    palabrasJugador.appendChild(palSel);

});

/**
 * Al pulsar en una palabra de la frase ordenada
 * Mueve la palabra pulsada de la frase ordenada a la desordenada
 */
palabrasJugador.addEventListener("click", function(e){
    //comprueba cual ha sido el elemento clicado
    let palSel = e.target;
    //Recuperar el elemento que corresponde a la palabra pulsada
    palSel.remove();
    //Pasar la palabra pulsada de desordenadas a las elegidas por el usuario

    //fraseDesordenada.remove(document.getElementById(idE));
    palabrasFrase.appendChild(palSel);

});

/**
 * Al pulsar el botón Comprobar
 * Comprueba si el jugador ha acertado con el orden de la frase
 */
btnComp.addEventListener("click", function() {
    let arrFraseJugador = []; //array que contendrá la frase del jugador
    //Monta la frase del jugador en un String.
    for (palabra of palabrasJugador.querySelectorAll("p")){
        arrFraseJugador.push(palabra.innerHTML);
    }
    fraseJugador = arrFraseJugador.join(" ");

    //Comprueba si ha acertado muestra el mensaje y cambia el estilo según el resultado del juego
    if(fraseJuego == fraseJugador){
        resultado.innerHTML = `<p class="acierta">Enhorabuena, has acertado la frase</p>`;
        //Aplica formato cuando gana
        document.getElementById("contenedorJuego").classList.add("gana");
    } else {
        resultado.innerHTML = `<p class="falla">Lo siento pero no has acertado. La frase correcta es:</p>`;
        resultado.innerHTML += `<p class="frasecorrecta">${fraseJuego}</p>`
        //Aplica formato cuando pierde
        document.getElementById("contenedorJuego").classList.add("pierde");
    }

    //Cambia el estilo según el resultado del juego
})



/* --- Programa principal --- */
//Generar frase al cargar la página
generarFrase();
