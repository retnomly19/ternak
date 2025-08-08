<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('profile.update.custom') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- Foto Profil -->
                    <div class="flex flex-col items-center">
                        @if(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="w-32 h-32 rounded-full object-cover mb-4">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" class="w-32 h-32 rounded-full object-cover mb-4">
                        @endif

                        <input type="file" name="profile_photo" class="mt-2">
                    </div>

                    <!-- Username -->
                    <div class="mt-4">
                        <x-label for="name" value="Username" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ Auth::user()->name }}" required />
                    </div>

                    <!-- WhatsApp -->
                    <div class="mt-4">
                        <x-label for="whatsapp" value="Nomor WhatsApp" />
                        <x-input id="whatsapp" class="block mt-1 w-full" type="text" name="whatsapp" value="{{ Auth::user()->whatsapp }}" />
                    </div>

                    <!-- Email (readonly, tidak bisa diubah) -->
                    <div class="mt-4">
                        <x-label for="email" value="Email" />
                        <x-input id="email" class="block mt-1 w-full bg-gray-100" type="email" name="email" value="{{ Auth::user()->email }}" readonly />
                    </div>

                    <!-- Submit -->
                    <div class="mt-6">
                        <x-button class="ml-3">
                            Simpan Perubahan
                        </x-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
