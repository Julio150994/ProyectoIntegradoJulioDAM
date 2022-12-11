/** Eventos para la compra de juegos en JS */

let contador = 1;

function sumarCantidad(precio) {
    if (contador >= 1) {
        document.getElementById('cantidad').value = ++contador;
        precio *= contador;

        document.getElementById('precioUnitario').textContent = precio.toFixed(2) + ' €'; // mostramos este resultado en texto con etiqueta <h3>
    } else {
        contador = 1;
    }
}

function restarCantidad(precio) {
    if (contador == 1) {
        contador = 1;
    } else {
        document.getElementById('cantidad').value = --contador; // restamos el contador

        let precioUnitario = precio * contador; // multiplicamos de manera que simulamos una resta del precio
        document.getElementById('precioUnitario').textContent = precioUnitario.toFixed(2) + ' €';
    }
}