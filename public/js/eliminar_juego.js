function eliminar(id, nombre) {
    Swal.fire({
        title: '¿Desea eliminar el juego de mesa ' + nombre + '?',
        text: "Este juego se eliminará definitivamente",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#178ABC',
        cancelButtonColor: '#B91308',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
    }).then((cliente) => {
        if (cliente.isConfirmed) {
            window.location = '/admin/catalogo/delete/' + id;
        } else {
            window.location = '/admin/catalogo';
        }
    });
}