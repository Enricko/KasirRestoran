<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tgl_pesanan',
        'id',
        'no_meja',
        'total_harga',
        'bayar',
        'kembalian',
        'status_pesanan',
        'status_makanan_pesanan'
    ];
}
