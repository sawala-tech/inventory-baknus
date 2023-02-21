<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    protected $table = 'SuratKeluar';
    use HasFactory;

    protected $fillable = [
        'nomor_surat',
        'judul_surat',
        'kategori',
        'tanggal_keluar',
        'tujuan_surat',
        'keterangan',
        'lampiran'
    ];

    public static function search($search){
        $allData=SuratKeluar::where('nomor_surat', 'like', '%'.$search.'%')
        ->orWhere('judul_surat', 'like', '%'.$search.'%')
        ->orWhere('kategori', 'like', '%'.$search.'%')
        ->orWhere('tanggal_keluar', 'like', '%'.$search.'%')
        ->orWhere('tujuan_surat', 'like', '%'.$search.'%')
        ->orWhere('keterangan', 'like', '%'.$search.'%')
        ->get();
        return $allData;
    }
}
