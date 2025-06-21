const ctx1 = document.getElementById('chartPelanggan')?.getContext('2d');
if (ctx1 && typeof Chart !== 'undefined') {
    new Chart(ctx1, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Pelanggan',
                data: [80, 90, 100, 110, 115, 123],
                borderColor: '#ff8000',
                borderWidth: 2,
                fill: false
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
}

const ctx2 = document.getElementById('chartPendapatan')?.getContext('2d');
if (ctx2 && typeof Chart !== 'undefined') {
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'],
            datasets: [{
                label: 'Pendapatan',
                data: [8000000, 9500000, 11000000, 12000000, 13500000, 15000000],
                backgroundColor: '#ff8000',
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            }
        }
    });
}

