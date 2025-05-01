document.addEventListener("DOMContentLoaded", function () {
    window.mostrarFormulario = function (btn) {
        const formularioId = btn.getAttribute('data-form');
        const dataTypes = ['menuId', 'itemId', 'prodId', 'userId', 'clientId', 'collectorId'];

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
                    },
                    clientId: {
                        'id_client': 'id',
                        'name_client_e': 'name',
                        'nit_client_e': 'nit',
                        'phn_client_e': 'phone',
                        'email_client_e': 'email',
                        'address_e': 'address',
                        'state_client_e': 'state'
                    },
                    collectorId: {
                        'id_coll': 'id',
                        'name_coll_e': 'name',
                        'type_doc_e': 'type_dni',
                        'dni_coll_e': 'dni',
                        'country_e': 'country',
                        'phn_coll_e': 'phone',
                        'email_coll_e': 'email',
                        'address_e': 'address',
                        'state_coll_e': 'state'
                    }
                };

                const fields = fillMap[type];
                for (const [fieldName, dataKey] of Object.entries(fields)) {
                    const field = document.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        if (fieldName === 'state_product_e' || fieldName === 'state_client_e' || fieldName === 'state_coll_e') {
                            field.checked = data[dataKey] == 1;
                        } else {
                            field.value = data[dataKey] ?? '';
                        }
                    }
                }

                // Seleccionar el país en el campo 'country_e' (edición)
                const countrySelectEdit = document.getElementById('country_e'); // Campo de país en edición
                if (countrySelectEdit) {
                    const countryCode = data.country; // Obtener el código del país asignado (ejemplo: 'CO')
                    const option = countrySelectEdit.querySelector(`option[value="${countryCode}"]`);
                    if (option) {
                        option.selected = true; // Selecciona el país correspondiente
                    }
                }

                break;
            }
        }
    };
});
