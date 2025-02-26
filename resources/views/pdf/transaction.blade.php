<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Pengajuan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }

        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            border: 1px solid #000;
            background-color: #fff;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        .info p {
            margin: 5px 0;
        }

        /* Tambahan untuk mode cetak */
        @media print {
            body {
                background: none;
            }

            .container {
                width: 100%;
                border: none;
                box-shadow: none;
                margin-top: 50px;
                /* Menambahkan margin atas */
            }

            h1 {
                font-size: 22px;
            }

            table {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container" id="pdf-content">
        <h1>Laporan Transaksi Pengajuan</h1>
        <div class="info">
            <p><strong>Nama Penerima:</strong> {{ $transaction->user->name }}</p>
            <p><strong>No HP:</strong> {{ $transaction->no_hp }}</p>
            @if ($transaction->tipe_pengiriman == 'cod')
                <p><strong>Alamat:</strong> {{ $transaction->alamat_pengiriman }}, {{ $transaction->city->name }},
                    {{ $transaction->province->name }}</p>
                <p><strong>Kode Pos:</strong> {{ $transaction->kode_pos }}</p>
            @endif
            <p><strong>Jumlah Legalisir:</strong> {{ $transaction->jumlah_legalisir }}</p>
            <p><strong>Jumlah Pembayaran:</strong> Rp{{ number_format($transaction->jumlah_pembayaran, 0, ',', '.') }}
            </p>
            <p><strong>Tipe Pengiriman:</strong>
                {{ $transaction->tipe_pengiriman == 'cod' ? 'Pengiriman COD' : 'Ambil di kampus' }}</p>
            <p><strong>Status Pengajuan:</strong> {{ ucfirst($transaction->status) }}</p>
        </div>

        <h2>Dokumen</h2>
        <table>
            <thead>
                <tr>
                    <th>Jenis Dokumen</th>
                    <th>Ketersediaan Dokumen</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ijazah</td>
                    <td>{{ $transaction->ijazah->file_name ? '✅' : '-' }}</td>
                </tr>
                <tr>
                    <td>Transkrip 1</td>
                    <td>{{ $transaction->transkrip_1 ? '✅' : '-' }}</td>
                </tr>
                <tr>
                    <td>Transkrip 2</td>
                    <td>{{ $transaction->transkrip_2 ? '✅' : '-' }}</td>
                </tr>
                <tr>
                    <td>Akta Mengajar</td>
                    <td>{{ $transaction->r_akta_mengajar ? '✅' : '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        window.onload = function() {
            const element = document.getElementById('pdf-content');
            html2pdf()
                .from(element)
                .save('Transaction_Report.pdf');
        };
    </script>
</body>

</html>
