@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4 d-flex justify-content-center align-items-center">
        <div class="card shadow-lg" style="width: 60%;">
            <div class="card-header text-center bg-primary text-white">
                <h6 class="mb-0">Profile</h6>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="mb-3">
                            <label class="form-label">Nama:</label>
                            <p class="form-control bg-light">{{ $user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label>
                            <p class="form-control bg-light">{{ $user->email }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">NIP:</label>
                            <p class="form-control bg-light">{{ $user->nip }}</p>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Prodi:</label>
                            <p class="form-control bg-light">{{ $user->prodi->nama_prodi }}</p>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-md mt-4 mb-4">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
@endsection
