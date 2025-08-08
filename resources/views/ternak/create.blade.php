@extends('layouts.app')

@section('header')
    <h2 class="text-lg font-semibold text-gray-800">Tambah Data Ternak</h2>
@endsection

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('ternak.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- ID Ternak (Otomatis) -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">ID Ternak</label>
                <input type="text" name="id" value="{{ $newId }}" readonly
                       class="w-full mt-1 px-3 py-2 border rounded bg-gray-100 cursor-not-allowed">
            </div>

            <!-- Foto -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Foto Ternak</label>
                <input type="file" name="foto" class="w-full mt-1" required>
            </div>

            <!-- Jenis -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Jenis Ternak</label>
                <input type="text" name="jenis" value="{{ old('jenis') }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Umur -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Usia (bulan)</label>
                <input type="number" name="umur" min="0" value="{{ old('umur') }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Jenis Kelamin -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih --</option>
                    <option value="Jantan" {{ old('jenis_kelamin') == 'Jantan' ? 'selected' : '' }}>Jantan</option>
                    <option value="Betina" {{ old('jenis_kelamin') == 'Betina' ? 'selected' : '' }}>Betina</option>
                </select>
            </div>

            <!-- Harga Beli -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Harga Beli</label>
                <input type="number" name="harga_beli" min="0" value="{{ old('harga_beli') }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Kondisi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Kondisi</label>
                <select name="kondisi" class="w-full mt-1 px-3 py-2 border rounded" required>
                    <option value="">-- Pilih --</option>
                    <option value="Sehat" {{ old('kondisi') == 'Sehat' ? 'selected' : '' }}>Sehat</option>
                    <option value="Sakit" {{ old('kondisi') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                    <option value="Luka" {{ old('kondisi') == 'Luka' ? 'selected' : '' }}>Luka</option>
                </select>
            </div>

            <!-- Tanggal Masuk -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Tanggal Masuk</label>
                <input type="date" name="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                       class="w-full mt-1 px-3 py-2 border rounded" required>
            </div>

            <!-- Vaksinasi -->
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700">Daftar Vaksinasi</label>
                <input type="text" name="vaksinasi" value="{{ old('vaksinasi') }}"
                       class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <!-- Tanggal Cek Medis -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700">Tanggal Cek Medis Terakhir</label>
                <input type="date" name="tanggal_cek_medis" value="{{ old('tanggal_cek_medis') }}"
                       class="w-full mt-1 px-3 py-2 border rounded">
            </div>

            <!-- Tombol Simpan -->
            <div class="text-right">
                <button type="submit"
                        class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
