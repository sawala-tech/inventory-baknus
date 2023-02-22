@extends('components.layout.main.app')
@section('title', 'Play Shop || Data Barang')
@section('content')
    <div class="container-fluid p-0 mb-5">
        <h2>Data Barang</h2>
        @if (session('message'))
            <div class="alert alert-success w-100 py-1 px-3 text-center" role="alert" id="alert-div">
                {{ session('message') }}
            </div>
        @endif
        <div class="justify-content-between mb-3 d-flex pt-2">
            <button onclick="window.location.href='{{ route('barang.create') }}'"
                class="rounded-lg bg-sea p-2 text-white align-items-center d-flex border-0">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 4V12M12 8H4" stroke="white" stroke-width="1.5" stroke-linecap="round"
                        stroke-linejoin="round" />
                </svg>
                <span class="px-2">
                    Tambah Barang
                </span>
            </button>

            <div class="w-auto position-relative">
                <i class="fas fa-search fa-sm position-absolute mt-2 pt-1 ml-3 text-secondary"></i>
                <input type="text" class="form-control pl-5 text-secondary" id="search-input"
                    placeholder="Cari Barang" />
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
                        <th class="text-uppercase">Kategori</th>
                        <th class="text-uppercase">keterangan</th>
                        <th class="text-uppercase">Foto barang</th>
                        <th class="text-uppercase">Aksi</th>
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
                            <td>
                                @if ($item->foto)
                                    <img src="{{ asset('/storage/lampiran/' . $item->foto) }}" style="width: 80px"
                                        alt="" />
                                @else
                                    -
                                @endif
                            </td>
                            <td class="d-flex flex-row">
                                <button onclick="window.location.href='/barang/detail/{{ $item->id }}'"
                                    class="bg-primary rounded border-0 align-items-center d-flex p-2">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.18791 7.18783C1.14765 7.06684 1.14765 6.93607 1.18791 6.81508C1.99699 4.38083 4.29357 2.625 7.00024 2.625C9.70574 2.625 12.0012 4.37908 12.812 6.81217C12.8528 6.93292 12.8528 7.06358 12.812 7.18492C12.0035 9.61917 9.70691 11.375 7.00024 11.375C4.29474 11.375 1.99874 9.62092 1.18791 7.18783Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M8.75 7C8.75 7.46413 8.56563 7.90925 8.23744 8.23744C7.90925 8.56563 7.46413 8.75 7 8.75C6.53587 8.75 6.09075 8.56563 5.76256 8.23744C5.43437 7.90925 5.25 7.46413 5.25 7C5.25 6.53587 5.43437 6.09075 5.76256 5.76256C6.09075 5.43437 6.53587 5.25 7 5.25C7.46413 5.25 7.90925 5.43437 8.23744 5.76256C8.56563 6.09075 8.75 6.53587 8.75 7Z"
                                            stroke="white" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </button>
                                <button onclick="window.location.href='{{ route('barang.edit', $item->id) }}'"
                                    class="bg-success rounded border-0 align-items-center d-flex p-2 mx-1">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3.8029 9.74189L4.6863 7.53339C4.8271 7.18156 5.03785 6.86198 5.3058 6.59399L10.1498 1.75139C10.4283 1.47291 10.806 1.31647 11.1998 1.31647C11.5936 1.31647 11.9713 1.47291 12.2498 1.75139C12.5283 2.02987 12.6847 2.40757 12.6847 2.80139C12.6847 3.19522 12.5283 3.57291 12.2498 3.85139L7.4058 8.69399C7.1377 8.96209 6.8178 9.17349 6.4657 9.31419L4.2579 10.1976C4.19429 10.2231 4.12461 10.2293 4.0575 10.2155C3.99039 10.2017 3.92879 10.1686 3.88034 10.1201C3.8319 10.0717 3.79874 10.0101 3.78497 9.94299C3.7712 9.87587 3.77744 9.8062 3.8029 9.74259V9.74189Z"
                                            fill="white" />
                                        <path
                                            d="M2.4499 4.02498C2.4499 3.54198 2.8419 3.14998 3.3249 3.14998H6.9999C7.13914 3.14998 7.27268 3.09466 7.37113 2.99621C7.46959 2.89775 7.5249 2.76421 7.5249 2.62498C7.5249 2.48574 7.46959 2.3522 7.37113 2.25374C7.27268 2.15529 7.13914 2.09998 6.9999 2.09998H3.3249C2.81436 2.09998 2.32473 2.30279 1.96372 2.6638C1.60271 3.0248 1.3999 3.51443 1.3999 4.02498V10.675C1.3999 11.1855 1.60271 11.6751 1.96372 12.0362C2.32473 12.3972 2.81436 12.6 3.3249 12.6H9.9749C10.4854 12.6 10.9751 12.3972 11.3361 12.0362C11.6971 11.6751 11.8999 11.1855 11.8999 10.675V6.99998C11.8999 6.86074 11.8446 6.7272 11.7461 6.62874C11.6477 6.53029 11.5141 6.47498 11.3749 6.47498C11.2357 6.47498 11.1021 6.53029 11.0037 6.62874C10.9052 6.7272 10.8499 6.86074 10.8499 6.99998V10.675C10.8499 11.158 10.4579 11.55 9.9749 11.55H3.3249C2.8419 11.55 2.4499 11.158 2.4499 10.675V4.02498Z"
                                            fill="white" />
                                    </svg>
                                </button>
                                <form action="{{ route('barang.destroy', $item->id) }}" method="POST"
                                    onclick="return confirm('Yakin ingin menghapus data?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-danger rounded border-0 align-items-center d-flex p-2">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.59833 5.25L8.3965 10.5M5.6035 10.5L5.40167 5.25M11.2163 3.3775C11.4158 3.40783 11.6142 3.43992 11.8125 3.47433M11.2163 3.3775L10.5933 11.4759C10.5679 11.8056 10.419 12.1136 10.1763 12.3382C9.93357 12.5629 9.61503 12.6876 9.28433 12.6875H4.71567C4.38497 12.6876 4.06643 12.5629 3.82374 12.3382C3.58105 12.1136 3.43209 11.8056 3.40667 11.4759L2.78367 3.3775M11.2163 3.3775C10.5431 3.27572 9.86636 3.19847 9.1875 3.14592M2.78367 3.3775C2.58417 3.40725 2.38583 3.43933 2.1875 3.47375M2.78367 3.3775C3.45691 3.27572 4.13364 3.19847 4.8125 3.14592M9.1875 3.14592V2.61158C9.1875 1.92325 8.65667 1.34925 7.96833 1.32767C7.32294 1.30704 6.67706 1.30704 6.03167 1.32767C5.34333 1.34925 4.8125 1.92383 4.8125 2.61158V3.14592M9.1875 3.14592C7.73134 3.03338 6.26866 3.03338 4.8125 3.14592"
                                                stroke="white" stroke-width="1.2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
