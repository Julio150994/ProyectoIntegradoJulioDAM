function eliminar(id, username, role_id) {
    if (role_id == 2) { // mensaje de confirmación para el contable
        Swal.fire({
            title: '¿Desea eliminar al contable ' + username + '?',
            text: "Este contable se eliminará definitivamente",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#178ABC',
            cancelButtonColor: '#B91308',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
        }).then((cliente) => {
            if (cliente.isConfirmed) {
                window.location = '/admin/empleados/delete/' + id;
            } else {
                window.location = '/admin/empleados';
            }
        });
    } else if (role_id == 3) { //mensaje de confirmación para el mozo de almacén
        Swal.fire({
            title: '¿Desea eliminar al mozo ' + username + '?',
            text: "Este mozo se eliminará definitivamente",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#178ABC',
            cancelButtonColor: '#B91308',
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
        }).then((cliente) => {
            if (cliente.isConfirmed) {
                window.location = '/admin/empleados/delete/' + id;
            } else {
                window.location = '/admin/empleados';
            }
        });
    }
}