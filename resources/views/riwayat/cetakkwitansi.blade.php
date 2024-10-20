@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="mt-3 text-center">Cetak Kwitansi</h3>
        <hr class="border-2" style="border-top: 2px solid;">

        @if($kwitansi->isEmpty())
            <p>No data found</p>
        @else
            @foreach($kwitansi as $index => $p)
                <div class="form-group">
                    <label><h5>Pegawai ke {{ $index + 1 }}</h5></label><br>
                    <label>NIP :</label>
                    <input type="text" id="nip" class="form-control" value="{{ $p->nip }}" readonly><br>
                    <label>Nama :</label>
                    <input type="text" id="nama" class="form-control" value="{{ $p->nama_staff }}" readonly>
                </div>
            @endforeach
        @endif

        <button type="button" class="btn btn-danger">Cetak</button>
    </div>
@endsection
