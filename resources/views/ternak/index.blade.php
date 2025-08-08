{{-- resources/views/ternak/index.blade.php --}}

@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">
            Data Ternak
        </h2>

        <div class="flex items-center space-x-2">
            <button @click="openModal = true"
                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">
                + Tambah Data Ternak
            </button>
            <button @click="openEdit = true"
                class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                ✎ Edit
            </button>
        </div>
    </div>
@endsection

@section('content')
<div x-data="{ openModal: false, openEdit: false, activeTab: 'umum' }">
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md rounded-lg p-6">
                <!-- Kategori Filter dan Search -->
                <div class="flex justify-between items-center mb-4">
                    <select class="border rounded px-3 py-2 text-sm">
                        <option value="">Semua Kategori</option>
                        <option value="domba">Domba</option>
                        <option value="kambing">Kambing</option>
                        <option value="sapi">Sapi</option>
                    </select>

                    <input type="text" placeholder="Cari ternak..." class="border px-3 py-2 rounded text-sm">
                </div>

                <!-- Tabel Ternak -->
<table class="min-w-full border text-sm">
    <thead class="bg-gray-100">
        <tr>
            <th class="px-4 py-2 border"></th>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">Foto</th>
            <th class="px-4 py-2 border">Jenis</th>
            <th class="px-4 py-2 border">Umur</th>
            <th class="px-4 py-2 border">Jenis Kelamin</th>
            <th class="px-4 py-2 border">Harga Beli</th>
            <th class="px-4 py-2 border">Kondisi</th>
            <th class="px-4 py-2 border">Vaksinasi</th>
            <th class="px-4 py-2 border">Tanggal Cek Medis</th>
            <th class="px-4 py-2 border">Tanggal Masuk</th>
            <th class="px-4 py-2 border">Last Update</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ternak as $item)
        <tr>
            <td class="border px-2 py-1 text-center">
                <input type="checkbox" name="selected[]" value="{{ $item->id }}">
            </td>
            <td class="border px-4 py-2">{{ $item->id }}</td>
            <td class="border px-4 py-2">
                @if($item->foto)
                    <img src="{{ asset($item->foto) }}" class="w-16 h-16 object-cover rounded">
                @else
                    -
                @endif
            </td>
            <td class="border px-4 py-2">{{ $item->jenis }}</td>
            <td class="border px-4 py-2">{{ $item->umur }} bulan</td>
            <td class="border px-4 py-2">{{ ucfirst($item->jenis_kelamin) }}</td>
            <td class="border px-4 py-2">Rp{{ number_format($item->harga_beli ?? 0, 0, ',', '.') }}</td>
            <td class="border px-4 py-2">{{ $item->kondisi ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $item->vaksinasi ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $item->tanggal_cek_medis ?? '-' }}</td>
            <td class="border px-4 py-2">{{ $item->tanggal_masuk }}</td>
            <td class="border px-4 py-2">{{ $item->updated_at->format('Y-m-d') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div x-show="openModal" x-cloak @click.away="openModal = false" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex justify-center items-center">
        <div class="bg-white w-full max-w-3xl p-6 rounded-lg shadow-lg overflow-y-auto max-h-[90vh]">

            <!-- Tab Header -->
            <div class="flex mb-4 border-b">
                <button class="px-4 py-2 font-semibold" :class="{ 'border-b-2 border-blue-500': activeTab === 'umum' }" @click="activeTab = 'umum'">Informasi Umum</button>
                <button class="px-4 py-2 font-semibold" :class="{ 'border-b-2 border-blue-500': activeTab === 'kontak' }" @click="activeTab = 'kontak'">Kontak Pemasok</button>
            </div>

            <form action="{{ route('ternak.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Informasi Umum -->
                <div x-show="activeTab === 'umum'" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">ID Ternak</label>
                        <input type="text" name="id" value="{{ $newId ?? '' }}" readonly class="w-full border px-3 py-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jenis Ternak</label>
                        <input type="text" name="jenis" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Umur (bulan)</label>
                        <input type="number" name="umur" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full border px-3 py-2 rounded">
                            <option value="jantan">Jantan</option>
                            <option value="betina">Betina</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Foto</label>
                        <input type="file" name="foto" class="w-full border px-3 py-2 rounded">
                    </div>
                </div>

                <!-- Kontak Pemasok -->
                <div x-show="activeTab === 'kontak'" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium">Nama Pemasok</label>
                        <input type="text" name="nama_pemasok" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Nomor WA Pemasok</label>
                        <input type="text" name="wa_pemasok" class="w-full border px-3 py-2 rounded">
                    </div>
                    <div>
                        <label class="block text-sm font-medium">Asal Pemasok</label>
                        <input type="text" name="asal_pemasok" class="w-full border px-3 py-2 rounded">
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <button type="button" @click="openModal = false" class="bg-gray-300 text-black px-4 py-2 rounded hover:bg-gray-400">Batal</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
