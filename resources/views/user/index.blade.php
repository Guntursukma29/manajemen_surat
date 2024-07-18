@extends('layouts.layout')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
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
                    <div class="me-3 my-3 text-end">
                        <a class="btn bg-gradient-dark mb-0" href="{{ route('user.create') }}">
                            <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New User
                        </a>
                    </div>
                    <div class="card my-4">


                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive p-3">
                                <table class="table align-items-center mb-0 table1">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th
                                                class="text-center text-uppercase  text-md font-weight-bolder opacity-7 text-white">
                                                ID
                                            </th>
                                            <th
                                                class="text-center text-uppercase  text-md font-weight-bolder opacity-7 text-white">
                                                NIP</th>
                                            <th
                                                class="text-center text-uppercase  text-md font-weight-bolder opacity-7 text-white">
                                                NAMA</th>
                                            <th
                                                class="text-center text-uppercase  text-md font-weight-bolder opacity-7 text-white">
                                                PRODI</th>
                                            <th
                                                class="text-center text-uppercase  text-md font-weight-bolder opacity-7 text-white">
                                                ROLE</th>
                                            <th
                                                class="text-center text-uppercase  text-md font-weight-bolder opacity-7 text-white">
                                                ACTION
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td
                                                    class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                    {{ $loop->iteration }}</td>
                                                <td
                                                    class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                    {{ $user->nip }}</td>
                                                <td
                                                    class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                    {{ $user->name }}</td>
                                                <td
                                                    class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                    {{ $user->prodi->nama_prodi }}</td>
                                                <td
                                                    class="text-uppercase text-secondary text-sm font-weight-bolder opacity-7 text-center">
                                                    {{ $user->role->name }}</td>
                                                <td
                                                    class=" text-center text-uppercase text-secondary text-sm font-weight-bolder opacity-7 ">
                                                    <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                                        class="d-inline" id="deleteForm_{{ $user->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="{{ route('user.edit', $user->id) }}"
                                                            class="btn btn-primary" title="Edit"><i
                                                                class="bi bi-pencil"></i></a>
                                                        <button type="button" class="btn btn-danger" title="Delete"
                                                            onclick="confirmDelete('{{ $user->id }}')"><i
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
    </main>
@endsection
