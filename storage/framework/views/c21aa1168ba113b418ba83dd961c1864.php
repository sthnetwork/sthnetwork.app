<?php $__env->startPush('styles'); ?>
    
    <link href="/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="grid lg:grid-cols-3 gap-6">
    
    <div class="lg:col-span-1">
        <div class="card p-6 sticky top-20">
            
            <div class="flex items-center gap-4">
                <div class="bg-orange-100 dark:bg-orange-500/20 rounded-md h-14 w-14 flex items-center justify-center">
                    <i class="mgc_edit_line text-orange-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">Ubah Data Router</h3>
                    <p class="text-sm text-slate-500">Perbarui informasi router.</p>
                </div>
            </div>

            <hr class="my-6 border-slate-200 dark:border-slate-700">

            
            <div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm text-slate-500">Nama Router</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e($mikrotik->router_name); ?></span>
                </div>
                 <div class="flex justify-between mb-2">
                    <span class="text-sm text-slate-500">IP Address</span>
                    <span class="text-sm font-mono text-slate-700 dark:text-slate-300"><?php echo e($mikrotik->ip_address); ?></span>
                </div>
                 <div class="flex justify-between">
                    <span class="text-sm text-slate-500">Cluster</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e($mikrotik->cluster ?? '-'); ?></span>
                </div>
            </div>

            
            <div class="mt-8 p-4 rounded-lg bg-amber-100/60 dark:bg-amber-500/20">
                <div class="flex items-center gap-3">
                    <i class="mgc_warning_line text-lg text-amber-600 dark:text-amber-400 flex-none"></i>
                    <p class="text-xs text-amber-700 dark:text-amber-300 leading-relaxed">
                        Kosongkan field **Password API** jika Anda tidak ingin mengubahnya.
                    </p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="lg:col-span-2">
        <div class="card">
            
            <div class="p-6 flex items-center gap-4 border-b border-slate-200 dark:border-slate-700">
                <i class="mgc_clipboard_edit_line text-xl text-slate-600 dark:text-slate-300"></i>
                <h4 class="text-lg font-semibold">Formulir Perubahan Data</h4>
            </div>

            <div class="p-6">
                <form action="<?php echo e(route('mikrotik.update', $mikrotik->id)); ?>" method="POST" id="edit-router-form">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <div class="grid lg:grid-cols-2 gap-x-6">
                        
                        <div class="space-y-6">
                            <div>
                                <label for="router_name" class="form-label">Nama Router <span class="text-red-500">*</span></label>
                                <input type="text" id="router_name" name="router_name" class="form-input" required value="<?php echo e(old('router_name', $mikrotik->router_name)); ?>">
                                <?php $__errorArgs = ['router_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-xs text-red-500 mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                             <div>
                                <label for="ip_address" class="form-label">IP Address <span class="text-red-500">*</span></label>
                                <input type="text" id="ip_address" name="ip_address" class="form-input" required value="<?php echo e(old('ip_address', $mikrotik->ip_address)); ?>">
                                <?php $__errorArgs = ['ip_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-xs text-red-500 mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="username" class="form-label">Username API <span class="text-red-500">*</span></label>
                                <input type="text" name="username" class="form-input" required value="<?php echo e(old('username', $mikrotik->username)); ?>">
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-xs text-red-500 mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                           
                            <div>
                                <label for="status" class="form-label">Status <span class="text-red-500">*</span></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="active" <?php echo e(old('status', $mikrotik->status) == 'active' ? 'selected' : ''); ?>>Aktif</option>
                                    <option value="inactive" <?php echo e(old('status', $mikrotik->status) == 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
                                </select>
                                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-xs text-red-500 mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        
                        
                        <div class="space-y-6">
                            <div>
                                <label for="cluster" class="form-label">Cluster / Area</label>
                                <input type="text" id="cluster" name="cluster" class="form-input" value="<?php echo e(old('cluster', $mikrotik->cluster)); ?>">
                            </div>

                            <div>
                                <label for="port_api" class="form-label">Port API <span class="text-red-500">*</span></label>
                                <input type="number" id="port_api" name="port_api" class="form-input" value="<?php echo e(old('port_api', $mikrotik->port_api)); ?>" required>
                                <?php $__errorArgs = ['port_api'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-xs text-red-500 mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            
                            <div>
                                <label for="password" class="form-label">Password API</label>
                                <input type="password" id="password" name="password" class="form-input" placeholder="Kosongkan jika tidak diubah">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-xs text-red-500 mt-1"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>

                    
                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="<?php echo e(route('mikrotik.index')); ?>" class="btn border-slate-300 text-slate-600 dark:border-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
                            Batal
                        </a>
                        <button type="submit" class="btn bg-[#ff8000] hover:bg-orange-600 text-white">
                            <i class="mgc_check_line me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>

<script src="/libs/sweetalert2/sweetalert2.min.js"></script>

<script>
    // Cek jika ada session 'success' dan tampilkan notifikasi
    <?php if(session('success')): ?>
        Swal.fire({
            title: 'Berhasil!',
            text: '<?php echo e(session('success')); ?>',
            icon: 'success',
            confirmButtonColor: '#ff8000',
            confirmButtonText: 'Luar Biasa!'
        })
    <?php endif; ?>
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Edit Router',
    'sub_title' => 'Mikrotik',
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/mikrotik/edit.blade.php ENDPATH**/ ?>