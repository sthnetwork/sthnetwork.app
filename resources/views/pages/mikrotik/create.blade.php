@extends('layouts.vertical', [
    'title' => 'Tambah Router',
    'sub_title' => 'Form Input Data Router Mikrotik'
])

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="card p-6">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-white mb-1">Tambah Router Mikrotik</h4>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
            Masukkan informasi lengkap untuk menambahkan router Mikrotik ke sistem billing ISP.
        </p>

        <form action="{{ route('mikrotik.store') }}" method="POST">
            @csrf

            {{-- Baris 1 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Nama Router *</label>
                    <input type="text" name="router_name" class="form-input" placeholder="Contoh: Router Perbatasan" required>
                </div>

                <div>
                    <label class="form-label">Port API *</label>
                    <input type="number" name="port_api" class="form-input" value="8728" required>
                </div>
            </div>

            {{-- Baris 2 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">IP Address *</label>
                    <select name="ip_address" class="form-select" required>
                        <option value="">-- Pilih IP VPN Tersedia --</option>
                        @foreach($availableVpnIps as $ip => $username)
                            <option value="{{ $ip }}">{{ $ip }} ({{ $username }})</option>
                        @endforeach
                    </select>
                    <a href="#" class="text-sm text-slate-500 hover:underline mt-1 inline-block">
                        <i class="mgc_link_2_line align-middle"></i> Test Koneksi
                    </a>
                </div>

                <div>
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-input" required>
                </div>
            </div>

            {{-- Baris 3 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-input" required>
                </div>

                <div>
                    <label class="form-label">Cluster / Area</label>
                    <input type="text" name="cluster" class="form-input" placeholder="Contoh: STH - Langkat">
                </div>
            </div>

            {{-- Baris 4 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="active" selected>Aktif</option>
                        <option value="inactive">Nonaktif</option>
                    </select>
                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="flex justify-end gap-4">
                <a href="{{ route('mikrotik.index') }}" class="btn border-slate-300 text-slate-600 dark:border-slate-600 dark:text-slate-300">
                    Batal
                </a>
                <button type="submit" class="btn bg-[#ff8000] hover:bg-[#e97400] text-white">
                    Simpan Router
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

