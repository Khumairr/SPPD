@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mt-3 text-center">Data SPPD Aktif</h3>
    <br>
    <hr class="mb-2" style="border-top: 3px solid #8B4513; width: 50%; margin: 0 auto;">
    <br>
    <!-- Search form -->
    <!-- <form action="{{ route('sppd.index') }}" method="GET" class="mb-4">
        <div class="input-group mx-auto" style="width: 40%;">
            <input type="text" name="search" class="form-control" placeholder="Cari No. SPT" value="{{ request('search') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form> -->

    <!-- SPPD Table -->
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>No.</th>
                <th>
                    <a href="{{ route('sppd.index', ['sort' => request('sort') === 'asc' ? 'desc' : 'asc']) }}" class="text-white">
                        Tanggal SPT
                        @if(request('sort') === 'asc')
                            &#9650;
                        @else
                            &#9660;
                        @endif
                    </a>
                </th>
                <th>No. SPT</th>
                <th>Tujuan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sppds as $index => $sppd)
            <tr>
                <td>{{ $index + 1 + (($sppds->currentPage() - 1) * $sppds->perPage()) }}</td>
                <td>{{ \Carbon\Carbon::parse($sppd->tgl_spt)->locale('id')->translatedFormat('d F Y') }}</td>
                <td>{{ $sppd->no_spt }}</td>
                <td>{{ $sppd->tujuan }}</td>
                <td class="text-center">
                    <span class="badge badge-secondary" style="font-size: 1rem;">
                        {{ $sppd->status }}
                    </span>
                </td>
                <td class="text-center">
                    <a href="{{ route('sppd.detail', ['id' => $sppd->id_sppd]) }}" class="btn btn-success btn-sm">Detail</a>
                    <a href="{{ route('sppd.laporan', ['id' => $sppd->id_sppd]) }}" class="btn btn-info btn-sm">Laporan</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination links -->
    <div class="d-flex justify-content-between align-items-center mt-3">
        <div>
            {{-- Navigasi pagination --}}
            @if ($sppds->hasPages())
                <div class="pagination">
                    {{-- Tautan ke halaman sebelumnya --}}
                    @if ($sppds->onFirstPage())
                        <span>&laquo;</span> <!-- Simbol << -->
                    @else
                        <a href="{{ $sppds->previousPageUrl() }}" rel="prev">&laquo;</a>
                    @endif

                    {{-- Tautan untuk setiap halaman --}}
                    @foreach ($sppds->getUrlRange(1, $sppds->lastPage()) as $page => $url)
                        @if ($page == $sppds->currentPage())
                            <span class="mx-2">{{ $page }}</span> <!-- Halaman saat ini dengan margin -->
                        @else
                            <a href="{{ $url }}" class="mx-2">{{ $page }}</a> <!-- Halaman dengan margin -->
                        @endif
                    @endforeach

                    {{-- Tautan ke halaman berikutnya --}}
                    @if ($sppds->hasMorePages())
                        <a href="{{ $sppds->nextPageUrl() }}" rel="next">&raquo;</a> <!-- Simbol >> -->
                    @else
                        <span>&raquo;</span> <!-- Simbol >> -->
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
