function eliminar(id, nombre) {
    Swal.fire({
        title: '¿Desea eliminar la empresa de reparto ' + nombre + '?',
        text: "Esta empresa de reparto se eliminará definitivamente",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#178ABC',
        cancelButtonColor: '#B91308',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
    }).then((cliente) => {
        if (cliente.isConfirmed) {
            window.location = '/admin/empresas-reparto/delete/' + id;
        } else {
            window.location = '/admin/empresas-reparto';
        }
    });
}