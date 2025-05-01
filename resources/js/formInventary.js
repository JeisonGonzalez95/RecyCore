document.addEventListener('DOMContentLoaded', function () {

    // Función para actualizar el precio
    function updatePrice(row) {
        const productSelect = row.querySelector('.product-select');
        const amountInput = row.querySelector('input[name="amount[]"]');
        const priceInput = row.querySelector('input[name="price[]"]');

        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const unitPrice = parseFloat(selectedOption.getAttribute('data-price').replace(',', '.')) || 0;

        // Reemplazo interno para cálculo
        const amountRaw = amountInput.value.replace(',', '.');
        const amount = parseFloat(amountRaw) || 0;

        const total = unitPrice * amount;
        priceInput.value = Number.isInteger(total) ? total : total.toFixed(2).replace(/\.?0+$/, '');
    }

    // Función para asociar eventos a cada fila
    function bindEventsToRow(row) {
        const productSelect = row.querySelector('.product-select');
        const amountInput = row.querySelector('input[name="amount[]"]');

        // Convertir punto a coma en el input visible del usuario
        amountInput.addEventListener('input', () => {
            amountInput.value = amountInput.value.replace('.', ',');
            updatePrice(row); // Calcular con coma convertida a punto internamente
        });

        productSelect.addEventListener('change', () => updatePrice(row));
    }

    // Inicializar los que ya están al cargar la página
    document.querySelectorAll('.product-item').forEach(bindEventsToRow);

    // Evento para agregar una nueva fila de productos
    document.getElementById('add-item').addEventListener('click', function (e) {
        e.preventDefault();

        let productRow = document.querySelector('.product-item');
        let newProductRow = productRow.cloneNode(true);

        newProductRow.querySelectorAll('input').forEach(input => input.value = '0');
        newProductRow.querySelector('select[name="product[]"]').selectedIndex = 0;

        let deleteButton = newProductRow.querySelector('#delete_item');
        deleteButton.removeAttribute('disabled');
        deleteButton.addEventListener('click', function (e) {
            e.preventDefault();
            newProductRow.remove(); 
        });

        document.querySelector('.product-container').appendChild(newProductRow);
        bindEventsToRow(newProductRow); // Asocia los eventos a la nueva fila
    });

    // Evento para eliminar un producto
    document.querySelectorAll('#delete_item').forEach(button => {
        if (button.closest('.product-item').isEqualNode(document.querySelector('.product-item'))) {
            button.setAttribute('disabled', 'true');
        } else {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                let rowToDelete = button.closest('.product-item');
                rowToDelete.remove();
            });
        }
    });

});
