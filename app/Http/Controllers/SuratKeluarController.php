<?php

namespace App\Http\Controllers;

use App\Models\SuratKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Exports\suratKeluarExport;
use Maatwebsite\Excel\Facades\Excel;

class SuratKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $currentPath='surat';

    public function index()
    {
        //get data from database with pagination
        $suratKeluar = SuratKeluar::all();
        //return to view
        return view('pages.surat-keluar.app', compact('suratKeluar'), ['currentPath' => $this->currentPath]);
    }
    public function detail($id)
    {
        $suratKeluar = SuratKeluar::find($id);
        //return to view
        return view('pages.surat-keluar.detail', compact('suratKeluar'), ['currentPath' => $this->currentPath]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.surat-keluar.create', ['currentPath' => $this->currentPath]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
    
        $this->validate($request, [
            'nomor_surat' => 'required',
            'judul_surat' => 'required',
            'kategori' => 'required|in:permohonan,undangan,pemberitahuan,permintaan,tugas,rekomendasi,pengantar',
            'tanggal_keluar' => 'required',
            'tujuan_surat' => 'required',
            'keterangan' => 'required',
            'lampiran' => 'required|mimes:pdf,doc,docx'
        ]);
        //store data from request
        $suratKeluar = new SuratKeluar;
        $suratKeluar->nomor_surat = $request->get('nomor_surat');
        $suratKeluar->judul_surat = $request->get('judul_surat');
        $suratKeluar->kategori = $request->get('kategori');
        $suratKeluar->tanggal_keluar = $request->get('tanggal_keluar');
        $suratKeluar->tujuan_surat = $request->get('tujuan_surat');
        $suratKeluar->keterangan = $request->get('keterangan');
        if($request->hasFile('lampiran')){
            $filenameWithExt = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('lampiran')->storeAs('public/lampiran', $filenameSimpan);
            $suratKeluar->file_surat = $filenameSimpan;
        }
        $suratKeluar->save();

        Session::flash('message', 'Data berhasil disimpan!');
        return Redirect::to('surat-keluar');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function show(SuratKeluar $suratKeluar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $suratKeluar = SuratKeluar::find($id);
        $datakategory = ['permohonan','undangan','pemberitahuan','permintaan','tugas','rekomendasi','pengantar'];
        return view('pages/surat-keluar.edit',$suratKeluar, ['datakategory' => $datakategory, 'currentPath' => $this->currentPath]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {  
        $this->validate($request, [
            'nomor_surat' => 'required',
            'judul_surat' => 'required',
            'kategori' => 'required|in:permohonan,undangan,pemberitahuan,permintaan,tugas,rekomendasi,pengantar',
            'tanggal_keluar' => 'required',
            'tujuan_surat' => 'required',
            'keterangan' => 'required',
            'lampiran'=>'mimes:pdf,doc,docx'
        ]);
        $suratKeluar = SuratKeluar::find($id);
        $suratKeluar->nomor_surat = $request->get('nomor_surat');
        $suratKeluar->judul_surat = $request->get('judul_surat');
        $suratKeluar->kategori = $request->get('kategori');
        $suratKeluar->tanggal_keluar = $request->get('tanggal_keluar');
        $suratKeluar->tujuan_surat = $request->get('tujuan_surat');
        $suratKeluar->keterangan = $request->get('keterangan');
        if($request->hasFile('lampiran')){
            $filenameWithExt = $request->file('lampiran')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('lampiran')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            if($filenameWithExt != $suratKeluar->file_surat){
                //delete old file
                Storage::delete('public/lampiran/'.$suratKeluar->file_surat);
                $path = $request->file('lampiran')->storeAs('public/lampiran', $filenameSimpan);
            }
            $suratKeluar->file_surat = $filenameSimpan;
        }

        $suratKeluar->save();

        Session::flash('message', 'Data berhasil di update!');
        return Redirect::to('surat-keluar/'.$suratKeluar->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SuratKeluar  $suratKeluar
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete data
        $suratKeluar = SuratKeluar::find($id);
        $suratKeluar->delete();
        if($suratKeluar->file_surat !=''||$suratKeluar->file_surat !=null){
            Storage::delete('public/lampiran/'.$suratKeluar->file_surat);
        }

        Session::flash('message', 'Data berhasil dihapus!');
        return Redirect::to('surat-keluar');
    }

    public function laporan()
    {
        $suratKeluar = SuratKeluar::all();
        return view('pages.surat-keluar.laporan', compact('suratKeluar'), ['currentPath' => 'laporan']);
    }

    public function exportExcel()
    {
        $params = request()->query();
        $search = $params['search'] ?? '';
        return Excel::download(new SuratKeluarExport($search), 'surat-keluar.xlsx'); 
    }
}
