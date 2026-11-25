// 1. Agrega una entrada inicial al historial al cargar la página
window.addEventListener('load', function() {
    window.history.pushState({ bloqueado: true }, "", window.location.href);
});

// 2. Si el usuario presiona "Atrás", recarga la misma página reemplazando el historial
window.addEventListener('popstate', function(event) {
    window.location.replace(window.location.href);
});

// 3. Evita que el navegador cargue una copia congelada desde su memoria caché
window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        window.location.replace(window.location.href);
    }
});

// 4. Función para avanzar a otra página sin dejar rastro de la anterior
function avanzarPagina(urlDestino) {
    window.location.replace(urlDestino);
}

