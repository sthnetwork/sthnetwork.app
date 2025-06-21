<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto mt-10">
    <div class="card p-6">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-white mb-1">Edit Router Mikrotik</h4>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
            Ubah informasi router Mikrotik sesuai data yang valid di jaringan ISP kamu.
        </p>

        <form action="<?php echo e(route('mikrotik.update', $mikrotik->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Nama Router *</label>
                    <input type="text" name="router_name" class="form-input"
                        value="<?php echo e(old('router_name', $mikrotik->router_name)); ?>" required>
                </div>

                <div>
                    <label class="form-label">Port API *</label>
                    <input type="number" name="port_api" class="form-input"
                        value="<?php echo e(old('port_api', $mikrotik->port_api)); ?>" required>
                </div>
            </div>

            
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">IP Address *</label>
                    <input type="text" name="ip_address" class="form-input"
                        value="<?php echo e(old('ip_address', $mikrotik->ip_address)); ?>" required>
                </div>

                <div>
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-input"
                        placeholder="(Kosongkan jika tidak ingin diubah)">
                </div>
            </div>

            
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-input"
                        value="<?php echo e(old('username', $mikrotik->username)); ?>" required>
                </div>

                <div>
                    <label class="form-label">Cluster / Area</label>
                    <input type="text" name="cluster" class="form-input"
                        value="<?php echo e(old('cluster', $mikrotik->cluster)); ?>">
                </div>
            </div>

            
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="active" <?php echo e($mikrotik->status === 'active' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="inactive" <?php echo e($mikrotik->status === 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
                    </select>
                </div>
            </div>

            
            <div class="flex justify-end gap-4">
                <a href="<?php echo e(route('mikrotik.index')); ?>" class="btn border-slate-300 text-slate-600">Batal</a>
                <button type="submit" class="btn bg-[#ff8000] text-white">Perbarui Router</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Edit Router',
    'sub_title' => 'Ubah Data Router Mikrotik'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/mikrotik/edit.blade.php ENDPATH**/ ?>