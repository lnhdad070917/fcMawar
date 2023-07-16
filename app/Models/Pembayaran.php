<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
    protected $fillable = [
        'id_transaksi',
        'total_bayar',
        'tgl_bayar',
    ];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiPembayaran::class, 'id_transaksi');
    }
}