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
                                            Penerima</th>
                                        <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Nomor Surat</td>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Perihal</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Nama Surat</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Jenis Surat</th>
                                        @if (auth()->user()->role_id == 1)
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Asal
                                                Surat</td>
                                        @else
                                            <td class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tujuan Surat</td>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                File
                                            </th>
                                        @endif
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($surat as $item)
                                        <tr>
                                            <td
                                                class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 text-center">
                                                {{ $loop->iteration }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->tanggal }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->penerima->name }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->nomor_surat }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->perihal }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->nama_surat }}</td>
                                            <td class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                {{ $item->jenisSurat->jenis_surat }}</td>
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
                                                        target="_blank">View File @if (Auth::user()->unreadNotifications->where('data.surat_id', $item->id)->count() > 0)
                                                            <span class="badge bg-info">New</span>
                                                        @endif
                                                    </a>
                                                </td>
                                            @endif
                                            <td>
                                                <span class="badge bg-success">{{ $item->status }}</span>
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
