@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Edit Surat</h6>
                    </div>
                    <div class="card-body px-3">
                        <form action="{{ route('surat.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3 input-group input-group-static">
                                <label for="nama_surat" class="ms-0">Nama Surat</label>
                                <input type="text" class="form-control" id="nama_surat" name="nama_surat"
                                    value="{{ $surat->nama_surat }}" required>
                            </div>
                            <div class="mb-3 input-group input-group-static">
                                <label for="exampleFormControlSelect1" class="ms-0">Jenis Surat</label>
                                <select class="form-control" id="jenis_surat_id" name="jenis_surat_id" required>
                                    <option value="" disabled>Pilih Jenis Surat</option>
                                    @foreach ($jenisSurat as $jenis)
                                        <option value="{{ $jenis->id }}"
                                            {{ $surat->jenis_surat_id == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->jenis_surat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 input-group input-group-static">
                                <label for="perihal" class="ms-0">Perihal</label>
                                <input type="text" class="form-control" id="perihal" name="perihal"
                                    value="{{ $surat->perihal }}" required>
                            </div>
                            @if (auth()->user()->role_id == 1)
                                <div class="mb-3 input-group input-group-static">
                                    <label for="asal_surat" class="ms-0">Asal Surat</label>
                                    <input type="text" class="form-control" id="asal_surat" name="asal_surat"
                                        value="{{ $surat->asal_surat }}" required>
                                </div>
                            @else
                                <div class="mb-3 input-group input-group-static">
                                    <label for="tujuan" class="ms-0">Tujuan Surat</label>
                                    <input type="text" class="form-control" id="tujuan" name="tujuan"
                                        value="{{ $surat->tujuan }}" required>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label for="bentuk_surat" class="form-label">Bentuk Surat</label>
                                <select class="form-select" id="bentuk_surat" name="bentuk_surat">
                                    <option value="hard_copy" {{ $surat->bentuk_surat == 'hard_copy' ? 'selected' : '' }}>
                                        Hard Copy</option>
                                    <option value="soft_copy" {{ $surat->bentuk_surat == 'soft_copy' ? 'selected' : '' }}>
                                        Soft Copy</option>
                                </select>
                            </div>
                            <div class="mb-3 input-group input-group-static">
                                <label for="filesurat" class="ms-0">File Surat</label>
                                <input class="form-control" type="file" id="filesurat" name="filesurat">
                                @if ($surat->filesurat)
                                    <small class="form-text text-muted">File sebelumnya: <a
                                            href="{{ asset('storage/surat/' . $surat->filesurat) }}"
                                            target="_blank">{{ $surat->filesurat }}</a></small>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
