<!-- Modal Tambah Data Ternak -->
<div class="modal fade" id="modalTambahTernak" tabindex="-1" aria-labelledby="modalTambahTernakLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content rounded-4">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="modalTambahTernakLabel">Tambah Data Ternak</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="{{ route('ternak.store') }}" method="POST" enctype="multipart/form-data" id="formTambahTernak">
        @csrf
        <div class="modal-body">
          <!-- Tabs -->
          <ul class="nav nav-tabs mb-3" id="ternakTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="umum-tab" data-bs-toggle="tab" data-bs-target="#umum" type="button" role="tab" aria-controls="umum" aria-selected="true">
                Informasi Umum
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="pemasok-tab" data-bs-toggle="tab" data-bs-target="#pemasok" type="button" role="tab" aria-controls="pemasok" aria-selected="false">
                Kontak Pemasok
              </button>
            </li>
          </ul>

          <!-- Isi Tab -->
          <div class="tab-content" id="ternakTabContent">
            <!-- Informasi Umum -->
            <div class="tab-pane fade show active" id="umum" role="tabpanel" aria-labelledby="umum-tab">
              <div class="row g-3">
                <div class="col-md-6">
                  <label>ID Ternak</label>
                  <input type="text" name="id_ternak" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label>Jenis Ternak</label>
                  <select name="jenis" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Domba">Domba</option>
                    <option value="Kambing">Kambing</option>
                    <option value="Sapi">Sapi</option>
                    <option value="Ayam">Ayam</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Jantan">Jantan</option>
                    <option value="Betina">Betina</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Umur (bulan)</label>
                  <input type="number" name="umur" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label>Harga Beli</label>
                  <input type="number" name="harga_beli" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label>Kondisi</label>
                  <select name="kondisi" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Sehat">Sehat</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Luka">Luka</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Tanggal Masuk</label>
                  <input type="date" name="tanggal_masuk" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label>Daftar Vaksinasi</label>
                  <input type="text" name="vaksinasi" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Tanggal Cek Medis Terakhir</label>
                  <input type="date" name="tanggal_cek_medis" class="form-control">
                </div>
                <div class="col-md-12">
                  <label>Foto Ternak</label>
                  <input type="file" name="foto" class="form-control" accept="image/*" required>
                </div>
              </div>
            </div>

            <!-- Kontak Pemasok -->
            <div class="tab-pane fade" id="pemasok" role="tabpanel" aria-labelledby="pemasok-tab">
              <div class="row g-3">
                <div class="col-md-6">
                  <label>Nama Pemasok</label>
                  <input type="text" name="nama_pemasok" class="form-control" required>
                </div>
                <div class="col-md-6">
                  <label>Nomor Telepon</label>
                  <input type="text" name="telepon_pemasok" class="form-control">
                </div>
                <div class="col-md-6">
                  <label>Alamat</label>
                  <textarea name="alamat_pemasok" class="form-control" rows="2"></textarea>
                </div>
                <div class="col-md-6">
                  <label>Hubungan</label>
                  <select name="hubungan_pemasok" class="form-select" required>
                    <option value="">Pilih</option>
                    <option value="Pihak Ketiga">Pihak Ketiga</option>
                    <option value="Pihak Berelasi">Pihak Berelasi</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
