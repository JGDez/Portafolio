/*
--- Ejercicio 11 del Boletín 6: DOM ---
    Crea el juego de las parejas. Debes buscar una serie de imágenes para
    realizarlo y luego:
    ○ Muestra una cuadrícula donde se muestren aleatoriamente las imágenes
    con su imagen repetida durante un tiempo.
    Luego de pasar el tiempo, debes mostrar sólo el hueco donde estaba la
    imagen.
    ○ El usuario debe hacer click en un hueco para mostrar una imagen y
    luego otro para descubrir la pareja.
    ○ Si acierta, se mostrarán las imágenes, sino, se volverán a ocultar.
    ○ Llevarás la cuenta de los intentos, para que al final se muestren
    cuantos intentos se gastaron.
*/

//capturar elementos del DOM
let recuadros = document.getElementById("secRecuadros"); //Recuadros donde están las imágenes
let nIntentos = document.getElementById("nIntentos"); //Recuadro con el contador de intentos
let btnJuego = document.getElementById("botonJuego"); //Botón para realizar un nuevo juego


//Declaración de variables para el juego
const arrRutas = [
    "./Imagenes/Parejas/circulo.png",
    "./Imagenes/Parejas/cuadrado.png",
    "./Imagenes/Parejas/donut.png",
    "./Imagenes/Parejas/equis.png",
    "./Imagenes/Parejas/estrella.png",
    "./Imagenes/Parejas/pentagono.png",
    "./Imagenes/Parejas/rombo.png",
    "./Imagenes/Parejas/triangulo.png"
];
let arrRutasDesord = []; //Array que contendrá las rutas ordenadas aleatoriamente
let esperaInicio = 5000; //Milisegundos de espera para mostrar todas las imágenes al inicio
let esperaJuego = 1000; //Milisegundos de espera para mostrar las 2 imágenes descubiertas
let numIntentos = 0; //Número de para resolver el juego
let imgsMostradas = []; //Array del elemento de imágenes mostradas


/* --- SECCIÓN DE FUNCIONES DEL JUEGO --- */
function situarImagenes(){
    let cont = 0;
    for (let recuadro of recuadros.querySelectorAll("div")){
        recuadro.querySelector("img").src = arrRutasDesord[cont];
        cont++;
    }
}

function mostrarImagen(imgn){
    imgn.classList.remove("oculto");

}

function ocultarImagen(imgn){
    imgn.classList.add("oculto");
}

function mostrarPareja(imgn){
    if(imgsMostradas.length < 2){
        imgsMostradas.push(imgn); 
        mostrarImagen(imgn);
        if (imgsMostradas.length == 2){
            if(!comprobarIguales()){
                setTimeout(function() {
                    for (let i of imgsMostradas){
                        ocultarImagen(i);
                    }
                    imgsMostradas = [];
                }, esperaJuego);
            } else {
                imgsMostradas = [];
            }
            numIntentos++; //Aumenta en 1 el número de intentos de resolver el juego
            nIntentos.innerHTML = numIntentos;
        }
    }
}

function comprobarIguales(){
    if(imgsMostradas[0].src == imgsMostradas[1].src){
        return true;
    } else {
        return false;
    }
}

function iniciarJuego(){
    numIntentos = 0;
    nIntentos.innerHTML = numIntentos;
    arrRutasDesord = arrRutas;
    arrRutasDesord = arrRutasDesord.concat(arrRutas); //Duplicar los elementos
    //Desordenar la lista de imágenes
    arrRutasDesord = arrRutasDesord.sort(function(){return 0.5 - Math.random()});
    situarImagenes(); //Situar las imágenes en el HTML
    
    //Recorer imágenes y mostrarlas para verlas al principio
    for (let recuadro of recuadros.querySelectorAll("div")){
        mostrarImagen(recuadro.querySelector("img"));
    }
    //Mostrar imágenes Recorrer imágenes y ocultarlas pasados unos segundos
    for (let recuadro of recuadros.querySelectorAll("div")){
        setTimeout(ocultarImagen, esperaInicio, recuadro.querySelector("img"));
    }
}


/* --- EVENTOS --- */
recuadros.addEventListener("click", function(e){
    let recuadro = e.target;
    let imagen = recuadro.querySelector("img");
    if(imagen.classList.contains("oculto")){
        mostrarPareja(imagen);
    }
});

btnJuego.addEventListener("click", iniciarJuego);

/* --- Juego general --- */
iniciarJuego(); //Inciamos el juego