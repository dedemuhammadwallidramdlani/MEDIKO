<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = ['obat_id', 'jumlah', 'tanggal_transaksi', 'total_harga'];

    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }
}
