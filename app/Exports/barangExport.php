<?php

namespace App\Exports;

use App\Models\barang;
use Maatwebsite\Excel\Concerns\FromCollection;

class barangExport implements FromCollection
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
            $allData=barang::search($this->search);
        }else{
            $allData=barang::all();
        }

        foreach($allData as $data){
            $data->getAttributes();
            if($data->foto!=null || $data->foto!=""){
                $data->foto = asset("/storage/lampiran/".$data->foto);
            }else{
                $data->foto = "Tidak Ada Lampiran";
            }
        }
        return collect([
            ['id','Kode Barang', 'Nama Barang', 'Tanggal Pembelian', 'Kategori', 'Keterangan', 'Link Foto', 'Created At', 'Updated At'],
            $allData
        ]);
    }
}
