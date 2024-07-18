@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card-header">
            <h5>{{ $title }}</h5>
        </div>
        <div class="card">
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
                                                <h5 class="modal-title" id="viewSuratModalLabel{{ $surat->id }}">Surat
                                                    untuk {{ $surat->nama }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @php
                                                    $filePath = storage_path(
                                                        'app/public/reply_files/' . $surat->surat_dikirim,
                                                    );
                                                    if (!file_exists($filePath)) {
                                                        Log::error('File not found: ' . $filePath);
                                                    }
                                                @endphp
                                                @if (file_exists($filePath))
                                                    <iframe
                                                        src="{{ asset('storage/app/reply_files/' . $surat->surat_dikirim) }}"
                                                        frameborder="0" style="width: 100%; min-height: 500px;"></iframe>
                                                @else
                                                    <p>File surat tidak ditemukan.</p>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
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
@endsection
