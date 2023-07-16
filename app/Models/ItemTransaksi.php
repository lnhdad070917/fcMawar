<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemTransaksi extends Model
{
    protected $table = 'item_transaksi';
    protected $fillable = [
        'id_transaksi',
        'id_barang',
        'jml_barang',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
}