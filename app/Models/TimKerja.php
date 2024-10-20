<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimKerja extends Model
{
    use HasFactory;

    protected $table = 'tim_kerja';
    protected $primaryKey = 'id_tim_kerja';
    public $incrementing = false; // Jika ini salah, bisa diubah ke true jika primary key auto-increment
    public $timestamps = false;

    protected $fillable = [
        'nama_tim',
        'anggaran_awal',
        'sisa_anggaran',
        'tahun_anggaran',
    ];
}
