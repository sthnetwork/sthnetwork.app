@extends('layouts.vertical', [
    'title' => 'Detail Router',
    'sub_title' => 'Informasi Lengkap Router Mikrotik'
])

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <div class="card p-6">
        <h4 class="text-lg font-semibold text-slate-700 dark:text-white mb-1">Detail Router Mikrotik</h4>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Berikut informasi lengkap dari router yang dipilih.</p>

        <div class="grid lg:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="form-label text-slate-500">Nama Router</label>
                <p class="font-medium text-slate-800 dark:text-slate-100">{{ $mikrotik->router_name }}</p>
            </div>
            <div>
                <label class="form-label text-slate-500">Port API</label>
                <p class="font-medium text-slate-800 dark:text-slate-100">{{ $mikrotik->port_api }}</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="form-label text-slate-500">IP Address</label>
                <p class="font-medium text-slate-800 dark:text-slate-100">{{ $mikrotik->ip_address }}</p>
            </div>
            <div>
                <label class="form-label text-slate-500">Username</label>
                <p class="font-medium text-slate-800 dark:text-slate-100">{{ $mikrotik->username }}</p>
            </div>
        </div>

        <div class="grid lg:grid-cols-2 gap-6 mb-6">
            <div>
                <label class="form-label text-slate-500">Cluster / Area</label>
                <p class="font-medium text-slate-800 dark:text-slate-100">{{ $mikrotik->cluster ?? '-' }}</p>
            </div>
            <div>
                <label class="form-label text-slate-500">Status</label>
                <span class="badge {{ $mikrotik->status == 'active' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ $mikrotik->status == 'active' ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
        </div>

        <div class="mt-6 flex justify-end">
            <a href="{{ route('mikrotik.index') }}" class="btn border-slate-300 text-slate-600">Kembali</a>
        </div>
    </div>
</div>
@endsection

