@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white shadow-lg rounded-lg overflow-hidden">
    <div class="flex flex-col items-center px-6 py-10">
        <!-- Foto Profil -->
        <form method="POST" action="{{ route('profile.update.custom') }}" enctype="multipart/form-data" class="w-full">
            @csrf
            <div class="mb-4 text-center">
                <img class="w-32 h-32 rounded-full object-cover mx-auto mb-4" 
                     src="{{ Auth::user()->foto ? asset('storage/' . Auth::user()->foto) : 'https://ui-avatars.com/api/?name='.Auth::user()->name }}" 
                     alt="Foto Profil">
                <input type="file" name="foto" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:border-0
                        file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"/>
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" value="{{ Auth::user()->name }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Username -->
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" value="{{ Auth::user()->username }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- No. Telepon -->
            <div class="mb-4">
                <label class="block text-gray-700">No. Telepon</label>
                <input type="text" name="telepon" value="{{ Auth::user()->telepon }}"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div class="text-center">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
 