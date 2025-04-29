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
    <h2>Data Pengajuan</h2>
    <table>
        <thead>
            <tr>
                <th>Tanggal Pengajuan</th>
                <th>Nama User</th>
                <th>NIM</th>
                <th>Nama Penerima</th>
                <th>Nomor Telepon</th>
                <th>Alamat Penerima</th>
                <th>Jenis Pengiriman</th>
                <th>Nomor Pengiriman</th>
                <th>File Ijazah</th>
                <th>File Transkrip</th>
                <th>File Akta</th>
                <th>Jumlah Ijazah</th>
                <th>Jumlah Transkrip</th>
                <th>Jumlah Akta</th>
                <th>Biaya Legalisir</th>
                {{-- <th>Biaya Pengiriman</th> --}}
                <th>Total Pembayaran</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->created_at ?? '-' }}</td>
                    <td>{{ $transaction->user->name ?? '-' }}</td>
                    <td>{{ $transaction->user->nim ?? '-' }}</td>
                    <td>{{ $transaction->nama_penerima ?? '-' }}</td>
                    <td>{{ $transaction->no_hp ?? '-' }}</td>
                    <td>{{ $transaction->alamat_pengiriman }} {{ $transaction->city->name }}
                        ,{{ $transaction->province->name }} ({{ $transaction->kode_pos }}) </td>
                    <td>{{ $transaction->pengiriman ?? '-' }}</td>
                    <td>{{ $transaction->nomor_pengiriman ?? '-' }}</td>
                    <td>
                        <a href="{{ asset( $transaction->ijazah->file) }}">{{ $transaction->ijazah->file_name }}</a>
                    </td>
                    <td>
                        @if ($transaction->transkrip)
                            <a href="{{ asset( $transaction->transkrip->file) }}">{{ $transaction->transkrip->file_name }}</a>

                        @endif
                    </td>
                    <td>
                        @if ($transaction->akta)
                            <a href="{{ asset( $transaction->akta->file) }}">{{ $transaction->akta->file_name }}</a>

                        @endif
                    </td>
                    <td>{{ $transaction->jumlah_ijazah ?? '-' }}</td>
                    <td>{{ $transaction->jumlah_transkrip  ?? '-' }}</td>
                    <td>{{ $transaction->jumlah_akta ?? '-' }}</td>
                    <td>Rp{{ number_format($transaction->biaya_legalisir, 0, ',', '.') }}</td>
                    {{-- <td>Rp{{ number_format($transaction->biaya_ongkir, 0, ',', '.') }}</td> --}}

                    <td class="font-semibold text-cyan-600">
                        Rp{{ number_format($transaction->total_pembayaran, 0, ',', '.') }}
                    </td>
                    <td>{{ $transaction->status  }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
