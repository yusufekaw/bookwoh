<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kado extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primaryKey = "id_kado";
    protected $fillable = [
        'id_kado',
        'barang',
        'qty',
        'satuan',
        'id_tamu',
    ];
}
