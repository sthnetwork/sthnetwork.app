@extends('layouts.vertical', [
    'title' => 'Router Mikrotik',
    'sub_title' => 'Daftar Router Multi-Site ISP'
])

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h2 class="flex items-center gap-2 text-3xl font-extrabold tracking-tight text-slate-800 dark:text-white">
                <i class="mgc_router_line text-[#ff8000] text-2xl"></i>
                Router Mikrotik
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Kelola router Mikrotik per area (cluster) yang terhubung ke sistem.
            </p>
        </div>
        <a href="{{ route('mikrotiks.create') }}"
           class="btn bg-[#ff8000] hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow-md hover:shadow-lg transition-all">
            <i class="mgc_add_line mr-1"></i> Tambah Router
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md p-6">
        <div class="overflow-x-auto">
            <table class="table w-full text-sm whitespace-nowrap border-separate border-spacing-y-2">
                <thead class="uppercase text-xs tracking-wide text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="font-semibold px-4 py-3 text-left">Nama Router</th>
                        <th class="font-semibold px-4 py-3 text-left">IP Address:Port</th>
                        <th class="font-semibold px-4 py-3 text-left">Cluster</th>
                        <th class="font-semibold px-4 py-3 text-left">Status DB</th>
                        <th class="font-semibold px-4 py-3 text-left">Koneksi API</th>
                        <th class="font-semibold px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($routers as $router)
                        <tr class="bg-white dark:bg-slate-900 hover:bg-orange-50 dark:hover:bg-slate-700 transition-all">
                            <td class="px-4 py-2 font-medium text-slate-800 dark:text-white rounded-l-lg">
                                {{ $router->router_name }}
                            </td>
                            <td class="px-4 py-2 text-slate-600 dark:text-slate-300 font-mono">
                                {{ $router->ip_address }}:{{ $router->port_api }}
                            </td>
                            <td class="px-4 py-2">{{ $router->cluster ?? '-' }}</td>
                            <td class="px-4 py-2">
                                @if($router->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-500/20 dark:text-green-400">
                                        <i class="mgc_check_circle_line text-sm"></i> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-700 dark:bg-red-500/20 dark:text-red-400">
                                        <i class="mgc_close_circle_line text-sm"></i> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                @if($router->status_koneksi)
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-sky-100 text-sky-800 dark:bg-sky-500/20 dark:text-sky-400">
                                        <i class="mgc_wifi_line text-sm"></i> Terhubung
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400">
                                        <i class="mgc_nowifi_line text-sm"></i> Gagal
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-2 text-center rounded-r-lg">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('mikrotiks.edit', $router->id) }}" class="btn btn-sm bg-primary/20 text-primary hover:bg-primary hover:text-white">
                                        <i class="mgc_edit_line"></i>
                                    </a>
                                    <button class="btn btn-sm bg-danger/20 text-danger hover:bg-danger hover:text-white" onclick="confirmDelete('delete-form-{{ $router->id }}')">
                                        <i class="mgc_delete_line"></i>
                                    </button>
                                    <form id="delete-form-{{ $router->id }}" action="{{ route('mikrotiks.destroy', $router->id) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-slate-500 py-8">
                                <div class="flex flex-col items-center">
                                    <i class="mgc_server_line text-4xl text-slate-400 mb-2"></i>
                                    <h4 class="text-lg font-medium">Belum ada data router.</h4>
                                    <p class="text-sm">Silakan tambahkan router baru untuk memulai.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
{{-- Sweet Alert --}}
<script src="/libs/sweetalert2/sweetalert2.min.js"></script>

<script>
    function confirmDelete(formId) {
        Swal.fire({
            title: 'Anda yakin?',
            text: "Data router ini akan dihapus secara permanen.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ff8000',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(formId).submit();
            }
        })
    }
</script>
@endpush

@push('styles')
{{-- Sweet Alert --}}
<link href="/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endpush

