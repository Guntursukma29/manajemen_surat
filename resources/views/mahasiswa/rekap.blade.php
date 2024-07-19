@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card-header text-center">
            <h5>{{ $title }}</h5>
        </div>


        <!-- Filter Form -->
        <div class="card card-frame mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('filter_mahasiswa.rekap') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="angkatan">Angkatan</label>
                                <input type="number" name="angkatan" class="form-control" id="angkatan"
                                    value="{{ request('angkatan') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="tanggal_start">Tanggal Mulai</label>
                                <input type="date" name="tanggal_start" class="form-control" id="tanggal_start"
                                    value="{{ request('tanggal_start') }}">
                            </div>
                        </div>
                        {{-- <div class="col-md-4">
                                        <div class="input-group input-group-static my-3">
                                            <label for="tanggal_end">Tanggal Akhir</label>
                                            <input type="date" name="tanggal_end" class="form-control" id="tanggal_end"
                                                value="{{ request('tanggal_end') }}">
                                        </div>
                                    </div> --}}
                        <div class="col-md-4">
                            <div class="input-group input-group-static my-3">
                                <label for="jenis_surat">Jenis Surat</label>
                                <select name="jenis_surat" class="form-control" id="jenis_surat">
                                    <option value="">Pilih Jenis Surat</option>
                                    @foreach ($jenisSurat as $jenis)
                                        <option value="{{ $jenis->id }}"
                                            {{ request('jenis_surat') == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->name }}
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
        <!-- End Filter Form -->
        <div class="card">
            <div class="card-body px-0 pb-2">
                <div class="p-3">
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0 table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Angkatan</th>
                                        <th>Keperluan</th>
                                        <th>Surat Dikirim</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requestSurat as $index => $surat)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $surat->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $surat->nim }}</td>
                                            <td>{{ $surat->nama }}</td>
                                            <td>{{ $surat->angkatan }}</td>
                                            <td>{{ $surat->jenisSurat->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#viewSuratModal{{ $surat->id }}">
                                                    Lihat Surat
                                                </button>
                                            </td>
                                        </tr>

                                        <!-- Modal -->
                                        <div class="modal fade" id="viewSuratModal{{ $surat->id }}" tabindex="-1"
                                            aria-labelledby="viewSuratModalLabel{{ $surat->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="viewSuratModalLabel{{ $surat->id }}">Surat
                                                            untuk {{ $surat->nama }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @if ($surat->surat_dikirim)
                                                            <iframe
                                                                src="{{ asset('/public/reply_files/' . $surat->surat_dikirim) }}"
                                                                frameborder="0"
                                                                style="width: 100%; min-height: 500px;"></iframe>
                                                        @else
                                                            <p>File surat tidak ditemukan.</p>
                                                        @endif
                                                    </div>
                                                    <div class="modal-footer">
                                                        @if ($surat->surat_dikirim)
                                                            <a href="{{ asset('/public/reply_files/' . $surat->surat_dikirim) }}"
                                                                class="btn btn-primary" download>Download</a>
                                                        @endif
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Modal -->
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
