<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use App\Models\SuratMasuk;
use Illuminate\Http\Request;


class Dashboard extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //get newest total 5 data from 2 table surat masuk and surat keluar
        $suratMasuk = SuratMasuk::orderBy('created_at', 'desc')->take(5)->get()->toArray();
        $suratKeluar = SuratKeluar::orderBy('created_at', 'desc')->take(5)->get()->toArray();
        $newestSurat=[];
        $indexMasuk=0;
        $indexKeluar=0;
        $totalData = count($suratMasuk)+count($suratKeluar);
        $totalLoop=($totalData>5)?5:$totalData;

        for($i=0;$i<$totalLoop;$i++){

            if($indexMasuk >= count($suratMasuk)){

                $newestSurat[$i] =$this->transformArraySurat($suratKeluar[$indexKeluar], "Surat Keluar");
                $indexKeluar++;

            }else if($indexKeluar >= count($suratKeluar)){

                $newestSurat[$i] = $this->transformArraySurat($suratMasuk[$indexMasuk], "Surat Masuk");
                $indexMasuk++;

            }else{

                if($suratMasuk[$indexMasuk]['created_at'] > $suratKeluar[$indexKeluar]['created_at']){

                    $newestSurat[$i] = $this->transformArraySurat($suratMasuk[$indexMasuk], "Surat Masuk");
                    $indexMasuk++;

                }else{

                    $newestSurat[$i] = $this->transformArraySurat($suratKeluar[$indexKeluar], "Surat Keluar");
                    $indexKeluar++;

                }

            }
            
        }

        //get count surat masuk and surat keluar
        $countSuratMasuk = SuratMasuk::count();
        $countSuratKeluar = SuratKeluar::count();

        $returnData= [
            'latest' => $newestSurat,
            'countSuratMasuk' => $countSuratMasuk,
            'countSuratKeluar' => $countSuratKeluar,
        ];
        $currentPath = $request->path();
        return view('pages.dashboard.app', $returnData, ['currentPath' => $currentPath]);
    }

    private function transformArraySurat($array, $jenisSurat){
        $newArray = [];
        if($jenisSurat == "Surat Masuk"){
            $newArray = [
                "id" => $array['id'],
                "nomor_surat" => $array['nomor_surat'],
                "judul_surat" => $array['judul_surat'],
                "kategori" => $array['kategori'],
                "tanggal_surat" => $array['tanggal_masuk'],
                "jenis_surat" => $jenisSurat
            ];
        }else{
            $newArray = [
                "id" => $array['id'],
                "nomor_surat" => $array['nomor_surat'],
                "judul_surat" => $array['judul_surat'],
                "kategori" => $array['kategori'],
                "tanggal_surat" => $array['tanggal_keluar'],
                "jenis_surat" => $jenisSurat
            ];
        }
        return $newArray;
    }
}
