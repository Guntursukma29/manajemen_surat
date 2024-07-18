@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <a class="btn text-white mb-0" data-bs-toggle="modal" data-bs-target="#createModal"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp; Create New</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="bg-primary">
                                        <th
                                            class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7 text-white">
                                            No</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7 text-white">
                                            Name</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-md font-weight-bolder opacity-7 text-white">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jenisSuratMahasiswa as $jenis)
                                        <tr>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                {{ $loop->iteration }}</td>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                {{ $jenis->name }}</td>
                                            <td
                                                class="text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7">
                                                <a href="#" class="btn btn-primary editBtn" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $jenis->id }}"
                                                    data-id="{{ $jenis->id }}" data-name="{{ $jenis->name }}"
                                                    title="Edit"><i class="bi bi-pencil"></i></a>
                                                <form action="{{ route('jenis_surat_mahasiswa.destroy', $jenis->id) }}"
                                                    method="POST" class="d-inline" id="deleteForm_{{ $jenis->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" title="Delete"
                                                        onclick="confirmDelete('{{ $jenis->id }}')"><i
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

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Create New Jenis Surat Mahasiswa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="createJenisSuratForm" action="{{ route('jenis_surat_mahasiswa.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @foreach ($jenisSuratMahasiswa as $jenis)
        <div class="modal fade" id="editModal{{ $jenis->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Jenis Surat Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editJenisSuratForm-{{ $jenis->id }}" method="POST"
                            action="{{ route('jenis_surat_mahasiswa.update', $jenis->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="edit_name">Name</label>
                                <input type="text" class="form-control" id="edit_name" name="name"
                                    value="{{ $jenis->name }}" required>
                            </div>
                            <input type="hidden" id="edit_jenis_id" name="jenis_id" value="{{ $jenis->id }}">
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
            // Create form submission
            $('#createJenisSuratForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                var formData = $(this).serialize(); // Serialize form data
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'), // Use form action attribute as URL
                    data: formData,
                    success: function(response) {
                        $('#createModal').modal('hide');
                        location.reload(); // Reload page after successful submission
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            // Edit button click event
            $('.editBtn').click(function() {
                var jenis_id = $(this).data('id');
                var name = $(this).data('name');
                $('#edit_jenis_id').val(jenis_id);
                $('#edit_name').val(name);
                $('#editModal-' + jenis_id).modal('show');
            });

            // Edit form submission
            $('form[id^="editJenisSuratForm"]').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                var jenis_id = $('#edit_jenis_id').val();
                $.ajax({
                    type: 'PUT',
                    url: '/jenis_surat_mahasiswa/' + jenis_id,
                    data: formData,
                    success: function(response) {
                        $('#editModal-' + jenis_id).modal('hide');
                        location.reload(); // Reload page after successful submission
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this item?')) {
                $('#deleteForm_' + id).submit();
            }
        }
    </script>
@endsection
