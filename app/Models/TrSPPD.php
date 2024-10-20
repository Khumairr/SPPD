<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrSPPD extends Model
{
    protected $table = 'tr_sppd';
    protected $primaryKey = 'id_sppd';
    protected $fillable = [
        'no_spt', 'ppk', 'perihal_sppd', 'angkutan', 'tujuan', 
        'tgl_berangkat', 'tgl_kembali', 'lama_perjalanan', 'tgl_spt', 'status'
    ];

    public $timestamps = false; // Nonaktifkan timestamps

    // Relasi ke TrSPPDPegawai
    public function pegawai()
    {
        return $this->hasMany(TrSPPDPegawai::class, 'id_sppd');
    }
}
