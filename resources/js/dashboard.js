document.addEventListener('DOMContentLoaded', function () {
    const dataDiv = document.getElementById('chart-data');
    const chartCanvas = document.getElementById('movimentChart');

    if (!dataDiv || !chartCanvas) return;

    // Leer los atributos y convertirlos desde JSON
    const labels = JSON.parse(dataDiv.dataset.labels);
    const quantities = JSON.parse(dataDiv.dataset.quantities);
    const costs = JSON.parse(dataDiv.dataset.costs);

    const ctx = chartCanvas.getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Cantidad Ingresada (Kg)',
                    data: quantities,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    fill: true
                },
                {
                    label: 'Costo Total ($)',
                    data: costs,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
});
