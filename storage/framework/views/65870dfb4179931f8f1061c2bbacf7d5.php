<?php $__env->startPush('styles'); ?>
    
    <link href="/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

    
    <style>
        /* Menargetkan semua instance Choices di dalam form ini secara spesifik */
        #create-router-form .choices__inner {
            background-color: transparent;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            padding-left: 0.75rem;
            padding-right: 0.75rem;
            font-size: 0.875rem;
            min-height: 42.5px; /* Menyamakan tinggi dengan form-input lain */
            color: #475569;
            line-height: 1.5;
        }
        .dark #create-router-form .choices__inner {
            border-color: #334155;
            background-color: transparent;
            color: #94a3b8;
        }
        #create-router-form .choices__input {
             background-color: transparent !important;
             font-size: 0.875rem;
             margin-bottom: 0; /* Merapikan posisi placeholder */
             padding-top: 0.2rem;
        }
        #create-router-form .is-focused .choices__inner,
        #create-router-form .is-open .choices__inner {
            border-color: #ff8000 !important;
            box-shadow: 0 0 0 2px #ff800033;
        }
        #create-router-form .choices__list--dropdown {
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            margin-top: 0.5rem;
            overflow: hidden;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.07), 0 4px 6px -4px rgb(0 0 0 / 0.07);
            z-index: 10;
        }
        .dark #create-router-form .choices__list--dropdown {
            background-color: #1e293b;
            border-color: #334155;
        }
        #create-router-form .choices__list--dropdown .choices__item--selectable {
            padding: 0.6rem 0.8rem;
            font-size: 0.875rem;
        }
        #create-router-form .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #ff80001a;
            color: #475569;
        }
        .dark #create-router-form .choices__list--dropdown .choices__item--selectable.is-highlighted {
            background-color: #ff800033;
            color: #e2e8f0;
        }
        #create-router-form .choices[data-type*="select-one"]::after {
            content: '\eabc';
            font-family: 'mingcute';
            height: 1rem;
            width: 1rem;
            border: none;
            margin-top: -0.75rem;
            right: 1.1rem;
            font-size: 1rem;
            transition: transform 0.2s ease-in-out;
            pointer-events: none;
        }
        #create-router-form .choices.is-open[data-type*="select-one"]::after {
           transform: rotate(180deg);
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="grid lg:grid-cols-3 gap-6">
    
    <div class="lg:col-span-1">
        <div class="card p-6 sticky top-20">
            
            <div class="flex items-center gap-4">
                <div class="bg-orange-100 dark:bg-orange-500/20 rounded-md h-14 w-14 flex items-center justify-center">
                    <i class="mgc_add_line text-orange-500 text-3xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-slate-800 dark:text-white">Registrasi Router</h3>
                    <p class="text-sm text-slate-500">Panduan pengisian formulir.</p>
                </div>
            </div>

            <hr class="my-6 border-slate-200 dark:border-slate-700">

            
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="bg-primary/10 text-primary rounded-full h-8 w-8 flex-none flex items-center justify-center text-sm font-bold">1</div>
                    <div>
                        <h4 class="font-semibold text-sm text-slate-700 dark:text-slate-200">Informasi Dasar</h4>
                        <p class="text-xs text-slate-500 mt-1">Nama unik, cluster, dan port API.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="bg-primary/10 text-primary rounded-full h-8 w-8 flex-none flex items-center justify-center text-sm font-bold">2</div>
                    <div>
                        <h4 class="font-semibold text-sm text-slate-700 dark:text-slate-200">Kredensial & Jaringan</h4>
                        <p class="text-xs text-slate-500 mt-1">IP dari VPN, username & password.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <div class="bg-primary/10 text-primary rounded-full h-8 w-8 flex-none flex items-center justify-center text-sm font-bold">3</div>
                    <div>
                        <h4 class="font-semibold text-sm text-slate-700 dark:text-slate-200">Status</h4>
                        <p class="text-xs text-slate-500 mt-1">Tentukan status aktif router.</p>
                    </div>
                </div>
            </div>

            
            <div class="mt-8 p-4 rounded-lg bg-slate-50 dark:bg-slate-700/50">
                <div class="flex items-center gap-3">
                    <i class="mgc_lightbulb_line text-lg text-slate-500 flex-none"></i>
                    <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                        Pastikan port API pada router tidak terblokir oleh firewall dan dapat diakses dari server.
                    </p>
                </div>
            </div>
        </div>
    </div>

    
    <div class="lg:col-span-2">
        <div class="card">
            
            <div class="p-6 flex items-center gap-4 border-b border-slate-200 dark:border-slate-700">
                <i class="mgc_clipboard_line text-xl text-slate-600 dark:text-slate-300"></i>
                <h4 class="text-lg font-semibold">Formulir Router</h4>
            </div>

            <div class="p-6">
                <form action="<?php echo e(route('mikrotik.store')); ?>" method="POST" id="create-router-form">
                    <?php echo csrf_field(); ?>
                    
                    <div class="grid lg:grid-cols-2 gap-x-6">
                        
                        <div class="space-y-6">
                            <div>
                                <label for="router_name" class="form-label">Nama Router <span class="text-red-500">*</span></label>
                                <input type="text" id="router_name" name="router_name" class="form-input" placeholder="Contoh: Router Pusat - Medan" required value="<?php echo e(old('router_name')); ?>">
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
                                <label for="ip_address_select" class="form-label">IP Address (dari VPN) <span class="text-red-500">*</span></label>
                                <select name="ip_address" id="ip_address_select" class="form-select" required>
                                    <option value="">Cari atau pilih IP...</option>
                                    <?php $__empty_1 = true; $__currentLoopData = $availableVpnIps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip => $username): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <option value="<?php echo e($ip); ?>" <?php echo e(old('ip_address') == $ip ? 'selected' : ''); ?>><?php echo e($ip); ?> (<?php echo e($username); ?>)</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <option value="" disabled>Tidak ada IP VPN yang tersedia</option>
                                    <?php endif; ?>
                                </select>
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
                                <input type="text" name="username" class="form-input" required placeholder="admin" value="<?php echo e(old('username')); ?>">
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
                                    <option value="active" <?php echo e(old('status', 'active') == 'active' ? 'selected' : ''); ?>>Aktif</option>
                                    <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Nonaktif</option>
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
                                <input type="text" id="cluster" name="cluster" class="form-input" placeholder="Contoh: AREA-BINJAI" value="<?php echo e(old('cluster')); ?>">
                            </div>

                            <div>
                                <label for="port_api" class="form-label">Port API <span class="text-red-500">*</span></label>
                                <input type="number" id="port_api" name="port_api" class="form-input" value="<?php echo e(old('port_api', '8728')); ?>" required>
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
                                <label for="password" class="form-label">Password API <span class="text-red-500">*</span></label>
                                <input type="password" name="password" class="form-input" required placeholder="&bull;&bull;&bull;&bull;&bull;&bull;">
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
                            <i class="mgc_save_line me-2"></i> Simpan Router
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('scripts'); ?>
    <script src="/libs/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inisialisasi Choices.js hanya untuk select IP Address (dengan fitur pencarian)
            new Choices('#ip_address_select', {
                searchEnabled: true,
                itemSelectText: 'Pilih',
                searchPlaceholderValue: "Ketik untuk mencari IP...",
                noResultsText: 'Tidak ada hasil ditemukan',
            });
        });
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.vertical', [
    'title' => 'Tambah Router Baru',
    'sub_title' => 'Mikrotik',
], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/pages/mikrotik/create.blade.php ENDPATH**/ ?>