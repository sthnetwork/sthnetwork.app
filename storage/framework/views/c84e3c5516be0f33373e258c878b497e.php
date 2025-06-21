<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto mt-10">
    <div class="card p-6">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-white mb-1">Tambah Akun VPN</h4>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
            Akun VPN akan digunakan untuk koneksi antar Mikrotik melalui tunnel L2TP / PPTP / SSTP.
        </p>

        
        <?php if(session('error')): ?>
            <div class="alert alert-danger mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('vpn.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Username *</label>
                    <div class="flex items-center space-x-2">
                        <input type="text" name="username" class="form-input w-full" placeholder="contoh: router01" required>
                        <span class="text-sm text-slate-500">@sthnetwork</span>
                    </div>
                </div>

                <div>
                    <label class="form-label">VPN Type *</label>
                    <select name="vpn_type" class="form-select" required>
                        <option value="L2TP" selected>L2TP</option>
                        <option value="PPTP">PPTP</option>
                        <option value="SSTP">SSTP</option>
                    </select>
                </div>
            </div>

            <div class="mb-6">
                <label class="form-label">Password *</label>
                <div class="relative">
                    <input type="password" name="password" class="form-input pr-10" id="vpn-password" required>
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-2.5 text-slate-500 hover:text-slate-700">
                        <i class="mgc_eye_line" id="icon-eye"></i>
                    </button>
                </div>
            </div>

            <div class="flex justify-end gap-4">
                <a href="<?php echo e(route('vpn.index')); ?>" class="btn border-slate-300 text-slate-600">Batal</a>
                <button type="submit" class="btn bg-[#ff8000] text-white">Buat Akun VPN</button>
            </div>
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById("vpn-password");
        const icon = document.getElementById("icon-eye");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('mgc_eye_line');
            icon.classList.add('mgc_eye_off_line');
        } else {
            input.type = "password";
            icon.classList.remove('mgc_eye_off_line');
            icon.classList.add('mgc_eye_line');
        }
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Tambah Akun VPN',
    'sub_title' => 'Buat Akun VPN untuk Router Mikrotik'
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/vpn/create.blade.php ENDPATH**/ ?>