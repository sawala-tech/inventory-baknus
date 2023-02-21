<?php

namespace App\Http\Controllers;

use App\Models\barang;
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
        $barang = barang::orderBy('created_at', 'desc')->take(5)->get()->toArray();
        
        $countBarang = barang::count();

        $returnData= [
            'latest' => $barang,
            'countBarang' => $countBarang,
        ];
        $currentPath = $request->path();
        return view('pages.dashboard.app', $returnData, ['currentPath' => $currentPath]);
    }
}
