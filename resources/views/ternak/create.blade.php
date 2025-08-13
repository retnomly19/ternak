@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-3 max-w-4xl">
    <!-- Judul center, jarak atas dipersempit -->
    <div class="text-center mb-3">
        <h1 class="text-2xl font-semibold">Tambah Data Ternak</h1>
    </div>

    @if ($errors->any())
        <div class="bg-red-100 p-2 rounded mb-3">
            <ul class="text-sm text-red-700 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-lg">
        <form action="{{ route('ternak.store') }}" method="POST" enctype="multipart/form-data" id="ternakForm">
            @csrf

            {{-- Card body --}}
            <div class="px-4 py-4">
                {{-- Tabs (centered) --}}
                <div class="flex justify-center mb-3">
                    <button type="button" id="tabInformasiBtn" class="tab-btn px-4 py-1 text-sm font-medium bg-blue-600 text-white rounded-t">Informasi Umum</button>
                    <button type="button" id="tabPemasokBtn" class="tab-btn px-4 py-1 text-sm font-medium ml-2 bg-gray-100 text-gray-700 rounded-t">Kontak Pemasok</button>
                </div>

                {{-- Informasi Umum (tab) --}}
                <div id="tabInformasi" class="tab-pane">
                    <!-- Grid: 10 kolom (md+), tiap input span 5 => kiri 5, kanan 5 -->
                    <div class="grid grid-cols-1 md:grid-cols-10 gap-2">
                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">ID Ternak <span class="text-red-600">*</span></label>
                            <input type="text" name="id_ternak" value="{{ old('id_ternak') }}" required class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Harga Beli <span class="text-red-600">*</span></label>
                            <input type="number" name="harga_beli" value="{{ old('harga_beli') }}" step="0.01" min="0" required class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Kategori <span class="text-red-600">*</span></label>
                            <select name="kategori" required class="w-full border rounded px-2 py-1 text-sm">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach(['Domba','Kambing','Sapi','Kerbau','Ayam','Kuda'] as $cat)
                                    <option value="{{ $cat }}" @selected(old('kategori')==$cat)>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Kondisi <span class="text-red-600">*</span></label>
                            <select name="kondisi" required class="w-full border rounded px-2 py-1 text-sm">
                                <option value="">-- Pilih --</option>
                                <option value="Sehat" @selected(old('kondisi')=='Sehat')>Sehat</option>
                                <option value="Sakit" @selected(old('kondisi')=='Sakit')>Sakit</option>
                            </select>
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Jenis Ternak <span class="text-red-600">*</span></label>
                            <input type="text" name="jenis" value="{{ old('jenis') }}" required class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Lokasi <span class="text-red-600">*</span></label>
                            <select name="lokasi" required class="w-full border rounded px-2 py-1 text-sm">
                                <option value="">-- Pilih Lokasi --</option>
                                @foreach(['Kandang A','Kandang B','Kandang C','Kandang D','Kandang E','Kandang F','Kandang G','Kandang H'] as $loc)
                                    <option value="{{ $loc }}" @selected(old('lokasi')==$loc)>{{ $loc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Umur (bulan) <span class="text-red-600">*</span></label>
                            <input type="number" name="umur" min="0" value="{{ old('umur') }}" required class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Tanggal Masuk <span class="text-red-600">*</span></label>
                            <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}" required class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Jenis Kelamin <span class="text-red-600">*</span></label>
                            <select name="jenis_kelamin" required class="w-full border rounded px-2 py-1 text-sm">
                                <option value="">-- Pilih --</option>
                                <option value="Jantan" @selected(old('jenis_kelamin')=='Jantan')>Jantan</option>
                                <option value="Betina" @selected(old('jenis_kelamin')=='Betina')>Betina</option>
                            </select>
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Foto</label>
                            <input type="file" name="foto" accept="image/*" class="w-full text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Daftar Vaksinasi</label>
                            <input type="text" name="vaksinasi" value="{{ old('vaksinasi') }}" placeholder="Contoh: Rabies, Cacar" class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Tanggal Cek Medis Terakhir</label>
                            <input type="date" name="cek_medis_terakhir" value="{{ old('cek_medis_terakhir') }}" class="w-full border rounded px-2 py-1 text-sm">
                        </div>
                    </div>

                    <!-- tombol lanjut -->
                    <div class="mt-3 text-right">
                        <button type="button" id="toPemasok" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Lanjut</button>
                    </div>
                </div>

                {{-- Kontak Pemasok (tab) --}}
                <div id="tabPemasok" class="tab-pane hidden">
                    <div class="grid grid-cols-1 md:grid-cols-10 gap-2">
                        

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Nama Pemasok (jika baru)</label>
                            <input type="text" name="nama_pemasok" value="{{ old('nama_pemasok') }}" class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-5">
                            <label class="block text-sm font-medium mb-1">Telepon Pemasok</label>
                            <input type="text" name="telepon_pemasok" value="{{ old('telepon_pemasok') }}" class="w-full border rounded px-2 py-1 text-sm">
                        </div>

                        <div class="md:col-span-10">
                            <label class="block text-sm font-medium mb-1">Alamat Pemasok</label>
                            <textarea name="alamat_pemasok" class="w-full border rounded px-2 py-1 text-sm" rows="2">{{ old('alamat_pemasok') }}</textarea>
                        </div>

                        <div class="md:col-span-10">
                            <label class="block text-sm font-medium mb-1">Hubungan</label>
                            <input type="text" name="hubungan_pemasok" value="{{ old('hubungan_pemasok') }}" class="w-full border rounded px-2 py-1 text-sm">
                        </div>
                    </div>

                    {{-- prev + submit --}}
                    <div class="mt-3 flex justify-between">
                        <button type="button" id="toInformasi" class="bg-gray-300 text-gray-800 px-4 py-2 rounded text-sm">Sebelumnya</button>
                        <div class="flex items-center gap-2">
                            <button type="reset" class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-sm">Reset</button>
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded text-sm">Simpan</button>
                        </div>
                    </div>
                </div>

            </div> <!-- end px-4 py-4 -->
        </form>
    </div>
</div>

{{-- JS tabs (ringkas) --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    const tabInformasiBtn = document.getElementById('tabInformasiBtn');
    const tabPemasokBtn = document.getElementById('tabPemasokBtn');
    const tabInformasi = document.getElementById('tabInformasi');
    const tabPemasok = document.getElementById('tabPemasok');

    const toPemasok = document.getElementById('toPemasok');
    const toInformasi = document.getElementById('toInformasi');

    function showInformasi() {
        tabInformasi.classList.remove('hidden');
        tabPemasok.classList.add('hidden');
        tabInformasiBtn.classList.add('bg-blue-600','text-white');
        tabInformasiBtn.classList.remove('bg-gray-100','text-gray-700');
        tabPemasokBtn.classList.remove('bg-blue-600','text-white');
        tabPemasokBtn.classList.add('bg-gray-100','text-gray-700');
    }

    function showPemasok() {
        tabPemasok.classList.remove('hidden');
        tabInformasi.classList.add('hidden');
        tabPemasokBtn.classList.add('bg-blue-600','text-white');
        tabPemasokBtn.classList.remove('bg-gray-100','text-gray-700');
        tabInformasiBtn.classList.remove('bg-blue-600','text-white');
        tabInformasiBtn.classList.add('bg-gray-100','text-gray-700');
    }

    tabInformasiBtn.addEventListener('click', showInformasi);
    tabPemasokBtn.addEventListener('click', showPemasok);

    toPemasok.addEventListener('click', showPemasok);
    toInformasi.addEventListener('click', showInformasi);

    // minimal validation before moving to pemasok tab
    document.getElementById('toPemasok').addEventListener('click', function(e){
        // check required inputs in informasi tab
        const required = ['id_ternak','jenis','kategori','umur','jenis_kelamin','harga_beli','kondisi','lokasi','tanggal_masuk'];
        let ok = true;
        for (let name of required) {
            const el = document.querySelector(`[name="${name}"]`);
            if (!el) continue;
            if (!el.value) { ok = false; break; }
        }
        if (!ok) {
            alert('Harap lengkapi semua field wajib di Informasi Umum sebelum melanjutkan.');
            showInformasi();
            return;
        }
        showPemasok();
    });
});
</script>
@endsection
