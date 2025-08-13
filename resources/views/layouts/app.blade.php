<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md hidden md:block">
            <div class="p-6">
                <h1 class="text-xl font-bold text-gray-800">🌾🐄TernakApp</h1>
            </div>
            <nav class="px-4">
                <ul class="space-y-2">
                    <li><a href="{{ route('dashboard') }}" class="block py-2 px-3 rounded hover:bg-gray-200">☷ Dashboard</a></li>
                    <li><a href="{{ route('ternak.index') }}" class="block py-2 px-3 rounded hover:bg-gray-200 font-semibold bg-gray-200">🗁 Data Ternak</a></li>
                    <li><a href="{{ route('aktivitas.index') }}" class="block py-2 px-3 rounded hover:bg-gray-200">𓃵 Aktivitas</a></li>
                    <li><a href="{{ route('laporan.index') }}" class="block py-2 px-3 rounded hover:bg-gray-200">✎ᝰ Laporan</a></li>
                    <li><a href="{{ route('kandang.index') }}" class="block py-2 px-3 rounded hover:bg-gray-200">ᝰ Data Kandang</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left py-2 px-3 rounded hover:bg-gray-200">⇄ Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-6">
                    @yield('header')
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-auto bg-gray-50">
                <div class="max-w-7xl mx-auto">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

</body>
</html>
