@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4 d-flex justify-content-center align-items-center">
        <div class="card text-center" style="width: 70%;">
            <div class="card-header pb-0 px-3">
                @if (Auth::user()->role_id == 1)
                    <h6 class="mb-0">Kirim Surat</h6>
                @elseif (Auth::user()->role_id == 2)
                    <h6 class="mb-0">Request Surat</h6>
                @endif
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('surat.kirim') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        @if (Auth::user()->role_id == 1)
                            <div class="col">
                                <div class="input-group input-group-static mb-4">
                                    <label for="exampleFormControlSelect1" class="ms-0">Pilih User</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="penerima_id">
                                        @foreach ($users as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <div class="col">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label">Perihal </label>
                                <input class="form-control" type="text" id="perihal" name="perihal" required>
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label">Nama Surat</label>
                                <input class="form-control" type="text" id="nama_surat" name="nama_surat" required>
                            </div>
                        </div>
                        @if (auth()->user()->role_id == 1)
                            <div class="col">
                                <div class="input-group input-group-dynamic mb-4">
                                    <label class="form-label">Asal Surat</label>
                                    <input class="form-control" type="text" id="asal_surat" name="asal_surat" required>
                                </div>
                            </div>
                        @else
                            <div class="col">
                                <div class="input-group input-group-dynamic mb-4">
                                    <label class="form-label">Tujuan Surat</label>
                                    <input class="form-control" type="text" id="tujuan" name="tujuan" required>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col">
                        <div class="input-group input-group-static mb-4">
                            <label for="exampleFormControlSelect1" class="ms-0">Jenis Surat</label>
                            <select class="form-control" id="jenis_surat_id" name="jenis_surat_id">
                                @foreach ($jenisSurat as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->jenis_surat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group input-group-static mb-4">
                            <label for="nomor_surat" class="form-label">Nomor Surat</label>
                            <input class="form-control" type="text" id="nomor_surat" name="nomor_surat" required>
                        </div>

                    </div>
                    @if (auth()->user()->role_id == 2)
                        <div class="col">
                            <div class="input-group input-group-static mb-4">
                                <label class="ms-0">File Surat</label>
                                <input class="form-control" type="file" id="filesurat" name="filesurat" required>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
