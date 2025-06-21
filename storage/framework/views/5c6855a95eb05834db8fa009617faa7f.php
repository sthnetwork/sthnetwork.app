<?php $__env->startSection('content'); ?>
<div class="card mt-8">
    <div class="card-body px-6 pt-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h4 class="text-xl font-semibold text-gray-800">Kelola Data Pelanggan</h4>
                <p class="text-sm text-gray-500">Daftar pelanggan aktif dan detail informasinya</p>
            </div>
            <a href="<?php echo e(route('customers.create')); ?>" class="btn bg-[#ff8000] text-white mt-4 md:mt-0">
                + Tambah Pelanggan
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="alert alert-success mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-gray-600">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Username</th>
                        <th class="px-4 py-3">Password</th>
                        <th class="px-4 py-3">Paket</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Cluster</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">PPN</th>
                        <th class="px-4 py-3">Prorata</th>
                        <th class="px-4 py-3">Daftar</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-2"><?php echo e($index + 1); ?></td>
                            <td class="px-4 py-2"><?php echo e($c->name); ?></td>
                            <td class="px-4 py-2 font-mono text-xs"><?php echo e($c->username_pppoe); ?></td>
                            <td class="px-4 py-2 font-mono text-xs"><?php echo e($c->password_pppoe); ?></td>
                            <td class="px-4 py-2"><?php echo e($c->paket); ?></td>
                            <td class="px-4 py-2">Rp<?php echo e(number_format($c->harga_paket ?? 150000)); ?></td>
                            <td class="px-4 py-2"><?php echo e($c->cluster ?? 'Payabakung'); ?></td>
                            <td class="px-4 py-2">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($c->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                    <?php echo e(ucfirst($c->status)); ?>

                                </span>
                            </td>
                            <td class="px-4 py-2"><?php echo e($c->ppn ? 'Ya' : 'Tidak'); ?></td>
                            <td class="px-4 py-2"><?php echo e($c->prorata ?? '-'); ?></td>
                            <td class="px-4 py-2"><?php echo e($c->created_at->format('d M Y')); ?></td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?php echo e(route('customers.edit', $c->id)); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="<?php echo e(route('customers.destroy', $c->id)); ?>" method="POST" onsubmit="return confirm('Yakin hapus pelanggan ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="12" class="px-4 py-4 text-center text-gray-400">Belum ada pelanggan</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Pelanggan',
    'sub_title' => 'Daftar Pelanggan ISP'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/customers/index.blade.php ENDPATH**/ ?>