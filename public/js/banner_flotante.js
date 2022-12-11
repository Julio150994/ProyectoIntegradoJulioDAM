/** JavaScript para cerrar nuestro banner en el menú principal de la tienda */

function exitBanner() {
    const banner = document.getElementById('banner').style.display = 'block';

    if (banner == 'block') {
        document.getElementById('banner').style.display = 'none';
    } else {
        document.getElementById('banner').style.display = 'block';
    }
}