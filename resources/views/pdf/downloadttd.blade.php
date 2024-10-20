<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Surat Perjalanan Dinas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .table-content {
            width: 99%;
            border-collapse: collapse;
            margin: 0;
        }

        .table-content td.ext {
            border: 1px solid black;
/*            padding: 8px;*/
            text-align: left;
            vertical-align: top;
            height: 150px;
        }

        .detail-table {
            width: 100%;
        }

        .detail-table td {
/*            padding: 5px;*/
            font-size: 12px;
            vertical-align: top;
            border: none;
        }

        .tanda-tangan {
            display: inline-block;
            text-align: left;
            margin: 0;
        }
    </style>
</head>

<body onload="window.print()">

    <table class="table-content">
        <tr>
            <td class="ext"></td>
            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="3">I.</td>
                        <td style="width: 40%;">Berangkat dari</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 55%;">BKPSDM Kota Tangerang Selatan</td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">(Tempat Kedudukan) Ke</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 55%;">{{ $sppd->tujuan }}</td>
                    </tr>

                    <tr>
                        <td style="width: 40%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 55%;">{{ \Carbon\Carbon::parse($sppd->tgl_berangkat)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>

                <div>
                    <div style="text-align: center; margin-top: 10px;">
                        <span><strong>Kepala,</strong></span>
                        <br><br><br><br>
                        <span style="text-decoration: underline; padding: 0px;"><strong>Drs, Fuad. MPA</strong></span><!-- {{ $staff->nama_staff }} -->
                        <br>
                        <span>NIP. 19741129 199303 1 003</span>
                        <!-- {{ $staff->nip }} -->
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="2">II.</td>
                        <td style="width: 25%;">Tiba di</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;">{{ $sppd->tujuan }}</td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;">{{ \Carbon\Carbon::parse($sppd->tgl_berangkat)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>
                <table class="detail-table" style="height: 114px;">
                <!-- <br><br><br> -->
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>

            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="3"></td>
                        <td style="width: 25%;">Berangkat dari</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;">{{ $sppd->tujuan }}</td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Ke</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;">BKPSDM Kota Tangerang Selatan</td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;">{{ \Carbon\Carbon::parse($sppd->tgl_kembali)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>

                <table class="detail-table" style="height: 97px;">
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="2">III.</td>
                        <td style="width: 25%;">Tiba di</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>
                </table>
                <table class="detail-table" style="height: 114px;">
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>

            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="3"></td>
                        <td style="width: 25%;">Berangkat dari</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Ke</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>
                </table>

                <table class="detail-table" style="height: 97px;">
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="2">IV.</td>
                        <td style="width: 25%;">Tiba di</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>
                </table>
                <table class="detail-table" style="height: 114px;">
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>

            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="3"></td>
                        <td style="width: 25%;">Berangkat dari</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Ke</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>
                </table>

                <table class="detail-table" style="height: 97px;">
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="2">V.</td>
                        <td style="width: 25%;">Tiba di</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>
                </table>
                <table class="detail-table" style="height: 114px;">
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>

            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="3"></td>
                        <td style="width: 25%;">Berangkat dari</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Ke</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;"></td>
                    </tr>
                </table>

                <table class="detail-table" style="height: 97px;">
                    <tr>
                        <td style="padding: 5px !important;"></td>
                        <td style="vertical-align: bottom;">(...............................................................................................)<br> NIP.</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="2">V.</td>
                        <td style="width: 25%;">Tiba di</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;">BKPSDM KOTA TANGSEL</td>
                    </tr>

                    <tr>
                        <td style="width: 25%;">Pada Tanggal</td>
                        <td style="width: 5%;">:</td>
                        <td style="width: 70%;">{{ \Carbon\Carbon::parse($sppd->tgl_kembali)->locale('id')->translatedFormat('d F Y') }}</td>
                    </tr>
                </table>
                <div>
                    <div style="text-align: center; margin-top: 20px;">
                        <span><strong>PEJABAT PEMBUAT KOMITMEN,</strong></span>
                        <br><br><br><br>
                        <span style="text-decoration: underline; padding: 0px;"><strong>Drs, Fuad. MPA</strong></span>
                        <br>
                        <span>NIP. 19741129 199303 1 003</span>
                    </div>
                </div>
            </td>

            <td class="ext">
                <table class="detail-table">
                    <tr>
                        <td rowspan="3"></td>
                        <td style="width: 100%;">Telah diperiksa dengan keterangan bahwa perjalanan tersebut atas perintahnya dan semata-mata untuk kepentingan jabatan dalam waktu yang sesingkat-singkatnya.</td>
                    </tr>
                </table>

                <div>
                    <div style="text-align: center; margin-top: 10px;">
                        <span><strong>PEJABAT PEMBUAT KOMITMEN,</strong></span>
                        <br><br><br><br>
                        <span style="text-decoration: underline; padding: 0px;"><strong>Drs, Fuad. MPA</strong></span>
                        <br>
                        <span>NIP. 19741129 199303 1 003</span>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="border: 1px solid #000">
                <table class="detail-table">
                    <tr>
                        <td>VII.</td>
                        <td style="width: 45%;">Catatan Lain</td>
                        <td style="width: 55%;"></td>
                    </tr>
                </table>
            </td>

             <td style="border: 1px solid #000"></td>
        </tr>
        <tr>
            <td colspan="2" style="border: 1px solid #000">
                <table class="detail-table">
                    <tr>
                        <td>VII.</td>
                        <td style="width: 100%;">PPK yang menerbitkan SPD, pegawai yang melakukan perjalanan dinas, para pejabat yang mengesahkan tanggal berangkat/tiba, serta bendahara pengeluaran bertanggung jawab berdasarkan peraturan-peraturan Keuangan Negara apabila Negara menderita rugi akibat kesalahan, kelalaian dan kealpaan.</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
