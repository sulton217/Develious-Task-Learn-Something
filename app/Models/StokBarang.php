<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'jumlah', 'kodebarang'
    ];
    public $table = "stokbarang";

}
