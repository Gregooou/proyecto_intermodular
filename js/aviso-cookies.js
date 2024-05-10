document.addEventListener('DOMContentLoaded', function() {
    const botonAceptarCookies = document.getElementById('btn-aceptar-cookies');
    const avisoCookies = document.getElementById('aviso-cookies');
    const fondoAvisoCookies = document.getElementById('fondo-aviso-cookies');

    // Verificar si el aviso ya ha sido mostrado antes
    if (!localStorage.getItem('cookies-aceptadas')) {
        avisoCookies.classList.add('activo');
        fondoAvisoCookies.classList.add('activo');
    }

    botonAceptarCookies.addEventListener('click', function() {
        avisoCookies.classList.remove('activo');
        fondoAvisoCookies.classList.remove('activo');

        // Marcar que el aviso ha sido aceptado en el almacenamiento local
        localStorage.setItem('cookies-aceptadas', true);
    });
});
