<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Exports\barangExport;
use Maatwebsite\Excel\Facades\Excel;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $currentPath='barang';

    public function index()
    {
        //get data from database with pagination
        $barang = barang::all();
        //return to view
        return view('pages.barang.app', compact('barang') , ['currentPath' => $this->currentPath]);
    }
    public function detail($id)
    {
        $barang = barang::find($id);
        //return to view
        return view('pages.barang.detail', compact('barang'), ['currentPath' => $this->currentPath]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.barang.create', ['currentPath' => $this->currentPath]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate request
        $this->validate($request, [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'tanggal_pembelian' => 'required',
            'kategori' => 'required|in:handphone,laptop,pakaian pria,pakaian wanita,kebutuhan rumah tangga,makanan',
            'keterangan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        //store data from request
        $barang = new barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->tanggal_pembelian = $request->tanggal_pembelian;
        $barang->kategori = $request->kategori;
        $barang->keterangan = $request->keterangan;
        if($request->hasFile('foto')){
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            $path = $request->file('foto')->storeAs('public/lampiran', $filenameSimpan);
            $barang->foto = $filenameSimpan;
        }
        $barang->save();

        Session::flash('message', 'Data berhasil disimpan!');
        return Redirect::to('barang');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $barang = barang::find($id);
        $datakategory = ['handphone', 'laptop', 'pakaian pria', 'pakaian wanita','kebutuhan rumah tangga','makanan'];
        return view('pages/barang.edit', $barang, ['datakategory' => $datakategory, 'currentPath' => $this->currentPath]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'tanggal_pembelian' => 'required',
            'kategori' => 'required|in:handphone,laptop,pakaian pria,pakaian wanita,kebutuhan rumah tangga,makanan',
            'keterangan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $barang = barang::find($id);
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->tanggal_pembelian = $request->tanggal_pembelian;
        $barang->kategori = $request->kategori;
        $barang->keterangan = $request->keterangan;
        
        if($request->hasFile('foto')){
            $filenameWithExt = $request->file('foto')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('foto')->getClientOriginalExtension();
            $filenameSimpan = $filename.'_'.time().'.'.$extension;
            if($filenameWithExt != $barang->foto){
                //delete old file
                Storage::delete('public/lampiran/'.$barang->foto);
                $path = $request->file('foto')->storeAs('public/lampiran', $filenameSimpan);
            }
            $barang->foto = $filenameSimpan;
        }

        $barang->save();

        Session::flash('message', 'Data berhasil di update!');
        return Redirect::to('barang/'.$barang->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //delete data
         $barang = barang::find($id);
         $barang->delete();
         if($barang->foto !=''||$barang->foto !=null){
             Storage::delete('public/lampiran/'.$barang->foto);
         }
 
         Session::flash('message', 'Data berhasil dihapus!');
         return Redirect::to('barang');
    }

    public function laporan()
    {
        $barang = barang::all();
        return view('pages.barang.laporan', compact('barang'), ['currentPath' => 'laporan']);
    }

    public function exportExcel()
    {
        //get params from url search
        $params = request()->query();
        $search = $params['search'] ?? '';
        return Excel::download(new barangExport($search), 'barang.xlsx'); 
    }
}
