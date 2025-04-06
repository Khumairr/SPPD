@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="text-center text-uppercase font-weight-bold" style="letter-spacing: 1.5px;">Data SPPD Aktif</h3>
    <hr class="mb-4" style="border-top: 3px solid #8B4513; width: 50%; margin: 0 auto;">

    <!-- Search form (optional) -->
    <!-- Uncomment if you want a search bar -->
    <!-- <form action="{{ route('sppd.index') }}" method="GET" class="mb-4 d-flex justify-content-center">
        <div class="input-group" style="max-width: 400px;">
            <input type="text" name="search" class="form-control" placeholder="Cari No. SPT" value="{{ request('search') }}">
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form> -->

    <!-- SPPD Table in a card -->
    <div class="card shadow-sm">
        <div class="card-body p-4">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark text-center" style="position: sticky; top: 0; z-index: 10;">
                    <tr>
                        <th>No.</th>
                        <th>
                            <a href="{{ route('sppd.index', ['sort' => request('sort') === 'asc' ? 'desc' : 'asc']) }}" class="text-white text-decoration-none">
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
                    <tr class="text-center">
                        <td>{{ $index + 1 + (($sppds->currentPage() - 1) * $sppds->perPage()) }}</td>
                        <td>{{ \Carbon\Carbon::parse($sppd->tgl_spt)->locale('id')->translatedFormat('d F Y') }}</td>
                        <td>{{ $sppd->no_spt }}</td>
                        <td>{{ $sppd->tujuan }}</td>
                        <td>
                            <span class="badge {{ $sppd->status === 'Aktif' ? 'badge-success' : 'badge-secondary' }}" style="font-size: 1rem;">
                                {{ $sppd->status }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('sppd.detail', ['id' => $sppd->id_sppd]) }}" class="btn btn-success btn-sm">Detail</a>
                            <a href="{{ route('sppd.laporan', ['id' => $sppd->id_sppd]) }}" class="btn btn-info btn-sm">Laporan</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination links -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="pagination justify-content-center">
                    {{-- Pagination with icons --}}
                    @if ($sppds->hasPages())
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($sppds->onFirstPage())
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a href="{{ $sppds->previousPageUrl() }}" class="page-link" rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($sppds->getUrlRange(1, $sppds->lastPage()) as $page => $url)
                                    @if ($page == $sppds->currentPage())
                                        <li class="page-item active" aria-current="page">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($sppds->hasMorePages())
                                    <li class="page-item">
                                        <a href="{{ $sppds->nextPageUrl() }}" class="page-link" rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled" aria-disabled="true">
                                        <span class="page-link">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
