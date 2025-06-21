<?php $__env->startSection('content'); ?>
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4 mb-6">
        
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow">
            <h5 class="text-sm text-gray-500">Total Pelanggan Aktif</h5>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">123</h3>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow">
            <h5 class="text-sm text-gray-500">Pelanggan Nonaktif</h5>
            <h3 class="text-2xl font-bold text-red-600">12</h3>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow">
            <h5 class="text-sm text-gray-500">Tagihan Bulan Ini</h5>
            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Rp 15.000.000</h3>
        </div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow">
            <h5 class="text-sm text-gray-500">Pembayaran Masuk</h5>
            <h3 class="text-2xl font-bold text-green-600">Rp 13.750.000</h3>
        </div>
    </div>

    
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4 mb-6">
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow">
            <h5 class="text-base font-semibold mb-4">Grafik Jumlah Pelanggan (Dummy)</h5>
            <canvas id="chartPelanggan" height="100"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow">
            <h5 class="text-base font-semibold mb-4">Grafik Pendapatan Bulanan (Dummy)</h5>
            <canvas id="chartPendapatan" height="100"></canvas>
        </div>
    </div>

    
    <div class="bg-white dark:bg-gray-800 rounded-xl p-5 shadow">
        <h5 class="text-base font-semibold mb-4">Tagihan Belum Dibayar</h5>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-4 py-3">Nama Pelanggan</th>
                        <th class="px-4 py-3">Jatuh Tempo</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Budi</td>
                        <td class="px-4 py-3">21 Juni 2025</td>
                        <td class="px-4 py-3">Rp 150.000</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs text-white bg-red-600 rounded">Belum Bayar</span>
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                        <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">Siti</td>
                        <td class="px-4 py-3">22 Juni 2025</td>
                        <td class="px-4 py-3">Rp 220.000</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs text-white bg-red-600 rounded">Belum Bayar</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo app('Illuminate\Foundation\Vite')('resources/js/pages/dashboard.js'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
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
                        fill: false,
                        tension: 0.3
                    }]
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
                        borderRadius: 6
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Dashboard',
    'sub_title' => 'Menu',
    'mode' => $mode ?? '',
    'demo' => $demo ?? ''
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/index.blade.php ENDPATH**/ ?>