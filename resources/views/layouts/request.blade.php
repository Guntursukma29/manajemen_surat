<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" sizes="76x76" href="{{ asset('../assets') }}/img/logo-almaata.png">
    <link rel="icon" type="image/png" href="{{ asset('../assets') }}/img/logo-almaata.png">
    <title>
        Selamat Datang
    </title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('../assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('../assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('../assets') }}/css/material-dashboard.css?v=3.1.0" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="bg-gray-200">

    <main class="main-content mt-0">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('landingpage') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('request_surat.index') }}">Pengajuan Surat</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section>
            <div class="page-header min-vh-100 ">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-md-6 text-center">
                            <img src="{{ asset('assets') }}/img/logo-almaata.png" style="width: 300px"
                                alt="{{ asset('assets') }}/img/logo-almaata.png">
                            <br>
                            <h2 class="text-center">Selamat Datang Di Website Manajemen Surat Universitas Alma Ata</h2>
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('request_surat.store') }}"
                                                    role="form text-left" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="mb-3">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input type="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            id="email" name="email" required>
                                                        @error('email')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="nim" class="form-label">NIM</label>
                                                        <input type="text"
                                                            class="form-control @error('nim') is-invalid @enderror"
                                                            id="nim" name="nim" required>
                                                        @error('nim')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="nama" class="form-label">Nama</label>
                                                        <input type="text"
                                                            class="form-control @error('nama') is-invalid @enderror"
                                                            id="nama" name="nama" required>
                                                        @error('nama')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="no_telp" class="form-label">No Telp</label>
                                                        <input type="text"
                                                            class="form-control @error('no_telp') is-invalid @enderror"
                                                            id="no_telp" name="no_telp" required>
                                                        @error('no_telp')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>


                                                    <div class="mb-3">
                                                        <label for="angkatan" class="form-label">Angkatan</label>
                                                        <input type="number"
                                                            class="form-control @error('angkatan') is-invalid @enderror"
                                                            id="angkatan" name="angkatan" required>
                                                        @error('angkatan')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="prodi" class="form-label">Prodi</label>
                                                        <select
                                                            class="form-control @error('prodi_id') is-invalid @enderror"
                                                            id="prodi" name="prodi_id" required>
                                                            <option value="">Pilih Prodi</option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('prodi_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="keperluan" class="form-label">Keperluan</label>
                                                        <select
                                                            class="form-control @error('keperluan_id') is-invalid @enderror"
                                                            id="keperluan" name="keperluan_id" required>
                                                            <option value="">Pilih Keperluan</option>
                                                            @foreach ($jenisSurat as $jenis)
                                                                <option value="{{ $jenis->id }}">
                                                                    {{ $jenis->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('keperluan_id')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <!-- Additional fields -->
                                                    <div class="additional-fields">

                                                        <div class="mb-3">
                                                            <label for="judul_skripsi" class="form-label">Judul
                                                                Skripsi</label>
                                                            <input type="text"
                                                                class="form-control @error('judul_skripsi') is-invalid @enderror"
                                                                id="judul_skripsi" name="judul_skripsi">
                                                            @error('judul_skripsi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="data_yang_dibutuhkan" class="form-label">Data
                                                                yang Dibutuhkan</label>
                                                            <input type="text"
                                                                class="form-control @error('data_yang_dibutuhkan') is-invalid @enderror"
                                                                id="data_yang_dibutuhkan" name="data_yang_dibutuhkan">
                                                            @error('data_yang_dibutuhkan')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="jumlah_data" class="form-label">Jumlah
                                                                Data</label>
                                                            <input type="number"
                                                                class="form-control @error('jumlah_data') is-invalid @enderror"
                                                                id="jumlah_data" name="jumlah_data">
                                                            @error('jumlah_data')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="cara_pengambilan_data" class="form-label">Cara
                                                                Pengambilan Data</label>
                                                            <input type="text"
                                                                class="form-control @error('cara_pengambilan_data') is-invalid @enderror"
                                                                id="cara_pengambilan_data"
                                                                name="cara_pengambilan_data">
                                                            @error('cara_pengambilan_data')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="waktu_penelitian" class="form-label">Waktu
                                                                Penelitian</label>
                                                            <input type="text"
                                                                class="form-control @error('waktu_penelitian') is-invalid @enderror"
                                                                id="waktu_penelitian" name="waktu_penelitian">
                                                            @error('waktu_penelitian')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="dosen_pembimbing" class="form-label">Dosen
                                                                Pembimbing</label>
                                                            <input type="text"
                                                                class="form-control @error('dosen_pembimbing') is-invalid @enderror"
                                                                id="dosen_pembimbing" name="dosen_pembimbing">
                                                            @error('dosen_pembimbing')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama_instansi" class="form-label">Nama
                                                                Instansi</label>
                                                            <input type="text"
                                                                class="form-control @error('nama_instansi') is-invalid @enderror"
                                                                id="nama_instansi" name="nama_instansi">
                                                            @error('nama_instansi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="nama_pimpinan" class="form-label">Nama
                                                                Pimpinan</label>
                                                            <input type="text"
                                                                class="form-control @error('nama_pimpinan') is-invalid @enderror"
                                                                id="nama_pimpinan" name="nama_pimpinan">
                                                            @error('nama_pimpinan')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="alamat_instansi" class="form-label">Alamat
                                                                Instansi</label>
                                                            <input type="text"
                                                                class="form-control @error('alamat_instansi') is-invalid @enderror"
                                                                id="alamat_instansi" name="alamat_instansi">
                                                            @error('alamat_instansi')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="mb-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                        <a href="{{ route('landingpage') }}"
                                                            class="btn btn-secondary">Cancel</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center align-items-center"></div>
                </div>
            </div>
        </section>
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('../assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('../assets') }}/js/core/bootstrap.min.js"></script>
    <script src="{{ asset('../assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('../assets') }}/js/plugins/smooth-scrollbar.min.js"></script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/material-dashboard.min.js?v=3.1.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const keperluanSelect = document.getElementById('keperluan');
            const additionalFields = document.querySelectorAll('.additional-fields .mb-3');

            function updateFieldVisibility() {
                const selectedKeperluan = keperluanSelect.value;

                // Show or hide fields based on the selected keperluan
                additionalFields.forEach(field => {
                    field.style.display = 'none';
                });

                // Assuming these are the IDs for the respective keperluan
                const izinPenelitianId = '1'; // replace with the actual id
                const layakEtikId = '3'; // replace with the actual id
                const magangId = '2'; // replace with the actual id

                if (selectedKeperluan === izinPenelitianId || selectedKeperluan === layakEtikId) {
                    additionalFields.forEach(field => {
                        field.style.display = 'block';
                    });
                } else if (selectedKeperluan === magangId) {
                    document.getElementById('nama_instansi').parentElement.style.display = 'block';
                    document.getElementById('nama_pimpinan').parentElement.style.display = 'block';
                    document.getElementById('alamat_instansi').parentElement.style.display = 'block';
                }
            }

            keperluanSelect.addEventListener('change', updateFieldVisibility);

            // Initial update to set correct visibility on page load
            updateFieldVisibility();
        });
    </script>

</body>

</html>
