@extends('layouts.app')

@section('header')
    <div class="flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-800">
            {{ __('Dashboard') }}
        </h2>

        <!-- Dropdown Profil -->
        <div class="relative" x-data="{ open: false }">
            <!-- Trigger Avatar -->
            <button @click="open = !open" class="focus:outline-none flex items-center space-x-2">
                <img src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                     alt="Foto Profil"
                     class="w-10 h-10 rounded-full object-cover border-2 border-gray-300">
            </button>

            <!-- Dropdown Form -->
            <div x-show="open" @click.away="open = false"
                class="absolute right-0 mt-2 w-72 bg-white rounded-lg shadow-lg p-5 z-50 space-y-4">

                <!-- Foto Profil -->
                <div class="text-center">
                    <img class="w-20 h-20 rounded-full mx-auto object-cover"
                        src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                        alt="Foto Profil">
                    <h3 class="mt-2 font-semibold text-lg">{{ Auth::user()->name }}</h3>
                </div>

                <!-- Info -->
                <div class="text-sm text-gray-600">
                    <p><strong>Pekerjaan:</strong> Peternak</p>
                    <p><strong>WA:</strong> {{ Auth::user()->telepon ?? '-' }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>

                <!-- Form Update -->
                <form action="{{ route('profile.update.custom') }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium">Ganti Foto</label>
                        <input type="file" name="photo" class="w-full text-sm mt-1" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Nama</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}"
                            class="w-full px-3 py-2 border rounded" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium">No. WA</label>
                        <input type="text" name="telepon" value="{{ Auth::user()->telepon }}"
                            class="w-full px-3 py-2 border rounded" />
                    </div>

                    <div class="text-right">
                        <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg p-8 text-center">
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Welcome in Ternak Pro</h1>
                <p class="text-sm text-gray-600 mb-6">An integrated farm and agriculture process tools</p>
                <img src="/images/dashboard.jpeg" alt="Dashboard Image" class="mx-auto rounded shadow-md max-w-full">
            </div>
        </div>
    </div>
@endsection
