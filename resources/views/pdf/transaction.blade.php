{{-- <!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Transaksi Pengajuan</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #eef2f7;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 900px;
      margin: auto;
      background-color: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #2c3e50;
      margin-bottom: 30px;
    }

    h2 {
      margin-top: 40px;
      color: #34495e;
      border-bottom: 2px solid #3498db;
      padding-bottom: 5px;
    }

    .info p {
      margin: 10px 0;
      color: #333;
      font-size: 15px;
    }

    .info p strong {
      width: 180px;
      display: inline-block;
      color: #2c3e50;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 14px;
      text-align: left;
    }

    th {
      background-color: #3498db;
      color: white;
    }

    td {
      border-bottom: 1px solid #e0e0e0;
    }

    tr:last-child td {
      border-bottom: none;
    }

    /* Ikon ceklist */
    .check-icon {
      color: #27ae60;
      font-size: 18px;
    }

    .dash {
      color: #ccc;
    }

    hr {
      border: none;
      border-top: 1px solid #ddd;
      margin: 20px 0;
    }

    @media print {
      body {
        background: white;
      }

      .container {
        box-shadow: none;
        border-radius: 0;
      }

      h1 {
        font-size: 20px;
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
      <p><strong>Alamat:</strong> {{ $transaction->alamat_pengiriman }}, {{ $transaction->city->name }}, {{ $transaction->province->name }}</p>
      <p><strong>Kode Pos:</strong> {{ $transaction->kode_pos }}</p>
      <p><strong>Status Pengajuan:</strong> {{ ucfirst($transaction->status) }}</p>
      <hr />
      <p><strong>Biaya Legalisir:</strong> Rp{{ number_format($transaction->biaya_legalisir, 0, ',', '.') }}</p>
      <p><strong>Biaya Pengiriman:</strong> Rp{{ number_format($transaction->biaya_ongkir, 0, ',', '.') }}</p>
      <p><strong>Jumlah Pembayaran:</strong> <strong style="color:#e74c3c;">Rp{{ number_format($transaction->total_pembayaran, 0, ',', '.') }}</strong></p>
      <hr />
      <p><strong>Jenis Pengiriman:</strong> {{ $transaction->pengiriman }}</p>
      <p><strong>Nomor Pengiriman:</strong> {{ $transaction->nomor_pengiriman }}</p>
    </div>

    <h2>Detail Dokumen</h2>
    <table>
      <thead>
        <tr>
          <th>Jenis Dokumen</th>
          <th>Jumlah</th>
          <th>Ketersediaan</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Ijazah</td>
          <td>{{ $transaction->jumlah_ijazah ?? 0 }}</td>
          <td>
            {!! $transaction->ijazah->file_name ? '<i class="fa-solid fa-circle-check check-icon"></i>' : '<span class="dash">-</span>' !!}
          </td>
        </tr>
        <tr>
          <td>Transkrip</td>
          <td>{{ $transaction->jumlah_transkrip ?? 0 }}</td>
          <td>
            {!! $transaction->transkrip ? '<i class="fa-solid fa-circle-check check-icon"></i>' : '<span class="dash">-</span>' !!}
          </td>
        </tr>
        <tr>
          <td>Akta Mengajar</td>
          <td>{{ $transaction->jumlah_akta ?? 0 }}</td>
          <td>
            {!! $transaction->akta ? '<i class="fa-solid fa-circle-check check-icon"></i>' : '<span class="dash">-</span>' !!}
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
  <script>
    window.onload = function () {
      const element = document.getElementById('pdf-content');
      html2pdf()
        .from(element)
        .save('Transaction_Report.pdf');
    };
  </script>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi Pengajuan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        .container {
            width: 85%;
            max-width: 1000px;
            margin: 30px auto;
            padding: 30px;
            border: 1px solid #e0e0e0;
            background-color: #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2c3e50;
        }

        .header img {
            height: 80px;
            margin-bottom: 15px;
        }

        h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 5px;
            font-weight: 600;
        }

        .subtitle {
            color: #7f8c8d;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .info-section {
            margin-bottom: 25px;
        }

        .section-title {
            background-color: #f2f2f2;
            padding: 10px 15px;
            color: #2c3e50;
            font-weight: 600;
            margin: 20px 0 15px 0;
            border-left: 4px solid #3498db;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 15px;
        }

        .info-item {
            margin-bottom: 8px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            display: inline-block;
            width: 160px;
        }

        .info-value {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        th {
            background-color: #2c3e50;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 500;
        }

        td {
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }

        tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        .status {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 13px;
        }

        .status-pending {
            background-color: #f39c12;
            color: white;
        }

        .status-processed {
            background-color: #3498db;
            color: white;
        }

        .status-completed {
            background-color: #27ae60;
            color: white;
        }

        .status-cancelled {
            background-color: #e74c3c;
            color: white;
        }

        .total-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
            border-left: 4px solid #3498db;
        }

        .total-label {
            font-weight: 600;
            color: #2c3e50;
        }

        .total-value {
            font-weight: 600;
            color: #27ae60;
            font-size: 18px;
        }

        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
        }

        .checkmark {
            color: #27ae60;
            font-weight: bold;
        }


    @media print {
        body {
            background: none;
            font-size: 12px;
            margin: 0;
            padding: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .container {
            width: 100%;
            border: none;
            box-shadow: none;
            padding: 5mm; /* margin cetak standar */
            margin: 0;
        }

        table {
            page-break-inside: avoid;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        .info-grid {
            display: block;
        }

        .info-item {
            display: inline-block;
            width: 48%;
            margin-bottom: 5px;
            page-break-inside: avoid;
        }

        /* Pastikan tabel tidak melebihi lebar halaman */
        table {
            width: 100%;
            max-width: 100%;
            table-layout: fixed;
            word-wrap: break-word;
        }

        th, td {
            padding: 6px 8px;
            font-size: 11px;
        }

        /* Atur margin halaman */
        @page {
            size: A4 portrait;
            margin: 15mm 10mm;
        }

        /* Untuk halaman tambahan jika konten panjang */
        .break-after {
            page-break-after: always;
        }

        .no-break {
            page-break-inside: avoid;
        }
    }

    </style>
</head>

<body>
    <div class="container" id="pdf-content">
        <div class="header">
            <!-- Logo perusahaan bisa ditambahkan di sini -->
            <!-- <img src="path/to/company-logo.png" alt="Company Logo"> -->
            <h1>LAPORAN TRANSAKSI PENGAJUAN</h1>
            <div class="subtitle">Nomor Transaksi: {{ $transaction->id }} | Tanggal: {{ date('d/m/Y', strtotime($transaction->created_at)) }}</div>
        </div>

        <div class="info-section">
            <div class="section-title">INFORMASI PENERIMA</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nama Penerima:</span>
                    <span class="info-value">{{ $transaction->user->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">No. Telepon:</span>
                    <span class="info-value">{{ $transaction->no_hp }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Alamat:</span>
                    <span class="info-value">{{ $transaction->alamat_pengiriman }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Kota/Kabupaten:</span>
                    <span class="info-value">{{ $transaction->city->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Provinsi:</span>
                    <span class="info-value">{{ $transaction->province->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Kode Pos:</span>
                    <span class="info-value">{{ $transaction->kode_pos }}</span>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="section-title">RINCIAN PENGAJUAN</div>
            <table>
                <thead>
                    <tr>
                        <th>Jenis Dokumen</th>
                        <th>Jumlah</th>
                        <th>Ketersediaan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ijazah</td>
                        <td>{{ $transaction->jumlah_ijazah ?? 0 }} dokumen</td>
                        <td><span class="checkmark">{{ $transaction->ijazah->file_name ? '✓ Tersedia' : '-' }}</span></td>
                    </tr>
                    <tr>
                        <td>Transkrip Nilai</td>
                        <td>{{ $transaction->jumlah_transkrip ?? 0 }} dokumen</td>
                        <td><span class="checkmark">{{ $transaction->transkrip ? '✓ Tersedia' : '-' }}</span></td>
                    </tr>
                    <tr>
                        <td>Akta Mengajar</td>
                        <td>{{ $transaction->jumlah_akta ?? 0 }} dokumen</td>
                        <td><span class="checkmark">{{ $transaction->akta ? '✓ Tersedia' : '-' }}</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="info-section">
            <div class="section-title">INFORMASI PENGIRIMAN</div>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Jenis Pengiriman:</span>
                    <span class="info-value">{{ $transaction->pengiriman }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Nomor Resi:</span>
                    <span class="info-value">{{ $transaction->nomor_pengiriman ?: '-' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status:</span>
                    <span class="info-value">
                        <span class="status status-{{ strtolower($transaction->status) }}">
                            {{ ucfirst($transaction->status) }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div class="info-section">
            <div class="section-title">RINCIAN PEMBAYARAN</div>
            <div class="total-box">
                <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Biaya Legalisir:</span>
                    <span>Rp{{ number_format($transaction->biaya_legalisir, 0, ',', '.') }}</span>
                </div>
                {{-- <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                    <span>Biaya Pengiriman:</span>
                    <span>Rp{{ number_format($transaction->biaya_ongkir, 0, ',', '.') }}</span>
                </div> --}}
                <div style="display: flex; justify-content: space-between; font-size: 16px; padding-top: 10px; border-top: 1px solid #ddd;">
                    <span class="total-label">TOTAL PEMBAYARAN:</span>
                    <span class="total-value">Rp{{ number_format($transaction->total_pembayaran, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <div class="footer">
            <p>Dokumen ini dicetak secara otomatis pada {{ date('d F Y H:i:s') }}</p>
            <p>&copy; {{ date('Y') }} Nama Perusahaan. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        window.onload = function() {
            const element = document.getElementById('pdf-content');
            const opt = {
                margin: [10, 10, 10, 10], // margin atas, kanan, bawah, kiri dalam mm
                filename: 'Laporan_Transaksi_{{ $transaction->id }}.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: {
                    scale: 2,
                    useCORS: true,
                    letterRendering: true,
                    allowTaint: true,
                    scrollX: 0,
                    scrollY: 0
                },
                jsPDF: {
                    unit: 'mm',
                    format: 'a4',
                    orientation: 'portrait',
                    compress: true
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                }
            };

            // Tambahkan class no-print untuk elemen yang tidak ingin dicetak
            html2pdf().set(opt).from(element).save();
        };
    </script>
</body>

</html>
