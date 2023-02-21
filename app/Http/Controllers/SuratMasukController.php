<?php

namespace App\Http\Controllers;

use App\Models\SuratMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Exports\suratMasukExport;
use Maatwebsite\Excel\Facades\Excel;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $currentPath='surat';

    public function index()
    {
        //get data from database with pagination
        $suratMasuk = SuratMasuk::all();
        //return to view
        return view('pages.surat-masuk.app', compact('suratMasuk') , ['currentPath' => $this->currentPath]);
    }
    public function detail($id)
    {
        $suratMasuk = SuratMasuk::find($id);
        //return to view
        return view('pages.surat-masuk.detail', compact('suratMasuk'), ['currentPath' => $this->currentPath]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.surat-masuk.create', ['currentPath' => $this->currentPath]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        //validate kategori enum
        $this->validate($request, [
            'nomor_surat' => 'required',
            'judul_surat' => 'required',
            'kategori' => 'required|in:permohonan,undangan,pemberitahuan,permintaan,tugas,rekomendasi,pengantar',
            'tanggal_masuk' => 'required',
            'asal_surat' => 'required',
            'keterangan' => 'required',
            'lampiran' => 'required|mimes:pdf,doc,docx'
        ]);

        //store data from request
        $suratMasuk = new SuratMasuk;
        $suratMasuk->nomor_surat = $request->get('nomor_surat');
        $suratMasuk->judul_surat = $request->get('judul_surat');
        $suratMasuk->kategori = $request->get('kategori');
        $suratMasuk->tanggal_masuk = $request->get('tanggal_masuk');
        $suratMasuk->asal_surat = $request->get('asal_surat');
        $suratMasuk->keterangan = $request->get('keterangan');
        if($request->hasFile('lampiran')){
            $filenameWithExt = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('lampiran')->storeAs('public/lampiran', $filenameSimpan);
            $suratMasuk->file_surat = $filenameSimpan;
        }
        $suratMasuk->save();

        Session::flash('message', 'Data berhasil disimpan!');
        return Redirect::to('surat-masuk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function show(SuratMasuk $suratMasuk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratMasuk = SuratMasuk::find($id);
        $datakategory = ['permohonan','undangan','pemberitahuan','permintaan','tugas','rekomendasi','pengantar'];
        return view('pages/surat-masuk.edit', $suratMasuk, ['datakategory' => $datakategory, 'currentPath' => $this->currentPath]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'nomor_surat' => 'required',
            'judul_surat' => 'required',
            'kategori' => 'required|in:permohonan,undangan,pemberitahuan,permintaan,tugas,rekomendasi,pengantar',
            'tanggal_masuk' => 'required',
            'asal_surat' => 'required',
            'keterangan' => 'required',
            'lampiran'=>'mimes:pdf,doc,docx'
        ]);
        $suratMasuk = SuratMasuk::find($id);
        $suratMasuk->nomor_surat = $request->get('nomor_surat');
        $suratMasuk->judul_surat = $request->get('judul_surat');
        $suratMasuk->kategori = $request->get('kategori');
        $suratMasuk->tanggal_masuk = $request->get('tanggal_masuk');
        $suratMasuk->asal_surat = $request->get('asal_surat');
        $suratMasuk->keterangan = $request->get('keterangan');
        if($request->hasFile('lampiran')){
            $filenameWithExt = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            if($filenameWithExt != $suratMasuk->file_surat){
                //delete old file
                Storage::delete('public/lampiran/'.$suratMasuk->file_surat);
                $path = $request->file('lampiran')->storeAs('public/lampiran', $filenameSimpan);
            }
            $suratMasuk->file_surat = $filenameSimpan;
        }

        $suratMasuk->save();

        Session::flash('message', 'Data berhasil di update!');
        return Redirect::to('surat-masuk/'.$suratMasuk->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratMasuk  $suratMasuk
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //delete data
         $suratMasuk = suratMasuk::find($id);
         $suratMasuk->delete();
         if($suratMasuk->file_surat !=''||$suratMasuk->file_surat !=null){
             Storage::delete('public/lampiran/'.$suratMasuk->file_surat);
         }
 
         Session::flash('message', 'Data berhasil dihapus!');
         return Redirect::to('surat-masuk');
    }

    public function laporan()
    {
        $suratMasuk = SuratMasuk::all();
        return view('pages.surat-masuk.laporan', compact('suratMasuk'), ['currentPath' => 'laporan']);
    }

    public function exportExcel()
    {
        //get params from url search
        $params = request()->query();
        $search = $params['search'] ?? '';
        return Excel::download(new SuratMasukExport($search), 'surat-masuk.xlsx'); 
    }
}
