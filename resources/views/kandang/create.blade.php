@extends('layouts.app')

@section('header')
<h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Tambah Kandang</h2>
@endsection

@section('content')
<div class="max-w-4xl mx-auto py-6">
    <div class="bg-white p-6 rounded shadow">
        <form action="{{ route('kandang.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label class="block text-sm font-semibold text-gray-700">ID Kandang</label>
                    <input type="text" name="id_kandang" value="{{ old('id_kandang') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Nama Kandang</label>
                    <input type="text" name="nama" value="{{ old('nama') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Lokasi (Desa)</label>
                    <input type="text" name="lokasi" value="{{ old('lokasi') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700">Penanggung Jawab</label>
                    <input type="text" name="penanggung_jawab" value="{{ old('penanggung_jawab') }}" class="w-full mt-1 px-3 py-2 border rounded" required>
                </div>

                {{-- Jenis Ternak Multi Select dengan Card --}}
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis Ternak</label>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                        @foreach(['Domba','Kambing','Sapi','Ayam','Kerbau','Kuda'] as $jenis)
                        <label class="flex items-center bg-gray-100 p-2 rounded cursor-pointer hover:bg-gray-200">
                            <input type="checkbox" name="jenis_ternak[]" value="{{ $jenis }}" class="mr-2"
                            {{ (is_array(old('jenis_ternak')) && in_array($jenis, old('jenis_ternak'))) ? 'checked' : '' }}>
                            {{ $jenis }}
                        </label>
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="mt-6 text-right">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan Kandang</button>
            </div>
        </form>
    </div>
</div>
@endsection
