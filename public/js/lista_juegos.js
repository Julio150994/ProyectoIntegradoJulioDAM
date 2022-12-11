function mostrarJuegos() {
    setTimeout(function() {
        document.getElementById('juegos').style.display = 'block'; // mostramos los demás juegos
        document.getElementById('btnJuegos').style.display = 'none'; // ocultamos botón "mostrar más"
    }, 1300); // carga de 1,3 segundos = 1300 milisegundos
}


function ocultarJuegos() {
    setTimeout(function() {
        document.getElementById('juegos').style.display = 'none'; // ocultamos los demás juegos y el botón "mostrar menos"
        document.getElementById('btnJuegos').style.display = 'block'; // mostramos de nuevo botón "mostrar más"
    }, 1300);
}