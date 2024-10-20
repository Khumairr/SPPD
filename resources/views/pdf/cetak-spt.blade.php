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

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid transparent;
            padding-left: 8px;
            padding-right: 8px;
            text-align: left;
            font-size: 12px;
        }

        table.kiri, table.kanan{ 
            font-size: 12px;
        }

        .tabel-kiri-kanan {
            display: flex;
            justify-content: space-between;
            margin: 0px 5px;
        }

        .tabel-kiri{
            width: 15%;
        }

        .tabel-kanan{
            width: 85%;
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
        <h3 class="judul-surat" style="text-decoration: underline;">SURAT PERINTAH TUGAS</h3>
        <p class="nomor-surat">Nomor: {{ $sppd->no_spt }}</p>
    </div>

    <div class="content">
        <table class="table">
            <tr>
                <td rowspan="3" style="vertical-align: top;"><strong>Dasar</strong></td>
                <td rowspan="3" style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">1.</td>
                <td>Peraturan Wali Kota Tangerang Selatan Nomor 35 Tahun 2022 tentang Kedudukan, Susunan Organisasi, Tugas, Fungsi dan Tata Kerja Badan Kepegawaian dan Pengembangan Sumber Daya Manusia.</td>
            </tr>

            <tr>
                <td style="vertical-align: top;">2.</td>
                <td>Peraturan Daerah Kota Tangerang Selatan Nomor 9 Tahun 2023 tentang Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024;</td>
            </tr>

            <tr>
                <td style="vertical-align: top;">3.</td>
                <td>Peraturan Wali Kota Tangerang Selatan Nomor 78 Tahun 2023 tentang Penjabaran Anggaran Pendapatan dan Belanja Daerah Tahun Anggaran 2024.</td>
            </tr>
        </table>      

        <h3 class="judul-surat" style="text-align: center; margin: 10px">MEMERINTAHKAN :</h3>  

        <div class="tabel-kiri-kanan">
            <div class="tabel-kiri">
                <table class="kiri">
                    <tr>
                        <td style="vertical-align: top; width: 75px;"><strong>Kepada</strong></td>
                        <td>:</td>
                    </tr>
                </table>
            </div>
            <div class="tabel-kanan">
                @foreach ($pegawaiList as $index => $pegawai)
                <table class="kanan">
                    <tr>
                        <td rowspan="4" style="vertical-align: top; width: 15px;">{{ $index + 1 }}.</td>
                        <td style="vertical-align: top; width: 75px;">Nama</td>
                        <td style="vertical-align: top; width: 15px;">:</td>
                        <td>{{ $pegawai->nama_staff }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 75px;">NIP</td>
                        <td style="vertical-align: top; width: 15px;">:</td>
                        <td>{{ $pegawai->nip }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 75px;">Gol.</td>
                        <td style="vertical-align: top; width: 15px;">:</td>
                        <td>{{ $pegawai->golongan }}</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; width: 75px;">Jabatan</td>
                        <td style="vertical-align: top; width: 15px;">:</td>
                        <td>{{ $pegawai->jabatan }}</td>
                    </tr>
                </table>
                @endforeach
            </div>
        </div>

        <table class="table" style="margin: 15px 0px;">
            <tr>
                <td rowspan="3" style="vertical-align: top;"><strong>Untuk</strong></td>
                <td rowspan="3" style="vertical-align: top;">:</td>
                <td>{{ $sppd->perihal_sppd}}, pada tanggal {{ \Carbon\Carbon::parse($sppd->tgl_berangkat)->locale('id')->translatedFormat('d')}} - {{ \Carbon\Carbon::parse($sppd->tgl_kembali)->locale('id')->translatedFormat('d F ') }}.<br> Demikian surat perintah tugas ini, untuk dilaksanakan dengan penuh tanggung jawab.</td>
            </tr>
        </table>      

        <div class="footer">
            <div class="tanda-tangan" style="text-align: center;">
                <p>Tangerang Selatan, {{ \Carbon\Carbon::parse($sppd->tgl_spt)->locale('id')->translatedFormat('d F Y') }}</p>
                <p><strong>KEPALA,</strong></p>
                <br><br><br>
                <p style="text-decoration: underline;"><strong>Drs, Fuad. MPA</strong></p><!-- {{ $sppd->ppk }} -->
                <p>Pembina Utama Muda</p><!-- {{ $staffFixed->golongan }} -->
                <p>NIP. 19741129 199303 1 003</p><!-- {{ $staffFixed->nip }} -->
            </div>
        </div>  
    </div>
</body>

</html>
