@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6" x-data="ternakForm()" @keydown.escape.window="resetForm()">

    <h1 class="text-3xl font-bold mb-6">Data Ternak</h1>

    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-4 gap-4">
        <div class="flex gap-2">
            <!-- Tombol tambah data buka modal -->
            <button type="button" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow" @click="showModal = true; initTabs()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Data
            </button>

            <button id="btn-edit" disabled
                class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white rounded shadow cursor-not-allowed opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2M12 14v7m6-7v7m-6-7H6" />
                </svg>
                Edit
            </button>

            <button id="btn-delete" disabled
                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded shadow cursor-not-allowed opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                Hapus
            </button>
        </div>

        <form method="GET" action="{{ route('ternak.index') }}" class="flex flex-col md:flex-row items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..." class="border rounded px-3 py-2 w-full md:w-48">

            <select name="filter_kategori" class="border rounded px-3 py-2 w-full md:w-40">
                <option value="">-- Kategori --</option>
                @foreach(['Domba','Kambing','Sapi','Ayam','Kerbau','Kuda'] as $cat)
                    <option value="{{ $cat }}" @selected(request('filter_kategori') == $cat)>{{ $cat }}</option>
                @endforeach
            </select>

            <select name="filter_umur" class="border rounded px-3 py-2 w-full md:w-32">
                <option value="">-- Umur (bln) --</option>
                <option value="0-6" @selected(request('filter_umur') == '0-6')>0-6</option>
                <option value="7-12" @selected(request('filter_umur') == '7-12')>7-12</option>
                <option value="13-24" @selected(request('filter_umur') == '13-24')>13-24</option>
                <option value="25+" @selected(request('filter_umur') == '25+')>25+</option>
            </select>

            <select name="filter_jenis_kelamin" class="border rounded px-3 py-2 w-full md:w-32">
                <option value="">-- Jenis Kelamin --</option>
                <option value="Jantan" @selected(request('filter_jenis_kelamin') == 'Jantan')>Jantan</option>
                <option value="Betina" @selected(request('filter_jenis_kelamin') == 'Betina')>Betina</option>
            </select>

            <select name="filter_kondisi" class="border rounded px-3 py-2 w-full md:w-32">
                <option value="">-- Kondisi --</option>
                <option value="Sehat" @selected(request('filter_kondisi') == 'Sehat')>Sehat</option>
                <option value="Sakit" @selected(request('filter_kondisi') == 'Sakit')>Sakit</option>
            </select>

            <select name="filter_lokasi" class="border rounded px-3 py-2 w-full md:w-40">
                <option value="">-- Lokasi --</option>
                @foreach(['Kandang A','Kandang B','Kandang C','Kandang D','Kandang E','Kandang F','Kandang G','Kandang H'] as $loc)
                    <option value="{{ $loc }}" @selected(request('filter_lokasi') == $loc)>{{ $loc }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded ml-0 md:ml-2">
                Filter
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <form id="multiDeleteForm" action="{{ route('ternak.destroyMultiple') }}" method="POST">
        @csrf
        @method('DELETE')

        <table class="w-full border border-gray-300 rounded overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2 text-center">
                        <input type="checkbox" id="selectAll" class="cursor-pointer">
                    </th>
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Kategori</th>
                    <th class="border p-2">Jenis Ternak</th>
                    <th class="border p-2">Lokasi</th>
                    <th class="border p-2">Umur (bulan)</th>
                    <th class="border p-2">Jenis Kelamin</th>
                    <th class="border p-2">Harga Beli</th>
                    <th class="border p-2">Kondisi</th>
                    <th class="border p-2">Tanggal Masuk</th>
                    <th class="border p-2">Vaksinasi</th>
                    <th class="border p-2">Cek Medis Terakhir</th>
                    <th class="border p-2">Pemasok</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ternak as $t)
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2 text-center">
                            <input type="checkbox" name="ids[]" value="{{ $t->id_ternak }}" class="checkbox cursor-pointer">
                        </td>
                        <td class="border p-2">{{ $t->id_ternak }}</td>
                        <td class="border p-2">{{ $t->kategori }}</td>
                        <td class="border p-2">{{ $t->jenis }}</td>
                        <td class="border p-2">{{ $t->lokasi }}</td>
                        <td class="border p-2">{{ $t->umur }}</td>
                        <td class="border p-2">{{ $t->jenis_kelamin }}</td>
                        <td class="border p-2">{{ number_format($t->harga_beli, 2, ',', '.') }}</td>
                        <td class="border p-2">{{ $t->kondisi }}</td>
                        <td class="border p-2">{{ $t->tanggal_masuk->format('d-m-Y') }}</td>
                        <td class="border p-2">{{ $t->vaksinasi }}</td>
                        <td class="border p-2">{{ $t->cek_medis_terakhir ? $t->cek_medis_terakhir->format('d-m-Y') : '-' }}</td>
                        <td class="border p-2">{{ $t->pemasok?->nama_pemasok ?? '-' }}</td>
                        <td class="border p-2 text-center whitespace-nowrap">
                            <a href="{{ route('ternak.edit', $t->id_ternak) }}" 
                               class="inline-block bg-yellow-400 hover:bg-yellow-500 text-white px-2 py-1 rounded mr-1" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h2M12 14v7m6-7v7m-6-7H6" />
                                </svg>
                            </a>

                            <form action="{{ route('ternak.destroy', $t->id_ternak) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin hapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded"
                                        title="Hapus">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="14" class="text-center p-4">Data ternak tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    <div class="mt-4">
        {{ $ternak->links() }}
    </div>

    <!-- Modal Tambah Data Ternak -->
    <div 
      class="modal fade" 
      tabindex="-1" 
      id="addTernakModal" 
      x-show="showModal" 
      @keydown.escape.window="showModal = false; resetForm()" 
      @click.away="showModal = false; resetForm()" 
      style="display: none;"
      x-transition
      x-cloak
    >
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content" @click.stop>
          <form x-ref="form" @submit.prevent="submitForm" action="{{ route('ternak.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @csrf
            <div class="modal-header">
              <h5 class="modal-title">Tambah Data Ternak</h5>
              <button type="button" class="btn-close" @click="showModal = false; resetForm()"></button>
            </div>

            <div class="modal-body">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs">
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" :class="currentTab === 1 ? 'active' : ''" @click="currentTab = 1">Informasi Umum</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button type="button" class="nav-link" :class="currentTab === 2 ? 'active' : ''" @click="currentTab = 2">Pilih Pemasok</button>
                </li>
              </ul>

              <!-- Tab content -->
              <div class="tab-content pt-3">
                <!-- Tab 1: Informasi Umum -->
                <div class="tab-pane" :class="currentTab === 1 ? 'show active' : ''">
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label for="id_ternak" class="form-label">ID Ternak <sup class="text-danger">*</sup></label>
                      <input type="text" class="form-control" name="id_ternak" id="id_ternak" x-model="form.id_ternak" required>
                    </div>
                    <div class="col-md-6">
                      <label for="jenis" class="form-label">Jenis Ternak <sup class="text-danger">*</sup></label>
                      <input type="text" class="form-control" name="jenis" id="jenis" x-model="form.jenis" required>
                    </div>
                    <div class="col-md-6">
                      <label for="kategori" class="form-label">Kategori <sup class="text-danger">*</sup></label>
                      <select name="kategori" id="kategori" class="form-select" x-model="form.kategori" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="Domba/Kambing">Domba/Kambing</option>
                        <option value="Sapi">Sapi</option>
                        <option value="Kerbau">Kerbau</option>
                        <option value="Ayam">Ayam</option>
                        <option value="Kuda">Kuda</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="umur" class="form-label">Usia (Bulan) <sup class="text-danger">*</sup></label>
                      <input type="number" class="form-control" name="umur" id="umur" x-model="form.umur" min="0" required>
                    </div>
                    <div class="col-md-6">
                      <label for="jenis_kelamin" class="form-label">Jenis Kelamin <sup class="text-danger">*</sup></label>
                      <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" x-model="form.jenis_kelamin" required>
                        <option value="">-- Pilih Jenis Kelamin --</option>
                        <option value="Jantan">Jantan</option>
                        <option value="Betina">Betina</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="harga_beli" class="form-label">Harga Beli <sup class="text-danger">*</sup></label>
                      <input type="number" step="0.01" class="form-control" name="harga_beli" id="harga_beli" x-model="form.harga_beli" required>
                    </div>
                    <div class="col-md-6">
                      <label for="kondisi" class="form-label">Kondisi <sup class="text-danger">*</sup></label>
                      <select name="kondisi" id="kondisi" class="form-select" x-model="form.kondisi" required>
                        <option value="">-- Pilih Kondisi --</option>
                        <option value="Sehat">Sehat</option>
                        <option value="Sakit">Sakit</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="lokasi" class="form-label">Lokasi <sup class="text-danger">*</sup></label>
                      <select name="lokasi" id="lokasi" class="form-select" x-model="form.lokasi" required>
                        <option value="">-- Pilih Lokasi --</option>
                        <option value="Kandang A">Kandang A</option>
                        <option value="Kandang B">Kandang B</option>
                        <option value="Kandang C">Kandang C</option>
                        <option value="Kandang D">Kandang D</option>
                        <option value="Kandang E">Kandang E</option>
                        <option value="Kandang F">Kandang F</option>
                        <option value="Kandang G">Kandang G</option>
                        <option value="Kandang H">Kandang H</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label for="tanggal_masuk" class="form-label">Tanggal Masuk <sup class="text-danger">*</sup></label>
                      <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" x-model="form.tanggal_masuk" required>
                    </div>
                    <div class="col-md-6">
                      <label for="cek_medis_terakhir" class="form-label">Tanggal Cek Medis Terakhir</label>
                      <input type="date" class="form-control" name="cek_medis_terakhir" id="cek_medis_terakhir" x-model="form.cek_medis_terakhir">
                    </div>
                    <div class="col-md-12">
                      <label for="vaksinasi" class="form-label">Daftar Vaksinasi</label>
                      <textarea class="form-control" name="vaksinasi" id="vaksinasi" rows="2" x-model="form.vaksinasi"></textarea>
                    </div>
                    <div class="col-md-12">
                      <label for="foto" class="form-label">Foto Ternak</label>
                      <input type="file" class="form-control" name="foto" id="foto" @change="handleFileUpload" accept="image/*">
                    </div>
                  </div>
                </div>

                <!-- Dropdown pilih pemasok -->
                        <select name="pemasok_id" id="pemasok_id" class="form-select" x-model="form.pemasok_id" required>
                        <option value="">-- Pilih Pemasok --</option>
                            @foreach($pemasok as $p)
                            <option value="{{ $p->id }}">{{ $p->nama_pemasok }}</option>
                            @endforeach
                        </select>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" @click="showModal = false; resetForm()">Tutup</button>
              <button type="submit" class="btn btn-primary" :disabled="loading">
                <span x-show="!loading">Simpan</span>
                <span x-show="loading">Menyimpan...</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<script>
