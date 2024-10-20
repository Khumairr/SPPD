<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kop Surat</title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .kop-surat {
            text-align: center;
            padding: 20px;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo {
            width: 100px;
            height: auto; 
            margin-right: 20px; /* Jarak antara logo dan teks */
        }

        p {
            margin: 5px 0;
            font-size: 12px;
        }

        hr {
            border: 2px solid #000; /* Garis bawah kop surat */
        }

        .content{
           padding: 0px 100px; 
        }

        .judul {
            text-align: center;
            margin: 0px 0px 20px 0px;
            font-size: 12px;
            font-weight: bold;
        }

        .detail-table {
            width: 100%;
            margin-bottom: 20px;
        }

        .detail-table td {
            padding: 5px;
            font-size: 12px;
            vertical-align: top;
        }

        .line{
            border: 2px solid #000;
        }

        .content-section {
            margin: 20px 0;
        }

        .content-section p {
            margin: 0;
            font-size: 12px !important;
        }

        .task-list {
            margin-top: 20px;
        }

        .task-list ol {
            padding-left: 20px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="kop-surat">
        <div class="header">
            <img src="{{ asset('img/logoutama.png') }}" alt="Logo" class="logo">
            <div class="info">
                <h2 style="margin: 0px 0px;">PEMERINTAH KOTA TANGERANG SELATAN</h2>
                <h4 style="margin: 0; font-size: 15px;">BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</h4>
                <p>Balai Kota Tangerang Selatan Gedung 2 Lt. 1 Jl. Maruga Raya No. 1 Serua-Ciputat 15414</p>
                <p>Email: bkpsdm@tangerangselatankota.go.id | Website: bkpsdm.tangerangselatankota.go.id</p>
            </div>
        </div>
        <hr>
    </div>

    <div class="content">   
        <div class="judul">NOTA DINAS</div>

        <table class="detail-table">
            <tr>
                <td>Kepada</td>
                <td>:</td>
                <td>Yth. Kepala BKPSDM Kota Tangerang Selatan</td>
            </tr>
            <tr>
                <td>Dari</td>
                <td>:</td>
                <td>Bidang Pengadaan, Penilaian Kinerja dan Informasi Kepegawaian</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</td>
            </tr>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td>{{ $details->first()->no_spt }}</td>
            </tr>
            <tr>
                <td>Lampiran</td>
                <td>:</td>
                <td>1 (satu) berkas</td>
            </tr>
            <tr>
                <td>Hal</td>
                <td>:</td>
                <td>Laporan Kegiatan</td>
            </tr>
        </table>

        <div class="line"></div>

        <div class="content-section">
            <p>Melaporkan hasil pelaksanaan tugas.</p>
        </div>

        <div class="content-section">
            <p style="margin-bottom: 5px"><strong>I. Dasar Pelaksanaan</strong></p>
            <p style="text-indent: 2em;">Surat Perintah Tugas Nomor: {{ $details->first()->no_spt }} Tanggal {{ \Carbon\Carbon::parse($details->first()->tgl_spt)->locale('id')->translatedFormat('l, d F Y') }}.</p>
        </div>

        <div class="content-section">
            <p style="margin-bottom: 5px"><strong>II. Maksud Tujuan</strong></p>
            <p style="text-indent: 2em;">{{ $details->first()->perihal_sppd }}</p>
        </div>

        <div class="content-section">
            <p style="margin-bottom: 5px"><strong>III. Hasil</strong></p>
            <p style="text-indent: 2em;">{{ $details->first()->laporan }}</p>
        </div>

        <div class="content-section">
            <p>Demikian laporan ini dibuat, untuk bukti kegiatan berupa foto terlampir.</p>
        </div>

        <table class="detail-table">
            <p style="text-decoration: underline;">Yang Melaksanakan Tugas</p>
            @foreach ($details as $index => $detail)
            <tr style="height: 35px;">
                <td style="width: 5%;">{{ $index + 1 }}.</td>
                <td style="width: 70%; text-align: left;">{{ $detail->nama_staff }}</td>
                <td style="width: 25%">(.................................................................)</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>
