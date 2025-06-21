<!-- Topbar Start -->
<header class="app-header flex items-center px-4 gap-3">
    <!-- Sidenav Menu Toggle Button -->
    <button id="button-toggle-menu" class="nav-link p-2">
        <span class="sr-only">Menu Toggle Button</span>
        <span class="flex items-center justify-center h-6 w-6">
            <i class="mgc_menu_line text-xl"></i>
        </span>
    </button>

    <!-- Topbar Brand Logo -->
    <a href="<?php echo e(route('any', 'index')); ?>" class="logo-box">
        <div class="logo-light">
            <img src="/images/logo-light.png" class="logo-lg h-6" alt="Light logo">
            <img src="/images/logo-sm.png" class="logo-sm" alt="Small logo">
        </div>
        <div class="logo-dark">
            <img src="/images/logo-dark.png" class="logo-lg h-6" alt="Dark logo">
            <img src="/images/logo-sm.png" class="logo-sm" alt="Small logo">
        </div>
    </a>

    <!-- Topbar Search Modal Button -->
    <button type="button" data-fc-type="modal" data-fc-target="topbar-search-modal" class="nav-link p-2 me-auto">
        <span class="sr-only">Search</span>
        <span class="flex items-center justify-center h-6 w-6">
            <i class="mgc_search_line text-2xl"></i>
        </span>
    </button>

    <!-- Fullscreen Toggle Button -->
    <div class="md:flex hidden">
        <button data-toggle="fullscreen" type="button" class="nav-link p-2">
            <span class="sr-only">Fullscreen Mode</span>
            <span class="flex items-center justify-center h-6 w-6">
                <i class="mgc_fullscreen_line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Notification Bell Button -->
    <div class="relative md:flex hidden">
        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link p-2">
            <span class="sr-only">View notifications</span>
            <span class="flex items-center justify-center h-6 w-6">
                <i class="mgc_notification_line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Light/Dark Toggle Button -->
    <div class="flex">
        <button id="light-dark-mode" type="button" class="nav-link p-2">
            <span class="sr-only">Light/Dark Mode</span>
            <span class="flex items-center justify-center h-6 w-6">
                <i class="mgc_moon_line text-2xl"></i>
            </span>
        </button>
    </div>

    <!-- Profile Dropdown Button -->
    <div class="relative">
        <button data-fc-type="dropdown" data-fc-placement="bottom-end" type="button" class="nav-link">
            <img src="/images/users/user-6.jpg" alt="user-image" class="rounded-full h-10">
        </button>
        <div class="fc-dropdown hidden opacity-0 w-44 z-50 transition-all mt-2 bg-white shadow-lg border rounded-lg p-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800">
            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="pages-gallery.html">
                <i class="mgc_pic_2_line  me-2"></i>
                <span>Gallery</span>
            </a>
            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="apps-kanban.html">
                <i class="mgc_task_2_line  me-2"></i>
                <span>Kanban</span>
            </a>
            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="<?php echo e(route('second', ['auth', 'login'])); ?>">
                <i class="mgc_lock_line  me-2"></i>
                <span>Lock Screen</span>
            </a>
            <hr class="my-2 -mx-2 border-gray-200 dark:border-gray-700">
            <a class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300" href="<?php echo e(route('second', ['auth', 'login'])); ?>">
                <i class="mgc_exit_line  me-2"></i>
                <span>Log Out</span>
            </a>
        </div>
    </div>
</header>
<!-- Topbar End -->

<?php /**PATH /home/billingsth/web/app.sthnetwork.com/public_html/resources/views/layouts/shared/topbar.blade.php ENDPATH**/ ?>