<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ternak;
use Illuminate\Support\Facades\Storage;

class TernakController extends Controller
{
    public function index()
    {
        $ternak = Ternak::all();
        return view('data-ternak', compact('ternak'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_ternak' => 'required|string',
            'jenis_ternak' => 'required|string',
            'jenis_kelamin' => 'required|in:Jantan,Betina',
            'usia_ternak' => 'required|integer',
            'harga_beli' => 'required|integer',
            'kondisi' => 'required|string',
            'tanggal_masuk' => 'required|date',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',

            // Optional fields
            'vaksinasi' => 'nullable|string',
            'tanggal_cek_medis' => 'nullable|date',
            'nama_pemasok' => 'required|string',
            'alamat_pemasok' => 'nullable|string',
            'telepon_pemasok' => 'nullable|string',
            'hubungan_pemasok' => 'required|string',
        ]);

        // Simpan foto
        $filename = $request->file('foto')->store('foto_ternak', 'public');

        // Simpan ke database
        Ternak::create([
            'id_ternak' => $request->id_ternak,
            'jenis' => $request->jenis_ternak,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->usia_ternak,
            'harga_beli' => $request->harga_beli,
            'kondisi' => $request->kondisi,
            'tanggal_masuk' => $request->tanggal_masuk,
            'foto' => basename($filename),
            'vaksinasi' => $request->vaksinasi,
            'tanggal_cek_medis' => $request->tanggal_cek_medis,
            'nama_pemasok' => $request->nama_pemasok,
            'alamat_pemasok' => $request->alamat_pemasok,
            'telepon_pemasok' => $request->telepon_pemasok,
            'hubungan' => $request->hubungan_pemasok,
        ]);

        return redirect()->route('ternak.index')->with('success', 'Data ternak berhasil ditambahkan.');
    }
}
