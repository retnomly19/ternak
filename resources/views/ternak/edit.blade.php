@extends('layouts.app')

@section('header')
<h2 class="text-2xl font-bold text-gray-800 mb-1 text-center">Edit Data Ternak</h2>
@endsection

@section('content')
<div class="max-w-2xl mx-auto -mt-2 py-6"> {{-- Lebar kotak lebih kecil --}}
    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('ternak.update', $ternak->id_ternak) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Tabs --}}
            <div class="mb-4 flex justify-center border-b border-gray-200">
                <button type="button" class="tab-button bg-blue-600 text-white px-4 py-2 rounded-t mx-1" data-tab="tabUmum">Informasi Umum</button>
                <button type="button" class="tab-button bg-gray-100 px-4 py-2 rounded-t mx-1" data-tab="tabPemasok">Kontak Pemasok</button>
            </div>

            {{-- Tab: Informasi Umum --}}
            <div id="tabUmum" class="tab-content block">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 justify-items-center">
                    {{-- Kolom Kiri --}}
                    <div class="w-full">
                        <label class="block text-sm font-semibold text-gray-700">ID Ternak</label>
                        <input type="text" name="id_ternak" value="{{ $ternak->id_ternak }}" readonly
                               class="w-full max-w-xs mt-1 px-3 py-2 border rounded bg-gray-100 cursor-not-allowed">

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Kategori</label>
                        <select name="kategori" class="w-full max-w-xs mt-1 px-3 py-2 border rounded" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach(['Domba','Kambing','Sapi','Ayam','Kerbau','Kuda'] as $cat)
                                <option value="{{ $cat }}" {{ $ternak->kategori == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Jenis Ternak</label>
                        <input type="text" name="jenis" value="{{ $ternak->jenis }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded" required>

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Lokasi</label>
                        <select name="lokasi" class="w-full max-w-xs mt-1 px-3 py-2 border rounded" required>
                            <option value="">-- Pilih Lokasi --</option>
                            @foreach(['Kandang A','Kandang B','Kandang C','Kandang D','Kandang E','Kandang F','Kandang G','Kandang H'] as $loc)
                                <option value="{{ $loc }}" {{ $ternak->lokasi == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                            @endforeach
                        </select>

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Umur (bulan)</label>
                        <input type="number" name="umur" min="0" value="{{ $ternak->umur }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded" required>

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full max-w-xs mt-1 px-3 py-2 border rounded" required>
                            <option value="">-- Pilih --</option>
                            <option value="Jantan" {{ $ternak->jenis_kelamin == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                            <option value="Betina" {{ $ternak->jenis_kelamin == 'Betina' ? 'selected' : '' }}>Betina</option>
                        </select>

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Harga Beli</label>
                        <input type="number" name="harga_beli" step="0.01" min="0" value="{{ $ternak->harga_beli }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded" required>
                    </div>

                    {{-- Kolom Kanan --}}
                    <div class="w-full">
                        <label class="block text-sm font-semibold text-gray-700">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" value="{{ $ternak->tanggal_masuk->format('Y-m-d') }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded">

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Daftar Vaksinasi</label>
                        <input type="text" name="vaksinasi" value="{{ $ternak->vaksinasi }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded">

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Tanggal Cek Medis Terakhir</label>
                        <input type="date" name="cek_medis_terakhir" value="{{ $ternak->cek_medis_terakhir ? $ternak->cek_medis_terakhir->format('Y-m-d') : '' }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded">

                        <label class="block text-sm font-semibold text-gray-700 mt-2">Kondisi</label>
                        <select name="kondisi" class="w-full max-w-xs mt-1 px-3 py-2 border rounded" required>
                            <option value="">-- Pilih --</option>
                            <option value="Sehat" {{ $ternak->kondisi == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                            <option value="Sakit" {{ $ternak->kondisi == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                        </select>

                        {{-- Foto --}}
                        <div class="mt-2">
                            <label class="block text-sm font-semibold text-gray-700">Foto Ternak</label>
                            @if($ternak->foto)
                                <img src="{{ asset('storage/'.$ternak->foto) }}" alt="Foto Ternak" class="w-32 h-32 object-cover mb-2 rounded mx-auto">
                            @endif
                            <input type="file" name="foto" class="w-full max-w-xs mt-1" accept="image/*">
                        </div>

                        {{-- Tombol Simpan --}}
                        <div class="mt-2">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tab: Kontak Pemasok --}}
            <div id="tabPemasok" class="tab-content hidden mt-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 justify-items-center">
                    <div class="w-full">
                        <label class="block text-sm font-semibold text-gray-700">Nama Pemasok</label>
                        <input type="text" name="nama_pemasok" value="{{ $ternak->pemasok->nama ?? '' }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded">
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-semibold text-gray-700">Alamat Pemasok</label>
                        <input type="text" name="alamat_pemasok" value="{{ $ternak->pemasok->alamat ?? '' }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded">
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-semibold text-gray-700">Telepon Pemasok</label>
                        <input type="text" name="telepon_pemasok" value="{{ $ternak->pemasok->telepon ?? '' }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded">
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-semibold text-gray-700">Hubungan Pemasok</label>
                        <input type="text" name="hubungan_pemasok" value="{{ $ternak->pemasok->hubungan ?? '' }}" class="w-full max-w-xs mt-1 px-3 py-2 border rounded">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- JS Tab --}}
<script>
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            tabContents.forEach(tc => tc.classList.add('hidden'));
            tabContents.forEach(tc => tc.classList.remove('block'));
            document.getElementById(btn.dataset.tab).classList.remove('hidden');
            document.getElementById(btn.dataset.tab).classList.add('block');

            tabButtons.forEach(b => b.classList.replace('bg-blue-600','bg-gray-200'));
            btn.classList.replace('bg-gray-100','bg-blue-600');
            btn.classList.replace('bg-gray-200','bg-blue-600');
        });
    });

    document.getElementById('tabUmum').classList.add('block');
</script>
@endsection
