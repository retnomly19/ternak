@extends('layouts.app')

@section('header')
    <h2 class="text-lg font-semibold text-gray-800">Edit Data Ternak</h2>
@endsection

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('ternak.update', $ternak->id_ternak) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- ID Ternak (readonly) -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">ID Ternak</label>
                <input type="text" name="id_ternak" value="{{ $ternak->id_ternak }}" readonly
                       class="w-full mt-1 px-3 py-2 border rounded bg-gray-100 cursor-not-allowed">
            </div>

            <!-- Foto (preview dan upload baru) -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Foto Ternak</label>
                @if($ternak->foto)
                    <img src="{{ asset('storage/'.$ternak->foto) }}" alt="Foto Ternak" class="w-32 h-32 object-cover mb-2 rounded">
                @endif
                <input type="file" name="foto" class="w-full mt-1" accept="image/*">
            </div>

            <!-- Kategori -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Kategori</label>
                <select name="kategori" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach(['Domba','Kambing','Sapi','Kerbau','Ayam','Kuda'] as $kat)
                        <option value="{{ $kat }}" {{ old('kategori', $ternak->kategori) == $kat ? 'selected' : '' }}>{{ $kat }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Lokasi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Lokasi</label>
                <select name="lokasi" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih Lokasi --</option>
                    @foreach(['Kandang A','Kandang B','Kandang C','Kandang D','Kandang E','Kandang F','Kandang G','Kandang H'] as $loc)
                        <option value="{{ $loc }}" {{ old('lokasi', $ternak->lokasi) == $loc ? 'selected' : '' }}>{{ $loc }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Jenis Ternak</label>
                <input type="text" name="jenis" value="{{ old('jenis', $ternak->jenis) }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Umur -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Umur (bulan)</label>
                <input type="number" name="umur" min="0" value="{{ old('umur', $ternak->umur) }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih --</option>
                    <option value="Jantan" {{ old('jenis_kelamin', $ternak->jenis_kelamin) == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ old('jenis_kelamin', $ternak->jenis_kelamin) == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>

            <!-- Harga Beli -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Harga Beli</label>
                <input type="number" name="harga_beli" min="0" value="{{ old('harga_beli', $ternak->harga_beli) }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Kondisi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Kondisi</label>
                <select name="kondisi" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih --</option>
                    <option value="Sehat" {{ old('kondisi', $ternak->kondisi) == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                    <option value="Sakit" {{ old('kondisi', $ternak->kondisi) == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                </select>
            </div>

            <!-- Tanggal Masuk -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk', $ternak->tanggal_masuk) }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Vaksinasi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Daftar Vaksinasi</label>
                <input type="text" name="vaksinasi" value="{{ old('vaksinasi', $ternak->vaksinasi) }}"
                       class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <!-- Tanggal Cek Medis -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700">Tanggal Cek Medis Terakhir</label>
                <input type="date" name="cek_medis_terakhir" value="{{ old('cek_medis_terakhir', $ternak->cek_medis_terakhir) }}"
                       class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <!-- Nama Pemasok -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Nama Pemasok</label>
                <input type="text" name="nama_pemasok" value="{{ old('nama_pemasok', $ternak->nama_pemasok) }}" class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Alamat Pemasok -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Alamat Pemasok</label>
                <textarea name="alamat_pemasok" class="w-full mt-1 px-3 py-2 border rounded" rows="3" required>{{ old('alamat_pemasok', $ternak->alamat_pemasok) }}</textarea>
            </div>

            <!-- Telepon Pemasok -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Telepon Pemasok</label>
                <input type="text" name="telepon_pemasok" value="{{ old('telepon_pemasok', $ternak->telepon_pemasok) }}" class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Hubungan Pemasok -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700">Hubungan Pemasok</label>
                <select name="hubungan_pemasok" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih Hubungan --</option>
                    <option value="Pihak Ketiga" {{ old('hubungan_pemasok', $ternak->hubungan_pemasok) == 'Pihak Ketiga' ? 'selected' : '' }}>Pihak Ketiga</option>
                    <option value="Pihak Berelasi" {{ old('hubungan_pemasok', $ternak->hubungan_pemasok) == 'Pihak Berelasi' ? 'selected' : '' }}>Pihak Berelasi</option>
                </select>
            </div>

            <div class="text-right">
                <button type="submit" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
