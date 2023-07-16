<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Model;

class ItemSupplier extends Model
{
    protected $table = 'item_supplier';
    public $timestamps = false;
    protected $fillable = [
        'id_supplier',
        'id_barang',
        'total_kertas',
        'harga',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }
    public function getSubtotalAttribute()
    {
        return $this->total_kertas * $this->harga;
    }
}