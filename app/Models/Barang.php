<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nama_barang',
        'harga_satuan',
        'harga_rim',
        'stok',
    ];
}