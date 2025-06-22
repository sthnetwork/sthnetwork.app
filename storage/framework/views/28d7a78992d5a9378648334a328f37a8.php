<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="flex items-center gap-2 text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">
                <i class="mgc_router_line text-[#ff8000] text-2xl"></i>
                Router Mikrotik
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Kelola router Mikrotik per area (cluster) yang terhubung ke sistem.
            </p>
        </div>
        <a href="<?php echo e(route('mikrotik.create')); ?>"
           class="btn bg-[#ff8000] hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all">
            <i class="mgc_add_line mr-1"></i> Tambah Router
        </a>
    </div>

    
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="table w-full text-sm whitespace-nowrap border-separate border-spacing-y-2">
                <thead class="uppercase text-xs tracking-wide text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="font-semibold px-4 py-3 text-left">Nama Router</th>
                        <th class="font-semibold px-4 py-3 text-left">IP Address:Port</th>
                        <th class="font-semibold px-4 py-3 text-left">Cluster</th>
                        <th class="font-semibold px-4 py-3 text-left">Status DB</th>
                        <th class="font-semibold px-4 py-3 text-left">Koneksi API</th>
                        <th class="font-semibold px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $routers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $router): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="bg-white dark:bg-slate-900 hover:bg-orange-50 dark:hover:bg-slate-700 transition-all">
                            <td class="px-4 py-2 font-medium text-slate-800 dark:text-white rounded-l-lg">
                                <?php echo e($router->router_name); ?>

                            </td>
                            <td class="px-4 py-2 text-slate-600 dark:text-slate-300 font-mono">
                                <?php echo e($router->ip_address); ?>:<?php echo e($router->port_api); ?>

                            </td>
                            <td class="px-4 py-2"><?php echo e($router->cluster ?? '-'); ?></td>
                            <td class="px-4 py-2">
                                <?php if($router->status === 'active'): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400">
                                        <i class="mgc_check_circle_line text-sm"></i> Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400">
                                        <i class="mgc_close_circle_line text-sm"></i> Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2">
                                <?php if($router->status_koneksi): ?>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-500/20 dark:text-sky-400">
                                        <i class="mgc_wifi_line text-sm"></i> Terhubung
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400">
                                        <i class="mgc_nowifi_line text-sm"></i> Gagal
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2 text-center rounded-r-lg">
                                <div class="flex justify-center gap-2">
                                    <a href="<?php echo e(route('mikrotik.edit', $router->id)); ?>" class="btn btn-sm bg-primary/20 text-primary hover:bg-primary hover:text-white">
                                        <i class="mgc_edit_line"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm bg-danger/20 text-danger hover:bg-danger hover:text-white"
                                        onclick="confirmDelete('delete-form-<?php echo e($router->id); ?>')">
                                        <i class="mgc_delete_line"></i>
                                    </button>
                                    <form id="delete-form-<?php echo e($router->id); ?>" action="<?php echo e(route('mikrotik.destroy', $router->id)); ?>" method="POST" class="hidden">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-slate-500 py-8">
                                <div class="flex flex-col items-center">
                                    <i class="mgc_server_line text-4xl text-slate-400 mb-2"></i>
                                    <h4 class="text-lg font-medium">Belum ada data router.</h4>
                                    <p class="text-sm">Silakan tambahkan router baru untuk memulai.</p>
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
<script src="/libs/sweetalert2/sweetalert2.min.js"></script>

<script>
function confirmDelete(formId) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data router ini akan dihapus secara permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ff8000',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(formId).submit();
        }
    });
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<link href="/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Router Mikrotik',
    'sub_title' => 'Daftar Router Multi-Site ISP'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/mikrotik/index.blade.php ENDPATH**/ ?>