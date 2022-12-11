function costePedidoNormal(precioTotalCompra, costePedidoNormal) {
    let precioTotal = precioTotalCompra + costePedidoNormal;

    // Lo mostramos en la propia plantilla
    document.getElementById('precioTotalCompra').textContent = 'Importe total: ' + precioTotal.toFixed(2) + ' €';
}

function costePedidoUrgente(precioTotalCompra, costePedidoUrgente) {
    let precioTotal = precioTotalCompra + costePedidoUrgente;

    // Lo mostramos en la propia plantilla
    document.getElementById('precioTotalCompra').textContent = 'Importe total: ' + precioTotal.toFixed(2) + ' €';
}