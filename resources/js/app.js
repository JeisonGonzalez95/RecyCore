const isRoute = path => window.location.pathname.includes(path);

require('./bootstrap');
require('./sweetalert');
require('./editForms');

if (isRoute('/inventaryIf') || isRoute('/inventaryOf')) require('./formInventary');
if (isRoute('/index')) require('./dashboard');
if (isRoute('/collectorList')) require('./countrys');
if (isRoute('/registerEc') || isRoute('/employees')) require('./validatePsw');


document.addEventListener('DOMContentLoaded', () => {
    // -------------------------------
    // DataTables y reloj
    // -------------------------------
    $('#tablaEmpleados').DataTable({
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        }
    });

    function actualizarHora() {
        const ahora = dayjs().format('HH:mm');
        const horaEl = document.getElementById("hora");
        if (horaEl) horaEl.innerText = ahora;
    }

    actualizarHora();
    setInterval(actualizarHora, 60000);

    // -------------------------------
    // Sidebar Toggle
    // -------------------------------
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.querySelector('.content-wrapper');
    const resizableContent = document.querySelector('.resizable-content');

    menuToggle?.addEventListener('click', () => {
        const isHidden = sidebar.classList.toggle('hidden');
        const width = isHidden ? '100%' : 'calc(100% - 25px)';
        contentWrapper.style.marginLeft = isHidden ? '0' : '100px';
        contentWrapper.style.width = width;
        if (resizableContent) resizableContent.style.width = width;
    });


    // -------------------------------
    // Menús superiores y sidebar
    // -------------------------------
    const menuData = document.getElementById('menu-data');
    const menuSlugs = menuData ? JSON.parse(menuData.dataset.slugs.replace(/&quot;/g, '"')) : [];
    window.menuSlugs = menuSlugs;

    const restoreTopMenu = () => {
        const active = localStorage.getItem('menuActivo') || menuSlugs[0] || 'adm';

        document.querySelectorAll('.menu-superior a').forEach(link => {
            link.classList.toggle('active', link.dataset.target === active);
        });

        menuSlugs.forEach(id => {
            const el = document.getElementById(id);
            if (el) el.style.display = (id === active) ? 'block' : 'none';
        });
    };

    document.querySelectorAll('.menu-superior a').forEach(link => {
        link.addEventListener('click', e => {
            e.preventDefault();
            const target = link.dataset.target;
            localStorage.setItem('menuActivo', target);
            restoreTopMenu();
        });
    });

    restoreTopMenu();
    document.body.classList.add('no-animate');
    setTimeout(() => document.body.classList.remove('no-animate'), 100);

    // -------------------------------
    // Sidebar activo (Inicio y otros items)
    // -------------------------------
    const sidebarLinks = document.querySelectorAll('.sidebar .menu-item');
    const rutaGuardada = localStorage.getItem('sidebarActivo');

    let rutaActual = rutaGuardada;

    if (!rutaActual) {
        const linkInicio = Array.from(sidebarLinks).find(link =>
            link.href === location.origin + '/' || link.href === location.origin + '/index'
        );
        if (linkInicio) {
            linkInicio.classList.add('active');
            localStorage.setItem('sidebarActivo', linkInicio.href);
            rutaActual = linkInicio.href;
        }
    }

    // Activar el link correspondiente
    sidebarLinks.forEach(link => {
        link.classList.remove('active');
        if (link.href === rutaActual) {
            link.classList.add('active');
        }

        // Escuchar clics y guardar la nueva ruta seleccionada
        link.addEventListener('click', function () {
            sidebarLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            localStorage.setItem('sidebarActivo', this.href);
        });
    });



    function ajustarSidebarTop() {
        const navbar = document.querySelector('.navbar');
        const sidebar = document.querySelector('.sidebar');

        if (navbar && sidebar) {
            const alturaNavbar = navbar.offsetHeight;
            sidebar.style.top = `${alturaNavbar}px`;
        }
    }

    window.addEventListener('load', ajustarSidebarTop);
    window.addEventListener('resize', ajustarSidebarTop);



    document.querySelectorAll('.numeric-comma').forEach(input => {
        input.addEventListener('input', function () {
            this.value = this.value
                .replace(/[^\d.,]/g, '')
                .replace(/\./g, ',');
        });

        input.addEventListener('blur', function () {
            const valor = this.value.replace(',', '.');
            if (!isNaN(valor)) {
                this.dataset.realValue = parseFloat(valor);
            }
        });
    });

});
