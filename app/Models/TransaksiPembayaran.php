<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPembayaran extends Model
{
    protected $table = 'transaksi_pembayaran';
    protected $fillable = [
        'tgl_transaksi',
        'ket',
    ];

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_transaksi');
    }

    public function items()
    {
        return $this->hasMany(ItemTransaksi::class, 'id_transaksi');
    }
}