<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    protected $table = 'SuratMasuk';
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'judul_surat',
        'kategori',
        'tanggal_masuk',
        'asal_surat',
        'keterangan',
        'lampiran'
    ];

    public static function search($search){
        $allData=SuratMasuk::where('nomor_surat', 'like', '%'.$search.'%')
        ->orWhere('judul_surat', 'like', '%'.$search.'%')
        ->orWhere('kategori', 'like', '%'.$search.'%')
        ->orWhere('tanggal_masuk', 'like', '%'.$search.'%')
        ->orWhere('asal_surat', 'like', '%'.$search.'%')
        ->orWhere('keterangan', 'like', '%'.$search.'%')
        ->get();
        return $allData;
    }
}
