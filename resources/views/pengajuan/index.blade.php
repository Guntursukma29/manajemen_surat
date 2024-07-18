@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <a class="btn text-white mb-0"
                                href="{{ Auth::user()->role_id == 1 ? route('surat.create') : route('surat.create') }}">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;
                                {{ Auth::user()->role_id == 1 ? 'Kirim Surat' : 'Request Surat' }}
                            </a>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mx-0 mb-0 table1">
                                <thead>
                                    <tr>
                                        <td
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Id</td>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Tanggal</td>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Penerima Surat</td>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Perihal</td>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                            Surat</td>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Jenis Surat</td>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</td>
                                        @if (auth()->user()->role_id == 1)
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Asal
                                                Surat</td>
                                        @else
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tujuan Surat</td>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                File
                                            </td>
                                        @endif
                                        <td
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Aksi</td>
                                    </tr>
                                </thead>
                                <tbody class="table align-items-center">
                                    @foreach ($surat as $item)
                                        <tr>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $loop->iteration }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->tanggal }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->penerima->name }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->perihal }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->nama_surat }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->jenisSurat->jenis_surat }}</td>


                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                <span
                                                    class="badge text-white bg-gradient-warning">{{ $item->status }}</span>
                                            </td>
                                            @if (auth()->user()->role_id == 1)
                                                <td
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                    {{ $item->asal_surat }}</td>
                                            @else
                                                <td
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                    {{ $item->tujuan }}</td>
                                                <td
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">

                                                    <a href="{{ asset('storage/surat/' . $item->filesurat) }}"
                                                        target="_blank">View File</a>

                                                </td>
                                            @endif
                                            <td
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">

                                                <form action="{{ route('surat.destroy', $item->id) }}" method="POST"
                                                    class="d-inline" id="deleteForm_{{ $item->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('surat.edit', $item->id) }}" class="btn btn-primary"
                                                        title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-danger" title="Delete"
                                                        onclick="confirmDelete('{{ $item->id }}')"><i
                                                            class="bi bi-trash"></i></button>
                                                    </button>
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
@endsection
