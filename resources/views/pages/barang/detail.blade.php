@extends('components.layout.main.app')
@section('title', 'E-Arsip || Barang')
@section('content')
    <div class="container-fluid p-0">
        <div>
            <a href="/barang" class="text-decoration-none text-body align-items-center mb-4 d-inline-flex">
                <i class="fas fa-chevron-left fa-lg"></i>
                <h3 class="fw-bolder mb-0 ml-3">Detail Barang</h3>
            </a>
        </div>
        <div class="card border-0 rounded-lg p-4 shadow-sm">
            <h4 class="fw-bolder text-capitalize mb-3">{{ $barang->nama_barang }}</h6>
                <div class="row w-100 border-bottom py-2 mt-2">
                    <div class="col-2">Kode Barang</div>
                    <div class="col-10">{{ $barang->kode_barang }}</div>
                </div>
                <div class="row w-100 border-bottom py-2 mt-2">
                    <div class="col-2">Tanggal Pembelian</div>
                    <div class="col-10">{{ $barang->tanggal_pembelian }}</div>
                </div>
                <div class="row w-100 border-bottom py-2 mt-2">
                    <div class="col-2">Kategori</div>
                    <div class="col-10">{{ $barang->kategori }}</div>
                </div>
                <div class="row w-100 border-bottom py-2 mt-2">
                    <div class="col-2">Keterangan</div>
                    <div class="col-10">{{ $barang->keterangan }}</div>
                </div>
                <div class="row w-100 border-bottom py-2 mt-2">
                    <div class="col-2">Foto Barang</div>
                    <div class="col-10">
                        <a href="{{ asset('/storage/lampiran/' . $barang->foto) }}" target="_blank">
                            {{ $barang->foto }}
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="bg-secondary p-2 text-white rounded-lg border-0 mr-1">
                        <i class="fas fa-print"></i>
                        <span>Print</span>
                    </button>
                    <button onclick="window.location.href='{{ route('barang.edit', $barang->id) }}'"
                        class="bg-success p-2 text-white rounded-lg border-0 mr-1">
                        <i class="fas fa-edit"></i>
                        <span>Edit</span>
                    </button>
                    <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" class="d-inline-flex">
                        @csrf
                        @method('DELETE')
                        <button class="bg-danger p-2 text-white rounded-lg border-0 mr-1" type="submit">
                            <i class="fas fa-trash-alt"></i>
                            <span>Hapus</span>
                        </button>
                    </form>
                </div>
        </div>
    </div>
@endsection
