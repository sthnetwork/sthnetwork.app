@extends('layouts.vertical', [
    'title' => 'Pelanggan',
    'sub_title' => 'Daftar Pelanggan ISP'
])

@section('content')
<div class="card mt-8">
    <div class="card-body px-6 pt-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <div>
                <h4 class="text-xl font-semibold text-gray-800">Kelola Data Pelanggan</h4>
                <p class="text-sm text-gray-500">Daftar pelanggan aktif dan detail informasinya</p>
            </div>
            <a href="{{ route('customers.create') }}" class="btn bg-[#ff8000] text-white mt-4 md:mt-0">
                + Tambah Pelanggan
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left border border-gray-200">
                <thead class="bg-gray-50">
                    <tr class="text-gray-600">
                        <th class="px-4 py-3">No</th>
                        <th class="px-4 py-3">Nama</th>
                        <th class="px-4 py-3">Username</th>
                        <th class="px-4 py-3">Password</th>
                        <th class="px-4 py-3">Paket</th>
                        <th class="px-4 py-3">Harga</th>
                        <th class="px-4 py-3">Cluster</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">PPN</th>
                        <th class="px-4 py-3">Prorata</th>
                        <th class="px-4 py-3">Daftar</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $index => $c)
                        <tr class="border-t border-gray-100 hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $index + 1 }}</td>
                            <td class="px-4 py-2">{{ $c->name }}</td>
                            <td class="px-4 py-2 font-mono text-xs">{{ $c->username_pppoe }}</td>
                            <td class="px-4 py-2 font-mono text-xs">{{ $c->password_pppoe }}</td>
                            <td class="px-4 py-2">{{ $c->paket }}</td>
                            <td class="px-4 py-2">Rp{{ number_format($c->harga_paket ?? 150000) }}</td>
                            <td class="px-4 py-2">{{ $c->cluster ?? 'Payabakung' }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $c->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($c->status) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $c->ppn ? 'Ya' : 'Tidak' }}</td>
                            <td class="px-4 py-2">{{ $c->prorata ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $c->created_at->format('d M Y') }}</td>
                            <td class="px-4 py-2 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('customers.edit', $c->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                    <form action="{{ route('customers.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Yakin hapus pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="px-4 py-4 text-center text-gray-400">Belum ada pelanggan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

