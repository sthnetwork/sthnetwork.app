@extends('layouts.vertical', [
    'title' => 'Edit Router',
    'sub_title' => 'Ubah Data Router Mikrotik'
])

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="card p-6">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-white mb-1">Edit Router Mikrotik</h4>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">
            Ubah informasi router Mikrotik sesuai data yang valid di jaringan ISP kamu.
        </p>

        <form action="{{ route('mikrotik.update', $mikrotik->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Baris 1 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Nama Router *</label>
                    <input type="text" name="router_name" class="form-input"
                        value="{{ old('router_name', $mikrotik->router_name) }}" required>
                </div>

                <div>
                    <label class="form-label">Port API *</label>
                    <input type="number" name="port_api" class="form-input"
                        value="{{ old('port_api', $mikrotik->port_api) }}" required>
                </div>
            </div>

            {{-- Baris 2 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">IP Address *</label>
                    <input type="text" name="ip_address" class="form-input"
                        value="{{ old('ip_address', $mikrotik->ip_address) }}" required>
                </div>

                <div>
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-input"
                        placeholder="(Kosongkan jika tidak ingin diubah)">
                </div>
            </div>

            {{-- Baris 3 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-input"
                        value="{{ old('username', $mikrotik->username) }}" required>
                </div>

                <div>
                    <label class="form-label">Cluster / Area</label>
                    <input type="text" name="cluster" class="form-input"
                        value="{{ old('cluster', $mikrotik->cluster) }}">
                </div>
            </div>

            {{-- Baris 4 --}}
            <div class="grid lg:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="form-label">Status *</label>
                    <select name="status" class="form-select" required>
                        <option value="active" {{ $mikrotik->status === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ $mikrotik->status === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            {{-- Tombol --}}
            <div class="flex justify-end gap-4">
                <a href="{{ route('mikrotik.index') }}" class="btn border-slate-300 text-slate-600">Batal</a>
                <button type="submit" class="btn bg-[#ff8000] text-white">Perbarui Router</button>
            </div>
        </form>
    </div>
</div>
@endsection

