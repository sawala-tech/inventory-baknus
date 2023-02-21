@extends('components.layout.main.app')
@section('title', 'Play Shop || Tambah Barang')
@section('content')
    <div class="container-fluid p-0">
        <div>
            <a href="/barang" class="text-decoration-none text-body align-items-center mb-4 d-inline-flex">
                <i class="fas fa-chevron-left fa-lg"></i>
                <h3 class="fw-bolder mb-0 ml-3">Tambah Barang</h3>
            </a>
        </div>
        <div class="card border-0 rounded-lg p-4 shadow-sm">
            <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group row">
                            <label for="nomor_surat" class="col-sm-2 col-form-label">Kode Barang</label>
                            <div class="col-sm-10">
                                <input type="text" name="kode_barang"
                                    class="form-control @error('kode_barang') is-invalid @enderror" id="kode_barang"
                                    placeholder="Kode Barang..." value="{{ old('kode_barang') }}">
                                @error('kode_barang')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('kode_barang') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="judul_surat" class="col-sm-2 col-form-label">Nama Barang</label>
                            <div class="col-sm-10">
                                <input type="text" name="nama_barang"
                                    class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang"
                                    placeholder="Nama Barang..." value="{{ old('nama_barang') }}">
                                @error('nama_barang')
                                    <div class="invalid-feedback">
                                        {{ $errors->first('nama_barang') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tanggal_masuk" class="col-sm-2 col-form-label">Tanggal Pembelian</label>
                            <div class="col-sm-10">
                                <input type="date" name="tanggal_pembelian"
                                    class="form-control @error('tanggal_pembelian') is-invalid @enderror"
                                    id="tanggal_pembelian" value="{{ old('tanggal_pembelian') }}">
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
                                    <option @if (old('kategori') == '') selected @endif>Pilih</option>
                                    <option value="handphone" @if (old('kategori') == 'handphone') selected @endif>Handphone
                                    </option>
                                    <option value="laptop" @if (old('kategori') == 'laptop') selected @endif>Laptop
                                    </option>
                                    <option value="pakaian pria" @if (old('kategori') == 'pakaian pria') selected @endif>
                                        Pakaian Pria</option>
                                    <option value="pakaian wanita" @if (old('kategori') == 'pakaian wanita') selected @endif>Pakaian
                                        Wanita
                                    </option>
                                    <option value="kebutuhan rumah tangga"
                                        @if (old('kategori') == 'kebutuhan rumah tangga') selected @endif>Kebutuhan Rumah Tangga</option>
                                    <option value="makanan" @if (old('kategori') == 'makanan') selected @endif>
                                        Makanan</option>
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
                                    id="exampleFormControlTextarea1" rows="3" placeholder="Keterangan...">{{ old('keterangan') }}</textarea>
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
                                    <label class="custom-file-label" for="customFile">Choose file</label>
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
