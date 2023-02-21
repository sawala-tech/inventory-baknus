<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    protected $table = 'barang';
    use HasFactory;

    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'tanggal_pembelian',
        'kategori',
        'keterangan',
        'foto'
    ];

    public static function search($search){
        $allData=barang::where('kode_barang', 'like', '%'.$search.'%')
        ->orWhere('nama_barang', 'like', '%'.$search.'%')
        ->orWhere('kategori', 'like', '%'.$search.'%')
        ->orWhere('tanggal_pembelian', 'like', '%'.$search.'%')
        ->orWhere('keterangan', 'like', '%'.$search.'%')
        ->get();
        return $allData;
    }
}
