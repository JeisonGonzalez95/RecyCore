document.addEventListener("DOMContentLoaded", function () {
    // Función para cargar los países en el select de país
    function loadCountries(selectId) {
        fetch('https://restcountries.com/v3.1/all')
            .then(response => response.json())
            .then(data => {
                const countrySelect = document.getElementById(selectId); // El campo select
                const sorted = data.sort((a, b) => a.name.common.localeCompare(b.name.common));

                // Limpiar las opciones previas
                countrySelect.innerHTML = '<option value="">Seleccione Uno...</option>';

                // Agregar las opciones de países
                sorted.forEach(country => {
                    if (country.name && country.cca2) {
                        const option = document.createElement('option');
                        option.value = country.cca2; // Siglas del país como valor
                        option.textContent = country.name.common; // Nombre visible del país
                        countrySelect.appendChild(option);
                    }
                });
            })
            .catch(error => console.error('Error cargando países:', error));
    }

    // Cargar los países en los formularios de registro y edición
    loadCountries('country');  // Campo para el formulario de registro
    loadCountries('country_e'); // Campo para el formulario de edición
});
