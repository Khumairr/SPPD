@extends('layouts.app')

@section('content')
<style>
    .table-thick-border {
        border: 2px solid #007bff; /* Primary color for border */
    }
    .table-thick-border th, 
    .table-thick-border td {
        border: 2px solid #007bff; /* Apply the same border to table headers and cells */
    }
    .table th {
        background-color: #007bff; /* Header background color */
        color: white; /* Header text color */
        text-align: center; /* Center align header text */
    }
    .table td {
        text-align: center; /* Center align table data */
    }
    .btn-custom {
        background-color: #28a745; /* Custom button background color */
        color: white; /* Button text color */
        transition: background-color 0.3s; /* Smooth background transition */
    }
    .btn-custom:hover {
        background-color: #218838; /* Darker green on hover */
    }
    .mt-3 {
        margin-top: 20px; /* Adjusting margin */
    }
</style>

<div class="container mt-4">
    <h3 class="mt-3 text-center">Riwayat SPPD</h3>
    <br>
    <hr class="mb-2" style="border-top: 3px solid #8B4513; width: 50%; margin: 0 auto;">
    <br>
    <table class="table table-bordered table-thick-border">
        <thead>
            <tr>
                <th>No.</th>
                <th>No. Kwitansi</th>
                <th>No. SPT</th>
                <th>Tanggal SPT</th>
                <!-- <th>Jumlah Pegawai</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($riwayat as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->no_kwitansi }}</td>
                <td>{{ $item->no_spt }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tgl_spt)->locale('id')->translatedFormat('d F Y') }}</td>
                <!-- <td>{{ $item->total_pegawai }} Pegawai</td> -->
                <td>
                    <a href="{{ route('riwayat.detail', ['no_kwitansi' => $item->no_kwitansi]) }}" class="btn btn-custom">Detail</a> |
                    <a href="{{ route('riwayat.inputspj', ['no_kwitansi' => $item->no_kwitansi]) }}" class="btn btn-info ">Upload SPJ</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
