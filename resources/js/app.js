require('./bootstrap');
require('./sweetalert');
require('./machine');
require('./validatePsw');
require('./formInventary');

import Swal from 'sweetalert2';

document.addEventListener('DOMContentLoaded', () => {
    // -------------------------------
    // DataTables y reloj
    // -------------------------------
    $('#tablaEmpleados').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        }
    });

    function actualizarHora() {
        const ahora = dayjs().format('HH:mm');
        const horaEl = document.getElementById("hora");
        if (horaEl) horaEl.innerText = ahora;
    }

    // Mostrar hora inmediatamente al cargar
    actualizarHora();

    // Actualizar cada segundo
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

    // Si no hay ruta en localStorage, usar "Inicio" como predeterminada
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



    window.mostrarFormulario = function (btn) {
        const formularioId = btn.getAttribute('data-form');
        const dataTypes = ['menuId', 'itemId', 'prodId', 'userId'];

        // Ocultar todos los formularios
        document.querySelectorAll('.formulario').forEach(f => f.style.display = 'none');

        // Mostrar el formulario correspondiente
        document.getElementById(formularioId).style.display = 'block';

        for (const type of dataTypes) {
            if (btn.dataset[type]) {
                const data = JSON.parse(btn.dataset[type]);

                const fillMap = {
                    menuId: {
                        'menu_id': 'id',
                        'name_menu_e': 'name',
                        'slug_menu_e': 'slug'
                    },
                    itemId: {
                        'item_id': 'id',
                        'name_item_e': 'name',
                        'route_e': 'route',
                        'main_menu_e': 'main'
                    },
                    prodId: {
                        'id_product': 'id',
                        'name_prod_e': 'name',
                        'slug_product_e': 'slug',
                        'price_product_sale_e': 'price_sale',
                        'price_product_purch_e': 'price_purch',
                        'state_product_e': 'state'
                    },
                    userId: {
                        'user_id': 'id',
                        'username_e': 'username'
                    }
                };

                const fields = fillMap[type];
                for (const [fieldName, dataKey] of Object.entries(fields)) {
                    const field = document.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        if (fieldName === 'state_product_e') {
                            field.checked = data[dataKey] == 1;
                        } else {
                            field.value = data[dataKey] ?? '';
                        }
                    }
                }

                break;
            }
        }
    };



    function ajustarSidebarTop() {
        const navbar = document.querySelector('.navbar');
        const sidebar = document.querySelector('.sidebar');

        if (navbar && sidebar) {
            const alturaNavbar = navbar.offsetHeight;
            sidebar.style.top = `${alturaNavbar}px`;
        }
    }

    // Ejecutar al cargar y al redimensionar la ventana
    window.addEventListener('load', ajustarSidebarTop);
    window.addEventListener('resize', ajustarSidebarTop);



    












});
