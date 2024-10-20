<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kwitansi extends Model
{
    use HasFactory;

    protected $table = 'tr_kwitansi'; 

    protected $primaryKey = 'id_kwitansi';

    protected $fillable = [
        'id_sppd','id_tr_sppd_pegawai','no_kwitansi','total_harian','total_transport','total_akomodasi',
        'total_kwitansi','lama_perjalanan','biaya_transport','lama_akomodasi','uang_hari',
        'uang_transport','uang_akomodasi'
    ];

    public $timestamps = false;

    public function sppd()
    {
        return $this->belongsTo(TrSppd::class, 'id_sppd');
    }

    public function sppdPegawai()
    {
        return $this->belongsTo(TrSppdPegawai::class, 'id_tr_sppd_pegawai');
    }
}
