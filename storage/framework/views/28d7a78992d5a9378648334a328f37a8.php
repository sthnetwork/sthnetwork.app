<?php $__env->startPush('styles'); ?>
<link href="<?php echo e(asset('libs/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="space-y-6 px-2 md:px-0">

    
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex gap-2">
            <i class="mgc_router_line text-[#ff8000] text-2xl mt-1.5"></i>
            <div>
                <h2 class="text-3xl font-bold text-slate-800 dark:text-white">Router Mikrotik</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Kelola router Mikrotik per area (cluster) yang terhubung ke sistem.
                </p>
            </div>
        </div>

        <a href="<?php echo e(route('mikrotik.create')); ?>"
           class="btn bg-[#ff8000] hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm hover:shadow transition">
            <i class="mgc_add_line mr-1"></i> Tambah Router
        </a>
    </div>

    
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700 uppercase text-[11px] font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-center min-w-[120px]">Aksi</th>
                        <th class="px-6 py-3">Nama Router</th>
                        <th class="px-6 py-3">IP Address:Port</th>
                        <th class="px-6 py-3">Cluster</th>
                        <th class="px-6 py-3 text-center">Koneksi API</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    <?php $__empty_1 = true; $__currentLoopData = $routers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $router): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                        <td class="px-6 py-4 text-center">
                            <div x-data="{
                                open: false,
                                top: 0,
                                left: 0,
                                toggle($el) {
                                    this.open = !this.open
                                    if (this.open) {
                                        const rect = $el.getBoundingClientRect()
                                        this.left = rect.left
                                        this.top = rect.bottom + 6
                                    }
                                }
                            }" @click.outside="open = false" class="relative">
                                <button @click="toggle($el)"
                                    title="Buka menu aksi"
                                    aria-haspopup="true"
                                    aria-expanded="false"
                                    class="bg-[#ff8000] text-white px-3 py-2 rounded-md text-xs font-medium flex items-center gap-1">
                                    Aksi <i class="mgc_down_line text-base transition-transform" :class="{ 'rotate-180': open }"></i>
                                </button>

                                <template x-if="open">
                                    <div
                                        class="fixed z-[9999] w-44 bg-white border border-gray-200 rounded-md shadow-lg dark:bg-gray-900 dark:border-gray-700"
                                        :style="`top: ${top}px; left: ${left}px`"
                                        x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                    >
                                        <button type="button"
                                            title="Tes koneksi router"
                                            class="flex items-center gap-2 w-full px-4 py-2 text-xs text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700 js-test-conn-btn"
                                            data-url="<?php echo e(route('mikrotik.test', $router->id)); ?>">
                                            <i class="mgc_transfer_line text-base"></i> Tes Koneksi
                                        </button>
                                        <a href="<?php echo e(route('mikrotik.edit', $router->id)); ?>"
                                           title="Edit router"
                                           class="flex items-center gap-2 w-full px-4 py-2 text-xs text-gray-800 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                            <i class="mgc_edit_line text-base"></i> Edit
                                        </a>
                                        <button type="button"
                                            title="Hapus router"
                                            class="flex items-center gap-2 w-full px-4 py-2 text-xs text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-gray-700 js-delete-btn"
                                            data-form-id="delete-form-<?php echo e($router->id); ?>">
                                            <i class="mgc_delete_line text-base"></i> Hapus
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <form id="delete-form-<?php echo e($router->id); ?>" method="POST" action="<?php echo e(route('mikrotik.destroy', $router->id)); ?>" class="hidden">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            </form>
                        </td>
                        <td class="px-6 py-4 font-medium"><?php echo e($router->router_name); ?></td>
                        <td class="px-6 py-4"><?php echo e($router->ip_address); ?>:<?php echo e($router->port_api); ?></td>
                        <td class="px-6 py-4"><?php echo e($router->cluster ?? '-'); ?></td>
                        <td class="px-6 py-4 text-center min-w-[120px]">
                            <?php if($router->status_koneksi): ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400">
                                    <i class="mgc_wifi_line text-sm"></i> Terhubung
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400">
                                    <i class="mgc_nowifi_line text-sm"></i> Gagal
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-10 text-slate-500">
                            <div class="flex flex-col items-center">
                                <i class="mgc_server_line text-4xl mb-3 text-slate-400"></i>
                                <p class="text-lg font-semibold">Belum ada router</p>
                                <p class="text-sm">Klik tombol "Tambah Router" untuk menambahkan router baru.</p>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('libs/sweetalert2/sweetalert2.min.js')); ?>"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.js-test-conn-btn').forEach(function (button) {
        button.addEventListener('click', function () {
            const url = this.dataset.url;
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: data.status ? 'success' : 'error',
                        title: data.message,
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true,
                    });
                })
                .catch(() => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'error',
                        title: 'Gagal menghubungi router.',
                        showConfirmButton: false,
                        timer: 2500,
                        timerProgressBar: true,
                    });
                });
        });
    });
});
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Router Mikrotik',
    'sub_title' => 'Kelola router Mikrotik antar cluster.'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/mikrotik/index.blade.php ENDPATH**/ ?>