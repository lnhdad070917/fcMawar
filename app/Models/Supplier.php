<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';
    public $timestamps = false;
    protected $fillable = [
        'nama_supplier',
        'no_nota',
    ];

    public function items()
    {
        return $this->hasMany(ItemSupplier::class, 'id_supplier');
    }
}