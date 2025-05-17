document.addEventListener("DOMContentLoaded", function () {
    // Inicializar Choices solo si existen los campos
    const menusField = document.getElementById('menus_e');
    const itemsField = document.getElementById('items_e');

    if (menusField) {
        window.choicesMenus = new Choices(menusField, { removeItemButton: true });
    }
    if (itemsField) {
        window.choicesItems = new Choices(itemsField, { removeItemButton: true });
    }

    window.mostrarFormulario = function (btn) {
        const formularioId = btn.getAttribute('data-form');
        const dataTypes = ['menuId', 'itemId', 'prodId', 'userId', 'clientId', 'collectorId', 'providerId', 'licenceId'];

        // Ocultar todos los formularios
        document.querySelectorAll('.formulario').forEach(f => f.style.display = 'none');

        // Mostrar el formulario correspondiente
        const formulario = document.getElementById(formularioId);
        if (formulario) {
            formulario.style.display = 'block';
        }

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
                        'price_product_purch_c_e': 'price_purch_c',
                        'price_product_purch_f_e': 'price_purch_f',
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
                    },
                    providerId: {
                        'id_provider': 'id',
                        'name_provider_e': 'name',
                        'nit_provider_e': 'nit',
                        'phn_provider_e': 'phone',
                        'email_provider_e': 'email',
                        'address_e': 'address',
                        'state_provider_e': 'state'
                    },
                    licenceId: {
                        'id_licence': 'id',
                        'employee_e': 'user',
                        'menus_e[]': 'menus',
                        'items_e[]': 'items'
                    },
                };

                const fields = fillMap[type];
                for (const [fieldName, dataKey] of Object.entries(fields)) {
                    const value = data[dataKey] ?? '';

                    if (fieldName === 'menus_e[]' && window.choicesMenus) {
                        const menuIds = value.split(',').map(id => id.trim());
                        choicesMenus.removeActiveItems();
                        choicesMenus.setChoiceByValue(menuIds);
                    } else if (fieldName === 'items_e[]' && window.choicesItems) {
                        const itemIds = value.split(',').map(id => id.trim());
                        choicesItems.removeActiveItems();
                        choicesItems.setChoiceByValue(itemIds);
                    } else {
                        const field = document.querySelector(`[name="${fieldName}"]`);
                        if (field) {
                            if (field.type === 'checkbox') {
                                field.checked = value == 1;
                            } else {
                                field.value = value;
                            }
                        }
                    }
                }

                // Seleccionar país si existe
                const countrySelectEdit = document.getElementById('country_e');
                if (countrySelectEdit && data.country) {
                    const option = countrySelectEdit.querySelector(`option[value="${data.country}"]`);
                    if (option) {
                        option.selected = true;
                    }
                }

                break;
            }
        }
    };
});
