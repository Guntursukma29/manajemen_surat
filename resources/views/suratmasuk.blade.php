@extends('layouts.layout')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center mb-0 table1">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                            Id</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Tanggal</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Pengirim</th>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Surat</td>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Perihal</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Surat</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jenis Surat</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">File
                                        </th>
                                        @if (auth()->user()->role_id == 2)
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Asal Surat</td>
                                        @else
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tujuan Surat</td>
                                        @endif
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat as $item)
                                        <tr>
                                            <td
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">
                                                {{ $loop->iteration }}</td>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ $item->tanggal }} </td>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ $item->pengirim->name }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->nomor_surat }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->perihal }}</td>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ $item->nama_surat }}</td>
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                {{ $item->jenisSurat->jenis_surat }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                <a href="{{ asset('storage/surat/' . $item->filesurat) }}"
                                                    target="_blank">View File
                                                    @if (Auth::user()->unreadNotifications->where('data.surat_id', $item->id)->count() > 0)
                                                        <span class="badge bg-info">New</span>
                                                    @endif
                                                </a>
                                            </td>
                                            @if (auth()->user()->role_id == 2)
                                                <td
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                    {{ $item->asal_surat }}</td>
                                            @else
                                                <td
                                                    class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                    {{ $item->tujuan }}</td>
                                            @endif
                                            <td>
                                                @if ($item->status == 'pending')
                                                    <form action="{{ route('updateStatus', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-warning btn-sm">Terima</button>
                                                    </form>
                                                @else
                                                    <span class="badge bg-success">Surat Diterima</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary forwardBtn" data-bs-toggle="modal"
                                                    data-bs-target="#forwardModal-{{ $item->id }}">Teruskan</a>
                                            </td>
                                        </tr>


                                        <!-- Modal Teruskan Surat -->
                                        <div class="modal fade" id="forwardModal-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Teruskan Surat</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="forwardForm-{{ $item->id }}" method="POST"
                                                            action="{{ route('suratmasuk.forward', $item->id) }}">
                                                            @csrf
                                                            <div class="input-group input-group-static mb-4">
                                                                <label for="forward_to" class="ms-0">Pilih User</label>
                                                                <select class="form-control" id="forward_to"
                                                                    name="forward_to[]" multiple>
                                                                    @foreach ($users as $user)
                                                                        <option value="{{ $user->id }}">
                                                                            {{ $user->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary">Teruskan</button>
                                                        </form>
                                                    </div>
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
        </div>
    </div>
@endsection
