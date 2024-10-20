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
            margin-top: 10px;
        }

        .judul-surat {
            font-size: 20px;
            font-weight: bold;
            margin: 0px 10px; /* Jarak antara garis dan judul */
            text-transform: uppercase;
        }

        .nomor-surat {
            font-size: 16px;
            margin: 0; /* Jarak setelah nomor surat */
        }

        .content{
           padding: 0px 20px; 
        }

        .table-content {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-content th,
        .table-content td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            vertical-align: top;
            font-size: 12px;
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

        .footer {
            text-align: right;
            margin: 0;
        }

        .tanda-tangan {
            display: inline-block;
            text-align: left;
        }
    </style>
</head>

<body onload="window.print()">
    @foreach ($details as $detail)
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
            <h3 class="judul-surat" style="text-decoration: underline;">SURAT PERJALANAN DINAS (SPD)</h3>
            <p class="nomor-surat">Nomor: {{ $detail->no_spt }}</p>
        </div>

        <div class="content">
            
            <table class="table-content">
                <tr>
                    <td>1.</td>
                    <td>Pejabat Pembuat Komitmen</td>
                    <td><strong>{{ $detail->ppk }}</strong></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Nama/NIP Pegawai yang melaksanakan perjalanan dinas</td>
                    <td>
                        {{ $detail->nama_staff }}
                        <br>
                        <br>
                        NIP: {{ $detail->nip }}
                    </td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>
                        a. Pangkat dan Golongan
                        <br><br>
                        b. Jabatan/Instansi
                        <br><br>
                        c. Tingkat Biaya Perjalanan Dinas
                    </td>
                    <td>
                        {{ $detail->golongan }}
                        <br><br>
                        {{ $detail->jabatan }}
                        <br><br>
                        Perjalanan Dinas Luar Daerah
                    </td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Maksud Perjalanan Dinas</td>
                    <td>{{ $detail->perihal_sppd }}</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Alat Angkutan yang dipergunakan</td>
                    <td>{{ $detail->angkutan }}</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>
                        a. Tempat Berangkat
                        <br><br>
                        b. Tempat Tujuan
                    </td>
                    <td>
                        BKPSDM Kota Tangerang Selatan
                        <br><br>
                        {{ $detail->tujuan }}
                    </td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>
                        a. Lamanya Perjalanan Dinas
                        <br><br>
                        b. Tanggal Berangkat
                        <br><br>
                        c. Tanggal harus kembali
                    </td>
                    <td>
                        {{ $detail->lama_perjalanan}} 
                        <br><br>
                        {{ \Carbon\Carbon::parse($detail->tgl_berangkat)->translatedFormat('d F Y') }}
                        <br><br>
                        {{ \Carbon\Carbon::parse($detail->tgl_kembali)->translatedFormat('d F Y') }}
                    </td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>
                        Pembebanan Anggaran
                        <br><br>
                        a. Instansi
                        <br><br>   
                        b. Akun
                    </td>
                    <td>
                        APBD Kota Tangerang Selatan Tahun 2024
                        <br><br>
                        Badan Kepegawaian dan Pengembangan Sumber Daya Manusia
                        <br>
                        Belanja Perjalanan Dinas Biasa (5.1.02.04.01.0001)
                    </td>
                </tr>
                <tr>
                    <td>9.</td>
                    <td>Keterangan lain-lain</td>
                    <td></td>
                </tr>
            </table>

            <div class="footer">
                <div class="tanda-tangan" style="text-align: center;">
                    <table class="detail-table">
                        <tr>
                            <td style="text-align: left;">Dikeluarkan di</td>
                            <td>:</td>
                            <td style="text-align: left;">Tangerang Selatan</td>
                        </tr>
                        <tr>
                            <td style="text-align: left;">Tanggal</td>
                            <td>:</td>
                            <td style="text-align: left;">{{ \Carbon\Carbon::parse($detail->tgl_spt)->translatedFormat('d F Y') }}</td>
                        </tr>
                    </table>
                    <p><strong>Pejabat Pembuat Komitmen,</strong></p>
                    <br><br><br>
                    <p style="text-decoration: underline;"><strong>Drs, Fuad. MPA</strong></p><!-- {{ $detail->ppk }} -->
                    <p><strong>NIP. 19741129 199303 1 003</strong></p><!-- {{ $staff1->nip }} -->
                </div>
            </div>  
        </div>
        <br>
        @if (!$loop->last)
            <div class="page-break"></div> <!-- Tambahkan page break di antara surat -->
        @endif
    @endforeach
    </body>
</html>