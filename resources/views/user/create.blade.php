@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Add New User</h6>
            </div>
            <div class="card-body pt-4 p-3">
                @if (session('success'))
                    <div class="alert alert-success text-white">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger text-white">
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('user.store') }}" method="POST" role="form text-left">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="nip">NIP</label>
                                <input class="form-control px-5" type="text" placeholder="NIP" id="nip"
                                    name="nip" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="name">Nama</label>
                                <input class="form-control px-5" type="text" placeholder="Nama" id="name"
                                    name="name" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="username">Email</label>
                                <input class="form-control px-5" type="text" placeholder="email" id="email"
                                    name="email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control px-3" type="password" id="password" name="password">
                            </div>
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input class="form-control px-3" type="password" id="password_confirmation"
                                    name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="role">Role</label>
                                <select class="form-control px-5" id="role" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="prodi">Prodi</label>
                                <select class="form-control px-5" id="prodi" name="prodi_id">
                                    @foreach ($prodi as $prodiItem)
                                        <option value="{{ $prodiItem->id }}">{{ $prodiItem->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
