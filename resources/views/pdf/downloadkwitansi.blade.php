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
            padding: 0;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo {
            width: 75px;
            height: auto; 
            margin-right: 20px; /* Jarak antara logo dan teks */
        }

        p {
            margin: 5px 0;
            font-size: 10px;
        }

        hr {
            border: 3px solid #000; /* Garis bawah kop surat */
        }

        .judul-surat {
            font-size: 16px;
            font-weight: bold;
            margin: 0px 10px; /* Jarak antara garis dan judul */
            text-transform: uppercase;
            text-align: center;
        }

        .nomor-surat {
            font-size: 16px;
            margin: 0; /* Jarak setelah nomor surat */
            text-align: center ;
        }

        .table-content {
            width: 99.9%;
            border-collapse: collapse;
            margin: 0;
            border: 1px solid black;
        }

        .table-content td.eth {
            padding-bottom: 12px;
            text-align: left;
            font-size: 10px;
            border: 1px solid #000;
        }

        /*.table-content td.ext {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
            vertical-align: middle;
        }*/

        .detail-table {
            width: 100%;
        }

        .detail-table td {
            padding: 5px;
            font-size: 10px;
            vertical-align: top;
            border: none;
        }
    </style>
</head>

@foreach($employeeGroups as $group)
<body onload="window.print()">
    @foreach($group as $employee)
    <table class="table-content" style="margin-bottom: 20px;">
        <tr>
            <td clas="eth" style="width: 70%;">
                <div class="kop-surat">
                    <div class="header">
                        <img src="{{ asset('img/tangsel.jpg') }}" alt="Logo" class="logo">
                        <div class="info">
                            <p style="margin: 0px 0px; font-size: 16px;"><strong>PEMERINTAH KOTA TANGERANG SELATAN</strong></p>
                            <p style="margin: 0;"><strong>BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA</strong></p>
                            <p>Balai Kota Tangerang Selatan Gedung 2 Lt. 1 Jl. Maruga Raya No. 1 Serua-Ciputat 15414</p>
                            <p>Email: bkpsdm@tangerangselatankota.go.id | Website: bkpsdm.tangerangselatankota.go.id</p>
                        </div>
                    </div>
                    <hr>
                </div>
            </td>
            <td clas="eth" style="width: 30%;">
                <table class="detail-table">
                    <tr>
                        <td clas="eth">Nomor</td>
                        <td clas="eth">:</td>
                        <td clas="eth">..........................</td>
                    </tr>

                    <tr>
                        <td clas="eth">Tanggal</td>
                        <td clas="eth">:</td>
                        <td clas="eth">..........................</td>
                    </tr>

                    <tr>
                        <td clas="eth">No.Rek</td>
                        <td clas="eth">:</td>
                        <td clas="eth">5.1.02.04.01.0001</td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr>
            <td clas="eth" colspan="2">
                <p class="judul-surat" style="text-decoration: underline;">KWITANSI/TANDA PENGELUARAN DANA</p>
                <p class="nomor-surat">Nomor   :   {{ $employee->no_kwitansi }}</p> 
            </td>
        </tr>

        <tr>
            <td clas="eth" colspan="2">
                <p>SUDAH DITERIMA DARI PENGGUNA ANGGARAN BADAN KEPEGAWAIAN DAN PENGEMBANGAN SUMBER DAYA MANUSIA KOTA TANGERANG SELATAN</p>
            </td>
        </tr>
            <tr>
                <td clas="eth" colspan="2">
                    <table class="detail-table">
                    <tr>
                        <td clas="eth" style="width: 75px;">Sebesar</td>
                        <td clas="eth">:</td>
                        <td clas="eth" style="padding-bottom: 15px;">
                            <strong style="border: 2px solid #000; padding: 5px;">
                                <span style="margin-right: 8px;">Rp</span> 
                                {{ number_format($employee->total_kwitansi, 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td clas="eth" style="width: 75px;">Terbilang</td>
                        <td clas="eth">:</td>
                        <td clas="eth" style="padding-bottom: 10px;">
                            <strong style="border: 2px solid #000; padding: 5px 50px;">
                            # {{ angkaKeTerbilang($employee->total_kwitansi) }} Rupiah #
                            </strong>
                        </td>
                    </tr>
                    <tr>
                        <td clas="eth" style="width: 75px;">Yaitu Untuk</td>
                        <td clas="eth">:</td>
                        <td clas="eth" style="padding-bottom: 15px;">{{ $employee->perihal_sppd }}, pada tanggal {{ \Carbon\Carbon::parse($employee->tgl_berangkat)->locale('id')->translatedFormat('d')}} - {{ \Carbon\Carbon::parse($employee->tgl_kembali)->locale('id')->translatedFormat('d F ') }}.</td>
                    </tr>
                    <tr>
                        <td clas="eth" style="width: 75px;">Kegiatan</td>
                        <td clas="eth">:</td>
                        <td clas="eth">Administrasi Umum Perangkat Daerah</td>
                    </tr>
                    <tr>
                        <td clas="eth" style="width: 75px;">Sub Kegiatan</td>
                        <td clas="eth">:</td>
                        <td clas="eth">Penyelenggaraan Rapat Koordinasi dan Konsultasi SKPD</td>
                    </tr>
                </table>

                <table style="padding-bottom: 12px;">
                    <tr>
                        <td rowspan="3" style="vertical-align: top; width: 75px; font-size: 10px; padding: 5px;">Keterangan</td>
                        <td style="vertical-align: top; font-size: 10px; padding: 6px 16px 0px 6px;">:</td>
                        <td>
                            <table>
                                <tr>
                                    <td style="padding-top: 0 !important; font-size: 10px;"><span>Uang Harian</span></td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">:</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{ $employee->lama_perjalanan }} hari</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">X</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">Rp</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{ number_format($employee->uang_hari, 0, ',', '.') }}</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">=</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">Rp</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{number_format($employee->total_harian, 0, ',', '.') }}</td>
                                </tr>

                                <tr>
                                    <td style="padding-top: 0 !important; font-size: 10px;"><span>Transport</span></td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">:</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{ number_format($employee->biaya_transport, 0, ',', '.') }} Kali</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">X</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">Rp</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{ number_format($employee->uang_transport, 0, ',', '.') }}</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">=</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">Rp</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{number_format($employee->total_transport, 0, ',', '.') }}</td>
                                </tr>

                                <tr>
                                    <td style="padding-top: 0 !important; font-size: 10px;"><span>Akomodasi</span></td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">:</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{ $employee->lama_akomodasi }} Malam</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">X</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">Rp</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{ number_format($employee->uang_akomodasi, 0, ',', '.') }}</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">=</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">Rp</td>
                                    <td style="padding-top: 0 !important; font-size: 10px;">{{number_format($employee->total_akomodasi, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 0px !important">
                <table class="table-content">
                    <tr>
                        <td class="eth" style="padding-bottom: 0px;">
                            <div>
                                <div style="text-align: center; margin-top: 10px;">
                                    <p>Mengetahui/Menyetujui,</p>
                                    <span><strong>Pengguna Anggaran</strong></span>
                                    <br><br><br><br><br><br>
                                    <span style="text-decoration: underline; padding: 0px;"><strong>Drs, Fuad. MPA</strong></span>
                                    <br>
                                    <span>NIP. 19741129 199303 1 003</span>
                                </div>
                            </div>
                        </td>

                        <td class="eth" style="padding-bottom: 0px;">
                            <div>
                                <div style="text-align: center; margin-top: 10px;">
                                    <p>Mengetahui,</p>
                                    <span><strong>Pejabat Pelaksana Teknis Kegiatan,</strong></span>
                                    <br><br><br><br><br><br>
                                    <span style="text-decoration: underline; padding: 0px;"><strong>Boy Muhammad Danial, S.SI., M.SI</strong></span>
                                    <br>
                                    <span>NIP. 19720708 200312 1 008</span>
                                </div>
                            </div>
                        </td>

                        <td class="eth" style="padding-bottom: 0px;">
                            <div>
                                <div style="text-align: center; margin-top: 10px;">
                                    <p>Telah Dibayar,</p>
                                    <span><strong>Bendahara Pengeluaran,</strong></span>
                                    <br><br><br><br><br><br>
                                    <span style="text-decoration: underline; padding: 0px;"><strong>Yani Octarani, S,E.</strong></span>
                                    <br>
                                    <span>NIP. 19821005 200801 2 014</span>
                                </div>
                            </div>
                        </td>

                        <td class="eth" style="padding-bottom: 0px;">
                            <p style="position: relative; top: -5px;">Tangerang Selatan, .............</p>
                            <div>
                                <div style="text-align: center; margin-top: 10px;">
                                    <span><strong>Yang Menerima,</strong></span>
                                    <br><br><br><br><br><br>
                                    <span style="text-decoration: underline; padding: 0px;"><strong>{{ $employee->nama_staff }}</strong></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    @endforeach
</body>
@endforeach

</html>
