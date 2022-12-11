function eliminar(id, username) {
    Swal.fire({
        title: '¿Desea eliminar al cliente ' + username + '?',
        text: "Este cliente se eliminará definitivamente",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#178ABC',
        cancelButtonColor: '#B91308',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
    }).then((cliente) => {
        if (cliente.isConfirmed) {
            window.location = '/admin/clientes/delete/' + id;
        } else {
            window.location = '/admin/clientes';
        }
    });
}