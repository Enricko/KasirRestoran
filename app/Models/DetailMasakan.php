<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMasakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pesanan',
        'id_masakan',
        'qty',
        'sub_total',
        'keterangan_pesanan',
        'status'
    ];
}
