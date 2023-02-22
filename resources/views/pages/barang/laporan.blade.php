@extends('components.layout.main.app')
@section('title', 'Play Shop || Laporan Barang')
@section('content')
    @if (session('message'))
        <div>
            {{ session('message') }}
        </div>
    @endif

    <h2>Laporan Barang</h2>
    <div class="container-fluid p-0 my-5">
        <div class="justify-content-between mb-3 d-flex">
            <a href="/export/barang"
                class="rounded-lg bg-sea p-2 text-white align-items-center d-flex border-0 text-decoration-none"
                id='exportLaporanBarang'>
                <i class="fas fa-download"></i>
                <span class="px-2">
                    Export Data
                </span>
            </a>

            <form action="" class="w-auto position-relative">
                <i class="fas fa-search fa-sm position-absolute mt-2 pt-1 ml-3 text-secondary"></i>
                <input type="text" name="search" class="form-control pl-5 text-secondary"
                    id="search-input"placeholder="Cari Barang" />
            </form>
        </div>

    </div>
    <div class="bg-white rounded-lg shadow-sm border-0 px-2 pb-2">
        <table id="table_data" class="table w-100">
            <thead class='text-secondary'>
                <tr>
                    <th class="text-uppercase">#</th>
                    <th class="text-uppercase">Kode Barang</th>
                    <th class="text-uppercase">Nama Barang</th>
                    <th class="text-uppercase">Tanggal Pembelian</th>
                    <th class="text-uppercase">kategori</th>
                    <th class="text-uppercase">keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_barang }}</td>
                        <td>{{ $item->nama_barang }}</td>
                        <td>{{ $item->tanggal_pembelian }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
