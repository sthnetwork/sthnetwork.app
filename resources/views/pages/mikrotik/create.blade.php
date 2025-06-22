@extends('layouts.vertical', [
    'title' => 'Tambah Router Baru',
    'sub_title' => 'Mikrotik',
])

{{-- push style --}}
@push('styles')
    {{-- Library Choices.js (pastikan path ini benar) --}}
    <link href="/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

    {{-- Custom Styling untuk Choices.js agar lebih modern dan menyatu dengan tema --}}
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
@endpush

@section('content')
<div class="grid lg:grid-cols-3 gap-6">
    {{-- Kolom Kiri: Informasi dan Petunjuk --}}
    <div class="lg:col-span-1">
        <div class="card p-6 sticky top-20">
            {{-- Header Card Kiri --}}
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

            {{-- Langkah-langkah --}}
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

            {{-- Kotak Tips --}}
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

    {{-- Kolom Kanan: Form Input --}}
    <div class="lg:col-span-2">
        <div class="card">
            {{-- Header Card Kanan --}}
            <div class="p-6 flex items-center gap-4 border-b border-slate-200 dark:border-slate-700">
                <i class="mgc_clipboard_line text-xl text-slate-600 dark:text-slate-300"></i>
                <h4 class="text-lg font-semibold">Formulir Router</h4>
            </div>

            <div class="p-6">
                <form action="{{ route('mikrotik.store') }}" method="POST" id="create-router-form">
                    @csrf
                    
                    <div class="grid lg:grid-cols-2 gap-x-6">
                        {{-- Kolom Form Kiri --}}
                        <div class="space-y-6">
                            <div>
                                <label for="router_name" class="form-label">Nama Router <span class="text-red-500">*</span></label>
                                <input type="text" id="router_name" name="router_name" class="form-input" placeholder="Contoh: Router Pusat - Medan" required value="{{ old('router_name') }}">
                                @error('router_name')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>

                             <div>
                                <label for="ip_address_select" class="form-label">IP Address (dari VPN) <span class="text-red-500">*</span></label>
                                <select name="ip_address" id="ip_address_select" class="form-select" required>
                                    <option value="">Cari atau pilih IP...</option>
                                    @forelse($availableVpnIps as $ip => $username)
                                        <option value="{{ $ip }}" {{ old('ip_address') == $ip ? 'selected' : '' }}>{{ $ip }} ({{ $username }})</option>
                                    @empty
                                        <option value="" disabled>Tidak ada IP VPN yang tersedia</option>
                                    @endforelse
                                </select>
                                @error('ip_address')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div>
                                <label for="username" class="form-label">Username API <span class="text-red-500">*</span></label>
                                <input type="text" name="username" class="form-input" required placeholder="admin" value="{{ old('username') }}">
                                @error('username')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>
                           
                            <div>
                                <label for="status" class="form-label">Status <span class="text-red-500">*</span></label>
                                <select name="status" id="status" class="form-select">
                                    <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                                </select>
                                @error('status')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>
                        </div>
                        
                        {{-- Kolom Form Kanan --}}
                        <div class="space-y-6">
                            <div>
                                <label for="cluster" class="form-label">Cluster / Area</label>
                                <input type="text" id="cluster" name="cluster" class="form-input" placeholder="Contoh: AREA-BINJAI" value="{{ old('cluster') }}">
                            </div>

                            <div>
                                <label for="port_api" class="form-label">Port API <span class="text-red-500">*</span></label>
                                <input type="number" id="port_api" name="port_api" class="form-input" value="{{ old('port_api', '8728') }}" required>
                                @error('port_api')<span class="text-xs text-red-500 mt-1">{{ $message }}</span>@enderror
                            </div>

                            <div>
                                <label for="password" class="form-label">Password API <span class="text-red-500">*</span></label>
                                <input type="password" name="password" class="form-input" required placeholder="&bull;&bull;&bull;&bull;&bull;&bull;">
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
                            <i class="mgc_save_line me-2"></i> Simpan Router
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- push script --}}
@push('scripts')
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
@endpush

