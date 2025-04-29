<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
    </style>
</head>
<body>
    <h2>Data Alumni</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIM</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>Program Studi</th>
                <th>Jenjang Sarjana</th>
                <th>Nomor Ijazah</th>
                <th>No. HP</th>
                <th>Provinsi</th>
                <th>Kota/Kabupaten</th>
                <th>Alamat Pengiriman</th>
                <th>Kode Pos</th>
                <th>Nama Perusahaan</th>
                <th>Jabatan di Perusahaan</th>
                <th>Alamat Perusahaan</th>
                <th>Provinsi Perusahaan</th>
                <th>Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td>{{ $student->user->name ?? '-' }}</td>
                    <td>{{ $student->user->nim ?? '-' }}</td>
                    <td>{{ $student->tanggal_lahir ?? '-' }}</td>
                    <td>{{ $student->tempat_lahir ?? '-' }}</td>
                    <td>{{ $student->program_studi ?? '-' }}</td>
                    <td>{{ $student->sarjana ?? '-' }}</td>
                    <td>{{ $student->nomor_ijazah ?? '-' }}</td>
                    <td>{{ $student->no_hp ?? '-' }}</td>
                    <td>{{ $student->province->name ?? '-' }}</td>
                    <td>{{ $student->city->name ?? '-' }}</td>
                    <td>{{ $student->alamat_pengiriman ?? '-' }}</td>
                    <td>{{ $student->kode_pos ?? '-' }}</td>
                    <td>{{ $student->nama_perusahaan ?? '-' }}</td>
                    <td>{{ $student->jabatan_perusahaan ?? '-' }}</td>
                    <td>{{ $student->alamat_perusahaan ?? '-' }}</td>
                    <td>{{ $student->companyProvince->name ?? '-' }}</td>
                    <td>{{ $student->gaji ? 'Rp ' . number_format($student->gaji, 0, ',', '.') : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
