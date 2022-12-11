/**--------- Código JS para eliminar juegos del carrito -------------- */

function eliminar(id, nombreJuego) {
    Swal.fire({
        title: '¿Desea eliminar juego ' + nombreJuego + ' de su carrito?',
        text: "Este juego se eliminará del carrito si solamente tiene uno",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#178ABC',
        cancelButtonColor: '#B91308',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
    }).then((cliente) => {
        if (cliente.isConfirmed) {
            window.location = '/juegos/carrito/delete/' + id;
        } else {
            window.location = '/juegos/carrito';
        }
    });
}

/**-------- Código JS para eliminar juegos del carrito---------------- */

function limpiar() {
    Swal.fire({
        title: '¿Desea limpiar todo el carrito?',
        text: "Se va a eliminar todo de su carrito definitivamente",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#178ABC',
        cancelButtonColor: '#B91308',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
    }).then((cliente) => {
        if (cliente.isConfirmed) {
            window.location = '/juegos/carrito/cleaned';
        } else {
            window.location = '/juegos/carrito';
        }
    });
}