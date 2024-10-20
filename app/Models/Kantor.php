<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantor extends Model
{
    use HasFactory;

    protected $table = 'kantor';
    protected $primaryKey = 'id_kantor'; // Tentukan kolom primary key jika bukan id
    public $timestamps = false; // Nonaktifkan timestamps jika tidak digunakan

    protected $fillable = [
        'nama_kantor',
        'alamat_kantor',
        'uang_harian',
        'transport',
        'akomodasi',
    ];
}
