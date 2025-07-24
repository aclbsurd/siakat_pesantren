<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kuitansi Pembayaran - {{ $pembayaran->santri->nis }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Courier New', Courier, monospace; color: black; }
        .receipt-container { width: 800px; margin: auto; border: 2px solid black; padding: 30px; }
        .kop-surat { text-align: center; border-bottom: 2px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .kop-surat h5, .kop-surat p { margin: 0; }
        .title { text-align: center; font-weight: bold; font-size: 1.2rem; text-decoration: underline; margin-bottom: 20px;}
        .details-table td { padding: 5px 0; }
        .terbilang-box { border: 1px solid black; padding: 10px; font-weight: bold; font-style: italic; margin: 20px 0; }
        .ttd-section { margin-top: 30px; }
        @media print { .no-print { display: none !important; } @page { size: A5 landscape; margin: 1cm; } }
    </style>
</head>
<body>
    <div class="container my-4">
        <div class="text-center mb-4 no-print">
            <button onclick="window.print()" class="btn btn-primary">Cetak Kuitansi</button>
        </div>
        <div class="receipt-container">
            <div class="kop-surat">
                <h5>PONDOK PESANTREN AL FATAH</h5>
                <p>Komplek Dar El Hasani, Banjarnegara, Jawa Tengah</p>
            </div>
            <div class="title">KUITANSI PEMBAYARAN</div>
            <table class="details-table w-100">
                <tr>
                    <td width="25%">Telah Diterima Dari</td>
                    <td width="5%">:</td>
                    <td>{{ $pembayaran->santri->nama_lengkap ?? 'N/A' }} (NIS: {{ $pembayaran->santri->nis ?? 'N/A' }})</td>
                </tr>
                <tr>
                    <td>Uang Sejumlah</td>
                    <td>:</td>
                    <td class="terbilang-box">{{ $terbilang }}</td>
                </tr>
                 <tr>
                    <td>Untuk Pembayaran</td>
                    <td>:</td>
                    <td>{{ $pembayaran->jenis_pembayaran }} {{ $pembayaran->bulan_pembayaran ? 'Bulan ' . $pembayaran->bulan_pembayaran : '' }}</td>
                </tr>
            </table>
            <div class="row ttd-section">
                <div class="col-6">
                    <div class="h-100 p-3 text-center" style="background-color: #e9ecef;">
                        <h4 class="mb-0">Rp {{ number_format($pembayaran->jumlah_bayar, 0, ',', '.') }},-</h4>
                    </div>
                </div>
                <div class="col-6 text-center">
                    <p>Banjarnegara, {{ \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->isoFormat('D MMMM Y') }}</p>
                    <p>Penerima,</p>
                    <br><br><br>
                    <p><strong>{{ $pembayaran->user->nama ?? 'Admin' }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>