@extends('layouts.app')

@section('content')
<div class="mt-3">
    <h2 class="text-center">Tambah Data Tim Kerja</h2>
    <form action="{{ route('storedatatimkerja') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_tim">Tim Kerja:</label>
            <input type="text" name="nama_tim" id="nama_tim" class="form-control" required autocomplete='off'>
        </div>
        <div class="form-group">
            <label for="anggaran">Anggaran Awal:</label>
            <input type="text" name="anggaran" id="anggaran" class="form-control" required autocomplete='off'>
        </div>
        <div class="form-group">
            <label for="sisa_anggaran">Anggaran Sudah Kepakai:</label>
            <input type="text" name="sisa_anggaran" id="sisa_anggaran" class="form-control" required autocomplete='off'>
        </div>
        <div class="form-group">
            <label for="tahun">Tahun:</label>
            <input type="text" name="tahun" id="tahun" class="form-control" required autocomplete='off'>
        </div>
        <br>
        <button type="submit" class="btn btn-primary mr-5">Tambah</button>
        <a href="{{ route('datatimkerja') }}" class="btn btn-secondary">
        <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
        Back
    </a>
    </form>
</div>
@endsection
