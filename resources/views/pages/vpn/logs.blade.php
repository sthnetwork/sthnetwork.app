@extends('layouts.vertical', [
    'title' => 'Log Aktivitas VPN',
    'sub_title' => 'Riwayat Perubahan & Aksi VPN'
])

@section('content')
<div class="card mt-6">
    <div class="card-body px-6 pt-6">
        <h4 class="text-lg font-semibold mb-4">Riwayat Aktivitas Akun VPN</h4>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200 text-left uppercase">
                    <tr>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Username</th>
                        <th class="px-4 py-3">Aksi</th>
                        <th class="px-4 py-3">Alamat IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-700 dark:text-gray-300">
                    @forelse ($logs as $log)
                        <tr>
                            <td class="px-4 py-2">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="px-4 py-2">{{ $log->vpnAccount->username }}</td>
                            <td class="px-4 py-2">
                                <span class="inline-flex px-2 py-1 rounded text-xs font-semibold
                                    @class([
                                        'bg-green-100 text-green-800' => $log->action === 'created',
                                        'bg-yellow-100 text-yellow-800' => $log->action === 'updated',
                                        'bg-red-100 text-red-800' => $log->action === 'deleted',
                                        'bg-slate-100 text-slate-800' => $log->action === 'disconnected',
                                    ])
                                ">
                                    {{ ucfirst($log->action) }}
                                </span>
                            </td>
                            <td class="px-4 py-2">{{ $log->ip_address ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-slate-500">Belum ada log.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
