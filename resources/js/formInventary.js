document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('add-item').addEventListener('click', function (e) {
        e.preventDefault(); // Evita el comportamiento por defecto del enlace

        // Encuentra la fila original (la primera) que se quiere duplicar
        let productRow = document.querySelector('.product-item');

        // Clona la fila
        let newProductRow = productRow.cloneNode(true);

        // Limpia los campos del nuevo "row" para que estén vacíos
        newProductRow.querySelectorAll('input').forEach(input => input.value = '');

        // Reemplaza el ID de delete_item para evitar conflictos
        let deleteButton = newProductRow.querySelector('#delete_item');

        // Habilitar el botón de eliminar en los ítems agregados
        deleteButton.removeAttribute('disabled');

        // Añadir evento al botón de eliminar
        deleteButton.addEventListener('click', function (e) {
            e.preventDefault();
            newProductRow.remove(); // Elimina la fila correspondiente
        });

        // Agrega la nueva fila al contenedor
        document.querySelector('.product-container').appendChild(newProductRow);
    });

    // Añadir evento para los botones de eliminar en las filas existentes
    document.querySelectorAll('#delete_item').forEach(button => {
        // Verificar si es el primer ítem y deshabilitar el botón de eliminar
        if (button.closest('.product-item').isEqualNode(document.querySelector('.product-item'))) {
            button.setAttribute('disabled', 'true');
        } else {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                let rowToDelete = button.closest('.product-item'); // Encuentra la fila más cercana al botón
                rowToDelete.remove(); // Elimina la fila correspondiente
            });
        }
    });
});
