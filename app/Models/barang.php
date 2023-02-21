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
        $allData=barang::where('nomor_surat', 'like', '%'.$search.'%')
        ->orWhere('judul_surat', 'like', '%'.$search.'%')
        ->orWhere('kategori', 'like', '%'.$search.'%')
        ->orWhere('tanggal_keluar', 'like', '%'.$search.'%')
        ->orWhere('tujuan_surat', 'like', '%'.$search.'%')
        ->orWhere('keterangan', 'like', '%'.$search.'%')
        ->get();
        return $allData;
    }
}
