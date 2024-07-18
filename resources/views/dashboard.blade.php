@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        @php
                            $roleName = Auth::user()->role_id == 1 ? 'Kirim Surat' : 'Request Surat';
                        @endphp
                        <h4 class="mb-0 text-capitalize">{{ $roleName }}</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <div class="row">
                        <p class="col-md-3 ">Total</p>
                        <p class="col-md-3 ms-auto">{{ $totalSurat }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class=" mb-0 text-capitalize">Surat Masuk</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <div class="row">
                        <p class="col-md-3 ">Total</p>
                        <p class="col-md-3 ms-auto">{{ $totalSuratMasuk }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
            <div class="card">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                        <i class="material-icons opacity-10">weekend</i>
                    </div>
                    <div class="text-end pt-1">
                        <h4 class=" mb-0 text-capitalize">Surat Keluar</h4>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <div class="row">
                        <p class="col-md-3 ">Total</p>
                        <p class="col-md-3 ms-auto">{{ $totalSuratKeluar }}</p>
                    </div>
                </div>
            </div>
        </div>
        @if (Auth::user()->role_id == 1)
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-danger shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <h4 class=" mb-0 text-capitalize">Jenis Surat</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="row">
                            <p class="col-md-3 ">Total</p>
                            <p class="col-md-3 ms-auto">{{ $totalJenisSurat }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-secondary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <h4 class=" mb-0 text-capitalize">Prodi</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="row">
                            <p class="col-md-3 ">Total</p>
                            <p class="col-md-3 ms-auto">{{ $totalProdi }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-warning shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <h4 class=" mb-0 text-capitalize">Akun</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <div class="row">
                            <p class="col-md-3 ">Total</p>
                            <p class="col-md-3 ms-auto">{{ $totalUser }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
