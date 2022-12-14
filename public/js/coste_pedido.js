function costePedidoNormal(precioTotalCompra, costePedidoNormal) {
    let precioCosteNormalTotal = precioTotalCompra + costePedidoNormal;

    // Lo mostramos en la propia plantilla
    document.getElementById('precioTotalCompra').textContent = 'Importe total: ' + precioCosteNormalTotal.toFixed(2) + ' €';
}

function costePedidoUrgente(precioTotalCompra, costePedidoUrgente) {
    let precioCosteUrgenteTotal = precioTotalCompra + costePedidoUrgente;

    // Lo mostramos en la propia plantilla
    document.getElementById('precioTotalCompra').textContent = 'Importe total: ' + precioCosteUrgenteTotal.toFixed(2) + ' €';
}