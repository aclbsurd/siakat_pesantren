<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Santri</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: black;
        }
        .kop-surat {
            text-align: center;
            border-bottom: 3px solid black;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .kop-surat h4, .kop-surat h5 {
            margin: 0;
            color: black;
        }
        .kop-surat p {
            margin: 0;
            font-size: 0.9rem;
        }
        table {
            width: 100%;
            border: 1px solid black !important;
            font-size: 0.9rem;
        }
        th, td {
            border: 1px solid black !important;
            padding: 8px;
            text-align: left;
            color: black;
        }
        th {
            background-color: #e9ecef !important; /* Warna abu-abu muda untuk header tabel */
            -webkit-print-color-adjust: exact; /* Memastikan warna background tercetak */
            color-adjust: exact;
            text-align: center;
        }
        .ttd-section {
            margin-top: 50px;
        }
        /* Style khusus untuk media cetak */
        @media print {
            .no-print {
                display: none !important;
            }
            @page {
                size: A4 portrait;
                margin: 2cm;
            }
            body {
                margin: 0;
                -webkit-print-color-adjust: exact; /* Memastikan warna background tercetak di Chrome/Safari */
                color-adjust: exact;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="kop-surat">
            <h4>LAPORAN DATA SANTRI</h4>
            <h5>PONDOK PESANTREN AL FATAH</h5>
            <p>Komplek Dar El Hasani, Banjarnegara, Jawa Tengah</p>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3 no-print">
            <div>
                @if($search)
                    <p class="mb-0">Hasil pencarian untuk: <strong>"{{ $search }}"</strong></p>
                @endif
            </div>
            <div class="text-end">
                <button onclick="window.print()" class="btn btn-primary">
                    <i class="bi bi-printer"></i> Cetak Halaman Ini
                </button>
            </div>
        </div>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>NIS</th>
                    <th>Nama Lengkap</th>
                    <th>Jenis Kelamin</th>
                    <th>Kelas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($santris as $index => $santri)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $santri->nis }}</td>
                        <td>{{ $santri->nama_lengkap }}</td>
                        <td>{{ $santri->jenis_kelamin }}</td>
                        <td>{{ $santri->kelas->nama_kelas ?? 'N/A' }}</td>
                        <td class="text-center">{{ $santri->status }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="row ttd-section">
            <div class="col-8"></div>
            <div class="col-4 text-center">
                <p>Banjarnegara, {{ $tanggalCetak }}</p>
                <p>Pimpinan Pondok,</p>
                <br><br><br>
                <p><strong>(___________________)</strong></p>
            </div>
        </div>
    </div>
</body>
</html>