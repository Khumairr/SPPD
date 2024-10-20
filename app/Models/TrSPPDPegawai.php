<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrSPPDPegawai extends Model
{
    protected $table = 'tr_sppd_pegawai';
    protected $primaryKey = 'id_tr_sppd_pegawai';
    protected $fillable = ['id_sppd', 'id_staff', 'nama_tim'];

    public $timestamps = false; // Nonaktifkan timestamps

    // Relasi ke TrSPPD
    public function sppd()
    {
        return $this->belongsTo(TrSPPD::class, 'id_sppd');
    }
}
