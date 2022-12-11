function eliminar(id) {
    Swal.fire({
        title: '¿Desea eliminar esta imágen?',
        text: "La imágen se eliminará definitivamente",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#178ABC',
        cancelButtonColor: '#B91308',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
    }).then((imagen) => {
        if (imagen.isConfirmed) {
            window.location = '/admin/catalogo/deleteImages/' + id;
        } else {
            window.location = '/admin/catalogo/update/' + id;
        }
    });
}