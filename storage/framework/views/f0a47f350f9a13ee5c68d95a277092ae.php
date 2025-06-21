<?php $__env->startSection('content'); ?>
<div class="card p-6">
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-white">Daftar Akun VPN</h4>
        <a href="<?php echo e(route('vpn.create')); ?>" class="btn bg-[#ff8000] text-white">
            + Tambah Akun VPN
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success mb-4">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="overflow-x-auto">
        <div class="min-w-full inline-block align-middle">
            <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="py-3 ps-4">
                                <input type="checkbox" class="form-checkbox rounded">
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Router</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">VPN Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Script</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        <?php $__empty_1 = true; $__currentLoopData = $vpnAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vpn): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="py-3 ps-4">
                                <input type="checkbox" class="form-checkbox rounded">
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                <?php echo e($vpn->username); ?>

                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                <?php echo e($vpn->mikrotik->router_name ?? '-'); ?>

                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-200">
                                <?php echo e($vpn->vpn_type); ?>

                            </td>
                            <td class="px-6 py-4 text-sm text-blue-500 cursor-pointer" onclick="copyScript('<?php echo e(addslashes($vpn->script)); ?>')">
                                <i class="mgc_copy_line align-middle mr-1"></i> Salin Script
                            </td>
                            <td class="px-6 py-4 text-sm">
                                <span class="badge <?php echo e($vpn->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                    <?php echo e(ucfirst($vpn->status)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-right flex justify-end gap-3">
                                <a href="<?php echo e(route('vpn.edit', $vpn->id)); ?>" class="text-primary hover:text-sky-700">Edit</a>

                                <form action="<?php echo e(route('vpn.destroy', $vpn->id)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus akun VPN ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-6 text-slate-500">
                                Belum ada akun VPN terdaftar.
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function copyScript(text) {
        navigator.clipboard.writeText(text).then(function () {
            alert('Script berhasil disalin!');
        }, function () {
            alert('Gagal menyalin script.');
        });
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Akun VPN',
    'sub_title' => 'Daftar Akun VPN untuk Router Mikrotik'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/vpn/index.blade.php ENDPATH**/ ?>