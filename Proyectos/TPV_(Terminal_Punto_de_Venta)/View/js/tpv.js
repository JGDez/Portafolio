//Declaración de variables
let msg = ""; //Texto para mostrar mensajes
let productosCaja; //Lista de elementos que representan los productos añadidos a la caja
let btnEliminar; //Elemento del botón eliminar producto
let dialogoCobrar; //Diálogo modal para realizar el cobro de la compra
let btnCobrar; //Elemento del botón de opciones para cobrar
let btnCobrarModal; //Botón de la ventana modal para finalizar el cobro
let btnCancelarModal; //Elemento del botón para cobrar de la ventana modal.
let entregado; //Input de la venta modal donde se indica el dinero entregado para cobrar.
let importeTotal; //Elemento de la ventana modal con el importe a cobrar.
let devolucion; //Elemento de la ventana modal donde se indica la cantidad a devolver para cobrar.
let msgContenedor; //Elemento donde mostrar un mensaje

//Capturar elementos
productosCaja = document.getElementById("elementosCaja"); //Elemento con productos en caja
btnEliminar = document.getElementById("eliminarProd"); //Elemento del botón para eliminar producto.
dialogoCobrar = document.getElementById("dialogoCobrar");
btnCobrar = document.getElementById("btnCobrar"); //Elemento del botón para cobrar los productos.
btnCobrarModal = document.getElementById("btnCobrarModal"); //Botón de la ventana modal para finalizar el cobro
btnCancelarModal = document.getElementById("btnCancelarModal"); //Elemento del botón para cancelar el cobro en la ventana modal.
entregado = document.getElementById("entregado"); //Input de la ventana modal con la cantidad de dinero entregado para cobrar.
devolucion = document.getElementById("devolucion"); //Elemento de la ventana modal donde se indica la cantidad a devolver para cobrar.
importeTotal = document.getElementById("importeTotal"); //Elemento de la ventana modal con el importe a cobrar.
msgContenedor = document.getElementById("msgContenedor"); //Elemento donde mostrar un mensaje

/* -- FUNCIONES -- */

/**
 * Función que activa la ventana modal para realizar el cobro
 */
function cobrar(){
    calculaDevolucion();
    dialogoCobrar.showModal();
}

/**
 * Función que oculta la ventana modal para realizar el cobro
 */
function cancelarCobro() {
    dialogoCobrar.close();
}

/**
 * Calcula el importe a devolver
 */
function calculaDevolucion() {
    let aDevolver = (entregado.value - parseFloat(importeTotal.textContent)).toFixed(2);
    devolucion.textContent = aDevolver + " €";
    return aDevolver;
}

function enviarFormCobrar() {
    if (calculaDevolucion() >=0) {
        document.getElementById("cobrarModal").submit();
    } else {
        msg = "No se ha completado el importe";
        msgContenedor.textContent = msg;
    }
}

/* --- EVENTOS --- */

/**
 * Evento disparado al pulsar sobre un producto en caja para su compra.
 * Realiza las funciones necesarias para poder eliminar el producto indicado 
 * cuando se pulse sobre el botón elimnar.
 */
productosCaja.addEventListener("click", function(e){
    //Recuperar el elemento pulsado
    let productoSel = e.target.parentElement; //Como quien recibe el evento es la celda, elegir el padre
    if (productoSel.classList.contains("selec")){
        //Si el elemento marcado está seleccinado, deseleccionarlo
        productoSel.classList.remove("selec");
        btnEliminar.value = "";
        btnEliminar.setAttribute("disabled", "");
    } else {
        //eliminar los elementos anteriormente marcados
        let filas = productosCaja.querySelectorAll("tr");
        for (let fila of filas){
            fila.classList.remove("selec");
        }
        //Marcar el elemento seleccionado
        productoSel.classList.add("selec");
        btnEliminar.value = productoSel.firstElementChild.textContent;
        btnEliminar.removeAttribute("disabled");
    }
});

/**
 * Evento cuando se pulsa en el botón de cobrar de la zona de opciones.
 */
btnCobrar.addEventListener("click", cobrar);

/**
 * Evento cuando se pulsa en el botón cancelar de la ventana modal para realizar el cobro.
 */
btnCancelarModal.addEventListener("click", cancelarCobro);

entregado.addEventListener("change", calculaDevolucion);

btnCobrarModal.addEventListener("click", enviarFormCobrar);