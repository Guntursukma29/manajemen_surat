@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (session('success'))
                    <div class="alert alert-success text-white">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <a class="btn text-white mb-0" data-bs-toggle="modal" data-bs-target="#addSuratModal"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp; Tambah Surat</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0 table1">
                                <thead>
                                    <tr class="bg-primary ">
                                        <th
                                            class="text-center text-uppercase text-md font-weight-bolder opacity-7 text-white">
                                            Id</th>
                                        <th
                                            class="text-center text-uppercase text-md font-weight-bolder opacity-7 text-white">
                                            Nama Surat</th>
                                        <th
                                            class="text-center text-uppercase text-md font-weight-bolder opacity-7 text-white">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenissurat as $j)
                                        <tr>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                {{ $loop->iteration }}</td>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                {{ $j->jenis_surat }}</td>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                <a href="#" class="btn btn-primary editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#editSuratModal-{{ $j->id }}"
                                                    data-id="{{ $j->id }}" data-nama="{{ $j->jenis_surat }}"
                                                    title="Edit"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ route('jenissurat.destroy', $j->id) }}" method="POST"
                                                    class="d-inline" id="deleteForm_{{ $j->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" title="Delete"
                                                        onclick="confirmDelete('{{ $j->id }}')"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
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

    <div class="modal fade" id="addSuratModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addSuratForm" action="{{ route('jenissurat.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_surat">Nama Surat</label>
                            <input type="text" class="form-control" id="nama_surat" name="jenis_surat" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($jenissurat as $j)
        <div class="modal fade" id="editSuratModal-{{ $j->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editSuratForm-{{ $j->id }}" method="POST"
                            action="{{ route('jenissurat.update', $j->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_nama_surat">Nama Surat</label>
                                <input type="text" class="form-control" id="edit_nama_surat" name="jenis_surat"
                                    value="{{ $j->jenis_surat }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addSuratForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Use form action attribute as URL
                    data: formData,
                    success: function(response) {
                        $('#addSuratModal').modal('hide');
                        location.reload(); // Reload page after successful submission
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Edit button click event
            $('.editBtn').click(function() {
                var surat_id = $(this).data('id');
                var nama_surat = $(this).data('nama');
                $('#edit_surat_id').val(surat_id);
                $('#edit_nama_surat').val(nama_surat);
                $('#editSuratModal').modal('show');
            });

            // Edit form submission
            $('[id^=editSuratForm]').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var surat_id = $(this).attr('id').split('-')[1];
                $.ajax({
                    type: 'PUT',
                    url: '/jenissurat/' + surat_id,
                    data: formData,
                    success: function(response) {
                        $('#editSuratModal-' + surat_id).modal('hide');
                        location.reload(); // Reload page after successful submission
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