function ternakForm() {
    return {
        showModal: false,
        currentTab: 1,
        loading: false,
        form: {
            id_ternak: '',
            jenis: '',
            kategori: '',
            umur: '',
            jenis_kelamin: '',
            harga_beli: '',
            kondisi: '',
            lokasi: '',
            tanggal_masuk: '',
            cek_medis_terakhir: '',
            vaksinasi: '',
            pemasok_id: '',
            foto: null,
        },
        initTabs() {
            this.currentTab = 1;
        },
        resetForm() {
            this.showModal = false;
            this.currentTab = 1;
            this.loading = false;
            this.form = {
                id_ternak: '',
                jenis: '',
                kategori: '',
                umur: '',
                jenis_kelamin: '',
                harga_beli: '',
                kondisi: '',
                lokasi: '',
                tanggal_masuk: '',
                cek_medis_terakhir: '',
                vaksinasi: '',
                pemasok_id: '',
                foto: null,
            };
            this.$refs.form.reset();
        },
        handleFileUpload(event) {
            this.form.foto = event.target.files[0];
        },
        submitForm() {
            // Validasi sederhana
            if(!this.form.id_ternak || !this.form.jenis || !this.form.kategori || !this.form.umur || !this.form.jenis_kelamin ||
               !this.form.harga_beli || !this.form.kondisi || !this.form.lokasi || !this.form.tanggal_masuk || !this.form.pemasok_id) {
                alert('Harap isi semua field wajib (*)');
                return;
            }

            this.loading = true;

            const formData = new FormData();

            for (const key in this.form) {
                if (this.form[key] !== null) {
                    formData.append(key, this.form[key]);
                }
            }

            fetch("{{ route('ternak.store') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData,
            })
            .then(response => {
                this.loading = false;
                if(!response.ok) throw new Error('Gagal menyimpan data');
                return response.json();
            })
            .then(data => {
                if(data.success) {
                    alert('Data ternak berhasil ditambahkan');
                    this.resetForm();
                    this.showModal = false;
                    // Reload halaman untuk update tabel (atau bisa kamu ganti dengan update tabel AJAX)
                    window.location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(err => {
                alert(err.message);
                this.loading = false;
            });
        }
    }
}

// Handle checkbox select all dan toggle tombol edit/hapus
document.addEventListener('alpine:init', () => {
    Alpine.data('ternakForm', () => ({
        // kosong karena sudah di atas
    }));

    // Select all checkbox
    document.getElementById('selectAll').addEventListener('change', function(e) {
        const checked = e.target.checked;
        document.querySelectorAll('.checkbox').forEach(chk => chk.checked = checked);
        toggleActionButtons();
    });

    // Toggle action buttons enabled state based on selection
    function toggleActionButtons() {
        const anyChecked = document.querySelectorAll('.checkbox:checked').length > 0;
        document.getElementById('btn-edit').disabled = !anyChecked;
        document.getElementById('btn-delete').disabled = !anyChecked;
        if(anyChecked){
            document.getElementById('btn-edit').classList.remove('cursor-not-allowed', 'opacity-50');
            document.getElementById('btn-delete').classList.remove('cursor-not-allowed', 'opacity-50');
        } else {
            document.getElementById('btn-edit').classList.add('cursor-not-allowed', 'opacity-50');
            document.getElementById('btn-delete').classList.add('cursor-not-allowed', 'opacity-50');
        }
    }

    document.querySelectorAll('.checkbox').forEach(chk => {
        chk.addEventListener('change', toggleActionButtons);
    });
});
</script>
@endsection
