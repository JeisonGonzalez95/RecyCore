document.addEventListener('DOMContentLoaded', function () {

    function isVisible(el) {
        return el && el.offsetParent !== null;
    }

    function updatePrice(row) {
        const productSelect = row.querySelector('.product-select');
        const amountInput = row.querySelector('input[name="amount[]"]');
        const amountDevInput = row.querySelector('input[name="amountDev[]"]');
        const priceInput = row.querySelector('.price-hidden');
        const priceViewInput = row.querySelector('.price-visible');

        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const unitPrice = parseFloat(selectedOption.getAttribute('data-price')?.replace(',', '.') || '0');

        const amount = parseFloat((amountInput.value || '0').replace(',', '.')) || 0;
        let amountDev = 0;

        if (amountDevInput && isVisible(amountDevInput)) {
            amountDev = parseFloat((amountDevInput.value || '0').replace(',', '.')) || 0;
        }

        const netAmount = Math.max(0, amount - amountDev);
        const total = unitPrice * netAmount;

        priceInput.value = total;

        if (priceViewInput) {
            const formatted = total.toLocaleString('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            });
            priceViewInput.value = formatted;
        }

        updateTotalPrice();
    }

    function updateTotalPrice() {
        let total = 0;
        document.querySelectorAll('.price-hidden').forEach(input => {
            const value = parseFloat(input.value?.replace(',', '.') || '0');
            total += value;
        });

        const totalDisplay = document.getElementById('total-price');
        if (totalDisplay) {
            totalDisplay.textContent = 'Total: ' + total.toLocaleString('es-CO', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }
    }

    function bindEventsToRow(row) {
        const productSelect = row.querySelector('.product-select');
        const amountInput = row.querySelector('input[name="amount[]"]');
        const amountDevInput = row.querySelector('input[name="amountDev[]"]');

        amountInput.addEventListener('input', () => {
            amountInput.value = amountInput.value.replace('.', ',');
            updatePrice(row);
        });

        if (amountDevInput) {
            amountDevInput.addEventListener('input', () => {
                amountDevInput.value = amountDevInput.value.replace('.', ',');
                updatePrice(row);
            });
        }

        productSelect.addEventListener('change', () => updatePrice(row));
    }

    document.querySelectorAll('.product-item').forEach(bindEventsToRow);

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
            updateTotalPrice();
        });

        document.querySelector('.product-container').appendChild(newProductRow);
        bindEventsToRow(newProductRow);
        updateTotalPrice();
    });

    document.querySelectorAll('#delete_item').forEach(button => {
        if (button.closest('.product-item').isEqualNode(document.querySelector('.product-item'))) {
            button.setAttribute('disabled', 'true');
        } else {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                let rowToDelete = button.closest('.product-item');
                rowToDelete.remove();
                updateTotalPrice();
            });
        }
    });

    updateTotalPrice();
});
