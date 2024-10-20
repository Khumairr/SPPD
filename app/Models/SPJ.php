<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SPJ extends Model
{
    use HasFactory;

    protected $table = 'spj';
    protected $primaryKey = 'no_kwitansi';  // Use no_kwitansi as the primary key
    public $incrementing = false;           // Disable auto-increment if no_kwitansi is not an integer
    protected $keyType = 'string';  
    public $timestamps = false;

    protected $fillable = [
        'no_kwitansi',
        'id_sppd',
        'file_spt',
        'file_spd',
        'file_visum',
        'file_laporan',
        'file_kwitansi',
        'file_poto',
        'file_notabensin',
    ];
}
