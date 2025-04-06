@extends('layouts.app')

@section('content')
<style>
    .custom-container {
        background-color: #f9f9f9;
        border-radius: 8px;
        padding: 30px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .page-title {
        font-weight: bold;
        color: #4a4a4a;
    }

    .custom-table {
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table th {
        background-color: #007bff;
        color: white;
        padding: 12px;
        text-align: center;
        font-size: 1.1rem;
        text-transform: uppercase;
    }

    .custom-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #ddd;
        vertical-align: middle;
        color: #333;
    }

    .custom-table tr:hover {
        background-color: #f1f1f1;
    }

    .custom-btn {
        background-color: #28a745;
        color: white;
        border-radius: 5px;
        padding: 6px 12px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .custom-btn:hover {
        background-color: #218838;
        color: white;
    }

    .info-btn {
        background-color: #17a2b8;
        color: white;
        border-radius: 5px;
        padding: 6px 12px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .info-btn:hover {
        background-color: #138496;
        color: white;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .pagination a {
        color: #007bff;
        padding: 8px 16px;
        margin: 0 4px;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .pagination a:hover {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination span {
        padding: 8px 16px;
        margin: 0 4px;
        background-color: #f1f1f1;
        border-radius: 4px;
        color: #888;
    }

</style>

<div class="container custom-container mt-5">
    <h2 class="text-center page-title mb-4">Riwayat SPPD</h2>
    <hr class="mb-5" style="border-top: 3px solid #8B4513; width: 50%; margin: 0 auto;">

    <div class="table-wrapper">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>No. Kwitansi</th>
                    <th>No. SPT</th>
                    <th>Tanggal SPT</th>
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
                    <td>
                        <a href="{{ route('riwayat.detail', ['no_kwitansi' => $item->no_kwitansi]) }}" class="custom-btn">Detail</a>
                        <a href="{{ route('riwayat.inputspj', ['no_kwitansi' => $item->no_kwitansi]) }}" class="info-btn">Upload SPJ</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if ($riwayat->hasPages())
    <div class="pagination mt-4">
        {{-- Pagination Links --}}
        @if ($riwayat->onFirstPage())
            <span>&laquo;</span>
        @else
            <a href="{{ $riwayat->previousPageUrl() }}" rel="prev">&laquo;</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($riwayat->getUrlRange(1, $riwayat->lastPage()) as $page => $url)
            @if ($page == $riwayat->currentPage())
                <span>{{ $page }}</span>
            @else
                <a href="{{ $url }}">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($riwayat->hasMorePages())
            <a href="{{ $riwayat->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <span>&raquo;</span>
        @endif
    </div>
    @endif
</div>
@endsection
