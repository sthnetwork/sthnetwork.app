@extends('layouts.vertical', [
    'title' => 'Router Mikrotik',
    'sub_title' => 'Kelola router Mikrotik antar cluster.'
])

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="space-y-6 px-2 md:px-0">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div class="flex gap-2">
            <i class="mgc_router_line text-[#ff8000] text-2xl mt-1.5"></i>
            <div>
                <h2 class="text-3xl font-bold text-slate-800 dark:text-white">Router Mikrotik</h2>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    Kelola router Mikrotik per area (cluster) yang terhubung ke sistem.
                </p>
            </div>
        </div>

        <a href="{{ route('mikrotik.create') }}"
           class="btn bg-[#ff8000] hover:bg-orange-600 text-white font-semibold px-4 py-2 rounded-md shadow-sm hover:shadow transition">
            <i class="mgc_add_line mr-1"></i> Tambah Router
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-gray-800 shadow rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-200">
                <thead class="bg-gray-50 dark:bg-gray-700 uppercase text-[11px] font-semibold">
                    <tr>
                        <th class="px-6 py-3 text-center min-w-[100px]">Aksi</th>
                        <th class="px-6 py-3">Nama Router</th>
                        <th class="px-6 py-3">IP Address:Port</th>
                        <th class="px-6 py-3">Cluster</th>
                        <th class="px-6 py-3 text-center">Koneksi API</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($routers as $router)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center items-center gap-2">
                                    <button onclick="testConnection('{{ url('/mikrotik/test-koneksi/' . $router->id) }}')" class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white">
                                        <i class="mgc_link_line"></i>
                                    </button>
                                    <a href="{{ route('mikrotik.edit', $router->id) }}" class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-white">
                                        <i class="mgc_edit_line"></i>
                                    </a>
                                    <form id="delete-form-{{ $router->id }}" method="POST" action="{{ route('mikrotik.destroy', $router->id) }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button onclick="confirmDelete('delete-form-{{ $router->id }}')" class="text-red-500 hover:text-red-700">
                                        <i class="mgc_delete_2_line"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $router->router_name }}</td>
                            <td class="px-6 py-4">{{ $router->ip_address }}:{{ $router->port_api }}</td>
                            <td class="px-6 py-4">{{ $router->cluster ?? '-' }}</td>
                            <td class="px-6 py-4 text-center min-w-[120px]">
                                @if($router->status_koneksi)
                                    <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-500/20 dark:text-green-400">
                                        <i class="mgc_wifi_line text-sm"></i> Terhubung
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400">
                                        <i class="mgc_nowifi_line text-sm"></i> Gagal
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-slate-500">
                                <div class="flex flex-col items-center">
                                    <i class="mgc_server_line text-4xl mb-3 text-slate-400"></i>
                                    <p class="text-lg font-semibold">Belum ada router</p>
                                    <p class="text-sm">Klik tombol "Tambah Router" untuk menambahkan router baru.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $routers->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function testConnection(url) {
    fetch(url)
        .then(res => res.json())
        .then(data => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: data.status ? 'success' : 'error',
                title: data.message ?? 'Tidak ada respon.',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                customClass: {
                    popup: 'text-sm rounded-md'
                }
            });
        })
        .catch(() => {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Gagal menghubungi router.',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true
            });
        });
}

function confirmDelete(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    Swal.fire({
        title: 'Apakah Anda yakin ingin menghapus router ini?',
        text: 'Data router akan dihapus permanen.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc2626',
        cancelButtonColor: '#6b7280',
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal',
        customClass: {
            popup: 'rounded-md p-4 text-sm w-[350px]',
            title: 'text-base font-semibold',
            actions: 'justify-end gap-2 mt-4',
            confirmButton: 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md',
            cancelButton: 'bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-md'
        },
        buttonsStyling: false
    }).then(result => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}
</script>
@endpush

