@extends('adminutama.navbar.admin')

@section('content')
<div class="mt-3">
    <h2 class="text-center">Tambah Data Kantor</h2>
    <form action="{{ route('tambahdatakantor') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nama_kantor">Nama Kantor:</label>
            <input type="text" name="nama_kantor" id="nama_kantor" class="form-control" required autocomplete='off'>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat:</label>
            <input type="text" name="alamat" id="alamat" class="form-control" required autocomplete='off'>
        </div>
        <div class="form-group">
            <label for="uang_harian">Uang Harian:</label>
            <input type="text" name="uang_harian" id="uang_harian" class="form-control" required autocomplete='off'>
        </div>
        <div class="form-group">
            <label for="transport">Transport:</label>
            <input type="text" name="transport" id="transport" class="form-control" required autocomplete='off'>
        </div>
        <div class="form-group">
            <label for="akomodasi">Akomodasi:</label>
            <input type="text" name="akomodasi" id="akomodasi" class="form-control" required autocomplete='off'>
        </div>
        <button type="submit" class="btn btn-primary mr-5">Tambah</button>
        <a href="{{ route('adminutama.datakantor') }}" class="btn btn-secondary">
            <img src="{{ asset('img/back.png') }}" alt="Back Icon" style="width: 20px; height: 20px; margin-right: 5px;">
            Back
        </a>
    </form>
</div>
@endsection