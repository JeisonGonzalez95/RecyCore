document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.querySelector('.content-wrapper');
    const resizableContent = document.querySelector('.resizable-content');

    // Recuperar el estado del sidebar del localStorage
    const sidebarState = localStorage.getItem('sidebarState');

    // Si está cerrado (oculto), aplica la clase 'hidden' sin animación
    if (sidebarState === 'hidden') {
        sidebar.classList.add('hidden');
        contentWrapper.style.marginLeft = '0'; // Elimina el margen cuando el sidebar está cerrado
        contentWrapper.style.width = 'calc(100% + 250px)'; // Expande el contenido para ocupar más espacio (ajustable)
        if (resizableContent) resizableContent.style.width = 'calc(100% + 250px)'; // Ajustar si es necesario

        // Desactivar la animación al cargar
        sidebar.style.transition = 'none';
    }

    // Cuando se haga clic en el toggle del sidebar
    menuToggle?.addEventListener('click', () => {
        // Volver a habilitar la transición para animar
        sidebar.style.transition = 'transform 0.3s ease-in-out';

        const isHidden = sidebar.classList.toggle('hidden');
        const width = isHidden ? 'calc(100% + 250px)' : 'calc(100% - 25px)'; // Ajusta el tamaño cuando el sidebar está abierto o cerrado

        // Cuando el sidebar está oculto, expande el contentWrapper
        if (isHidden) {
            contentWrapper.style.marginLeft = '0';  // El contenido ocupa todo el ancho disponible
            contentWrapper.style.width = 'calc(100% + 250px)';    // Expande el contenido cuando el sidebar está cerrado
        } else {
            contentWrapper.style.marginLeft = '15vh'; // Cuando el sidebar está abierto, agrega el margen
            contentWrapper.style.width = width;  // Ajusta el tamaño según el ancho del sidebar
        }

        if (resizableContent) resizableContent.style.width = contentWrapper.style.width;

        // Guardar el estado del sidebar en localStorage
        localStorage.setItem('sidebarState', isHidden ? 'hidden' : 'visible');
    });
});
