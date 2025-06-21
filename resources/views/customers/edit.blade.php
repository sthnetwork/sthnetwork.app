@extends('layouts.vertical', [
    'title' => 'Pelanggan',
    'sub_title' => 'Daftar Pelanggan ISP'
])

@section('content')
<div class="card">
    <div class="card-body">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 px-2 md:px-4">
            <h4 class="card-title text-lg font-semibold">Daftar Pelanggan</h4>
            <a href="{{ route('customers.create') }}" class="btn bg-[#ff8000] text-white mt-3 md:mt-0">
                + Tambah Pelanggan
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success mb-4 px-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive px-2 md:px-4">
            <table class="table table-bordered w-full" id="datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username PPPoE</th>
                        <th>Password</th>
                        <th>Paket</th>
                        <th>Harga</th>
                        <th>Cluster</th>
                        <th>Status</th>
                        <th>PPN</th>
                        <th>Prorata</th>
                        <th>Daftar</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $index => $c)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $c->name }}</td>
                            <td class="font-mono text-xs">{{ $c->username_pppoe }}</td>
                            <td class="font-mono text-xs">{{ $c->password_pppoe }}</td>
                            <td>{{ $c->paket }}</td>
                            <td>Rp{{ number_format($c->harga_paket) }}</td>
                            <td>{{ $c->cluster }}</td>
                            <td>
                                @if($c->status == 'aktif')
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-danger">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $c->ppn ? 'Ya' : 'Tidak' }}</td>
                            <td>{{ $c->prorata ?? '-' }}</td>
                            <td>{{ $c->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <a href="{{ route('customers.edit', $c->id) }}" class="text-primary">Edit</a>
                                |
                                <form action="{{ route('customers.destroy', $c->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-danger bg-transparent border-0 p-0">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="12" class="text-center text-gray-500">Belum ada pelanggan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        new simpleDatatables.DataTable("#datatable");
    });
</script>
@endpush

