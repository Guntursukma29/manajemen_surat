<!DOCTYPE html>
<html>

<head>
    <title>Rekap Surat Keluar</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 100%;
            max-width: 1000px;
            /* Maximum width for the content */
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Ensures table stays within container */
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            /* Ensures long words break to fit within cells */
            font-size: 12px;
            /* Adjust font size if necessary */
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Rekap Surat Keluar</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tanggal</th>
                    <th>Tanggal Diterima</th>
                    <th>Pengirim</th>
                    <th>Perihal</th>
                    <th>Jenis Surat</th>
                    <th>Bentuk Surat</th>
                    @if (auth()->user()->role_id == 2)
                        <th>Asal Surat</th>
                    @else
                        <th>Tujuan Surat</th>
                    @endif
                    <th>File Surat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($suratMasuk as $surat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $surat->tanggal }}</td>
                        <td>{{ $surat->updated_at }}</td>
                        <td>{{ $surat->pengirim->name }}</td>
                        <td>{{ $surat->nama_surat }}</td>
                        <td>{{ $surat->jenisSurat->jenis_surat }}</td>
                        <td>{{ $surat->bentuk_surat }}</td>
                        @if (auth()->user()->role_id == 2)
                            <td>{{ $surat->asal_surat }}</td>
                        @else
                            <td>{{ $surat->tujuan }}</td>
                        @endif
                        <td>{{ $surat->filesurat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
