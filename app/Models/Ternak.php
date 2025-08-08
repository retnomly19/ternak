<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ternak extends Model
{
    use HasFactory;

    protected $table = 'ternak';

    protected $primaryKey = 'id_ternak';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
    'id_ternak',
    'foto',
    'jenis',
    'umur',
    'jenis_kelamin',
    'harga_beli',
    'kondisi',
    'tanggal_masuk',
    'vaksinasi',
    'tanggal_cek_medis',
    'nama_pemasok',
    'alamat_pemasok',
    'telepon_pemasok',
    'hubungan_pemasok',
];

}
