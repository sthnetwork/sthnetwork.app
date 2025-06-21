<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto mt-10">
    <div class="card p-6">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-white mb-1">Edit Akun VPN</h4>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
            Perbarui password atau status akun VPN router Mikrotik.
        </p>

        <form action="<?php echo e(route('vpn.update', $vpn->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Username</label>
                    <input type="text" class="form-input bg-slate-100 cursor-not-allowed" value="<?php echo e($vpn->username); ?>" disabled>
                </div>

                <div>
                    <label class="form-label">VPN Type</label>
                    <select name="vpn_type" class="form-select" required>
                        <option value="L2TP" <?php echo e($vpn->vpn_type == 'L2TP' ? 'selected' : ''); ?>>L2TP</option>
                        <option value="PPTP" <?php echo e($vpn->vpn_type == 'PPTP' ? 'selected' : ''); ?>>PPTP</option>
                        <option value="SSTP" <?php echo e($vpn->vpn_type == 'SSTP' ? 'selected' : ''); ?>>SSTP</option>
                    </select>
                </div>
            </div>

            
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div x-data="{ show: false }">
                    <label class="form-label">Password Baru</label>
                    <div class="relative">
                        <input :type="show ? 'text' : 'password'" name="password" class="form-input pr-10" placeholder="Kosongkan jika tidak diubah">
                        <button type="button" @click="show = !show" class="absolute inset-y-0 end-0 px-3 text-slate-500">
                            <i :class="show ? 'mgc_eye_line' : 'mgc_eye_close_line'" class="text-xl"></i>
                        </button>
                    </div>
                </div>

                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="active" <?php echo e($vpn->status == 'active' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="inactive" <?php echo e($vpn->status == 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
                    </select>
                </div>
            </div>

            
            <div class="flex justify-end gap-4">
                <a href="<?php echo e(route('vpn.index')); ?>" class="btn border-slate-300 text-slate-600">Batal</a>
                <button type="submit" class="btn bg-[#ff8000] text-white">Update Akun</button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Edit Akun VPN',
    'sub_title' => 'Perbarui Informasi Akun VPN Mikrotik'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/vpn/edit.blade.php ENDPATH**/ ?>