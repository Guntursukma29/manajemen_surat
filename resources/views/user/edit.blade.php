@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">

            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Edit User</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('user.update', $user->id) }}" method="POST" role="form text-left">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="nip">NIP</label>
                                <input class="form-control px-5" value="{{ $user->nip }}" type="text"
                                    placeholder="NIP" id="nip" name="nip" aria-describedby="basic-addon1">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="name">Nama</label>
                                <input class="form-control px-5" value="{{ $user->name }}" type="text"
                                    placeholder="Nama" id="name" name="name" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="username">Email</label>
                                <input class="form-control px-5" type="text" placeholder="Username" id="username"
                                    name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control px-3" type="password" id="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="prodi">Prodi</label>
                                <select class="form-control px-5" id="prodi" name="prodi_id">
                                    @foreach ($prodi as $prodiItem)
                                        <option value="{{ $prodiItem->id }}"
                                            {{ $user->prodi_id == $prodiItem->id ? 'selected' : '' }}>
                                            {{ $prodiItem->nama_prodi }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="role">Role :</label>
                                <select class="form-control px-5" id="role" name="role_id">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
