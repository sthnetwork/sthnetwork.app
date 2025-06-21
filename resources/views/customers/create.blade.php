@extends('layouts.vertical', [
    'title' => 'Tambah Pelanggan',
    'sub_title' => 'Input Data Pelanggan Baru'
])

@section('content')
<div class="card mt-8">
    <div class="card-body px-6 pt-8" x-data="formPelanggan()">
        <form action="{{ route('customers.store') }}" method="POST" @submit.prevent="submitForm">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="form-label">Nama Pelanggan *</label>
                    <input type="text" name="name" x-model.lazy="nama" class="form-input" required @blur="nama = toProperCase(nama)">
                </div>

                <div>
                    <label class="form-label">NIK (No. KTP) *</label>
                    <input type="text" name="nik" x-model="nik" class="form-input" maxlength="16" required>
                    <template x-if="nik.length > 0 && nik.length !== 16">
                        <p class="text-red-500 text-sm mt-1">NIK harus 16 digit</p>
                    </template>
                </div>

                <div>
                    <label class="form-label">Nomor WhatsApp</label>
                    <input type="text" name="no_hp" class="form-input" placeholder="628xxxxxxx">
                </div>

                <div>
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" x-model.lazy="alamat" @blur="alamat = toProperCase(alamat)" class="form-input" rows="2"></textarea>
                </div>

                <div>
                    <label class="form-label">Router (POP)</label>
                    <select name="mikrotik_id" class="form-select" x-model="routerId" @change="updateRouter()" required>
                        <option value="">-- Pilih Router --</option>
                        <option value="1" data-idrouter="RTR1" data-cluster="Payabakung">RTR1 (Payabakung)</option>
                        <option value="2" data-idrouter="RTR2" data-cluster="Swadaya">RTR2 (Swadaya)</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Cluster</label>
                    <input type="text" name="cluster" x-model="cluster" class="form-input bg-gray-100" readonly>
                </div>

                <div>
                    <label class="form-label">Paket Internet *</label>
                    <select name="paket" class="form-select" x-model="paket" @change="updateHarga()" required>
                        <option value="">-- Pilih Paket --</option>
                        <option value="StreamMax" data-harga="150000">StreamMax - Rp150.000</option>
                        <option value="UltraStream" data-harga="180000">UltraStream - Rp180.000</option>
                    </select>
                </div>

                <div>
                    <label class="form-label">Harga Paket</label>
                    <input type="text" x-model="hargaPaket" class="form-input bg-gray-100" readonly>
                </div>

                <div>
                    <label class="form-label">Username PPPoE</label>
                    <input type="text" name="username_pppoe" x-model="username" class="form-input bg-gray-100" readonly>
                </div>

                <div>
                    <label class="form-label">Password PPPoE</label>
                    <input type="text" name="password_pppoe" x-model="password" class="form-input bg-gray-100" readonly>
                </div>

                <div>
                    <label class="form-label">Serial Number ONU</label>
                    <input type="text" name="onu_serial" class="form-input" placeholder="Opsional">
                </div>

                <div>
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <div class="mt-6">
                <button type="submit" class="btn bg-[#ff8000] text-white">
                    <i class="mdi mdi-content-save me-1"></i> Simpan Pelanggan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function formPelanggan() {
    return {
        nama: '',
        nik: '',
        alamat: '',
        routerId: '',
        cluster: '',
        paket: '',
        hargaPaket: '',
        username: '',
        password: '',

        updateRouter() {
            const select = document.querySelector('select[name="mikrotik_id"]');
            const selected = select.options[select.selectedIndex];
            const idRouter = selected.getAttribute('data-idrouter');
            const cluster = selected.getAttribute('data-cluster');
            this.cluster = cluster;
            this.generateUsername(idRouter);
        },

        generateUsername(idRouter) {
            const namaClean = this.nama.toLowerCase().replace(/\s+/g, '');
            const nikPart = this.nik.slice(-4) || Math.floor(1000 + Math.random() * 9000);
            const user = `${namaClean}.${nikPart}`;
            this.username = `${user}@${idRouter}.sthnetwork.com`;
            this.password = user;
        },

        updateHarga() {
            const select = document.querySelector('select[name="paket"]');
            const harga = select.options[select.selectedIndex]?.getAttribute('data-harga');
            this.hargaPaket = harga ? `Rp ${parseInt(harga).toLocaleString('id-ID')}` : '';
        },

        toProperCase(text) {
            return text.replace(/\w\S*/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        },

        submitForm() {
            this.nama = this.toProperCase(this.nama);
            this.alamat = this.toProperCase(this.alamat);

            if (this.nama.trim() === '' || this.nik.length !== 16 || this.routerId === '' || this.paket === '') {
                alert('Harap isi semua kolom wajib dan pastikan NIK 16 digit.');
                return;
            }
            $el('form').submit();
        }
    }
}
</script>
@endpush

