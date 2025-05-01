document.addEventListener('DOMContentLoaded', function () {
    const chartData = document.getElementById('chart-data');
    const labels = JSON.parse(chartData.dataset.labels);
    const quantities = JSON.parse(chartData.dataset.quantities);
    const costs = JSON.parse(chartData.dataset.costs);

    // 1. Gráfico de Pastel (Pie)
    new Chart(document.getElementById('chartPie'), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                label: 'Kilos totales',
                data: quantities,
                backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF']
            }]
        }
    });

    // 2. Gráfico de Línea (Line)
    new Chart(document.getElementById('chartLine'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Costo total',
                data: costs,
                borderColor: '#36A2EB',
                backgroundColor: 'rgba(54,162,235,0.2)',
                fill: true,
                tension: 0.4
            }]
        }
    });

    // 3. Gráfico de Barras Verticales (Bar)
    new Chart(document.getElementById('chartBar'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Kilos totales',
                data: quantities,
                backgroundColor: '#FF6384'
            }]
        }
    });

    // 4. Gráfico de Barras Horizontales
    new Chart(document.getElementById('chartBarHorizontal'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Costo total',
                data: costs,
                backgroundColor: '#4BC0C0'
            }]
        },
        options: {
            indexAxis: 'y', // 👉 Esto cambia de vertical a horizontal
        }
    });
});
