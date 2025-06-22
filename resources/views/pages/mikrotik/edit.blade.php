@extends('layouts.vertical', [
    'title' => 'Edit Router',
    'sub_title' => 'Mikrotik',
])

@push('styles')
    {{-- SweetAlert2 (jika belum ada di layout utama) --}}
    <link href="/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    {{-- Kolom Kiri: Informasi dan Petunjuk --}}
    <div class="lg:col-span-1">
        <div class="card p-6 sticky top-20">
            {{-- Header Card Kiri --}}
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

            {{-- Info Router --}}
            <div>
                <div class="flex justify-between mb-2">
                    <span class="text-sm text-slate-500">Nama Router</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $mikrotik->router_name }}</span>
                </div>
                 <div class="flex justify-between mb-2">
                    <span class="text-sm text-slate-500">IP Address</span>
                    <span class="text-sm font-mono text-slate-700 dark:text-slate-300">{{ $mikrotik->ip_address }}</span>
                </div>
                 <div class="flex justify-between">
                    <span class="text-sm text-slate-500">Cluster</span>
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $mikrotik->cluster ?? '-' }}</span>
                </div>
            </div>

            {{-- Kotak Peringatan Password --}}
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

    {{-- Kolom Kanan: Form Input --}}
    <div class="lg:col-span-2">
        <div class="card">
            {{-- Header Card Kanan --}}
            <div class="p-6 flex items-center gap-4 border-b border-slate-200 dark:border-slate-700">
                <i class="mgc_clipboard_edit_line text-xl text-slate-600 dark:text-slate-300"></i>
                <h4 class="text-lg font-semibold">Formulir Perubahan Data</h4>
            </div>

            <div class="p-6">
                <form action="{{ route('mikrotik.update', $mikrotik->id) }}" method="POST" id="edit-router-form">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid lg:grid-cols-2 gap-x-6">
                        {{-- Kolom Form Kiri --}}
                        <div class="space-y-6">
                            <div>
                                <label for="router_name" class="form-label">Nama Router <span class="text-red-500">*</span></label>
                                <input type="text" id="router_name" name="router_name" class="form-input" required value="{{ old('router_name', $mikrotik->router_name) }}">
                                @error('router_name')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>

                             <div>
                                <label for="ip_address" class="form-label">IP Address <span class="text-red-500">*</span></label>
                                <input type="text" id="ip_address" name="ip_address" class="form-input" required value="{{ old('ip_address', $mikrotik->ip_address) }}">
                                @error('ip_address')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div>
                                <label for="username" class="form-label">Username API <span class="text-red-500">*</span></label>
                                <input type="text" name="username" class="form-input" required value="{{ old('username', $mikrotik->username) }}">
                                @error('username')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>
                           
                            <div>
                                <label for="status" class="form-label">Status <span class="text-red-500">*</span></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="active" {{ old('status', $mikrotik->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status', $mikrotik->status) == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        
                        {{-- Kolom Form Kanan --}}
                        <div class="space-y-6">
                            <div>
                                <label for="cluster" class="form-label">Cluster / Area</label>
                                <input type="text" id="cluster" name="cluster" class="form-input" value="{{ old('cluster', $mikrotik->cluster) }}">
                            </div>

                            <div>
                                <label for="port_api" class="form-label">Port API <span class="text-red-500">*</span></label>
                                <input type="number" id="port_api" name="port_api" class="form-input" value="{{ old('port_api', $mikrotik->port_api) }}" required>
                                @error('port_api')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>

                            {{-- Field Password Standar --}}
                            <div>
                                <label for="password" class="form-label">Password API</label>
                                <input type="password" id="password" name="password" class="form-input" placeholder="Kosongkan jika tidak diubah">
                                @error('password')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex justify-end gap-4 mt-8 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('mikrotik.index') }}" class="btn border-slate-300 text-slate-600 dark:border-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition-all">
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
@endsection

@push('scripts')
{{-- Library SweetAlert2 --}}
<script src="/libs/sweetalert2/sweetalert2.min.js"></script>

<script>
    // Cek jika ada session 'success' dan tampilkan notifikasi
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#ff8000',
            confirmButtonText: 'Luar Biasa!'
        })
    @endif
</script>
@endpush

