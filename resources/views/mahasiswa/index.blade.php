@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="card-header">
            <h5>Request Surat</h5>
        </div>
        <div class="card">
            <div class="card-body  px-0 pb-2">
                <div class="table-responsive p-3">
                    <table class="table align-items-center mb-0 table1">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Email</th>
                                <th>NIM</th>
                                <th>Nama</th>
                                <th>Angkatan</th>
                                <th>Prodi</th>
                                <th>Keperluan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requestSurat as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->email }}</td>
                                    <td>{{ $surat->nim }}</td>
                                    <td>{{ $surat->nama }}</td>
                                    <td>{{ $surat->angkatan }}</td>
                                    <td>{{ $surat->prodi->name }}</td>
                                    <td>{{ $surat->jenisSurat->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#readModal{{ $surat->id }}">Read</button>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="deleteSurat({{ $surat->id }})">Delete</button>
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#replyModal{{ $surat->id }}">Reply</button>
                                    </td>
                                </tr>
                                <!-- Read Modal -->
                                <div class="modal fade" id="readModal{{ $surat->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="readModalLabel{{ $surat->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="readModalLabel{{ $surat->id }}">Request
                                                    Details</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Email:</strong> {{ $surat->email }}</p>
                                                <p><strong>NIM:</strong> {{ $surat->nim }}</p>
                                                <p><strong>Nama:</strong> {{ $surat->nama }}</p>
                                                <p><strong>Angkatan:</strong> {{ $surat->angkatan }}</p>
                                                <p><strong>Prodi:</strong> {{ $surat->prodi->name }}</p>
                                                <p><strong>Keperluan:</strong> {{ $surat->jenisSurat->name }}</p>
                                                <p><strong>Judul Skripsi:</strong> {{ $surat->judul_skripsi }}</p>
                                                <p><strong>Data yang Dibutuhkan:</strong>
                                                    {{ $surat->data_yang_dibutuhkan }}</p>
                                                <p><strong>Jumlah Data:</strong> {{ $surat->jumlah_data }}</p>
                                                <p><strong>Cara Pengambilan Data:</strong>
                                                    {{ $surat->cara_pengambilan_data }}</p>
                                                <p><strong>Waktu Penelitian:</strong> {{ $surat->waktu_penelitian }}</p>
                                                <p><strong>Dosen Pembimbing:</strong> {{ $surat->dosen_pembimbing }}</p>
                                                <p><strong>No Telp:</strong> {{ $surat->no_telp }}</p>
                                                <p><strong>Nama Instansi:</strong> {{ $surat->nama_instansi }}</p>
                                                <p><strong>Nama Pimpinan:</strong> {{ $surat->nama_pimpinan }}</p>
                                                <p><strong>Alamat Instansi:</strong> {{ $surat->alamat_instansi }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Reply Modal -->
                                <div class="modal fade" id="replyModal{{ $surat->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="replyModalLabel{{ $surat->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form method="POST" action="{{ route('reply.store') }}"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="replyModalLabel{{ $surat->id }}">Reply
                                                        to {{ $surat->email }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="replyContent{{ $surat->id }}">Reply Content</label>
                                                        <textarea class="form-control" id="replyContent{{ $surat->id }}" name="reply_content" rows="4" required></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="replyFile{{ $surat->id }}">Attach File</label>
                                                        <input type="file" class="form-control-file"
                                                            id="replyFile{{ $surat->id }}" name="reply_file">
                                                    </div>
                                                    <input type="hidden" name="surat_id" value="{{ $surat->id }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Send Reply</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Form -->
    <form id="deleteForm" action="" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        function deleteSurat(id) {
            if (confirm('Are you sure you want to delete this record?')) {
                var deleteForm = document.getElementById('deleteForm');
                deleteForm.action = '{{ route('surat_mahasiswa.destroy', '') }}/' + id;
                deleteForm.submit();
            }
        }
    </script>
@endsection
