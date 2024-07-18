@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">Edit Profile</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('profile.update') }}" method="POST" role="form text-left" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="name">Name</label>
                                <input class="form-control px-5" value="{{ $user->name }}" type="text"
                                    placeholder="Name" id="name" name="name">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="email">Email</label>
                                <input class="form-control px-5" type="email" placeholder="Email" id="email"
                                    name="email" value="{{ $user->email }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control px-3" type="password" placeholder="Password" id="password"
                                    name="password">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="password_confirmation">Confirm Password</label>
                                <input class="form-control px-3" type="password" placeholder="Confirm Password"
                                    id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="nip">NIP</label>
                                <input class="form-control px-5" value="{{ $user->nip }}" type="text"
                                    placeholder="NIP" id="nip" name="nip" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group input-group-dynamic mb-4">
                                <label class="form-label" for="photo">Photo</label>
                                <input class="form-control px-5" type="file" id="photo" name="photo">
                            </div>
                            @if ($user->photo)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($user->photo) }}" alt="Profile Photo" class="img-thumbnail"
                                        width="150">
                                </div>
                            @endif
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
