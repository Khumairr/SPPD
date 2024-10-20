<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Nama tabel di database
    protected $table = 'role';

    // Nama kolom primary key, jika menggunakan kolom 'id_role'
    protected $primaryKey = 'id_role';

    // Jika tabel tidak menggunakan created_at dan updated_at
    public $timestamps = false;

    // Atribut yang bisa diisi
    protected $fillable = ['nama_role']; // Pastikan kolom ini sesuai dengan struktur tabel
}
