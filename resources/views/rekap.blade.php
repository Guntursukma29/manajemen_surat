@extends('layouts.layout')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="card card-frame">
                <div class="card-body">
                    <form method="GET" action="{{ route('rekap.index') }}">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="input-group input-group-static my-3">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control" id="tanggal"
                                        value="{{ request('tanggal') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-static my-3">
                                    <label for="bulan">Bulan</label>
                                    <input type="month" name="bulan" class="form-control" id="bulan"
                                        value="{{ request('bulan') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-static my-3">
                                    <label for="jenis_surat_id">Jenis Surat</label>
                                    <select name="jenis_surat_id" class="form-control" id="jenis_surat_id">
                                        <option value="">Pilih Jenis Surat</option>
                                        @foreach ($jenisSurat as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ request('jenis_surat_id') == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->jenis_surat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Bagian untuk menampilkan Surat Masuk -->
            @if (auth()->check())
                <div class="row mt-4">
                    <div class="col-12">
                        <a href="{{ route('rekap-surat-masuk.pdf', ['tanggal' => request('tanggal'), 'bulan' => request('bulan'), 'jenis_surat_id' => request('jenis_surat_id')]) }}"
                            class="btn btn-success mt-3">Cetak Surat Masuk PDF</a>

                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3">
                                        @if (auth()->user()->role_id == 1)
                                            Request Surat
                                        @else
                                            Surat Masuk
                                        @endif
                                    </h6>
                                </div>
                            </div>
                            <div class="card-body px-0 pb-2">
                                <div class="table-responsive p-3">
                                    <table class="table align-items-center mb-0 table1">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    ID</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tanggal</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Pengirim</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Nomor Surat</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Perihal</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Jenis Surat</th>

                                                @if (auth()->user()->role_id == 2)
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Asal Surat</th>
                                                @else
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        Tujuan Surat</th>
                                                @endif
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    File Surat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($suratMasuk as $surat)
                                                <tr>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $surat->tanggal }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $surat->pengirim->name }}
                                                    </td>

                                                    <td
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                        {{ $surat->nomor_surat }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">{{ $surat->nama_surat }}</td>
                                                    <td class="text-xs font-weight-bold mb-0">
                                                        {{ $surat->jenisSurat->jenis_surat }}</td>
                                                    @if (auth()->user()->role_id == 2)
                                                        <td
                                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                            {{ $surat->asal_surat }}</td>
                                                    @else
                                                        <td
                                                            class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                            {{ $surat->tujuan }}</td>
                                                    @endif
                                                    <td class="text-xs font-weight-bold mb-0"><a
                                                            href="{{ asset('storage/surat/' . $surat->filesurat) }}"
                                                            target="_blank">Lihat File</a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <!-- Bagian untuk menampilkan Surat Keluar -->
            <div class="row mt-4">
                <div class="col-12">
                    <a href="{{ route('rekap-surat-keluar.pdf', ['tanggal' => request('tanggal'), 'bulan' => request('bulan'), 'jenis_surat_id' => request('jenis_surat_id')]) }}"
                        class="btn btn-success mt-3">Cetak Surat Keluar PDF</a>

                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Rekap Surat Keluar</h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0 table1">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tanggal</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Penerima</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nomor Surat</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Perihal</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jenis Surat</th>
                                            @if (auth()->user()->role_id == 1)
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Asal Surat</th>
                                            @else
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tujuan Surat</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    File Surat</th>
                                            @endif

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suratKeluar as $surat)
                                            <tr>
                                                <td class="text-xs font-weight-bold mb-0">{{ $loop->iteration }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $surat->tanggal }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $surat->penerima->name }}</td>
                                                <td
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                    {{ $surat->nomor_surat }}</td>
                                                <td class="text-xs font-weight-bold mb-0">{{ $surat->nama_surat }}</td>
                                                <td class="text-xs font-weight-bold mb-0">
                                                    {{ $surat->jenisSurat->jenis_surat }}</td>
                                                @if (auth()->user()->role_id == 1)
                                                    <td
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                        {{ $surat->asal_surat }}</td>
                                                @else
                                                    <td
                                                        class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                        {{ $surat->tujuan }}</td>
                                                    <td class="text-xs font-weight-bold mb-0"><a
                                                            href="{{ asset('storage/surat/' . $surat->filesurat) }}"
                                                            target="_blank">Lihat File</a></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
