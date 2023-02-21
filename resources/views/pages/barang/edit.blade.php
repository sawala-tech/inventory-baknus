@extends('components.layout.main.app')
@section('title', 'Play Shop || Edit Barang')
@section('content')
    <div class="container-fluid p-0">
        <div>
            <a href="/barang" class="text-decoration-none text-body align-items-center mb-4 d-inline-flex">
                <i class="fas fa-chevron-left fa-lg"></i>
                <h3 class="fw-bolder mb-0 ml-3">Edit Barang</h3>
            </a>
        </div>
        @if (session('message'))
            <div class="alert alert-success w-100 py-1 px-3 text-center" role="alert" id="alert-div">
                {{ session('message') }}
            </div>
        @endif
        <div class="card border-0 rounded-lg p-4 shadow-sm">
            <form action="{{ route('barang.update', $id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="kode_barang" class="col-sm-2 col-form-label">Kode Barang</label>
                            <div class="col-sm-10">
                                <input type="text" name="kode_barang"
                                    class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang"
                                    value="{{ old('kode_barang') ? old('kode_barang') : $kode_barang }}"
                                    placeholder="Kode Barang...">
                                @error('kode_barang')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('kode_barang') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_barang"
                                    class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                                    value="{{ old('nama_barang') ? old('nama_barang') : $nama_barang }}"
                                    placeholder="Nama Barang...">
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_barang') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_pembelian" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                            <div class="col-sm-10">
                                <input type="date" name="tanggal_pembelian"
                                    class="form-control @error('tanggal_pembelian') is-invalid @enderror"
                                    id="tanggal_pembelian"
                                    value="{{ old('tanggal_pembelian') ? old('tanggal_pembelian') : $tanggal_pembelian }}">
                                @error('tanggal_pembelian')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('tanggal_pembelian') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judul_surat" class="col-sm-2 col-form-label">Kategori</label>
                            <div class="col-sm-10">
                                <select class="custom-select @error('kategori') is-invalid @enderror" name="kategori">
                                    @foreach ($datakategory as $category)
                                        <option value="{{ $category }}"
                                            {{ ($category == $kategori && old('kategori') == '') || old('kategori') == $category ? 'selected' : '' }}>
                                            {{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('kategori')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('kategori') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                            <div class="col-sm-10">
                                <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                    id="exampleFormControlTextarea1" rows="3" placeholder="Keterangan...">{{ old('keterangan') ? old('keterangan') : $keterangan }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('keterangan') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="customFile" class="col-sm-2 col-form-label">Foto</label>
                            <div class="col-sm-10">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('foto') is-invalid @enderror"
                                        id="customFile" name="foto">
                                    <label class="custom-file-label" for="customFile" value="{{ $foto }}">Choose
                                        file</label>
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $errors->first('foto') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-3">
                        
                    </div> --}}
                </div>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <a href="/barang" class="btn btn-outline-gray">Cancel</a>
                    <button type="submit" class="btn bg-sea text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
