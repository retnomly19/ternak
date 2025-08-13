@extends('layouts.app')

@section('header')
<h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Data Kandang</h2>
@endsection

@section('content')
<div class="max-w-6xl mx-auto py-6">

    @if(session('success'))
        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex mb-4 gap-2">
        <a href="{{ route('kandang.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center gap-1">
            <span>+</span> Tambah Kandang
        </a>
    </div>

    <table class="w-full border border-gray-300">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-1">ID Kandang</th>
                <th class="border px-2 py-1">Nama</th>
                <th class="border px-2 py-1">Lokasi</th>
                <th class="border px-2 py-1">Penanggung Jawab</th>
                <th class="border px-2 py-1">Jenis Ternak</th>
                <th class="border px-2 py-1">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kandang as $k)
            <tr>
                <td class="border px-2 py-1">{{ $k->id_kandang }}</td>
                <td class="border px-2 py-1">{{ $k->nama }}</td>
                <td class="border px-2 py-1">{{ $k->lokasi }}</td>
                <td class="border px-2 py-1">{{ $k->penanggung_jawab }}</td>
                <td class="border px-2 py-1">{{ $k->jenis_ternak }}</td>
                <td class="border px-2 py-1 text-center flex justify-center gap-2">
                    <a href="{{ route('kandang.edit', $k->id_kandang) }}" class="text-yellow-500 hover:text-yellow-700">✎</a>
                    <form action="{{ route('kandang.destroy', $k->id_kandang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">🗑</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
