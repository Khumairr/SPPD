@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mt-3">
        <h3 class="text-center">Edit Data Tim Kerja</h3>
        <form action="{{ route('updatetimkerja', $timkerja->id_tim_kerja) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_tim">Tim Kerja:</label>
                <input type="text" name="nama_tim" id="nama_tim" class="form-control" value="{{ $timkerja->nama_tim }}" required>
            </div>
            <div class="form-group">
                <label for="anggaran_awal">Anggaran Awal:</label>
                <input type="text" name="anggaran_awal" id="anggaran_awal" class="form-control" value="{{ $timkerja->anggaran_awal }}" required>
            </div>
            <div class="form-group">
                <label for="sisa_anggaran">Anggaran Sudah Kepakai:</label>
                <input type="text" name="sisa_anggaran" id="sisa_anggaran" class="form-control" value="{{ $timkerja->sisa_anggaran}}" required>
            </div>
            <div class="form-group">
                <label for="tahun_anggaran">Tahun Anggaran:</label>
                <input type="text" name="tahun_anggaran" id="tahun_anggaran" class="form-control" value="{{ $timkerja->tahun_anggaran }}" required>
            </div>
            <button type="submit" class="btn btn-primary mr-5">Simpan</button>
            <a href="{{ route('datatimkerja') }}" class="btn btn-secondary">
        <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
        Back
    </a>
        </form>
    </div>
</div>
@endsection
