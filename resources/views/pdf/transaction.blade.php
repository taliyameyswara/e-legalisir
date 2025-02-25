<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            border: 1px solid #000;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .no-print {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container" id="pdf-content">
        <h1>Transaction Report</h1>
        <p><strong>Nama Penerima:</strong> {{ $transaction->user->name }}</p>
        <p><strong>No HP:</strong> {{ $transaction->no_hp }}</p>
        @if ($transaction->tipe_pengiriman == 'cod')
        <p><strong>Alamat:</strong> {{ $transaction->alamat_pengiriman }}{{ $transaction->city->name }},{{ $transaction->province->name }}</p>
        <p><strong>Kode Pos:</strong>  ({{ $transaction->kode_pos }})</p>
        @endif

        <p><strong>Jumlah Legalisir:</strong>  ({{ $transaction->jumlah_legalisir }})</p>
        <p><strong>Jumlah Pembayaran:</strong>   Rp{{ number_format($transaction->jumlah_pembayaran, 0, ',', '.') }}</p>
        <p><strong>Tipe Pengiriman:</strong>
            {{ $transaction->tipe_pengiriman == 'cod' ? 'Pengiriman COD' : 'Ambil di kampus' }}
        </p>
        <h2>Dokumen</h2>
        <table>
            <thead>
                <tr>
                    <th>Jenis Dokumen</th>
                    <th>Nama File</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ijazah</td>
                    <td>{{ $transaction->ijazah->file_name }}</td>
                </tr>
                <tr>
                    <td>Transkrip 1</td>
                    <td>{{
                        $transaction->transkrip_1 ? $transaction->transkrip_1->file_name : '-'
                    }}</td>
                </tr>
                <tr>
                    <td>Transkrip 2</td>
                    <td>{{
                    $transaction->transkrip_2 ? $transaction->transkrip_2->file_name : '-'

                    }}</td>
                </tr>
                <tr>
                    <td>Akta Mengajar</td>
                    <td>
                        {{ $transaction->r_akta_mengajar ?
                        $transaction->r_akta_mengajar->file_name : '-' }}



                    </td>
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
