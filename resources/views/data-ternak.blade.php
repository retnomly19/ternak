@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Data Ternak</h1>
        <button id="openModal" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium">
            + Tambah Data Ternak
        </button>
    </div>

    <!-- Filter & Search -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-4">
        <div>
            <select id="kategoriDropdown" class="border rounded-md px-3 py-2">
                <option value="">Semua Kategori</option>
                <option value="domba">Domba</option>
                <option value="kambing">Kambing</option>
                <option value="sapi">Sapi</option>
                <option value="ayam">Ayam</option>
            </select>
        </div>
        <div class="relative">
            <input type="text" id="searchInput" placeholder="Cari..." class="border rounded-md pl-10 pr-4 py-2 w-full">
            <span class="absolute left-3 top-2.5 text-gray-400">
                <i class="fas fa-search"></i>
            </span>
        </div>
    </div>

    <!-- Tabel Data Ternak -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">
                        <input type="checkbox" id="checkAll">
                    </th>
                    <th class="px-4 py-2">Foto</th>
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Jenis</th>
                    <th class="px-4 py-2">Usia(Bulan)</th>
                    <th class="px-4 py-2">JK</th>
                    <th class="px-4 py-2">Harga Beli</th>
                    <th class="px-4 py-2">Kondisi</th>
                    <th class="px-4 py-2">Tanggal Masuk</th>
                    <th class="px-4 py-2">Last Update</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-4 py-2 text-center">
                        <input type="checkbox" class="row-check">
                    </td>
                    <td class="px-4 py-2">
                        <img src="https://via.placeholder.com/50" alt="Foto Ternak" class="rounded-md w-12 h-12 object-cover">
                    </td>
                    <td class="px-4 py-2">KMB001</td>
                    <td class="px-4 py-2">Kambing Jawa</td>
                    <td class="px-4 py-2">5 Bulan</td>
                    <td class="px-4 py-2">Jantan</td>
                    <td class="px-4 py-2">500.000</td>
                    <td class="px-4 py-2">Sehat</td>
                    <td class="px-4 py-2">2025-08-01</td>
                    <td class="px-4 py-2">2025-08-07</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


<!-- Modal Tambah Data Ternak -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-start z-50 hidden">
    <div class="bg-white rounded-lg w-full max-w-3xl p-6 min-h-[80vh] overflow-y-auto my-10">
        <div class="flex justify-center items-center border-b pb-3 mb-4 relative">
            <h2 class="text-xl font-bold">Tambah Data Ternak</h2>
            <button id="closeModal" class="text-red-500 text-xl absolute right-0">&times;</button>
        </div>

        <div>
            <ul class="flex justify-center border-b mb-4" id="tabMenu">
    <li class="mx-3">
        <button class="tab-link text-blue-600 font-medium border-b-2 border-blue-600 px-4 py-2" data-tab="informasiUmum">
            Informasi Umum
        </button>
    </li>
    <li class="mx-3">
        <button class="tab-link text-gray-600 font-medium px-4 py-2" data-tab="kontakPemasok">
            Kontak Pemasok
        </button>
    </li>
</ul>

            <form id="formTernak">
                <div id="informasiUmum" class="tab-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label>ID Ternak</label>
                            <input type="text" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Jenis Ternak</label>
                            <input type="text" placeholder="Masukkan jenis ternak" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Usia Ternak(Bulan)</label>
                            <input type="text" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Jenis Kelamin</label>
                            <select class="w-full border rounded px-3 py-2">
                                <option value="jantan">Jantan</option>
                                <option value="betina">Betina</option>
                            </select>
                        </div>
                        <div>
                            <label>Harga Beli</label>
                            <input type="number" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Kondisi</label>
                            <input type="text" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Tanggal Masuk</label>
                            <input type="date" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Daftar Vaksinasi</label>
                            <input type="text" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Tanggal Cek Medis Terakhir</label>
                            <input type="date" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Foto Ternak</label>
                            <input type="file" class="w-full border rounded px-3 py-2">
                        </div>
                    </div>
                </div>
                <div id="kontakPemasok" class="tab-content hidden">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label>Nama Pemasok</label>
                            <input type="text" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Alamat</label>
                            <textarea class="w-full border rounded px-3 py-2"></textarea>
                        </div>
                        <div>
                            <label>Telepon</label>
                            <input type="text" class="w-full border rounded px-3 py-2">
                        </div>
                        <div>
                            <label>Hubungan</label>
                            <select class="w-full border rounded px-3 py-2">
                                <option>Pihak Ketiga</option>
                                <option>Pihak Berelasi</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-4 text-right">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.tab-link').forEach(button => {
        button.addEventListener('click', () => {
            const tab = button.dataset.tab;
            document.querySelectorAll('.tab-link').forEach(btn => btn.classList.remove('text-blue-600', 'border-blue-600'));
            document.querySelectorAll('.tab-content').forEach(content => content.classList.add('hidden'));

            button.classList.add('text-blue-600', 'border-blue-600');
            document.getElementById(tab).classList.remove('hidden');
        });
    });

    document.getElementById('openModal').addEventListener('click', () => {
        document.getElementById('modal').classList.remove('hidden');
    });

    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('modal').classList.add('hidden');
    });
</script>
@endsection
