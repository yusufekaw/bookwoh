<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tamu extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $primaryKey = "id_tamu";
    protected $fillable = [
        'id_tamu',
        'nama',
        'alamat',
        'keterangan',
        'gender',
        'id_tuanrumah',
    ];
}
