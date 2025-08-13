@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4 max-w-7xl">
    <h1 class="text-3xl font-bold mb-4">Data Ternak</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('ternak.index') }}" class="mb-4 flex flex-wrap gap-4 items-end">
        <div>
            <label for="search" class="block font-semibold mb-1 text-sm">Cari (ID, Jenis, Vaksinasi)</label>
            <input type="text" name="search" id="search" value="{{ request('search') }}"
                class="border rounded px-3 py-2 w-48" placeholder="Cari...">
        </div>

        <div>
            <label for="filter_kategori" class="block font-semibold mb-1 text-sm">Kategori</label>
            <select name="filter_kategori" id="filter_kategori" class="border rounded px-3 py-2 w-36">
                <option value="">-- Semua --</option>
                @foreach(['Domba', 'Kambing', 'Sapi', 'Kerbau', 'Ayam', 'Kuda'] as $cat)
                    <option value="{{ $cat }}" @selected(request('filter_kategori') == $cat)>{{ $cat }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="filter_lokasi" class="block font-semibold mb-1 text-sm">Lokasi</label>
            <select name="filter_lokasi" id="filter_lokasi" class="border rounded px-3 py-2 w-36">
                <option value="">-- Semua --</option>
                @foreach(['Kandang A','Kandang B','Kandang C','Kandang D','Kandang E','Kandang F','Kandang G','Kandang H'] as $loc)
                    <option value="{{ $loc }}" @selected(request('filter_lokasi') == $loc)>{{ $loc }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition text-sm">
                Filter
            </button>
        </div>

        <div>
            <a href="{{ route('ternak.index') }}" class="text-gray-600 hover:underline text-sm">Reset</a>
        </div>
    </form>

    <div class="mb-4">
        <a href="{{ route('ternak.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition text-sm">
            + Tambah Data Ternak
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200 table-auto text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2 text-left font-semibold">Foto</th>
                    <th class="px-3 py-2 text-left font-semibold">ID Ternak</th>
                    <th class="px-3 py-2 text-left font-semibold">Kategori</th>
                    <th class="px-3 py-2 text-left font-semibold">Jenis</th>
                    <th class="px-3 py-2 text-left font-semibold">Lokasi</th>
                    <th class="px-3 py-2 text-left font-semibold">Umur (bln)</th>
                    <th class="px-3 py-2 text-left font-semibold">Jenis Kelamin</th>
                    <th class="px-3 py-2 text-left font-semibold">Harga Beli</th>
                    <th class="px-3 py-2 text-left font-semibold">Kondisi</th>
                    <th class="px-3 py-2 text-left font-semibold">Tanggal Masuk</th>
                    <th class="px-3 py-2 text-left font-semibold">Vaksinasi</th>
                    <th class="px-3 py-2 text-left font-semibold">Cek Medis Terakhir</th>
                    <th class="px-3 py-2 text-left font-semibold">Pemasok</th>
                    <th class="px-3 py-2 text-center font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($ternak as $item)
                    <tr>
                        <td class="px-3 py-2">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto Ternak" class="w-12 h-12 object-cover rounded">
                            @else
                                <span class="text-gray-400">Tidak ada</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">{{ $item->id_ternak }}</td>
                        <td class="px-3 py-2">{{ $item->kategori }}</td>
                        <td class="px-3 py-2">{{ $item->jenis }}</td>
                        <td class="px-3 py-2">{{ $item->lokasi }}</td>
                        <td class="px-3 py-2">{{ $item->umur }}</td>
                        <td class="px-3 py-2">{{ $item->jenis_kelamin }}</td>
                        <td class="px-3 py-2">Rp {{ number_format($item->harga_beli, 2, ',', '.') }}</td>
                        <td class="px-3 py-2">{{ $item->kondisi }}</td>
                        <td class="px-3 py-2">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td class="px-3 py-2">{{ $item->vaksinasi ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $item->cek_medis_terakhir ? \Carbon\Carbon::parse($item->cek_medis_terakhir)->format('d/m/Y') : '-' }}</td>
                        <td class="px-3 py-2">{{ $item->pemasok->nama ?? '-' }}</td>
                        <td class="px-3 py-2 text-center">
                            <div class="flex justify-center space-x-2">
                                <!-- Edit icon -->
                                <a href="{{ route('ternak.edit', $item->id_ternak) }}" class="text-blue-600 hover:text-blue-800" title="Edit">
                                    ✏️
                                </a>
                                <!-- Delete icon -->
                                <form action="{{ route('ternak.destroy', $item->id_ternak) }}" method="POST" class="inline" onsubmit="return confirm('Yakin hapus data ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="px-3 py-6 text-center text-gray-500">
                            Data ternak tidak ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $ternak->withQueryString()->links() }}
    </div>
</div>
@endsection
