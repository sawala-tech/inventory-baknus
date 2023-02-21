<?php

namespace App\Exports;

use App\Models\SuratKeluar;
use Maatwebsite\Excel\Concerns\FromCollection;

class suratKeluarExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $search;
    public function __construct(string $search)
    {
        $this->search = $search;
    }

    public function collection()
    {   
        $allData;
        if($this->search!=null || $this->search!=""){
            $allData=SuratKeluar::search($this->search);
        }else{
            $allData=SuratKeluar::all();
        }

        foreach($allData as $data){
            $data->getAttributes();
            if($data->file_surat!=null || $data->file_surat!=""){
                $data->file_surat = asset("/storage/lampiran/".$data->file_surat);
            }else{
                $data->file_surat = "Tidak Ada Lampiran";
            }
        }
        return collect([
            ['id','Nomor Surat', 'Judul Surat', 'Kategori', 'Tanggal Masuk', 'Asal Surat', 'Keterangan', 'Link Lampiran', 'Created At', 'Updated At'],
            $allData
        ]);
    }
}
