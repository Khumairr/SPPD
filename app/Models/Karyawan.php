<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $table = 'karyawan';
    protected $primaryKey = 'id_staff'; // Pastikan ini sesuai
    public $incrementing = false; // Jika ID tidak auto-increment
    protected $keyType = 'string'; // Sesuaikan tipe kunci jika diperlukan

    // Nonaktifkan timestamps
    public $timestamps = false;

    protected $fillable = [
        'nip','nama_staff','golongan','jabatan',
    ];

}
