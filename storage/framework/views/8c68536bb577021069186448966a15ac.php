<!DOCTYPE html>
<html lang="en" data-sidenav-view="<?php echo e($sidenav ?? 'default'); ?>">

<head>
    <?php echo $__env->make('layouts.shared/title-meta', ['title' => $title], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
    <?php echo $__env->make('layouts.shared/head-css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

<body>
    <div class="flex wrapper">
        <?php echo $__env->make('layouts.shared/sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="page-content">
            <?php echo $__env->make('layouts.shared/topbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <main class="flex-grow p-6">
                <?php echo $__env->make('layouts.shared/page-title', [
                    'title' => $title,
                    'sub_title' => $sub_title,
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <?php echo $__env->make('layouts.shared/footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <?php echo $__env->make('layouts.shared/customizer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts.shared/footer-scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html>

<?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/layouts/vertical.blade.php ENDPATH**/ ?>