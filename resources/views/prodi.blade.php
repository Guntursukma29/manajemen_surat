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
                            <a class="btn text-white mb-0" data-bs-toggle="modal" data-bs-target="#addProdiModal"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp; Tambah Prodi</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0 table1">
                                <thead>
                                    <tr class="bg-primary">
                                        <th
                                            class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7 text-white">
                                            Id</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7 text-white">
                                            Nama Prodi</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7 text-white">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prodi as $p)
                                        <tr>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                {{ $loop->iteration }}</td>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                {{ $p->nama_prodi }}</td>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                <a href="#" class="btn btn-primary editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#editProdiModal-{{ $p->id }}"
                                                    data-id="{{ $p->id }}" data-nama="{{ $p->nama_prodi }}"
                                                    title="Edit"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ route('prodi.destroy', $p->id) }}" method="POST"
                                                    class="d-inline" id="deleteForm_{{ $p->id }}">
                                                    @csrf
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" title="Delete"
                                                        onclick="confirmDelete('{{ $p->id }}')"><i
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

    <div class="modal fade" id="addProdiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prodi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addProdiForm" action="{{ route('prodi.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_prodi">Nama Prodi</label>
                            <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @foreach ($prodi as $p)
        <div class="modal fade" id="editProdiModal-{{ $p->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Prodi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editProdiForm-{{ $p->id }}" method="POST"
                            action="{{ route('prodi.update', $p->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_nama_prodi">Nama Prodi</label>
                                <input type="text" class="form-control" id="edit_nama_prodi" name="nama_prodi"
                                    value="{{ $p->nama_prodi }}" required>
                            </div>
                            <input type="hidden" id="edit_prodi_id" name="prodi_id" value="{{ $p->id }}">
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
            $('#addProdiForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Use form action attribute as URL
                    data: formData,
                    success: function(response) {
                        $('#addProdiModal').modal('hide');
                        location.reload(); // Reload page after successful submission
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Edit button click event
            $('.editBtn').click(function() {
                var prodi_id = $(this).data('id');
                var nama_prodi = $(this).data('nama');
                $('#edit_prodi_id').val(prodi_id);
                $('#edit_nama_prodi').val(nama_prodi);
                $('#editProdiModal').modal('show');
            });

            // Edit form submission
            $('#editProdiForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var prodi_id = $('#edit_prodi_id').val();
                $.ajax({
                    type: 'PUT',
                    url: '/prodi/' + prodi_id,
                    data: formData,
                    success: function(response) {
                        $('#editProdiModal').modal('hide');
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
