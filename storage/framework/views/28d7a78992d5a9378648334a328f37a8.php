<?php $__env->startSection('content'); ?>
<div class="space-y-6">

    
    <div class="mb-2">
        <h2 class="flex items-center gap-2 text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">
            <i class="mgc_router_line text-[#ff8000] text-2xl"></i>
            Router Mikrotik
        </h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
            Kelola router Mikrotik per area (cluster) yang terhubung ke sistem billing STHNetwork.
        </p>
    </div>

    
    <div class="flex justify-end">
        <a href="<?php echo e(route('mikrotik.create')); ?>"
           class="btn bg-[#ff8000] hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all">
            <i class="mgc_add_line mr-1"></i> Tambah Router
        </a>
    </div>

    
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md p-6">
        <div class="overflow-x-auto rounded-xl">
            <table class="table w-full text-sm whitespace-nowrap border-separate border-spacing-y-2">
                <thead class="uppercase text-xs tracking-wide text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="font-semibold px-4 py-3 text-left rounded-l-xl">Nama</th>
                        <th class="font-semibold px-4 py-3 text-left">IP Address</th>
                        <th class="font-semibold px-4 py-3 text-left">Cluster</th>
                        <th class="font-semibold px-4 py-3 text-left">Tipe</th>
                        <th class="font-semibold px-4 py-3 text-left">Status</th>
                        <th class="font-semibold px-4 py-3 text-center rounded-r-xl">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $routers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $router): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="bg-white dark:bg-slate-900 hover:bg-orange-50 dark:hover:bg-slate-700 transition-all">
                            <td class="px-4 py-2 font-medium text-slate-800 dark:text-white">
                                <?php echo e($router->router_name); ?>

                            </td>
                            <td class="px-4 py-2 text-slate-600 dark:text-slate-300">
                                <?php echo e($router->ip_address); ?>:<?php echo e($router->port_api); ?>

                            </td>
                            <td class="px-4 py-2"><?php echo e($router->cluster ?? '-'); ?></td>
                            <td class="px-4 py-2">
                                <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-slate-600 dark:text-white">
                                    <i class="mgc_network_line text-sm"></i>
                                    <?php echo e(strtoupper($router->site_type)); ?>

                                </span>
                            </td>
                            <td class="px-4 py-2">
                                <?php if($router->status === 'active'): ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        <i class="mgc_check_line text-sm"></i> Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700">
                                        <i class="mgc_close_line text-sm"></i> Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <a href="<?php echo e(route('mikrotik.edit', $router->id)); ?>"
                                   class="btn btn-sm btn-outline-primary hover:scale-105 transition-all">
                                    <i class="mgc_edit_line"></i>
                                    <span class="ml-1 hidden md:inline">Edit</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center text-slate-500 py-6">
                                Belum ada router ditambahkan.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Router Mikrotik',
    'sub_title' => 'Daftar Router Multi-Site ISP'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/mikrotik/index.blade.php ENDPATH**/ ?>