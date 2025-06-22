<!DOCTYPE html>
<html lang="en" data-sidenav-view="{{ $sidenav ?? 'default' }}">

<head>
    @include('layouts.shared/title-meta', ['title' => $title])
    @yield('css')
    @include('layouts.shared/head-css')
</head>

<body>
    <div class="flex wrapper">
        @include('layouts.shared/sidebar')

        <div class="page-content">
            @include('layouts.shared/topbar')

            <main class="flex-grow p-6">
                @include('layouts.shared/page-title', [
                    'title' => $title,
                    'sub_title' => $sub_title,
                ])

                @yield('content')
            </main>

            @include('layouts.shared/footer')
        </div>
    </div>

    @include('layouts.shared/customizer')
    @include('layouts.shared/footer-scripts')

    {{-- Alpine.js wajib untuk dropdown --}}
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/js/app.js'])
    @stack('scripts')
</body>

</html>

